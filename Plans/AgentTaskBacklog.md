<!--
IndexTitle: Agent Task Backlog
IndexDescription: Web-presence starter task queue for GetEstablishedOnTheWebStartup.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-10-11
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

## Adoption Readiness

Guided startup refreshed on 2026-10-11 from the reusable GEOTW source:
five-question preview, individual questions with progress labels, one-goal
minimum, saved resume checkpoint, integrated environment discovery, and
existing-site maintenance follow-up. Optional setup remains optional; the
close leads with the owner's outcome and next action. Shared source documents,
new links, diff checks, package verification, and an actual temporary project
copy passed. Real owner goal entries and protected identity/Git/preferences
were preserved. The temporary fixture was removed. These checks verify package
contents; a real human interview was not performed. No public package, commit,
or push. See [QuickStartupWalkthrough.md](../Capabilities/GettingStarted/QuickStartupWalkthrough.md).

Adoption instructions refreshed on 2026-10-10. Canonical template Git and blank
owner registers remain intact. New copies exclude Git and agent runtime
metadata. Quick Startup confirms adoption before resets, preserves resumed
project data and owner remotes, offers indexing, and verifies identity.
Package verification, all eight identity matrix scenarios, and the actual
temporary-folder copy smoke test passed. Canonical Git config and owner
registers were verified unchanged. The project's own Quick Startup follows
after copying. See [QuickStartupAdoptedIdentityCleanupPlan.md](QuickStartupAdoptedIdentityCleanupPlan.md).

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
