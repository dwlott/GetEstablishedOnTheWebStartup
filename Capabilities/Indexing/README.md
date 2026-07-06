<!-- Index: Refresh markdown indexes and validate index health for repository navigation. -->
<!--
IndexTitle: Indexing Capability
IndexDescription: Shared index core - Indexes/ format/columns, one-time Setup, and read-only health check. The actual refresh is done by ManualIndexing (default) or CodeAssistedIndexing (opt-in).
IndexType: Capability
CapabilityName: Indexing
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-06-07
-->

# Indexing Capability

> **Shared index core.** This Capability defines the **index format**, the
> `Indexes/` structure, Setup, and the read-only health check. The two **indexing
> modes** that decide *who* keeps the indexes current live in separate
> Capabilities:
>
> | Mode | Capability | Default? |
> | --- | --- | --- |
> | Agent refreshes by hand (no scripts) | [ManualIndexing](../ManualIndexing/README.md) | **Yes — default** |
> | Automated/script-driven | [CodeAssistedIndexing](../CodeAssistedIndexing/README.md) | No — opt-in, may be absent |
>
> Manual indexing is the default. Code-assisted indexing is offered only when it
> is present in the registry and the owner consents.

- **Version:** 2
- **Tier:** Universal
- **Rules package status:** Active — README, Rules, Structure, SetupPrompt, Prompt, WorkflowIndex, IndexHealthCheck.
- **Capability status:** Active on archetype host — `Indexes/` provisioned 2026-06-07; consumer starter via StarterRepositoryPackage Step 6b.
- **Purpose:** Define the `Indexes/` format and provisioning; validate index readiness via health check before refresh. Mode Capabilities (ManualIndexing, CodeAssistedIndexing) reuse this core.
- **Inputs:** Source markdown under [Rules.md](Rules.md) source folders; existing index files; metadata standards.
- **Outputs:** Updated files under `Indexes/` only (refresh pass); health report (check pass).
- **WhenToUse:** For the index **format/columns**, one-time `Indexes/` **Setup**, or a read-only **health check**. To actually refresh the indexes after new files, use **ManualIndexing** (default) or **CodeAssistedIndexing** (opt-in).

## Start Here

[WorkflowIndex.md](WorkflowIndex.md) — Setup → health check → refresh.

| Pass | Entry |
| --- | --- |
| Health check (read-only) | [IndexHealthCheck.md](IndexHealthCheck.md) |
| Automated scan | [Run-IndexHealthCheck.ps1](../../Automation/IndexHealthCheck/Run-IndexHealthCheck.ps1) |
| Setup (first time) | [SetupPrompt.md](SetupPrompt.md) |
| Refresh | [Prompt.md](Prompt.md) or [IndexRefresh Skill](Skills/IndexRefresh/SKILL.md) |

## Provisioned Structure

| File | Role |
| --- | --- |
| [Structure.md](Structure.md) | Paths Setup may create; index column specs |
| [SetupPrompt.md](SetupPrompt.md) | One-time `Indexes/` provisioning |
| [Rules.md](Rules.md) | Operating rules and data boundaries |
| [Prompt.md](Prompt.md) | Operate pass (refresh indexes) |
| [IndexHealthCheck.md](IndexHealthCheck.md) | Read-only readiness validation |
| [IndexHealthReportTemplate.md](IndexHealthReportTemplate.md) | Durable health report shape |

## Data Boundaries

Reads `Workspace/` and planning content for index descriptions only. Full
boundaries in [Rules.md](Rules.md): write only under `Indexes/` during refresh;
health check writes nothing (optional report in `Plans/` when owner requests).

## Skills

| Skill | Status | Path |
| --- | --- | --- |
| IndexRefresh | Active pilot | [Skills/IndexRefresh/SKILL.md](Skills/IndexRefresh/SKILL.md) |

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | promoted workflow; Phase 6 index automation |
| **SourceSummary** | Health check + Indexes refresh on clean-root repos |
| **PromotionStatus** | Planned (until Indexes/ Setup on host) |
| **Dependencies** | MarkdownIndexMetadataStandard, IndexHealthStandard |
| **RelatedFiles** | WorkflowIndex.md, IndexHealthCheck.md, Prompt.md |
| **LastReviewed** | 2026-06-06 |
| **HarmonizationNotes** | v2 clean-root source folders; health check before refresh |

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-06-06 | 2 | Phase 6: WorkflowIndex, IndexHealthCheck, script, clean-root Rules | Self-describe before generating indexes | README, Rules, Structure, Prompt, SetupPrompt, WorkflowIndex, IndexHealthCheck |
| 2026-05-30 | 1 | IndexRefresh Skill scaffold | Runtime-neutral operate package | Skills/IndexRefresh/SKILL.md |
| 2026-05-28 | 1 | Parent template for new repos | Setup before operate | README, Structure, SetupPrompt, Prompt |

## Related

- [Rules.md](Rules.md)
- [../ManualIndexing/README.md](../ManualIndexing/README.md) — default mode
- [../CodeAssistedIndexing/README.md](../CodeAssistedIndexing/README.md) — optional mode
- [../../Standards/IndexHealthStandard.md](../../Standards/IndexHealthStandard.md)
- [../../Standards/CapabilityProvisionedStructure.md](../../Standards/CapabilityProvisionedStructure.md)
