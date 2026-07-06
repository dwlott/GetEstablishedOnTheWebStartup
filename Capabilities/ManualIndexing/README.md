<!-- Index: Default agent-driven indexing of new files into Indexes/ with no automation. -->
<!--
IndexTitle: ManualIndexing Capability
IndexDescription: Default, always-present indexing mode; an agent updates Indexes/ on request without running automation.
IndexType: Capability
CapabilityName: ManualIndexing
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-07
-->

# ManualIndexing Capability

- **Version:** 1
- **Tier:** Universal
- **Status:** Active — the **default** indexing mode. Always present.
- **Purpose:** Keep `Indexes/` current by having an **agent** read newly created
  or changed files and update the indexes on request. No scripts, schedulers, or
  "mirroring" code run. This is the calm default for owners who do not want
  automated code touching the repository.
- **WhenToUse:** After new source files are added; when the owner asks to refresh
  indexes; as the last step of `StarterRepositoryPackage` so the starter ships
  pre-indexed.
- **Inputs:** Source markdown under the source folders in [Rules.md](Rules.md);
  existing index files; index column specs from
  [../Indexing/Structure.md](../Indexing/Structure.md).
- **Outputs:** Updated files under `Indexes/` only.

## Why Manual Is The Default

Some owners are wary of letting automated code run against their repository.
Manual indexing removes that concern: an agent does the work, in small reviewable
passes, only when asked. This works well when the repository is used only a few
times a day. If the repository is used more heavily, the optional
[CodeAssistedIndexing](../CodeAssistedIndexing/README.md) Capability can be
offered — but only when it is present in the registry.

## Start Here

[WorkflowIndex.md](WorkflowIndex.md) — manual refresh flow.

| Pass | Entry |
| --- | --- |
| Refresh `Indexes/` by hand (agent) | [Prompt.md](Prompt.md) |
| Operating rules + re-offer logic | [Rules.md](Rules.md) |
| Index format / health check (shared core) | [../Indexing/](../Indexing/README.md) |

## Relationship To Other Indexing Capabilities

| Capability | Role | Present by default |
| --- | --- | --- |
| **ManualIndexing** (this) | Agent-driven refresh; the default | Yes |
| [Indexing](../Indexing/README.md) | Shared index format + health-check core | Yes |
| [CodeAssistedIndexing](../CodeAssistedIndexing/README.md) | Optional automated/script indexing | No — opt-in only |

If `CodeAssistedIndexing` is **not** present in the registry, agents do not know
it exists and never offer it. Manual indexing stays the silent default.

## Data Boundaries

Reads source folders for index descriptions only; writes only under `Indexes/`.
Full boundaries in [Rules.md](Rules.md). Never moves, renames, or rewrites source
bodies.

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | promoted workflow; split from Indexing v2 |
| **SourceSummary** | Default, always-present indexing mode so owners get fast chat without running automation |
| **PromotionStatus** | Active |
| **Dependencies** | Indexing (shared format + health check), SituationalAwareness, Workspace/OwnerPreferences |
| **RelatedFiles** | WorkflowIndex.md, Rules.md, Prompt.md |
| **LastReviewed** | 2026-06-07 |
| **HarmonizationNotes** | Pairs with optional CodeAssistedIndexing; reuses Indexing/Structure.md and IndexHealthCheck.md |

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-06-07 | 1 | Initial Capability: default agent-driven indexing split from Indexing | Make manual the calm default; offer automation only on consent | README, WorkflowIndex, Rules, Prompt |

## Related

- [Rules.md](Rules.md)
- [Prompt.md](Prompt.md)
- [../Indexing/Structure.md](../Indexing/Structure.md)
- [../Indexing/IndexHealthCheck.md](../Indexing/IndexHealthCheck.md)
- [../../Workspace/OwnerPreferences.md](../../Workspace/OwnerPreferences.md)
