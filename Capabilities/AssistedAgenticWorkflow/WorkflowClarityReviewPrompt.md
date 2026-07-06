<!--
IndexTitle: Workflow Clarity Review Prompt
IndexDescription: Copy-ready prompt for a review-only, non-scoring workflow clarity pass.
IndexType: Capability
CapabilityName: AssistedAgenticWorkflow
IndexStatus: Active
LastEdited: 2026-06-03
-->

# Workflow Clarity Review Prompt

## Purpose

Use this prompt to review whether repository workflows are easy for a human and agents to understand and follow.

The reviewing agent should identify workflow strengths, confusion risks, unclear steps, terms that need plainer explanation, hard-to-find files, practical follow-up tasks, and human decisions. The review should stay calm, practical, beginner-friendly, non-scoring, and review-only.

## Copy-Ready Prompt

```text
You are working locally in C:\Repositories\GetEstablished.

Do not push to GitHub.

Use the repository workflow.

Goal:
Run a review-only workflow clarity pass.

Review whether repository workflows are easy for a human and agents to understand and follow.

Read:
- AGENTS.md
- README.md
- Plans/RepositoryMap.md
- Plans/AgentWorkflowModes.md
- Plans/AgentReviewChecklist.md
- Capabilities/AssistedAgenticWorkflow/AgentSelfDirectedLoop.md
- Capabilities/LocalAgentToolSetup/AgentSandboxAndPermissions.md
- Plans/AgentTaskBacklog.md
- Plans/RepositoryExcellenceHighlights.md
- Ideas/FutureIdeas.md
- Archive/RepositoryHousekeeping.md
- Plans/OpenQuestions.md if it exists
- Workspace/README.md if it exists

Keep this pass review-only and non-scoring.

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
- Expand the Workspace folder tree.
- Review a real user, business, or personal brand unless a separate task explicitly provides that scope.

Review whether workflows clearly explain:
- Planning-agent role.
- Implementation-agent role.
- Human supervision role.
- Repository as source of truth.
- Local-first work.
- Milestone syncs.
- Copy-ready implementation handoffs.
- Why full git status is usually omitted from normal handoffs.
- When to pause for human decisions.
- When to use Plans/OpenQuestions.md.
- When to log issues in Archive/RepositoryHousekeeping.md.
- When to park ideas in Ideas/FutureIdeas.md.
- How to handle sandbox and permission prompts at a basic level.
- What not to build or decide too early.
- How review-only passes differ from implementation passes.
- How owner-owned content stays separate from reusable repository logic.

Produce a review document with these sections:
- Summary
- Workflow strengths
- Confusion risks
- Missing or unclear steps
- Terms that need plainer explanation
- Files that should be easier to find
- Suggested follow-up tasks
- Human decisions needed, if any

Repository update rules:
- Write findings into a review document, not directly into broad rewrites.
- Log navigation, indexing, terminology, folder-growth, stale-file, proposed-move, or proposed-rename concerns in Archive/RepositoryHousekeeping.md.
- Use Plans/OpenQuestions.md only for non-blocking project-level human decisions.
- Use Ideas/FutureIdeas.md for useful ideas that should not become current scope yet.
- Update Plans/AgentTaskBacklog.md with one small next recommended task if the review identifies a clear next step.
- Update Plans/RepositoryExcellenceHighlights.md only if the review finds or creates a meaningful repository-quality improvement, tutorial point, selling point, or reusable workflow lesson.
- Use Workspace/ only for owner-specific questions when real owner content is in scope.

Guidance:
- Keep the tone calm, practical, and beginner-friendly.
- Treat workflow confusion as useful review input, not failure.
- Prefer small follow-up tasks over broad rewrites.
- Separate review findings from implementation.
- Do not present AI review comments as endorsements, testimonials, certifications, scores, independent evaluations, or proof that the workflow is objectively excellent.

Report using the implementation-agent copy-ready fenced handoff format:
Summary:
Files Changed:
Planning Files To Review:
Questions Added Or Changed:
Next Recommended Task:
```

## Agent Notes

- Keep this prompt review-only unless a future task explicitly asks for implementation.
- Use it to inspect workflow docs before changing workflow rules.
- Do not turn this prompt into a checklist, scoring system, or automation.
- Preserve the distinction between local implementation agent, planning agent, human supervisor, repository source of truth, and GitHub sync or commit.
