<!--
IndexTitle: Indexing Workflow Index
IndexDescription: Runnable index for Indexing Setup, health check, and refresh passes.
IndexType: Capability
CapabilityName: Indexing
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-06-06
-->

# Indexing Workflow Index

**Shared index core** for `Indexes/` work on GetEstablished clean-root
repositories: format, Setup, and health check. To **refresh** indexes, pick a
mode:

- Default (no scripts): [../ManualIndexing/WorkflowIndex.md](../ManualIndexing/WorkflowIndex.md)
- Optional (automation, opt-in): [../CodeAssistedIndexing/README.md](../CodeAssistedIndexing/README.md)

If `Capabilities/Indexing/` were removed, these instructions would be lost.

## When To Use

| Need | Step |
| --- | --- |
| First-time `Indexes/` folders | [SetupPrompt.md](SetupPrompt.md) (owner approval required) |
| Validate before Setup or refresh | [IndexHealthCheck.md](IndexHealthCheck.md) |
| Refresh existing indexes | [Prompt.md](Prompt.md) or [Skills/IndexRefresh/SKILL.md](Skills/IndexRefresh/SKILL.md) |
| Automated scan | [Run-IndexHealthCheck.ps1](../../Automation/IndexHealthCheck/Run-IndexHealthCheck.ps1) |

**Default on archetype host:** `Indexes/` is **not** provisioned until owner runs Setup.

## Step 0 — Confirm Scope

- [ ] Owner approved Indexing scope (Setup, health check, or refresh only)
- [ ] Read [Rules.md](Rules.md) and [Structure.md](Structure.md)
- [ ] Health check is read-only unless refresh pass explicitly approved

## Step 1 — Health Check (Recommended Before Setup Or Refresh)

Run [IndexHealthCheck.md](IndexHealthCheck.md) or:

```powershell
cd C:\Repositories\GetEstablished
.\Automation\IndexHealthCheck\Run-IndexHealthCheck.ps1
```

Optional report file:

```powershell
.\Automation\IndexHealthCheck\Run-IndexHealthCheck.ps1 -ReportPath Plans\IndexHealthReport.md
```

Fix Must-fix items before refresh when they affect index accuracy.

## Step 2 — Setup (If `Indexes/` Missing)

1. Owner confirms Setup.
2. Run [SetupPrompt.md](SetupPrompt.md).
3. Creates paths in [Structure.md](Structure.md) only.
4. Re-run health check.

## Step 3 — Refresh (If `Indexes/` Exists)

1. Confirm partial vs full provisioning per Rules.
2. Run [Prompt.md](Prompt.md) or IndexRefresh Skill.
3. Write **only** under `Indexes/`.
4. End with standard worker handoff.

## Step 4 — Verify

- [ ] Source files unchanged (except `Indexes/`)
- [ ] Health check passes or remaining items documented as Optional
- [ ] `Capabilities/README.md` Indexing row current if Rules/Prompt changed

## Related

- [README.md](README.md)
- [IndexHealthReportTemplate.md](IndexHealthReportTemplate.md)
- [../../Standards/IndexHealthStandard.md](../../Standards/IndexHealthStandard.md)
