<!-- Index: Initialize an optimal repository shell with full capability catalog. -->
<!--
IndexTitle: RepositoryInitialize Capability
IndexDescription: Bootstrap optimal-repo shell, AGENTS.md, registry, and profile-specific structure without pre-creating intake trees.
IndexType: Capability
CapabilityName: RepositoryInitialize
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-07
-->

# RepositoryInitialize Capability

- **Version:** 1
- **Tier:** Archetype (operate behavior applies to any repo in the family)
- **Purpose:** Turn an empty or skeletal repository into an optimal-repo shell with universal **AGENTS.md**, full capability registry (Active copies + Planned stubs), standards, and project map — without creating Capability-owned inbox or index trees until Setup runs.
- **Inputs:** Target repository path; **profile** (`archetypeHost`, `commissionedWebPresence`, `agenticMeta`, `codeRepo`); identity strings (name, purpose, parent repo if child).
- **Outputs:** Core shell files per [Structure.md](Structure.md) and [Rules.md](Rules.md).
- **WhenToUse:** New repo after clone; skeletal repo (for example Agentic); re-alignment pass when owner asks to bootstrap or initialize.
- **Replaces:** `Docs/Prompts/AgentStartRepositoryFoundation.md` (GEOTW-branded foundation prompt).

## Profiles

| Profile | Use for |
| --- | --- |
| `archetypeHost` | GetEstablishedOnTheWeb-like parent |
| `commissionedWebPresence` | Business envelope (commissioned-instance-like) |
| `agenticMeta` | Multi-agent workflow hub (Agentic) |
| `codeRepo` | code-repository-style; Automation profile only |

See [Rules.md](Rules.md) for per-profile registry and folder rules.

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | promoted workflow |
| **SourceSummary** | Bootstrap optimal repository shell for archetype or envelope |
| **PromotionStatus** | Active |
| **Dependencies** | RepositoryCoreStandard, Capability tiers |
| **RelatedFiles** | Rules.md, Prompt.md |
| **LastReviewed** | 2026-06-05 |
| **HarmonizationNotes** | Use after GitHubWorkflow creates clone, or on skeletal repos |

## Related

- Worker entry: [Prompt.md](Prompt.md)
- Shell paths: [Structure.md](Structure.md)
- Optional shell-only mkdir: [SetupPrompt.md](SetupPrompt.md)
- New repo first: **GitHubWorkflow** [SetupPrompt.md](../GitHubWorkflow/SetupPrompt.md), then this Capability
- Human copy guide: [TemplateGuidance.md](../../Setup/TemplateGuidance.md)

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-05-28 | 1 | Initial Capability; migrates AgentStartRepositoryFoundation | Full catalog as registry rows; lazy Capability Setup | README, Rules, Prompt, Structure, SetupPrompt |
