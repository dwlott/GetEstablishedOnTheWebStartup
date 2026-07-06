<!--
IndexTitle: StarterRepositoryPackage Prompt
IndexDescription: Copy-ready worker prompt for packaging workspace repair pass.
IndexType: Capability
CapabilityName: StarterRepositoryPackage
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-07-06
-->

# StarterRepositoryPackage Prompt

Read [Rules.md](Rules.md) before using this prompt.

## Profile selection

| Profile | Host | Repair spec | Boot snippets |
| --- | --- | --- | --- |
| `GetEstablishedStartup` | `C:\Repositories\GetEstablished` | ConsumerRepairSpec.md | ConsumerBootSnippets.md |
| `GetEstablishedOnTheWebStartup` | `C:\Repositories\GetEstablishedOnTheWeb` | WebPresenceStartupRepairSpec.md | WebPresenceBootSnippets.md |

For WebPresence + WordPress extension after base packaging, also read
`WebPoweredStartupExtensionSpec.md`.

```text
# Worker pass: StarterRepositoryPackage

Packaging workspace: {{PACKAGING_WORKSPACE_PATH}}
Archetype host (do not edit): {{ARCHETYPE_HOST_PATH}}
Starter profile: {{STARTER_PROFILE}}
Branch: main (if .git exists)

Read first:
- Capabilities/StarterRepositoryPackage/{{REPAIR_SPEC}}
- Capabilities/StarterRepositoryPackage/{{BOOT_SNIPPETS}}
- Capabilities/StarterRepositoryPackage/WorkflowIndex.md
- Capabilities/StarterRepositoryPackage/PackageChecklist.md
- Capabilities/StarterRepositoryPackage/Rules.md
- Capabilities/StarterRepositoryPackage/ScaffoldPolicy.md
- Capabilities/StarterRepositoryPackage/AgentConfigDetach.md

Goal:
Repair a fresh mirror of the archetype host into the named starter profile.
Use the active repair spec lists — do not invent REMOVE/KEEP lists.

Required sequence (WorkflowIndex):
0. Confirm packaging workspace; record fresh mirror; profile + repair spec.
1. Git + agent detach (Option A default if host origin).
2. Remove host trees per active repair spec.
2c. Capability subset trim per active repair spec.
2d. Plans whitelist trim per active repair spec.
2b. Scaffold trim (Workspace child folders, etc.).
3. Identity repair — full registry rewrite (RouterIndex, guide, README, AGENTS).
4. Path and link repair (host paths, Docs/*, Intake references).
6. Verify — PackageChecklist + repair spec verification commands.
6b. Index starter (ManualIndexing; last step).
7. Document manual ZIP + smoke test: Begin Quick Startup from AGENTS.md.

Never push to host remote. Never edit archetype host during this pass.

When instructions are wrong or incomplete:
- Record under "Instruction gaps found" in handoff.
- Do not leave learnings only in chat.

Out of scope:
- Editing the archetype host folder (record gaps for next host pass).
- git push unless owner explicitly requests a new non-host remote.
- Production website launch or deploy.
- ZIP automation.

End with exactly one fenced text handoff:
Summary
Packaging workspace
Archetype host
Starter profile
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

- **2026-07-06 (v4):** Profile branch for GetEstablishedOnTheWebStartup;
  WebPresenceBootSnippets; WebPoweredStartupExtensionSpec reference.
- **2026-06-07 (v3):** ConsumerRepairSpec, ConsumerBootSnippets, reordered steps
  (2c/2d before identity), extended handoff, instruction-gap fields.
- **2026-06-06 (v2):** Lazy scaffold trim; RepositoryScaffold in consumer package.
- **2026-06-05 (v1):** Initial draft for packaging workspace repair pass.
