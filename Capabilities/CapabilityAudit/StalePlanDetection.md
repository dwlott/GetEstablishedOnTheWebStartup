<!--
IndexTitle: Stale Plan Detection Guidance
IndexDescription: Signals and checks for stale, superseded, or conflicting Plans and routing docs.
IndexType: Capability
CapabilityName: CapabilityAudit
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-06-06
-->

# Stale Plan Detection Guidance

Use during [AuditChecklist.md](AuditChecklist.md) section **E — Plans Health**.
Review-only — list findings; do not move or delete files during audit.

## Stale Signals

| Signal | Likely issue | Check |
| --- | --- | --- |
| `IndexStatus: Active` but body says superseded or historical | Status drift | Compare to [ArchiveAndDeprecationRules.md](../../Standards/ArchiveAndDeprecationRules.md) |
| Redirect stub missing | Broken navigation | Add superseded pointer or sync to Archive |
| `LastEdited` old + contradicts newer Active file on same topic | Duplicate guidance | Name canonical file; mark other Superseded |
| Links to `Docs/Project/`, `Docs/Capabilities/`, `Docs/Setup/` | Pre-clean-root paths | Update to `Plans/`, `Capabilities/`, `Standards/` |
| Linked from `RepositorySearchMap.md` but file missing | Index drift | Fix map or restore file |
| `AgentTaskBacklog.md` Ready Next references completed work | Backlog drift | Move to Completed or update Ready Next |
| OpenQuestions row **Decided** but target files unchanged | Decision not applied | Note for owner or fix pass |
| Plan promotes work already in Active Capability | Promotion lag | Mark plan Superseded; link Capability |
| `*Review.md` in `Plans/` with validated copy in Archive | Duplicate review | Keep stub only if still linked |

## Active Versus Historical

| Location | Role |
| --- | --- |
| `Plans/` | Active planning, setup guides, registers, current reviews |
| `Archive/SupersededPlans/` | Replaced planning tracks |
| `Archive/HistoricalReviews/` | Validation and review artifacts |
| `Archive/MigrationReports/` | Host migration history |
| `Intake/` | Reference only — not active write destination |

Consumer starter packages exclude host Archive trees. Do not flag missing
Archive on consumer repos as Must-fix.

## Quick Scan Commands (Optional)

Run in repository root when filesystem access is available:

```powershell
# Legacy Docs/ path references in active routable files
Select-String -Path "AGENTS.md","Plans\RepositorySearchMap.md","Capabilities\README.md" -Pattern "Docs/(Project|Capabilities|Setup|Prompts)/" -SimpleMatch

# Plans with Superseded in body but Active in metadata (manual review)
Select-String -Path "Plans\*.md" -Pattern "IndexStatus: Active" | Select-Object -First 20
```

Interpret results manually — automated grep is advisory only.

## Duplicative Workflow Detection

Flag when two Active surfaces give conflicting instructions for the same task:

- `AGENTS.md` vs Capability `Rules.md` on source of truth or cloud copy
- `Plans/PlannerWorkerWorkflow.md` vs `Capabilities/AssistedAgenticWorkflow/`
- Registry row **Active** but README **Planned** or **Deprecated**

Recommend one canonical surface; link others as pointers.

## Severity

| Severity | Example |
| --- | --- |
| **Must-fix** | Wrong SoT in `AGENTS.md`; broken Capability route |
| **Should-fix** | Stale `Docs/` link in Active Capability README |
| **Optional** | Old review file still in Plans but also archived |

## Related

- [AuditChecklist.md](AuditChecklist.md)
- [AuditReportTemplate.md](AuditReportTemplate.md)
- [../../Standards/ArchiveAndDeprecationRules.md](../../Standards/ArchiveAndDeprecationRules.md)
