<!--
IndexTitle: Get Established On The Web Startup
IndexDescription: Web-presence starter with WordPress bootstrap for new local sites.
IndexType: README
IndexStatus: Active
LastEdited: 2026-07-24
-->

# Get Established On The Web Startup

A **web-presence starter repository** for goals, ideas, plans, website content
drafts, and **local WordPress site bootstrap** — including Bluehost deploy prep,
cPanel email guidance, and a High Altitude method pointer for new commissions.

This is **not** the GetEstablishedOnTheWeb product repository. After you adopt
this folder, **this workspace** is the source of truth for your work.

## Start a new project (folder copy)

Do **not** keep the starter `.git` — that leaves `origin` pointing at
`GetEstablishedOnTheWebStartup` and blocks a clean Quick Startup.

```powershell
cd C:\Repositories\GetEstablishedOnTheWebStartup
.\Automation\Copy-StartupToProject.ps1 -DestinationName YourProjectName
```

Or Explorer-copy the folder, then delete the copied `.git` directory. Open the
new folder and say **"Begin Quick Startup from AGENTS.md"**. Connect GitHub later
via **GitHubWorkflow** (`git init` + new repo).

## First Session (already in this folder)

If you **copied** this folder to a new project name, delete `.git` in the
**new** folder first — [HowToAdoptThisStarter.md](Capabilities/GettingStarted/HowToAdoptThisStarter.md).
Then say **"Begin Quick Startup from AGENTS.md"** in your agent chat.

The agent will detach leftover starter Git if you forgot, capture Owner Goals,
and **index** the workspace. It will not stop to ask about the starter remote.

Path example after adoption:

```text
C:\Repositories\<YourWebProjectName>
```

## What Ships Here

- WebPresence Capability pack (ContentReview, OnePageWebsite, WebPresenceNode, …)
- Self-provisioning core (CapabilityHarmonize, StarterRepositoryPackage, …)
- WordPress bootstrap: `ges-build.php`, WordPress Save, MirrorWebAssets
- Bluehost prep: `Automation/BluehostDatabasePrep/` + `Workspace/SiteDeployProfiles/_TEMPLATE.md`
- **CPanelEmail** — mailboxes, forwarders, Thunderbird (Secure IMAP/SMTP)
- High Altitude **method pointer** (`Plans/HighAltitudeThemeMethod.md`) — Cap stays on project repos
- Example website pages under `Content/Website/Pages/` from building
  **GetEstablishedOnTheWeb** (not from customer sites)

## Example source rule

Website examples come from building **GetEstablishedOnTheWeb** only. Do not use
DansRepairService, MoverCalcs.com, US1Movers, or other customer websites as
templates for this starter.

## Boot

1. [AGENTS.md](AGENTS.md)
2. [Capabilities/RouterIndex.md](Capabilities/RouterIndex.md)
3. [Plans/AgentTaskBacklog.md](Plans/AgentTaskBacklog.md)
4. [Capabilities/WordPressWebsite/NewCommissionSiteChecklist.md](Capabilities/WordPressWebsite/NewCommissionSiteChecklist.md)
5. [Workspace/LocalWordPressBuild/site-manifest.json](Workspace/LocalWordPressBuild/site-manifest.json)
6. [Workspace/SiteDeployProfiles/_TEMPLATE.md](Workspace/SiteDeployProfiles/_TEMPLATE.md)

## Learn More

- [GetEstablishedOnTheWeb.com](https://GetEstablishedOnTheWeb.com)
- [Plans/WebsiteGoals.md](Plans/WebsiteGoals.md)
- [Plans/WordPressWebsiteCapabilityGroupPlan.md](Plans/WordPressWebsiteCapabilityGroupPlan.md)
- [Plans/WordPressMigrationCapabilityPlan.md](Plans/WordPressMigrationCapabilityPlan.md)
- [Plans/HighAltitudeThemeMethod.md](Plans/HighAltitudeThemeMethod.md)
