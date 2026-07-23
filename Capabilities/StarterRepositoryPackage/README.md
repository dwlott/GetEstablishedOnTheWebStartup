<!-- Index: Repair a host copy into a download-ready Get Established starter repository. -->
<!--
IndexTitle: StarterRepositoryPackage Capability
IndexDescription: Agent-run repair pass to turn an archetype-host copy into an archetype-specific starter repository.
IndexType: Capability
CapabilityName: StarterRepositoryPackage
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-06-19
-->

# StarterRepositoryPackage Capability

- **Version:** 2
- **Tier:** Archetype (runs for an archetype host; output is a **starter repository**)
- **Purpose:** Provide runnable agent instructions to repair a **packaging
  workspace** copy of an archetype host into a **starter repository** for that
  archetype. The current fully specified profile remains `GetEstablishedStartup`;
  future profiles may include `GetEstablishedOnTheWebStartup` after GEOTW is
  promoted to a self-provisioning web-presence archetype host.
- **Inputs:** Packaging workspace path (for example
  `C:\Repositories\GetEstablishedStartup`); archetype host path; starter profile;
  confirmation that the archetype host remains the development source; owner
  choice for Git handling (remove `.git` vs fresh init).
- **Outputs:** Repaired starter tree for the named archetype; lazy-scaffold trim;
  **RepositoryScaffold** included for on-demand folder creation; repair report in
  handoff; optional packaging verification against [PackageChecklist.md](PackageChecklist.md).
- **WhenToUse:** After manually copying the archetype host to a staging folder;
  before building a consumer ZIP; when Git remote, host-only folders, or identity
  text still point at the development host.

## Start Here

1. **[ConsumerRepairSpec.md](ConsumerRepairSpec.md)** — REMOVE/KEEP lists and verification (read first on repair pass).
2. **[WorkflowIndex.md](WorkflowIndex.md)** — runnable step order.
3. **[ConsumerBootSnippets.md](ConsumerBootSnippets.md)** — AGENTS.md and backlog templates.

Copy-ready worker entry: [Prompt.md](Prompt.md).

## Three Roles

| Role | Example | Notes |
| --- | --- | --- |
| **Archetype host** | `C:\Repositories\GetEstablished` | Develop Capabilities, standards, migration |
| **Packaging workspace** | `C:\Repositories\GetEstablishedStartup` | Disposable copy; run this Capability here |
| **Starter repository** | Output of repair pass | Consumer download; **Get Established Workspace** |

This Capability does **not** replace **RepositoryInitialize** (empty shell bootstrap) or
**RepositorySpawn** (retired). It **repairs a full copy**
and applies **lazy scaffold** policy so Capability-owned folders are not
pre-created in the download ZIP. Consumer repos use **RepositoryScaffold** for
core repair and growth-map orientation after download.

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | owner session — GetEstablishedStartup packaging workflow |
| **SourceSummary** | Agent repair pass for consumer starter ZIP after manual host copy |
| **PromotionStatus** | Draft |
| **Dependencies** | TemplateGuidance, RepositoryCoreStandard, GettingStarted, GitHubWorkflow Setup |
| **RelatedFiles** | ConsumerRepairSpec.md, ConsumerBootSnippets.md, WorkflowIndex.md, Rules.md, Prompt.md, PackageChecklist.md |
| **LastReviewed** | 2026-06-07 |
| **HarmonizationNotes** | Instruction-first v3; deterministic lists; instruction-gap handoff; v2 terminology supports archetype-specific starter profiles |

## Starter Profiles

| Profile | Archetype host | Status | Notes |
| --- | --- | --- | --- |
| `GetEstablishedStartup` | `C:\Repositories\GetEstablished` | Active/current spec | Uses [ConsumerRepairSpec.md](ConsumerRepairSpec.md). |
| `GetEstablishedOnTheWebStartup` | `C:\Repositories\GetEstablishedOnTheWeb` | Active | Uses [WebPresenceStartupRepairSpec.md](WebPresenceStartupRepairSpec.md). |

Do not run a profile that is still Planned or missing a repair spec, keep/remove
lists, identity rewrites, and verification checklist.

## Related

- Deterministic repair lists: [ConsumerRepairSpec.md](ConsumerRepairSpec.md)
- Boot templates: [ConsumerBootSnippets.md](ConsumerBootSnippets.md)
- Include/exclude matrix: [PackageChecklist.md](PackageChecklist.md)
- Lazy scaffold policy: [ScaffoldPolicy.md](ScaffoldPolicy.md)
- Git and agent detach: [AgentConfigDetach.md](AgentConfigDetach.md)
- Consumer scaffold router: [RepositoryScaffold](../RepositoryScaffold/README.md)
- Canonical rules: [Rules.md](Rules.md)
- Worker entry: [Prompt.md](Prompt.md)
- Template context: [TemplateGuidance.md](../../Standards/TemplateGuidance.md)
- Consumer first session: [GettingStarted](../GettingStarted/README.md)
- Post-download GitHub: [GitHubWorkflow Setup](../GitHubWorkflow/SetupPrompt.md)
- Self-provisioning model: [SelfProvisioningRepositoryModel.md](../../Plans/SelfProvisioningRepositoryModel.md)
- WebPresence pack: [WebPresenceCapabilityPack.md](../../Plans/WebPresenceCapabilityPack.md)

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-06-05 | 1 | Initial draft Capability | Manual copy needs agent repair pass, not scripts first | README, WorkflowIndex, Rules, Prompt, PackageChecklist |
| 2026-06-06 | 2 | Lazy scaffold policy; RepositoryScaffold in consumer package | Capability paths on demand; tidy Workspace | ScaffoldPolicy, WorkflowIndex, PackageChecklist, RepositoryScaffold |
| 2026-06-06 | 2 | AgentConfigDetach — required .git and IDE config removal on host copy | Same origin trap; Cursor sync confusion | AgentConfigDetach, WorkflowIndex Step 1, Rules, PackageChecklist |
| 2026-06-07 | 3 | ConsumerRepairSpec + ConsumerBootSnippets; step reorder 2c/2d before identity; instruction-gap handoff | Fresh mirror resets to ~28 Capabilities; last repair needed invented lists | ConsumerRepairSpec, ConsumerBootSnippets, WorkflowIndex, PackageChecklist, Prompt, Rules, SA Rules §7 |
| 2026-06-07 | 3.1 | `Workspace/ValuableReferences.md` in starter boot; Quick Startup reference ladder | Cert prep smoke test deferred URL discovery to owner | ConsumerRepairSpec, ScaffoldPolicy, PackageChecklist, GettingStarted |
| 2026-06-07 | 3.2 | VerifyStarterPackage.ps1; remove placeholder traps; consumer StartHere.md | Smoke test agent read AGENTS.md.placeholder; StartHere linked missing Plans | VerifyStarterPackage.ps1, ConsumerRepairSpec, WorkflowIndex, PackageChecklist |
| 2026-06-19 | 2 | Generalized wording for archetype-specific starter profiles | GEOTW should be able to define `GetEstablishedOnTheWebStartup` after self-provisioning promotion without breaking current GetEstablishedStartup repair rules | README, WorkflowIndex, ConsumerRepairSpec |
| 2026-07-23 | 2.1 | Profile Active; DRS Bluehost lessons blended; Save/Overlay stay Plans+Automation / commissioned-only | Honor WebPresenceWordPress packaging; absorb Universal go-live lessons without Cap shells | README, WebPresenceStartupRepairSpec, BluehostDatabasePrep |
