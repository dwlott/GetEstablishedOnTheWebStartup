#!/usr/bin/env python3
"""
Prepare a local WordPress SQL dump for Bluehost import.

The script rewrites SQL string literals from the local WAMP URL to the public
site URL, verifies the WordPress table prefix, and refuses to edit serialized
PHP values that contain local URLs.
"""

from __future__ import annotations

import argparse
import json
import re
import sys
from dataclasses import dataclass
from pathlib import Path
from urllib.parse import urlparse


SERIALIZED_MARKER_RE = re.compile(r"(?:^|[;{}])(?:a|O|s|i|b|d|N):")
CREATE_OPTIONS_RE = re.compile(
    r"CREATE TABLE(?: IF NOT EXISTS)? `(?P<prefix>[^`]+)options`", re.IGNORECASE
)


@dataclass
class PrepStats:
    sql_literals_seen: int = 0
    sql_literals_changed: int = 0
    url_replacements: int = 0
    serialized_url_blocks: int = 0


def scheme_less(url: str) -> str:
    parsed = urlparse(url)
    if not parsed.netloc:
        raise ValueError(f"URL must include a host: {url}")
    path = parsed.path.rstrip("/")
    return f"//{parsed.netloc}{path}"


def mysql_unescape(value: str) -> str:
    out: list[str] = []
    i = 0
    while i < len(value):
        char = value[i]
        if char != "\\" or i + 1 >= len(value):
            out.append(char)
            i += 1
            continue

        nxt = value[i + 1]
        replacements = {
            "0": "\0",
            "'": "'",
            '"': '"',
            "b": "\b",
            "n": "\n",
            "r": "\r",
            "t": "\t",
            "Z": "\x1a",
            "\\": "\\",
        }
        out.append(replacements.get(nxt, nxt))
        i += 2
    return "".join(out)


def mysql_escape(value: str) -> str:
    return (
        value.replace("\\", "\\\\")
        .replace("\0", "\\0")
        .replace("'", "\\'")
        .replace('"', '\\"')
        .replace("\b", "\\b")
        .replace("\n", "\\n")
        .replace("\r", "\\r")
        .replace("\t", "\\t")
        .replace("\x1a", "\\Z")
    )


def looks_serialized(value: str) -> bool:
    return bool(SERIALIZED_MARKER_RE.search(value))


def count_and_replace(value: str, old: str, new: str, stats: PrepStats) -> str:
    count = value.count(old)
    if count:
        stats.url_replacements += count
        value = value.replace(old, new)
    return value


def adapt_literal(value: str, local_url: str, public_url: str, stats: PrepStats) -> str:
    local_scheme_less = scheme_less(local_url)
    public_scheme_less = scheme_less(public_url)
    local_https = "https://" + urlparse(local_url).netloc + urlparse(local_url).path.rstrip("/")
    insecure_public = "http://" + urlparse(public_url).netloc + urlparse(public_url).path.rstrip("/")

    needles = (
        local_url,
        local_https,
        local_scheme_less,
        local_url.replace("/", r"\/"),
        local_https.replace("/", r"\/"),
        local_scheme_less.replace("/", r"\/"),
        insecure_public,
        insecure_public.replace("/", r"\/"),
    )
    if any(needle and needle in value for needle in needles) and looks_serialized(value):
        stats.serialized_url_blocks += 1
        raise ValueError(
            "A local URL was found inside a PHP-serialized value. "
            "Use a WordPress-aware search/replace workflow before exporting."
        )

    before = value
    value = count_and_replace(value, local_url, public_url, stats)
    value = count_and_replace(value, local_https, public_url, stats)
    value = count_and_replace(value, local_scheme_less, public_scheme_less, stats)
    value = count_and_replace(value, local_url.replace("/", r"\/"), public_url.replace("/", r"\/"), stats)
    value = count_and_replace(value, local_https.replace("/", r"\/"), public_url.replace("/", r"\/"), stats)
    value = count_and_replace(value, local_scheme_less.replace("/", r"\/"), public_scheme_less.replace("/", r"\/"), stats)
    value = count_and_replace(value, insecure_public, public_url, stats)
    value = count_and_replace(value, insecure_public.replace("/", r"\/"), public_url.replace("/", r"\/"), stats)

    if value != before:
        stats.sql_literals_changed += 1
    return value


def adapt_sql_literals(text: str, local_url: str, public_url: str, stats: PrepStats) -> str:
    pieces: list[str] = []
    i = 0
    while i < len(text):
        if text[i] != "'":
            pieces.append(text[i])
            i += 1
            continue

        i += 1
        raw: list[str] = []
        while i < len(text):
            char = text[i]
            if char == "\\" and i + 1 < len(text):
                raw.append(text[i : i + 2])
                i += 2
                continue
            if char == "'" and i + 1 < len(text) and text[i + 1] == "'":
                raw.append("''")
                i += 2
                continue
            if char == "'":
                i += 1
                break
            raw.append(char)
            i += 1
        else:
            raise ValueError("Unterminated SQL string literal.")

        stats.sql_literals_seen += 1
        decoded = mysql_unescape("".join(raw).replace("''", "\\'"))
        adapted = adapt_literal(decoded, local_url, public_url, stats)
        pieces.append("'" + mysql_escape(adapted) + "'")

    return "".join(pieces)


