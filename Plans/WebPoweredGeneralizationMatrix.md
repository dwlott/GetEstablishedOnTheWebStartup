<!--
IndexTitle: Web-Powered Generalization Matrix
IndexDescription: Copy vs exclude matrix when generalizing MoverCalcsWeb WordPress ops into GetEstablishedOnTheWebStartup.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-07-06
-->

# Web-Powered Generalization Matrix

Use this matrix when applying [WebPoweredStartupExtensionSpec.md](../Capabilities/StarterRepositoryPackage/WebPoweredStartupExtensionSpec.md)
to the startup workspace. **Do not edit** MoverCalcsWeb or GEOTW product paths.

## Copy and generalize (from MoverCalcsWeb)

| Source path | Startup target | Generalization rule |
| --- | --- | --- |
| `Capabilities/MirrorWebAssets/` | Same | Replace `movercalcs` with `{siteKey}` in docs |
| `Automation/MirrorWebAssets/` | Same | Template `WebAssetsSites.json` |
| `Automation/WordPressSave/` | Same | Template `ThemeTrackManifest.json` |
| `Automation/DatabaseBackups/` | Same | Prefer GEOTW script interface; site-agnostic |
| `Automation/BluehostDatabasePrep/` | Same | `{localUrl}` → `{productionUrl}` placeholders |
| `Automation/LocalWordPress/WampPaths.ps1` | Same | No hardcoded paths |
| `Plans/WordPressSaveWorkflow.md` | Same | `{siteKey}` placeholders |
| `Plans/LocalWordPressSetupPlan.md` | Same | WAMP mapping template |

## Copy and generalize (from GEOTW product)

| Source path | Startup target | Generalization rule |
| --- | --- | --- |
| `Workspace/LocalWordPressBuild/geotw-*.php` | `ges-*.php` | Rename prefix; strip GEOTW-specific slugs |
| `Workspace/LocalWordPressBuild/page-layout-manifest.php` | Same | Minimal starter slugs |
| `Automation/DatabaseBackups/Export-LocalWordPressDatabase.ps1` | Same | Canonical DB export |
| `Content/Website/Database/README.md` | Same | Template only — no product snapshot |
| `Workspace/Reference/WordPressGenesisOperatingGuide/` | Curated subset | Setup, query args, page interiors pages only |
| `Plans/WebPresenceCapabilityPack.md` | Same | Promote WordPress group to Active in startup |

## Exclude (site-specific — never copy)

| Path | Reason |
| --- | --- |
| `Capabilities/MoverItemImageGeneration/` | MoverCalcs inventory specialty |
| `Automation/MoverItemImageGeneration/` | MoverCalcs inventory specialty |
| `Content/Media/MoverCalcsItems/` | Commissioned media |
| `Content/Website/Pages/MoverCalcs/` | Commissioned content |
| `mc-*` scripts and manifests | MoverCalcs site key |
| `Content/Website/Database/movercalcs-local.sql.gz` | Live site snapshot |
| `Automation/AgentReplies/` | Private pass history |
| Bluehost `movercalcs.com` URL literals | Site-specific production URL |

## Exclude (product-only — stripped in base packaging)

| Path | Reason |
| --- | --- |
| `Workspace/Intake/` | Product reference bulk |
| `Workspace/Legacy/` | Product private material |
| `Content/Website/Assets/` (full tree) | Large product assets |
| Production dry-run paste previews | Not starter-safe |

## Related

- [WebPoweredStartupExtensionSpec.md](../Capabilities/StarterRepositoryPackage/WebPoweredStartupExtensionSpec.md)
- [WebPresenceStartupRepairSpec.md](../Capabilities/StarterRepositoryPackage/WebPresenceStartupRepairSpec.md)
