<!--
IndexTitle: CapabilityAudit Rules
IndexDescription: Guardrails and method for repository readiness and Capability catalog audits.
IndexType: Capability
CapabilityName: CapabilityAudit
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-06-06
-->

# CapabilityAudit Rules

Canonical rules for auditing the GetEstablished clean-root repository.
Read [AuditChecklist.md](AuditChecklist.md) before running [Prompt.md](Prompt.md).

## Scope

In scope:

- **Capability catalog:** registry vs disk, routing, Harmonization Metadata,
  Data boundaries, Skill links.
- **Repository readiness:** boot chain, source of truth, promotion path artifacts,
  navigation maps, folder README coverage.
- **Plans health:** stale, superseded, or conflicting guidance per
  [StalePlanDetection.md](StalePlanDetection.md).
- **Starter packaging (host):** StarterRepositoryPackage alignment when scoped.

Out of scope unless separately approved:

- Implementing fixes during the audit pass.
- Creating, moving, or deleting Capability folders or Plans.
- Creating `Indexes/`, Skills, automation, scripts, or generated catalogs.
- Cross-repo audit (use **CapabilityHarmonize**).
- Commit, push, or cloud writes.

## Source Priority

1. `AGENTS.md`, `Plans/RepositorySearchMap.md`
2. `Capabilities/README.md`, `Capabilities/AgentCapabilityGuide.md`
3. `Capabilities/SkillRegistry.md`
4. Each `Capabilities/<Name>/` folder
5. `Standards/` (metadata, SoT, promotion, archive)
6. `Plans/RepositoryGoals.md`, `Plans/OpenQuestions.md`, `Plans/AgentTaskBacklog.md`
7. `Archive/` for historical context only

The audit report is **not** a new source of truth. It points back to canonical files.

## Audit Method

1. Confirm scope: catalog | repository-readiness | cross-repo.
2. Walk [AuditChecklist.md](AuditChecklist.md) sections for the chosen scope.
3. Apply [StalePlanDetection.md](StalePlanDetection.md) for Plans folder.
4. Classify findings: Must-fix | Should-fix | Optional.
5. Output chat summary or [AuditReportTemplate.md](AuditReportTemplate.md) file.
6. Name **one** Next Recommended Task — often a small fix pass or InstructionCapture.

## Finding Style

- Name the file, registry row, or plan.
- State the mismatch or stale signal.
- Recommend a **small** fix.
- Separate audit findings from implementation tasks.

Do not score, certify, or claim exhaustive proof.

## Output Destination

| Owner request | Destination |
| --- | --- |
| Default | Chat-only short form in Prompt |
| Durable report | `Plans/<Topic>AuditReport.md` |
| Historical retention | After validation, sync to `Archive/HistoricalReports/` per Archive rules |

Do not write audit reports under legacy `Docs/Project/` paths.

## Cloud And Local

- Local Git is the audit read/write surface for durable reports.
- Cloud review is optional and on-demand only; not required for catalog audit.
- Do not treat cloud folders as source of truth.

## Skill Boundary

Do not create a Skill for CapabilityAudit v2.

A future deterministic checklist Skill may be considered only after repeated
manual audits prove a stable pattern — with owner approval.

## Related

- [README.md](README.md)
- [Prompt.md](Prompt.md)
- [AuditChecklist.md](AuditChecklist.md)
- [../CapabilityHarmonize/README.md](../CapabilityHarmonize/README.md)
- [../InstructionCapture/README.md](../InstructionCapture/README.md)
