<!--
IndexTitle: WebPresence Boot Snippets
IndexDescription: Minimal templates for GetEstablishedOnTheWebStartup AGENTS.md and AgentTaskBacklog.md during packaging repair.
IndexType: Capability
CapabilityName: StarterRepositoryPackage
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-07-06
-->

# WebPresence Boot Snippets

Copy and adapt these during [WorkflowIndex.md](WorkflowIndex.md) Step 3 identity
repair when the starter profile is **`GetEstablishedOnTheWebStartup`**.

Full lists: [WebPresenceStartupRepairSpec.md](WebPresenceStartupRepairSpec.md).

For WordPress extension passes, also read
[WebPoweredStartupExtensionSpec.md](WebPoweredStartupExtensionSpec.md).

---

## AGENTS.md (WebPresence starter)

Replace product `AGENTS.md` with this structure (adapt metadata dates as needed):

```markdown
# Repository Instructions

This is a **Get Established On The Web Startup** repository — a web-presence
starter for goals, ideas, plans, website content drafts, and local WordPress
site bootstrap. It is **not** the GetEstablishedOnTheWeb product repository.

Help the owner through **Quick Startup** (Workspace Adoption Prep →
`Workspace/OwnerGoals.md`), then route work through Capabilities. Read `Standards/AgentSituationalAwareness.md` before
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
| Save local WordPress to Git + Dropbox | **WordPress Save** — `Plans/WordPressSaveWorkflow.md` |
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
C:\Repositories\<YourWebProjectName>
```

Do not assume the root is `C:\Repositories\GetEstablishedOnTheWeb`.

## Source Of Truth

| Rank | Surface | Role |
| --- | --- | --- |
| 1 | Local Git repository | Source of truth |
| 2 | GitHub | Backup and history |
| 3 | Dropbox or Google Drive | Optional review — **not connected to Git** |

**Cursor (repo open):** edit local Git only. **Default: no cloud copy** after edits.

## Stop Conditions

- WordPress install, DNS, contact forms, analytics, or public launch without
  owner build-pass approval.
- Treating this starter as the GetEstablishedOnTheWeb product repository.
- Inventing legal, pricing, licensing, insurance, ranking, or revenue claims.
```

---

## Plans/AgentTaskBacklog.md (WebPresence starter)

```markdown
# Agent Task Backlog

Web-presence starter backlog. After download, **Ready Next** is Quick Startup
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
| Refresh Indexes/ after new files | ManualIndexing |
| Local WordPress setup on WAMP | `Plans/LocalWordPressSetupPlan.md` |

## Blocked

| Task | Blocker |
| --- | --- |
| WordPress `--write` build pass | Owner approval + DB backup |
| Production launch | Owner build-pass approval |

## Related

- [Workspace/OwnerGoals.md](../Workspace/OwnerGoals.md)
- [Plans/WebsiteGoals.md](WebsiteGoals.md)
- [Capabilities/GettingStarted/GettingStarted.md](../Capabilities/GettingStarted/GettingStarted.md)
```

---

## README.md (opening — WebPresence starter)

Key identity lines for root `README.md`:

- Title: **Get Established On The Web Startup**
- Path example: `C:\Repositories\<YourWebProjectName>`
- First session trigger: `Begin Quick Startup from AGENTS.md`
- CTA: **Get Established On The Web** (GetEstablishedOnTheWeb.com)
- Not the GetEstablishedOnTheWeb product repository

---

## Workspace/OwnerPreferences.md (starter template sections)

Include these sections (reset private paths on every repair pass):

```markdown
## Local WordPress (WAMP)

| Setting | Value |
| --- | --- |
| `WAMP_WWW_ROOT` | *(owner sets — e.g. `C:\wamp64\www`)* |
| Site folder | `www\{siteKey}` |
| Local URL | `http://localhost/{siteKey}` |

## WordPress asset mirror (Dropbox)

| Setting | Value |
| --- | --- |
| Dropbox Webs root | `Dropbox\Webs\{siteKey}` |
| Backup command | `.\Automation\MirrorWebAssets\Mirror-WebAssetsToDropbox.ps1` |
| Restore command | `.\Automation\MirrorWebAssets\Restore-WebAssetsFromDropbox.ps1` |

## WordPress Save

```powershell
.\Automation\WordPressSave\Save-LocalWordPress.ps1
```
```

---

## Related

- [WebPresenceStartupRepairSpec.md](WebPresenceStartupRepairSpec.md)
- [WebPoweredStartupExtensionSpec.md](WebPoweredStartupExtensionSpec.md)
- [ConsumerBootSnippets.md](ConsumerBootSnippets.md)
