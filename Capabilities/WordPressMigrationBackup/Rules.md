# WordPressMigrationBackup Rules

## Scope

Pre-experiment backup: local database snapshot and optional web-asset mirror.

Required before:

- Owner-approved `--write` content sync passes
- Bluehost prep export
- Bulk manifest-driven rebuilds

## Commands

| Action | Script |
| --- | --- |
| DB snapshot | `Automation/DatabaseBackups/Export-LocalWordPressDatabase.ps1` |
| Table prefix repair | `Automation/DatabaseBackups/Repair-LocalWordPressTablePrefix.ps1` |
| Uploads/theme backup | `Automation/MirrorWebAssets/Mirror-WebAssetsToDropbox.ps1` |

## Related

- [Prompt.md](Prompt.md)
- [../WordPressWebsite/NewCommissionSiteChecklist.md](../WordPressWebsite/NewCommissionSiteChecklist.md) — phase 3
