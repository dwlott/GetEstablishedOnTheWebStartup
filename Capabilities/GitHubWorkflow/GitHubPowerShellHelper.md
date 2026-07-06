<!--
IndexTitle: GitHub PowerShell Helper
IndexDescription: Practical PowerShell-first Git and GitHub CLI commands for local GEOTW repository workflow.
IndexType: Setup
IndexStatus: Draft
LastEdited: 2026-06-08
-->

# GitHub PowerShell Helper

## Purpose

Provide practical PowerShell-first GitHub workflow commands for Get Established On The Web users.

This is not a full Git course. Use it when you need to check setup, review changes, create a clear local commit, or sync at a milestone.

## PowerShell First

These examples are written for PowerShell on Windows.

Use PowerShell from the repository folder:

```powershell
cd C:\Repositories\GetEstablished
```

Stop and ask for help if a command shows a conflict, an unexpected file deletion, a credential problem, or output you do not understand.

## Save Git Output For Review

When console output is hard to read or you work across several repositories,
use [RepoGitOutput.ps1](RepoGitOutput.ps1). It writes plain-text output to
`git-workflow-output.txt` in each repository root while still printing to the
console.

File logging is optional and on by default in
[PowerShellPrompts.md](PowerShellPrompts.md). Set `$SaveGitOutputToFile =
$false` to disable it for a session.

## Check Git Installation

```powershell
git --version
```

If Git is installed, this prints a version number.

## Check GitHub CLI Installation

```powershell
gh --version
```

If GitHub CLI is installed, this prints a version number.

## Authenticate GitHub CLI

```powershell
gh auth status
```

If you are not signed in:

```powershell
gh auth login
```

Follow the prompts. Stop if the prompt asks for access you do not understand.

## Clone A Repository

Use this only when the repository is not already on your computer.

```powershell
git clone https://github.com/OWNER/REPOSITORY.git
```

Then enter the folder:

```powershell
cd REPOSITORY
```

Replace `OWNER` and `REPOSITORY` with the real GitHub owner and repository name.

## Pull Latest Changes

Use this before starting a new local work session when you are ready to sync from GitHub:

```powershell
git pull
```

Stop and ask for help if Git reports conflicts.

## Check Status

```powershell
git status
```

Use this to see changed, added, deleted, or untracked files.

## Review Changes

Show changed file names:

```powershell
git diff --name-only
```

Show the actual edits:

```powershell
git diff
```

Review changes before committing. Do not commit files you do not recognize.

## Add Files

Add one file:

```powershell
git add Capabilities\GitHubWorkflow\GitHubPowerShellHelper.md
```

Add several known files:

```powershell
git add Plans\AgentWorkflowModes.md Plans\AgentReviewChecklist.md
```

Avoid broad adds until you have reviewed `git status` and `git diff`.

## Commit With A Concise Message

Use a short professional message:

```powershell
git commit -m "Update workflow handoff guidance"
```

Good commit messages are clear and brief:

- `Add owner folder architecture plan`
- `Refine product language guidance`
- `Add agent permissions guidance`
- `Update repository organization plan`

The implementation handoff can explain details. The commit message should stay short.

## Push Or Sync At Milestones

Push only after review and only when the human wants to sync with GitHub:

```powershell
git push
```

Push or sync at meaningful milestones, not after every tiny edit.

## Common Line Ending Warnings

Git may warn that line endings will change between LF and CRLF.

That warning often appears on Windows and does not always mean the content is wrong. Still, review the actual file changes before committing.

If line ending warnings appear with unexpected content changes, stop and ask for help.

## Stop Conditions

Stop and ask for help when:

- Git reports merge conflicts.
- `git status` shows deleted or renamed files you did not expect.
- A command asks for broad access, credentials, or system changes you do not understand.
- The task would push, publish, deploy, install dependencies, or change automation without explicit approval.
- You are unsure which files should be committed.

## Copy-Ready Milestone Check

Use this before a human-approved commit or sync:

```powershell
git status
git diff --name-only
```

Then review the changed files before adding, committing, or pushing.
