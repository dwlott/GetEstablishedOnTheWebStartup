<!--
IndexTitle: Local WordPress Setup Plan
IndexDescription: Local WAMP development setup for the {siteKey}Web documentation site using the copied GEOTW-derived Altitude Pro theme.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-06-27
-->

# Local WordPress Setup Plan

Local-first development plan for **{siteKey}Web** — the WordPress site that will
host the {siteKey} output SSC workbook documentation. This pass is **local WAMP
only**. No Bluehost, no deployment, no production `{siteKey}.com` work.

This repository is a propagated copy of the **GetEstablishedOnTheWebStartup**
scaffold (see `AGENTS.md`). It is a planning/content/source repository. The
runnable WordPress site lives outside this repository in the WAMP web root.

## Local WAMP Facts (Confirmed 2026-06-20)

| Fact | Value | Confirmed |
| --- | --- | --- |
| Local WordPress URL | `http://localhost/{siteKey}/` | Provided by owner; not load-tested this pass |
| WAMP web root / site folder | `G:\wamp64\www\{siteKey}` | Exists (WordPress core present) |
| Active theme folder | `G:\wamp64\www\{siteKey}\wp-content\themes\altitude-pro` | Exists |
| Parent theme (Genesis) | `G:\wamp64\www\{siteKey}\wp-content\themes\genesis` | Exists (required — Altitude Pro is a Genesis child) |
| Database name | `{siteKey}` | Confirmed in `wp-config.php` (`DB_NAME`) |
| Table prefix | `Lr4_` | Changed 2026-06-26 from `wp_` to match the live Bluehost `mindfxa6_{siteKey}` tables; set in `wp-config.php` |
| Planning repository root | `C:\Repositories\{siteKey}Web` | Exists; **not** a git repository yet |
| Dropbox mirror target | `C:\Users\dwlot\Dropbox\Repositories\{siteKey}Web` | Folder exists |
| Content source repository | `C:\Repositories\{siteKey}` | Exists (workbook help markdowns live here) |

## Table Prefix Alignment With Bluehost (2026-06-26)

The local install was switched from the default `wp_` prefix to `Lr4_` so the
local tables line up with the live Bluehost `mindfxa6_{siteKey}` database, whose
tables are already prefixed `Lr4_` (capital `L`, lowercase `r4`).

