<!--
IndexTitle: CapabilityHarmonize Prompt
IndexDescription: Copy-ready prompt to compare a Capability, tree pattern, pack, or self-provisioning readiness across repositories.
IndexType: Capability
CapabilityName: CapabilityHarmonize
CapabilityVersion: 3
IndexStatus: Active
LastEdited: 2026-06-19
-->

# CapabilityHarmonize Prompt

Planner or worker pass. Read [Rules.md](Rules.md) first. This prompt compares
and recommends; it does not edit the compared Capabilities unless the user
approves an implementation pass. For repository tree parity, read
[CleanRootMigration.md](CleanRootMigration.md) after the compare step. For
self-provisioning readiness, read
[SelfProvisioningRepositoryModel.md](../../Plans/SelfProvisioningRepositoryModel.md).

```text
# Planner or worker pass: CapabilityHarmonize

Goal:
Compare a Capability, repository tree pattern, Capability pack, or
self-provisioning readiness that exists in more than one place, name each
version's strengths, and propose how to blend the best of both (or enhance them)
toward a uniform, optimal result. Keep it a head start, not a change log.

Tell me first (or infer from what I provide):
- Subject: which Capability, capability area, repository tree shape, Capability
  pack, or self-provisioning readiness question to compare.
- Sources: the repositories or paths that hold each version (one repo is fine
  for an internal compare; old vs new version is also fine).
- Goals (optional): what "uniform and optimal" should mean here.

Read for each source (when available):
- README.md (purpose, version, distinctive strengths)
- Rules.md (guardrails, learned constraints)
- Prompt.md (what the Capability actually does)
- Any existing CrossRepoCapabilityGapMatrix row for this Capability
- For tree harmonization: AGENTS.md, repository search map, router, capability
  guide, index files, and any migration report
- For self-provisioning readiness: SelfProvisioningRepositoryModel.md,
  StarterRepositoryPackage, RepositoryInitialize, CapabilityAudit,
  CapabilityHarmonize, Indexing, registry/router/guide, and relevant
  archetype-pack plan

Rules:
- Compare and recommend only; do not edit the compared Capabilities unless I
  approve a separate implementation pass.
- Lead with strengths and goals, then options.
- Make schemas, file names, and metadata identical where they should match;
  single-source shared specs to prevent drift.
- Keep intentional, profile-driven differences (source folders, host vs
  commissioned provisioning, tier-specific behavior).
- Respect tier: never blend a commissioned-only behavior into a universal or
  archetype-host Capability, or vice versa.
- Prefer the stricter, safer guardrail when two rules conflict.
- Do not invent capabilities, rules, or goals the sources do not support.
- If the subject is clean-root tree parity, follow CleanRootMigration.md:
  preflight, migration map, controlled move, reference refresh, smoke tests,
  and report. Do not rewrite customer-facing claims as part of tree migration.
- If the subject is self-provisioning readiness, compare audit, harmonization,
  initialization, starter packaging, indexing, routing parity, and archetype-pack
  readiness. Do not recommend copying host-only or private material by default.

Produce this output:

1. Subject
One line: the Capability/area and the sources compared.

2. Per-source inventory
For each source: version, key files, and one line of distinctive strengths.

3. Goals
What uniform and optimal means for this Capability.

4. Reconcile vs intentional
- Reconcile: differences that should be aligned (schema, naming, rules gaps).
- Intentional: differences to keep (profile-driven, tier-driven).

5. Blend / enhance options
2-3 options. For each: a one-line trade-off and rough effort (small/medium).

6. Recommendation
The best-of-both path, with a tier-safety note and what an implementation pass
would touch.

If the subject is clean-root migration, add:
- migration map;
- preserved boundaries;
- smoke-test checklist;
- report destination.

If the subject is self-provisioning readiness, add:
- core Capability coverage;
- archetype-pack coverage;
- starter packaging gap list;
- receive/copy boundaries;
- verification checklist.

End with exactly one fenced text handoff if acting as worker:
Summary, Files Changed, Planning Files To Review, Questions Added Or Changed,
Next Recommended Task.
```

## Prompt history

- **2026-05-28 (v1):** Initial canonical compare-and-blend prompt. Cross-repo capable; emphasizes strengths, goals, and best-of-both options over change tracking.
- **2026-06-19 (v2):** Added clean-root tree harmonization routing to the commissioned-instance-derived migration playbook.
- **2026-06-19 (v3):** Added self-provisioning readiness and Capability-pack comparison mode.
