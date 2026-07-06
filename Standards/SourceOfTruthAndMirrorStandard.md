<!--
IndexTitle: Source Of Truth And Mirror Standard
IndexDescription: Thin authority rules for local Git, GitHub, and optional cloud review surfaces.
IndexType: Standard
IndexStatus: Active
LastEdited: 2026-06-12
-->

# Source Of Truth And Mirror Standard

Principles only. Runnable mirror and cloud review steps live in Capabilities — not here.

Apply rules (purpose, purge, exclusions): [RepositoryMirrorStandard.md](RepositoryMirrorStandard.md).

## Authority Hierarchy

| Rank | Surface | Role |
| --- | --- | --- |
| 1 | Local Git repository | Source of truth — all normal edits |
| 2 | GitHub | Backup, history, collaboration |
| 3 | Dropbox or Google Drive | Optional review or owner-chosen mirror target — **not connected to Git** |

## When No Local Clone Exists

Owner confirmed (OpenQuestions ENV-3, 2026-06-09). For **Remote-only** or
**GitHub-then-local** operating profiles who have not yet cloned locally (see
[CloudOnlyPlanningAndMeasurementDevicePlan.md](../Plans/CloudOnlyPlanningAndMeasurementDevicePlan.md);
terminology:
[NamingStandard.md](NamingStandard.md) §Environment-Adaptive Model):

- **GitHub** is the working collaboration surface for plans, ideas, reviews, and
  cloud-agent changes.
- Cloud review mirrors (Dropbox, Google Drive) are **never required**.
- Progress verification uses **GitHub state** (merged PRs, file contents on
  default branch) until a local clone exists.
- When the user later clones, **local Git becomes authoritative** per the
  hierarchy above — upgrade, not migration.

## Git And Cloud Are Not Connected

- Git is never linked to Dropbox or Google Drive.
- Do not use cloud folders as a Git working copy, remote, or substitute for GitHub.
- Do not copy `.git/` to cloud review surfaces.
- GitHub remains the durable version-control record.

## Default: No Cloud Copy

After local edits:

- **Do not** automatically copy files to Dropbox or Google Drive.
- **Do not** treat cloud storage as backup (GitHub is backup).

Cloud copy happens **only** when the owner explicitly requests a mirror refresh
or review sync for a remote planner.

## When Cloud Review Applies

Use when **all** are true:

- ChatGPT (or similar) is planner without reliable local repository access;
- A local worker (Codex, Cursor CLI, Claude Code) edits local Git;
- The owner requests review sync so the planner can read current files.

**Cursor unified sessions** (planner and worker in IDE with repo open): skip
cloud copy; read local files directly.

## Runnable Workflow Indexes

Operational steps are self-contained in:

| Task | Start file |
| --- | --- |
| Mac repository mirror | `Capabilities/MirrorToMac/WorkflowIndex.md` |
| Windows repository mirror | `Capabilities/MirrorToWindows/WorkflowIndex.md` |
| Dropbox mirror refresh *(alias)* | Platform mirror cap + saved target path |
| Google Drive mirror refresh *(alias)* | Platform mirror cap + saved target path |
| Dropbox ChatGPT + Codex planner loop | `Capabilities/DropboxLink/WorkflowIndex.md` |
| Google Drive ChatGPT + Codex planner loop | `Capabilities/GoogleDriveLink/WorkflowIndex.md` |

First-time mirror setup writes paths to `Workspace/OwnerPreferences.md` § Connectors.

Mirror apply details:

- `Capabilities/MirrorToWindows/MirrorWorkflow.md`
- `Capabilities/MirrorToMac/MirrorWorkflow.md`
- [RepositoryMirrorStandard.md](RepositoryMirrorStandard.md) — purpose matrix

Vendor-named mirror caps (`MirrorToDropbox`, `MirrorToGoogleDrive`) are **stub
aliases** during migration. Link Capabilities retain stub redirects at
`*/MirrorWorkflow.md`.

Manual copy via File Explorer is a valid first method when review sync is
requested.

## Disposable Review Copies

Cloud or secondary-folder repository copies may be **disposable review mirrors**
when **Mirror purpose** is `review` or `portability`. Rebuild from local Git
when needed. Destination file deletions during a full one-way mirror (`/MIR`)
are normal for those purposes.

When **Mirror purpose** is `backup`, purge is **off** by default — extras on
the destination are not deleted. See [RepositoryMirrorStandard.md](RepositoryMirrorStandard.md).

## Intake Protection

When using one-way mirror workflows:

- Exclude `IncomingIdeas/` (Dropbox agent-owned intake).
- Exclude local `Intake/` migration reference from routine mirror trees.

## Related

- [RepositoryMirrorStandard.md](RepositoryMirrorStandard.md)
- [../Plans/RepositoryMirrorCapabilityStreamlinePlan.md](../Plans/RepositoryMirrorCapabilityStreamlinePlan.md)
- [../Plans/MirrorCapabilitiesSplitPlan.md](../Plans/MirrorCapabilitiesSplitPlan.md)
- [AgentSituationalAwareness.md](AgentSituationalAwareness.md)
- [CloudOnlyPlanningAndMeasurementDevicePlan.md](../Plans/CloudOnlyPlanningAndMeasurementDevicePlan.md)
- [CloudMirrorArchitectureHarmonizationPlan.md](../Plans/CloudMirrorArchitectureHarmonizationPlan.md)
- [../AGENTS.md](../AGENTS.md)
- [../Plans/InstructionEmbeddingRoadmap.md](../Plans/InstructionEmbeddingRoadmap.md)
