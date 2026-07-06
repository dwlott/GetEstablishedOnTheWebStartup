<!--
IndexTitle: Capability Registry
IndexDescription: Product repository registry for GetEstablishedOnTheWeb with self-provisioning startup test Capabilities.
IndexType: README
IndexStatus: Active
LastEdited: 2026-06-19
-->

# Capability Registry

## Purpose

This **product repository** holds the GEOTW website/publishing Capability set
plus a bounded self-provisioning set for the `GetEstablishedOnTheWebStartup`
provisioning test.

Full method Capability development lives on the method host:
`C:\Repositories\GetEstablished\Capabilities\`.

Receive updates via [GEOTWCoreReleaseWorkflow.md](../Plans/GEOTWCoreReleaseWorkflow.md).

## How To Use

1. Match user intent via [RouterIndex.md](RouterIndex.md) (read first).
2. Confirm in [AgentCapabilityGuide.md](AgentCapabilityGuide.md).
3. Open the Capability folder; read `README.md`, then `Prompt.md` / `Rules.md`.
4. For method-only tasks not listed here, switch to the **GetEstablished** host repo.

## Registry Columns

| Column | Meaning |
| --- | --- |
| Tier | Universal or Archetype |
| Capability | PascalCase canonical name |
| Status | Active, Draft, Planned, or Stub on this repo |
| Entry | Primary file link |
| Rules | `Rules.md` if present |

## Active Capabilities

| Tier | Capability | User intent | Status | Entry | Rules |
| --- | --- | --- | --- | --- | --- |
| Archetype | GettingStarted | First setup; owner goals; beginner orientation | Active | [Prompt](GettingStarted/Prompt.md) | [Rules](GettingStarted/Rules.md) |
| Archetype | BusinessPlan | Clarify North Star goal; capture business-plan inputs | Active | [Prompt](BusinessPlan/Prompt.md) | [Rules](BusinessPlan/Rules.md) |
| Archetype | ContentReview | Review public website drafts; clarity and claims | Active | [Prompt](ContentReview/Prompt.md) | [Rules](ContentReview/Rules.md) |
| Archetype | OnePageWebsite | Draft owner's one-page business website | Active | [Prompt](OnePageWebsite/Prompt.md) | [Rules](OnePageWebsite/Rules.md) |
| Archetype | WebPresenceNode | Plan, track, and harmonize one external listing/profile node | Active | [Prompt](WebPresenceNode/Prompt.md) | [Rules](WebPresenceNode/Rules.md) |
| Universal | ChatToMarkdown | Save chat to structured markdown | Active | [Prompt](ChatToMarkdown/Prompt.md) | [Rules](ChatToMarkdown/Rules.md) |
| Universal | InstructionCapture | Triage chat/session into Ideas, Plans, OpenQuestions | Active | [Prompt](InstructionCapture/Prompt.md) | [Rules](InstructionCapture/Rules.md) |
| Universal | LocalAgentToolSetup | Install or configure local agent apps | Active | [Prompt](LocalAgentToolSetup/Prompt.md) | [Rules](LocalAgentToolSetup/Rules.md) |
| Universal | GitHubWorkflow | Git status, pull, push, GitHub onboarding | Active | [Prompt](GitHubWorkflow/Prompt.md) | [Rules](GitHubWorkflow/Rules.md) |
| Universal | MirrorToWindows | On-demand mirror refresh (docs-only) | Active | [WorkflowIndex](MirrorToWindows/WorkflowIndex.md) | [Rules](MirrorToWindows/Rules.md) |
| Universal | MirrorToDropbox | Alias → MirrorToWindows | Stub | [WorkflowIndex](MirrorToDropbox/WorkflowIndex.md) | — |
| Universal | MirrorToGoogleDrive | Alias → MirrorToWindows | Stub | [WorkflowIndex](MirrorToGoogleDrive/WorkflowIndex.md) | — |
| Universal | GoogleDriveLink | ChatGPT + Codex Drive review mirror | Active | [WorkflowIndex](GoogleDriveLink/WorkflowIndex.md) | [Rules](GoogleDriveLink/Rules.md) |
| Universal | DropboxLink | ChatGPT + Codex Dropbox review mirror | Active | [WorkflowIndex](DropboxLink/WorkflowIndex.md) | [Rules](DropboxLink/Rules.md) |
| Universal | AssistedAgenticWorkflow | Owner-supervised pass cycle | Active | [Prompt](AssistedAgenticWorkflow/Prompt.md) | [Rules](AssistedAgenticWorkflow/Rules.md) |
| Universal | SituationalAwareness | Always-on orientation before every pass | Active | [README](SituationalAwareness/README.md) | [Rules](SituationalAwareness/Rules.md) |
| Universal | RepositoryScaffold | Core scaffold repair; intended growth tree | Active | [Prompt](RepositoryScaffold/Prompt.md) | [Rules](RepositoryScaffold/Rules.md) |
| Universal | Indexing | Shared index format, Setup, health-check core | Active | [WorkflowIndex](Indexing/WorkflowIndex.md) | [Rules](Indexing/Rules.md) |
| Universal | ManualIndexing | Default: refresh Indexes/ by hand | Active | [WorkflowIndex](ManualIndexing/WorkflowIndex.md) | [Rules](ManualIndexing/Rules.md) |
| Universal | CapabilityCreate | Create or promote web-presence Capabilities | Active | [Prompt](CapabilityCreate/Prompt.md) | [Rules](CapabilityCreate/Rules.md) |
| Universal | CapabilityHarmonize | Compare Capabilities, trees, packs, or self-provisioning readiness | Active | [Prompt](CapabilityHarmonize/Prompt.md) | [Rules](CapabilityHarmonize/Rules.md) |
| Universal | CapabilityAudit | Audit catalog, routing, and startup readiness | Active | [AuditChecklist](CapabilityAudit/AuditChecklist.md) | [Rules](CapabilityAudit/Rules.md) |
| Archetype | RepositoryInitialize | Initialize related web-presence repository shells | Active | [Prompt](RepositoryInitialize/Prompt.md) | [Rules](RepositoryInitialize/Rules.md) |
| Archetype | StarterRepositoryPackage | Package `GetEstablishedOnTheWebStartup` from GEOTW workspace copy | Active | [WorkflowIndex](StarterRepositoryPackage/WorkflowIndex.md) | [Rules](StarterRepositoryPackage/Rules.md) |

## Planned WebPresence Capabilities

| Tier | Capability | User intent | Status | Entry | Rules |
| --- | --- | --- | --- | --- | --- |
| Archetype | GoogleBusinessProfile | Plan Google Business Profile setup/readiness guidance | Planned | [README](GoogleBusinessProfile/README.md) | [Rules](GoogleBusinessProfile/Rules.md) |
| Archetype | YelpBusinessProfile | Plan Yelp Business Page setup/readiness guidance | Planned | [README](YelpBusinessProfile/README.md) | [Rules](YelpBusinessProfile/Rules.md) |

### Indexing Modes Note

**ManualIndexing** is the default on this product repo. **CodeAssistedIndexing**
is not shipped here — stay on manual indexing silently.

## Host-Only Capabilities (not on disk here)

Develop and route on `C:\Repositories\GetEstablished`:

CapabilityDefinition, RepositoryLearning, RepositorySpawn, ImportCapabilitiesFromRepository,
ImportOwnerPreferencesFromRepository, ChatMemoryCapture, CodeAssistedIndexing,
OneDriveLink.

## Parity

Capability folders with `README.md` must match registry rows and RouterIndex
rows. Re-run after each [GEOTWCoreReleaseWorkflow.md](../Plans/GEOTWCoreReleaseWorkflow.md)
or self-provisioning receive pass.

## Related

- [AgentCapabilityGuide.md](AgentCapabilityGuide.md)
- [RouterIndex.md](RouterIndex.md)
- Host registry: `C:\Repositories\GetEstablished\Capabilities\README.md`
- [CapabilityMetadataStandard.md](../Standards/CapabilityMetadataStandard.md)
- [../Plans/GEOTWSelfProvisioningPromotionPlan.md](../Plans/GEOTWSelfProvisioningPromotionPlan.md)
