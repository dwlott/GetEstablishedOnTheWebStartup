# Index Health Check Automation

Read-only PowerShell scanner for Phase 6 index health validation.

## Purpose

Detect index readiness issues without creating or updating `Indexes/`.

When `Indexes/` is not provisioned, the script prints a **strong recommendation**
to run Indexing Setup and explains **which source folders** would feed generated
tables under `Indexes/` (Plans, website pages, Workspace pointers — not copies
of source bodies).

Checks include:

- Capability Harmonization Metadata gaps
- Missing folder README files
- Legacy `Docs/` path references in active files
- Missing metadata blocks on key boot files
- Source-of-truth language spot checks
- Stale plan signals (lightweight spot checks)
- Deprecated references in search map
- Broken relative markdown links (sampled)

Spec: [Standards/IndexHealthStandard.md](../../Standards/IndexHealthStandard.md)

Workflow: [Capabilities/Indexing/WorkflowIndex.md](../../Capabilities/Indexing/WorkflowIndex.md)

## Usage

From repository root:

```powershell
.\Automation\IndexHealthCheck\Run-IndexHealthCheck.ps1
```

Write report to Plans:

```powershell
.\Automation\IndexHealthCheck\Run-IndexHealthCheck.ps1 -ReportPath Plans\IndexHealthReport.md
```

Custom root:

```powershell
.\Automation\IndexHealthCheck\Run-IndexHealthCheck.ps1 -RepositoryRoot C:\Repositories\GetEstablished
```

## Exit Codes

| Code | Meaning |
| --- | --- |
| 0 | No Must-fix or Should-fix findings (Recommend items may still appear) |
| 1 | Should-fix findings only |
| 2 | One or more Must-fix findings |

**Recommend** severity (e.g. missing `Indexes/`) is informational and does not change the exit code by itself.

## Scope Limits

- Does not modify any repository files
- Does not create `Indexes/`
- Link scan is sampled (Capabilities + Plans), not exhaustive
- Excludes `Archive/` and `Intake/` from legacy path scan

## Related

- [IndexHealthCheck.md](../../Capabilities/Indexing/IndexHealthCheck.md)
- [Run-IndexHealthCheck.ps1](Run-IndexHealthCheck.ps1)
