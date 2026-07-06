<!--
IndexTitle: Website Content Readiness Review Prompt
IndexDescription: Copy-ready prompt for a review-only, non-scoring website content readiness pass.
IndexType: Capability
CapabilityName: ContentReview
IndexStatus: Active
LastEdited: 2026-06-02
-->

# Website Content Readiness Review Prompt

## Purpose

Use this prompt to review whether website content source drafts are ready for the next planning or publishing-readiness step.

The reviewing agent should identify website content strengths, page-flow concerns, unclear public messaging, terms that need plainer explanation, non-blocking open decisions, practical follow-up tasks, human decisions, and files or pages to review next. The review should stay calm, practical, beginner-friendly, non-scoring, and review-only.

## Copy-Ready Prompt

```text
You are working locally in C:\Repositories\GetEstablished.

Do not push to GitHub.

Use the repository workflow.

Goal:
Run a review-only website content readiness pass.

Review whether website content source drafts are ready for the next planning or publishing-readiness step.

Read:
- AGENTS.md
- README.md
- Plans/RepositoryMap.md
- Plans/WebsiteContentPlan.md if it exists
- Archive/HistoricalReviews/WebsiteContentReadinessReview.md if it exists
- Archive/HistoricalReviews/BeginnerWebsiteContentConsistencyReview.md if it exists
- Archive/HistoricalReviews/PublishingReadinessReview.md if it exists
- Plans/ProductLanguageAndPositioning.md if it exists
- Plans/RepositoryQualityReviewPlan.md if it exists
- Plans/AgentTaskBacklog.md
- Plans/RepositoryExcellenceHighlights.md if it exists
- Ideas/FutureIdeas.md
- Archive/RepositoryHousekeeping.md
- Content/Website/Pages/README.md
- Content/Website/Pages/Index.md
- Content/Website/Pages/Home.md
- Content/Website/Pages/StartHere.md
- Content/Website/Pages/HowItWorks.md
- Content/Website/Pages/AIWorkflow.md
- Content/Website/Pages/AgentPermissions.md if it exists
- Content/Website/Pages/GitHubWorkflow.md
- Content/Website/Pages/Offers.md
- Content/Website/Pages/About.md

Keep this pass review-only and non-scoring.

Do not:
- Edit website page files.
- Move files.
- Rename files.
- Delete files.
- Create automation.
- Create scoring systems.
- Build the website.
- Create HTML.
- Choose a publishing platform.
- Add dependencies.
- Create owner content.
- Create business plan content.
- Create a one-page website draft.
- Expand the Workspace folder tree.
- Review a real user, business, or personal brand unless a separate task explicitly provides that scope.

Review whether the website content drafts:
- Have a clear page flow.
- Explain the purpose of the site.
- Align with Plans/ProductLanguageAndPositioning.md if available.
- Distinguish the public website, offered Workspace or Repository, and future user one-page website outputs.
- Keep the tone calm, practical, credible, and beginner-friendly.
- Avoid unsupported hype.
- Avoid premature platform or publishing decisions.
- Preserve framework-neutral Markdown source content.
- Include useful link intent where appropriate.
- Keep open decisions batched instead of blocking.
- Identify missing proof, origin story, contact path, or call-to-action clarity.
- Identify whether the content is ready for a later publishing-readiness review.
- Identify whether another scoped content edit pass is needed.

Produce a review document with these sections:
- Summary
- Website content strengths
- Page-flow concerns
- Missing or unclear public messaging
- Terms that need plainer explanation
- Open decisions that remain non-blocking
- Recommended follow-up tasks
- Human decisions needed, if any
- Files or pages to review next

Repository update rules:
- Write findings into a review document, not directly into website page files.
- Log navigation, indexing, terminology, folder-growth, stale-file, proposed-move, or proposed-rename concerns in Archive/RepositoryHousekeeping.md.
- Use Plans/OpenQuestions.md only for non-blocking project-level human decisions.
- Use Ideas/FutureIdeas.md for useful ideas that should not become current scope yet.
- Update Plans/AgentTaskBacklog.md with one small next recommended task if the review identifies a clear next step.
- Update Plans/RepositoryExcellenceHighlights.md only if the review finds or creates a meaningful repository-quality improvement, tutorial point, selling point, or reusable workflow lesson.

Guidance:
- Keep the tone calm, practical, credible, and beginner-friendly.
- Treat missing proof, link intent, origin-story detail, contact paths, or call-to-action clarity as normal planning inputs, not failures.
- Prefer small follow-up tasks over broad rewrites.
- Separate current source-draft readiness from future website build, platform, design, deployment, or publishing decisions.
- Do not present AI review comments as endorsements, testimonials, certifications, scores, independent evaluations, or proof that the website content is objectively ready.

Report using the implementation-agent copy-ready fenced handoff format:
Summary:
Files Changed:
Planning Files To Review:
Questions Added Or Changed:
Next Recommended Task:
```

## Agent Notes

- Keep this prompt review-only unless a future task explicitly asks for implementation.
- Use it before publishing-readiness or platform-comparison work when website page drafts need a readiness check.
- Do not use it to edit website page files, build the website, choose a platform, or create owner-specific content.
- Preserve the distinction between the public Get Established site, the offered Workspace or Repository, and a user's future one-page website output.
