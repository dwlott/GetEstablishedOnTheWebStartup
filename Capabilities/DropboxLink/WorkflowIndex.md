<!--
IndexTitle: Dropbox Workflow Index
IndexDescription: Runnable step index for ChatGPT planner and Codex worker using Dropbox review mirror.
IndexType: Capability
CapabilityName: DropboxLink
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-05
-->

# Dropbox Workflow Index

**Start here.** This file is the runnable index for the **ChatGPT + Codex**
workflow when Dropbox is the cloud review surface.

If the `Capabilities/DropboxLink/` folder were removed, these instructions
would be lost. Everything needed to run the workflow lives in this Capability.

---

## When To Run This Index

Run this index when **all** are true:

- **ChatGPT** is the planning and review agent.
- **Codex** (or another local worker) implements repository edits.
- ChatGPT does **not** have reliable direct access to the local Git folder.
- Dropbox is the chosen review mirror (ChatGPT reads real `.md` files).

**Do not run mirror steps** when:

- Both planner and worker operate in **Cursor** with the local repository open.
- The task is local-only and no ChatGPT file review is needed.

---

## Authority Model

| Rank | Surface | Role |
| --- | --- | --- |
| 1 | Local Git repository | Source of truth — Codex edits here |
| 2 | GitHub | Backup and history |
| 3 | Dropbox repository copy | Disposable review mirror for ChatGPT |
| 4 | `IncomingIdeas/` on Dropbox | Cloud intake — protected from mirror deletion |

The Dropbox copy is **not** a backup. Rebuild it from local Git at any time.

---

## Default: No Mirroring

- Codex edits the **local Git repository** only.
- **No mirror runs automatically** after worker passes.
- Mirror runs only when the **owner or ChatGPT planner explicitly asks**
  for a review sync so ChatGPT can read updated files.

---

## Step 0 — Confirm Runtime

Answer before continuing:

| Question | If yes | If no |
| --- | --- | --- |
| Is ChatGPT the planner? | Continue | Use local tools only; skip this index |
| Is Codex the worker? | Continue | Adapt worker steps to your local agent |
| Is Dropbox connector active in ChatGPT? | Continue Step 1 | Enable Dropbox app; see [RepositoryAccessWorkflow.md](RepositoryAccessWorkflow.md) |
| Does local Git exist and have `AGENTS.md`? | Continue | Run RepositoryInitialize first |

---

## Step 1 — Planner Boot (ChatGPT)

ChatGPT reads from Dropbox **only when the mirror is current enough**, or
reads the last known state and notes staleness.

1. Confirm Dropbox connector is active in this chat.
2. List `/Repositories/<RepositoryName>` at depth 1.
3. Confirm clean-root folders: `Capabilities`, `Standards`, `Plans`, `Ideas`,
   `Automation`, `Workspace`, `Content`, `Archive`, `Intake`.
4. Read `/Repositories/<RepositoryName>/AGENTS.md`.
5. Read `/Repositories/<RepositoryName>/Plans/RepositorySearchMap.md` if present.
6. Read this file from the mirror when available:

   ```text
   Capabilities/DropboxLink/WorkflowIndex.md
   ```

7. State whether the Dropbox view appears **current** or **possibly stale**
   (local edits may have happened since last mirror).

**Planner boot prompt (copy-ready):**

```text
Dropbox planner boot — read only.

1. Confirm Dropbox connector is active.
2. List /Repositories/GetEstablished at max_depth=1.
3. Read /Repositories/GetEstablished/AGENTS.md.
4. Read /Repositories/GetEstablished/Capabilities/DropboxLink/WorkflowIndex.md.
5. Report: connector active (yes/no), top-level folders found, whether the
   mirror looks current or possibly stale, and the approved task scope.
Do not edit files yet.
```

---

## Step 2 — Planner Defines Worker Scope

ChatGPT prepares a **Codex worker handoff** (click-to-copy block in chat).

The handoff must include:

- Approved scope (files or task)
- Local Git as edit target
- Explicit **do not mirror** unless the handoff says otherwise
- Standard end fields: Summary, Files Changed, Next Recommended Task

