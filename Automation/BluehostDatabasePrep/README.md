<!--
IndexTitle: Bluehost Database Prep
IndexDescription: Export local WordPress SQL for Bluehost import — serialize-aware URL replace, prefix verify, SiteDeployProfiles.
IndexType: Automation
IndexStatus: Active
LastEdited: 2026-09-03
-->

# Bluehost Database Prep

Prepare a **local WAMP** WordPress database for **phpMyAdmin import** on Bluehost.
Capability route: [WordPressMigrationBackup](../../Capabilities/WordPressMigrationBackup/README.md).

Harmonized from MoverCalcsWeb commissioned go-live (2026-09-03).

## Scripts

| File | Role |
| --- | --- |
| [Export-BluehostReadyDatabase.ps1](Export-BluehostReadyDatabase.ps1) | Orchestrates dump → serialize-aware adapter |
| [prepare_bluehost_sql.py](prepare_bluehost_sql.py) | Rewrites SQL string literals; PHP-serialized URL rewrite; prefix case normalization; DROP TABLE validation; loopback checks |
| [search-replace-urls.php](search-replace-urls.php) | Serialize-aware replace **inside MySQL** (temp DB) before final dump |

## Export script parameters (2026-09)

| Parameter | Purpose |
| --- | --- |
| `-SiteKey` | Resolve WAMP path + deploy profile |
| `-SiteLabel` | Human label in output filename |
| `-AllowCustomOutputPath` | Opt-in non-Downloads output (default: Downloads only) |
| `-AdditionalReplacement[]` | Extra `from=to` pairs for path-specific URLs |
| `-WpConfigPath` | Override when multiple sites share a machine |

Prefix mismatch between local `wp-config` and deploy profile **blocks export**
unless `-Force`.

## Required inputs (SiteDeployProfiles)

Fill [Workspace/SiteDeployProfiles/](../../Workspace/SiteDeployProfiles/) first:

- Production DB name
- Table prefix (must match local and production `wp-config`)
- Local URL → public URL

Keep credentials out of Git. Profiles may hold DB **names** and prefixes only;
SQL dumps stay in Downloads / outside the repo.

## Lessons learned

| Lesson | Why |
| --- | --- |
| **Always pass `-SiteKey` / `-WpConfigPath` into the export** | Default export path may point at another WAMP site |
| **`prepare_bluehost_sql.py` alone is not enough** | Widgets, theme_mods, and hero HTML live in **PHP-serialized** options — use `search-replace-urls.php` on a temp database first |
| **Serialized rewrite in Python adapter** | Generalized adapter now handles common serialized URL patterns (MoverCalcsWeb hardening) |
| **Prefix case normalization** | Mixed-case prefix in dump vs production `wp-config` causes silent import failures |
| **Windows PowerShell 5.1: no `ArgumentList`** | Shared export helpers fall back to an `Arguments` string; Python launcher tries `py` then `python` |
| **Uploads + child theme: copy as-is** | After DB URLs are public, do **not** search-replace inside `uploads` or child-theme binary/CSS trees |
| **Prefix must match production `wp-config`** | Import into empty/matching-prefix DB only |

## Recommended pipeline

1. Local WordPress save / DB snapshot (optional but wise) — **WordPressSave**.
2. Dump local DB → import into temp MySQL DB.
3. `php search-replace-urls.php --from=<local> --to=<public> --db=<temp>`.
4. `mysqldump` temp DB → `prepare_bluehost_sql.py` (verify siteurl/home/prefix).
5. Owner imports `.sql` in phpMyAdmin; copies `wp-content/uploads` + child theme folders.

Preparing Bluehost SQL is **not** the same as importing or pointing DNS —
still require owner confirmation before phpMyAdmin import.

## Related

- [WordPressMigrationBackup](../../Capabilities/WordPressMigrationBackup/README.md)
- [WordPressSave](../../Capabilities/WordPressSave/README.md)
- [Workspace/SiteDeployProfiles/README.md](../../Workspace/SiteDeployProfiles/README.md)
- [Plans/CrossRepoCapabilityGapMatrix.md](../../Plans/CrossRepoCapabilityGapMatrix.md)
