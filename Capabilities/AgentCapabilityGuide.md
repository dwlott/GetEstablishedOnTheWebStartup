<!--
IndexTitle: Agent Capability Guide
IndexDescription: GetEstablishedOnTheWebStartup starter repository intent routing.
IndexType: Capability
IndexStatus: Active
LastEdited: 2026-06-19
-->

# Agent Capability Guide

Use after [AGENTS.md](../AGENTS.md) for workflow tasks on
**GetEstablishedOnTheWebStartup**. Compact router: [RouterIndex.md](RouterIndex.md).
Full registry: [README.md](README.md).

> **Canonical routing (this repo).** This guide and [RouterIndex.md](RouterIndex.md)
> list **only folders on disk**.

## How To Route

1. Read [RouterIndex.md](RouterIndex.md) first.
2. Match user intent in the table below.
3. Open the Capability folder; read `README.md`, then `Prompt.md` / `Rules.md`.
4. For `LocalAgentToolSetup`, read [VendorToolIndex.md](LocalAgentToolSetup/VendorToolIndex.md) first.
5. Read [SituationalAwareness/Rules.md](SituationalAwareness/Rules.md) before writes.

## Intent Routing Table

| User intent | Capability | Entry | Status | Tier | Pre-Checks |
| --- | --- | --- | --- | --- | --- |
| Get started; owner goals; beginner orientation | **GettingStarted** | [Prompt](GettingStarted/Prompt.md) | Active | Archetype | OwnerGoals.md |
| Install or configure local agent app | **LocalAgentToolSetup** | [Prompt](LocalAgentToolSetup/Prompt.md) | Active | Universal | VendorToolIndex |
| Save chat to markdown | **ChatToMarkdown** | [Prompt](ChatToMarkdown/Prompt.md) | Active | Universal | Rules.md destination |
| Capture or triage chat/session to Ideas or Plans | **InstructionCapture** | [Prompt](InstructionCapture/Prompt.md) | Active | Universal | IdeaCaptureTemplate |
| Review website page **examples** under `Content/Website/Pages/` | **ContentReview** | [Prompt](ContentReview/Prompt.md) | Active | Archetype | Page drafts on disk |
| Draft owner's one-page business website | **OnePageWebsite** | [Prompt](OnePageWebsite/Prompt.md) | Active | Archetype | Approved business inputs |
| Google Drive; ChatGPT + Codex review | **GoogleDriveLink** | [WorkflowIndex](GoogleDriveLink/WorkflowIndex.md) | Active | Universal | AgentSituationalAwareness |
| Dropbox; ChatGPT + Codex review | **DropboxLink** | [WorkflowIndex](DropboxLink/WorkflowIndex.md) | Active | Universal | AgentSituationalAwareness |
| Refresh repository mirror on Windows | **MirrorToWindows** | [WorkflowIndex](MirrorToWindows/WorkflowIndex.md) | Active | Universal | OwnerPreferences |
| Refresh Google Drive mirror *(alias)* | **MirrorToGoogleDrive** → MirrorToWindows | [WorkflowIndex](MirrorToGoogleDrive/WorkflowIndex.md) | Stub | Universal | OwnerPreferences |
| Refresh Dropbox mirror *(alias)* | **MirrorToDropbox** → MirrorToWindows | [WorkflowIndex](MirrorToDropbox/WorkflowIndex.md) | Stub | Universal | OwnerPreferences |
| Owner-supervised pass cycle | **AssistedAgenticWorkflow** | [Prompt](AssistedAgenticWorkflow/Prompt.md) | Active | Universal | SituationalAwareness |
| Git status; pull; push; GitHub onboarding | **GitHubWorkflow** | [Prompt](GitHubWorkflow/Prompt.md) | Active | Universal | SourceOfTruthAndMirrorStandard |
| Repository folders; scaffold; growth tree | **RepositoryScaffold** | [Prompt](RepositoryScaffold/Prompt.md) | Active | Universal | IntendedRepositoryTree |
| Index new files; refresh Indexes/ by hand (default) | **ManualIndexing** | [WorkflowIndex](ManualIndexing/WorkflowIndex.md) | Active | Universal | Writes under Indexes/ only |
| Index format, Setup, health check | **Indexing** | [WorkflowIndex](Indexing/WorkflowIndex.md) | Active | Universal | Owner approval for Setup |
| Always-on orientation | **SituationalAwareness** | [Rules](SituationalAwareness/Rules.md) | Active | Universal | Boot with AGENTS.md |
| Create or promote a WebPresence Capability | **CapabilityCreate** | [Prompt](CapabilityCreate/Prompt.md) | Active | Universal | CapabilityMetadataStandard |
| Harmonize Capabilities, tree, or readiness | **CapabilityHarmonize** | [Prompt](CapabilityHarmonize/Prompt.md) | Active | Universal | — |
| Audit catalog, routing, or readiness | **CapabilityAudit** | [AuditChecklist](CapabilityAudit/AuditChecklist.md) | Active | Universal | Review-only by default |
| Initialize related web-presence repository shell | **RepositoryInitialize** | [Prompt](RepositoryInitialize/Prompt.md) | Active | Archetype | RepositoryCoreStandard |
| Advanced re-packaging from product source | **StarterRepositoryPackage** | [WorkflowIndex](StarterRepositoryPackage/WorkflowIndex.md) | Active | Archetype | Owner scope only |
| Plan Google Business Profile setup/readiness | **GoogleBusinessProfile** | [README](GoogleBusinessProfile/README.md) | Planned | Archetype | No credentials or ranking promises |
| Plan Yelp Business Page setup/readiness | **YelpBusinessProfile** | [README](YelpBusinessProfile/README.md) | Planned | Archetype | No review solicitation or lead promises |

## Disambiguation (Near-Neighbor Capabilities)

| If the request is about... | Use | Not |
| --- | --- | --- |
| Reviewing page **examples** in `Content/Website/Pages/` | **ContentReview** | OnePageWebsite |
| Drafting **owner's** one-page business site | **OnePageWebsite** | ContentReview |
| Refreshing Indexes/ by hand (default) | **ManualIndexing** | Indexing |
| Index format, Setup, or health check | **Indexing** | ManualIndexing |
| Refresh **repository mirror** on Windows | **MirrorToWindows** | GoogleDriveLink / DropboxLink |
| Planning **Google Business Profile** | **GoogleBusinessProfile** | GoogleDriveLink |
| Planning **Yelp Business Page** | **YelpBusinessProfile** | ContentReview |

## Expected Outputs

| Capability | Expected output |
| --- | --- |
| GettingStarted | Owner Goals direction; next setup step |
| ContentReview | Review notes; clarity fixes on example page drafts |
| OnePageWebsite | Draft under Content/OnePageBusinessWebsite/ or blocked report |
| ChatToMarkdown | One Markdown file per Rules |
| GitHubWorkflow | Git command guidance; commit/push when owner asks |
| GoogleBusinessProfile | Planned checklist/readiness guidance |
| YelpBusinessProfile | Planned checklist/readiness guidance |

## Situational Awareness (Always On)

Read [SituationalAwareness/Rules.md](SituationalAwareness/Rules.md) with
`AGENTS.md` every pass.

## Related

- [WebsiteGoals.md](../Plans/WebsiteGoals.md)
- [UserSetupGuide.md](../Plans/UserSetupGuide.md)
