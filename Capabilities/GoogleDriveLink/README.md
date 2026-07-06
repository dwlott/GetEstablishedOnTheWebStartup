<!-- Index: Safe Google Drive connection guidance for repository and agent workflows. -->
<!--
IndexTitle: GoogleDriveLink Capability
IndexDescription: Reusable guidance for connecting repository workflows to Google Drive safely.
IndexType: Capability
CapabilityName: GoogleDriveLink
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-05
-->

# GoogleDriveLink Capability

- **Version:** 1
- **Tier:** Universal
- **Purpose:** Operate the **ChatGPT + Codex** workflow when Google Drive is the
  cloud review surface, plus safe Drive connection guidance. Mirror runs
  **only when prompted** — not by default.
- **Inputs:** Intended Drive role, target MCP or connector path, access level,
  human account or Workspace decision, OAuth app status, and available official
  setup docs.
- **Outputs:** Safe setup guidance, connection rules, copy-ready operating
  prompt, security guardrails, open questions, and future Skill boundary notes.
- **WhenToUse:** ChatGPT is planner, Codex is worker, and Google Drive is the
  review mirror; or when planning safe Drive connection, capture, and handoff
  patterns.

## Start Here

**Run the workflow index:**

- [WorkflowIndex.md](WorkflowIndex.md)

All operational steps for the ChatGPT + Codex + Drive stack live in this
Capability folder. If this folder were deleted, the full Google Drive workflow
instructions would be lost with it.
- **Does not replace:** Google Cloud Console setup, OAuth consent decisions,
  live MCP authentication, credential storage, sync automation, or future
  runtime-specific Skills.

## Recommended Architecture

Prefer the official Google Drive remote MCP server as the default connection
path when Google Drive access is needed. The planning source marks it as
Developer Preview and records the endpoint and official references.

Document OpenAI's Google Drive connector as an alternate path for Responses API
workflows when an application already owns the OAuth flow and can supply an
access token.

Do not begin with a custom sync script. Start with documented steps, human
approval, least-privilege access, and a read-only or file-specific test path
where possible.

## Setup Guidance

For the current GEOTW setup target, use the project-level setup decisions and
live setup checklist:

- [../../Plans/GoogleDriveLinkSetupDecisions.md](../../Plans/GoogleDriveLinkSetupDecisions.md)
- [../../Plans/GoogleDriveLinkLiveSetupChecklist.md](../../Plans/GoogleDriveLinkLiveSetupChecklist.md)

These files may include owner-specific, non-secret decisions. Keep reusable
rules here in the Capability and keep account-specific setup records in
`Plans/`.

For the proven ChatGPT Google Drive App access path, use:

- [WorkflowIndex.md](WorkflowIndex.md) — runnable step index (start here)
- [../MirrorToWindows/WorkflowIndex.md](../MirrorToWindows/WorkflowIndex.md) — on-demand mirror refresh
- [RepositoryAccessWorkflow.md](RepositoryAccessWorkflow.md)
- [DriveCaptureWorkflow.md](DriveCaptureWorkflow.md)

This workflow documents Google Drive as an on-the-go repository reading,
chat bootstrapping, mobile capture, and large-file intake path. The real local
Git repository remains the editing source of truth. When using ChatGPT Apps,
search for `Google Drive` and choose the Google Drive App developed by OpenAI.
For **Save To GCloud**, create a temporary Google Doc in My Drive root for
later sorting. Use the Codex Google Drive plugin at the desk to read or export
those Google Docs and promote useful content into real repository Markdown; do
not treat `.gdoc` pointer files as repository Markdown.

