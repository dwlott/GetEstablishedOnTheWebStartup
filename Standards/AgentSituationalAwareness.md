<!--
IndexTitle: Agent Situational Awareness
IndexDescription: Runtime-aware rules so agents know when local repo access makes cloud-assisted handoffs unnecessary (Cursor) versus required (ChatGPT planning).
IndexType: Standard
IndexStatus: Active
LastEdited: 2026-11-07
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

When you are operating **inside Cursor** with this starter or an adopted project
(for example `C:\Repositories\GetEstablishedOnTheWebStartup` or
`C:\Repositories\<YourWebProjectName>`) open in the workspace:

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
   window; handoffs are not Drive documents. Format them per
   [Click-To-Copy Blocks And Handoffs](#click-to-copy-blocks-and-handoffs).

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

## Click-To-Copy Blocks And Handoffs

Always on, for every agent and every pass. `AGENTS.md` carries a short pointer
to this section; this section is the single source of the rule.

A fenced code block (click-to-copy window) is **only** for text the owner will
copy and paste somewhere else. Everything else is normal dialogue.

**Always in one fenced block, in chat:**

- Prompts for another agent or AI tool: handoffs, worker prompts, prompts for
  ChatGPT, Codex, or a new Claude Code session. Use a `text` block.
- Commands the owner will run themselves. Use a shell-tagged block.
- Any other text the owner must paste somewhere: a form field, a settings
  box, an email, a file. Use a `text` block.

Rules for those blocks:

- The block holds only the text to copy. Explanations go before or after it,
  never inside.
- One block per thing to copy. Don't split one prompt across blocks.
- Saving the prompt to a file as well is fine, but the file never replaces
  the in-chat block.

**Never in a fenced block:** normal dialogue. That includes answers, reports,
summaries, recaps, status, findings, plans, questions to the owner, and lists
of what changed. Write these as ordinary text (tables and lists are fine).
Short inline code such as a file name or a single value stays in backticks,
not a block. Never wrap a whole final summary in a block just to make it
copyable.

### Handoff blocks and single-agent sessions

**Default assumption:** one agent (or the owner) continues when ready. **Do not**
assume a separate **planning agent** is waiting unless the owner explicitly
requested **PlannerWorker** or **AssistedAgenticWorkflow**. Editing files or
being called a "worker" does not by itself call for a handoff block.

Give a fenced `text` handoff block (`Summary`, `Files Changed`,
`Next Recommended Task`, …) only when at least one is true:

- the owner explicitly chose a separate planner-agent / implementation-agent
  workflow;
- another agent or conversation is waiting for the handoff; or
- the owner asked for a copy-ready prompt, report, or handoff.

Otherwise report in normal dialogue.

**Quick Startup** ([GettingStarted](../Capabilities/GettingStarted/GettingStarted.md))
ends with a **plain owner summary** — not a fenced worker handoff. See
[PostQuickStartupRouting.md](../Capabilities/GettingStarted/PostQuickStartupRouting.md).

## Instructions Codex And Claude Should Still Read

Codex (outside Cursor) and Claude Code workers should:

- Edit the **local** repository as source of truth;
- Copy files to a cloud review surface **only when** the user or planner
  explicitly requests review sync;
- Give a handoff block only under the conditions in
  [Click-To-Copy Blocks And Handoffs](#click-to-copy-blocks-and-handoffs);
  otherwise report in normal dialogue.

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
