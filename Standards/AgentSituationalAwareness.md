<!--
IndexTitle: Agent Situational Awareness
IndexDescription: Runtime-aware rules so agents know when local repo access makes cloud-assisted handoffs unnecessary (Cursor) versus required (ChatGPT planning).
IndexType: Standard
IndexStatus: Active
LastEdited: 2026-06-09
-->

# Agent Situational Awareness

## Purpose

Prevent agents from applying the wrong workflow layer for the tool the user is
using. Many repository files were written when **ChatGPT** planned work and
**Codex** implemented locally while ChatGPT read a **Google Drive mirror** of
the repo. That pattern is still valid for that stack. It is **not** the default
when both planner and worker run in **Cursor** with the repository open.

## User Device Vs Agent Runtime

Two separate awareness layers apply. Do not conflate them.

| Layer | Covers | Primary file |
| --- | --- | --- |
| **User device / operating profile** | Phone, tablet, Chromebook, browser-only, local workstation, Git/GitHub availability, recommended operating profile | [CloudOnlyPlanningAndMeasurementDevicePlan.md](../Plans/CloudOnlyPlanningAndMeasurementDevicePlan.md) |
| **Agent runtime profile** | Cursor unified vs ChatGPT+worker vs Claude Code worker; when cloud review handoffs apply | This file + [SituationalAwareness/Rules.md](../Capabilities/SituationalAwareness/Rules.md) |

**Remote-only profiles** (no local clone, no local agents) may never trigger
DropboxLink or GoogleDriveLink mirror workflows. Route them to GitHubWorkflow,
ChatMemoryCapture, and hosted-agent review paths instead. Use
**device-appropriate paths** per
[NamingStandard.md](NamingStandard.md) §Environment-Adaptive Model.

Deferred environment interview:
`Capabilities/SituationalAwareness/EnvironmentDetectionQuestions.md`.

## Agentic Handoff Expectations

Owners often paste a **prior worker summary** or handoff block when continuing
in a new chat. They may be unsure which agent has the ball. Agents should
**expect** this — do not treat it as unusual.

Heuristic (full rules in [SituationalAwareness/Rules.md](../Capabilities/SituationalAwareness/Rules.md) section 2):

- Detect duplicate or repeated summaries quickly at pass start.
- Compare to local repo state; do not redo completed work.
- If the paste adds **new** needs beyond the summary, separate settled vs new
  and **offer options** (continue worker pass, plan-only review, route to a
  Capability, refresh from repo files).
- When only ball clarity is needed, reply briefly: who acts now, one next task.

## Git And Cloud Are Not Connected

Local Git and GitHub form the version-control stack. Dropbox and Google Drive
are **separate** agent review surfaces — not Git remotes, not synced working
copies, and not backups (GitHub is backup).

- Edit and commit from **local Git** only.
- **Default: no cloud copy** after local edits.
- When a remote ChatGPT planner must review files, the owner may copy selected
  files manually or follow on-demand steps in the cloud Capabilities — only
  when explicitly requested.

## Runtime Profiles

| Profile | Typical tools | Repository access | Cloud-assisted handoff |
| --- | --- | --- | --- |
| **Cursor unified** | Cursor Ask, Plan, Agent (same workspace) | Direct read/write on local git root | **Not required** for planning review |
| **ChatGPT + local worker** | ChatGPT (planning), Codex/Cursor CLI/worker (impl) | Planner often **no** local repo | Optional cloud copy **when owner requests review** |
| **Claude Code worker** | Claude Code in repo; ChatGPT or human plans | Worker: local repo; planner: may be remote | Optional cloud copy when owner requests review |
| **Codex app worker** | Codex with repo access | Local repo | Cloud copy only when **owner** requests review sync |

## Cursor Rule (this chat and normal Cursor use)

When you are operating **inside Cursor** with
`C:\Repositories\GetEstablished` (and optional sibling roots) open in the workspace:

1. **Treat the local repository as the source of truth.** Read and edit files
   in the workspace directly.
2. **Do not copy files to Dropbox or Google Drive** as part of a normal agent
   pass unless the user explicitly requests cloud review sync for ChatGPT.
3. **Do not invoke** `DropboxLink` or `GoogleDriveLink` workflow indexes for
   routine planning or implementation in Cursor.
4. **Do not tell the user** to paste repository files so you can "see" them —
   use the workspace.
5. **Do not send work to Codex** only to inspect files the workspace already
   exposes.
6. **Planner and worker** may be the same Cursor session or two chats in one
   window; handoffs are copy-ready blocks or natural chat, not Drive documents.

