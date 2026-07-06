<!--
IndexTitle: Planner Worker Workflow
IndexDescription: Access-aware planner and worker workflow for repository-backed AI collaboration.
IndexType: Capability
CapabilityName: AssistedAgenticWorkflow
IndexStatus: Active
LastEdited: 2026-06-04
-->

# Planner Worker Workflow

## Purpose

This note explains the access-aware planner and worker workflow for this repository.

Use this as the active workflow model instead of the older Cloud-To-Local framing.

## Core Model

- The planner decides direction using whatever repository access is available.
- The worker edits files in the active local repository or worktree environment.
- The repository is the durable source of truth.
- The human supervises the loop and decides when to pause, commit, push, sync, or continue.

The planner may be ChatGPT, a planning-oriented agent, or another agent. The worker may be a worker agent or another implementation agent with write access to the active repository environment.

## Access-Aware Planning

Do not assume every planner has the same repository access.

A planner may have:

- GitHub connector access to current pushed files.
- Local filesystem access.
- Uploaded files.
- Pasted snippets or handoffs.
- Only a human summary.
- No reliable repository access.

The planner should state or infer what it can actually see before turning direction into a worker task. If repository access is incomplete, the planner should ask for the needed file, use a worker handoff, or recommend a human-directed sync when appropriate.

Do not assume a cloud planning agent cannot inspect repository files. Do not assume it can. Make the handoff match the access available in the moment.

## Repository Source Of Truth

The repository should carry durable project knowledge.

Use repository Markdown for:

- Workflow rules.
- Task briefs.
- Review notes.
- Backlog direction.
- Open questions.
- Reusable prompts.
- Decisions that should survive outside a chat thread.

Chat is useful for reasoning and review, but chat memory should not be the only place where important direction lives.

## Planner To Worker Handoff

Planner-to-worker prompts should be short, focused, and easy to copy.

A good worker prompt should:

- Begin with one short first-line tracking comment.
- Make the active local repository or worktree environment clear when it matters.
- Name the repository path and branch when relevant.
- Say what repository context the planner used or does not have.
- List read-first files.
- Describe one focused task.
- Include clear in-scope and out-of-scope boundaries.
- Include stop conditions.
- Require the standard worker handoff block at the end.

Do not paste giant transcript dumps by default. Summarize only the context needed for the next worker pass and point the worker to repository files whenever possible.

Normally, planning agents should provide worker prompts in a click-to-copy
code block in chat. A planning file or external handoff document does not
replace the click-to-copy prompt unless the prompt is too long or complex
for normal chat use.

Creating a repository planning file is useful when context should become
durable, but the planning agent should still give the user a copy-ready
worker prompt when a worker pass is expected next.

When the **planning agent is ChatGPT without local repo access**, live desk
work may need a stable cloud handoff document, a short pointer prompt, or
refreshed repository verification before the next task. After local edits,
normal mode is FastMirror when ChatGPT should read the refreshed Google Drive
reference mirror. Use the GDrive Enhanced Agentic Workflow Trigger in
`Capabilities/GoogleDriveLink/DriveCaptureWorkflow.md` (Google Drive option)
or the Dropbox-connector approach in
`Capabilities/AssistedAgenticWorkflow/Rules.md`. Keep any cloud handoff
documents temporary; repository source-of-truth files still belong in local
Git.

## Future Task Folder Boundary

A `Tasks/` structure inside the repository remains future-only.

Do not create any task-folder structure unless a stronger repeated need
appears and the owner explicitly approves that exact work. For now, use short
task briefs, backlog entries, and review files in the existing repository
structure.

## Worker Execution

The worker edits the active local repository or worktree environment named for the task.

The worker should:

- Confirm the prompt matches the active local repository or worktree before editing.
- Read the required files first.
- Keep changes small and reviewable.
- Edit only files needed for the task.
- Preserve user-authored content.
- Stop for missing required files, unexpected dirty state, conflicts, unclear scope, or unapproved website build, publishing, dependency, automation, owner-content, or restructuring decisions.

## Worker To Planner Handoff

Worker agents must end each completed pass with exactly one copy-ready fenced `text` handoff block.

Use these standard fields:

- Summary
- Files Changed
- Planning Files To Review
- Questions Added Or Changed
- Next Recommended Task

Avoid extra commentary outside the final handoff block unless reporting a blocking condition.

The handoff helps the human or planner review what happened and decide the next task. It is not a Git commit, GitHub sync, or replacement for repository files.

## Commit, Push, And Sync

Commit, push, and sync are human-directed milestone actions.

They are useful when:

- The human wants a durable checkpoint.
- The planner needs GitHub-visible files to review current repository state.
- A meaningful set of changes is ready to share.
- The owner asks for a sync or handoff across environments.

They are not default tasks after every worker pass.

Before recommending commit, push, or sync, identify intended files, suggest a concise commit message when useful, verify working-tree expectations, and stop for unexpected files, conflicts, failed checks, or unclear scope.

## Deprecated Framing

The older Cloud-To-Local wording is deprecated as a primary workflow concept.

Do not use it as the normal model because it assumes the planner is in cloud chat and cannot inspect local repository files. That may be true in some sessions, but it is not generally true.

Use access-aware planner/worker language instead.

## Beginner Rule

If the planner-to-worker prompt cannot be explained in a few plain sentences, the task is probably too large.

Prefer a small worker pass with clear read-first files, clear boundaries, and a copy-ready handoff over a giant prompt that tries to carry the whole project in chat.
