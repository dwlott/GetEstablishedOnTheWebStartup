<!-- Index: Always-on situational orientation before every agent pass. -->
<!--
IndexTitle: SituationalAwareness Capability
IndexDescription: Core always-on situational orientation read alongside AGENTS.md at the start of every pass, plus per-Capability SA components in other Capabilities.
IndexType: Capability
CapabilityName: SituationalAwareness
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-08
-->

# SituationalAwareness Capability

- **Version:** 1
- **Tier:** Universal
- **Purpose:** Orient agents at the start of every pass: task type, active
  repository, connector/environment, and destination folder — before any
  write, move, or workflow advice.
- **Inputs:** Owner task message; `AGENTS.md`; optional connector context.
- **Outputs:** Mental/routing orientation (no files by default); clearer scope
  and destination choice for the active Capability pass.
- **WhenToUse:** At the **start of every agent pass**, before any other
  Capability `Prompt.md` or file mutation. Especially when the owner pastes a
  prior handoff summary (agentic workflow ball clarity).
- **ParentCapability:** N/A — core orientation layer.

SA is modeled in two parts:

1. **Core SA group** (this folder) — shared orientation for all passes.
2. **Per-Capability SA component** — a short section in each Capability's
   `Rules.md` (or `README.md` when no Rules exist) with checks specific to
   that Capability.

Read [Rules.md](Rules.md) for canonical checks. Use [Prompt.md](Prompt.md)
as a copy-ready orientation block when booting a worker pass.

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | promoted workflow — SituationalAwarenessCapabilityPlan (archived) |
| **SourceSummary** | Core always-on orientation before every agent pass; per-Capability SA in Rules |
| **PromotionStatus** | Active |
| **Dependencies** | AGENTS.md, AgentSituationalAwareness standard |
| **RelatedFiles** | Rules.md, Prompt.md, EnvironmentDetectionQuestions.md, CloudOnlyDeviceWorkflow.md |
| **LastReviewed** | 2026-06-05 |
| **HarmonizationNotes** | Distinct from AssistedAgenticWorkflow supervised pass cycle |

## Related

- Planning source (archived): [SituationalAwarenessCapabilityPlan.md](../../Archive/SupersededPlans/SituationalAwarenessCapabilityPlan.md)
- Repository instructions: [AGENTS.md](../../AGENTS.md)
- Supervised pass execution: [AssistedAgenticWorkflow](../AssistedAgenticWorkflow/README.md)
- Intent routing: [AgentCapabilityGuide.md](../AgentCapabilityGuide.md)

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-06-09 | 1 | Terminology pass: operating profiles, device-appropriate paths | Formal terms in NamingStandard §Environment-Adaptive Model | EnvironmentDetectionQuestions, CloudOnlyDeviceWorkflow, Rules |
| 2026-06-08 | 1 | Environment detection + remote-only device routing | User device layer extends SA without new Capability folder | EnvironmentDetectionQuestions, CloudOnlyDeviceWorkflow, Rules |
| 2026-06-07 | 1 | Section 2: duplicate/repeated handoff summary detection for agentic workflow | Owners re-paste summaries; agents should expect ball confusion | Rules, Prompt, AgentSituationalAwareness |
| 2026-06-03 | 1 | Initial Capability (CAP-3) | Centralize orientation; per-Capability components in Rules | README, Rules, Prompt |
