<!--
IndexTitle: WordPressContentUpdate Rules
IndexDescription: Starter-safe rules for Markdown/manifest sync into local WordPress, including the page intro stack.
IndexType: Capability
CapabilityName: WordPressContentUpdate
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-07-16
-->

# WordPressContentUpdate Rules

## Scope

Markdown and manifest sync into local WordPress via `Workspace/LocalWordPressBuild/ges-*.php`.

In scope:

- Editing manifests for the **owner's** site map
- Running starter sync scripts with `--only`
- Dry-run before owner-approved write passes
- Page/post intro-stack layout contract (below)

Out of scope:

- Full GEOTW product sync (capability catalog, offer hubs, messaging) — scripts not shipped
- `--write` without **WordPressMigrationBackup** first
- Production deploy
- High Altitude / AltitudeProOverlay recipes (commissioned repos only)

## Before Any Pass

1. Read `Workspace/LocalWordPressBuild/site-manifest.json`.
2. Confirm owner approved the pass scope.
3. Route through **WordPressWebsite** when unsure which child Capability owns the task.

## Page / Post Layout (mandatory — every create or update)

Do not invent alternate layouts. Every page/post uses this stack:

| Requirement | How |
| --- | --- |
| Hide Genesis entry titles | Build scripts / hide-title helpers |
| Visible title | In-content `h1.ges-page-title` |
| Intro stack | **Intro Photo → Intro Hero (lead) → Intro Body (deck) → Intro Pitch** |
| Markdown | First **two** body paragraphs = lead + deck; then headings/body |
| Layout row | `Workspace/LocalWordPressBuild/page-layout-manifest.php` — `intro` image, `intro_paragraphs` => 2, `intro_pitch_html` |
| Front-page bands | Featured Page widget `show_title` => 0 when featuring a real page |

Theme CSS for the intro stack may be refined later on a commissioned project
repo (AltitudeProOverlay). The **content contract** above is required in this
starter regardless.

## Manifest edit rules

| File | Commission site |
| --- | --- |
| `content-manifest.php` | Owner categories/archives only; remove showcase/MoverCalcs rows |
| `nav-menu-manifest.php` | Owner nav; remove Get Listed / Use AI unless owner wants them |
| `page-layout-manifest.php` | Slugs that exist in `Content/Website/Pages/` |

## Related

- [Prompt.md](Prompt.md)
- [../WordPressWebsite/NewCommissionSiteChecklist.md](../WordPressWebsite/NewCommissionSiteChecklist.md)
