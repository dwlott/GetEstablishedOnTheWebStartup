<!--
IndexTitle: GitHubWorkflow PowerShell Prompts
IndexDescription: Copy-ready PowerShell command sequences for GitHub maintenance and first setup.
IndexType: Capability
CapabilityName: GitHubWorkflow
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-09
-->

# GitHubWorkflow PowerShell Prompts

Replace `<RepositoryName>` and `<GitHubUserName>` before using these commands.

## Repositories root

Default: `C:\Repositories\<RepositoryName>`. Override:
`GETESTABLISHED_REPOSITORIES_ROOT`. See
[LocalRepositoriesRoot.md](../../Standards/LocalRepositoriesRoot.md).

Load path helpers once per session:

```powershell
. C:\Repositories\GetEstablished\Capabilities\GitHubWorkflow\RepositoryPaths.ps1
cd (Get-RepositoryPath '<RepositoryName>')
```

Open PowerShell before using these command blocks.

## Save Git Output To Repository Root

Use this when console output is hard to read or you want a plain-text record
for review. Each repository gets its own log file:

```powershell
git-workflow-output.txt
```

File logging is optional. It is **on by default** in the examples below. Set
`$SaveGitOutputToFile = $false` before dot-sourcing, or pass `-NoSave` to
`Start-RepoGitLog`, to turn it off.

Load helpers once per PowerShell session:

```powershell
. C:\Repositories\GetEstablished\Capabilities\GitHubWorkflow\RepositoryPaths.ps1
. (Join-Path (Get-RepositoryPath 'GetEstablished') 'Capabilities\GitHubWorkflow\RepoGitOutput.ps1')
```

Single-repository example — push with logged output:

```powershell
Start-RepoGitLog (Get-RepositoryPath '<RepositoryName>')

Invoke-GitWithLog status
Invoke-GitWithLog push
Invoke-GitWithLog status

Stop-RepoGitLog
```

Review example — status and changed file names:

```powershell
Start-RepoGitLog (Get-RepositoryPath '<RepositoryName>')

Invoke-GitWithLog status
Invoke-GitWithLog diff --name-status

Stop-RepoGitLog
```

Turn off file logging for one visit:

```powershell
Start-RepoGitLog (Get-RepositoryPath '<RepositoryName>') -NoSave

git status
git push
```

Optional `.gitignore` entry when you do not want the log committed:

```gitignore
git-workflow-output.txt
```

## Push Selected Repositories With Per-Repo Logs

Use this instead of one shared `Start-Transcript` file when you push or review
several repositories in one session. Each repository writes to its own
`git-workflow-output.txt`.

Repositories under `Get-RepositoriesRoot` (edit `$names` each session):

| Repository | Resolved path |
| --- | --- |
| GetEstablished | `(Get-RepositoryPath 'GetEstablished')` |
| GetEstablishedStartup | `(Get-RepositoryPath 'GetEstablishedStartup')` |
| GetEstablishedOnTheWeb | `(Get-RepositoryPath 'GetEstablishedOnTheWeb')` |
| GetEstablishedOnTheWebStartup | `(Get-RepositoryPath 'GetEstablishedOnTheWebStartup')` |
| `<YourRepoName>` | `(Get-RepositoryPath '<YourRepoName>')` |
| `<AnotherRepo>` | `(Get-RepositoryPath '<AnotherRepo>')` |

```powershell
. C:\Repositories\GetEstablished\Capabilities\GitHubWorkflow\RepositoryPaths.ps1
. (Join-Path (Get-RepositoryPath 'GetEstablished') 'Capabilities\GitHubWorkflow\RepoGitOutput.ps1')

$names = @(
    'GetEstablished',
    'GetEstablishedStartup',
    'GetEstablishedOnTheWeb',
    'GetEstablishedOnTheWebStartup',
    '<YourRepoName>',
    '<AnotherRepo>'
)

foreach ($name in $names) {
    Start-RepoGitLog (Get-RepositoryPath $name)

    Invoke-GitWithLog status
    Invoke-GitWithLog push
    Invoke-GitWithLog status

    Stop-RepoGitLog
}
```

Follow-up review pass — status and diff only, no push:

```powershell
. C:\Repositories\GetEstablished\Capabilities\GitHubWorkflow\RepositoryPaths.ps1
. (Join-Path (Get-RepositoryPath 'GetEstablished') 'Capabilities\GitHubWorkflow\RepoGitOutput.ps1')

$names = @('<YourRepoName>', '<AnotherRepo>', 'GetEstablishedOnTheWeb')

foreach ($name in $names) {
    Start-RepoGitLog (Get-RepositoryPath $name)

    Invoke-GitWithLog status
    Invoke-GitWithLog diff --name-status

    Stop-RepoGitLog
}
```

