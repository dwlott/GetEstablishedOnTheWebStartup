<!--
IndexTitle: Repository Search Map
IndexDescription: Boot and search map for GetEstablishedOnTheWebStartup web-presence starter.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-07-06
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
Workspace/LocalWordPressBuild/site-manifest.json
```

## Key Locations

| Need | Look first |
| --- | --- |
| Public page drafts (GEOTW examples) | `Content/Website/Pages/` |
| Startup audit | `Plans/StartupRepositoryAudit-20260714.md` |
| One-page business website | `Content/OnePageBusinessWebsite/` |
| Website outcomes | `Plans/WebsiteGoals.md` |
| WordPress setup | `Plans/LocalWordPressSetupPlan.md` |
| WordPress save workflow | `Plans/WordPressSaveWorkflow.md` |
| WordPress Capability group | `Plans/WordPressWebsiteCapabilityGroupPlan.md` |
| Local build orchestrator | `Workspace/LocalWordPressBuild/ges-build.php` |
| Site configuration | `Workspace/LocalWordPressBuild/site-manifest.json` |
| Asset mirror manifest | `Automation/MirrorWebAssets/WebAssetsSites.json` |
| DB snapshot | `Automation/DatabaseBackups/Export-LocalWordPressDatabase.ps1` |
| Bluehost SQL export | `Automation/BluehostDatabasePrep/` |
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
- Commissioned content, AltitudeProOverlay / High Altitude theme recipes
- Customer-site examples (DansRepairService, MoverCalcs.com, US1Movers, …)
- Live production launch without owner build-pass approval

**Example rule:** page drafts come from building GetEstablishedOnTheWeb only.