def detect_prefixes(text: str) -> list[str]:
    prefixes: list[str] = []
    for match in CREATE_OPTIONS_RE.finditer(text):
        prefix = match.group("prefix")
        if prefix not in prefixes:
            prefixes.append(prefix)
    return prefixes


def strip_database_selection(text: str, target_database: str) -> str:
    text = re.sub(r"(?im)^CREATE DATABASE\b.*?;\s*$", "", text)
    text = re.sub(r"(?im)^USE\s+`?[^`;]+`?\s*;\s*$", "", text)
    return re.sub(r"-- Database: `[^`]+`", f"-- Database: `{target_database}`", text)


def validate_output(text: str, expected_prefix: str, local_url: str, public_url: str) -> dict[str, object]:
    remaining_local = text.count(local_url) + text.count(local_url.replace("http://", "https://"))
    remaining_local += text.count(scheme_less(local_url))
    remaining_http_public = text.count(public_url.replace("https://", "http://"))
    prefixes = detect_prefixes(text)
    siteurl_ok = bool(
        re.search(
            r"\(\s*\d+\s*,\s*'siteurl'\s*,\s*'"
            + re.escape(public_url)
            + r"'",
            text,
        )
    )
    home_ok = bool(
        re.search(
            r"\(\s*\d+\s*,\s*'home'\s*,\s*'"
            + re.escape(public_url)
            + r"'",
            text,
        )
    )
    prefix_ok = expected_prefix in prefixes
    return {
        "remainingLocalUrlReferences": remaining_local,
        "remainingHttpPublicReferences": remaining_http_public,
        "detectedPrefixes": prefixes,
        "prefixOk": prefix_ok,
        "siteurlOk": siteurl_ok,
        "homeOk": home_ok,
    }


def parse_args() -> argparse.Namespace:
    parser = argparse.ArgumentParser(description=__doc__)
    parser.add_argument("--input", required=True, type=Path)
    parser.add_argument("--output", required=True, type=Path)
    parser.add_argument("--local-url", default="http://localhost/yoursite")
    parser.add_argument("--public-url", default="https://your-site.example")
    parser.add_argument("--target-database", default="youraccount_yoursite")
    parser.add_argument("--expected-prefix", default="wp_")
    parser.add_argument("--report", type=Path)
    return parser.parse_args()


def main() -> int:
    args = parse_args()
    text = args.input.read_text(encoding="utf-8-sig")
    prefixes = detect_prefixes(text)
    if args.expected_prefix not in prefixes:
        raise SystemExit(
            f"Expected prefix {args.expected_prefix!r} was not found. "
            f"Detected prefixes: {', '.join(prefixes) or '(none)'}"
        )

    stats = PrepStats()
    text = strip_database_selection(text, args.target_database)
    text = adapt_sql_literals(text, args.local_url.rstrip("/"), args.public_url.rstrip("/"), stats)
    validation = validate_output(text, args.expected_prefix, args.local_url.rstrip("/"), args.public_url.rstrip("/"))

    if not validation["prefixOk"]:
        raise SystemExit(f"Output prefix verification failed: {validation['detectedPrefixes']}")
    if validation["remainingLocalUrlReferences"]:
        raise SystemExit(f"Output still contains {validation['remainingLocalUrlReferences']} local URL references.")
    if validation["remainingHttpPublicReferences"]:
        raise SystemExit(
            f"Output still contains {validation['remainingHttpPublicReferences']} insecure public URL references."
        )
    if not validation["siteurlOk"] or not validation["homeOk"]:
        raise SystemExit("Output did not verify both siteurl and home as the public URL.")

    args.output.parent.mkdir(parents=True, exist_ok=True)
    args.output.write_text(text, encoding="utf-8", newline="\n")

    report = {
        "input": str(args.input),
        "output": str(args.output),
        "targetDatabase": args.target_database,
        "expectedPrefix": args.expected_prefix,
        "localUrl": args.local_url.rstrip("/"),
        "publicUrl": args.public_url.rstrip("/"),
        "sqlLiteralsSeen": stats.sql_literals_seen,
        "sqlLiteralsChanged": stats.sql_literals_changed,
        "urlReplacements": stats.url_replacements,
        "serializedUrlBlocks": stats.serialized_url_blocks,
        **validation,
        "outputBytes": args.output.stat().st_size,
    }
    if args.report:
        args.report.parent.mkdir(parents=True, exist_ok=True)
        args.report.write_text(json.dumps(report, indent=2) + "\n", encoding="utf-8")
    print(json.dumps(report, indent=2))
    return 0


if __name__ == "__main__":
    try:
        raise SystemExit(main())
    except ValueError as exc:
        print(f"error: {exc}", file=sys.stderr)
        raise SystemExit(1)
