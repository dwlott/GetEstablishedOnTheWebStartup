<!-- Index: Turn approved business inputs into a framework-neutral one-page website draft. -->
<!--
IndexTitle: OnePageWebsite Capability
IndexDescription: Create a plain Markdown one-page business website draft from approved inputs without inventing facts or choosing a platform.
IndexType: Capability
CapabilityName: OnePageWebsite
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-07
-->

# OnePageWebsite Capability

- **Version:** 1
- **Tier:** Archetype
- **Purpose:** Turn approved business-plan or one-page website inputs into a
  plain Markdown one-page business website draft under
  `Content/OnePageBusinessWebsite/`.
- **Inputs:** Approved or clearly provided business inputs; optional prior
  discovery from `Capabilities/BusinessPlan/BusinessPlanDiscoveryPrompt.md`.
- **Outputs:** `Content/OnePageBusinessWebsite/OnePageWebsiteDraft.md` or a
  blocked report when essential inputs are missing.
- **WhenToUse:** After business inputs are collected and the user explicitly
  wants **the owner's own** one-page business website source draft (under
  `Content/OnePageBusinessWebsite/`) — not before essentials exist. To **review**
  existing public Get Established site pages instead, use **ContentReview**.
- **ParentCapability:** GEOTW archetype host.

This Capability creates **user one-page business website** source content. It
does not replace **ContentReview** (Get Established public site drafts under
`Content/Website/Pages/`), **GettingStarted** (first setup routing), or
publishing/platform decisions.

## Data Boundaries

- Do not invent business facts, credentials, proof, pricing, contact details,
  or legal language.
- Do not build HTML, choose a platform, add automation, or add dependencies.
- Batch non-blocking questions in `Plans/OpenQuestions.md`.

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | imported repository |
| **SourceSummary** | Framework-neutral one-page business website draft from inputs |
| **PromotionStatus** | Active |
| **Dependencies** | Content/OnePageBusinessWebsite |
| **RelatedFiles** | Prompt.md |
| **LastReviewed** | 2026-06-05 |
| **HarmonizationNotes** | Distinct from public GetEstablished website Content |

## Related

- Canonical rules: [Rules.md](Rules.md)
- Worker entry: [Prompt.md](Prompt.md)
- Draft prompt: [OnePageWebsiteDraftPrompt.md](OnePageWebsiteDraftPrompt.md)
- Upstream discovery: [BusinessPlan](../BusinessPlan/README.md), [BusinessPlanDiscoveryPrompt.md](../BusinessPlan/BusinessPlanDiscoveryPrompt.md)
- Downstream review: [ContentReview](../ContentReview/README.md),
  [WebPresenceQualityReviewPrompt.md](../ContentReview/WebPresenceQualityReviewPrompt.md)
- Content templates: [Content/OnePageBusinessWebsite/README.md](../../Content/OnePageBusinessWebsite/README.md)
- Planning: [OnePageBusinessWebsitePlan.md](../../Plans/OnePageBusinessWebsitePlan.md)

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-06-03 | 1 | Initial Capability from Plans promotion | Separate user one-page drafting from ContentReview public-site scope | README, Rules, Prompt, OnePageWebsiteDraftPrompt |
