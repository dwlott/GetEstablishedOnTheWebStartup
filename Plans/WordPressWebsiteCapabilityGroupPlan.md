<!--
IndexTitle: WordPress Website Capability Group Plan
IndexDescription: Starter-safe WordPress Capability group — parent router and child workflows for local site bootstrap.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-07-07
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
NewCommissionSiteChecklist (WordPressWebsite)
  → site-manifest.json configured
  → LocalWordPressSetupPlan (WAMP install)
  → Replace GEOTW showcase manifests with owner site map
  → MirrorWebAssets restore (optional)
  → WordPressMigrationBackup (before --write)
  → ges-build.php --only= (starter script set)
  → WordPress Save (inverse capture)
  → BluehostDatabasePrep (when migrating)
```

## Commission site vs product showcase

| Profile | Manifests | Build |
| --- | --- | --- |
| **Commission site** (Dan's Repair, etc.) | Owner pages/nav; trim GEOTW examples | `ges-build.php --only=ges-theme-css-sync,ges-content-setup,ges-nav-menu-sync` |
| **GEOTW product showcase** | Use product repo `GetEstablishedOnTheWeb`, not this starter | Full geotw/ges product sync pack |

Checklist: [Capabilities/WordPressWebsite/NewCommissionSiteChecklist.md](../Capabilities/WordPressWebsite/NewCommissionSiteChecklist.md)

## Starter scripts on disk

```text
ges-theme-css-sync.php
ges-content-setup.php
ges-front-page-sync.php
ges-nav-menu-sync.php
```

Product-only steps referenced by full `ges-build.php` (catalog, offer hubs, messaging)
are **not shipped** in this starter — always use `--only`.

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
