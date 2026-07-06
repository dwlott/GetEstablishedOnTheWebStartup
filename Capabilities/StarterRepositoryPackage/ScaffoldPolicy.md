<!--
IndexTitle: Starter Repository Scaffold Policy
IndexDescription: Lazy scaffold rules for packaging GetEstablishedStartup — core now, Capability paths on demand.
IndexType: Capability
CapabilityName: StarterRepositoryPackage
CapabilityVersion: 2
IndexStatus: Draft
LastEdited: 2026-06-06
-->

# Starter Repository Scaffold Policy

Apply during [WorkflowIndex.md](WorkflowIndex.md) **Step 2b — Scaffold trim**.
Consumer starter repos stay **tidy**: only **core scaffold** ships in the ZIP;
Capability-owned folders appear when the owner runs Setup.

## Principle

| Layer | In starter ZIP? | Created by |
| --- | --- | --- |
| **Core scaffold** | Yes | This packaging pass |
| **Core Capabilities** | Yes (folders with real files) | Copied from host subset |
| **Capability scaffold** | No | Each Capability **SetupPrompt.md** when used |
| **Workspace child folders** | No | Owner task when real content exists |

Authoritative consumer router: [RepositoryScaffold](../RepositoryScaffold/README.md).
Growth map: [IntendedRepositoryTree.md](../RepositoryScaffold/IntendedRepositoryTree.md).

## Core Scaffold (Include)

```text
AGENTS.md
README.md
Capabilities/              <- consumer subset + RepositoryScaffold
Standards/
Plans/                     <- consumer setup subset
Ideas/README.md
Content/Website/Pages/
Workspace/
  README.md
  OwnerGoals.md            <- empty register
  OwnerPreferences.md      <- empty preferences scaffold
  ValuableReferences.md    <- empty reference register (Suggested tier)
```

## Remove From Packaging Workspace (Trim)

Empty or Capability-provisioned paths that must **not** ship in the starter:

```text
Inbox/
Content/OnePageBusinessWebsite/     <- OnePageWebsite workflow when adopted
Content/Product/                    <- empty product stub
Workspace/Assets/
Workspace/Documents/
Workspace/Drafts/
Workspace/Exports/
Workspace/Inbox/
Workspace/Intake/
Workspace/Notes/                    <- remove if only README/.gitkeep
Workspace/OpenQuestions/            <- remove if only README/.gitkeep
Workspace/References/
Workspace/Scratch/
Workspace/Templates/
**/.gitkeep under Workspace/        <- consumer uses real files, not empty stubs
AGENTS.md.placeholder
README.md.placeholder
STRUCTURE_MANIFEST.md               <- host skeleton manifest; confuses agents
```

Keep `Plans/OpenQuestions.md` at repo level for structured decisions — not
duplicate empty `Workspace/OpenQuestions/` unless owner already uses it.

**Exception — `Indexes/` ships populated.** Unlike other Capability-provisioned
paths, the starter is **pre-indexed** as the final packaging step (WorkflowIndex
Step 6b). Keep `Indexes/` (populated) and `Capabilities/ManualIndexing/` +
`Capabilities/Indexing/`; **exclude** `Capabilities/CodeAssistedIndexing/` so the
starter stays manual-only.

## RepositoryScaffold In Consumer Package

The packaging pass **must include**:

```text
Capabilities/RepositoryScaffold/
  README.md, Rules.md, Prompt.md, SetupPrompt.md, IntendedRepositoryTree.md
```

Register in consumer `Capabilities/README.md` and `AgentCapabilityGuide.md`.

## Offer Intended Tree After Download

GettingStarted and RepositoryScaffold should offer
[IntendedRepositoryTree.md](../RepositoryScaffold/IntendedRepositoryTree.md)
when the owner asks what the repository will contain — without creating folders.

## Related

- [ConsumerRepairSpec.md](ConsumerRepairSpec.md)
- [WorkflowIndex.md](WorkflowIndex.md)
- [PackageChecklist.md](PackageChecklist.md)
- [Rules.md](Rules.md)
- [CapabilityProvisionedStructure.md](../../Standards/CapabilityProvisionedStructure.md)
