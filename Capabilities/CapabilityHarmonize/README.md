<!-- Index: Compare a Capability across repositories and propose best-of-both blend options. -->
<!--
IndexTitle: CapabilityHarmonize Capability
IndexDescription: Compare Capabilities, repository tree patterns, or self-provisioning readiness across repositories and propose lightweight blend options.
IndexType: Capability
CapabilityName: CapabilityHarmonize
CapabilityVersion: 3
IndexStatus: Active
LastEdited: 2026-06-19
-->

# CapabilityHarmonize Capability

- **Version:** 3
- **Tier:** Universal (meta Capability; runs in any repo, compares across repos)
- **Purpose:** Give humans and agents one consistent way to compare a Capability,
  repository tree pattern, Capability pack, or self-provisioning readiness across
  repositories, name the strengths of each, and propose how to **blend the best
  of both** or enhance them toward a uniform, optimal result. Comparison and
  recommendation — **not** heavy change tracking.
- **Inputs:** The Capability, capability area, repository tree shape,
  self-provisioning core, or Capability pack to compare; the repositories or
  paths that hold each version; optional goals; optional existing
  [CrossRepoCapabilityGapMatrix.md](../../Plans/CrossRepoCapabilityGapMatrix.md).
- **Outputs:** A short comparison **head start**: per-source inventory, each
  version's strengths, the goals for the blended result, the differences worth
  reconciling vs the ones that are intentional, and 2–3 blend/enhance options
  with a recommended path. Optionally a brief report or gap-matrix row. No edits
  to the compared Capabilities unless the user approves an implementation pass.
- **WhenToUse:** You maintain the same Capability in several repositories, the implementations are evolving ("learning"), and you want a repeatable head start on comparison and blending instead of re-deriving it each time. Also before adopting or aligning a Capability between repos.
- **Does not replace:** **CapabilityCreate** (authors a new Capability), **CapabilityDefinition** (defines the term), or **Indexing** (refreshes discoverability).

## What "blend the best of both" means here

Two implementations of the same Capability usually each do something better. This Capability's job is to surface those strengths quickly and recommend a single improved version — while keeping intentional, profile-driven differences (for example which source folders a repo indexes) and respecting Capability **tier** (do not push a commissioned-only behavior onto a universal host).

Keep it a **head start**, not a ledger: capture durable lessons in the target Capability's own changelog or lessons log, not here.

## Outputs shape (lightweight)

1. Subject — Capability/area and the sources compared.
2. Per-source inventory — version, key files, distinctive strengths.
3. Goals — what "uniform and optimal" should mean for this Capability.
4. Reconcile vs intentional — differences to align vs profile-driven differences to keep.
5. Blend / enhance options — 2–3 options, each with a one-line trade-off and rough effort.
6. Recommendation — the best-of-both path, with a tier-safety note.

## Clean-Root Migration

For repository tree harmonization, use [CleanRootMigration.md](CleanRootMigration.md).
It captures lessons from a commissioned instance's clean-root migration: map legacy roots
before moving, preserve commissioned content under standard roots, refresh boot
and routing files, remove compatibility-bridge language after migration, and
smoke-test workflow intents before calling the pass complete.

## Self-Provisioning Readiness

For repository self-provisioning readiness, compare against
[SelfProvisioningRepositoryModel.md](../../Plans/SelfProvisioningRepositoryModel.md).
Keep this separate from clean-root migration:

- clean-root migration asks whether the tree, paths, and routing surfaces match;
- self-provisioning readiness asks whether the repository can audit, harmonize,
  initialize, package, and maintain a starter for its own archetype.

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | promoted workflow |
| **SourceSummary** | Compare and harmonize Capabilities across repositories |
| **PromotionStatus** | Active |
| **Dependencies** | CapabilityMetadataStandard, RepositoryArchetypeAndCapabilityTiers |
| **RelatedFiles** | Rules.md, Prompt.md, CleanRootMigration.md |
| **LastReviewed** | 2026-06-19 |
| **HarmonizationNotes** | Compare and recommend first; for tree parity use the clean-root migration playbook; for starter readiness use the self-provisioning model |

## Related

- Operating rules and blend principles: [Rules.md](Rules.md)
- Worker / planner entry: [Prompt.md](Prompt.md)
- Clean-root repository tree migration: [CleanRootMigration.md](CleanRootMigration.md)
- Self-provisioning model: [SelfProvisioningRepositoryModel.md](../../Plans/SelfProvisioningRepositoryModel.md)
- WebPresence pack: [WebPresenceCapabilityPack.md](../../Plans/WebPresenceCapabilityPack.md)
- Cross-repo inventory artifact: [CrossRepoCapabilityGapMatrix.md](../../Plans/CrossRepoCapabilityGapMatrix.md)
- Reference instance: a commissioned instance's `Capabilities/CapabilityHarmonize/`
- Meta companions: [CapabilityCreate](../CapabilityCreate/README.md), [CapabilityDefinition](../CapabilityDefinition/README.md)
- Tiers: [RepositoryArchetypeAndCapabilityTiers.md](../../Standards/RepositoryArchetypeAndCapabilityTiers.md)

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-05-28 | 1 | Initial canonical CapabilityHarmonize meta-module (cross-repo compare + best-of-both blend) | One consistent comparison method; a commissioned instance is the reference | README, Rules, Prompt |
| 2026-06-19 | 2 | Added clean-root migration playbook from a commissioned instance's harmonization lessons | Tree parity needs a repeatable checklist so commissioned repos can converge without re-deriving path moves, link refreshes, and smoke tests | README, Rules, Prompt, CleanRootMigration |
| 2026-06-19 | 3 | Added self-provisioning readiness comparison mode | Mature archetype hosts need a readiness compare distinct from tree migration | README, Rules, Prompt |
| 2026-07-23 | 3 | DRS → GEOTWStartup blend: Bluehost serialize-aware prep + gap matrix; Save/Overlay Cap shells deferred | WebPresenceWordPress packaging keeps Save as Plans+Automation and Overlay commissioned-only | Gap matrix, WordPressMigrationBackup, BluehostDatabasePrep |
