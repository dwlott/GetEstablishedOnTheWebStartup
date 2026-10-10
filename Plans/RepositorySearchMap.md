<!--
IndexTitle: Repository Search Map
IndexDescription: Boot and search map for GetEstablishedOnTheWebStartup web-presence starter.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-10-10
-->

# Repository Search Map

**GetEstablishedOnTheWebStartup** — web-presence and WordPress bootstrap starter.

## First Search Path

```text
AGENTS.md
Standards/AgentSituationalAwareness.md
Plans/RepositorySearchMap.md
Plans/AgentTaskBacklog.md
Capabilities/RouterIndex.md
Capabilities/WordPressWebsite/NewCommissionSiteChecklist.md
Workspace/LocalWordPressBuild/site-manifest.json
Workspace/SiteDeployProfiles/_TEMPLATE.md
```

## Key Locations

| Need | Look first |
| --- | --- |
| Public page drafts (GEOTW examples) | `Content/Website/Pages/` |
| Prepare Startup adoption instructions | [StartupAdoptionReadinessWorkflow.md](../Capabilities/StarterRepositoryPackage/StartupAdoptionReadinessWorkflow.md) |
| Adopt a new project copy | `Capabilities/GettingStarted/HowToAdoptThisStarter.md` |
| Adopted project identity | `Capabilities/GettingStarted/RepositoryIdentityTemplate.md` + `Automation/Test-AdoptedRepositoryIdentity.ps1` |
| New commission checklist | `Capabilities/WordPressWebsite/NewCommissionSiteChecklist.md` |
| One-page business website | `Content/OnePageBusinessWebsite/` |
| Website outcomes | `Plans/WebsiteGoals.md` |
| WordPress setup | `Plans/LocalWordPressSetupPlan.md` |
| WampServer / MAMP install | `Capabilities/WordPressWebsite/WampServerAndMampSetup.md` |
| WAMP/MAMP full guide | `Workspace/Reference/WampServer-and-MAMP-Installation-Migration-Guide.md` |
| WordPress save workflow | `Capabilities/WordPressSave/` (pointer: `Plans/WordPressSaveWorkflow.md`) |
| Migration / Bluehost re-push | `Plans/WordPressMigrationCapabilityPlan.md` |
| High Altitude method pointer | `Plans/HighAltitudeThemeMethod.md` |
| WordPress Capability group | `Plans/WordPressWebsiteCapabilityGroupPlan.md` |
| Local build orchestrator | `Workspace/LocalWordPressBuild/ges-build.php` |
| Site configuration | `Workspace/LocalWordPressBuild/site-manifest.json` |
| Deploy profile template | `Workspace/SiteDeployProfiles/_TEMPLATE.md` |
| Asset mirror manifest | `Automation/MirrorWebAssets/WebAssetsSites.json` |
| DB snapshot | `Automation/DatabaseBackups/Export-LocalWordPressDatabase.ps1` |
| Bluehost SQL export | `Automation/BluehostDatabasePrep/` |
| cPanel email / Thunderbird | `Capabilities/CPanelEmail/` |
| WordPress mail vs DNS vs mailbox | `Plans/WordPressMailDeliveryPlan.md` |
| Genesis operating guide | `Workspace/Reference/WordPressGenesisOperatingGuide/` |
| Owner WAMP/mirror settings | `Workspace/OwnerPreferences.md` |
| Capability routing | `Capabilities/AgentCapabilityGuide.md` |

## Placement Hints

| Information type | Location |
| --- | --- |
| Reusable workflows | `Capabilities/<Name>/` |
| Planning and backlog | `Plans/` |
| Website Markdown | `Content/Website/Pages/` |
| Theme text saved from WAMP | `Content/Website/Theme/` |
| DB snapshots | `Content/Website/Database/` |
| Build scripts | `Workspace/LocalWordPressBuild/` |
| Automation scripts | `Automation/` |

## Not In This Starter

- GEOTW product-only Intake, Archive, production dry-runs
- Commissioned Cap `AltitudeProOverlay` / full High Altitude CSS (pointer plan only)
- Customer-site content examples (DansRepairService, MoverCalcs.com, US1Movers, …)
