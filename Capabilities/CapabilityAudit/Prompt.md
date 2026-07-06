<!--
IndexTitle: CapabilityAudit Prompt
IndexDescription: Copy-ready prompt for repository readiness and Capability catalog audits.
IndexType: Capability
CapabilityName: CapabilityAudit
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-06-06
-->

# CapabilityAudit Prompt

Read [Rules.md](Rules.md) and [AuditChecklist.md](AuditChecklist.md) first.
Review-only unless the owner approved a separate implementation pass.

```text
# Worker or planner pass: CapabilityAudit

Repository: C:\Repositories\GetEstablished
Audit scope: repository-readiness | catalog-only | cross-repo (owner names scope)
Branch: main

Read first:
- AGENTS.md
- Capabilities/CapabilityAudit/Rules.md
- Capabilities/CapabilityAudit/AuditChecklist.md
- Capabilities/CapabilityAudit/StalePlanDetection.md
- Plans/RepositorySearchMap.md
- Capabilities/README.md
- Capabilities/AgentCapabilityGuide.md
- Capabilities/SkillRegistry.md

Goal:
Run a review-only audit. Find friction points: catalog mismatches, stale plans,
unclear routing, missing Harmonization Metadata, conflicting SoT guidance, and
gaps in the Phase 4 promotion path (InstructionCapture, PromotionChecklist).

Use AuditChecklist sections matching the chosen scope.

In scope:
- Compare registry to Capability folders on disk
- Compare AgentCapabilityGuide to Active/Planned modules
- Compare SkillRegistry to Capability-owned SKILL.md files
- Stale plan detection on Plans/ and routable boot files
- Recommend Must-fix / Should-fix / Optional items

Out of scope:
- Editing audited files (unless this pass is explicitly an implementation pass)
- Cross-repo audit unless owner named another repository
- Indexes/, Skills, automation, scripts, commit, push, cloud writes

Output:
- Default: chat summary (short form in AuditReportTemplate.md)
- If owner requested durable report: Plans/<Topic>AuditReport.md using AuditReportTemplate.md

End with exactly one fenced text handoff:
Summary
Audit scope
Must-fix count and top items
Should-fix count
Stale plan signals (if any)
Open questions
Next Recommended Task
Files Changed (none if review-only)
```

## Prompt history

- **2026-06-06 (v2):** Phase 5 — checklist-driven audit, stale plan detection, clean-root paths, repository readiness scope.
- **2026-06-01 (v1):** Initial catalog-only audit prompt.

## Related

- [AuditReportTemplate.md](AuditReportTemplate.md)
- [RepositoryStructureReviewPrompt.md](RepositoryStructureReviewPrompt.md)
