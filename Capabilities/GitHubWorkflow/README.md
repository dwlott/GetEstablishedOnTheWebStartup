<!-- Index: GitHub workflow Capability for local maintenance, review handoff, and first-push setup. -->
<!--
IndexTitle: GitHubWorkflow Capability
IndexDescription: Maintain GitHub-backed repositories, separate review from publication, and onboard beginners to GitHub and AI tool workflows.
IndexType: Capability
CapabilityName: GitHubWorkflow
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-08
-->

# GitHubWorkflow Capability

- **Version:** 1
- **Tier:** Universal
- **Purpose:** Help users maintain GitHub-backed repositories, separate optional cloud-assisted review from owner-approved publication, safely connect a downloaded Get Established starter folder to their own GitHub repository, and understand beginner GitHub + AI tool onboarding.
- **Inputs:** Local folder path, Git status output, remote URL, user's GitHub repository state, tool access state, and the user's current starting path.
- **Outputs:** Copy-ready Git command sequences, safe stop decisions, troubleshooting guidance, verification prompts, and first-commit / first-push workflow support.
- **WhenToUse:** When the user asks about `git status`, pull, push, remotes, first commits, GitHub sync, beginner GitHub onboarding, connecting AI tools to GitHub, checking whether files reached GitHub, or setting up a downloaded repository folder.

## Scope

This Capability covers four related paths:

1. Normal GitHub maintenance for an existing local repository.
2. Beginner setup after a user downloads the Get Established On The Web repository from the website as a ZIP or starter folder.
3. Beginner onboarding for GitHub, ChatGPT, Codex, Cursor, Claude Code,
   and optional Google Drive repository access.
4. Optional cloud-assisted review handoff — when the owner or remote planner
   **explicitly requests** review sync, local edits may be copied to a Google
   Drive review mirror so ChatGPT can read them. Git and cloud are **not
   connected**; mirroring is never automatic. Runnable steps live in
   [GoogleDriveLink/WorkflowIndex.md](../GoogleDriveLink/WorkflowIndex.md).

For beginner setup, the recommended stable folder is:

```powershell
C:\Repositories\<RepositoryName>
```

Users should not work directly from `Downloads`.

## Beginner Setup Path

For a downloaded ZIP, keep the path simple:

1. Download the ZIP from the website or GitHub.
2. Extract the ZIP.
3. Move the extracted project folder to `C:\Repositories\<RepositoryName>`.
4. Open PowerShell.
5. Run the status check from [PowerShellPrompts.md](PowerShellPrompts.md).
6. Initialize Git only if `git status` says it is not a Git repository.
7. Review files before the first commit.
8. Connect `origin` only after the GitHub repository is ready.
9. Push only after the first local commit succeeds.

PowerShell is the command window for the copy-ready commands in this
Capability. Users can open it from the Start menu, Windows Terminal, or a
terminal panel in an editor.

Normal maintenance uses status checks and review first. Stage, commit, push,
and pull request steps are publication actions and should happen only when
the owner explicitly asks for that workflow.
Emergency or conflict recovery starts only when Git reports conflicts,
non-fast-forward rejection, unexpected deletions, or other stop-rule output.
Do not mix destructive recovery commands into the beginner setup path.

## Review Workflow Versus Publication Workflow

Authority order: **local Git** (source of truth) → **GitHub** (backup and
publication) → **Google Drive or Dropbox** (optional disposable review mirror
only when requested). See
[SourceOfTruthAndMirrorStandard.md](../../Standards/SourceOfTruthAndMirrorStandard.md).

**Default after local edits:** do not copy to cloud. **Cursor** sessions with
the repository open skip cloud copy — the planner reads local files directly.

When the owner or ChatGPT planner **explicitly requests** cloud review sync:

1. The local worker edits files in the local Git repository.
2. Local changes stay **uncommitted** unless the owner asks to publish.
3. The worker runs the on-demand mirror workflow from
   [GoogleDriveLink/WorkflowIndex.md](../GoogleDriveLink/WorkflowIndex.md)
   (or [DropboxLink/WorkflowIndex.md](../DropboxLink/WorkflowIndex.md) when
   Dropbox is the review surface).
4. ChatGPT reads the refreshed cloud copy for review.
5. The owner decides later whether to stage, commit, push, or create a pull
   request.

Publication is separate. Use stage, commit, push, and pull request guidance
only when the owner explicitly asks to publish work to GitHub.

## Beginner GitHub + AI Tool Onboarding

Use [BeginnerGitHubOnboarding.md](BeginnerGitHubOnboarding.md) when the user
needs a plain-language path for signing in to GitHub, accepting repository
access, connecting ChatGPT or Codex, opening the repository in Cursor, using
Claude Code, or understanding what each tool does.

