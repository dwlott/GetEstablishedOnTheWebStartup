<!-- Index: Audit repository readiness, Capability catalog health, routing, and stale guidance. -->
<!--
IndexTitle: CapabilityAudit Capability
IndexDescription: Review-only audits for Capability catalog health, repository readiness, and stale plan detection.
IndexType: Capability
CapabilityName: CapabilityAudit
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-06-06
-->

# CapabilityAudit Capability

- **Version:** 2
- **Tier:** Universal meta Capability
- **Purpose:** Help agents quickly find **friction points**: catalog mismatches,
  stale plans, unclear routing, missing metadata, conflicting guidance, and
  gaps in the promotion path — without becoming a second registry.
- **Inputs:** `AGENTS.md`, `Plans/RepositorySearchMap.md`, Capability registry
  and routing, Skill registry, Standards, Plans folder, optional backlog.
- **Outputs:** Chat summary or durable report in `Plans/` using
  [AuditReportTemplate.md](AuditReportTemplate.md); recommended small fix tasks
  (implementation requires separate owner-approved pass).
- **WhenToUse:** Audit Capabilities; check catalog health; repository readiness
  review; find stale plans; verify Phase 4 promotion artifacts; before a large
  cleanup or packaging pass.

## Start Here

1. [AuditChecklist.md](AuditChecklist.md) — runnable checklist
2. [Rules.md](Rules.md) — scope and method
3. [Prompt.md](Prompt.md) — copy-ready worker prompt
4. [StalePlanDetection.md](StalePlanDetection.md) — Plans health signals
5. [AuditReportTemplate.md](AuditReportTemplate.md) — durable report shape

For structure-only review: [RepositoryStructureReviewPrompt.md](RepositoryStructureReviewPrompt.md).

## Design Stance

CapabilityAudit is **documentation-only** by default. It reads, compares, and
recommends. It does not edit audited files, create `Indexes/`, Skills,
automation, or cross-repo reports unless a later scoped task approves that work.

The registry and each Capability folder remain source of truth; CapabilityAudit
points out where they disagree or need attention.

## Audit Modes

| Mode | Checklist sections | Typical output |
| --- | --- | --- |
| **Catalog** | C, D | Capability routing and metadata gaps |
| **Repository readiness** | A–H | Boot, SoT, plans, promotion path, navigation |
| **Cross-repo** | C + CapabilityHarmonize | Only when owner explicitly scopes |

## Relationship To Other Capabilities

| Capability | Relationship |
| --- | --- |
| CapabilityCreate | Implements fixes after audit recommends new or updated modules |
| CapabilityHarmonize | Cross-repo compare/blend; not default audit scope |
| Indexing | Owns `Indexes/` refresh; audit may recommend only |
| InstructionCapture | Captures audit lessons or follow-up Ideas |
| RepositoryLearning | Promotes repeatable audit lessons after proof |
| SituationalAwareness | Orient before audit; audit does not replace SA |

```text
CapabilityAudit  →  "Is guidance clean, routed, and current?"
CapabilityHarmonize  →  "How should two repo versions blend?"
InstructionCapture  →  "Save this session to Ideas or Plans."
```

## Data Boundaries

- **May read:** boot files, `Capabilities/`, `Plans/`, `Standards/`, `Archive/`
  (historical context), Skill files, `Workspace/` structure (not owner secrets).
- **May write:** scoped report under `Plans/` when owner requests durable output.
- **Must not:** store credentials, tokens, or owner-private content in reports;
  treat cloud folders as optional read-only review surfaces only.

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | CapabilityAuditCapabilityPlan; Phase 5 modernization |
| **SourceSummary** | Catalog + repository readiness audit; stale plan detection |
| **PromotionStatus** | Active |
| **Dependencies** | CapabilityMetadataStandard, AgentCapabilityGuide, SkillRegistry, PromotionChecklist |
| **RelatedFiles** | Rules.md, Prompt.md, AuditChecklist.md, AuditReportTemplate.md, StalePlanDetection.md |
| **LastReviewed** | 2026-06-06 |
| **HarmonizationNotes** | v2 expands beyond catalog-only; clean-root paths |

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-06-06 | 2 | Phase 5 modernization: checklist, report template, stale plan guidance; clean-root paths | Audits need runnable index, not stale Docs/ paths | README, Rules, Prompt, AuditChecklist, AuditReportTemplate, StalePlanDetection |
| 2026-06-01 | 1 | Initial documentation-only CapabilityAudit | Recommend only; no second registry | README, Rules, Prompt |

## Related

- First historical report: [../../Archive/MigrationReports/CapabilityAuditFirstReport.md](../../Archive/MigrationReports/CapabilityAuditFirstReport.md)
- [../README.md](../README.md)
- [../AgentCapabilityGuide.md](../AgentCapabilityGuide.md)
- [../../Standards/CapabilityMetadataStandard.md](../../Standards/CapabilityMetadataStandard.md)
