<!--
IndexTitle: Agent Capability Guide
IndexDescription: Startup repository intent routing for GetEstablishedOnTheWebStartup.
IndexType: Capability
IndexStatus: Active
LastEdited: 2026-06-19
-->

# Agent Capability Guide

Use after [AGENTS.md](../AGENTS.md) for workflow tasks on the
**GetEstablishedOnTheWebStartup** web-presence starter. Compact router:
[RouterIndex.md](RouterIndex.md). Full registry: [README.md](README.md).

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
| Clarify North Star goal; collect business-plan inputs (discovery) | **BusinessPlan** | [Prompt](BusinessPlan/Prompt.md) | Active | Archetype | OwnerGoals.md; no invented facts |
| Install or configure local agent app | **LocalAgentToolSetup** | [Prompt](LocalAgentToolSetup/Prompt.md) | Active | Universal | VendorToolIndex |
| Save chat to markdown | **ChatToMarkdown** | [Prompt](ChatToMarkdown/Prompt.md) | Active | Universal | Rules.md destination |
| Capture or triage chat/session to Ideas or Plans | **InstructionCapture** | [Prompt](InstructionCapture/Prompt.md) | Active | Universal | IdeaCaptureTemplate |
| Review **public** website drafts under `Content/Website/Pages/` | **ContentReview** | [Prompt](ContentReview/Prompt.md) | Active | Archetype | Page drafts on disk |
| Draft owner's one-page business website | **OnePageWebsite** | [Prompt](OnePageWebsite/Prompt.md) | Active | Archetype | Approved business inputs |
| Plan or track an external web listing/profile node (Google, Bing, Yelp, Facebook, Nextdoor, Foursquare, BBB, Apple Maps, Yellow Pages) | **WebPresenceNode** | [Prompt](WebPresenceNode/Prompt.md) | Active | Archetype | Owner-approved facts; no credentials |
| Google Drive; ChatGPT + Codex review | **GoogleDriveLink** | [WorkflowIndex](GoogleDriveLink/WorkflowIndex.md) | Active | Universal | AgentSituationalAwareness |
| Dropbox; ChatGPT + Codex review | **DropboxLink** | [WorkflowIndex](DropboxLink/WorkflowIndex.md) | Active | Universal | AgentSituationalAwareness |
| Refresh repository mirror on Windows; backup or review copy | **MirrorToWindows** | [WorkflowIndex](MirrorToWindows/WorkflowIndex.md) | Active | Universal | OwnerPreferences; RepositoryMirrorStandard |
| Refresh Google Drive mirror *(alias)* | **MirrorToGoogleDrive** → MirrorToWindows | [WorkflowIndex](MirrorToGoogleDrive/WorkflowIndex.md) | Stub | Universal | OwnerPreferences |
| Refresh Dropbox mirror *(alias)* | **MirrorToDropbox** → MirrorToWindows | [WorkflowIndex](MirrorToDropbox/WorkflowIndex.md) | Stub | Universal | OwnerPreferences |
| Owner-supervised pass cycle | **AssistedAgenticWorkflow** | [Prompt](AssistedAgenticWorkflow/Prompt.md) | Active | Universal | SituationalAwareness |
| Git status; pull; push; GitHub onboarding | **GitHubWorkflow** | [Prompt](GitHubWorkflow/Prompt.md) | Active | Universal | SourceOfTruthAndMirrorStandard |
| Repository folders; scaffold; growth tree | **RepositoryScaffold** | [Prompt](RepositoryScaffold/Prompt.md) | Active | Universal | IntendedRepositoryTree |
| Index new files; refresh Indexes/ by hand (default) | **ManualIndexing** | [WorkflowIndex](ManualIndexing/WorkflowIndex.md) | Active | Universal | Writes under Indexes/ only |
| Index format, Setup, health check | **Indexing** | [WorkflowIndex](Indexing/WorkflowIndex.md) | Active | Universal | Owner approval for Setup |
| Always-on orientation | **SituationalAwareness** | [Rules](SituationalAwareness/Rules.md) | Active | Universal | Boot with AGENTS.md |
| Create or promote a WebPresence Capability | **CapabilityCreate** | [Prompt](CapabilityCreate/Prompt.md) | Active | Universal | CapabilityMetadataStandard |
| Harmonize Capabilities, tree, pack, or self-provisioning readiness | **CapabilityHarmonize** | [Prompt](CapabilityHarmonize/Prompt.md) | Active | Universal | GEOTWSelfProvisioningPromotionPlan |
| Audit catalog, routing, or startup readiness | **CapabilityAudit** | [AuditChecklist](CapabilityAudit/AuditChecklist.md) | Active | Universal | Review-only by default |
| Initialize related web-presence repository shell | **RepositoryInitialize** | [Prompt](RepositoryInitialize/Prompt.md) | Active | Archetype | RepositoryCoreStandard |
| Package `GetEstablishedOnTheWebStartup` from GEOTW copy | **StarterRepositoryPackage** | [WorkflowIndex](StarterRepositoryPackage/WorkflowIndex.md) | Active | Archetype | WebPresenceStartupRepairSpec |
| Plan Google Business Profile setup/readiness | **GoogleBusinessProfile** | [README](GoogleBusinessProfile/README.md) | Planned | Archetype | No credentials or ranking promises |
| Plan Yelp Business Page setup/readiness | **YelpBusinessProfile** | [README](YelpBusinessProfile/README.md) | Planned | Archetype | No review solicitation or lead promises |
| Bootstrap local WordPress site; configure site-manifest | **WordPressWebsite** | [NewCommissionSiteChecklist](WordPressWebsite/NewCommissionSiteChecklist.md) | Active | Archetype | site-manifest.json |
| Sync Markdown/manifests to WordPress (`ges-build`) | **WordPressContentUpdate** | [Prompt](WordPressContentUpdate/Prompt.md) | Active | Archetype | Owner-approved --write |
| Genesis child theme / Altitude overlay work | **StudioPressGenesisChildTheme** | [Prompt](StudioPressGenesisChildTheme/Prompt.md) | Active | Archetype | Theme boundaries |
| Backup before WordPress experiments | **WordPressMigrationBackup** | [Prompt](WordPressMigrationBackup/Prompt.md) | Active | Universal | DB snapshot first |
| Mirror WordPress uploads/theme to Dropbox | **MirrorWebAssets** | [WorkflowIndex](MirrorWebAssets/WorkflowIndex.md) | Active | Universal | WebAssetsSites.json |

