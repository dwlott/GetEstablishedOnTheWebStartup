<!--
IndexTitle: Self-Provisioning Repository Model
IndexDescription: Formal model for mature repositories that can produce or maintain starter repositories for their own archetype.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-06-19
-->

# Self-Provisioning Repository Model

## Purpose

Define how a mature repository in the Get Established family can become a
**self-provisioning archetype host** without copying unrelated host material,
commissioned content, or private owner files.

Use formal terms:

- **Self-provisioning repository**
- **Archetype host**
- **Starter repository**
- **Capability pack**
- **Commissioned instance**

Do not use informal metaphors for repository roles in durable instructions.

## Definition

A **self-provisioning repository** is a mature archetype host that carries the
core Capabilities needed to:

- audit its own readiness;
- harmonize with related repositories;
- initialize a new repository shell;
- package a starter repository for its own archetype;
- refresh or validate repository indexes;
- keep routing and registry surfaces in parity.

Self-provisioning does **not** mean every repository carries every Capability.
It means the repository has the approved core needed to produce and maintain a
starter for its own archetype.

## Universal Self-Provisioning Core

| Capability | Role | Required for every mature self-provisioning repo? |
| --- | --- | --- |
| `SituationalAwareness` | Runtime/source-of-truth orientation | Yes |
| `GitHubWorkflow` | Git, GitHub, commit/push routing | Yes |
| `RepositoryScaffold` | Core folder repair and intended growth tree | Yes |
| `RepositoryInitialize` | Bootstrap a new or skeletal repository shell | Yes |
| `StarterRepositoryPackage` | Repair a host copy into a starter repository | Yes, with archetype-specific profile |
| `CapabilityCreate` | Create durable Capability folders correctly | Yes |
| `CapabilityHarmonize` | Compare and align Capabilities or tree patterns | Yes |
| `CapabilityAudit` | Audit catalog, readiness, routing parity | Yes |
| `Indexing` | Shared index structure and health-check core | Yes |
| `ManualIndexing` | Default no-script index refresh | Yes |
| `CodeAssistedIndexing` | Optional generated index refresh | Optional/adopted |
| `ImportCapabilitiesFromRepository` | Import approved Capability modules | Recommended |
| `ImportOwnerPreferencesFromRepository` | Import owner preferences from a prior repo | Recommended |

## Archetype Capability Packs

An archetype pack is a named group of Capabilities that travel together for a
domain. The self-provisioning core handles repository mechanics; the archetype
pack handles domain work.

Examples:

| Pack | Purpose | Canonical plan |
| --- | --- | --- |
| `WebPresence` | Website, local profile basics, WordPress/publishing, starter support | [WebPresenceCapabilityPack.md](WebPresenceCapabilityPack.md) |
| Future book-writing pack | Manuscript, chapter, review, citation workflows | Not implemented |
| Code/system pack | Codebase standards, generated indexes, build/test workflows | Repo-specific, for example MoverCalcs |

## Repository Roles

| Repository | Current role | Direction |
| --- | --- | --- |
| `GetEstablished` | Method host and current self-provisioning core host | Maintain universal core, standards, harmonization, and archetype-pack plans. |
| `GetEstablishedOnTheWeb` | Product repository with canonical website content | Promote toward self-provisioning web-presence archetype host before producing `GetEstablishedOnTheWebStartup`. |
| `US1Movers` | Commissioned web-presence instance | Keep commissioned rules local while adopting applicable core and web-presence patterns. |

## Copy Rules

Before copying Capabilities between repositories, classify each item:

| Classification | Copy rule |
| --- | --- |
| Universal core | Copy to mature repositories when they are approved to become self-provisioning. |
| Archetype pack | Copy only to repositories that implement that archetype. |
| Host-only method development | Keep on `GetEstablished` unless a target repo explicitly needs that method role. |
| Product/private content | Keep only in the product or commissioned repository that owns it. |
| Generated or local automation | Copy only when the target repo has adopted that automation. |

## GEOTW Direction

`GetEstablishedOnTheWeb` should not remain only a trimmed product subset if it is
expected to produce `GetEstablishedOnTheWebStartup`. It should receive or develop
the self-provisioning core needed for its web-presence archetype, while keeping:

- canonical website content in `GetEstablishedOnTheWeb`;
- bulk method plans in `GetEstablished`;
- private or commissioned files out of reusable starters;
- code-assisted indexing opt-in, not default.

## Verification

A repository is self-provisioning-ready when:

- `AGENTS.md`, `Capabilities/RouterIndex.md`, `Capabilities/AgentCapabilityGuide.md`,
  and `Capabilities/README.md` route starter packaging and initialization
  consistently;
- `StarterRepositoryPackage` can name the archetype host, packaging workspace,
  and starter output;
- `CapabilityHarmonize` can compare self-provisioning readiness across repos;
- `CapabilityAudit` can verify registry and routing parity;
- no informal role metaphors appear in durable instructions;
- starter packaging excludes private, commissioned, host-only, and generated
  material unless explicitly approved.

## Related

- [RepositoryArchetypeAndCapabilityTiers.md](../Standards/RepositoryArchetypeAndCapabilityTiers.md)
- [RepositoryCoreStandard.md](../Standards/RepositoryCoreStandard.md)
- [WebPresenceCapabilityPack.md](WebPresenceCapabilityPack.md)
- [GEOTWCoreReleaseWorkflow.md](GEOTWCoreReleaseWorkflow.md)
- [CapabilityHarmonize](../Capabilities/CapabilityHarmonize/README.md)
- [StarterRepositoryPackage](../Capabilities/StarterRepositoryPackage/README.md)
