<!--
IndexTitle: Dropbox Repository Access Workflow
IndexDescription: ChatGPT Dropbox app workflow for reading and writing repository Markdown.
IndexType: Capability
CapabilityName: DropboxLink
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-05
-->

# Dropbox Repository Access Workflow

## Purpose

Use Dropbox when ChatGPT must **plan and review** repository work in the
**ChatGPT + Codex** stack. ChatGPT reads and can write **real Markdown files**
under the repository tree — a practical advantage over Google Drive's native
Google Doc handoff pattern for this workflow.

Local Git remains the edit source of truth. Codex implements there. Dropbox is
the review mirror and optional capture surface.

---

## Connector Setup

1. In ChatGPT, enable the **Dropbox** app for the chat.
2. Confirm the app can list the account root.
3. Confirm read access to `/Repositories/<RepositoryName>/`.
4. Confirm write access only when the owner approves mutations.

Do not claim connector access without verifying it in the current chat.

---

## Active Repository Path

Use the **clean-root** repository name:

```text
/Repositories/GetEstablished
```

Legacy reference path (do not use for active work unless owner says so):

```text
/Repositories/GetEstablishedOnTheWeb
```

---

## Read Workflow (Planner)

1. Shallow list `/Repositories/GetEstablished` at depth 1.
2. Confirm expected top-level folders before deep reads.
3. Do **not** recurse into `Intake/` during routine inspection.
4. Read named files by exact path.
5. Report `NOT_FOUND` clearly — do not hide missing files.
6. Fetch content only when wording or structure must be inspected.

**Boot files (read in order):**

```text
/Repositories/GetEstablished/AGENTS.md
/Repositories/GetEstablished/Capabilities/DropboxLink/WorkflowIndex.md
/Repositories/GetEstablished/Plans/RepositorySearchMap.md
```

---

## Write Workflow (Planner — Approved Only)

ChatGPT **can** create and update text files including `.md` in Dropbox when
the owner approves.

Preferred write targets:

| Target | Use |
| --- | --- |
| `IncomingIdeas/` | Raw captures before promotion to local Git |
| Specific `Plans/` or `Ideas/` paths | Only when owner explicitly approves planner writes |

Rules:

- Summarize the exact mutation before writing unless the owner already
  requested that specific file operation.
- Do not write credentials, tokens, or private account details.
- Do not create shared links unless explicitly requested.
- Planner writes to Dropbox do **not** replace Codex edits to local Git for
  durable implementation work.

---

## Local Bridge (Codex)

Codex does not need a Dropbox plugin if Dropbox Desktop syncs to a local folder.

Discovery order:

1. `GETESTABLISHED_DROPBOX_REPO_ROOT`
2. `%USERPROFILE%\Dropbox\Repositories\GetEstablished`
3. Alternatives listed in [MirrorWorkflow.md](MirrorWorkflow.md) Step 1

Codex reads the local synced folder for handoff files. Codex edits **local Git**,
not the Dropbox-managed copy, unless doing an approved mirror step.

---

## Staleness

Dropbox may lag behind local Git if:

- Codex edited local files but no mirror ran (normal — no mirror is default).
- Desktop sync has not finished.

If Dropbox and expected local state differ, report both and ask whether the
owner ran [MirrorWorkflow.md](MirrorWorkflow.md).

The **local Git repository wins** unless the owner explicitly approves a
cloud-to-local update.

---

## Inspection Prompts

### Confirm repository root

```text
List /Repositories/GetEstablished at max_depth=1.
Report exact folder names. Do not summarize file contents yet.
```

### Read a planning file

```text
Read /Repositories/GetEstablished/Plans/<FileName>.md
Report whether the file exists and summarize only what is needed for the task.
```

### Check mirror freshness signal

```text
Read /Repositories/GetEstablished/Capabilities/DropboxLink/WorkflowIndex.md
and the LastEdited date in the file header if present.
Compare with the worker handoff. Say whether Dropbox likely reflects the
latest local pass or needs a mirror first.
```

---

## Related

- [WorkflowIndex.md](WorkflowIndex.md)
- [MirrorWorkflow.md](MirrorWorkflow.md)
- [IntakeWorkflow.md](IntakeWorkflow.md)
- [Rules.md](Rules.md)
