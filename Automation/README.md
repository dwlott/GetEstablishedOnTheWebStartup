# Automation

Starter WordPress and repository automation:

| Folder | Role |
| --- | --- |
| [IndexHealthCheck/](IndexHealthCheck/) | Optional index health script |
| [DatabaseBackups/](DatabaseBackups/) | Local WAMP WordPress database snapshot export |
| [MirrorWebAssets/](MirrorWebAssets/) | Uploads + theme ↔ Dropbox backup/restore |
| [WordPressSave/](WordPressSave/) | Save WAMP DB + theme text to Git + Dropbox |
| [BluehostDatabasePrep/](BluehostDatabasePrep/) | Production-ready SQL export ([README](BluehostDatabasePrep/README.md)) |
| [LocalWordPress/](LocalWordPress/) | Shared WAMP path helpers |
| [VerifyStarterPackage.ps1](VerifyStarterPackage.ps1) | Packaging verification (`-Profile WebPresenceWordPress`) |
| [Copy-StartupToProject.ps1](Copy-StartupToProject.ps1) | Copy this starter to a new project folder **without** `.git` |

**Repository mirror:** **MirrorToWindows** (docs-only). See `Capabilities/MirrorToWindows/`.

**Local WordPress build:** `Workspace/LocalWordPressBuild/ges-build.php` — owner-approved `--write` only.

**Deploy profile:** copy `Workspace/SiteDeployProfiles/_TEMPLATE.md` → `{SiteKey}.md`
before Bluehost prep. See [WordPressMigrationCapabilityPlan.md](../Plans/WordPressMigrationCapabilityPlan.md).

Plans: [WordPressSaveWorkflow.md](../Plans/WordPressSaveWorkflow.md), [LocalWordPressSetupPlan.md](../Plans/LocalWordPressSetupPlan.md), [HighAltitudeThemeMethod.md](../Plans/HighAltitudeThemeMethod.md).
