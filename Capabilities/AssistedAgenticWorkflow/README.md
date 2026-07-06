<!-- Index: Owner-supervised agentic pass cycle with optional connector inspection. -->
<!--
IndexTitle: AssistedAgenticWorkflow Capability
IndexDescription: Owner-supervised agentic workflow with Dropbox connector inspection for the GetEstablished repository.
IndexType: Capability
CapabilityName: AssistedAgenticWorkflow
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-08
-->

# AssistedAgenticWorkflow Capability

> **Cloud review workflows:** For ChatGPT + Codex with Dropbox or Google Drive,
> use the dedicated Capability indexes — they contain the full runnable steps:
> [DropboxLink/WorkflowIndex.md](../DropboxLink/WorkflowIndex.md) or
> [GoogleDriveLink/WorkflowIndex.md](../GoogleDriveLink/WorkflowIndex.md).
> This Capability covers the generic owner-supervised pass cycle only.

- **Version:** 1
- **Tier:** Universal
- **Purpose:** Define and operate the owner-supervised agentic workflow where
  a local agent works directly in the active repository and an external
  assistant (such as ChatGPT) optionally inspects the repository state
  through a synced Dropbox folder or connector view. The local repository is
  always the source of truth. The external view is an inspection surface only.
- **Inputs:** Owner-approved scope for the pass; `AGENTS.md` and task-specific
  files for agent context; optional Dropbox connector access for the external
  assistant to verify repository state.
- **Outputs:** Changed repository files, a concise pass summary (files
  changed, verification result, owner decisions needed, recommended next
  task), and any owner-decision items requiring follow-up.
- **WhenToUse:** Use whenever the owner wants to run a focused, supervised
  agent pass on repository files with optional external assistant inspection
  through a synced Dropbox or cloud view. Also use when starting or resuming
  a cleanup, normalization, or content pass.

## How The Workflow Operates

The workflow runs in a cycle:

1. Owner boots an agent session with context from `AGENTS.md` and any
   named task-specific files.
2. Owner describes the approved scope for the pass.
3. Agent reads required files, works within the approved scope, and writes
   changes directly to the local repository.
4. Agent produces a concise summary: files changed, verification result,
   owner decisions needed, and next recommended task.
5. Owner reviews the summary and the local repository state.
6. Owner decides to approve the next pass, adjust scope, or stop.
7. The external assistant (ChatGPT via Dropbox connector) may inspect the
   repository state through the synced Dropbox view to provide an independent
   review layer.

The local repository is the source of truth at every step. The Dropbox
connector view is read-only and may lag behind local state if sync is
incomplete.

## Boundary With Other Capabilities

| Capability | Boundary |
| --- | --- |
| GoogleDriveLink | Governs Google Drive connection, handoff, and write rules. Use AssistedAgenticWorkflow for the pass cycle; use GoogleDriveLink when Drive specifically is the target. |
| ChatMemoryCapture | Prepares durable capture notes for important decisions after a pass. AssistedAgenticWorkflow governs the pass structure; ChatMemoryCapture handles post-pass memory extraction. |
| ChatToMarkdown | Converts chat output to repository Markdown. ChatToMarkdown handles the conversion task; AssistedAgenticWorkflow governs the broader supervised pass cycle. |
| GitHubWorkflow | Governs git operations. AssistedAgenticWorkflow governs pass structure and inspection rules; GitHubWorkflow governs commit, push, and branch steps. |

## Dropbox Profile

The active inspection surface for this repository is Dropbox. The relevant
paths are:

| Path type | Path |
| --- | --- |
| Active repository (Dropbox) | `/Repositories/GetEstablished` |
| Old source reference (Dropbox) | `/Repositories/GetEstablishedOnTheWeb` |
| Active local path | `C:\Users\dwlot\Dropbox\Repositories\GetEstablished` |

The old/source path is reference only. Do not confuse the two.

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | promoted workflow — AssistedAgenticWorkflowCapturePlan |
| **SourceSummary** | Generic owner-supervised pass cycle; cloud-specific steps in DropboxLink/GoogleDriveLink |
| **PromotionStatus** | Active |
| **Dependencies** | SituationalAwareness |
| **RelatedFiles** | Rules.md, Prompt.md, PlannerWorkerWorkflow.md |
| **LastReviewed** | 2026-06-05 |
| **HarmonizationNotes** | Dropbox profile paths in README are inspection-only; local Git is SoT |

## Related

- Canonical rules: [Rules.md](Rules.md)
- Worker entry: [Prompt.md](Prompt.md)
- Self-directed loop: [AgentSelfDirectedLoop.md](AgentSelfDirectedLoop.md)
- Planner-to-worker brief: [PlannerWorkerTaskBriefPrompt.md](PlannerWorkerTaskBriefPrompt.md)
- Planner/worker workflow guide: [PlannerWorkerWorkflow.md](PlannerWorkerWorkflow.md)
- Cloud-agent PR cycle (no local workstation): [CloudAgentWorkflow.md](CloudAgentWorkflow.md)
- Planning baseline: [AssistedAgenticWorkflowCapturePlan.md](../../Plans/AssistedAgenticWorkflowCapturePlan.md)
- Google Drive sibling: [GoogleDriveLink](../GoogleDriveLink/README.md)
- Agent operating instructions: [AGENTS.md](../../AGENTS.md)

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-06-09 | 1 | Terminology: hosted-agent PR workflow | Formal terms in NamingStandard §Environment-Adaptive Model | CloudAgentWorkflow |
| 2026-06-08 | 1 | Hosted-agent supervised pass cycle | PR review without local clone | CloudAgentWorkflow |
| 2026-06-03 | 1 | CAP-3 SituationalAwareness; AAW Prompt reads core SA first | Centralize orientation outside AAW | Prompt |
| 2026-06-03 | 1 | Instruction optimization pass | Separate write path from Dropbox inspection; promote SA plan Section 4 lessons to Rules §7 | Rules, Prompt |
| 2026-06-02 | 1 | Initial Capability; promoted from planning capture | Formalize owner-supervised workflow with Dropbox connector inspection lessons | README, Rules, Prompt |
