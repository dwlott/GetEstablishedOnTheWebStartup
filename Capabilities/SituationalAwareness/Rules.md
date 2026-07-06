<!--
IndexTitle: SituationalAwareness Rules
IndexDescription: Core always-on situational orientation rules for every GetEstablished agent pass, including duplicate handoff summary detection in agentic workflow.
IndexType: Capability
CapabilityName: SituationalAwareness
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-12
-->

# SituationalAwareness Rules

Read this file alongside `AGENTS.md` at the start of every pass. When a
specific Capability is active, also read that Capability's **Situational
Awareness** section in its `Rules.md`.

## 1. Task Type Detection

Name the **primary** task type before acting (a pass may touch more than one):

- Repository cleanup
- Migration
- Idea capture
- Prompt / Capability creation
- Content workflow
- Connector inspection
- Local worker handoff
- Google Drive handoff
- Dropbox inspection
- Mirror refresh (Dropbox or Google Drive) — see section 13
- Git / GitHub workflow
- Repeated manual indexing (see section 8)
- Duplicate or repeated handoff summary (see section 2)
- External canonical source needed (see section 9)
- Summarizing repository purpose for the owner (see section 11)

Route to the owning Capability when one exists (`Capabilities/AgentCapabilityGuide.md`).

**Tie-breakers** when more than one Capability could match:

- Prefer the **most specific** intent (e.g. "draft my one-page site" → OnePageWebsite, not ContentReview).
- **Mirror refresh** ("refresh Dropbox", "mirror repository", "backup copy") →
  **MirrorToWindows** on Windows or **MirrorToMac** on macOS when present; read
  `Workspace/OwnerPreferences.md` first. Vendor stubs **MirrorToDropbox** /
  **MirrorToGoogleDrive** redirect by platform.
- **Dropbox intake / IncomingIdeas** → **DropboxLink**, not MirrorToDropbox.
- **Drive capture / connector setup** → **GoogleDriveLink**, not MirrorToGoogleDrive unless refresh was explicitly requested.
- For indexing, default to **ManualIndexing** unless the owner has adopted code-assisted indexing; consult the guide's **Disambiguation** table.
- If two capabilities still tie, **ask the owner** rather than guess.

## 2. Duplicate Or Repeated Handoff Summaries

In **agentic workflow** (planner ↔ worker ↔ owner), the owner often pastes a
**prior pass summary** or handoff block into a new chat to continue. This is
normal. The owner may be unsure **who has the ball** — which chat or agent
should act next. Agents should **expect** this; it is repository guidance, not
something to figure out only from the current chat.

### Detect quickly (heuristic)

At the start of the pass, check whether the user's message looks like:

- A fenced `text` handoff block (Summary, Files Changed, Next Recommended Task, etc.)
- A near-verbatim repeat of a prior summary, worker report, or planner brief
- "Continue from here" or "implement the plan" plus a pasted summary with little new text

| Signal | Likely meaning |
| --- | --- |
| Mostly handoff fields, little new instruction | Re-orientation; confirm who acts next |
| Same summary pasted again with no delta | Context reset; do not redo completed local work |
| Pasted summary **plus** new questions, scope, or constraints | Duplicate context **and** additional needs |

Compare pasted **Files Changed** or task names to the **local repository** (and
`git status` when relevant) before acting.

### Actions (heuristic)

1. **Name the ball** — state which role this session is (e.g. Cursor worker with
   repo open, plan-only review) and who should act **now** (usually: this agent
   executes locally unless the user scoped plan-only).
2. **If purely duplicate** — short confirmation: context received; note whether
   repo state matches the summary or drift exists; propose **one** next scoped
   task; wait for **continue** before large re-work.
3. **If duplicate plus additional needs** — separate explicitly:
   - What is **already settled** (from the pasted summary)
   - What is **new** in the message
   - **Options** for the owner (e.g. worker pass on the new item only, planning
     review only, route to a Capability, refresh handoff from repo files)
   Do not merge old and new into one ambiguous task silently.
4. Do not shame re-pasting; confusion about handoffs is expected in multi-agent
   workflows. Keep ball-clarity replies **short** when no new work is requested.

See also [AssistedAgenticWorkflow Rules](../AssistedAgenticWorkflow/Rules.md) for
supervised pass cycles and handoff shape.

## 3. Active Repository

| Surface | Role |
| --- | --- |
| `C:\Repositories\GetEstablished` | **Write target** — active clean root; method host; source of truth |
| `C:\Repositories\GetEstablishedOnTheWeb` | **Product repo** — canonical `Content/Website/` and Phase 4 publishing |
| `C:\Repositories\GetEstablished\Intake\GetEstablishedOnTheWeb` | **Reference only** — not source of truth |
| `/Repositories/GetEstablished` (Dropbox) | **Inspection only** — optional cloud review; not Git |
| Google Drive (cloud) | Optional review surface — not connected to Git; on-demand copy only |

