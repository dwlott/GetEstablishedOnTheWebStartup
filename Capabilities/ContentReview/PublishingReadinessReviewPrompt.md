<!--
IndexTitle: Publishing Readiness Review Prompt
IndexDescription: Copy-ready prompt for a review-only, non-scoring publishing readiness pass.
IndexType: Capability
CapabilityName: ContentReview
IndexStatus: Active
LastEdited: 2026-06-02
-->

# Publishing Readiness Review Prompt

## Purpose

Use this prompt to review whether the repository and website source content are ready to compare publishing approaches or move toward a publishing decision.

The reviewing agent should identify ready items, blocking gaps, non-blocking open decisions, premature actions to avoid, practical next steps, human decisions, and files to review next. The review should stay calm, practical, non-scoring, and review-only.

## Copy-Ready Prompt

```text
You are working locally in C:\Repositories\GetEstablished.

Do not push to GitHub.

Use the repository workflow.

Goal:
Run a review-only publishing readiness pass.

Review whether the repository and website source content are ready to compare publishing approaches or move toward a publishing decision.

Read:
- AGENTS.md
- README.md
- Plans/RepositoryMap.md
- Archive/HistoricalReviews/WebsiteContentReadinessCurrentReview.md if it exists
- Archive/HistoricalReviews/PublishingReadinessReview.md if it exists
- Plans/PublishingDecisionCriteria.md if it exists
- Plans/PublishingDecisionChecklist.md if it exists
- Archive/HistoricalReviews/MinimalPublishingApproachesReview.md if it exists
- Plans/ProductLanguageAndPositioning.md if it exists
- Plans/OpenQuestions.md
- Plans/RepositoryQualityReviewPlan.md if it exists
- Plans/AgentTaskBacklog.md
- Plans/RepositoryExcellenceHighlights.md if it exists
- Ideas/FutureIdeas.md
- Archive/RepositoryHousekeeping.md
- Content/Website/Pages/Index.md
- Content/Website/Pages/Home.md
- Content/Website/Pages/StartHere.md
- Content/Website/Pages/HowItWorks.md
- Content/Website/Pages/AIWorkflow.md
- Content/Website/Pages/AgentPermissions.md if it exists
- Content/Website/Pages/GitHubWorkflow.md
- Content/Website/Pages/Offers.md
- Content/Website/Pages/About.md

Add:
- Archive/HistoricalReviews/PublishingReadinessCurrentReview.md

Keep this pass review-only and non-scoring.

Do not:
- Choose a publishing platform.
- Build the website.
- Create HTML.
- Add dependencies.
- Create automation.
- Move files.
- Rename files.
- Delete files.
- Edit website page files.
- Create owner content.
- Create business plan content.
- Create a one-page website draft.
- Expand the Workspace folder tree.
- Make final business, legal, privacy, analytics, hosting, domain, deployment, pricing, contact-form, or professional-service decisions.
- Treat draft assumptions as final public copy.

Review whether:
- Website content has passed content readiness.
- Product language and public message are stable enough for a publishing approach comparison.
- Plans/OpenQuestions.md has no blocking public website decisions.
- Plans/PublishingDecisionCriteria.md and Plans/PublishingDecisionChecklist.md are satisfied enough for comparison.
- Proof, origin story, contact path, call to action, and offer details are ready enough or clearly non-blocking.
- The repository distinguishes the Get Established public website from user one-page business website outputs.
- Framework-neutral source content is preserved.
- A publishing approach comparison is appropriate.
- Human approval is required before platform choice, build, deployment, analytics, domain, hosting, privacy, contact-form, or final public business decisions.

Produce a review document with these sections:
- Summary
- Ready items
- Blocking gaps, if any
- Non-blocking open decisions
- Premature actions to avoid
- Recommended next step
- Human decisions needed
- Files to review next

Repository update rules:
- Write findings into the review document, not directly into website page files.
- Log navigation, indexing, terminology, folder-growth, stale-file, proposed-move, or proposed-rename concerns in Archive/RepositoryHousekeeping.md.
- Use Plans/OpenQuestions.md only for non-blocking project-level human decisions.
- Use Ideas/FutureIdeas.md for useful ideas that should not become current scope yet.
- Update Plans/AgentTaskBacklog.md with one small next recommended task if the review identifies a clear next step.
- Update Plans/RepositoryExcellenceHighlights.md only if the review finds or creates a meaningful repository-quality improvement, tutorial point, selling point, or reusable workflow lesson.

Guidance:
- Keep the tone calm, practical, credible, and beginner-friendly.
- Treat missing proof, origin-story detail, contact path, final call-to-action wording, offer packaging, platform choice, hosting, analytics, privacy, and domain decisions as normal planning inputs, not failures.
- Separate readiness to compare publishing approaches from readiness to build, deploy, launch, or choose a platform.
- Do not present AI review comments as endorsements, testimonials, certifications, scores, independent evaluations, guarantees, or proof that the project is ready to publish.
- Prefer one small follow-up task over broad publishing work.
- Pause for human input before any platform, build, deployment, domain, hosting, privacy, analytics, contact-form, dependency, automation, credential, billing, or final public business decision.

Report using the implementation-agent copy-ready fenced handoff format:
Summary:
Files Changed:
Planning Files To Review:
Questions Added Or Changed:
Next Recommended Task:
```

## Agent Notes

- Keep this prompt review-only unless a future task explicitly asks for implementation.
- Use it after website content readiness review and before publishing approach comparison, platform choice, website build, deployment, or launch decisions.
- Do not use it to choose a platform, build the website, create HTML, add dependencies, create automation, or finalize business/legal/privacy/analytics/hosting/domain/deployment decisions.
- Preserve the distinction between the public Get Established site, the offered Workspace or Repository, and a user's future one-page website output.
