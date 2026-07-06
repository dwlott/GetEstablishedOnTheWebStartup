<!--
IndexTitle: RepositoryInitialize Setup Prompt
IndexDescription: Optional shell-only mkdir pass when init should not run full Prompt.
IndexType: Capability
CapabilityName: RepositoryInitialize
CapabilityVersion: 1
LastEdited: 2026-05-28
-->

# RepositoryInitialize Setup Prompt

Use when the owner wants **folder README stubs only** without a full init content pass. Full bootstrap: [Prompt.md](Prompt.md).

```text
# Worker pass: RepositoryInitialize Setup (shell only)

Repository: {{REPOSITORY_NAME}}
Branch: main
Profile: {{PROFILE}}

Read Docs/Capabilities/RepositoryInitialize/Structure.md and Rules.md.

Goal:
Create only README.md stub files and empty-folder pointers listed in Structure.md for the profile. Do not copy Capability Prompt bodies or write AGENTS.md unless user asked for full Initialize in the same session.

Allowed: mkdir and README.md under paths in Structure.md for the selected profile.

Forbidden: Inbox/, Indexes/, Capability Prompt.md copies, commissioned intake paths.

End with exactly one fenced text handoff: Summary, Files Changed, Planning Files To Review, Questions Added Or Changed, Next Recommended Task.
```

## Prompt history

- **2026-05-28 (v0):** Optional shell-only setup pass.
