<!--
IndexTitle: Index Health Report Template
IndexDescription: Standard output for Indexing health check reports in Plans/.
IndexType: Capability
CapabilityName: Indexing
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-06-06
-->

# Index Health Report Template

Use for durable output at `Plans/IndexHealthReport.md` or dated variants.

## Metadata Block

```markdown
<!--
IndexTitle: Index Health Report
IndexDescription: Read-only index readiness scan results.
IndexType: Project
IndexStatus: Active
LastEdited: YYYY-MM-DD
-->
```

## Report Body

```markdown
# Index Health Report

## Summary

One paragraph. Include script exit summary if used.

## Method

- IndexHealthCheck checklist sections run
- Run-IndexHealthCheck.ps1 (yes/no)

## Capability Metadata

| Finding | Path | Severity |
| --- | --- | --- |

## Document Metadata

| Finding | Path | Severity |
| --- | --- | --- |

## Folder README Coverage

| Folder | Has README | Severity |
| --- | --- | --- |

## Deprecated And Legacy References

| Finding | Path | Severity |
| --- | --- | --- |

## Stale Plans

| Finding | Signal | Severity |
| --- | --- | --- |

## Broken Links

| Source file | Broken target | Severity |
| --- | --- | --- |

## Source Of Truth

| Finding | Files | Severity |
| --- | --- | --- |

## Indexes/ Status

| Check | Result |
| --- | --- |
| Indexes/ exists | yes/no |
| Partial provisioning | yes/no |
| Ready for Setup | yes/no |
| Ready for refresh | yes/no |

## Next Recommended Task

One focused step — often Setup, fix pass, or refresh.
```

## Related

- [IndexHealthCheck.md](IndexHealthCheck.md)
- [WorkflowIndex.md](WorkflowIndex.md)
