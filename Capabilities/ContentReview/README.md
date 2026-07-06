<!-- Index: Review framework-neutral website page drafts for clarity and credibility. -->
<!--
IndexTitle: ContentReview Capability
IndexDescription: Review Get Established website page drafts for clarity, credibility, and framework neutrality.
IndexType: Capability
CapabilityName: ContentReview
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-07
-->

# ContentReview Capability

- **Version:** 1
- **Purpose:** Review existing framework-neutral website page drafts under `Content/Website/Pages/` (the **public Get Established** site) for clarity, credibility, tone, and practical next steps without building the site or choosing a platform.
- **Inputs:** One or more page paths under `Content/Website/Pages/`; optional subset named by the user.
- **Outputs:** Structured review in chat, or a dated review file under `Plans/` when the user requests a file.
- **WhenToUse:** To **review** existing public-site page drafts before large rewrites or publishing-readiness checks. For **creating** the owner's own one-page business site, use **OnePageWebsite** instead.
- **ParentCapability:** Migrated from `Docs/Prompts/ContentReviewPrompt.md` (2026-05-28). A commissioned instance maintains a child variant with business-specific rules.

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | imported repository — Docs/Prompts migration |
| **SourceSummary** | Framework-neutral website draft review under Content/Website/Pages |
| **PromotionStatus** | Active |
| **Dependencies** | Content/Website/Pages |
| **RelatedFiles** | Rules.md, Prompt.md |
| **LastReviewed** | 2026-06-05 |
| **HarmonizationNotes** | commissioned-instance child variant with claim rules |

## Related

- [Rules.md](Rules.md)
- [Prompt.md](Prompt.md)
- Legacy redirect: [ContentReviewPrompt.md](../../Prompts/ContentReviewPrompt.md)
- Child envelope: a commissioned instance's ContentReview Capability (diverges for customer claim rules)

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-05-28 | 1 | Initial Capability migration from Docs/Prompts | Centralize rules in Rules.md; keep fenced prompt copy-clean | README, Rules, Prompt |
| 2026-05-29 | 1 | Cross-pollination (CapabilityHarmonize Option A): adopted shared Ready For Website recommendation vocabulary from a commissioned instance | Best-of-both; consistent readiness vocabulary across repos | Rules, Prompt |
