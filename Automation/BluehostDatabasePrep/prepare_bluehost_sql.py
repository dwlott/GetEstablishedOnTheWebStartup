#!/usr/bin/env python3
"""
Prepare a local WordPress SQL dump for Bluehost import.

The script rewrites SQL string literals from the local WAMP URL to the public
site URL, safely repairs PHP-serialized string lengths, verifies the WordPress
table prefix, and refuses to produce an import containing local or insecure
public URLs.

Promoted from MoverCalcsWeb commissioned go-live lessons (2026-08 through
2026-09). Generalized for GetEstablishedOnTheWebStartup SiteDeployProfiles.
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
DROP_TABLE_RE = re.compile(r"(?im)^DROP TABLE IF EXISTS \x60[^\x60]+\x60;\s*$")
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
    if old.startswith("/") or old.startswith(r"\/"):
        pattern = rf"(?<![A-Za-z0-9._-]){re.escape(old)}"
        value, count = re.subn(pattern, new, value)
    else:
        count = value.count(old)
        value = value.replace(old, new) if count else value
    if count:
        stats.url_replacements += count
    return value


def url_forms(url: str) -> tuple[str, ...]:
    parsed = urlparse(url)
    https = "https://" + parsed.netloc + parsed.path.rstrip("/")
    scheme_less_url = scheme_less(url)
    return (
        url,
        https,
        scheme_less_url,
        url.replace("/", r"\/"),
        https.replace("/", r"\/"),
        scheme_less_url.replace("/", r"\/"),
    )


def replacement_forms(old_url: str, new_url: str) -> tuple[tuple[str, str], ...]:
    """Return URL or path-only forms without requiring a host for paths."""
    if old_url.startswith("/") and new_url.startswith("/"):
        return (
            (old_url, new_url),
            (old_url.replace("/", r"\/"), new_url.replace("/", r"\/")),
        )

    forms: list[tuple[str, str]] = []
    forms.extend(zip(url_forms(old_url), url_forms(new_url)))
    insecure_public = "http://" + urlparse(new_url).netloc + urlparse(new_url).path.rstrip("/")
    forms.append((insecure_public, new_url))
    forms.append((insecure_public.replace("/", r"\/"), new_url.replace("/", r"\/")))
    return tuple(forms)


def apply_mappings(value: str, mappings: list[tuple[str, str]], stats: PrepStats) -> str:
    before = value
    for old, new in mappings:
        value = count_and_replace(value, old, new, stats)
    return value


class SerializedPhpRewriter:
    """Rewrite PHP serialized strings while recalculating string byte lengths."""

    def __init__(self, value: str, mappings: list[tuple[str, str]], stats: PrepStats):
        self.value = value
        self.mappings = mappings
        self.stats = stats
        self.index = 0

    def _take_until(self, delimiter: str) -> str:
        end = self.value.find(delimiter, self.index)
        if end < 0:
            raise ValueError("Malformed PHP-serialized value.")
        result = self.value[self.index:end]
        self.index = end + len(delimiter)
        return result

    def _take_string_payload(self, byte_length: int) -> str:
        start = self.index
        consumed = 0
        while self.index < len(self.value) and consumed < byte_length:
            consumed += len(self.value[self.index].encode("utf-8"))
            self.index += 1
        if consumed != byte_length or not self.value.startswith('";', self.index):
            raise ValueError("Malformed PHP-serialized string length.")
        payload = self.value[start:self.index]
        self.index += 2
        return payload

    def parse(self) -> str:
        result = self.parse_value()
        if self.index != len(self.value):
            raise ValueError("Trailing data in PHP-serialized value.")
        return result

    def parse_value(self) -> str:
        if self.index >= len(self.value):
            raise ValueError("Unexpected end of PHP-serialized value.")
        kind = self.value[self.index]
        self.index += 1

        if kind == "N":
            if self.index >= len(self.value) or self.value[self.index] != ";":
                raise ValueError("Malformed PHP-serialized null.")
            self.index += 1
            return "N;"

        if kind in {"b", "i", "d", "r", "R"}:
            return kind + ":" + self._take_until(";") + ";"

        if kind == "s":
            if self.index >= len(self.value) or self.value[self.index] != ":":
                raise ValueError("Malformed PHP-serialized string.")
            self.index += 1
            byte_length = int(self._take_until(":"))
            if self.index >= len(self.value) or self.value[self.index] != '"':
                raise ValueError("Malformed PHP-serialized string quote.")
            self.index += 1
            payload = self._take_string_payload(byte_length)
            rewritten = apply_mappings(payload, self.mappings, self.stats)
            return f's:{len(rewritten.encode("utf-8"))}:"{rewritten}";'

        if kind in {"a", "O"}:
            if self.index >= len(self.value) or self.value[self.index] != ":":
                raise ValueError("Malformed PHP-serialized aggregate.")
            self.index += 1
            if kind == "O":
                class_length = int(self._take_until(":"))
                if self.index >= len(self.value) or self.value[self.index] != '"':
                    raise ValueError("Malformed PHP-serialized class.")
                self.index += 1
                class_name = self._take_string_payload(class_length)
                prefix = f'O:{len(class_name.encode("utf-8"))}:"{class_name}":'
            else:
                prefix = "a:"
            count = self._take_until(":")
            if self.index >= len(self.value) or self.value[self.index] != "{":
                raise ValueError("Malformed PHP-serialized aggregate body.")
            self.index += 1
            body = []
            for _ in range(int(count)):
                body.append(self.parse_value())
                body.append(self.parse_value())
            if self.index >= len(self.value) or self.value[self.index] != "}":
                raise ValueError("Malformed PHP-serialized aggregate terminator.")
            self.index += 1
            return prefix + count + ":{" + "".join(body) + "}"

        raise ValueError(f"Unsupported PHP-serialized type {kind!r}.")


def rewrite_serialized(value: str, mappings: list[tuple[str, str]], stats: PrepStats) -> str:
    return SerializedPhpRewriter(value, mappings, stats).parse()


def adapt_literal(value: str, replacements: list[tuple[str, str]], stats: PrepStats) -> str:
    mappings: list[tuple[str, str]] = []
    for old_url, new_url in replacements:
        mappings.extend(replacement_forms(old_url, new_url))

    if any(old and old in value for old, _ in mappings) and looks_serialized(value):
        stats.serialized_url_blocks += 1
        return rewrite_serialized(value, mappings, stats)

    before = value
    value = apply_mappings(value, mappings, stats)

    if value != before:
        stats.sql_literals_changed += 1
    return value


def adapt_sql_literals(text: str, replacements: list[tuple[str, str]], stats: PrepStats) -> str:
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
        adapted = adapt_literal(decoded, replacements, stats)
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


def normalize_prefix_case(text: str, expected_prefix: str) -> str:
    pattern = re.compile(re.escape(expected_prefix), re.IGNORECASE)
    return pattern.sub(expected_prefix, text)


def validate_wordpress_prefix_keys(text: str, expected_prefix: str) -> bool:
    required = (
        f"'{expected_prefix}capabilities'",
        f"'{expected_prefix}user_level'",
    )
    if not all(key in text for key in required):
        return False

    key_pattern = re.compile(
        r"['\"](?P<prefix>[A-Za-z0-9_]+)(?P<suffix>capabilities|user_level)['\"]",
        re.IGNORECASE,
    )
    return all(
        match.group("prefix") == expected_prefix
        for match in key_pattern.finditer(text)
    )


def local_path_pattern(local_url: str) -> str | None:
    path = urlparse(local_url).path.strip("/")
    if not path:
        return None
    return rf"(?:^|[\"' =])/{re.escape(path)}(?:/|[\"' ?#=]|$)"


def validate_output(
    text: str, expected_prefix: str, replacements: list[tuple[str, str]], local_url: str
) -> dict[str, object]:
    remaining_local = sum(
        sum(text.count(form) for form, _ in replacement_forms(old_url, new_url))
        for old_url, new_url in replacements
        if not old_url.startswith("/")
    )
    remaining_http_public = sum(
        text.count("http://" + urlparse(new_url).netloc + urlparse(new_url).path.rstrip("/"))
        for _, new_url in replacements
        if not new_url.startswith("/")
    )
    primary_local_url, primary_public_url = replacements[0]
    prefixes = detect_prefixes(text)
    prefix_case_matches = re.findall(re.escape(expected_prefix), text, re.IGNORECASE)
    prefix_case_ok = all(match == expected_prefix for match in prefix_case_matches)
    wordpress_prefix_keys_ok = validate_wordpress_prefix_keys(text, expected_prefix)
    siteurl_ok = bool(
        re.search(
            r"\(\s*\d+\s*,\s*'siteurl'\s*,\s*'"
            + re.escape(primary_public_url.rstrip("/"))
            + r"'",
            text,
        )
    )
    home_ok = bool(
        re.search(
            r"\(\s*\d+\s*,\s*'home'\s*,\s*'"
            + re.escape(primary_public_url.rstrip("/"))
            + r"'",
            text,
        )
    )
    prefix_ok = expected_prefix in prefixes
    drop_table_count = len(DROP_TABLE_RE.findall(text))
    loopback_patterns = {
        "localhost": r"(?:https?:)?//localhost(?=[:/?\"' ]|$)",
        "ipv4Loopback": r"(?:https?:)?//127\.0\.0\.1(?=[:/?\"' ]|$)",
        "ipv6Loopback": r"(?:https?:)?//\[?::1\]?(?=[:/?\"' ]|$)",
    }
    loopback_counts = {
        name: len(re.findall(pattern, text, re.IGNORECASE))
        for name, pattern in loopback_patterns.items()
    }
    path_pattern = local_path_pattern(primary_local_url)
    local_path_references: list[str] = []
    if path_pattern:
        public_path = urlparse(primary_public_url).path.strip("/")
        local_path_references = sorted(
            {
                match
                for match in re.findall(path_pattern, text, re.IGNORECASE)
                if public_path and match.lstrip("\"' =").lower() != f"/{public_path.lower()}/"
            }
        )
    remaining_local_host = sum(loopback_counts.values())
    return {
        "remainingLocalUrlReferences": remaining_local,
        "remainingLocalHostReferences": remaining_local_host,
        "loopbackReferenceCounts": loopback_counts,
        "remainingLocalPathReferences": len(local_path_references),
        "remainingLocalPathSamples": local_path_references[:20],
        "remainingHttpPublicReferences": remaining_http_public,
        "detectedPrefixes": prefixes,
        "prefixCaseOk": prefix_case_ok,
        "wordpressPrefixKeysOk": wordpress_prefix_keys_ok,
        "dropTableStatements": drop_table_count,
        "replacementReady": drop_table_count > 0,
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
    parser.add_argument(
        "--additional-replacement",
        action="append",
        default=[],
        metavar="LOCAL=PUBLIC",
        help="Additional URL mapping, repeatable (cross-site links or path-only maps).",
    )
    parser.add_argument("--report", type=Path)
    return parser.parse_args()


def normalize_mapping_endpoint(value: str) -> str:
    if value.startswith("/"):
        return value
    return value.rstrip("/")


def main() -> int:
    args = parse_args()
    text = args.input.read_text(encoding="utf-8-sig")
    prefixes = detect_prefixes(text)
    if args.expected_prefix not in prefixes:
        raise SystemExit(
            f"Expected prefix {args.expected_prefix!r} was not found. "
            f"Detected prefixes: {', '.join(prefixes) or '(none)'}"
        )

    replacements = [(args.local_url.rstrip("/"), args.public_url.rstrip("/"))]
    for item in args.additional_replacement:
        if "=" not in item:
            raise SystemExit(f"Invalid --additional-replacement {item!r}; use LOCAL=PUBLIC")
        old_url, new_url = item.split("=", 1)
        replacements.append(
            (normalize_mapping_endpoint(old_url), normalize_mapping_endpoint(new_url))
        )

    stats = PrepStats()
    text = strip_database_selection(text, args.target_database)
    text = normalize_prefix_case(text, args.expected_prefix)
    text = adapt_sql_literals(text, replacements, stats)
    validation = validate_output(text, args.expected_prefix, replacements, args.local_url)

    if not validation["prefixOk"]:
        raise SystemExit(f"Output prefix verification failed: {validation['detectedPrefixes']}")
    if not validation["replacementReady"]:
        raise SystemExit("Output is not replacement-ready; no DROP TABLE statements were found.")
    if not validation["prefixCaseOk"]:
        raise SystemExit("Output contains a mixed-case reference to the expected WordPress table prefix.")
    if not validation["wordpressPrefixKeysOk"]:
        raise SystemExit(
            "Output is missing consistently-prefixed WordPress capability metadata keys."
        )
    if validation["remainingLocalUrlReferences"]:
        raise SystemExit(f"Output still contains {validation['remainingLocalUrlReferences']} local URL references.")
    if validation["remainingLocalHostReferences"]:
        raise SystemExit(
            "Output still contains loopback host references: "
            f"{validation['loopbackReferenceCounts']}"
        )
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
        "replacementMappings": [{"local": old, "public": new} for old, new in replacements],
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
