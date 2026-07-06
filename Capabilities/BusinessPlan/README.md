<!-- Index: Capture a clear North Star and practical business-plan inputs that downstream web-presence work can build on. -->
<!--
IndexTitle: BusinessPlan Capability
IndexDescription: Capture North Star goals and practical business-plan inputs so the repository makes getting there easy; feeds OnePageWebsite and publishing work.
IndexType: Capability
CapabilityName: BusinessPlan
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-22
-->

# BusinessPlan Capability

- **Version:** 1
- **Tier:** Archetype
- **Status:** Active
- **Purpose:** Help an owner clarify their **North Star goal** and collect
  practical, plain-language business-plan inputs in the repository, so later
  web-presence work (one-page website, publishing, local profiles) has a
  credible source of truth. Discovery only — it does not produce a finished
  business plan or public copy.
- **Inputs:** Owner-provided business facts (name, offer, audience, service
  area, contact intent); optional prior notes; the North Star outcome the owner
  wants.
- **Outputs:** Plain Markdown business discovery notes and a captured North Star
  goal, with unknowns separated into open questions. No invented facts, no
  finished plan, no website draft, no HTML, no publishing decision.
- **WhenToUse:** The owner has rough business ideas and wants to clarify goals
  and capture inputs before drafting a one-page website or doing publishing
  work. For drafting the actual site, route to **OnePageWebsite**; for first
  orientation and owner-goal capture, route to **GettingStarted**.
- **ParentCapability:** GEOTW archetype host.

## Start Here

Use [Prompt.md](Prompt.md) for the operate workflow. The reusable discovery
prompt lives in [BusinessPlanDiscoveryPrompt.md](BusinessPlanDiscoveryPrompt.md).

## Data Boundaries

See [Rules.md](Rules.md). This Capability must not invent business facts,
credentials, proof, pricing, or legal language; must not produce a finished
business plan or website draft; and must not provide legal, financial, tax,
investment, accounting, or insurance advice.

## Relationship To Owner Goals

The durable **North Star** and Owner Goals register live in
[Workspace/OwnerGoals.md](../../Workspace/OwnerGoals.md). BusinessPlan captures
the practical inputs and goal clarity; it does not replace that register —
durable goals are written there.

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | promoted workflow — GettingStarted BusinessPlanDiscoveryPrompt |
| **SourceSummary** | North Star goal capture plus practical business-plan discovery inputs for repository-backed web presence |
| **PromotionStatus** | Active |
| **Dependencies** | GettingStarted (Owner Goals), OnePageWebsite (downstream draft), Content/OnePageBusinessWebsite |
| **RelatedFiles** | Rules.md, Prompt.md, BusinessPlanDiscoveryPrompt.md |
| **LastReviewed** | 2026-06-22 |
| **HarmonizationNotes** | WebPresence pack member; discovery only, hands off to OnePageWebsite. Carried into GetEstablishedOnTheWebStartup packaging. |

## Related

- Canonical rules: [Rules.md](Rules.md)
- Worker entry: [Prompt.md](Prompt.md)
- Reusable discovery prompt: [BusinessPlanDiscoveryPrompt.md](BusinessPlanDiscoveryPrompt.md)
- Downstream draft: [OnePageWebsite](../OnePageWebsite/README.md)
- First-setup routing: [GettingStarted](../GettingStarted/README.md)
- Owner Goals / North Star register: [Workspace/OwnerGoals.md](../../Workspace/OwnerGoals.md)
- WebPresence pack: [WebPresenceCapabilityPack.md](../../Plans/WebPresenceCapabilityPack.md)

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-06-22 | 1 | Promote business-plan discovery into its own Capability | Business planning is a distinct, repeatable owner workflow that feeds web-presence drafting; it deserves its own routable module rather than living inside GettingStarted | README, Rules, Prompt, BusinessPlanDiscoveryPrompt |