For live desk work that needs a temporary cloud handoff document or refreshed
repository verification between a planning agent and an implementation agent,
use the
[GDrive Enhanced Agentic Workflow Trigger](DriveCaptureWorkflow.md#gdrive-enhanced-agentic-workflow-trigger).
This is for active coordination, not save-now-process-later chat capture.

For long implementation prompts that are awkward to copy from chat, use the
[Long Prompt GDrive Handoff](DriveCaptureWorkflow.md#long-prompt-gdrive-handoff).
Normally, planning agents should provide Codex prompts in a click-to-copy code
block in chat. A planning file or Google Drive handoff does not replace the
click-to-copy prompt unless the prompt is too long or complex for normal chat
use. For long or complex planning notes and Codex prompts, ChatGPT writes the
full prompt to My Drive root as a native Google Doc, then gives the
implementation agent a short pointer prompt with the document URL. The Google
Doc may be titled naturally and does not need to end in `.md`.

Before attempting the write, check that the Google Drive connector/app is
active. If Drive write fails, stop and ask the user to load or enable Drive.
Retry only once after the user confirms Drive is active. Do not repeatedly
retry Drive writes.

The Drive doc is a temporary communication artifact; local Git remains the
source of truth. Codex-specific wording belongs only in labeled examples.

For root handoff notes such as `Pick Up Here - GEOTW`, keep the note compact:
current project, current task, why it is next, files to read, boundary, and an
optional task-specific caution. The standard phrase "Pick up from where we
left off in the last chat" means to find that active project root note first,
then boot from the gdrive repo copy using repository source-of-truth files.
The note is only a pointer. Durable workflow rules remain in `AGENTS.md`,
`Plans/RepositorySearchMap.md`, `Plans/AgentTaskBacklog.md`, and
this Capability.

For on-demand desk refresh of the Google Drive repository copy, use
[../MirrorToWindows/WorkflowIndex.md](../MirrorToWindows/WorkflowIndex.md).
**No mirroring is the default.** Run mirror only when the owner or planner
requests review sync or an explicit mirror refresh.

That automation keeps `My Drive / Repositories / GetEstablished` current from
local Git. One-way only: local Git and GitHub remain source of truth; the Drive
copy is a disposable review mirror when purpose=review, or a backup copy when
purpose=backup.

When mirror is requested, follow **MirrorToWindows** (see
[../MirrorToWindows/MirrorWorkflow.md](../MirrorToWindows/MirrorWorkflow.md)).
Dry-run check is optional for investigation only.

Google Drive Desktop sync or mirror is not required for the ChatGPT App
workflow. The local `H:\My Drive\Repositories\GetEstablished` path is
used by the optional desk refresh automation when Google Drive Desktop exposes
that Drive location on the workstation.

Capability-owned Skill:

- [GDriveRepositoryRefreshSkillPlan.md](GDriveRepositoryRefreshSkillPlan.md)
- [Skills/GDriveRepositoryRefresh/SKILL.md](Skills/GDriveRepositoryRefresh/SKILL.md)

The runtime-neutral `GDriveRepositoryRefresh` Skill may remind agents when a
**requested** review sync is still pending. It does not mirror by default.

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | promoted workflow — Google Drive link planning and FastMirror pass |
| **SourceSummary** | Safe Google Drive connection and ChatGPT + Codex on-demand review via WorkflowIndex |
| **PromotionStatus** | Active |
| **Dependencies** | SituationalAwareness, SourceOfTruthAndMirrorStandard; Automation/GoogleDriveRepositoryRefresh |
| **RelatedFiles** | WorkflowIndex.md, MirrorWorkflow.md, DriveCaptureWorkflow.md, RepositoryAccessWorkflow.md, Rules.md, Prompt.md |
| **LastReviewed** | 2026-06-05 |
| **HarmonizationNotes** | Runnable steps in Capability folder; Plans setup decisions remain in Plans/ |

## Data Boundaries

This Capability may document:

- The intended role for Google Drive in a repository workflow.
- Which MCP client, connector, or human setup path is being considered.
- Which least-privilege access mode is recommended.
- Non-secret links to official Google and OpenAI documentation.

This Capability must not store:

- OAuth client secrets.
- Access tokens or refresh tokens.
- `.env` files.
- Generated credential JSON.
- Local MCP client config containing secrets.
- Owner-specific Google account details beyond non-secret planning questions.

Outputs belong in `Capabilities/GoogleDriveLink/` for reusable guidance
and `Plans/` for planning decisions. Integration artifacts do not belong
in `Workspace/` or `Content/`.

## Skill Boundary

Version 1 includes one runtime-neutral scaffolded Skill:

- [Skills/GDriveRepositoryRefresh/SKILL.md](Skills/GDriveRepositoryRefresh/SKILL.md)

The Skill keeps the Google Drive repository copy current after local repository
edits. It uses existing automation and does not add scripts, runtime adapters,
or broader PowerShell permissions.

Propose a Skill only after repeated executable setup, validation, or
maintenance steps are proven useful. The candidate Skill name is
**GoogleDriveMcpConnect**.

The current repository Skills model prefers Capability-owned Skills. If the
owner later approves a future Skill, the preferred canonical path is:

```text
Capabilities/GoogleDriveLink/Skills/GoogleDriveMcpConnect/SKILL.md
```

If the owner later approves an Automation-hosted or runtime-adapter surface,
the candidate future adapter path may be:

```text
Automation/Skills/GoogleDriveMcpConnect/SKILL.md
```

Do not create `Automation/Skills/` or any Skill folder during ordinary
GoogleDriveLink planning or setup guidance.

## Open Questions

The planning file keeps these questions open and non-blocking:

- Which Google account or Workspace owns the connection?
- Is the Google app internal/testing only, or external/public?
- Which MCP client should be targeted first?
- Should Drive access be read-only, file-specific, or create/update capable?
- Should GEOTW use Google Drive as a source, intake area, archive, export
  destination, or only a manually consulted reference?
- Should future Skill discovery stay Capability-owned, or should the owner
  approve a top-level or runtime-adapter surface?

## Authority Model

```text
Local Git     = source of truth (Codex edits here)
GitHub        = backup / history
Drive copy    = disposable review mirror (after on-demand mirror)
Drive root    = intake and handoff Docs (outside mirror tree)
```

Use [DropboxLink](../DropboxLink/README.md) when ChatGPT must read/write real
`.md` files in repository folders.

## Related

- Runnable index: [WorkflowIndex.md](WorkflowIndex.md)
- On-demand mirror: [MirrorWorkflow.md](MirrorWorkflow.md)
- Operating prompt: [Prompt.md](Prompt.md)
- Safety rules: [Rules.md](Rules.md)
- Repository access workflow: [RepositoryAccessWorkflow.md](RepositoryAccessWorkflow.md)
- Drive capture workflow: [DriveCaptureWorkflow.md](DriveCaptureWorkflow.md)
- GDrive repository refresh Skill plan: [GDriveRepositoryRefreshSkillPlan.md](GDriveRepositoryRefreshSkillPlan.md)
- Codex permission config service plan:
  [../../Plans/CodexGDriveRefreshPermissionConfigPlan.md](../../Plans/CodexGDriveRefreshPermissionConfigPlan.md)
- Google Drive repository refresh automation: [../../Automation/GoogleDriveRepositoryRefresh/README.md](../../Automation/GoogleDriveRepositoryRefresh/README.md)
- Planning source: [../../Plans/GoogleDriveLinkCapabilityPlan.md](../../Plans/GoogleDriveLinkCapabilityPlan.md)
- Live setup checklist: [../../Plans/GoogleDriveLinkLiveSetupChecklist.md](../../Plans/GoogleDriveLinkLiveSetupChecklist.md)
- Capability registry: [../README.md](../README.md)
- Provisioned structure standard: [../../Standards/CapabilityProvisionedStructure.md](../../Standards/CapabilityProvisionedStructure.md)

## Workflow Updater Reminder

When GoogleDriveLink changes, review the optional repository refresh
automation in the same pass:

- [GDriveRepositoryRefreshSkillPlan.md](GDriveRepositoryRefreshSkillPlan.md)
- [../../Automation/GoogleDriveRepositoryRefresh/README.md](../../Automation/GoogleDriveRepositoryRefresh/README.md)
- [../../Automation/GoogleDriveRepositoryRefresh/Refresh-GDriveRepository.ps1](../../Automation/GoogleDriveRepositoryRefresh/Refresh-GDriveRepository.ps1)
- [../../Automation/GoogleDriveRepositoryRefresh/refresh_gdrive_repository.py](../../Automation/GoogleDriveRepositoryRefresh/refresh_gdrive_repository.py)

The Drive copy exists to support ChatGPT access and reference-mirror
visibility. It must not quietly drift into an edit source, backup role, or
reverse-sync workflow.

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-06-05 | 1 | Self-contained WorkflowIndex; on-demand mirror only; MirrorWorkflow | README, Rules, RepositoryAccessWorkflow, Prompt, WorkflowIndex, MirrorWorkflow |
| 2026-06-04 | 1 | Completed post-FastMirror documentation optimization | FastMirror is normal mode; dry-run is optional; remaining Plans and Rules docs aligned with reference-mirror authority model | README, Rules, RepositoryAccessWorkflow, GDriveRepositoryRefreshSkillPlan, CodexGDriveRefreshPermissionConfigPlan, CapabilityWorkflowCaptureAndSkillPromotionPlan, GDriveRefreshDryRunApplyOptimizationPlan, PlannerWorkerWorkflow |
| 2026-06-01 | 1 | Clarified dry-run, apply, and final verification expectations for repository refresh | Dry-run protects mirror apply but does not refresh the Drive copy; ChatGPT review should wait for a final zero-change verification dry-run | README, Rules, GDriveRepositoryRefreshSkillPlan, Skill, automation README |
| 2026-06-01 | 1 | Strengthened long prompt Drive handoff rules | Long Drive handoffs still need a short click-to-copy pointer prompt, Drive availability should be checked before writing, and failed writes should retry only once after user confirmation | README, Rules, DriveCaptureWorkflow, PlannerWorkerWorkflow, AgentWorkflowModes |
| 2026-06-01 | 1 | Clarified click-to-copy prompts and native Google Doc handoffs | Short and moderate Codex prompts stay in chat; native Drive-root Google Docs are only a communication layer for long or complex handoffs | README, Rules, DriveCaptureWorkflow, RepositoryAccessWorkflow, PlannerWorkerWorkflow, AgentWorkflowModes, ChatToMarkdown |
| 2026-06-01 | 1 | Added enhanced live handoff trigger and refresh verification guidance | Live desk loops need a clear switch point for temporary Drive handoff docs and actual-file verification without making Drive the source of truth | README, DriveCaptureWorkflow, RepositoryAccessWorkflow, AgentCapabilityGuide, PlannerWorkerWorkflow |
| 2026-06-01 | 1 | Added Long Prompt GDrive Handoff workflow | Long generated Codex prompts can use a temporary Drive-root Google Doc pointer without moving source of truth out of local Git | README, DriveCaptureWorkflow |
| 2026-05-31 | 1 | Added standard resume phrase for Drive root handoff notes | "Pick up from where we left off" should resolve to the active project root note, then repository boot files | README, RepositoryAccessWorkflow, DriveCaptureWorkflow |
| 2026-05-31 | 1 | Added compact Drive root handoff guidance | Root notes should point to repository source-of-truth files instead of repeating durable workflow rules | README, RepositoryAccessWorkflow, DriveCaptureWorkflow |
| 2026-05-31 | 1 | Scaffolded runtime-neutral `GDriveRepositoryRefresh` Skill | The check-then-apply refresh workflow is repeated and stable enough to package without adding automation or runtime adapters | README, GDriveRepositoryRefreshSkillPlan, Skills/GDriveRepositoryRefresh/SKILL.md, SkillRegistry |
| 2026-05-31 | 1 | Added `GDriveRepositoryRefresh` Skill plan | A future Skill should make stale Drive copies hard to forget without silently running destructive mirror apply | README, GDriveRepositoryRefreshSkillPlan, SkillRegistry |
| 2026-05-31 | 1 | Clarified refresh automation roles and reminder | GoogleDriveLink and the desk refresh helper should be reviewed together when Drive workflow guidance changes | README, RepositoryAccessWorkflow, Automation/GoogleDriveRepositoryRefresh |
| 2026-05-31 | 1 | Added optional repository refresh automation pointer | A one-way local-to-Drive copy helps ChatGPT read current repository files while preserving local Git as source of truth | README, RepositoryAccessWorkflow, Automation/GoogleDriveRepositoryRefresh |
| 2026-05-31 | 1 | Added Drive capture and Save To GCloud workflow | Google Docs in My Drive root are useful temporary captures; local Git remains the promoted source of truth | README, RepositoryAccessWorkflow, DriveCaptureWorkflow |
| 2026-05-30 | 1 | Added ChatGPT Google Drive App repository access workflow | Preserve the proven on-the-go read and capture path while keeping local Git as the edit source of truth | README, RepositoryAccessWorkflow |
| 2026-05-29 | 1 | Linked GEOTW live setup checklist | Keep external setup concrete while preserving credential-free Capability boundaries | README |
| 2026-05-29 | 1 | Initial GoogleDriveLink Capability shell | Keep Drive connection guidance reusable, credential-free, and documentation-first | README, Rules, Prompt |
