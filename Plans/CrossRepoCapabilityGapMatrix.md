<!--
IndexTitle: Cross-Repo Capability Gap Matrix
IndexDescription: Living inventory for CapabilityHarmonize passes involving GetEstablishedOnTheWebStartup.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-09-03
-->

# Cross-Repo Capability Gap Matrix

Living inventory for **CapabilityHarmonize** passes. Update a row when a
Capability is promoted, blended, or intentionally diverges.

## Repositories In Scope

| Repo | Path | Archetype | Notes |
| --- | --- | --- | --- |
| **GetEstablishedOnTheWebStartup** | `C:\Repositories\GetEstablishedOnTheWebStartup` | WebPresence + WordPress starter | This file — packaging + Universal lesson target |
| **MoverCalcsWeb** | `C:\Repositories\MoverCalcsWeb` | Commissioned (help + forum) | Bluehost hardening + multi-site WordPressSave source |
| **GetEstablishedOnTheWeb** | Product host | Product / archetype host | MoversForumParticipation v2; packaging source |
| **GetEstablished** | General method host | Non-web (books, resumes) | Not a WordPress method home |

## How To Use

1. Run **CapabilityHarmonize** with subject + source repos.
2. Add or update rows below; mark **Reconcile** vs **Intentional**.
3. Record recommendations in the target Capability changelog.

**Tier safety:** never push commissioned-only behavior onto universal/archetype
hosts without explicit promotion approval. No credentials or filled deploy
profiles in the starter.

---

## I. Self-Provisioning And Packaging

| Area | MoverCalcsWeb | GEOTWStartup | Reconcile? | Notes |
| --- | --- | --- | --- | --- |
| Self-provisioning core | Present | Present | Done | Required Yes set on both |
| Starter packaging | N/A | WebPresenceWordPress (**33** Caps) | Done | WordPressSave promoted 2026-09-03 |
| VerifyStarterPackage | N/A | WebPresenceWordPress profile | Intentional | Expects `Capabilities/WordPressSave/` |

## II. WordPress Group

| Capability | MoverCalcsWeb | GEOTWStartup | Reconcile? | Harmonize action |
| --- | --- | --- | --- | --- |
| WordPressMigrationBackup | Plan-level | **Active v4** (blended 2026-09-03) | Done | MoverCalcsWeb hardening ported |
| WordPressSave | **Active** — help + forum tracks | **Active v1** — single-site | Intentional | Promoted from MC pattern 2026-09-03 |
| BluehostDatabasePrep | Hardened source | Blended scripts + README | Done | Serialized rewrite, prefix guard |
| BluehostEmailDelivery | **Active** | N/A | Intentional | Never copy; see `Plans/WordPressMailDeliveryPlan.md` |
| CPanelEmail | N/A | **Active** | Intentional | Starter mailboxes/forwarders |
| AltitudeProOverlay | Commissioned Active | **Not shipped** | Intentional | Commissioned project repos only |
| StudioPressGenesisChildTheme | Folded into overlay | Active + defaults | Done | CommonTweaks stay on project repos |
| MirrorWebAssets | Active | Active | Intentional | Per-repo site manifests |
| SiteDeployProfiles | Filled MC profiles | Template README only | Intentional | Do not copy filled host profiles |

## III. Forum (GEOTW product, not starter)

| Capability | GetEstablishedOnTheWeb | MoverCalcsWeb | Notes |
| --- | --- | --- | --- |
| MoversForumParticipation | **Active v2** (2026-09-03) | N/A | Not shipped on starter |
| AltitudeForumCapability | N/A | **Active** | Never copy to starter |

## IV. Harmonization Log

| Date | Change |
| --- | --- |
| 2026-09-03 | WordPressSave Cap promoted; Bluehost SQL hardening; WordPressMailDeliveryPlan on this starter (GetEstablished is non-web) |
| 2026-07-23 | DRS → GEOTWStartup: Bluehost serialize-aware prep; Save deferred per packaging |

## Related

- `C:\Repositories\GetEstablishedOnTheWeb\Plans\CrossRepoCapabilityGapMatrix.md` — product + forum participant view
- `C:\Repositories\MoverCalcsWeb\Plans\CrossRepoCapabilityGapMatrix.md` — commissioned reference
- [WordPressMailDeliveryPlan.md](WordPressMailDeliveryPlan.md) — mailboxes vs WordPress outbound vs DNS
