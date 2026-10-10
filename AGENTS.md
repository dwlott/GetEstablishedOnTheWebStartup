<!--
IndexTitle: Repository Instructions
IndexDescription: Agent boot for GetEstablishedOnTheWebStartup web-presence and WordPress bootstrap starter.
IndexType: Workflow
IndexStatus: Active
LastEdited: 2026-10-10
-->

# Repository Instructions

This is a **Get Established On The Web Startup** repository — a web-presence
starter for goals, ideas, plans, website content drafts, and local WordPress
site bootstrap. It is **not** the GetEstablishedOnTheWeb product repository.

Help the owner through **Quick Startup** → `Workspace/OwnerGoals.md`, then route
work through Capabilities. Read `Standards/AgentSituationalAwareness.md` before
acting.

## Quick Start

| Situation | What to do |
| --- | --- |
| First session in an adopted copy | Confirm this is your new project copied from Startup, then say **"Begin Quick Startup from AGENTS.md"**. Follow [HowToAdoptThisStarter.md](Capabilities/GettingStarted/HowToAdoptThisStarter.md); classify the root before resets or Git detach. |
| Start a **new** project from this starter | `Automation/Copy-StartupToProject.ps1 -DestinationName YourProject` (no `.git`) — or Explorer copy then **delete `.git`** — then Quick Startup in the new folder |
| Review website page examples | **ContentReview** on `Content/Website/Pages/` |
| Draft one-page business site | **OnePageWebsite** |
| Google or Yelp profile planning | **WebPresenceNode** (Google/Yelp children Planned) |
| New commission site bootstrap | **WordPressWebsite** → `NewCommissionSiteChecklist.md` |
| Configure new site | Edit `site-manifest.json` + `WebAssetsSites.json` |
| Site deploy profile (Bluehost fields) | Copy `Workspace/SiteDeployProfiles/_TEMPLATE.md` → `{SiteKey}.md` |
| Bluehost SQL prep (not go-live) | `Automation/BluehostDatabasePrep/` + deploy profile |
| Production push / re-push notes | `Plans/WordPressMigrationCapabilityPlan.md` (owner-gated) |
| cPanel mailbox / forwarder / Thunderbird | **CPanelEmail** |
| High Altitude theme (after commission) | `Plans/HighAltitudeThemeMethod.md` — promote **AltitudeProOverlay** on the **project** repo (not shipped here) |
| Mirror Git repository refresh | **MirrorToWindows** — reads `Workspace/OwnerPreferences.md` |
| WordPress asset backup/restore | **MirrorWebAssets** |
| Install WampServer (Windows) or MAMP (macOS) *(optional offer)* | **WordPressWebsite** → [WampServerAndMampSetup.md](Capabilities/WordPressWebsite/WampServerAndMampSetup.md) |
| Save local WordPress to Git + Dropbox | **WordPressSave** |
| Prepare SQL for Bluehost / production import | **WordPressMigrationBackup** + `Automation/BluehostDatabasePrep/` + `Workspace/SiteDeployProfiles/` |
| Create / update pages or posts | **WordPressContentUpdate** — hide Genesis title; `h1.ges-page-title`; stack **Intro Photo → Intro Hero → Intro Body → Intro Pitch** via `page-layout-manifest.php` (`intro_paragraphs` => 2) |
| Local WordPress build (owner-approved) | `Workspace/LocalWordPressBuild/ges-build.php` |
| Git status, commit, push | **GitHubWorkflow** (owner must ask for commit/push) |
| Not sure what's going on | **SituationalAwareness** Rules |

Before acting: read this file, then `Standards/AgentSituationalAwareness.md`.

## Primary Goal Of Repository

Help the owner **capture Ideas**, turn selected Ideas into **Plans**, and carry
Plans through to **desired positive outcomes** — with agents assisting in small,
reviewable steps.

**Web presence** is a primary supported outcome: example page drafts under
`Content/Website/Pages/`, one-page business website drafts, listing guides,
and local WordPress bootstrap when the owner approves a build pass.

Formal chain: **Goals** → **Ideas** → **Plans** → implemented work.

## Starting Rule

The active local repository root is **this folder** — for example:

```text
C:\Repositories\GetEstablishedOnTheWebStartup
```

Or after copy:

```text
C:\Repositories\<YourWebProjectName>
```

Do not assume the root is `C:\Repositories\GetEstablishedOnTheWeb` or
`C:\Repositories\GetEstablished`.

When the owner references **`agents.md`**, read **`AGENTS.md`** at the repository
root (case-insensitive intent).

## Adoption Boundary