Short and moderate prompts stay in chat. Long prompts may be written as
`.md` in Dropbox `IncomingIdeas/` or local `Plans/` — see
[IntakeWorkflow.md](IntakeWorkflow.md).

---

## Step 3 — Worker Pass (Codex)

Codex runs on the **local Git repository**, not the Dropbox folder.

1. Read local `AGENTS.md`.
2. Read the planner handoff scope.
3. Edit **local Git only**.
4. Do **not** run a mirror unless Step 4 applies.
5. End with one fenced handoff block:

```text
Summary
Files Changed
Verification
Mirror Requested (yes/no)
Next Recommended Task
```

Set `Mirror Requested: yes` only when the planner or owner asked for a
review sync in this pass.

---

## Step 4 — Decide Whether To Mirror

Mirror **only** when one of these is true:

- Owner says: "sync to Dropbox" / "mirror for ChatGPT review"
- Planner handoff explicitly requests review sync
- Worker handoff sets `Mirror Requested: yes`
- ChatGPT needs to read files changed since the last mirror

Otherwise **stop after Step 3**. No mirror is the normal outcome.

---

## Step 5 — On-Demand Mirror (Owner Prompted)

When Step 4 says yes, run
[../MirrorToWindows/WorkflowIndex.md](../MirrorToWindows/WorkflowIndex.md).
If `MirrorToWindows/` is absent, use the stub
[MirrorWorkflow.md](MirrorWorkflow.md) redirect.

Report to ChatGPT:

- Mirror completed (yes/no)
- Local source path used
- Dropbox destination path used
- Any errors or skipped folders

---

## Step 6 — Planner Review (ChatGPT)

After a successful mirror:

1. Re-read changed files from `/Repositories/<RepositoryName>/...` as
   real Markdown paths.
2. Compare worker summary to actual file content.
3. Report `NOT_FOUND` explicitly for any expected missing file.
4. Do not treat the worker summary as proof without reading files.
5. Decide: approve next pass, adjust scope, or stop.

**Planner review prompt (copy-ready):**

```text
Dropbox review pass — read only.

The worker reported these changes:
<paste worker Files Changed list>

Re-read each changed file from /Repositories/GetEstablished/ using exact paths.
Report: file found (yes/no), brief content confirmation, discrepancies, and
next recommended task.
Do not edit repository files unless explicitly approved.
```

---

## Step 7 — Incoming Ideas (Optional)

When ChatGPT or the owner captures ideas not yet ready for local Git:

- Write to `/Repositories/<RepositoryName>/IncomingIdeas/`
- Do not mirror over unprocessed intake — see [IntakeWorkflow.md](IntakeWorkflow.md)
- Process intake in a later scoped pass into local `Ideas/` or `Plans/`

---

## Step 8 — Loop Or Stop

| Outcome | Next action |
| --- | --- |
| Review approved | Planner may issue Step 2 handoff for next scoped task |
| Review found gaps | Planner adjusts scope; return to Step 3 |
| No more tasks | Stop; no mirror unless a future review is needed |
| Durable work complete | Owner may commit/push local Git via GitHubWorkflow |

---

## Quick Reference — File Map In This Capability

| File | Use |
| --- | --- |
| [WorkflowIndex.md](WorkflowIndex.md) | This index — run from Step 0 |
| [MirrorWorkflow.md](MirrorWorkflow.md) | Redirect → MirrorToWindows |
| [../MirrorToWindows/WorkflowIndex.md](../MirrorToWindows/WorkflowIndex.md) | On-demand local → mirror target |
| [RepositoryAccessWorkflow.md](RepositoryAccessWorkflow.md) | Connector paths, read rules, write rules |
| [IntakeWorkflow.md](IntakeWorkflow.md) | IncomingIdeas and promotion |
| [Rules.md](Rules.md) | Operating rules |
| [Prompt.md](Prompt.md) | Copy-ready planner and worker prompts |
| [README.md](README.md) | Capability overview |

---

## Why Dropbox For ChatGPT + Codex

Compared to Google Drive for this stack:

- ChatGPT can read and write **real `.md` files** in repository folders.
- No Google Docs workaround for planner review.
- Planner and worker both reason about the same file tree after mirror.

Use **GoogleDriveLink** when Drive is the chosen review surface instead.
