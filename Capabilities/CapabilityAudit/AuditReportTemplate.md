<!--
IndexTitle: CapabilityAudit Report Template
IndexDescription: Standard output shape for CapabilityAudit and repository readiness reports.
IndexType: Capability
CapabilityName: CapabilityAudit
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-06-06
-->

# CapabilityAudit Report Template

Use when the owner requests a **durable audit report** in `Plans/`. Default is
chat-only. For historical retention, sync validated reports to
`Archive/HistoricalReviews/` per [ArchiveAndDeprecationRules.md](../../Standards/ArchiveAndDeprecationRules.md).

## Metadata Block

```markdown
<!--
IndexTitle: <Audit Topic> Report
IndexDescription: <One sentence — scope and date>
IndexType: Project
IndexStatus: Active
LastEdited: YYYY-MM-DD
AuditScope: catalog | repository-readiness | cross-repo
-->
```

Suggested filename: `Plans/<Topic>AuditReport.md` (for example
`Plans/RepositoryReadinessAuditReport.md`).

## Report Body

```markdown
# <Audit Topic> Report

## Scope

What was audited, repository path, and explicit out-of-scope items.

## Method

Checklist used ([AuditChecklist.md](../Capabilities/CapabilityAudit/AuditChecklist.md))
and primary source files read.

## Summary

One short paragraph on overall health. No scoring.

## Source Files Reviewed

Bulleted list of main files and folders.

## High-Confidence Fixes (Must-Fix)

| Finding | File or row | Recommended fix |
| --- | --- | --- |
| | | |

## Medium-Confidence Items (Should-Fix)

| Finding | File or row | Recommended fix |
| --- | --- | --- |
| | | |

## Stale Or Deprecated Guidance

From [StalePlanDetection.md](../Capabilities/CapabilityAudit/StalePlanDetection.md):

| Item | Signal | Recommended action |
| --- | --- | --- |
| | | |

## Open Questions

Non-blocking items for `Plans/OpenQuestions.md` or owner batch review.

## Suggested Promotions

Ideas or Plans that may promote per [PromotionChecklist.md](../../Standards/PromotionChecklist.md).
Audit only — do not promote without owner approval.

## Suggested Archive Moves

Files that should be superseded or moved per ArchiveAndDeprecationRules.
Implementation pass required.

## Missing Metadata

Capability README Harmonization Metadata, index blocks, or registry columns.

## Blockers

Items that block the next implementation pass (if any).

## Next Recommended Task

One focused follow-up — often a small fix pass or InstructionCapture of audit lessons.

## Related

- Prior audit reports in `Archive/HistoricalReviews/` or `Archive/MigrationReports/`
```

## Chat-Only Short Form

When no durable file is requested:

```text
Summary
Scope
Must-fix (count)
Should-fix (count)
Stale items (count)
Open questions
Next Recommended Task
```

## Related

- [AuditChecklist.md](AuditChecklist.md)
- [Prompt.md](Prompt.md)
