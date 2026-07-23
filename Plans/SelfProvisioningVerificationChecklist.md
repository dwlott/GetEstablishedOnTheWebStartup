<!--
IndexTitle: Self-Provisioning Verification Checklist
IndexDescription: Verification checklist for self-provisioning terminology, routing, and WebPresence promotion across GetEstablished and GEOTW.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-06-19
-->

# Self-Provisioning Verification Checklist

## Purpose

Verify that self-provisioning repository guidance is discoverable, uses formal
terminology, and does not blur host, product, starter, or commissioned boundaries.

## Scope

Primary host:

```text
C:\Repositories\GetEstablished
```

Related product repository:

```text
C:\Repositories\GetEstablishedOnTheWeb
```

This checklist may be run as review-only. Product repo edits require a separate
GEOTW receive or promotion pass.

## Host Checks

- `Standards/RepositoryArchetypeAndCapabilityTiers.md` defines:
  - self-provisioning repository;
  - archetype host;
  - starter repository;
  - Capability pack;
  - commissioned instance.
- `Plans/SelfProvisioningRepositoryModel.md` lists the universal
  self-provisioning core.
- `Plans/WebPresenceCapabilityPack.md` lists the WebPresence pack and marks
  Google/Yelp as planned until promoted.
- `Capabilities/StarterRepositoryPackage/` names `GetEstablishedStartup` and
  `GetEstablishedOnTheWebStartup` as **Active** profiles (each with its repair
  spec).
- `Capabilities/CapabilityHarmonize/` supports self-provisioning readiness
  comparison separately from clean-root migration.
- `Capabilities/README.md`, `RouterIndex.md`, and `AgentCapabilityGuide.md`
  include planned `GoogleBusinessProfile` and `YelpBusinessProfile` rows.

## GEOTW Checks

- GEOTW still owns canonical website content under `Content/Website/`.
- GEOTW receive docs identify self-provisioning promotion as a staged pass, not
  a bulk host copy.
- GEOTW registry/router/guide match folders on disk after any future receive.
- `GetEstablishedOnTheWebStartup` uses
  `WebPresenceStartupRepairSpec.md`; router/registry include the WordPress
  group and Planned WordPressSave / AltitudeProOverlay shells.
- GEOTW does not receive bulk host `Plans/`, private host automation, Intake,
  Archive history, or commissioned-only material by default.

## Terminology Checks

Use only formal terms in durable repository files:

- self-provisioning repository;
- archetype host;
- starter repository;
- Capability pack;
- WebPresence pack;
- commissioned instance.

Do not introduce informal role metaphors into durable docs.

## Suggested Searches

```powershell
rg -n "self-provisioning|GetEstablishedOnTheWebStartup|WebPresence" C:\Repositories\GetEstablished -g "*.md"
rg -n "GoogleBusinessProfile|YelpBusinessProfile" C:\Repositories\GetEstablished -g "*.md"
```

Also search for any informal role metaphor introduced during the planning
conversation before committing durable docs.

## Pass Criteria

- No informal role metaphors in durable docs.
- Host routes self-provisioning model, WebPresence pack, Google/Yelp planned
  Capabilities, and starter packaging.
- GEOTW promotion remains staged and bounded.
- No product repo changes are implied without a receive/promotion pass.

## Related

- [SelfProvisioningRepositoryModel.md](SelfProvisioningRepositoryModel.md)
- [WebPresenceCapabilityPack.md](WebPresenceCapabilityPack.md)
- [GEOTWSelfProvisioningPromotionPlan.md](GEOTWSelfProvisioningPromotionPlan.md)
- [CapabilityHarmonize](../Capabilities/CapabilityHarmonize/README.md)
