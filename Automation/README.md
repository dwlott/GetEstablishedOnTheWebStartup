# Automation

Starter WordPress and repository automation:

| Folder | Role |
| --- | --- |
| [IndexHealthCheck/](IndexHealthCheck/) | Optional index health script |
| [DatabaseBackups/](DatabaseBackups/) | Local WAMP WordPress database snapshot export |
| [MirrorWebAssets/](MirrorWebAssets/) | Uploads + theme ↔ Dropbox backup/restore |
| [WordPressSave/](WordPressSave/) | Save WAMP DB + theme text to Git + Dropbox |
| [BluehostDatabasePrep/](BluehostDatabasePrep/) | Production-ready SQL export |
| [LocalWordPress/](LocalWordPress/) | Shared WAMP path helpers |
| [VerifyStarterPackage.ps1](VerifyStarterPackage.ps1) | Packaging verification (`-Profile WebPresenceWordPress`) |

**Repository mirror:** **MirrorToWindows** (docs-only). See `Capabilities/MirrorToWindows/`.

**Local WordPress build:** `Workspace/LocalWordPressBuild/ges-build.php` — owner-approved `--write` only.

Plans: [WordPressSaveWorkflow.md](../Plans/WordPressSaveWorkflow.md), [LocalWordPressSetupPlan.md](../Plans/LocalWordPressSetupPlan.md).