Edit the `$repos` list and the commands inside the loop for each session.

## Prepare A Stable Folder

Use this before Git commands when the downloaded project is still under
`Downloads`.

```powershell
New-Item -ItemType Directory -Force -Path C:\Repositories

cd C:\Repositories
```

Then move or extract the project folder so the final folder is:

```powershell
C:\Repositories\<RepositoryName>
```

Do not keep working inside a nested extracted ZIP path such as:

```powershell
C:\Users\<Name>\Downloads\<RepositoryName>\<RepositoryName>
```

## Clone Repository

Use this when the repository already exists on GitHub and the user needs a
local copy.

```powershell
cd C:\Repositories

git clone https://github.com/<RepositoryOwner>/<RepositoryName>.git

cd <RepositoryName>

git status
```

## Check Status

```powershell
cd C:\Repositories\<RepositoryName>

git status
```

## Check Whether It Is Already A Git Repository

```powershell
cd C:\Repositories\<RepositoryName>

git status
```

If this works, do not run `git init`.

If Git says `fatal: not a git repository`, continue only after confirming this is the correct stable folder.

## Initialize Downloaded Folder

Use this only if `git status` says this is not a Git repository.

```powershell
cd C:\Repositories\<RepositoryName>

git init

git branch -M main

git status
```

## Optional Publication Step - First Local Commit

These commands publish or prepare work for GitHub. Use them only when the
owner explicitly asks to stage, commit, push, or publish changes. For normal
review, first use status and diff commands to inspect the work.

Review files first. Do not commit credentials, API keys, tokens, local `.env` files, scans, generated output folders, or private customer files.

```powershell
cd C:\Repositories\<RepositoryName>

git status

git add .

git commit -m "Initial repository setup"

git status
```

## Optional Publication Step - Connect To An Empty GitHub Repo

Use this only when `origin` does not already exist and the GitHub repository is empty or ready to receive this local repository.

```powershell
cd C:\Repositories\<RepositoryName>

git remote -v

git remote add origin https://github.com/<GitHubUserName>/<RepositoryName>.git

git remote -v
```

## Optional Publication Step - First Push

These commands publish or prepare work for GitHub. Use them only when the
owner explicitly asks to stage, commit, push, or publish changes. For normal
review, first use status and diff commands to inspect the work.

```powershell
cd C:\Repositories\<RepositoryName>

git status

git push -u origin main

git status
```

## If Origin Already Exists

Use this only if `origin` points to the wrong repository.

```powershell
cd C:\Repositories\<RepositoryName>

git remote -v

git remote set-url origin https://github.com/<GitHubUserName>/<RepositoryName>.git

git remote -v
```

## Verify Connection

```powershell
cd C:\Repositories\<RepositoryName>

git status

git remote -v

git log --oneline --decorate -5
```

## Check Current Repository

Use this when a user is unsure which repository or remote they are using.

```powershell
cd C:\Repositories\<RepositoryName>

git status

git remote -v

git log --oneline --decorate -5
```

## Start A Safe Docs Branch

Use this before a small documentation-only task when direct edits to `main`
are not the intended workflow.

```powershell
cd C:\Repositories\<RepositoryName>

git status

git switch -c docs/<short-task-name>

git status
```

## Pull Latest Changes

Use this before a work session when the user is ready to sync from GitHub.

```powershell
cd C:\Repositories\<RepositoryName>

git status

git pull

git status
```

Stop if Git reports conflicts.

## Optional Publication Step - Push Existing Work

Use this after a reviewed local commit and explicit owner approval to sync
with GitHub.

```powershell
cd C:\Repositories\<RepositoryName>

git status

git push

git status
```

## Check What Changed Locally

```powershell
cd C:\Repositories\<RepositoryName>

git status

git diff --name-only

git diff
```

Review the output before adding or committing files.

## Beginner Stop Notes

Stop and ask for help if any of these happen:

- GitHub says the repository was not found.
- Authentication fails or the wrong GitHub account appears.
- `git status` shows uncommitted work already present.
- Unexpected files appear in `git status`.
- Git reports merge conflicts or unmerged files.
- The folder is still under `Downloads`.
- The open folder is a Google Drive copy instead of the local Git repository.
