<!--
IndexTitle: Beginner Usability Review Prompt
IndexDescription: Copy-ready prompt for a review-only, non-scoring beginner usability pass.
IndexType: Capability
CapabilityName: GettingStarted
IndexStatus: Active
LastEdited: 2026-06-02
-->

# Beginner Usability Review Prompt

## Purpose

Use this prompt to review whether a new user can understand and use this repository without getting overwhelmed.

The reviewing agent should identify beginner strengths, confusion risks, unclear starting points, hard-to-find files, terms that need plainer explanation, practical follow-up tasks, and human decisions. The review should stay calm, practical, non-scoring, and review-only.

## Copy-Ready Prompt

```text
You are working locally in C:\Repositories\GetEstablished.

Do not push to GitHub.

Use the repository workflow.

Goal:
Run a review-only beginner usability pass.

Review whether a new user can understand and use the repository without getting overwhelmed.

Read:
- AGENTS.md
- README.md
- Plans/RepositoryMap.md
- Plans/RepositoryQualityReviewPlan.md if it exists
- Plans/AgentTaskBacklog.md
- Plans/RepositoryExcellenceHighlights.md if it exists
- Archive/RepositoryHousekeeping.md
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

Review whether a beginner can understand:
- What the repository is for.
- Where to start.
- What the Get Established Workspace folder is for.
- How the public website differs from the offered repository or workspace.
- How the offered repository or workspace differs from a user's future one-page website output.
- What Workspace/ is for.
- Which files to read first.
- What not to build yet.
- What decisions are still open.
- When to ask for help.
- How the planning-agent and implementation-agent workflow works.
- How copy-ready handoffs help the user move between tools or sessions.
- How permission prompts and sandbox prompts should be approached at a basic level.

Produce a review document with these sections:
- Summary
- Beginner strengths
- Beginner confusion risks
- Missing or unclear start points
- Files that should be easier to find
- Terms that need plainer explanation
- Suggested follow-up tasks
- Human decisions needed, if any

Repository update rules:
- Write findings into a review document, not directly into broad rewrites.
- Log navigation, indexing, terminology, folder-growth, stale-file, proposed-move, or proposed-rename concerns in Archive/RepositoryHousekeeping.md.
- Update Plans/AgentTaskBacklog.md with one small next recommended task if the review identifies a clear next step.
- Update Plans/RepositoryExcellenceHighlights.md only if the review finds or creates a meaningful repository-quality improvement, tutorial point, selling point, or reusable workflow lesson.
- Add project-level human decisions to Plans/OpenQuestions.md only when needed.

Guidance:
- Keep the tone calm, practical, and beginner-friendly.
- Treat confusion as useful review input, not as failure.
- Prefer small follow-up tasks over broad rewrites.
- Separate repository instructions, prompts, standards, references, indexes, and automation from owner-owned content.
- Do not present AI review comments as endorsements, testimonials, certifications, scores, independent evaluations, or proof that the repository is objectively excellent.

Report using the implementation-agent copy-ready fenced handoff format:
Summary:
Files Changed:
Planning Files To Review:
Questions Added Or Changed:
Next Recommended Task:
```

## Agent Notes

- Keep this prompt review-only unless a future task explicitly asks for an implementation pass.
- Use it to check beginner orientation before adding larger public workflows, checklists, scoring, automation, or website-building tasks.
- Do not use it to create owner content or expand the Workspace folder tree.
- Preserve the distinction between the public website, the offered workspace or repository, and a user's future one-page website output.