Do not confuse **GetEstablished** (method host) with **GetEstablishedOnTheWeb**
(product repo at `C:\Repositories\GetEstablishedOnTheWeb`) or the Intake snapshot
(legacy reference).

## 4. Connector / Environment

Identify which is active:

- **Local filesystem** — default write surface
- **Dropbox** — inspection; read-only unless owner approves mutation with exact paths
- **Google Drive** — optional review/handoff; connector loop → GoogleDriveLink;
  mirror refresh → MirrorToWindows or MirrorToMac when present; not Git
- **GitHub** — remote sync; follow GitHubWorkflow; no push unless instructed
- **No connector** — local-only pass

The **local repository is source of truth**. Connector views may lag behind local state.

## 5. Destination Folder Routing

Before writing or advising, pick the correct folder (`AGENTS.md` Active Root Structure):

| Folder | Use for |
| --- | --- |
| `Capabilities/` | Reusable agent operating knowledge |
| `Standards/` | Durable cross-task rules |
| `Plans/` | Approved work not yet implemented; reports |
| `Ideas/` | Possibilities before promotion |
| `Content/` | Publishable project content |
| `Archive/` | Retired or superseded material |
| `Intake/` | Reference only — do not modify without explicit scope |

When destination is unclear, list it under **Owner Decisions Needed** — do not guess.

## 6. Dropbox Idea-Sharing

When Dropbox is the active inspection surface:

- Idea-sharing folder: `/Repositories/GetEstablished/Ideas` (local: `Ideas/`).
- Default general ideas file: `Ideas/FutureIdeas.md`.
- Do not leave durable repository ideas only in chat when they belong in `Ideas/`.
- Do not mutate Dropbox files without explicit owner approval and confirmed paths.

## 7. Instruction Optimization

- Separate **inspection** from **execution**.
- Treat **continue** as approval for the **next scoped task**, not unrelated mutations.
- Keep handoffs **copy-ready** — one fenced block, concise fields.
- Do not over-explain connector tool-policy friction in final prompts.
- After Dropbox inspection, provide the next clean worker prompt when asked to continue.
- Do not confuse clean-root files with Intake source copies.
- When a Capability pass finds **instruction gaps** (instructions wrong, incomplete,
  or more work needed than documented), record them for the owner — in the
  handoff and/or `Plans/OpenQuestions.md` — do not leave learnings only in chat.
  During **StarterRepositoryPackage**, edit the packaging workspace only; promote
  fixes into host Capability docs on a follow-up pass.

## 8. Repeated Manual Indexing Signal

Manual indexing is the default (`Capabilities/ManualIndexing/`). When you notice
the owner asking for — or you performing — manual `Indexes/` refreshes
**repeatedly** for this repository, treat it as a signal and route to
[../ManualIndexing/Rules.md](../ManualIndexing/Rules.md) "Repetition Detector And
Code-Assisted Re-Offer":

1. **Presence check first.** If `Capabilities/CodeAssistedIndexing/` is not in
   the registry, do nothing — stay manual silently. Agents do not know it exists.
2. If present, read the **Indexing** section of
   [../../Workspace/OwnerPreferences.md](../../Workspace/OwnerPreferences.md).
3. Apply the decision table: never re-offer after `Declined`; while
   `Deferred`/`Undecided`, offer code-assisted indexing softly only until the
   `Re-offer cap` is reached, then go quiet.

Do not pester. One soft offer per qualifying occasion; increment the counter.

## 9. External Information Ladder

When the next step needs information from outside the repository (official docs,
exam outlines, product pages, pricing, canonical URLs):

1. **Suggest a specific URL** when you know a likely canonical source. Mark
   `Confidence: Suggested` in `Workspace/ValuableReferences.md` until the owner
   confirms.
2. **If uncertain**, provide a **search term and starting site** (for example
   "Search `skills measured` on learn.microsoft.com for [cert name]").
3. **Record the candidate** in `Workspace/ValuableReferences.md` with **Used for**
   and review notes — even when you cannot verify the link in-session.
4. **Never stop at** "go find a URL and paste it here" without steps 1–3.
5. **Offer owner review** when Suggested rows accumulate — see
   [GettingStarted/ReferenceReviewPrompt.md](../GettingStarted/ReferenceReviewPrompt.md).

Treat **Owner-confirmed** rows as citable; treat **Suggested** rows as hypotheses.

## 10. Vendor Profile Memory (Claude Code)

