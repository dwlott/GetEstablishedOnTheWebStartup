<!--
IndexTitle: Consumer Boot Snippets
IndexDescription: Minimal templates for consumer AGENTS.md and AgentTaskBacklog.md during packaging repair.
IndexType: Capability
CapabilityName: StarterRepositoryPackage
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-10
-->

# Consumer Boot Snippets

Copy and adapt these during [WorkflowIndex.md](WorkflowIndex.md) Step 3 identity
repair. Full lists: [ConsumerRepairSpec.md](ConsumerRepairSpec.md).

Adjust RouterIndex / registry rows if **GoogleDriveLink** was trimmed at Step 0.

---

## AGENTS.md (consumer starter)

Replace host `AGENTS.md` with this structure (adapt metadata dates as needed):

```markdown
# Repository Instructions

This is a **Get Established Workspace** — a consumer starter repository for the
owner's goals, ideas, and plans. It is **not** the GetEstablished archetype
development host.

Help the owner through **Quick Startup** → `Workspace/OwnerGoals.md`, then route
work through Capabilities. Read `Standards/AgentSituationalAwareness.md` before
acting.

## Quick Start

| Situation | What to do |
| --- | --- |
| First time in this repo | Say **"Begin Quick Startup from AGENTS.md"** — agent runs Workspace Adoption Prep, then full first-session order in `Capabilities/GettingStarted/GettingStarted.md` |
| Returning with a task | Route via `Capabilities/RouterIndex.md` |
| Not sure what's going on | Read `Standards/AgentSituationalAwareness.md` |
| Want to capture an idea | Drop it in `Ideas/` |
| Ready to plan something | Move an idea into `Plans/` |

Before acting on any task: read this file, then `Standards/AgentSituationalAwareness.md`.

**Full Quick Startup session:** Workspace Adoption Prep (reset stale boot files) →
setup questions → Owner Goals → optional prior-repo path note → valuable reference
candidates → optional reference review → one routed next task → park GitHub →
soft indexing offer. See GettingStarted first-session order.

## Primary Goal Of Repository

This workspace helps the owner **capture Ideas**, turn selected Ideas into
**Plans**, and carry Plans through to **desired positive outcomes** — with
agents assisting in small, reviewable steps.

Formal chain: **Goals** → **Ideas** → **Plans** → implemented work.

**Outcomes follow Owner Goals.** Practical **online presence** (Get Established
On The Web) is one **supported outcome** when the owner wants it and shipped
Capabilities apply (GettingStarted, ContentReview, website drafts under
`Content/`). It is **not** the sole identity of every download unless
`Workspace/OwnerGoals.md` says so.

When summarizing this repo: lead with the **pipeline** (ideas → plans →
outcomes), then the owner's current goals. Web-oriented Capabilities may explain
why an agent mentions online presence — that is a supported outcome, not the
whole story.

## Starting Rule

Before making changes, read this file first.

The active local repository root is **this folder** — for example:

```text
C:\Repositories\<YourProjectName>
```

Do not assume the root is `C:\Repositories\GetEstablished`. Use the workspace path the
owner opened.

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
3. If the owner said **Begin Quick Startup from AGENTS.md** (case-insensitive) or
   wants first setup → `Capabilities/GettingStarted/GettingStarted.md` — **not**
   an app launch; never use `/run` or server-start skills.
4. Otherwise route the task: read `Capabilities/RouterIndex.md` first, confirm in
   `Capabilities/AgentCapabilityGuide.md`, then the owning Capability's
   `Rules.md` and `Prompt.md`.
5. Confirm scope with the owner when unclear.
6. Edit **local Git only** unless cloud review sync was explicitly requested.

New human users: `README.md` → `Capabilities/GettingStarted/GettingStarted.md`.

## Active Workflow Signals

| Signal | Action |
| --- | --- |
| **Begin Quick Startup from AGENTS.md** (case-insensitive) | GettingStarted → OwnerGoals → ValuableReferences → soft indexing offer |
| First setup; owner goals | `Capabilities/GettingStarted/` |
| User pastes prior handoff; who has the ball? | `Capabilities/SituationalAwareness/Rules.md` section 2 |
| Git commit, push, branch | `Capabilities/GitHubWorkflow/` |
| Review public website drafts | `Capabilities/ContentReview/` |
| Repository folders; scaffold | `Capabilities/RepositoryScaffold/` |
| Save chat to markdown | `Capabilities/ChatToMarkdown/` |
| Index new files (default) | `Capabilities/ManualIndexing/` — no scripts |
| Install Cursor or local agent | `Capabilities/LocalAgentToolSetup/` |

Avoid user phrase **`run Quick Startup`** — may trigger app-launch skills in Claude.

## Active Root Structure

| Folder | Role |
| --- | --- |
| `Capabilities/` | Repeatable workflows |
| `Standards/` | Durable rules |
| `Plans/` | Setup guides and planning |
| `Ideas/` | Captured possibilities |
| `Workspace/` | Owner goals and preferences |
| `Content/` | Publishable drafts |
| `Indexes/` | Pre-built navigation indexes |
| `Archive/` | Retired material |

## Capability Discovery (Starter Subset)

Map tasks through `Capabilities/RouterIndex.md`. See registry for the shipped list.
**Manual indexing is the default.** CodeAssistedIndexing is not shipped in this starter.

## Operating Rules

- Keep changes minimal and owner-approved.
- Do not commit or push unless the owner asks.
- Do not expand scope silently.

## Do Not Do List

- Do not treat cloud folders as Git remotes.
- Do not copy files to cloud on routine passes.
- Do not invent workflows when a Capability owns the task.
- Do not commit secrets or credentials.

## Agent Handoff

Worker handoff block fields when requested: Summary, Files Changed, Planning Files
To Review, Questions Added Or Changed, Next Recommended Task.

Post-download GitHub: `Capabilities/GitHubWorkflow/SetupPrompt.md`.
```

