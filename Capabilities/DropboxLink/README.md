<!-- Index: Dropbox connection and review mirror for ChatGPT plus Codex workflow. -->
<!--
IndexTitle: DropboxLink Capability
IndexDescription: Dropbox-enabled agentic workflow for ChatGPT planner and Codex worker with on-demand review mirror.
IndexType: Capability
CapabilityName: DropboxLink
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-05
-->

# DropboxLink Capability

- **Version:** 1
- **Tier:** Universal
- **Purpose:** Operate the **ChatGPT + Codex** workflow when Dropbox is the
  cloud review surface. ChatGPT plans and reviews real `.md` files; Codex edits
  local Git; mirror runs **only when prompted** — not by default.
- **Inputs:** Owner-approved scope; active Dropbox connector; local Git
  repository; optional mirror request for planner review.
- **Outputs:** Local repository edits (Codex); optional Dropbox mirror sync;
  planner review from Dropbox paths; concise handoff blocks.
- **WhenToUse:** ChatGPT is planner, Codex is worker, and ChatGPT needs Dropbox
  to read or write repository Markdown for planning and review.

## Start Here

**Run the workflow index:**

- [WorkflowIndex.md](WorkflowIndex.md)

Everything needed to operate this Capability lives in `Capabilities/DropboxLink/`.
If this folder were deleted, the full Dropbox workflow instructions would be
lost with it.

## Authority Model

```text
Local Git     = source of truth (Codex edits here)
GitHub        = backup / history
Dropbox copy  = disposable review mirror (ChatGPT reads here after mirror)
IncomingIdeas = cloud intake (protected from mirror deletion)
```

## Default: No Mirroring

Mirroring is **not** automatic after worker passes. The owner or planner
prompts mirror only when ChatGPT must review updated files. Mirror apply:
[../MirrorToWindows/WorkflowIndex.md](../MirrorToWindows/WorkflowIndex.md).
Planner loop: [WorkflowIndex.md](WorkflowIndex.md) Step 4.

## Why Dropbox For This Stack

- ChatGPT reads and writes **actual Markdown** in repository folders.
- No Google Docs workaround for planner review.
- Strong fit for ChatGPT planner + Codex worker loops.

Use **GoogleDriveLink** when Google Drive is the chosen review surface.

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | promoted workflow — ChatGPT + Codex cloud mirror planning (2026-06-05) |
| **SourceSummary** | Self-contained Dropbox review workflow for ChatGPT planner and Codex worker; on-demand mirror only |
| **PromotionStatus** | Active |
| **Dependencies** | SituationalAwareness, SourceOfTruthAndMirrorStandard, AgentSituationalAwareness |
| **RelatedFiles** | WorkflowIndex.md, MirrorToWindows, RepositoryAccessWorkflow.md, IntakeWorkflow.md, Rules.md, Prompt.md |
| **LastReviewed** | 2026-06-05 |
| **HarmonizationNotes** | Mirror proof-of-concept on hold; Git not connected to Dropbox |

## Capability Files

| File | Role |
| --- | --- |
| [WorkflowIndex.md](WorkflowIndex.md) | **Runnable step index** — start here |
| [../MirrorToWindows/WorkflowIndex.md](../MirrorToWindows/WorkflowIndex.md) | On-demand local → mirror target |
| [MirrorWorkflow.md](MirrorWorkflow.md) | Redirect stub → MirrorToWindows |
| [RepositoryAccessWorkflow.md](RepositoryAccessWorkflow.md) | Connector read/write paths |
| [IntakeWorkflow.md](IntakeWorkflow.md) | `IncomingIdeas/` intake |
| [Rules.md](Rules.md) | Operating rules |
| [Prompt.md](Prompt.md) | Copy-ready prompts |

## Cursor Sessions

When both planner and worker run in Cursor with the local repo open, skip
Dropbox mirror steps and read local files directly.

## Capability Changelog

| Date | Ver | Change | Files |
| --- | ---: | --- | --- |
| 2026-06-05 | 1 | Initial DropboxLink Capability with self-contained workflow index | All |

## Related

- Sibling cloud Capability: [GoogleDriveLink](../GoogleDriveLink/README.md)
- Supervised pass cycle (generic): [AssistedAgenticWorkflow](../AssistedAgenticWorkflow/README.md)
