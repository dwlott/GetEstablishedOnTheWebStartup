<!--
IndexTitle: GitHub Workflow Repository Registry
IndexDescription: Repository registry and command reference for Custom GPT Knowledge upload.
IndexType: Capability
CapabilityName: GitHubWorkflow
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-09
-->

# GitHub Workflow Repository Registry

Upload as **Knowledge** for a Custom GitHub GPT. Do not paste into Instructions.

## Repositories root

| Setting | Value |
| --- | --- |
| Default root | `C:\Repositories` |
| Override | `GETESTABLISHED_REPOSITORIES_ROOT` |
| Path pattern | `<repositories-root>\<RepositoryName>` |

```powershell
. C:\Repositories\GetEstablished\Capabilities\GitHubWorkflow\RepositoryPaths.ps1
Get-RepositoriesRoot
Get-RepositoryPath GetEstablished
```

## Repository registry

| Repository | Role |
| --- | --- |
| GetEstablished | Method host; capabilities, plans, standards |
| GetEstablishedStartup | Starter-package packaging and repair mirror |
| GetEstablishedOnTheWeb | Product and website repository |
| GetEstablishedOnTheWebStartup | Web-presence starter repository |
| `<YourRepoName>` | Example commissioned or code repository |
| `<AnotherRepo>` | Example specialty repository |

## Setup paths

| Case | Steps |
| --- | --- |
| A. ZIP | Extract → move to `(Get-RepositoryPath '<Name>')` → git status |
| B. Folder | Move to `(Get-RepositoryPath '<Name>')` → git status |
| C. Clone | git status only; do not git init |
| D. Remote exists | git remote -v before changing origin |

## Commands

```powershell
. C:\Repositories\GetEstablished\Capabilities\GitHubWorkflow\RepositoryPaths.ps1
cd (Get-RepositoryPath '<RepositoryName>')
git status
git diff --name-only
git diff --name-status
git pull
git push
git remote -v
git log --oneline --decorate -5
```

## Multi-repo session with per-repo logs

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

Review-only: replace push with `Invoke-GitWithLog diff --name-status`.

Log file: `git-workflow-output.txt` in each repo root. Default: logging on.
Off: `$SaveGitOutputToFile = $false` or `Start-RepoGitLog -NoSave`.

## GitHub CLI

```powershell
gh auth status
gh repo view
```

Optional when gh is installed. PowerShell git commands remain default.

## Troubleshooting

| Symptom | Check |
| --- | --- |
| Repo not visible in ChatGPT | Connector access, account, repo selection |
| ChatGPT cannot push | Expected; use local PowerShell or coding agent |
| Files missing on GitHub | Local status, commits, remote, push history |
| Wrong local path | `Get-RepositoriesRoot`; env var override |
| Pull conflicts | Stop; do not force push |

Full matrix: TroubleshootingMatrix.md (Knowledge).
