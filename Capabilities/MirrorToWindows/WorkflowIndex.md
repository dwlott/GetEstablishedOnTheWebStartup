<!--
IndexTitle: MirrorToWindows Workflow Index
IndexDescription: Runnable index for on-demand Windows mirror refresh in consumer starter.
IndexType: Capability
CapabilityName: MirrorToWindows
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-12
-->

# MirrorToWindows Workflow Index

**Start here** when the owner requests a **repository mirror refresh** on Windows.

Planner loop (optional): [../GoogleDriveLink/WorkflowIndex.md](../GoogleDriveLink/WorkflowIndex.md).

## When To Run

- Owner explicitly requests mirror / refresh / backup copy / review sync.
- Owner is on **Windows** (or applying to a Windows mirror path).
- Local Git is SoT.

**Do not run** for Drive capture / connector setup only — use GoogleDriveLink.

## Steps

1. Read `Workspace/OwnerPreferences.md` § Connectors — purpose, paths, purge policy.
2. If unset → [SetupPrompt.md](SetupPrompt.md) and stop.
3. Discover paths per [PathDiscovery.md](PathDiscovery.md) if needed.
4. Confirm purpose and purge with owner (backup → no purge).
5. Apply per [MirrorWorkflow.md](MirrorWorkflow.md) (manual — docs-only starter).
6. Update **Last mirror refresh** on success.

## Quick Reference

| File | Role |
| --- | --- |
| [Prompt.md](Prompt.md) | Copy-ready worker pass |
| [MirrorWorkflow.md](MirrorWorkflow.md) | Manual apply steps |
| [Rules.md](Rules.md) | Operating rules |
