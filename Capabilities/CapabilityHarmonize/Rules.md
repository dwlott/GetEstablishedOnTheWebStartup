<!--
IndexTitle: CapabilityHarmonize Rules
IndexDescription: Blend principles, tier-safety, and lightweight output rules for comparing Capabilities, trees, packs, or self-provisioning readiness.
IndexType: Standard
CapabilityName: CapabilityHarmonize
CapabilityVersion: 3
IndexStatus: Active
LastEdited: 2026-06-19
-->

# CapabilityHarmonize Rules

Canonical operating rules for comparing a Capability across repositories (or
across versions) and proposing a best-of-both result. This Capability is
**compare-and-recommend**: it does not edit the compared Capabilities unless
the user approves a separate implementation pass.

## Scope

In scope:

- Inventory each version of the Capability (files, version, distinctive strengths).
- State the goals for a uniform, optimal result.
- Separate differences worth reconciling from intentional profile differences.
- Propose 2–3 blend / enhance options and recommend one.
- Apply the clean-root migration playbook when the subject is repository tree
  parity rather than a single Capability.
- Apply the self-provisioning model when the subject is whether a repository can
  produce or maintain a starter repository for its own archetype.

Out of scope (keep it a head start, not a ledger):

- Exhaustive change history or diff logs.
- Editing the compared Capabilities (that is an approved implementation pass).
- Inventing capabilities, rules, or goals that the sources do not support.

## Method

1. Confirm the subject and the sources (repos/paths, or old vs new version).
2. Read each source's `README.md` (purpose, version, strengths), `Rules.md`
   (guardrails, learned constraints), and `Prompt.md` (what it actually does).
3. Note each version's strengths in one line each.
4. Write the goals: what "uniform and optimal" means for this Capability.
5. Classify each difference: **reconcile** (schema, file names, rules wording,
   missing guardrails) or **intentional** (profile-driven source folders, host
   vs commissioned provisioning, tier-specific behavior).
6. Offer 2–3 blend / enhance options, each with a one-line trade-off and rough
   effort. Recommend the best-of-both path.
7. For tree harmonization, switch to [CleanRootMigration.md](CleanRootMigration.md)
   after the compare step and keep the migration structural unless the user
   separately approves content rewriting.
8. For self-provisioning readiness, compare the repository against
   [SelfProvisioningRepositoryModel.md](../../Plans/SelfProvisioningRepositoryModel.md):
   audit, harmonization, initialization, packaging, indexing, routing parity, and
   archetype-pack readiness.

## Blend Principles

- **Best of both:** take the clearer, safer, or more reusable version of each
  element rather than averaging them.
- **Conflicting guardrails:** prefer the stricter, safer rule.
- **Schema and naming:** make column sets, file names, and metadata identical;
  single-source schemas (one spec file the others reference) to prevent drift.
- **Keep intentional differences:** profile-driven source folders and
  host-vs-commissioned provisioning are features, not gaps.
- **Tier safety:** never blend a commissioned-only behavior into a universal or
  archetype-host Capability, or vice versa. See
  [RepositoryArchetypeAndCapabilityTiers.md](../../Standards/RepositoryArchetypeAndCapabilityTiers.md).
- **Reuse the canonical home:** the cross-repo inventory lives in
  [CrossRepoCapabilityGapMatrix.md](../../Plans/CrossRepoCapabilityGapMatrix.md);
  durable lessons belong in the target Capability's changelog or lessons log.
- **Tree parity is not content rewriting:** clean-root migration may update path
  metadata and active instructions, but customer-facing claims and business
  content stay unchanged unless separately approved.
- **Bridge language expires:** compatibility bridges are useful before a
  migration, but active instructions should speak clean-root truth after the
  tree has moved.
- **Self-provisioning is explicit:** do not assume every repository should carry
  the full core. Confirm it is intended to be a mature archetype host or
  self-provisioning repository before recommending core additions.

## Output Destinations

- Default: a concise comparison in chat (the six-part shape in the README).
- Optional: a short report file or a gap-matrix row when the user wants a record.
- Implementation edits to the compared Capabilities only on explicit approval.

## After A Compare Pass

Worker agents end with one fenced `text` handoff block per `AGENTS.md`
(about 72 characters per line). Recommendations are proposals until the user
approves an implementation pass.

## Learned Constraints

- Lead with strengths and goals, then options — not a wall of differences.
- Two or three options is enough; name a recommendation so the user can decide.
- Respect tier and profile; uniformity means same mechanism, not erasing
  intentional per-repo differences.
- For clean-root migrations, verify boot routing, index paths, and common
  workflow intents before marking the pass complete.
- For self-provisioning readiness, verify starter packaging, initialization,
  audit, harmonization, indexing, and archetype-pack routes separately.
