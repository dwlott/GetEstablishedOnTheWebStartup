<!--
IndexTitle: GEOTW Self-Provisioning Promotion Plan
IndexDescription: Staged plan for promoting GetEstablishedOnTheWeb from trimmed product subset to self-provisioning web-presence archetype host.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-06-19
-->

# GEOTW Self-Provisioning Promotion Plan

## Purpose

Plan the shift from `GetEstablishedOnTheWeb` as a trimmed product repository to
`GetEstablishedOnTheWeb` as a self-provisioning web-presence archetype host that
can produce `GetEstablishedOnTheWebStartup`.

This is a planning document. It does not perform the GEOTW receive pass.

## Target State

`GetEstablishedOnTheWeb` should eventually carry:

- canonical web content and publishing plans;
- the WebPresence Capability pack;
- enough self-provisioning core to audit, harmonize, initialize, and package a
  web-presence starter;
- a dedicated packaging profile/spec for `GetEstablishedOnTheWebStartup`.

## Preserve Boundaries

Do not bulk-copy:

- host method Plans;
- host Intake or Archive history;
- private owner or commissioned material;
- local-only/generated automation unless GEOTW adopts it;
- code-assisted indexing as default starter behavior.

## Candidate Receive Additions

Review these for GEOTW in a future receive pass:

| Candidate | Reason | Notes |
| --- | --- | --- |
| `CapabilityCreate` | GEOTW can promote web-presence workflows into Capabilities. | Universal self-provisioning core. |
| `CapabilityHarmonize` | GEOTW can compare pack/core drift with host. | Include clean-root and self-provisioning readiness modes. |
| `CapabilityAudit` | GEOTW can audit routing, registry, and readiness. | Review-only by default. |
| `RepositoryInitialize` | GEOTW can initialize related web-presence repos. | Needs GEOTW identity/profile guidance. |
| `StarterRepositoryPackage` | GEOTW can produce `GetEstablishedOnTheWebStartup`. | Requires a WebPresence repair spec before active use. |
| `CodeAssistedIndexing` | Optional generated nav index support. | Keep opt-in; do not make default starter behavior. |
| `GoogleBusinessProfile` | WebPresence local profile planning. | Planned Capability first. |
| `YelpBusinessProfile` | WebPresence local profile planning. | Planned Capability first. |

## Staged Sequence

1. Host defines the self-provisioning model and WebPresence pack.
2. Host adds planned Google/Yelp Capability definitions.
3. Host updates GEOTW receive workflow/spec to name self-provisioning promotion.
4. Run a GEOTW readiness review: decide which core Capabilities GEOTW should
   receive now versus later.
5. Implement a GEOTW receive pass with registry/router parity updates.
6. Add a `GetEstablishedOnTheWebStartup` repair spec before any packaging run.
7. Verify no bulk host Plans or private material were copied.

## Verification Checklist

- GEOTW `AGENTS.md` routes host-only work appropriately until local
  self-provisioning Capabilities are received.
- GEOTW `Capabilities/README.md`, `RouterIndex.md`, and
  `AgentCapabilityGuide.md` match folders on disk.
- GEOTW can route `GetEstablishedOnTheWebStartup` packaging to an active or
  explicitly planned workflow.
- Google/Yelp are planned or active Capabilities, not only content pages.
- WordPress group remains Draft until build boundaries are validated.
- No informal role metaphors appear in durable docs.

## Related

- [SelfProvisioningRepositoryModel.md](SelfProvisioningRepositoryModel.md)
- [WebPresenceCapabilityPack.md](WebPresenceCapabilityPack.md)
- [GEOTWCoreReceiveSpec.md](GEOTWCoreReceiveSpec.md)
- [GEOTWCoreReleaseWorkflow.md](GEOTWCoreReleaseWorkflow.md)
