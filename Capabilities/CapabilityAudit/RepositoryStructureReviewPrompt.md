<!--
IndexTitle: Repository Structure Review Prompt
IndexDescription: Copy-ready prompt for a review-only repository structure and navigation quality pass.
IndexType: Capability
CapabilityName: CapabilityAudit
IndexStatus: Active
LastEdited: 2026-06-02
-->

# Repository Structure Review Prompt

## Purpose

Use this prompt to run a review-only repository structure pass.

The reviewing agent should inspect organization, folder clarity, README coverage, metadata readiness, indexing readiness, owner-content boundaries, prompt/workflow clarity, and housekeeping needs without editing files or restructuring the repository.

## Copy-Ready Prompt

```text
You are working locally in C:\Repositories\GetEstablished.

Do not push to GitHub.

Use the repository workflow.

Read:
- AGENTS.md
- README.md
- Plans/RepositoryMap.md
- Archive/MigrationReports/RepositoryOrganizationPlan.md if historical organization context is needed
- Plans/RepositoryQualityReviewPlan.md if it exists
- Archive/RepositoryHousekeeping.md
- Plans/AgentTaskBacklog.md
- Plans/RepositoryExcellenceHighlights.md if it exists
- Workspace/README.md if it exists

Goal:
Run a review-only repository structure quality pass. Use
Capabilities/CapabilityAudit/AuditChecklist.md sections A, E, G for structure,
navigation, and stale plan signals. See StalePlanDetection.md for Plans health.

Review:
- Repository organization.
- Folder clarity.
- Folder README coverage.
- Markdown metadata readiness.
- Future indexing readiness.
- Owner-content boundaries.
- Prompt and workflow clarity.
- Navigation clarity for beginners and future agents.
- Housekeeping needs.

Do not:
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
- Rewrite website page drafts.

Output:
Create a new review document in Plans/ with a clear name ending in Review.md.

The review document should include:
- Summary
- Strengths
- Issues or risks
- Proposed follow-up tasks
- Files or folders needing attention
- Housekeeping notes
- Human decisions needed, if any

Repository update rules:
- Write findings into the review document. Do not directly restructure the repository.
- Log confusion, stale files, proposed moves, proposed renames, indexing gaps, or folder growth concerns in Archive/RepositoryHousekeeping.md.
- Update Plans/AgentTaskBacklog.md with one small next recommended task if the review identifies a clear next step.
- Update Plans/RepositoryExcellenceHighlights.md only if the review finds or creates a meaningful repository-quality improvement, tutorial point, selling point, or reusable workflow lesson.
- Add questions to Plans/OpenQuestions.md only when a project-level human decision is needed.

Keep the review calm, practical, and non-hype-driven.

Do not present AI review comments as endorsements, testimonials, certifications, scores, independent evaluations, or proof that the repository is objectively excellent.

Report using the implementation-agent copy-ready fenced handoff format:
Summary:
Files Changed:
Planning Files To Review:
Questions Added Or Changed:
Next Recommended Task:
```

## Agent Notes

- Keep this prompt review-only unless a future task explicitly asks for an implementation pass.
- Prefer one clear review document over scattered chat findings.
- Use housekeeping notes for possible structural changes before moving or renaming files.
- Do not turn this prompt into a scoring system without a future approved task.
