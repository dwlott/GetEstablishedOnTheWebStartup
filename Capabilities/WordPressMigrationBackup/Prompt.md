<!--
IndexTitle: WordPressMigrationBackup Prompt
IndexDescription: Backup checklist and Bluehost prep routing before WordPress experiments.
IndexType: Capability
CapabilityName: WordPressMigrationBackup
CapabilityVersion: 3
IndexStatus: Active
LastEdited: 2026-07-23
-->

# WordPressMigrationBackup Prompt

Read [Rules.md](Rules.md) first.

## When to use

- Before first `ges-build.php` pass with write side effects
- Before Bluehost export / phpMyAdmin import prep
- Before theme or DB risky changes in wp-admin

## Backup checklist

```text
[ ] site-manifest.json tablePrefix matches wp-config.php
[ ] Export local DB (always pass -WpConfigPath when known):
      .\Automation\DatabaseBackups\Export-LocalWordPressDatabase.ps1 -WpConfigPath <path>
[ ] Optional: MirrorWebAssets backup to Dropbox
      .\Automation\MirrorWebAssets\Mirror-WebAssetsToDropbox.ps1 -SiteKey {siteKey}
[ ] Confirm output path under Content/Website/Database/ (gitignored .sql unless owner commits)
[ ] Owner approved proceeding to WordPressContentUpdate --write
```

## Bluehost prep checklist (optional second pass)

```text
[ ] Workspace/SiteDeployProfiles/<Site>.md filled (no passwords)
[ ] Temp MySQL DB imported from local dump
[ ] php Automation\BluehostDatabasePrep\search-replace-urls.php --from=... --to=... --db=...
[ ] Export-BluehostReadyDatabase.ps1 / prepare_bluehost_sql.py verify siteurl/home/prefix
[ ] Owner confirmed before phpMyAdmin import and DNS changes
```

Report: snapshot path, size, siteKey, date — in handoff only (do not log secrets
in OwnerPreferences).
