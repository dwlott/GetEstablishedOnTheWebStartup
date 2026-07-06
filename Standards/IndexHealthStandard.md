<!--
IndexTitle: Index Health Standard
IndexDescription: What repository index health checks detect before or during Indexing refresh.
IndexType: Standard
IndexStatus: Active
LastEdited: 2026-06-06
-->

# Index Health Standard

Defines what **index health checks** evaluate before or alongside `Indexes/`
refresh. Phase 6 complements manual index files with automated and agent-run
validation so the repository can **self-describe** more reliably.

Operational workflow: [IndexHealthCheck.md](../Capabilities/Indexing/IndexHealthCheck.md).
Script: [Run-IndexHealthCheck.ps1](../Automation/IndexHealthCheck/Run-IndexHealthCheck.ps1).

## Health Domains

| Domain | Detects |
| --- | --- |
| **Capability metadata** | Missing Harmonization Metadata; routing parity drift across folders <-> AgentCapabilityGuide (canonical) <-> RouterIndex <-> README registry <-> AGENTS Capability Discovery list |
| **Document metadata** | Missing index blocks on routable files per MarkdownIndexMetadataStandard |
| **Folder README coverage** | Major folders without README or first-line index comment |
| **Deprecated references** | Active files linking to superseded paths; `IndexStatus` drift |
| **Stale plans** | Signals from [StalePlanDetection.md](../Capabilities/CapabilityAudit/StalePlanDetection.md) |
| **Broken related links** | Relative markdown links pointing to missing files |
| **Source-of-truth notes** | Conflicts between `AGENTS.md` and SourceOfTruth standard |

## Run Modes

| Mode | When | Tool |
| --- | --- | --- |
| **Health check only** | Before Setup or refresh; CI optional | Script and/or IndexHealthCheck checklist |
| **Index refresh** | After Setup; owner approved | Indexing Prompt / IndexRefresh Skill |
| **Full audit** | Broader friction review | CapabilityAudit AuditChecklist |

Health check is **read-only**. It does not create `Indexes/` or edit source files.

## Output

| Request | Destination |
| --- | --- |
| Default | Console summary + exit code |
| Agent pass | Chat handoff or `Plans/IndexHealthReport.md` |
| After fix pass | Re-run health check before index refresh |

## Related

- [MarkdownIndexMetadataStandard.md](MarkdownIndexMetadataStandard.md)
- [CapabilityMetadataStandard.md](CapabilityMetadataStandard.md)
- [../Capabilities/Indexing/WorkflowIndex.md](../Capabilities/Indexing/WorkflowIndex.md)
