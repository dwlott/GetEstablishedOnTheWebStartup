<!--
IndexTitle: Site Deploy Profiles
IndexDescription: Template for per-site WordPress database deploy data (host, DB name, table prefix, URLs).
IndexType: Reference
IndexStatus: Active
LastEdited: 2026-07-06
-->

# Site Deploy Profiles

**Data** for the WordPress database deploy workflow. The reusable **method** lives
in [../Reference/WordPressGenesisOperatingGuide/Pages/17-PhpMyAdminDatabaseExportAndEdit.md](../Reference/WordPressGenesisOperatingGuide/Pages/17-PhpMyAdminDatabaseExportAndEdit.md)
(Update production from local). One method, one profile per site.

Create one `<Site>.md` profile per site you deploy, using the fields below.

## Sensitivity

- Table prefixes and database names are **not secrets**, but they are
  security-hardening details. Keep this repository **private** if you record them.
- **Never** add DB passwords, `wp-config.php`, or `.sql` dumps to Git. Store dumps
  in a local backup folder outside the repo.

## Profile fields (template)

Each `<Site>.md` profile should carry:

| Field | Notes |
| --- | --- |
| Live URL | e.g. `https://your-site.example` |
| cPanel host | your host's cPanel URL |
| Production DB | your production database name |
| Production prefix | hardened, per site |
| Local URL | e.g. `http://localhost/yoursite` |
| Local WAMP root | `C:\wamp\www\...` or `G:\wamp64\www\...` |
| Local DB / prefix | local values |
| SSH / WP-CLI available? | yes/no per account |
| Default deploy mode | `full` \| `standard-partial` \| `custom` — see [Deploy modes](../Reference/WordPressGenesisOperatingGuide/Pages/17-PhpMyAdminDatabaseExportAndEdit.md#deploy-modes-draft) |
| Full-DB push safe? | yes if no live-generated data |
| Extra exclude tables | plugin/live-data tables beyond the default tricky list on page 17 |
| Backup folder (outside Git) | local path |
| Last deploy | date + mode used |

## Read-only guardrail

Mark any site you must not deploy over as **read-only** in its profile. Do not
deploy over it unless the owner explicitly lifts that guardrail.
