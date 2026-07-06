<!--
IndexTitle: ManualIndexing Workflow Index
IndexDescription: Runnable index for the default agent-driven Indexes/ refresh on GetEstablished clean-root repositories.
IndexType: Capability
CapabilityName: ManualIndexing
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-07
-->

# ManualIndexing Workflow Index

**Start here** for the default, agent-driven `Indexes/` refresh. No scripts run.

If `Capabilities/ManualIndexing/` were removed, these instructions would be lost.

## When To Use

| Need | Step |
| --- | --- |
| Refresh `Indexes/` after new files | [Prompt.md](Prompt.md) |
| Confirm index format / columns | [../Indexing/Structure.md](../Indexing/Structure.md) |
| Validate before refresh (read-only) | [../Indexing/IndexHealthCheck.md](../Indexing/IndexHealthCheck.md) |
| Provision `Indexes/` first time | [../Indexing/SetupPrompt.md](../Indexing/SetupPrompt.md) |

**Default mode.** Manual indexing is always available and requires no owner Setup
beyond an existing `Indexes/` folder.

## Step 0 — Confirm Scope

- [ ] Read [Rules.md](Rules.md) and [../Indexing/Structure.md](../Indexing/Structure.md)
- [ ] This pass writes only under `Indexes/`
- [ ] No scripts, schedulers, or mirroring code are run in this Capability

## Step 1 — Verify Structure

- If `Indexes/` is missing, tell the owner indexes are not set up yet and offer
  [../Indexing/SetupPrompt.md](../Indexing/SetupPrompt.md) (owner must agree).
- If partially provisioned, offer scoped repair and stop.

## Step 2 — Refresh By Hand

1. Read the changed or new source files.
2. Update `Indexes/ChatMarkdownIndex.md` and/or `Indexes/FollowThroughIndex.md`
   per [../Indexing/Structure.md](../Indexing/Structure.md) column specs.
3. Preserve source wording; do not move or rename source files.

## Step 3 — Re-Offer Check (Situational Awareness)

If this is a **repeated** manual indexing pass, follow the re-offer logic in
[Rules.md](Rules.md): check `Workspace/OwnerPreferences.md`, and only when the
[CodeAssistedIndexing](../CodeAssistedIndexing/README.md) Capability is present
and the owner has not declined, consider offering code-assisted indexing.

## Step 4 — Verify

- [ ] Source files unchanged (except `Indexes/`)
- [ ] Index columns match Structure spec
- [ ] End with one fenced `text` worker handoff per `AGENTS.md`

## Related

- [README.md](README.md)
- [Rules.md](Rules.md)
- [../Indexing/WorkflowIndex.md](../Indexing/WorkflowIndex.md)
