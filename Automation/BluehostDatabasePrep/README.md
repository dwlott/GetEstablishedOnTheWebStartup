<!--
IndexTitle: Bluehost Database Prep
IndexDescription: Export local WordPress SQL for Bluehost import — serialize-aware URL replace, prefix verify, SiteDeployProfiles.
IndexType: Automation
IndexStatus: Active
LastEdited: 2026-07-23
-->

# Bluehost Database Prep

Prepare a **local WAMP** WordPress database for **phpMyAdmin import** on Bluehost.
Capability route: [WordPressMigrationBackup](../../Capabilities/WordPressMigrationBackup/README.md).

## Scripts

| File | Role |
| --- | --- |
| [Export-BluehostReadyDatabase.ps1](Export-BluehostReadyDatabase.ps1) | Orchestrates dump → adapter (pass `-WpConfigPath` via `-SiteKey`) |
| [prepare_bluehost_sql.py](prepare_bluehost_sql.py) | Rewrites SQL string literals; **refuses** serialized local URLs |
| [search-replace-urls.php](search-replace-urls.php) | Serialize-aware replace **inside MySQL** (temp DB) before final dump |

## Required inputs (SiteDeployProfiles)

Fill [Workspace/SiteDeployProfiles/](../../Workspace/SiteDeployProfiles/) first:

- Production DB name
- Table prefix (must match local and production `wp-config`)
- Local URL → public URL

Keep credentials out of Git. Profiles may hold DB **names** and prefixes only;
SQL dumps stay in Downloads / outside the repo.

## Lessons learned (promote from commissioned go-live)

| Lesson | Why |
| --- | --- |
| **Always pass `-WpConfigPath` / `-SiteKey` into the export** | Default export path may point at another WAMP site |
| **`prepare_bluehost_sql.py` alone is not enough** | Widgets, theme_mods, and hero HTML live in **PHP-serialized** options — naive replace throws; use `search-replace-urls.php` on a temp database first |
| **Windows PowerShell 5.1: no `ArgumentList`** | Shared export helpers must fall back to an `Arguments` string |
| **Uploads + child theme: copy as-is** | After DB URLs are public, do **not** search-replace inside `uploads` or child-theme binary/CSS trees |
| **Prefix must match production `wp-config`** | Import into empty/matching-prefix DB only |

## Recommended pipeline

1. Local WordPress save / DB snapshot (optional but wise).
2. Dump local DB → import into temp MySQL DB.
3. `php search-replace-urls.php --from=<local> --to=<public> --db=<temp>`.
4. `mysqldump` temp DB → `prepare_bluehost_sql.py` (verify siteurl/home/prefix).
5. Owner imports `.sql` in phpMyAdmin; copies `wp-content/uploads` + child theme folders.

Preparing Bluehost SQL is **not** the same as importing or pointing DNS —
still require owner confirmation before phpMyAdmin import.

## Related

- [WordPressMigrationBackup](../../Capabilities/WordPressMigrationBackup/README.md)
- [Workspace/SiteDeployProfiles/README.md](../../Workspace/SiteDeployProfiles/README.md)
- [Plans/CrossRepoCapabilityGapMatrix.md](../../Plans/CrossRepoCapabilityGapMatrix.md)
