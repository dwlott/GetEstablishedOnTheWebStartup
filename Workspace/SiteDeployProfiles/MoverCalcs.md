<!--
IndexTitle: MoverCalcs Deploy Profile
IndexDescription: Site-specific data and database deploy defaults for movercalcs.com on Bluehost.
IndexType: Reference
IndexStatus: Draft
LastEdited: 2026-06-25
-->

# MoverCalcs Deploy Profile

Database deploy data for the MoverCalcs documentation WordPress site. Method:
[page 17](../Reference/WordPressGenesisOperatingGuide/Pages/17-PhpMyAdminDatabaseExportAndEdit.md)
([Deploy modes](../Reference/WordPressGenesisOperatingGuide/Pages/17-PhpMyAdminDatabaseExportAndEdit.md#deploy-modes-draft)).

Planning repo for content and theme tracking:
`C:\Repositories\MoverCalcsWeb` (local WAMP runtime is outside that repo).

## Site data

| Field | Value |
| --- | --- |
| Live URL | `https://movercalcs.com` (confirm before first deploy) |
| cPanel host | `wp1.bluehost.com:2083` (account `mindfxa6_`) |
| Production DB | `mindfxa6_movercalcs` |
| Production prefix | `Lr4_` |
| Local URL | `http://localhost/movercalcs/` |
| Local WAMP root | `G:\wamp64\www\movercalcs` |
| Local DB / prefix | `movercalcs` / `wp_` — align local to `Lr4_` before first deploy |
| SSH / WP-CLI available? | **TBD** (Bluehost supports WP-CLI over SSH) |
| Default deploy mode | `full` until first production push; then `standard-partial` |
| Full-DB push safe? | **TBD** — likely yes on empty production; confirm before deploy |
| Extra exclude tables | *(none yet — add if CF7/Flamingo or other live capture is enabled)* |
| Backup folder (outside Git) | **TBD** local path |
| Last deploy | (none yet) |

## Prefix alignment (required before first deploy)

Local WAMP currently uses prefix `wp_`; production uses `Lr4_`. Follow page 17
[one-time setup](../Reference/WordPressGenesisOperatingGuide/Pages/17-PhpMyAdminDatabaseExportAndEdit.md#one-time-setup-per-site)
before any import.

## Recommended first deploy

When production is empty and `Full-DB push safe? = yes`:

1. Align local prefix to `Lr4_`.
2. Production backup (even if empty).
3. [Full deploy](../Reference/WordPressGenesisOperatingGuide/Pages/17-PhpMyAdminDatabaseExportAndEdit.md#mode-full)
   from local.
4. URL replace: `http://localhost/movercalcs` → `https://movercalcs.com`.
5. Re-save Permalinks; smoke-test workbook help pages.

After go-live, set `Default deploy mode: standard-partial` and record any
**Extra exclude tables** if forms or user accounts exist on production.

## Standard partial include list (after go-live)

Example WP-CLI `--tables=` (prefix `Lr4_`):

- `Lr4_posts`
- `Lr4_postmeta`
- `Lr4_terms`
- `Lr4_term_taxonomy`
- `Lr4_term_relationships`

See page 17 for the default tricky-table exclude list.

## Notes / open items

- Repo-to-WAMP sync is not automated — content is drafted in `MoverCalcsWeb`
  under `Content/` before WordPress publish passes.
- Theme: copied GEOTW-derived Altitude Pro child at
  `G:\wamp64\www\movercalcs\wp-content\themes\altitude-pro` — file deploy is
  separate from database deploy.
- Confirm live URL and production DB state in phpMyAdmin before first push.

## Related

- [MoverCalcsWeb LocalWordPressSetupPlan](C:/Repositories/MoverCalcsWeb/Plans/LocalWordPressSetupPlan.md)
- [Site Deploy Profiles README](README.md)
