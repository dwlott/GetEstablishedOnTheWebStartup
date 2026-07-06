<!--
IndexTitle: GitHubWorkflow Rules
IndexDescription: Stop rules, safety boundaries, and command style for GitHub workflow support.
IndexType: Capability
CapabilityName: GitHubWorkflow
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-09
-->

# GitHubWorkflow Rules

Use these rules before giving commands or editing GitHub workflow docs.

## Command Style

- Prefer plain PowerShell command sequences that look like commands the user would type.
- Use `cd (Get-RepositoryPath '<RepositoryName>')` after dot-sourcing
  [RepositoryPaths.ps1](RepositoryPaths.ps1), or `cd C:\Repositories\<RepositoryName>`
  when helpers are not loaded. Default root: `C:\Repositories`; override
  `GETESTABLISHED_REPOSITORIES_ROOT`. See
  [LocalRepositoriesRoot.md](../../Standards/LocalRepositoriesRoot.md).
- Tell beginners when to open PowerShell before showing Git commands.
- Do not use `Write-Host` report scripts unless the user explicitly asks for a script-style report.
- Keep commands copy-ready and short.
- Tell the user what output to look for, but do not wrap simple Git checks in custom scripts.
- When the user needs readable output capture across one or more repositories,
  use [RepositoryPaths.ps1](RepositoryPaths.ps1), [RepoGitOutput.ps1](RepoGitOutput.ps1),
  and the patterns in [PowerShellPrompts.md](PowerShellPrompts.md). File logging
  is optional; keep it on unless the user turns it off.

## Review Workflow Versus Publication Workflow

Authority order: local Git (source of truth) → GitHub (backup and publication)
→ Google Drive or Dropbox (optional disposable review mirror **only when
requested**). See
[SourceOfTruthAndMirrorStandard.md](../../Standards/SourceOfTruthAndMirrorStandard.md).

**Default after local edits:** do not copy to cloud. **Cursor** sessions with
the repository open skip cloud copy.

Cloud-assisted review means the owner or remote planner **explicitly requested**
review sync so ChatGPT can read current files. In that workflow, leave local
changes uncommitted. Do not stage, commit, push, or create a pull request
unless the owner explicitly asks. Runnable mirror steps live in
[GoogleDriveLink/WorkflowIndex.md](../GoogleDriveLink/WorkflowIndex.md) or
[DropboxLink/WorkflowIndex.md](../DropboxLink/WorkflowIndex.md).

Publication means the owner has explicitly asked to stage, commit, push, or
open a pull request. Treat publication as a separate workflow after review.

## Normal Workflow Versus Recovery

Normal workflow means checking status, reviewing files, and choosing either
optional cloud-assisted review (when explicitly requested) or an
owner-approved publication step.

Recovery means Git has reported a problem such as conflicts, unmerged files,
non-fast-forward rejection, unexpected deletions, authentication failure, or
repository ownership confusion.

Keep recovery separate from normal setup. Do not introduce destructive commands
while guiding a beginner through ZIP extraction, first commit, or first push.

## Stop Rules

- Do not run `git init` if `git status` already works.
- Do not add `origin` if `origin` already exists.
- Do not use `git add .` until the user has reviewed files.
- Do not stage, commit, push, or create a pull request during a cloud-assisted
  review workflow unless explicitly instructed.
- Do not force push.
- Do not use `git reset --hard` or `git clean -fd` unless the user explicitly asks for destructive recovery and the warning is clear.
- If expected GitHub files are missing, stop and ask whether the user pushed the local work.
- Stop for merge conflicts, unmerged files, unexpected deletions, credential prompts, or repository ownership confusion.

## Beginner Folder Rule

Downloaded ZIPs and starter folders should be moved out of `Downloads` before work begins.

Recommended path:

```powershell
C:\Repositories\<RepositoryName>
```

The user may choose another stable folder, but avoid temporary folders, synced-desktop clutter, or nested ZIP extraction folders such as:

```powershell
C:\Users\<Name>\Downloads\<RepositoryName>\<RepositoryName>
```

## First Commit Review Rule

Before `git add .`, the user must review files.

Do not commit credentials, API keys, tokens, local `.env` files, scans, generated output folders, private customer files, or scratch files unless the user explicitly intends to track them.

Use `.gitignore` guidance before the first commit when local-only folders are present.

## Remote Rules

- If `git remote -v` shows no `origin`, use `git remote add origin ...`.
- If `origin` exists but points to the wrong repository, use `git remote set-url origin ...`.
- If `origin` exists and points to the right repository, do not change it.
- If the GitHub repository is not empty, do not blindly push over it. Pull or ask for a merge plan first.

## Maintenance Workflow

For normal repository maintenance:

1. Check status.
2. Pull before starting when the user is ready to sync from GitHub.
3. Review changed files before any publication command.
4. For cloud-assisted review (when explicitly requested), leave changes
   uncommitted and run the on-demand mirror workflow from GoogleDriveLink or
   DropboxLink so ChatGPT can review.
5. Commit focused changes only when the owner explicitly asks to publish.
6. Push at meaningful milestones only when the owner explicitly approves.
7. Verify with `git status`, `git remote -v`, and recent log output when
   publication commands are used.

## Checking Whether Files Were Pushed

When a user says files are missing on GitHub:

1. Check local `git status`.
2. Check whether the expected files are tracked or untracked.
3. Check recent commits with `git log --oneline --decorate -5`.
4. Check `git remote -v`.
5. Ask whether the user pushed after the local commit if the remote view is missing expected files.

Do not assume GitHub is wrong before checking whether local work was committed and pushed.

## .gitignore Guidance

Large intake folders should usually be ignored unless they are intentionally part of the repository.

Common local-only or sensitive items:

- Scans and source uploads.
- Generated output folders.
- Credentials, tokens, and local `.env` files.
- Private customer files.
- Scratch folders and temporary exports.
- Large media or archives that are not source material.

Prefer adding clear `.gitignore` entries before the first commit rather than cleaning up sensitive files after they were committed.

## When Operating Profile Is Remote-Only Or GitHub-Then-Local

When the user has **no local clone** or cannot run local Git:

- Use [CloudOnlyGitHubWorkflow.md](CloudOnlyGitHubWorkflow.md) as the primary
  **GitHub-primary** path.
- **Private repository** is valid; do not require public visibility.
- Use **device-appropriate paths** — GitHub web/mobile: Issues, PR review,
  merge; not PowerShell.
- Do not default to `cd C:\Repositories\...` or local Git commands.
- Hosted agents work via PRs; owner reviews before merge.

When the user later clones locally, resume standard Rules in this file
(**local-primary**).

Terminology: [NamingStandard.md](../../Standards/NamingStandard.md)
§Environment-Adaptive Model.

## Related

- [CloudOnlyGitHubWorkflow.md](CloudOnlyGitHubWorkflow.md)
- [CloudOnlyDeviceWorkflow.md](../SituationalAwareness/CloudOnlyDeviceWorkflow.md)
- [BeginnerGitHubOnboarding.md](BeginnerGitHubOnboarding.md)
