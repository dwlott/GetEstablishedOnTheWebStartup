<!--
IndexTitle: Agent Task Backlog
IndexDescription: Web-presence starter task queue for GetEstablishedOnTheWebStartup.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-07-24
-->

# Agent Task Backlog

Web-presence starter backlog. After adoption, **Ready Next** is Quick Startup
until the owner changes it.

## Ready Next

**Starter launch-ready refresh (2026-07-24):** SituationalAwareness write path
fixed; SiteDeployProfiles template; Bluehost migration / re-push plan;
HighAltitudeThemeMethod pointer; CPanelEmail ported from US1 learnings.
Verify with `Automation/VerifyStarterPackage.ps1 -Profile WebPresenceWordPress`.

| Task | Capability | Notes |
| --- | --- | --- |
| Copy starter to new project folder (no `.git`) | Automation | `Copy-StartupToProject.ps1 -DestinationName YourProject` |
| Run Quick Startup; capture Owner Goals | GettingStarted | Trigger: `Begin Quick Startup from AGENTS.md` |
| Configure `site-manifest.json` for new site | WordPressWebsite | Set `siteKey`, `localUrl`, `tablePrefix` |
| Fill deploy profile from `_TEMPLATE.md` | SiteDeployProfiles | Before Bluehost prep |
| Connect GitHub when owner is ready | GitHubWorkflow | SetupPrompt.md — owner must ask |

## Later

| Task | Notes |
| --- | --- |
| Review public website drafts | ContentReview |
| Draft one-page business website | OnePageWebsite |
| Plan a listing node (Google, Yelp, etc.) | WebPresenceNode |
| Local WordPress setup on WAMP | `Plans/LocalWordPressSetupPlan.md` |
| High Altitude Cap on project repo | `Plans/HighAltitudeThemeMethod.md` |
| cPanel mailbox / Thunderbird | **CPanelEmail** |
| Bluehost Path A / re-push | `Plans/WordPressMigrationCapabilityPlan.md` |
| Refresh Indexes/ after new files | ManualIndexing |

## Blocked

| Task | Blocker |
| --- | --- |
| WordPress `--write` build pass | Owner approval + DB backup |
| Production launch (DNS, CF7, analytics) | Owner build-pass approval |
| Full DB overwrite of live site | Production backup + owner build-pass |

## Related

- [Workspace/OwnerGoals.md](../Workspace/OwnerGoals.md)
- [WebsiteGoals.md](WebsiteGoals.md)
- [WordPressWebsiteCapabilityGroupPlan.md](WordPressWebsiteCapabilityGroupPlan.md)
- [WordPressMigrationCapabilityPlan.md](WordPressMigrationCapabilityPlan.md)
- [../Capabilities/WordPressWebsite/NewCommissionSiteChecklist.md](../Capabilities/WordPressWebsite/NewCommissionSiteChecklist.md)