`C:\Repositories\GetEstablishedOnTheWebStartup` is the canonical template.
Preserve its Startup identity, owner scaffolds, and Git metadata. The product
repository and established projects also retain their identity and owner data.
Run adoption resets or Git detach only in a new copy identified by the owner,
or with an existing `adopted-project` identity record. Folder names and stale
remotes alone do not authorize changes. See
`Capabilities/GettingStarted/WorkspaceAdoptionPrep.md`.

Every confirmed adopted project completes `Workspace/RepositoryIdentity.md`
and runs `Automation/Test-AdoptedRepositoryIdentity.ps1` before startup closes.

## Source Of Truth

| Rank | Surface | Role |
| --- | --- | --- |
| 1 | Local Git repository | Source of truth |
| 2 | GitHub | Backup and history |
| 3 | Dropbox or Google Drive | Optional review — **not connected to Git** |

**Cursor (repo open):** edit local Git only. **Default: no cloud copy** after edits.

## First 10 Minutes (Agent Startup)

On every new pass, before editing:

1. Read this file (`AGENTS.md`).
2. Read `Standards/AgentSituationalAwareness.md`.
3. Read `Plans/RepositorySearchMap.md` for placement.
4. If resuming work, read `Plans/AgentTaskBacklog.md` for **Ready Next**.
5. Route the task: read `Capabilities/RouterIndex.md` first,
   confirm in `Capabilities/AgentCapabilityGuide.md`,
   then the owning Capability's `Rules.md` and `Prompt.md`.
6. Confirm scope with the owner when unclear.
7. Edit **local Git only** unless cloud review sync was explicitly requested.

## Active Workflow Signals

| Signal | Action |
| --- | --- |
| **Begin Quick Startup from AGENTS.md** | Classify root → adopted-only WorkspaceAdoptionPrep → Owner Goals + preferences + references → optional indexing → adopted identity record + verification |
| Review website page examples | **ContentReview** |
| Draft one-page business website | **OnePageWebsite** |
| Web listing/profile node | **WebPresenceNode** |
| New commission / site-manifest | **WordPressWebsite** / NewCommissionSiteChecklist |
| Bluehost SQL / deploy profile | `SiteDeployProfiles` + `BluehostDatabasePrep` |
| cPanel email / Thunderbird | **CPanelEmail** |
| High Altitude theme method | `Plans/HighAltitudeThemeMethod.md` (Cap on project repo) |
| WordPress save after local edits | **WordPressSave** |
| Prepare Bluehost / production DB SQL | **WordPressMigrationBackup** + BluehostDatabasePrep |
| Install / migrate WampServer or MAMP *(optional)* | **WordPressWebsite** → WampServerAndMampSetup |
| Create / update pages or posts | **WordPressContentUpdate** intro stack + `page-layout-manifest.php` |
| Mirror uploads/theme to Dropbox | **MirrorWebAssets** |
| Git commit, push, branch | **GitHubWorkflow** |
| Save chat to markdown | **ChatToMarkdown** |
| Index new files (default) | **ManualIndexing** |
| Package another startup copy | **StarterRepositoryPackage** — WebPresenceStartupRepairSpec → WebPoweredStartupExtensionSpec |

## Capability Discovery

Map workflow requests through `Capabilities/RouterIndex.md`. Shipped Capabilities
include WebPresence pack, self-provisioning core, MirrorWebAssets, CPanelEmail,
and the WordPress group (Active, including **WordPressSave**). **AltitudeProOverlay** Cap stays on commissioned project repos — see
`Plans/HighAltitudeThemeMethod.md`.

## Stop Conditions

- WordPress `--write` build, DNS, CF7, analytics, or public launch without
  owner build-pass approval.
- Treating this starter as the GetEstablishedOnTheWeb product repository.
- Using customer project repos as example templates (examples come from
  GetEstablishedOnTheWeb product drafts only).
- Inventing legal, pricing, licensing, insurance, ranking, or revenue claims.
- Shipping AltitudeProOverlay / full High Altitude CSS recipes into this starter.
- Full production DB overwrite without a production backup when the live site
  already has data.

## Related

- [Plans/WebsiteGoals.md](Plans/WebsiteGoals.md)
- [Plans/WordPressWebsiteCapabilityGroupPlan.md](Plans/WordPressWebsiteCapabilityGroupPlan.md)
- [Plans/WordPressMigrationCapabilityPlan.md](Plans/WordPressMigrationCapabilityPlan.md)
- [Plans/HighAltitudeThemeMethod.md](Plans/HighAltitudeThemeMethod.md)
- [Plans/UserSetupGuide.md](Plans/UserSetupGuide.md)
- [Capabilities/WordPressWebsite/NewCommissionSiteChecklist.md](Capabilities/WordPressWebsite/NewCommissionSiteChecklist.md)