Claude Code may store **memories** in the user profile (for example
`%USERPROFILE%\.claude\projects\` on Windows) — **outside Git**, not in this
repository.

| Situation | Action |
| --- | --- |
| Session start; Claude recalls memory | Read repo registers first; **repo wins** if memory conflicts |
| Session end; Claude offers to save memory | Harmonize: update repo for durable facts; memory is optional shortcut |
| Smoke test / clean boot | Owner may reset profile memory manually; agents do not delete it |

Durable homes: `Workspace/OwnerGoals.md`, `Workspace/OwnerPreferences.md`,
`Workspace/ValuableReferences.md`, `Plans/Ideas.md` — not profile-only.

Full checklist: [LocalAgentToolSetup/Vendors/ClaudeCode.md](../LocalAgentToolSetup/Vendors/ClaudeCode.md).

## 11. Describing Repository Purpose (Agent Replies)

When the owner asks what this repository is for, or you orient at session start:

1. **Lead with the pipeline:** capture **Ideas** → **Plans** → **desired positive
   outcomes** (see `AGENTS.md` Primary Goal Of Repository).
2. **Then** name **Owner Goals** from `Workspace/OwnerGoals.md` when available.
3. **Online presence / Get Established On The Web** is a **supported outcome** when
   Owner Goals and shipped Capabilities (GettingStarted, ContentReview, `Content/`)
   fit — not the default identity of every repo unless goals say so.
4. Do not reduce the repository to "a website template" or "web presence builder
   only" unless the owner explicitly scoped the project that way.

## 12. User Device And Operating Profile

When local-only instructions would misfire (phone, tablet, Chromebook,
browser-only), run the environment interview in
[EnvironmentDetectionQuestions.md](EnvironmentDetectionQuestions.md) and route
per [CloudOnlyDeviceWorkflow.md](CloudOnlyDeviceWorkflow.md). Use
**device-appropriate paths** per
[NamingStandard.md](../../Standards/NamingStandard.md) §Environment-Adaptive Model.

Distinct from **agent runtime** profiles in
[AgentSituationalAwareness.md](../../Standards/AgentSituationalAwareness.md).

## 13. Mirror Refresh Routing

When the owner or planner asks to **refresh**, **mirror**, or **sync review copy**
to Dropbox or Google Drive:

### Detect mirror intent

Keywords combined with a surface name, for example:

- refresh Dropbox / mirror to Dropbox / sync Dropbox review copy
- refresh Google Drive / mirror to GDrive / sync Drive review copy

### Presence gate

| Surface | Route when folder exists | Fallback |
| --- | --- | --- |
| Any Windows mirror target | `Capabilities/MirrorToWindows/WorkflowIndex.md` | Manual copy per Standard |
| Any Mac mirror target | `Capabilities/MirrorToMac/WorkflowIndex.md` | Manual copy per Standard |
| Dropbox *(phrase alias)* | Platform mirror cap + Dropbox target path | Link mirror stub |
| Google Drive *(phrase alias)* | Platform mirror cap + GDrive/CloudStorage path | Link mirror stub |

Use **Mirror platform** in Owner Preferences when both caps are present.
Vendor-named folders **MirrorToDropbox** / **MirrorToGoogleDrive** are stub
aliases — route to **MirrorToWindows** or **MirrorToMac** by OS.

### Read Workspace first

Before apply:

1. Read `Workspace/OwnerPreferences.md` § **Connectors**.
2. If **Local repository root** or the surface mirror root is `(not set)`, run
   that Mirror Capability's **SetupPrompt.md** — do not apply blind paths.
3. On later refreshes, prefer saved paths without re-asking drive letters.

### Cursor unified skip

When the repository is open in **Cursor** and the user did **not** explicitly
request review sync for a remote planner, **skip mirror** — local Git is visible.

### Disambiguation

| User says | Route |
| --- | --- |
| Refresh / mirror to Dropbox or GDrive | MirrorToWindows (this section) |
| Refresh / mirror repository / backup copy | MirrorToWindows (this section) |
| Dropbox incoming ideas / intake | DropboxLink IntakeWorkflow |
| Drive capture / Save To GCloud / connector boot | GoogleDriveLink WorkflowIndex |
| ChatGPT + Codex full planner loop | GoogleDriveLink or DropboxLink WorkflowIndex |

## Related

- [Prompt.md](Prompt.md)
- [EnvironmentDetectionQuestions.md](EnvironmentDetectionQuestions.md)
- [CloudOnlyDeviceWorkflow.md](CloudOnlyDeviceWorkflow.md)
- [CloudOnlyPlanningAndMeasurementDevicePlan.md](../../Plans/CloudOnlyPlanningAndMeasurementDevicePlan.md)
- [MirrorToMac Rules](../MirrorToMac/Rules.md)
- [MirrorToWindows Rules](../MirrorToWindows/Rules.md)
- [MirrorToDropbox Rules](../MirrorToDropbox/Rules.md) — stub alias
- [MirrorToGoogleDrive Rules](../MirrorToGoogleDrive/Rules.md) — stub alias
- [AssistedAgenticWorkflow Rules](../AssistedAgenticWorkflow/Rules.md) — supervised pass execution after orientation
- [ManualIndexing Rules](../ManualIndexing/Rules.md) — repetition detector and re-offer logic
