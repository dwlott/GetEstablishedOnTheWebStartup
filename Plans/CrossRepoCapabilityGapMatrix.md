<!--
IndexTitle: Cross-Repo Capability Gap Matrix
IndexDescription: Living inventory for CapabilityHarmonize passes involving GetEstablishedOnTheWebStartup.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-07-23
-->

# Cross-Repo Capability Gap Matrix

Living inventory for **CapabilityHarmonize** passes. Update a row when a
Capability is promoted, blended, or intentionally diverges.

## Repositories In Scope

| Repo | Path | Archetype | Notes |
| --- | --- | --- | --- |
| **GetEstablishedOnTheWebStartup** | `C:\Repositories\GetEstablishedOnTheWebStartup` | WebPresence + WordPress starter | This file — packaging + Universal lesson target |
| **DansRepairService** | `C:\Repositories\DansRepairService` | Commissioned instance | Latest go-live reference (2026-07-14); keep site data local |
| **GetEstablishedOnTheWeb** | Product host (when present) | Product / archetype host | Source for packaging profile |

## How To Use

1. Run **CapabilityHarmonize** with subject + source repos.
2. Add or update rows below; mark **Reconcile** vs **Intentional**.
3. Record recommendations in the target Capability changelog.

**Tier safety:** never push commissioned-only behavior onto universal/archetype
hosts without explicit promotion approval. No credentials or filled deploy
profiles in the starter.

---

## I. Self-Provisioning And Packaging

| Area | DansRepairService | GEOTWStartup | Reconcile? | Notes |
| --- | --- | --- | --- | --- |
| Self-provisioning core | Present | Present | Done | Required Yes set on both |
| Starter packaging | Consumer + WebPresence specs | WebPresenceWordPress (31 Caps) | Done | Two-phase repair + WebPowered extension |
| VerifyStarterPackage | Present | WebPresenceWordPress profile | Intentional | Starter verify includes OpenQuestions checks |

## II. WordPress Group

| Capability | DansRepairService | GEOTWStartup | Reconcile? | Harmonize action |
| --- | --- | --- | --- | --- |
| WordPressMigrationBackup | Active + Bluehost lessons | Active v3 (blended 2026-07-23) | Done | Serialize-aware prep + SiteDeployProfiles |
| WordPressSave | Commissioned Active Cap | **Plans + Automation only** | Intentional | Do not add `Capabilities/WordPressSave/` here |
| AltitudeProOverlay | Commissioned Active | **Not shipped** | Intentional | Commissioned project repos only; Genesis holds archetype defaults |
| StudioPressGenesisChildTheme | Active + overlay pointer | Active + 360×76 / 1200 defaults | Done | CommonTweaks stay on project repos |
| MirrorWebAssets | Active | Active | Intentional | Per-repo site manifests |
| SiteDeployProfiles | Filled DRS profile | Template README only | Intentional | Do not copy filled host profiles |

## III. Harmonization Log

| Date | Change |
| --- | --- |
| 2026-07-23 | DRS → GEOTWStartup: Bluehost serialize-aware prep + gap matrix; Cap shells for Save/Overlay deferred per WebPresenceWordPress packaging |

## Related

- [SelfProvisioningRepositoryModel.md](SelfProvisioningRepositoryModel.md)
- [StartupModernizationAudit-20260716.md](StartupModernizationAudit-20260716.md)
- [Capabilities/CapabilityHarmonize/README.md](../Capabilities/CapabilityHarmonize/README.md)
- [Capabilities/StarterRepositoryPackage/WebPresenceStartupRepairSpec.md](../Capabilities/StarterRepositoryPackage/WebPresenceStartupRepairSpec.md)
