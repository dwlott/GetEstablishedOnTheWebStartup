<!--
IndexTitle: RepositoryScaffold Setup Prompt
IndexDescription: Create or repair core Workspace boot files only — no Capability-owned paths.
IndexType: Capability
CapabilityName: RepositoryScaffold
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-06
-->

# RepositoryScaffold Setup Prompt

Read [Rules.md](Rules.md). This Setup creates **core Workspace boot files only**.

```text
# Worker pass: RepositoryScaffold Setup (core only)

Repository: <TARGET_PATH>

Read first:
- AGENTS.md
- Capabilities/RepositoryScaffold/Rules.md
- Workspace/README.md (create from host template if missing)
- Standards/CapabilityProvisionedStructure.md

Goal:
Ensure core Workspace boot files exist. Do not create Inbox/, Indexes/,
Content/OnePageBusinessWebsite/, or empty Workspace child folders.

Create or repair if missing:
- Workspace/README.md (tidy Workspace policy)
- Workspace/OwnerGoals.md (empty register scaffold if new repo)
- Workspace/OwnerPreferences.md (empty preferences scaffold if new repo)

Do not:
- mkdir Inbox/, Indexes/, or Capability-owned paths
- Add .gitkeep scaffolds under Workspace/
- Copy host-only Plans or Intake trees

After changes, show IntendedRepositoryTree.md [CORE] section to owner.

End with one fenced handoff:
Summary, Files Changed, Core scaffold status,
Next Recommended Task (often GettingStarted or one Capability Setup)
```

## Related

- [Prompt.md](Prompt.md)
- [IntendedRepositoryTree.md](IntendedRepositoryTree.md)
