<!--
IndexTitle: Indexing Prompt
IndexDescription: Copy-ready prompt to refresh indexes without moving source material.
IndexType: Capability
CapabilityName: Indexing
CapabilityVersion: 2
IndexStatus: Planned
LastEdited: 2026-06-06
-->

# Indexing Prompt

Read [Rules.md](Rules.md), [Structure.md](Structure.md), and [WorkflowIndex.md](WorkflowIndex.md) before this pass.

```text
# Worker pass: Indexing (operate / refresh)

Repository: C:\Repositories\GetEstablished
Branch: main

Read first:
- AGENTS.md
- Capabilities/Indexing/Rules.md
- Capabilities/Indexing/Structure.md

Step 0 — Health check (recommended):
- Run Capabilities/Indexing/IndexHealthCheck.md review OR
  Automation/IndexHealthCheck/Run-IndexHealthCheck.ps1
- Fix Must-fix items that would corrupt index accuracy, or document in handoff

Step 1 — Verify structure:
- If Indexes/ is missing:
  - Tell the owner indexes are not set up yet.
  - Offer Capabilities/Indexing/SetupPrompt.md (owner must agree).
  - Do NOT create Indexes/ except via SetupPrompt.
  - Stop unless owner approves Setup.
- If partially provisioned, offer Setup repair and stop.

Step 2 — Refresh:
- Update ChatMarkdownIndex and/or FollowThroughIndex per owner scope.
- Source folders: Plans/, Content/Website/Pages/, Workspace/ (pointers only).
- Do not move or rename source files.
- Edit only under Indexes/ unless owner expands scope.

Out of scope: commit, push, scripts beyond health check, new index file types.

End with exactly one fenced text handoff:
Summary
Files Changed
Planning Files To Review
Questions Added Or Changed
Next Recommended Task
```

## Prompt history

- **2026-06-06 (v2):** Health check step; clean-root paths; WorkflowIndex link.
- **2026-05-28 (v1):** Parent template with lazy Setup offer.

## Related

- [Skills/IndexRefresh/SKILL.md](Skills/IndexRefresh/SKILL.md)
