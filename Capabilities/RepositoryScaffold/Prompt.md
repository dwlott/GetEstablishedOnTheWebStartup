<!--
IndexTitle: RepositoryScaffold Prompt
IndexDescription: Copy-ready prompt to show intended tree and route Capability Setup.
IndexType: Capability
CapabilityName: RepositoryScaffold
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-06
-->

# RepositoryScaffold Prompt

Read [Rules.md](Rules.md) and [IntendedRepositoryTree.md](IntendedRepositoryTree.md) before using this prompt.

```text
# Worker pass: RepositoryScaffold

Repository: <TARGET_PATH>

Read first:
- AGENTS.md
- Capabilities/RepositoryScaffold/README.md
- Capabilities/RepositoryScaffold/Rules.md
- Capabilities/RepositoryScaffold/IntendedRepositoryTree.md
- Workspace/README.md
- Standards/CapabilityProvisionedStructure.md

Goal:
Help the owner understand what folders exist today versus what appears later.
Keep the repository tidy — no improvised mkdir.

Workflow:
1. List [CORE] paths that exist now (brief).
2. Show IntendedRepositoryTree.md — distinguish CORE, CAPABILITY, WHEN NEEDED.
3. If Workspace boot files missing, offer RepositoryScaffold SetupPrompt.md (core only).
4. If owner wants a specific workflow (email, indexes, one-page site), route to
   that Capability's SetupPrompt.md — do not create paths here.
5. Recommend exactly one next Setup or GettingStarted task.

Do not:
- Pre-create empty Workspace subfolders
- mkdir Inbox/ or Indexes/ without the owning Capability Setup
- Edit OwnerGoals.md unless owner asks

End with one fenced handoff:
Summary, Current tree (CORE only), Recommended next Setup,
Files Changed, Questions Added Or Changed, Next Recommended Task
```

## Related

- [SetupPrompt.md](SetupPrompt.md)
- [IntendedRepositoryTree.md](IntendedRepositoryTree.md)
