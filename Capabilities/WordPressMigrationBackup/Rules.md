<!--
IndexTitle: WordPressMigrationBackup Rules
IndexDescription: Backup and Bluehost-prep guardrails before WordPress experiments.
IndexType: Capability
CapabilityName: WordPressMigrationBackup
CapabilityVersion: 4
IndexStatus: Active
LastEdited: 2026-09-03
-->

# WordPressMigrationBackup Rules

## Scope

Pre-experiment backup: local database snapshot, optional web-asset mirror, and
optional Bluehost-ready SQL prep.

Required before:

- Owner-approved `--write` content sync passes
- Bluehost prep export / phpMyAdmin import prep
- Bulk manifest-driven rebuilds

## Commands

| Action | Script |
| --- | --- |
| DB snapshot | `Automation/DatabaseBackups/Export-LocalWordPressDatabase.ps1` (pass `-WpConfigPath`) |
| Table prefix repair | `Automation/DatabaseBackups/Repair-LocalWordPressTablePrefix.ps1` |
| Uploads/theme backup | `Automation/MirrorWebAssets/Mirror-WebAssetsToDropbox.ps1` |
| Bluehost-ready export | `Automation/BluehostDatabasePrep/Export-BluehostReadyDatabase.ps1` |
| Serialize-aware URL replace | `Automation/BluehostDatabasePrep/search-replace-urls.php` (temp DB) |
| Python SQL adapter | `Automation/BluehostDatabasePrep/prepare_bluehost_sql.py` |

## Bluehost prep rules

- Fill `Workspace/SiteDeployProfiles/<Site>.md` before export (DB name, prefix, URLs).
- Never commit DB passwords, `wp-config.php`, or `.sql` dumps.
- Use serialize-aware replace on a **temp** database before `prepare_bluehost_sql.py`.
- Pass `-SiteKey` (or `-WpConfigPath`) — never rely on implicit default site paths.
- Prefix in deploy profile must match local `wp-config`; export blocks on mismatch.
- Default output: **Downloads only** unless owner passes `-AllowCustomOutputPath`.
- Optional `-AdditionalReplacement[]` for path-specific URL pairs.
- After public URLs are in the DB, copy uploads/theme trees as-is — do not
  search-replace inside those folders.
- Preparing SQL ≠ launching the site.

## Related

- [Prompt.md](Prompt.md)
- [Automation/BluehostDatabasePrep/README.md](../../Automation/BluehostDatabasePrep/README.md)
- [../WordPressWebsite/NewCommissionSiteChecklist.md](../WordPressWebsite/NewCommissionSiteChecklist.md) — phase 3
