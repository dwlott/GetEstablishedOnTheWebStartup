<!--
IndexTitle: Google Drive Workflow Index
IndexDescription: Runnable step index for ChatGPT planner and Codex worker using Google Drive review mirror.
IndexType: Capability
CapabilityName: GoogleDriveLink
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-05
-->

# Google Drive Workflow Index

**Start here.** This file is the runnable index for the **ChatGPT + Codex**
workflow when Google Drive is the cloud review surface.

If the `Capabilities/GoogleDriveLink/` folder were removed, these instructions
would be lost. Everything needed to run the workflow lives in this Capability.

---

## When To Run This Index

Run this index when **all** are true:

- **ChatGPT** is the planning and review agent.
- **Codex** (or another local worker) implements repository edits.
- ChatGPT does **not** have reliable direct access to the local Git folder.
- Google Drive is the chosen review mirror.

**Do not run mirror steps** when:

- Both planner and worker operate in **Cursor** with the local repository open.
- The task is local-only and no ChatGPT file review is needed.

Use **DropboxLink** when Dropbox is the chosen review surface instead —
especially when ChatGPT must read and write real `.md` files in repository
folders.

---

## Authority Model

| Rank | Surface | Role |
| --- | --- | --- |
| 1 | Local Git repository | Source of truth — Codex edits here |
| 2 | GitHub | Backup and history |
| 3 | Google Drive repo copy | Disposable review mirror for ChatGPT |
| 4 | My Drive root Google Docs | Intake and handoff — outside mirrored tree |

The Drive repository copy is **not** a backup. Rebuild it from local Git.

---

## Default: No Mirroring

- Codex edits the **local Git repository** only.
- **No mirror runs automatically** after worker passes.
- Mirror runs only when the **owner or ChatGPT planner explicitly asks**
  for a review sync.

FastMirror is the **apply command** when mirror is requested — not the default
rhythm of every edit.

---

## Step 0 — Confirm Runtime

| Question | If yes | If no |
| --- | --- | --- |
| Is ChatGPT the planner? | Continue | Use local tools only; skip this index |
| Is Codex the worker? | Continue | Adapt worker steps to your local agent |
| Is Google Drive app active in ChatGPT? | Continue Step 1 | Enable Drive; see [RepositoryAccessWorkflow.md](RepositoryAccessWorkflow.md) |
| Does local Git exist with `AGENTS.md`? | Continue | Run RepositoryInitialize first |

---

## Step 1 — Planner Boot (ChatGPT)

ChatGPT reads from the Drive repository mirror when it is current enough.

Drive cloud path (ChatGPT connector):

```text
My Drive / Repositories / <RepositoryName>
```

1. Confirm Google Drive app is active in this chat.
2. Locate `My Drive / Repositories / <RepositoryName>`.
3. Read `AGENTS.md` from that path.
4. Read `Capabilities/GoogleDriveLink/WorkflowIndex.md` when available.
5. Read `Plans/RepositorySearchMap.md` when available.
6. State whether the Drive mirror appears **current** or **possibly stale**.

**Planner boot prompt (copy-ready):**

```text
Google Drive planner boot — read only.

1. Confirm Google Drive app is active.
2. Locate My Drive / Repositories / GetEstablished.
3. Read AGENTS.md from that repository copy.
4. Read Capabilities/GoogleDriveLink/WorkflowIndex.md from the mirror if present.
5. Report: connector active (yes/no), path found, mirror current or stale,
   and approved task scope.
Do not edit files yet.
```

For captures and long handoffs at Drive root, see
[DriveCaptureWorkflow.md](DriveCaptureWorkflow.md).

---

## Step 2 — Planner Defines Worker Scope

ChatGPT prepares a **Codex worker handoff** (click-to-copy block in chat).

Include:

- Approved scope
- Local Git as edit target
- Explicit **do not mirror** unless requested
- Standard end fields

