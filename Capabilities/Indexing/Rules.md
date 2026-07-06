<!--
IndexTitle: Indexing Rules
IndexDescription: Operating rules and data boundaries for Indexing on GetEstablished clean-root repos.
IndexType: Standard
CapabilityName: Indexing
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-06-06
-->

# Indexing Rules

Canonical operating rules for the Indexing Capability on the GetEstablished
**clean-root** profile. Index refresh only; this Capability does not move source
material.

Profile: **archetypeHost** (GetEstablished). Read
[Structure.md](Structure.md) for column specs and provisioned paths.

## Setup Before Operate

If `Indexes/` does not exist, offer [SetupPrompt.md](SetupPrompt.md) and stop.
Never `mkdir Indexes/` outside Setup. On the archetype host, `Indexes/` is not
provisioned by default.

Run [IndexHealthCheck.md](IndexHealthCheck.md) or
[Run-IndexHealthCheck.ps1](../../Automation/IndexHealthCheck/Run-IndexHealthCheck.ps1)
before Setup or refresh when drift is suspected.

Partial provisioning: if `Indexes/` exists but required files or header rows
are missing, treat as **partially provisioned**. Offer Setup or scoped repair;
do not silently create index files during a normal refresh.

## Output Files

| File | Role |
| --- | --- |
| `Indexes/ChatMarkdownIndex.md` | Per-file inventory: topic, status, decisions, routing, Ready For Website |
| `Indexes/FollowThroughIndex.md` | Aggregated tasks and questions from source planning files |

Column specs: [Structure.md](Structure.md).

## Source Folders (archetypeHost — clean root)

Index these GetEstablished source folders:

- `Plans/` — planning tracks, maps, backlog, registers (not all Archive copies)
- `Content/Website/Pages/` — publishable page drafts
- `Workspace/` — describe owner paths; pointer only; do not relocate content
- `Capabilities/README.md` and `Capabilities/AgentCapabilityGuide.md` — routing snapshot rows (optional column in ChatMarkdownIndex)

Do not index `Intake/`, `Archive/`, or commissioned-only envelope paths unless
owner explicitly expands scope.

## Durable Task Discovery

`Plans/AgentTaskBacklog.md` is the durable task queue.
`Indexes/FollowThroughIndex.md` is a finding aid surfacing important tasks from
planning files — not a replacement for the backlog.

During refresh:

- Read `AgentTaskBacklog.md` as primary queue source
- Preserve source wording; point index entries to source files
- Do not move backlog items between Ready Next / Later / Blocked / Completed

## Health Check (Read-Only)

[IndexHealthCheck.md](IndexHealthCheck.md) validates:

- Capability metadata and registry alignment
- Document metadata blocks
- Folder README coverage
- Legacy `Docs/` references in active files
- Stale plan signals (see CapabilityAudit StalePlanDetection)
- Broken related links (sampled)
- Source-of-truth consistency

Health check does **not** write under `Indexes/` unless owner requests a
`Plans/IndexHealthReport.md` file.

## Data Boundaries

- **May read:** source folders above, existing index files, registry files
- **May write:** only `Indexes/` during refresh; optional `Plans/*HealthReport*` during health pass when requested
- **Must never:** move, rename, delete, or rewrite source bodies; invent decisions; mark Ready For Website **Yes** without owner review

## After A Refresh

End with one fenced `text` handoff per `AGENTS.md`. Do not bulk-edit unrelated files.

## Related

- [WorkflowIndex.md](WorkflowIndex.md)
- [README.md](README.md)
- [../../Standards/IndexHealthStandard.md](../../Standards/IndexHealthStandard.md)
