<!--
IndexTitle: DropboxLink Prompt
IndexDescription: Copy-ready prompts for Dropbox-enabled ChatGPT planner and Codex worker passes.
IndexType: Capability
CapabilityName: DropboxLink
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-12
-->

# DropboxLink Prompt

Read [Rules.md](Rules.md) and run [WorkflowIndex.md](WorkflowIndex.md) before
using these prompts.

---

## Planner Boot (ChatGPT)

```text
# Dropbox planner boot

Read and follow:
Capabilities/DropboxLink/WorkflowIndex.md (from Dropbox mirror if current,
or ask owner to mirror first)

Run WorkflowIndex Steps 0–1 only.

Confirm: Dropbox connector active, repository root listed, AGENTS.md read,
mirror current or stale, approved scope stated.
Read-only unless owner approved writes.
```

---

## Worker Pass (Codex)

```text
# Codex worker pass — local Git

Repository: GetEstablished
Read first:
- AGENTS.md
- Capabilities/DropboxLink/WorkflowIndex.md
- Capabilities/DropboxLink/Rules.md

Scope:
<paste approved scope>

Rules:
- Edit local Git only — not the Dropbox folder
- Do NOT mirror unless this handoff says "Mirror Requested: yes"
- Do not stage, commit, or push unless explicitly requested
- End with one fenced handoff: Summary, Files Changed, Verification,
  Mirror Requested (yes/no), Next Recommended Task
```

---

## Mirror Request (Owner → Codex)

```text
# Codex — on-demand Dropbox mirror

Mirror Requested: yes

Read and run Capabilities/MirrorToWindows/WorkflowIndex.md.

Read Workspace/OwnerPreferences.md Connectors first. If paths unset, run
Capabilities/MirrorToWindows/SetupPrompt.md.

Report Windows Mirror block from MirrorToWindows/MirrorWorkflow.md when done.
```

---

## Planner Review (ChatGPT)

```text
# Dropbox planner review

Worker handoff:
<paste worker handoff>

Run WorkflowIndex Step 6.

Re-read each changed file from /Repositories/GetEstablished/ as real .md paths.
Report NOT_FOUND for any missing file. Recommend next scoped task or stop.
```

---

## Intake Capture (ChatGPT — Approved Writes)

```text
# Dropbox intake capture

Owner approved write to IncomingIdeas.

Read Capabilities/DropboxLink/IntakeWorkflow.md.

Create or update:
/Repositories/GetEstablished/IncomingIdeas/<descriptive-name>.md

Return exact path and brief summary. Do not claim promotion to local Git.
```

---

## Prompt history

- **2026-06-05 (v1):** Initial DropboxLink prompts aligned with WorkflowIndex.
