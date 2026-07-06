<!--
IndexTitle: ManualIndexing Prompt
IndexDescription: Copy-ready prompt for an agent to refresh Indexes/ by hand without running automation.
IndexType: Capability
CapabilityName: ManualIndexing
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-07
-->

# ManualIndexing Prompt

Read [Rules.md](Rules.md), [../Indexing/Structure.md](../Indexing/Structure.md),
and [WorkflowIndex.md](WorkflowIndex.md) before this pass.

```text
# Worker pass: ManualIndexing (agent refresh, no scripts)

Repository: C:\Repositories\GetEstablished
Branch: main

Read first:
- AGENTS.md
- Capabilities/ManualIndexing/Rules.md
- Capabilities/Indexing/Structure.md

Step 0 — Verify structure:
- If Indexes/ is missing:
  - Tell the owner indexes are not set up yet.
  - Offer Capabilities/Indexing/SetupPrompt.md (owner must agree).
  - Do NOT create Indexes/ except via SetupPrompt. Stop unless owner approves.
- If partially provisioned, offer Setup repair and stop.

Step 1 — Refresh by hand:
- Read new or changed source files under Plans/, Content/Website/Pages/,
  Workspace/ (pointers only).
- Update Indexes/ChatMarkdownIndex.md and/or Indexes/FollowThroughIndex.md per
  Capabilities/Indexing/Structure.md column specs.
- Preserve source wording; do not move or rename source files.
- Edit only under Indexes/ unless the owner expands scope.
- Run NO scripts, schedulers, or mirroring code in this pass.

Step 2 — Re-offer check (only if this is a repeated manual indexing pass):
- Follow Capabilities/ManualIndexing/Rules.md "Repetition Detector And
  Code-Assisted Re-Offer".
- If Capabilities/CodeAssistedIndexing/ is NOT present, do nothing — stay manual.
- Otherwise read Workspace/OwnerPreferences.md Indexing section and apply the
  decision table (never re-offer after a Declined; respect the re-offer cap).

Out of scope: commit, push, source file moves, running automation scripts.

End with exactly one fenced text handoff:
Summary
Files Changed
Planning Files To Review
Questions Added Or Changed
Next Recommended Task
```

## Related

- [WorkflowIndex.md](WorkflowIndex.md)
- [Rules.md](Rules.md)
