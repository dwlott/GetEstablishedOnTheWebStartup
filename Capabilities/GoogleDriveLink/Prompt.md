<!--
IndexTitle: GoogleDriveLink Prompt
IndexDescription: Copy-ready prompts for Google Drive ChatGPT planner and Codex worker passes.
IndexType: Capability
CapabilityName: GoogleDriveLink
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-12
-->

# GoogleDriveLink Prompt

Read [Rules.md](Rules.md) and run [WorkflowIndex.md](WorkflowIndex.md) before
using these prompts.

---

## Planner Boot (ChatGPT)

```text
# Google Drive planner boot

Read and follow Capabilities/GoogleDriveLink/WorkflowIndex.md Steps 0–1.

Confirm: Drive app active, My Drive / Repositories / GetEstablished found,
AGENTS.md read, mirror current or stale, approved scope stated.
Read-only unless owner approved writes or capture.
```

---

## Worker Pass (Codex)

```text
# Codex worker pass — local Git

Repository: GetEstablished
Read first:
- AGENTS.md
- Capabilities/GoogleDriveLink/WorkflowIndex.md
- Capabilities/GoogleDriveLink/Rules.md

Scope:
<paste approved scope>

Rules:
- Edit local Git only
- Do NOT mirror unless this handoff says "Mirror Requested: yes"
- Do not stage, commit, or push unless explicitly requested
- End with: Summary, Files Changed, Verification, Mirror Requested (yes/no),
  Next Recommended Task
```

---

## Mirror Request (Owner → Codex)

```text
# Codex — on-demand Google Drive mirror

Mirror Requested: yes

Read and run Capabilities/MirrorToWindows/WorkflowIndex.md.

Read Workspace/OwnerPreferences.md Connectors first. If paths unset, run
Capabilities/MirrorToWindows/SetupPrompt.md.

Report Windows Mirror block from MirrorToWindows/MirrorWorkflow.md when done.
```

---

## Planner Review (ChatGPT)

```text
# Google Drive planner review

Worker handoff:
<paste worker handoff>

Run WorkflowIndex Step 6.

Re-read each changed file from My Drive / Repositories / GetEstablished/.
Report NOT_FOUND for missing files. Recommend next task or stop.
```

---

## Connection Planning Pass (Documentation)

```text
# Worker pass: GoogleDriveLink planning

Read first:
- AGENTS.md
- Capabilities/GoogleDriveLink/README.md
- Capabilities/GoogleDriveLink/Rules.md
- Capabilities/GoogleDriveLink/WorkflowIndex.md

Goal: Plan or document safe Google Drive connection — not live OAuth unless
explicitly approved.

Do not commit secrets. End with standard worker handoff fields.
```

---

## Prompt history

- **2026-06-05 (v1):** WorkflowIndex-aligned prompts; on-demand mirror only.
- **2026-05-29 (v1):** Initial documentation-first worker prompt.