Keep the message reassuring and practical: the user does not need to master
GitHub at once, routine steps are often guided by the tools, and the safest
habit is to ask the assistant to explain the next step before commands run.

## User Starting Paths

Help the user choose the nearest starting point:

| User state | Start with |
| --- | --- |
| A. I have a ZIP folder | Extract it, move the extracted folder to `C:\Repositories\<RepositoryName>`, then check Git status. |
| B. I have a normal folder | Move or confirm it is in `C:\Repositories\<RepositoryName>`, then check Git status. |
| C. I already cloned it | Do not run `git init`; use normal maintenance commands. |
| D. I already created the GitHub repo | Check `git remote -v`; add or update `origin` only as needed. |

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | promoted workflow — migration from Intake capabilities |
| **SourceSummary** | Git status, pull, push, beginner onboarding; GitHub as backup/history layer |
| **PromotionStatus** | Active |
| **Dependencies** | SourceOfTruthAndMirrorStandard; GoogleDriveLink or DropboxLink when cloud review is requested |
| **RelatedFiles** | Rules.md, Prompt.md, PowerShellPrompts.md, RepositoryPaths.ps1, RepoGitOutput.ps1, ChatGPTGitHubGPTInstructions.md, GitHubWorkflowRepositoryRegistry.md |
| **LastReviewed** | 2026-06-05 |
| **HarmonizationNotes** | Review-vs-publication aligned with on-demand cloud mirror model |

## Related Files

- Canonical rules: [Rules.md](Rules.md)
- Beginner onboarding: [BeginnerGitHubOnboarding.md](BeginnerGitHubOnboarding.md)
- Worker entry: [Prompt.md](Prompt.md)
- Copy-ready command prompts: [PowerShellPrompts.md](PowerShellPrompts.md)
- Per-repository git output logging: [RepoGitOutput.ps1](RepoGitOutput.ps1)
- Path resolution helper: [RepositoryPaths.ps1](RepositoryPaths.ps1)
- Custom GPT deploy pack: [ChatGPTGitHubGPTInstructions.md](ChatGPTGitHubGPTInstructions.md)
- Repository registry (Knowledge): [GitHubWorkflowRepositoryRegistry.md](GitHubWorkflowRepositoryRegistry.md)
- Error guidance: [TroubleshootingMatrix.md](TroubleshootingMatrix.md)
- Beginner setup worker prompt: [SetupPrompt.md](SetupPrompt.md)
- Supporting setup note: [GitHubWorkflow.md](GitHubWorkflow.md)
- Supporting command helper: [GitHubPowerShellHelper.md](GitHubPowerShellHelper.md)

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-05-30 | 1 | Initial active Capability for GitHub maintenance and downloaded-folder first push setup | Keep first GitHub connection steps safe, beginner-readable, and copy-ready | README, Rules, Prompt, PowerShellPrompts, TroubleshootingMatrix, SetupPrompt |
| 2026-05-31 | 1 | Clarified ZIP-to-first-push setup path and PowerShell entry point | Make the beginner path easier to follow before any Git commands run | README, Rules, PowerShellPrompts, TroubleshootingMatrix, SetupPrompt |
| 2026-06-01 | 1 | Added beginner GitHub and AI tool onboarding | Help beginners connect GitHub, ChatGPT, Codex, Cursor, Claude Code, and Drive with safe verification prompts | BeginnerGitHubOnboarding, README, Prompt, SetupPrompt, PowerShellPrompts, TroubleshootingMatrix |
| 2026-06-01 | 1 | Clarified review versus publication workflows | Keep GDrive review uncommitted unless the owner explicitly asks to publish | README, Rules, BeginnerGitHubOnboarding, Prompt, SetupPrompt, PowerShellPrompts, TroubleshootingMatrix |
| 2026-06-05 | 1 | Aligned review section with on-demand cloud mirror model | No automatic GDrive refresh; cloud copy only on explicit request; Cursor skips mirror | README, Rules, Prompt, SetupPrompt, BeginnerGitHubOnboarding, TroubleshootingMatrix |
| 2026-06-08 | 1 | Added optional per-repository git output logging | Console output is hard to capture across multi-repo push sessions; write plain-text logs to each repo root | RepoGitOutput.ps1, PowerShellPrompts, GitHubPowerShellHelper, Rules, README |
| 2026-06-09 | 1 | Renamed local root to C:\Repositories with configurable GETESTABLISHED_REPOSITORIES_ROOT | Easier maintenance; agent memory refresh after folder move | LocalRepositoriesRoot, RepositoryPaths, PowerShellPrompts, Registry, GPT Instructions, 114 active docs |
