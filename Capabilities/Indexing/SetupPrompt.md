<!--
IndexTitle: Indexing Setup Prompt
IndexDescription: Copy-ready prompt to provision Indexes/ folder structure on clean-root repos.
IndexType: Capability
CapabilityName: Indexing
CapabilityVersion: 2
LastEdited: 2026-06-06
-->

# Indexing Setup Prompt

Run once when the owner wants `Indexes/` folders. Spec: [Structure.md](Structure.md).

Recommend running [IndexHealthCheck.md](IndexHealthCheck.md) first.

```text
# Worker pass: Indexing Setup

Repository: C:\Repositories\GetEstablished
Branch: main

Read first:
- AGENTS.md
- Capabilities/Indexing/Rules.md
- Capabilities/Indexing/Structure.md
- Standards/CapabilityProvisionedStructure.md

Goal:
Create Indexes/ structure per Structure.md for the archetypeHost profile.
This pass may mkdir only paths listed in Structure.md.

Create or update:

1. Indexes/README.md — indexes are capability-provisioned; list ChatMarkdownIndex, FollowThroughIndex.
2. Indexes/ChatMarkdownIndex.md — table header row per Structure.md; starter note if empty.
3. Indexes/FollowThroughIndex.md — table header per Structure.md.
4. Indexes/InboxFileIndex.md — only if owner confirmed inbox capabilities exist.

Do NOT create Inbox/ or other Capability-provisioned folders in this pass.

After creation:
- Offer IndexHealthCheck re-run
- Offer first refresh via Capabilities/Indexing/Prompt.md

Out of scope: commit, push, source file moves, bulk metadata sweep.

End with exactly one fenced text handoff:
Summary
Files Changed
Planning Files To Review
Questions Added Or Changed
Next Recommended Task
```

## Prompt history

- **2026-06-06 (v2):** Clean-root paths; health check recommendation.
- **2026-05-28 (v1):** Initial Setup prompt.

## Related

- [WorkflowIndex.md](WorkflowIndex.md)