Steps applied (a `mysqldump` backup was taken first, under
`G:\wamp64\sql-backups\`):

1. Renamed all 12 `wp_*` tables to `Lr4_*`.
2. Renamed the prefix-derived rows: `Lr4_options.option_name` `wp_user_roles`
   -> `Lr4_user_roles`; `Lr4_usermeta.meta_key` `wp_capabilities`,
   `wp_user_level`, `wp_dashboard_quick_press_last_post_id` -> `Lr4_...`.
   (Literal `wp_`-named options such as `wp_page_for_privacy_policy` were left
   unchanged on purpose; they are not prefix-scoped.)
3. Set `$table_prefix = 'Lr4_';` in `wp-config.php`. Home page verified loading
   (HTTP 200, no install prompt).

**Migration caveat — case sensitivity.** Local MySQL 9.1.0 runs with
`lower_case_table_names = 1`, so the table names are physically stored lowercase
(`lr4_*`) even though `wp-config.php` and the data rows use `Lr4_`. WordPress
works locally because lookups are case-insensitive. Bluehost (Linux MySQL) is
**case-sensitive**, where `lr4_` != `Lr4_`. Before any export/import to Bluehost,
plan to normalize the dumped table names to match the live `Lr4_` tables (for
example, adjust the table names in the `mysqldump` output) so the import does not
create a mismatched second set. This stays a future, owner-approved pass.

## Lowercase prefix policy (draft — plan only)

**Adopt for new sites** (including {siteKey} before first Bluehost deploy): use an
**all-lowercase** hardened prefix end-to-end (target for {siteKey}: **`lr4_`**) so
local WAMP dumps and Linux production match without per-deploy table-name casing
fixes. Historical local alignment used **`Lr4_`** (2026-06-26).

Full policy, verification checklist, and deferred legacy conversion:
[LowercaseTablePrefixPolicy.md](LowercaseTablePrefixPolicy.md).

**No wp-config, Bluehost, or automation changes** until Vanilla XPS verification
and owner approval of an implementation pass.

## Repair — install screen after prefix drift

Symptom: `http://localhost/{siteKey}/` shows the WordPress **installation**
wizard instead of the existing site.

Cause: `$table_prefix` in `wp-config.php` no longer matches the tables in the
`{siteKey}` database (common after copying `wp-config` from another install or
reverting to default `wp_`).

Fix:

1. Confirm WAMP MySQL is running and database `{siteKey}` has tables like
   `lr4_options` (phpMyAdmin or the repair script below).
2. Set `$table_prefix = 'Lr4_';` in `G:\wamp64\www\{siteKey}\wp-config.php`.
3. Reload the site. If tables are missing, restore from
   `Content/Website/Database/{siteKey}-local.sql.gz` first.

Automated check/fix from the repo root:

```powershell
.\Automation\DatabaseBackups\Repair-LocalWordPressTablePrefix.ps1
.\Automation\DatabaseBackups\Repair-LocalWordPressTablePrefix.ps1 -Apply
```

Optional explicit path:

```powershell
.\Automation\DatabaseBackups\Repair-LocalWordPressTablePrefix.ps1 `
  -WpConfigPath 'G:\wamp64\www\{siteKey}\wp-config.php' `
  -Apply
```

## Theme Source And Intended Starting Theme

The intended starting theme is the **copied, GetEstablishedOnTheWeb-derived
Altitude Pro child theme** — not a clean Altitude Pro download.

- Copied from: `G:\wamp64\www\getestablishedontheweb\wp-content\themes\altitude-pro`
- Installed at: `G:\wamp64\www\{siteKey}\wp-content\themes\altitude-pro`
- `style.css` header reports `Theme Name: Altitude Pro`, `Version: 1.5.1`,
  `Template: genesis` (Genesis child theme).
- Evidence it is the customized GEOTW copy, not pristine: the theme folder
  contains a `geotw-custom/` directory plus several retained style backups
  (`style - official.css`, `style 08-16-24.css`, `style-before-upgrade.css`,
  `style-original.css`) and a `tribe-events/` override folder.

**Do not** replace this theme with a fresh Altitude Pro download. Build on the
copied theme as the starting point.

## How This Repo Should Track WordPress Theme / Content / Source Files

Current state: this repository contains **no** {siteKey}-specific content and
**no** copy of the WordPress theme. It is still the unmodified starter scaffold.
There is no symlink, no build script, and no documented sync between this repo
and `G:\wamp64\www\{siteKey}`.

Proposed tracking model (for owner confirmation — see Open Questions):

1. **Documentation source of truth** stays here under `Content/` (page drafts in
   Markdown), routed from the {siteKey} workbook help markdowns. WordPress
   pages are authored from these drafts.
2. **Theme customizations** worth versioning (the `geotw-custom/` layer and any
   child-theme edits) should be tracked by copying just those files into this
   repo under a path such as `Content/Theme/altitude-pro/` — never the whole
   WordPress install, never WordPress core, never `genesis/`.
3. The **live WAMP install** (`G:\wamp64\www\{siteKey}`) remains the runtime
   surface, rebuildable from WordPress + the tracked theme layer + tracked
   content. It is not mirrored wholesale into this repo.
4. **Git is not yet initialized** here. Initialize when the owner approves
   (GitHubWorkflow), before relying on version history.

## Repo-To-WAMP Mapping (Resolved 2026-06-27)

Owner-confirmed mapping between this planning repository and the WAMP WordPress
site:

| Layer | Role | Where |
| --- | --- | --- |
| `{siteKey}Web` repo | Source of truth — all web content and plans | `C:\Repositories\{siteKey}Web` |
| `{siteKey}` WordPress site | Runtime site | `G:\wamp64\www\{siteKey}` -> `http://localhost/{siteKey}/` |
| SSC output web content | Repo content namespace `Content/Website/Pages/{siteKey}/`, deployed **flat** into the site | `/{siteKey}/{slug}/` (e.g. `/{siteKey}/quick-estimates/`) |
| SSC output calculator app | Generated static calculator copied from the {siteKey} output repo | `/{siteKey}/{siteKey}/` |

Notes:

- `{siteKey}\{siteKey}` refers to the repo's content **namespace** (the
  capital-`M` `{siteKey}` folder under `Content/Website/Pages/`), not a URL
  level. SSC help pages stay flat at the site root `/{siteKey}/{slug}/`, matching
  [../Content/Website/PageMap.md](../Content/Website/PageMap.md) and
  [../Content/Website/Pages/{siteKey}/Index.md](../Content/Website/Pages/{siteKey}/Index.md).
