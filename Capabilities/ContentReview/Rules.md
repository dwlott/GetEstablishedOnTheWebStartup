<!--
IndexTitle: ContentReview Rules
IndexDescription: Get Established On The Web review constraints for website page drafts.
IndexType: Capability
CapabilityName: ContentReview
CapabilityVersion: 1
LastEdited: 2026-06-04
-->

# ContentReview Rules

Canonical review constraints for Get Established On The Web public website **source drafts**. The worker prompt references this file.

## Scope

- **In scope:** `Content/Website/Pages/*.md` framework-neutral drafts for the Get Established product site.
- **Out of scope:** Owner folder content, user one-page business website outputs, platform choice, HTML builds, dependencies, deployment.

## Output Shape

Default output is structured findings in chat or a worker handoff. When the user requests a file, use a dated name under `Plans/` (for example `WebsiteContentReview_YYYY-MM-DD.md`).

Include:

- Overall assessment
- Page-by-page priority notes
- Unsupported or hype-like claims to revise
- Non-blocking items for `Plans/OpenQuestions.md`
- Prioritized next-step checklist (review-only unless user approves edits)
- Ready For Website recommendation per page: `No`, `Partial`, `AdvanceToOwnerReview`, `ReadyForExtract`, or `OnHold` (owner judgment; never `ReadyForExtract` without owner review of claims and tone). Shared vocabulary with a commissioned instance's ContentReview.

## Learned constraints

- Treat drafts as **source content**, not a live website.
- Stay **framework-neutral** (plain Markdown; no framework or hosting decisions).
- Do not present AI review comments as endorsements, scores, certifications, or proof the site is objectively excellent.
- Distinguish **GetEstablished** (host repository; see [RepositoryGoals.md](../../Plans/RepositoryGoals.md)) from **Get Established Repository/Workspace** (offered product in public drafts).
- Preserve distinctions in [ProductLanguageAndPositioning.md](../../Plans/ProductLanguageAndPositioning.md): prepared foundation, Workspace, Repository, and separate user website outputs. GEOTW "product and proof" / "prime example" language belongs in website drafts and product positioning—not host-repository identity docs.
- Do not rewrite every page unless the user explicitly asks for implementation.
- Batch human decisions in `Plans/OpenQuestions.md` rather than inventing answers.
- Compare tone and product language across the full draft set when reviewing more than one page.

## Related

- [Prompt.md](Prompt.md)
- [RepositoryGoals.md](../../Plans/RepositoryGoals.md)
- [RepositoryQualityReviewPlan.md](../../Plans/RepositoryQualityReviewPlan.md)
