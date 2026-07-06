<!--
IndexTitle: StarterRepositoryPackage Prompt
IndexDescription: Copy-ready worker prompt for packaging workspace repair pass.
IndexType: Capability
CapabilityName: StarterRepositoryPackage
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-07
-->

# StarterRepositoryPackage Prompt

Read [Rules.md](Rules.md) before using this prompt.

```text
# Worker pass: StarterRepositoryPackage

Packaging workspace: {{PACKAGING_WORKSPACE_PATH}}
Archetype host (do not edit): {{ARCHETYPE_HOST_PATH}}
Branch: main (if .git exists)

Read first:
- Capabilities/StarterRepositoryPackage/ConsumerRepairSpec.md
- Capabilities/StarterRepositoryPackage/ConsumerBootSnippets.md
- Capabilities/StarterRepositoryPackage/WorkflowIndex.md
- Capabilities/StarterRepositoryPackage/PackageChecklist.md
- Capabilities/StarterRepositoryPackage/Rules.md
- Capabilities/StarterRepositoryPackage/ScaffoldPolicy.md
- Capabilities/StarterRepositoryPackage/AgentConfigDetach.md

Goal:
Repair a fresh mirror of the archetype host into a consumer Get Established
Workspace starter. Use ConsumerRepairSpec lists — do not invent REMOVE/KEEP lists.

Required sequence (WorkflowIndex):
0. Confirm packaging workspace; record fresh mirror; GoogleDriveLink keep/trim.
1. Git + agent detach (Option A default if host origin).
2. Remove host trees (Intake, Archive/*, Automation GDrive refresh paths).
2c. Remove host-only Capability folders (ConsumerRepairSpec § E).
2d. Plans whitelist trim — keep 10 files only (ConsumerRepairSpec § G).
2b. Scaffold trim (Workspace child folders, Inbox, etc.).
3. Identity repair — full registry rewrite (RouterIndex, guide, README, AGENTS).
4. Path and link repair (host paths, Docs/*, Intake references).
6. Verify — PackageChecklist + ConsumerRepairSpec § K PowerShell.
6b. Index starter (ManualIndexing; last step).
7. Document manual ZIP + smoke test: Begin Quick Startup from AGENTS.md.

Never push to host remote. Never edit archetype host during this pass.

When instructions are wrong or incomplete:
- Record under "Instruction gaps found" in handoff.
- Do not leave learnings only in chat.

Out of scope:
- Editing the archetype host folder (record gaps for next host pass).
- git push unless owner explicitly requests a new non-host remote.
- Website build or deploy.
- ZIP automation.

End with exactly one fenced text handoff:
Summary
Packaging workspace
Archetype host
Fresh mirror (yes / no)
Git repair applied
Host-only paths removed
Capability folders remaining (count)
Plans files remaining (count)
Identity files changed
Starter indexed (yes / no; index files)
Instruction gaps found (host — next archetype pass)
Instruction enhancements applied (packaging workspace)
Package status (ready / not ready)
Files Changed
Planning Files To Review
Questions Added Or Changed
Next Recommended Task
```

## Prompt history

- **2026-06-07 (v3):** ConsumerRepairSpec, ConsumerBootSnippets, reordered steps
  (2c/2d before identity), extended handoff, instruction-gap fields.
- **2026-06-06 (v2):** Lazy scaffold trim; RepositoryScaffold in consumer package.
- **2026-06-05 (v1):** Initial draft for packaging workspace repair pass.