- The calculator app stays at `{siteKey}.com/{siteKey}` (local `/{siteKey}/`).
- The repo remains source of truth; the WAMP install is the rebuildable runtime
  surface (WordPress core + tracked theme layer + content authored from `Content/`).

## Static Calculator Folder (Installed 2026-06-27)

The generated SpreadsheetConverter calculator was installed as a direct static
folder in the local WordPress document root:

| Item | Value |
| --- | --- |
| Source folder | `C:\Repositories\{siteKey}\Output\SSCOutput\{siteKey}` |
| Destination folder | `G:\wamp64\www\{siteKey}\{siteKey}` |
| Local URL verified | `http://localhost/{siteKey}/{siteKey}` |
| Files copied | 27 files, including `index.htm`, `offline.appcache`, `image002.png`, `insert-into-website.htm`, and the full `assets/` tree |
| Routing/template change | None needed |

Apache/WordPress served the existing physical directory directly. The root
WordPress `.htaccess` already skips existing files and directories, and Apache
served `index.htm` from the static folder. Browser verification confirmed the
page title `{siteKey}`, SpreadsheetConverter generator metadata, local
`assets/css/app.min.css` and `assets/js/app.min.js`, and no WordPress/Genesis
header, footer, sidebar, or admin chrome.

**Authoring mechanics (resolved 2026-06-27).** Page drafts are pushed into the
running site by porting the GEOTW CLI sync toolkit (Markdown -> WordPress
upserts). Details and build sequence:
[{siteKey}LocalWordPressBuildPlan.md]({siteKey}LocalWordPressBuildPlan.md).
Execution is gated on owner approval and a DB backup before any `--write` run.

## Dropbox Mirror Validation

Mirror target: `C:\Users\dwlot\Dropbox\Repositories\{siteKey}Web` (confirmed to
exist). Per `Standards/SourceOfTruthAndMirrorStandard.md`:

- Local Git is the source of truth; Dropbox is an **optional review mirror**,
  not a Git remote and not a backup.
- Default is **no automatic cloud copy** after edits — mirror on demand only.
- Validate a mirror pass with **MirrorToWindows**
  (`Capabilities/MirrorToWindows/WorkflowIndex.md`) after recording the target
  path in `Workspace/OwnerPreferences.md` § Connectors.
- Exclude `.git/` and any intake folders from the mirror per the standard.

## Content Direction (Documentation Site)

- The site will host the **{siteKey} output SSC workbook documentation**.
- First content source: the existing output workbook help markdowns in
  `C:\Repositories\{siteKey}` (e.g. the `OutputWorkbookHelp…` material referenced
  under `C:\Repositories\{siteKey}\Automation\AgentReplies\`).
- Keep documentation **customer-facing and concise**.
- The workbook **Welcome sheet** will link out to these web pages, so the web
  pages can carry the fuller explanations the workbook cells cannot.

## Phases

1. **This pass — document local working path** (complete): confirm WAMP facts,
   theme source, DB, and the repo↔WAMP gap; write this plan and the agent reply.
2. **Next — content intake**: route the {siteKey} workbook help markdowns into
   `Content/` page drafts (ContentReview), customer-facing and concise.
3. **Next — theme tracking decision**: decide how the `geotw-custom` layer and
   child-theme edits are versioned in this repo.
4. **Later — git + mirror**: initialize git (GitHubWorkflow) and validate the
   Dropbox mirror (MirrorToWindows).
5. **Future note only — production `{siteKey}.com` / Bluehost**: out of scope
   now. Not active work. No production URLs assumed.

## Related

- [LowercaseTablePrefixPolicy.md](LowercaseTablePrefixPolicy.md)
- [AgentTaskBacklog.md](AgentTaskBacklog.md)
- [OpenQuestions.md](OpenQuestions.md)
- [../Standards/SourceOfTruthAndMirrorStandard.md](../Standards/SourceOfTruthAndMirrorStandard.md)
- [../Workspace/OwnerPreferences.md](../Workspace/OwnerPreferences.md)
- Database deploy method (page 17, draft deploy modes):
  `C:\Repositories\GetEstablishedOnTheWeb\Workspace\Reference\WordPressGenesisOperatingGuide\Pages\17-PhpMyAdminDatabaseExportAndEdit.md`
- {siteKey} deploy profile (draft):
  `C:\Repositories\GetEstablishedOnTheWeb\Workspace\SiteDeployProfiles\{siteKey}.md`
