<!--
IndexTitle: WordPress Website Capability Group Plan
IndexDescription: Starter-safe WordPress Capability group — parent router and child workflows for local site bootstrap.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-07-06
-->

# WordPress Website Capability Group Plan

## Purpose

Define the **Active** WordPress Capability group in GetEstablishedOnTheWebStartup.
GEOTW product repo keeps these as Draft until separately promoted.

## Group Members

| Capability | Role |
| --- | --- |
| `WordPressWebsite` | Parent router + safety rules |
| `WordPressContentUpdate` | Markdown/manifest sync gate (`ges-build.php`) |
| `StudioPressGenesisChildTheme` | Altitude child-theme overlay rules |
| `WordPressMigrationBackup` | Pre-experiment DB + asset backup |
| `MirrorWebAssets` | Uploads/theme ↔ Dropbox (large assets) |

## Workflow Chain

```text
site-manifest.json configured
  → LocalWordPressSetupPlan (WAMP install)
  → MirrorWebAssets restore (optional)
  → WordPressMigrationBackup (before --write)
  → ges-build.php (dry-run, then --write when approved)
  → WordPress Save (inverse capture)
  → BluehostDatabasePrep (when migrating)
```

## Owner Configuration

Edit `Workspace/LocalWordPressBuild/site-manifest.json`:

- `siteKey`, `localUrl`, `productionUrl`, `tablePrefix`
- `wampWwwRoot`, `dropboxWebsPath`

Edit `Automation/MirrorWebAssets/WebAssetsSites.json` to match.

## Stop Conditions

- No `--write` without owner approval + DB backup.
- No production launch without separate owner build-pass.

## Related

- [WebPresenceCapabilityPack.md](WebPresenceCapabilityPack.md)
- [WebPoweredStartupExtensionSpec.md](../Capabilities/StarterRepositoryPackage/WebPoweredStartupExtensionSpec.md)
