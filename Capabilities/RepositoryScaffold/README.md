<!-- Index: On-demand repository scaffolding — core shell only; Capability paths via Setup prompts. -->
<!--
IndexTitle: RepositoryScaffold Capability
IndexDescription: Maintain core starter scaffold, show intended growth tree, route Capability Setup when folders are needed.
IndexType: Capability
CapabilityName: RepositoryScaffold
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-06
-->

# RepositoryScaffold Capability

- **Version:** 1
- **Tier:** Universal (ships in **Get Established** consumer starter)
- **Purpose:** Keep the downloaded repository **tidy**: only **core scaffold**
  exists on day one. Show the **intended tree** as the project grows. Create
  Capability-owned folders **only** when the owner runs that Capability's
  **SetupPrompt.md** (or this Capability's core **SetupPrompt.md** for missing
  Workspace boot files).
- **Inputs:** Owner question about folders, setup, or "what should this repo contain?"
- **Outputs:** Intended tree summary; routed Setup handoff; optional core scaffold repair.
- **WhenToUse:** Owner asks what folders to add; after download when Workspace feels
  empty; before improvising `mkdir` during unrelated tasks.

## Start Here

- Growth map: [IntendedRepositoryTree.md](IntendedRepositoryTree.md)
- Core-only repair: [SetupPrompt.md](SetupPrompt.md)
- Owner conversation: [Prompt.md](Prompt.md)

## Core Versus Capability Scaffold

| Layer | Exists in starter ZIP | Created by |
| --- | --- | --- |
| **Core scaffold** | Yes | StarterRepositoryPackage pass + SetupPrompt if missing |
| **Capability scaffold** | No until used | Each Capability's SetupPrompt.md |
| **Workspace child folders** | No until content | Owner task + README in new folder |

See [Rules.md](Rules.md) and [Standards/CapabilityProvisionedStructure.md](../../Standards/CapabilityProvisionedStructure.md).

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | StarterRepositoryPackage scaffold policy |
| **SourceSummary** | Lazy scaffold for consumer Get Established starter |
| **PromotionStatus** | Active |
| **Dependencies** | CapabilityProvisionedStructure, GettingStarted |
| **RelatedFiles** | Rules.md, Prompt.md, SetupPrompt.md, IntendedRepositoryTree.md |
| **LastReviewed** | 2026-06-06 |
| **HarmonizationNotes** | Consumer starter includes this; host archetype may omit if not needed |

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-06-06 | 1 | Initial Universal scaffold router for tidy starter repos | Folders when used, not before | README, Rules, Prompt, SetupPrompt, IntendedRepositoryTree |

## Related

- Packaging pass: [StarterRepositoryPackage](../StarterRepositoryPackage/README.md)
- [ScaffoldPolicy.md](../StarterRepositoryPackage/ScaffoldPolicy.md)
- [GettingStarted](../GettingStarted/README.md)
