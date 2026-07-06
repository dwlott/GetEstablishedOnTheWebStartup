<!--
IndexTitle: GEOTW Page Interiors
IndexDescription: Hide Genesis titles, title plus intro row layout, lead headline styling, and image sizes for GEOTW inner pages.
IndexType: Reference
IndexStatus: Active
LastEdited: 2026-06-14
-->

# GEOTW Page Interiors

## Use For Capability

Style inner pages on local GEOTW Altitude Pro: hide duplicate theme titles, apply
**title + intro row** layout, and sync from Git Markdown + page images.

Future **Altitude Capability** on the GetEstablished host can own these patterns;
this doc is the product-repo reference until promoted.

## Hide theme page title

Genesis renders `h1.entry-title` in `header.entry-header`. GEOTW instead:

1. Sets post meta `_genesis_hide_title` on synced pages (Customizer **Hide Title**).
2. Adds `genesis_title_hidden` filter for inner pages in `geotw-customizations.php`.
3. Renders `<h1 class="geotw-page-title">` inside page HTML from Markdown `# Title`.

Body class: `genesis-title-hidden`. One H1 per page for accessibility.

## Title + intro row pattern

Default for messaging-sync pages (2026-06-14):

```text
h1.geotw-page-title
geotw-page-intro
  one-third first → intro image
  two-thirds      → first paragraph as p.geotw-page-lead; second as p.geotw-page-deck
  hr.clearfix
single-column body (third paragraph onward + lists, links, sections)
```

**Markdown convention:** the first paragraph after `# Title` is the **headline** (lead).
The second paragraph is the **deck** — a supporting line directly under the headline.
Both sit beside the intro image. Further content flows in the body column below.

Column classes are **Altitude built-in** — not the Genesis Columns plugin.
See [13-ColumnClasses.md](../../StudioPressAltitudeProInstructions/Pages/13-ColumnClasses.md).

### Manifest keys

`Workspace/LocalWordPressBuild/page-layout-manifest.php` per slug:

| Key | Standard | Notes |
| --- | --- | --- |
| `intro` | `{slug}-intro.jpg` | Required for intro row |
| `intro_paragraphs` | `2` | Lead + deck beside image; pages with one intro para use only the first |
| `banner` | *(deprecated)* | Optional; omit to skip full-width hero |

Banner JPGs may remain in Git under `PageImages/` but are not rendered when
`banner` is absent from the manifest.

## Image sizes

| Role | Display | Source file | WP size name |
| --- | --- | --- | --- |
| Page banner *(optional / unused)* | 960 × 320 px | 1920 × 640 px (3:1) | `geotw-page-banner` |
| Intro column | ~300 × 300 px | 600 × 600 px (1:1) | `geotw-page-intro` |
| Home Featured Page widget | 1140 × 400 px | theme default | `featured-page` |

Git sources:

```text
Content/Website/Assets/PageImages/
  {slug}-intro.jpg
  {slug}-intro.attribution.txt
  {slug}-banner.jpg          ← optional legacy; not used in intro-only layout
```

Layout manifest:

```text
Workspace/LocalWordPressBuild/page-layout-manifest.php
```

## Lead headline CSS

In `geotw-altitude-custom.css`:

- `.geotw-page-intro .two-thirds` — flex, vertically centers headline beside image
- `.geotw-page-lead` — 28px desktop, 22px mobile, font-weight 600
- `.geotw-page-deck` — 18px desktop, 16px mobile, italic, muted color, left accent bar

Sync applies via `geotw-theme-css-sync.php`.

## Altitude heading gotchas

| Selector | Default Altitude | GEOTW overlay |
| --- | --- | --- |
| `h1.entry-title` | 48px (hidden on inner pages) | — |
| `h2` (global) | **80px** | `.page .entry-content h2` → **28px** |
| `h3` | 38px | `.page .entry-content h3` → **22px** |
| In-content title | — | `h1.geotw-page-title` → **36px** |
| Intro lead | — | `p.geotw-page-lead` → **28px** (22px mobile) |
| Intro deck | — | `p.geotw-page-deck` → **18px** (16px mobile) |

Do not use bare `h2` for page titles in Markdown body — use `#` in source;
sync extracts it to `h1.geotw-page-title`.

## Inline markup (body accents)

Parsed by `geotw_inline_md()` in `geotw-wp-content-lib.php`. Styled in
`geotw-altitude-custom.css`. Term list: [ProductLanguageAndPositioning.md](../../../Plans/ProductLanguageAndPositioning.md).

| Role | Markdown | HTML | When to use |
| --- | --- | --- | --- |
| Key term | `**GetEstablished**` | `<strong>` | Product names, method terms, **source of truth** |
| File / path | `` `AGENTS.md` `` | `<code>` | Filenames, repo paths, module names |
| Soft emphasis | `*reviewable*` | `<em>` | Sparse — workflow qualities, not every adjective |

**Rules**

- Do **not** mark up lead or deck paragraphs (first two lines after `# Title`).
- Prefer **2–3 accented phrases per sentence** maximum.
- Keep lead/deck plain; accent the body column and lists only.
- No auto-glossary highlighting — authors mark terms in Git Markdown.

CSS overrides Altitude’s black `code` chip with a light blue-gray chip and applies
brand accent color to `strong` links.

## References (editorial typography)

GEOTW inner-page styling follows common **editorial design** and **typographic
hierarchy** practice — not a single “text beautification” standard. Useful anchors:

| Reference | Use for GEOTW |
| --- | --- |
| **Typographic hierarchy** | Title → lead → deck → body; inline `strong` / `code` / `em` roles |
| **Editorial structure** | Publishing terms: headline (lead), deck (standfirst), body copy |
| [WCAG 2 contrast](https://www.w3.org/WAI/WCAG22/quickref/#contrast-minimum) | Legibility floor — accent colors must stay readable on the content card |
| [ProductLanguageAndPositioning.md](../../../Plans/ProductLanguageAndPositioning.md) | Which product terms deserve `**` markup |
| *The Elements of Typographic Style* (Bringhurst) | Classic guidance on hierarchy, measure, and restraint — optional deep read |

**GEOTW choices (take the best, leave the rest):** system fonts (no extra web
fonts in v1); author-marked Markdown accents only (no auto-glossary); lead/deck
stay plain; body uses semantic markup + CSS tokens in `geotw-altitude-custom.css`.

Disciplines that overlap this work: **content design**, **information design**,
**typography**. Copywriting covers the words; this doc covers structure and
emphasis on the page.

## Sync workflow

After Markdown or CSS edits:

```text
G:\wamp64\bin\php\php8.3.14\php.exe C:\Repositories\GetEstablishedOnTheWeb\Workspace\LocalWordPressBuild\geotw-theme-css-sync.php
G:\wamp64\bin\php\php8.3.14\php.exe C:\Repositories\GetEstablishedOnTheWeb\Workspace\LocalWordPressBuild\geotw-messaging-sync.php
```

`geotw_build_page_html()` in `geotw-wp-content-lib.php` uploads images from Git
( keyed by `geotw_source_file` meta ) and assembles the shell.

## Related

- [09-GEOTWAltitudeCustomCSS.md](09-GEOTWAltitudeCustomCSS.md)
- [10-GEOTWGenesisCustomizerBaseline.md](10-GEOTWGenesisCustomizerBaseline.md)
- [16-GEOTWMenusAndHubTemplates.md](16-GEOTWMenusAndHubTemplates.md)
- [Workspace/LocalWordPressBuild.md](../../LocalWordPressBuild.md)