### Not on this starter

| User intent | Route on host |
| --- | --- |
| Method catalog work not present here | `C:\Repositories\GetEstablished\Capabilities\` |
| Import from prior repo | Same |
| Automate indexing (CodeAssistedIndexing) | Not on product repo — host only if present |

## Disambiguation (Near-Neighbor Capabilities)

| If the request is about... | Use | Not |
| --- | --- | --- |
| Clarifying goals / collecting **business-plan inputs** (discovery) | **BusinessPlan** | OnePageWebsite |
| Drafting the **website** from collected inputs | **OnePageWebsite** | BusinessPlan |
| First-session orientation and **Owner Goals** capture | **GettingStarted** | BusinessPlan |
| Reviewing **public** site drafts in `Content/Website/Pages/` | **ContentReview** | OnePageWebsite |
| Drafting **owner's** one-page business site | **OnePageWebsite** | ContentReview |
| Refreshing Indexes/ by hand (default) | **ManualIndexing** | Indexing |
| Index format, Setup, or health check | **Indexing** | ManualIndexing |
| Refresh **repository mirror** on Windows | **MirrorToWindows** | GoogleDriveLink / DropboxLink (connector only) |
| Refresh **Dropbox** mirror *(alias)* | **MirrorToWindows** | DropboxLink |
| Refresh **Google Drive** mirror *(alias)* | **MirrorToWindows** | GoogleDriveLink |
| Dropbox **IncomingIdeas** intake | **DropboxLink** IntakeWorkflow | MirrorToWindows |
| Drive **capture** / connector setup | **GoogleDriveLink** | MirrorToWindows unless refresh requested |
| Packaging **GetEstablishedOnTheWebStartup** | **StarterRepositoryPackage** | GetEstablishedStartup host package |
| Planning a vendor listing/profile node | **WebPresenceNode** | individual one-off page edits |
| Planning **Google Business Profile** | **WebPresenceNode** first; `GoogleBusinessProfile` only for planned child boundaries | GoogleDriveLink |
| Mirror repository / Git repo to Dropbox | **MirrorToWindows** | MirrorWebAssets (uploads/theme only) |
| WordPress save after local edits | `Plans/WordPressSaveWorkflow.md` | ges-build --write without backup |
| Local WordPress build | **WordPressContentUpdate** | Production launch without approval |

## Expected Outputs

| Capability | Expected output |
| --- | --- |
| GettingStarted | Owner Goals direction; next setup step |
| BusinessPlan | North Star goal captured; business-plan discovery notes or blocked report |
| ContentReview | Review notes; clarity fixes on public page drafts |
| OnePageWebsite | Draft under Content/OnePageBusinessWebsite/ or blocked report |
| WebPresenceNode | One-node status/checklist or next-step plan using official links |
| ChatToMarkdown | One Markdown file per Rules |
| InstructionCapture | Idea/Plan captures; triage handoff |
| LocalAgentToolSetup | Vendor setup guidance |
| GitHubWorkflow | Git command guidance; commit/push when owner asks |
| GoogleDriveLink / DropboxLink | Cloud review workflow; mirror apply → MirrorToWindows |
| MirrorToWindows | On-demand mirror refresh; OwnerPreferences; refresh report |
| MirrorToGoogleDrive / MirrorToDropbox | Stub aliases → MirrorToWindows |
| AssistedAgenticWorkflow | Supervised pass cycle |
| RepositoryScaffold | Intended tree; scaffold repair |
| ManualIndexing | Refreshed Indexes/ (by hand) |
| Indexing | Format/Setup/health-check guidance |
| SituationalAwareness | Orientation before writes |
| CapabilityCreate | New or promoted WebPresence Capability files |
| CapabilityHarmonize | Comparison or readiness report |
| CapabilityAudit | Audit findings and one next task |
| RepositoryInitialize | Initialized web-presence repo shell |
| StarterRepositoryPackage | Repaired startup workspace and provisioning test report |
| GoogleBusinessProfile | Planned checklist/readiness guidance |
| YelpBusinessProfile | Planned checklist/readiness guidance |

## Situational Awareness (Always On)

Read [SituationalAwareness/Rules.md](SituationalAwareness/Rules.md) with
`AGENTS.md` every pass.

## Related

- [WebsiteGoals.md](../Plans/WebsiteGoals.md)
- [CapabilityMetadataStandard.md](../Standards/CapabilityMetadataStandard.md)
- [GEOTWCoreReleaseWorkflow.md](../Plans/GEOTWCoreReleaseWorkflow.md)
- [GEOTWSelfProvisioningPromotionPlan.md](../Plans/GEOTWSelfProvisioningPromotionPlan.md)
