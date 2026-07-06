<!--
IndexTitle: Index Health Check
IndexDescription: Runnable checklist for index readiness and repository self-description validation.
IndexType: Capability
CapabilityName: Indexing
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-06-06
-->

# Index Health Check

Read-only validation before **Indexing Setup** or **refresh**. Implements
[IndexHealthStandard.md](../../Standards/IndexHealthStandard.md).

Automated pass: [Run-IndexHealthCheck.ps1](../../Automation/IndexHealthCheck/Run-IndexHealthCheck.ps1).

When `Indexes/` is missing, the script prints context on **what Indexing would
summarize** (source folders → generated tables) and a **strong recommendation**
to run [SetupPrompt.md](SetupPrompt.md) once, then [Prompt.md](Prompt.md) refresh.

## Before You Start

- [ ] Scope: health check only — no `Indexes/` writes
- [ ] Read `AGENTS.md`, [Rules.md](Rules.md)
- [ ] Stale plan rules: [StalePlanDetection.md](../CapabilityAudit/StalePlanDetection.md)

## 1 — Capability Metadata

- [ ] Each **Active** folder under `Capabilities/` has `README.md`
- [ ] Active Capability READMEs include **Harmonization Metadata** table
- [ ] `Capabilities/README.md` registry rows match folders on disk
- [ ] `Capabilities/AgentCapabilityGuide.md` intents map to Active modules
- [ ] `Capabilities/SkillRegistry.md` matches `*/Skills/*/SKILL.md` files

## 2 — Document Metadata

Per [MarkdownIndexMetadataStandard.md](../../Standards/MarkdownIndexMetadataStandard.md):

- [ ] Routable boot files have metadata blocks (`AGENTS.md`, key Plans, Standards)
- [ ] Folder `README.md` files have first-line `<!-- Index: ... -->` comment
- [ ] `IndexStatus: Deprecated` files are not linked as primary paths from maps

Spot-check paths: `Plans/RepositorySearchMap.md`, `Standards/README.md`,
`Capabilities/GettingStarted/`.

## 3 — Folder README Coverage

Major folders should have `README.md`:

- [ ] `Capabilities/`, `Plans/`, `Standards/`, `Content/`, `Ideas/`, `Workspace/`
- [ ] New Capability folders include README when Active

## 4 — Deprecated And Legacy References

- [ ] No new writes target `Docs/Project/`, `Docs/Capabilities/`, `Intake/` without scope
- [ ] Active routable files avoid legacy `Docs/` paths (spot check + script)
- [ ] Superseded plans use redirect stub or Archive pointer

## 5 — Stale Plans

Apply [StalePlanDetection.md](../CapabilityAudit/StalePlanDetection.md):

- [ ] `Plans/OpenQuestions.md` Decided rows reflected in targets (spot check)
- [ ] `AgentTaskBacklog.md` Ready Next not pointing at completed work
- [ ] Review stubs in `Plans/` point to `Archive/HistoricalReviews/`

## 6 — Broken Related Links

- [ ] Run script link scan or manual check on edited files
- [ ] Capability README **Related** links resolve
- [ ] `Plans/RepositorySearchMap.md` paths exist

## 7 — Source Of Truth Notes

- [ ] `AGENTS.md` hierarchy matches `Standards/SourceOfTruthAndMirrorStandard.md`
- [ ] No routine cloud copy assumed after local edits
- [ ] Indexing Rules do not contradict AGENTS boot chain

## Severity

| Level | Action |
| --- | --- |
| **Must-fix** | Fix before index refresh affects routing or SoT |
| **Should-fix** | Fix in next documentation pass |
| **Optional** | Note in health report; non-blocking |

## Output

Use [IndexHealthReportTemplate.md](IndexHealthReportTemplate.md) when owner
requests a durable report in `Plans/`.

## Related

- [WorkflowIndex.md](WorkflowIndex.md)
- [Prompt.md](Prompt.md)
