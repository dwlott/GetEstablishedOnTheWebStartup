# WordPressMigrationBackup Prompt

Read [Rules.md](Rules.md) first.

## When to use

- Before first `ges-build.php` pass with write side effects
- Before Bluehost export experiments
- Before theme or DB risky changes in wp-admin

## Backup checklist

```text
[ ] site-manifest.json tablePrefix matches wp-config.php
[ ] Export local DB:
      .\Automation\DatabaseBackups\Export-LocalWordPressDatabase.ps1
    (set -WpConfigPath to WAMP wp-config.php if needed)
[ ] Optional: MirrorWebAssets backup to Dropbox
      .\Automation\MirrorWebAssets\Mirror-WebAssetsToDropbox.ps1 -SiteKey {siteKey}
[ ] Confirm output path under Content/Website/Database/ (gitignored .sql unless owner commits)
[ ] Owner approved proceeding to WordPressContentUpdate --write
```

Report: snapshot path, size, siteKey, date — in handoff only (do not log secrets in OwnerPreferences).