---

## Workspace/ValuableReferences.md (starter boot)

Copy the empty register from the archetype host
`Workspace/ValuableReferences.md` into the packaging workspace during Step 3.
Keep the Suggested / Owner-confirmed / Deprecated tiers and column headers.
Reset the register table to a single placeholder row on every repair pass.

---

## Plans/RepositoryGoals.md (consumer starter)

Replace host learning-repo goals with workspace framing. Key points:

- North star = indexed workspace for Owner Goals through Quick Startup
- Five goals: Owner Goals, Ideas, Plans/outcomes, ManualIndexing, optional web presence
- Explicit **not shipped** list: Import*, CapabilityAudit, StarterRepositoryPackage,
  RepositoryInitialize, CodeAssistedIndexing
- Related links only to whitelisted Plans files

---

## GettingStarted step 4 (consumer)

Replace Import* routing with:

```markdown
4. Ask: **Do you have a prior repository folder or archive to learn from?**
   If yes, record the path in `Workspace/OwnerPreferences.md` Import section
   only. This starter does **not** ship ImportOwnerPreferences or
   ImportCapabilities — copy files manually with owner approval, or use
   **GitHubWorkflow** when creating a fresh repo.
```

Persist environment notes to `Workspace/OwnerPreferences.md`, not `OwnerEnvironment.md`.

---

## Plans/AgentTaskBacklog.md (consumer starter)

Replace host backlog with:

```markdown
# Agent Task Backlog

Consumer starter backlog. After download, **Ready Next** is Quick Startup until
the owner changes it.

## Ready Next

| Task | Capability | Notes |
| --- | --- | --- |
| Run Quick Startup; capture Owner Goals | GettingStarted | Trigger: `Begin Quick Startup from AGENTS.md` |
| Connect GitHub when owner is ready | GitHubWorkflow | SetupPrompt.md — owner must ask |

## Later

| Task | Notes |
| --- | --- |
| Review public website drafts | ContentReview when owner has pages to review |
| Refresh Indexes/ after new files | ManualIndexing (default) |
| Add folders per growth plan | RepositoryScaffold |

## Blocked

| Task | Blocker |
| --- | --- |
| *(none)* | — |

## Related

- [Workspace/OwnerGoals.md](../Workspace/OwnerGoals.md)
- [Capabilities/GettingStarted/GettingStarted.md](../Capabilities/GettingStarted/GettingStarted.md)
```

---

## README.md (opening — consumer)

Key identity lines for root `README.md`:

- Title: **Get Established Workspace**
- Path example: `C:\Repositories\<YourProjectName>`
- First session trigger: `Begin Quick Startup from AGENTS.md`
- CTA: **Get Established** (GetEstablishedOnTheWeb.com)
- Not the GetEstablished archetype development host

---

## Related

- [ConsumerRepairSpec.md](ConsumerRepairSpec.md)
- [WorkflowIndex.md](WorkflowIndex.md)
