<!-- Index: Guide the first owner setup path without turning startup into a full business plan. -->
<!--
IndexTitle: GettingStarted Capability
IndexDescription: Guide beginner setup, owner-goal capture, read-first orientation, and next-task routing for the repository-backed web-presence workflow.
IndexType: Capability
CapabilityName: GettingStarted
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-07
-->

# GettingStarted Capability

- **Version:** 1
- **Tier:** Archetype
- **Purpose:** Help a new owner or agent run **Quick Startup**—the first
  getting-started path: prep the Workspace boot files for an adopted copy, orient
  to the learning repository, collect three to five **Owner Goals**, keep those
  goals separate from **Repository Goals**, and route the next setup task through
  existing docs and Capabilities.
- **Inputs:** Current repository state; `Capabilities/GettingStarted/GettingStarted.md`;
  `Plans/UserSetupGuide.md`; `Plans/RepositoryGoals.md`;
  optional owner-provided setup goals.
- **Outputs:** A short getting-started recommendation, focused setup-doc edits,
  or a next worker prompt. Durable Owner Goals belong in
  `Workspace/OwnerGoals.md`; candidate external URLs in
  `Workspace/ValuableReferences.md`.
- **WhenToUse:** When the user asks to get started, prepare first setup,
  clarify startup goals, decide what to do first, or make the Getting Started
  path ready for a new owner.
- **ParentCapability:** GEOTW archetype host.

This Capability is for first-session orientation and routing. It does not
replace **RepositoryInitialize** (bootstrap a repository shell),
**GitHubWorkflow** (GitHub setup and sync), **ContentReview** (website draft
review), or **UserDiscovery** prompt-only work (identity, audience, offer,
proof, and page discovery).

## Data Boundaries

GettingStarted may ask about owner goals and tool context, but it must keep
owner-specific goals separate from reusable repository logic.

- Owner goals can guide the next setup task.
- Repository Goals live in `Plans/RepositoryGoals.md`.
- Capability files may contain examples and routing rules, not private owner
  facts, credentials, business claims, legal claims, pricing, or final public
  copy.
- If durable owner goals need to be saved, use `Workspace/OwnerGoals.md` or
  another approved owner-owned file. Do not create owner folders during
  unrelated GettingStarted operation.

## Placement

GettingStarted operates on existing documentation:

- `Capabilities/GettingStarted/GettingStarted.md`
- `Plans/UserSetupGuide.md`
- `Plans/SampleUserJourney.md`
- `Plans/RepositoryGoals.md`
- `Plans/AgentTaskBacklog.md`
- existing routed Capabilities under `Capabilities/`

It does not provision new repository folders. There is no `Structure.md` or
`SetupPrompt.md` for version 1.

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | promoted workflow — GettingStartedPlan |
| **SourceSummary** | Quick Startup and Owner Goals capture separate from Repository Goals |
| **PromotionStatus** | Active |
| **Dependencies** | RepositoryGoals, Workspace/OwnerGoals.md |
| **RelatedFiles** | GettingStarted.md, WorkspaceAdoptionPrep.md, Rules.md, Prompt.md |
| **LastReviewed** | 2026-07-06 |
| **HarmonizationNotes** | Archetype tier; does not provision folders |

## Related

- Canonical rules: [Rules.md](Rules.md)
- Worker entry: [Prompt.md](Prompt.md)
- Adoption prep: [WorkspaceAdoptionPrep.md](WorkspaceAdoptionPrep.md)
- Beginner entry point: [GettingStarted.md](GettingStarted.md)
- Owner Goal operating loop: [OwnerGoalOperatingLoop.md](OwnerGoalOperatingLoop.md)
- Fuller setup guide: [UserSetupGuide.md](../../Plans/UserSetupGuide.md)
- Repository North Star: [RepositoryGoals.md](../../Plans/RepositoryGoals.md)
- Planning source: [GettingStartedPlan.md](../../Plans/GettingStartedPlan.md)
- Goal placement plan: [StartupGuideGoalsAndNorthStarPlan.md](../../Plans/StartupGuideGoalsAndNorthStarPlan.md)

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-07-06 | 2 | Workspace Adoption Prep — auto-reset stale boot files on Quick Startup | Adopted copies stalled on leftover template Owner Goals | WorkspaceAdoptionPrep, Rules, QuickStartupGreeting, GettingStarted |
| 2026-06-01 | 1 | Initial Capability | First setup needs routable owner-goal capture without merging owner goals into Repository Goals | README, Rules, Prompt |
