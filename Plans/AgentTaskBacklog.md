<!--
IndexTitle: Agent Task Backlog
IndexDescription: Web-presence starter task queue for GetEstablishedOnTheWebStartup.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-07-06
-->

# Agent Task Backlog

Web-presence starter backlog. After adoption, **Ready Next** is Quick Startup
until the owner changes it.

## Ready Next

| Task | Capability | Notes |
| --- | --- | --- |
| Run Quick Startup; capture Owner Goals | GettingStarted | Trigger: `Begin Quick Startup from AGENTS.md` |
| Configure `site-manifest.json` for new site | WordPressWebsite | Set `siteKey`, `localUrl`, `tablePrefix` |
| Connect GitHub when owner is ready | GitHubWorkflow | SetupPrompt.md — owner must ask |

## Later

| Task | Notes |
| --- | --- |
| Review public website drafts | ContentReview |
| Draft one-page business website | OnePageWebsite |
| Plan a listing node (Google, Yelp, etc.) | WebPresenceNode |
| Local WordPress setup on WAMP | `Plans/LocalWordPressSetupPlan.md` |
| Refresh Indexes/ after new files | ManualIndexing |

## Blocked

| Task | Blocker |
| --- | --- |
| WordPress `--write` build pass | Owner approval + DB backup |
| Production launch (DNS, CF7, analytics) | Owner build-pass approval |

## Related

- [Workspace/OwnerGoals.md](../Workspace/OwnerGoals.md)
- [WebsiteGoals.md](WebsiteGoals.md)
- [WordPressWebsiteCapabilityGroupPlan.md](WordPressWebsiteCapabilityGroupPlan.md)
