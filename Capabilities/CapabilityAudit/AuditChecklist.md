<!--
IndexTitle: CapabilityAudit Checklist
IndexDescription: Runnable checklist for repository readiness and Capability catalog health audits.
IndexType: Capability
CapabilityName: CapabilityAudit
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-06-06
-->

# CapabilityAudit Checklist

**Start here** for a review-only audit pass. Read [Rules.md](Rules.md) first.
Use [AuditReportTemplate.md](AuditReportTemplate.md) for durable output and
[StalePlanDetection.md](StalePlanDetection.md) for Plans health.

Default scope: **local GetEstablished** clean-root catalog. Cross-repo only
when the owner names another repository or requests **CapabilityHarmonize**.

## Before You Start

- [ ] Scope confirmed: catalog-only | full repository readiness | cross-repo
- [ ] Read `AGENTS.md`, `Plans/RepositorySearchMap.md`
- [ ] Audit is **review-only** unless owner approved a separate fix pass
- [ ] Output destination chosen: chat-only | `Plans/<Topic>AuditReport.md`

## A — Boot And Goals

- [ ] `AGENTS.md` Mission, First 10 Minutes, and How To Promote are current
- [ ] `Plans/RepositoryGoals.md` linked from boot chain
- [ ] Phase 4 artifacts referenced: InstructionCapture, PromotionChecklist, templates
- [ ] `Workspace/OwnerGoals.md` exists (host may be empty; consumer should be scaffold)

## B — Source Of Truth

- [ ] `Standards/SourceOfTruthAndMirrorStandard.md` matches `AGENTS.md` hierarchy
- [ ] No routine cloud copy assumed after local edits (on-demand review only)
- [ ] No `Intake/` treated as write target without explicit owner scope

## C — Capability Catalog

- [ ] Each **Active** Capability has `README.md` with Harmonization Metadata
- [ ] Each **Active** operational Capability has `Prompt.md` (or `WorkflowIndex.md`)
- [ ] Capabilities touching owner content, credentials, cloud, or intake have **Data boundaries** in README or Rules
- [ ] No duplicate ownership between CapabilityAudit, CapabilityCreate, CapabilityHarmonize, Indexing, InstructionCapture

### C1 — Routing Parity (Must-fix on mismatch)

`Capabilities/AgentCapabilityGuide.md` is the **canonical** routing table; the
others are derived views. Every `Capabilities/<Name>/` folder on disk must appear,
with a **matching `IndexStatus`**, in all four surfaces:

- [ ] Folder on disk → row in `Capabilities/RouterIndex.md`
- [ ] Folder on disk → row in `Capabilities/README.md` registry
- [ ] Folder on disk → entry in `AGENTS.md` Capability Discovery list
- [ ] Every **routable** (Active / Optional / Draft) folder → row or section in `Capabilities/AgentCapabilityGuide.md` (canonical). Planned / Scaffold folders may be registry + RouterIndex only.
- [ ] Status consistent across surfaces (Active / Optional / Planned / Scaffold / Draft)
- [ ] No row in any surface points to a folder that does not exist
- [ ] Disambiguation table covers any new near-neighbor pair

Flag any surface that is missing a folder, lists a phantom, or shows a different
status as **Must-fix**. Compare against
[CapabilityMetadataStandard.md](../../Standards/CapabilityMetadataStandard.md)
Canonical Routing Source.

## D — Skills

- [ ] `Capabilities/SkillRegistry.md` rows match `Capabilities/*/Skills/*/SKILL.md` on disk
- [ ] No orphan Skill files missing registry rows
- [ ] No runtime adapters or scripts created during audit

## E — Plans Health

Run [StalePlanDetection.md](StalePlanDetection.md):

- [ ] Active plans not superseded by newer canonical files
- [ ] No broken links to `Docs/` paths in routable active files
- [ ] Review stubs point to `Archive/HistoricalReviews/` when applicable
- [ ] `Plans/OpenQuestions.md` Decided rows reflected in target files (spot check)

## F — Promotion And Capture Path

- [ ] `Standards/IdeaCaptureTemplate.md`, `PlanTemplate.md`, `PromotionChecklist.md` present
- [ ] `Capabilities/InstructionCapture/` registered and routable
- [ ] `Standards/ArchiveAndDeprecationRules.md` referenced for superseded plans

## G — Navigation And Indexes

- [ ] `Plans/RepositorySearchMap.md` covers new Capabilities and Standards from recent phases
- [ ] `Indexes/` — provisioned on archetype host (2026-06-07); consumer starter via StarterRepositoryPackage Step 6b
- [ ] Folder README coverage for major active folders (`Capabilities/`, `Standards/`, `Plans/`)

## H — Starter Packaging (Host Only)

When auditing archetype host packaging readiness:

- [ ] `Capabilities/StarterRepositoryPackage/` WorkflowIndex aligns with PackageChecklist
- [ ] Consumer subset documented; host-only modules listed for trim

Skip this section on commissioned or consumer repositories.

## Finding Severity

| Level | Meaning |
| --- | --- |
| **Must-fix** | Broken routing, missing Active entry, wrong SoT guidance |
| **Should-fix** | Stale paths, missing metadata, unclear boundaries |
| **Optional** | Polish, duplication, non-blocking OpenQuestions |

Do not score or certify. Name files, recommend small fixes, separate audit from implementation.

## Related

- [Prompt.md](Prompt.md)
- [AuditReportTemplate.md](AuditReportTemplate.md)
- [RepositoryStructureReviewPrompt.md](RepositoryStructureReviewPrompt.md)
