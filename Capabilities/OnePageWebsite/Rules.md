<!--
IndexTitle: OnePageWebsite Rules
IndexDescription: Constraints for creating a one-page business website Markdown draft from approved inputs.
IndexType: Capability
CapabilityName: OnePageWebsite
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-03
-->

# OnePageWebsite Rules

Canonical constraints for **user one-page business website** source drafts.
The worker prompt references this file.

## Scope

- **In scope:** Plain Markdown draft at
  `Content/OnePageBusinessWebsite/OnePageWebsiteDraft.md` from approved inputs
  in `Content/OnePageBusinessWebsite/OnePageWebsiteInputs.md`, using section
  guidance from `OnePageWebsiteSections.md`.
- **Out of scope:** Get Established public site pages under
  `Content/Website/Pages/`, HTML builds, platform choice, dependencies,
  automation, invented business facts, and publishing decisions.

## Prerequisites

Run or confirm upstream discovery before drafting:

1. `Capabilities/BusinessPlan/BusinessPlanDiscoveryPrompt.md`, or
2. Approved inputs already present in `OnePageWebsiteInputs.md`.

If any of the nine essential inputs are missing, stop with a blocked report.
Do not guess.

## Essential Inputs

- Business Name Or Site Title
- Tagline
- Short Business Description
- Services
- Service Area
- Why Choose Us
- About
- Contact / Preferred Contact Method
- Call To Action

## Output Shape

Default draft path:

```text
Content/OnePageBusinessWebsite/OnePageWebsiteDraft.md
```

When blocked, use the blocked-report format in
[OnePageWebsiteDraftPrompt.md](OnePageWebsiteDraftPrompt.md).

## Learned Constraints

- Keep drafts framework-neutral and compatible with future WordPress or builder
  export in concept only — no platform selection in this Capability.
- Optional sections (testimonials, FAQ, policies) may use clearly marked
  placeholders when not confirmed.
- Route review after drafting to **ContentReview** or
  **WebPresenceQualityReviewPrompt** — not inline in the draft pass unless
  scoped.
- Batch non-blocking questions in `Plans/OpenQuestions.md`.

## Situational Awareness

When **OnePageWebsite** is active (after core SA):

- Confirm **essential inputs** exist before drafting; stop with blocked report if not.
- Confirm destination is **user one-page** track (`Content/OnePageBusinessWebsite/`), not Get Established public site pages.

## Related

- [Prompt.md](Prompt.md)
- [OnePageWebsiteDraftPrompt.md](OnePageWebsiteDraftPrompt.md)
- [ContentReview Rules](../ContentReview/Rules.md)
