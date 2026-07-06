<!--
IndexTitle: GitHub Workflow
IndexDescription: Local pull, edit, review, commit, and milestone sync workflow notes.
IndexType: Workflow
IndexStatus: Active
LastEdited: 2026-05-23
-->

# GitHub Workflow

Use this workflow for local repository sessions.

## Before Starting

- Pull or sync the latest changes before starting a work session.
- Read `AGENTS.md`, `README.md`, and the relevant planning or prompt files.
- Work on one focused task at a time.
- Use `Capabilities/GitHubWorkflow/GitHubPowerShellHelper.md` for PowerShell-first command examples.

## While Working

- Keep `main` clean by making small, understandable changes.
- Avoid unrelated edits while completing a task.
- Review changed files before handing off or committing.
- Stop and ask for help if a merge conflict, unclear change, or unexpected file state appears.

## Committing

- Commit through the agent interface or Git when a focused task is complete.
- Use a short commit message that explains the result.
- Do not commit partial work unless it is useful to preserve a clear checkpoint.

## Pushing And Syncing

- Push or sync to GitHub at meaningful milestones.
- Do not push after every tiny change unless the user asks for that workflow.
- Confirm `git status` before and after important Git actions.

## Good Session Handoff

- Summarize what changed.
- List files changed.
- List planning files to review.
- List questions added or changed.
- Recommend the next local pass.

Do not include full `git status` in normal implementation handoffs. Include it only when there is a conflict, unexpected dirty state, requested commit or sync, or blocking condition.