Cursor-specific setup: `Capabilities/LocalAgentToolSetup/Vendors/Cursor.md`.

Claude Code worker: profile memories live under `%USERPROFILE%\.claude\projects\`
(outside Git). **Repository wins** over profile memory when they conflict.
Harmonize when Claude offers to save memory — see
`Capabilities/LocalAgentToolSetup/Vendors/ClaudeCode.md`.

## External Information (Quick Startup And Early Passes)

When work needs canonical URLs or official docs, use the **external information
ladder** in [SituationalAwareness/Rules.md](../Capabilities/SituationalAwareness/Rules.md)
section 9: suggest URL → search term → record **Suggested** row in
`Workspace/ValuableReferences.md`. Do not default to "go find a URL."

## When Cloud Review Workflows Apply

Use **GoogleDriveLink** (`Capabilities/GoogleDriveLink/WorkflowIndex.md`) when
**all** are true:

- The **planning agent** is ChatGPT (or similar) **without** reliable local
  repository access;
- The **implementation agent** edits the local git repository;
- The **owner requests** review sync so the planner can read current files from
  Google Drive (manual copy or documented one-way copy steps).

Use **DropboxLink** (`Capabilities/DropboxLink/WorkflowIndex.md`) under the
same pattern when Dropbox is the chosen review surface. Not used for
Cursor-unified work. Dropbox mirroring proof-of-concept is on hold until the
owner runs a ChatGPT + Codex trial.

## Instructions To Skip Or Down-Rank In Cursor

When booting in Cursor, **deprioritize** (do not treat as mandatory next steps):

- "Copy local files to cloud after each pass"
- "Read the cloud repo copy instead of local files" when the workspace is open
- "Ask the user to paste `RepositoryTree.txt`" when the workspace is open
- Cloud-To-Local framing as the primary model (deprecated; use
  `Plans/PlannerWorkerWorkflow.md`)
- Triggers that assume the planner cannot open `Plans/` or `Capabilities/`

Still read **GoogleDriveLink** when the task is actually about Drive MCP,
connectors, OAuth, or handoff **for ChatGPT** sessions.

## Quick Startup And Default Single-Agent Sessions

**Quick Startup** ([GettingStarted](../Capabilities/GettingStarted/GettingStarted.md))
ends with a **plain owner summary** — not a fenced worker handoff. See
[PostQuickStartupRouting.md](../Capabilities/GettingStarted/PostQuickStartupRouting.md).

**Default assumption:** one agent (or the owner) continues when ready. **Do not**
assume a separate **planning agent** is waiting unless the owner explicitly
requested **PlannerWorker** or **AssistedAgenticWorkflow**.

Fenced worker handoff blocks (`Summary`, `Files Changed`, `Next Recommended Task`, …)
apply to **implementation worker passes** in that explicit loop — not to Quick
Startup, casual chat, or owner Q&A.

## Instructions Codex And Claude Should Still Read

Codex (outside Cursor) and Claude Code workers should:

- Edit the **local** repository as source of truth;
- Copy files to a cloud review surface **only when** the user or planner
  explicitly requests review sync;
- End **implementation worker passes** (explicit PlannerWorker loop) with the
  standard handoff block for the human or planner. **Quick Startup** uses an
  owner session close instead — see GettingStarted Rules.

## Layered Boot Order

```text
AGENTS.md
Standards/AgentSituationalAwareness.md   <- runtime (this file)
Standards/SourceOfTruthAndMirrorStandard.md
Plans/RepositorySearchMap.md
Capabilities/RouterIndex.md              <- compact router (read first)
Capabilities/AgentCapabilityGuide.md     <- canonical; confirm match + Disambiguation
(task Capability or Plans file)
```

## Related

- [SourceOfTruthAndMirrorStandard.md](SourceOfTruthAndMirrorStandard.md)
- [CloudOnlyPlanningAndMeasurementDevicePlan.md](../Plans/CloudOnlyPlanningAndMeasurementDevicePlan.md) — user device classes (Draft; separate from agent runtime profiles)
- [AgentWorkflowModes.md](../Plans/AgentWorkflowModes.md)
- [PlannerWorkerWorkflow.md](../Plans/PlannerWorkerWorkflow.md)
- [RepositorySearchMap.md](../Plans/RepositorySearchMap.md)
- [DropboxLink WorkflowIndex.md](../Capabilities/DropboxLink/WorkflowIndex.md)
- [GoogleDriveLink WorkflowIndex.md](../Capabilities/GoogleDriveLink/WorkflowIndex.md)