Long prompts: native Google Doc in **My Drive root** + short pointer URL in
chat — see [DriveCaptureWorkflow.md](DriveCaptureWorkflow.md#long-prompt-gdrive-handoff).

---

## Step 3 — Worker Pass (Codex)

Codex runs on **local Git**, not the Drive copy.

1. Read local `AGENTS.md`.
2. Execute approved scope in local Git.
3. Do **not** mirror unless Step 4 applies.
4. End with:

```text
Summary
Files Changed
Verification
Mirror Requested (yes/no)
Next Recommended Task
```

---

## Step 4 — Decide Whether To Mirror

Mirror **only** when:

- Owner says: "sync to Drive" / "refresh gdrive mirror" / "mirror for ChatGPT"
- Planner handoff explicitly requests review sync
- Worker handoff sets `Mirror Requested: yes`
- ChatGPT must read files changed since the last mirror

Otherwise **stop after Step 3**.

---

## Step 5 — On-Demand Mirror (Owner Prompted)

When Step 4 says yes, run
[../MirrorToWindows/WorkflowIndex.md](../MirrorToWindows/WorkflowIndex.md).
If `MirrorToWindows/` is absent, use the stub
[MirrorWorkflow.md](MirrorWorkflow.md) redirect.

Report result to ChatGPT before planner review.

---

## Step 6 — Planner Review (ChatGPT)

After mirror (or if mirror was not needed and files unchanged on Drive):

1. Read changed files from `My Drive / Repositories / <RepositoryName>/...`
2. Treat worker summary as a pointer, not proof.
3. For long handoffs, read Drive-root Google Docs if used.
4. Report missing files; ask whether mirror ran if content looks stale.

**Planner review prompt (copy-ready):**

```text
Google Drive review pass — read only.

Worker reported these changes:
<paste Files Changed>

Re-read each file from My Drive / Repositories / GetEstablished/ using exact paths.
Report found/not found, brief confirmation, discrepancies, next task.
```

---

## Step 7 — Capture And Intake (Optional)

| Pattern | Location | Use |
| --- | --- | --- |
| Save To GCloud | My Drive root Google Doc | Mobile or quick capture |
| Long prompt handoff | My Drive root Google Doc | Too long for chat block |
| Root handoff note | My Drive root | Session pointer only |

Promote useful capture into local Git Markdown via Codex — see
[DriveCaptureWorkflow.md](DriveCaptureWorkflow.md).

Drive root docs are **outside** the repository mirror tree and are not
deleted by repository mirror operations.

---

## Step 8 — Loop Or Stop

| Outcome | Next action |
| --- | --- |
| Review approved | Planner issues next Step 2 handoff |
| Gaps found | Adjust scope; return to Step 3 |
| Done | Stop; no mirror unless future review needed |
| Durable work complete | Owner may commit/push via GitHubWorkflow |

---

## Quick Reference — File Map In This Capability

| File | Use |
| --- | --- |
| [WorkflowIndex.md](WorkflowIndex.md) | This index — run from Step 0 |
| [MirrorWorkflow.md](MirrorWorkflow.md) | Redirect → MirrorToWindows |
| [../MirrorToWindows/WorkflowIndex.md](../MirrorToWindows/WorkflowIndex.md) | On-demand local → mirror target |
| [RepositoryAccessWorkflow.md](RepositoryAccessWorkflow.md) | ChatGPT Drive app read path |
| [DriveCaptureWorkflow.md](DriveCaptureWorkflow.md) | Root Docs, Save To GCloud, long handoffs |
| [Rules.md](Rules.md) | Operating rules |
| [Prompt.md](Prompt.md) | Copy-ready prompts |
| [README.md](README.md) | Capability overview |

---

## GDrive vs Dropbox For ChatGPT + Codex

| Need | Prefer |
| --- | --- |
| Read/write real `.md` in repo folders | DropboxLink |
| Phone capture as Google Docs | GoogleDriveLink |
| Nested repo `.md` write from ChatGPT | DropboxLink (proven) |
| Repository tree review mirror | Either — after on-demand mirror |
