<!--
IndexTitle: Local WordPress Setup Plan
IndexDescription: Local WAMP development setup for a WordPress site built from this starter, using a Genesis child theme.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-07-06
-->

# Local WordPress Setup Plan

Local-first development plan for a WordPress site built from this starter. This
pass is **local WAMP only** — no host, no deployment, no production work until the
owner approves a build pass.

This repository is a planning/content/source repository derived from the
**GetEstablishedOnTheWebStartup** scaffold (see `AGENTS.md`). The runnable
WordPress site lives **outside** this repository in the WAMP web root.

Replace `{siteKey}` below with your own site folder name (the folder under the
WAMP `www` directory that holds `wp-config.php`).

## Local WAMP Facts (template)

| Fact | Value |
| --- | --- |
| Local WordPress URL | `http://localhost/{siteKey}/` |
| WAMP web root / site folder | `<WAMP www>\{siteKey}` (e.g. `C:\wamp64\www\{siteKey}`) |
| Active theme folder | `<WAMP www>\{siteKey}\wp-content\themes\<child-theme>` |
| Parent theme (Genesis) | `<WAMP www>\{siteKey}\wp-content\themes\genesis` (required for a Genesis child) |
| Database name | your local DB name (see `wp-config.php` `DB_NAME`) |
| Table prefix | your prefix (see `$table_prefix` in `wp-config.php`) |
| Planning repository root | `C:\Repositories\{siteKey}Web` |
| Content source repository | your content/source repo, if separate |

Record the actual values for your machine in `Workspace/OwnerPreferences.md` and,
if you deploy, in a `Workspace/SiteDeployProfiles/<Site>.md` profile.

## Table Prefix Alignment

If your production host uses a **hardened (non-default) table prefix**, align the
local install's prefix so local dumps and production match without per-deploy
table-name fixes. Recommended policy: use an **all-lowercase** hardened prefix
end-to-end so Windows (WAMP) and Linux (production) agree regardless of MySQL
case sensitivity.

> Case-sensitivity note: Windows MySQL is typically case-insensitive for table
> names, but Linux production is case-sensitive. Keep the prefix lowercase to
> avoid a mismatched second set of tables on import.

Full policy and verification checklist:
[LowercaseTablePrefixPolicy.md](LowercaseTablePrefixPolicy.md). Make no
`wp-config`, host, or automation changes until the owner approves a pass.

## Repair — install screen after prefix drift

Symptom: `http://localhost/{siteKey}/` shows the WordPress **installation**
wizard instead of the existing site.

Cause: `$table_prefix` in `wp-config.php` no longer matches the tables in the
database (common after copying `wp-config` from another install or reverting to
the default `wp_`).

Fix:

1. Confirm WAMP MySQL is running and the database has the expected `*_options`
   table (phpMyAdmin or the repair script below).
2. Set `$table_prefix` in `<WAMP www>\{siteKey}\wp-config.php` to match the
   tables.
3. Reload the site. If tables are missing, restore your local database snapshot
   first.

Automated check/fix from the repo root (set `WP_SITE_KEY` or pass `-SiteKey`):

```powershell
.\Automation\DatabaseBackups\Repair-LocalWordPressTablePrefix.ps1
.\Automation\DatabaseBackups\Repair-LocalWordPressTablePrefix.ps1 -Apply
```

Optional explicit path:

```powershell
.\Automation\DatabaseBackups\Repair-LocalWordPressTablePrefix.ps1 `
  -WpConfigPath '<WAMP www>\{siteKey}\wp-config.php' `
  -Apply
```

## Theme Source

If you start from a customized Genesis child theme (rather than a pristine
download), treat the customized copy as the starting point and do not overwrite
it with a fresh download. Track only the child-theme customization layer in this
repo (see below) — never the whole WordPress install, core, or `genesis/`.

## How This Repo Should Track WordPress Theme / Content / Source Files

1. **Documentation source of truth** stays here under `Content/` (page drafts in
   Markdown). WordPress pages are authored from these drafts.
2. **Theme customizations** worth versioning should be tracked by copying just
   those files into this repo under a path such as
   `Content/Website/Theme/` — never the whole WordPress install, core, or
   `genesis/`.
3. The **live WAMP install** remains the runtime surface, rebuildable from
   WordPress + the tracked theme layer + tracked content. It is not mirrored
   wholesale into this repo.
4. **Initialize git** when the owner approves (GitHubWorkflow), before relying on
   version history.

## Repo-To-WAMP Mapping (template)

| Layer | Role | Where |
| --- | --- | --- |
| `{siteKey}Web` repo | Source of truth — web content and plans | `C:\Repositories\{siteKey}Web` |
| `{siteKey}` WordPress site | Runtime site | `<WAMP www>\{siteKey}` → `http://localhost/{siteKey}/` |

The repo remains source of truth; the WAMP install is the rebuildable runtime
surface (WordPress core + tracked theme layer + content authored from `Content/`).

## Dropbox Mirror Validation

Per `Standards/SourceOfTruthAndMirrorStandard.md`:

- Local Git is the source of truth; Dropbox is an **optional review mirror**, not
  a Git remote and not a backup.
- Default is **no automatic cloud copy** after edits — mirror on demand only.
- Validate a mirror pass with **MirrorToWindows**
  (`Capabilities/MirrorToWindows/WorkflowIndex.md`) after recording the target
  path in `Workspace/OwnerPreferences.md` § Connectors.
- Exclude `.git/` and any intake folders from the mirror per the standard.

## Phases

1. **Document the local working path**: confirm WAMP facts, theme source, DB, and
   the repo↔WAMP gap.
2. **Content intake**: route source material into `Content/` page drafts
   (ContentReview), customer-facing and concise.
3. **Theme tracking decision**: decide how the child-theme customization layer is
   versioned in this repo.
4. **Git + mirror**: initialize git (GitHubWorkflow) and validate the Dropbox
   mirror (MirrorToWindows).
5. **Future note only — production / host deploy**: out of scope until the owner
   approves a build pass. No production URLs assumed.

## Related

- [LowercaseTablePrefixPolicy.md](LowercaseTablePrefixPolicy.md)
- [AgentTaskBacklog.md](AgentTaskBacklog.md)
- [OpenQuestions.md](OpenQuestions.md)
- [../Standards/SourceOfTruthAndMirrorStandard.md](../Standards/SourceOfTruthAndMirrorStandard.md)
- [../Workspace/OwnerPreferences.md](../Workspace/OwnerPreferences.md)
- Database deploy method and per-site deploy profiles: see
  `Workspace/Reference/WordPressGenesisOperatingGuide/` and
  `Workspace/SiteDeployProfiles/`
