<!--
IndexTitle: Repository Instructions
IndexDescription: Agent boot for GetEstablishedOnTheWebStartup web-presence and WordPress bootstrap starter.
IndexType: Workflow
IndexStatus: Active
LastEdited: 2026-07-23
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
| First time in this repo | Say **"Begin Quick Startup from AGENTS.md"** — agent preps Workspace boot files, then follow `Capabilities/GettingStarted/GettingStarted.md` |
| Review website page examples | **ContentReview** on `Content/Website/Pages/` |
| Draft one-page business site | **OnePageWebsite** |
| Google or Yelp profile planning | **WebPresenceNode** (Google/Yelp children Planned) |
| Mirror Git repository refresh | **MirrorToWindows** — reads `Workspace/OwnerPreferences.md` |
| WordPress asset backup/restore | **MirrorWebAssets** |
| Save local WordPress to Git + Dropbox | **WordPress Save** — `Plans/WordPressSaveWorkflow.md` + `Automation/WordPressSave/` |
| Prepare SQL for Bluehost / production import | **WordPressMigrationBackup** + `Automation/BluehostDatabasePrep/` + `Workspace/SiteDeployProfiles/` |
| Create / update pages or posts | **WordPressContentUpdate** — hide Genesis title; `h1.ges-page-title`; stack **Intro Photo → Intro Hero → Intro Body → Intro Pitch** via `page-layout-manifest.php` (`intro_paragraphs` => 2) |
| Local WordPress build (owner-approved) | `Workspace/LocalWordPressBuild/ges-build.php` |
| Configure new site | Edit `site-manifest.json` + `WebAssetsSites.json` |
| New commission site bootstrap | **WordPressWebsite** → `NewCommissionSiteChecklist.md` |
| Theme CSS / High Altitude (after commission) | Promote to a project repo — **AltitudeProOverlay** is not shipped in this starter |
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
C:\Repositories\<YourWebProjectName>
```

Do not assume the root is `C:\Repositories\GetEstablishedOnTheWeb`.

When the owner references **`agents.md`**, read **`AGENTS.md`** at the repository
root (case-insensitive intent).

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
| **Begin Quick Startup from AGENTS.md** | WorkspaceAdoptionPrep (boot files, OpenQuestions, git remote) → GettingStarted → OwnerGoals → ValuableReferences |
| Review website page examples | **ContentReview** |
| Draft one-page business website | **OnePageWebsite** |
| Web listing/profile node | **WebPresenceNode** |
| WordPress save after local edits | `Plans/WordPressSaveWorkflow.md` (no `Capabilities/WordPressSave/` folder here) |
| Prepare Bluehost / production DB SQL | **WordPressMigrationBackup** + BluehostDatabasePrep |
| Create / update pages or posts | **WordPressContentUpdate** intro stack + `page-layout-manifest.php` |
| Mirror uploads/theme to Dropbox | **MirrorWebAssets** |
| Git commit, push, branch | **GitHubWorkflow** |
| Save chat to markdown | **ChatToMarkdown** |
| Index new files (default) | **ManualIndexing** |
| Package another startup copy | **StarterRepositoryPackage** — WebPresenceStartupRepairSpec → WebPoweredStartupExtensionSpec |

## Capability Discovery

Map workflow requests through `Capabilities/RouterIndex.md`. Shipped Capabilities
include WebPresence pack, self-provisioning core, MirrorWebAssets, and the
WordPress group (Active). WordPress Save is **Plans + Automation only**.
**AltitudeProOverlay** / High Altitude stay on commissioned project repos.

## Stop Conditions

- WordPress `--write` build, DNS, CF7, analytics, or public launch without
  owner build-pass approval.
- Treating this starter as the GetEstablishedOnTheWeb product repository.
- Using customer project repos as example templates (examples come from
  GetEstablishedOnTheWeb product drafts only).
- Inventing legal, pricing, licensing, insurance, ranking, or revenue claims.
- Shipping AltitudeProOverlay / High Altitude commissioned theme recipes into
  this starter (those stay on commissioned project repos).

## Related

- [Plans/WebsiteGoals.md](Plans/WebsiteGoals.md)
- [Plans/WordPressWebsiteCapabilityGroupPlan.md](Plans/WordPressWebsiteCapabilityGroupPlan.md)
- [Plans/UserSetupGuide.md](Plans/UserSetupGuide.md)
- [Plans/StartupRepositoryAudit-20260714.md](Plans/StartupRepositoryAudit-20260714.md)
- [Plans/StartupModernizationAudit-20260716.md](Plans/StartupModernizationAudit-20260716.md)
