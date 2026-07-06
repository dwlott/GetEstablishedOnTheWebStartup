<!--
IndexTitle: AssistedAgenticWorkflow Prompt
IndexDescription: Copy-ready worker prompt for starting or continuing an owner-supervised agentic workflow pass on GetEstablished.
IndexType: Capability
CapabilityName: AssistedAgenticWorkflow
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-03
-->

# AssistedAgenticWorkflow Prompt

Read [Rules.md](Rules.md) and [README.md](README.md) before using this
prompt. This prompt is for starting or continuing a supervised agent pass.

```text
# Worker pass: AssistedAgenticWorkflow

Repository: GetEstablished
Branch: main
Local write path: C:\Repositories\GetEstablished
Dropbox inspection path: C:\Users\dwlot\Dropbox\Repositories\GetEstablished
  (read-only connector inspection only — not the write target unless owner
  explicitly approves Dropbox mutation)

Read first:
- AGENTS.md
- Capabilities/SituationalAwareness/Rules.md
- Capabilities/AssistedAgenticWorkflow/Rules.md
- Plans/MigrationCompleteStatus.md (or the named task file)

Active Dropbox path: /Repositories/GetEstablished
Old source-reference path: /Repositories/GetEstablishedOnTheWeb
  (source/reference only — do not use as active path)

Owner-approved scope for this pass:
[OWNER FILLS IN SCOPE BEFORE STARTING]

Rules:
- Work only in the local repository root.
- Do not modify Intake unless owner explicitly approves that scope.
- Do not create folders, move, rename, or delete files without explicit
  approval.
- Prefer targeted edits over broad sweeps.
- When a path destination is unclear, list it as an owner-decision item.
- Reports belong in Plans/ unless the owner names another destination.
- Do not expand scope beyond what was stated above.

If using Dropbox connector inspection:
- Verify connector is available before inspecting.
- Start with max_depth=1 listing of /Repositories/GetEstablished.
- Use exact paths; do not switch to another folder silently.
- Verify named files with metadata when existence matters.
- Report NOT_FOUND exactly; do not hide missing-file results.
- Fetch file content only when wording or links must be inspected.
- Inspection is read-only; do not mutate Dropbox files without an explicit
  approved mutation plan.
- If Dropbox state differs from expected local state, report both states and
  ask the owner to verify locally before treating the connector view as final.

After completing the approved scope, end with exactly one fenced text
handoff block using these fields:

Summary
Files Changed
Files Created
Files Deleted
Verification
Owner Decisions Needed
Next Recommended Task

Keep lines roughly 72 characters. Put each file on its own line under
Files Changed. Name one concrete next task.
```

## Prompt History

- **2026-06-03 (v1):** Instruction optimization: separate local write path from
  Dropbox inspection path; align with AGENTS.md clean root.
- **2026-06-02 (v1):** Initial worker prompt; captures owner-supervised pass
  cycle and Dropbox connector inspection rules.
