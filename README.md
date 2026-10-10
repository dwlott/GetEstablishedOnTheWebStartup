<!--
IndexTitle: Get Established On The Web Startup
IndexDescription: Web-presence starter with WordPress bootstrap for new local sites.
IndexType: README
IndexStatus: Active
LastEdited: 2026-10-10
-->

# Get Established On The Web Startup

A **web-presence starter repository** for goals, ideas, plans, website content
drafts, and **local WordPress site bootstrap** — including Bluehost deploy prep,
cPanel email guidance, and a High Altitude method pointer for new commissions.

This is **not** the GetEstablishedOnTheWeb product repository. After you adopt
this folder, **this workspace** is the source of truth for your work.


## Start A New Project

Choose a new project name and purpose, then copy without inherited Git:

```powershell
& "C:\Repositories\GetEstablishedOnTheWebStartup\Automation\Copy-StartupToProject.ps1" -DestinationName "YourProjectName"
```

Add `-WhatIf` to preview. The script excludes `.git`, `.cursor`, and `.claude`
and refuses an existing destination. Preserve existing repositories through a
reviewed import instead of copying over them. The canonical Startup remains
the template; do not remove its Git metadata or perform adoption resets there.

Open the **new project folder** in Codex, Cursor, Claude Code, or another agent:

```text
This is my new project copied from GetEstablishedOnTheWebStartup.
Begin Quick Startup from AGENTS.md. This is not an app launch.
```

The agent confirms adoption before clearing stale template setup, captures
your goals and preferences, offers indexing, and verifies the project's
identity record. A folder without Git is valid; connect your own GitHub repo
later through **GitHubWorkflow** when you ask. Existing project goals and the
project's own remote are preserved when resuming.

Full adoption steps: [HowToAdoptThisStarter.md](Capabilities/GettingStarted/HowToAdoptThisStarter.md).
WordPress setup follows only when your goals call for it, using
[NewCommissionSiteChecklist.md](Capabilities/WordPressWebsite/NewCommissionSiteChecklist.md).

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
