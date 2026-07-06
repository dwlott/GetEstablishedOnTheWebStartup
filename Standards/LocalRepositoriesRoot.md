<!--
IndexTitle: Local Repositories Root
IndexDescription: Configurable parent folder for local Git repositories on Windows.
IndexType: Standard
IndexStatus: Active
LastEdited: 2026-06-08
-->

# Local Repositories Root

## Purpose

One parent folder holds all local Git repositories. GitHub remotes are unchanged;
only local paths change.

## Default

```text
C:\Repositories\<RepositoryName>
```

Example: `C:\Repositories\GetEstablished`

## Override

```powershell
$env:GETESTABLISHED_REPOSITORIES_ROOT = 'D:\Repos'
[Environment]::SetEnvironmentVariable('GETESTABLISHED_REPOSITORIES_ROOT', 'D:\Repos', 'User')
```

Resolution order:

1. `GETESTABLISHED_REPOSITORIES_ROOT` if set
2. `C:\Repositories`

## Single-repository override

Mirror and refresh scripts use `GETESTABLISHED_LOCAL_REPO_ROOT` for one repo
root (see GoogleDriveLink MirrorWorkflow). Typical value:
`C:\Repositories\GetEstablished`.

## PowerShell helper

```powershell
. C:\Repositories\GetEstablished\Capabilities\GitHubWorkflow\RepositoryPaths.ps1

Get-RepositoriesRoot
Get-RepositoryPath GetEstablished
```

## Documentation convention

| Use | Form |
| --- | --- |
| Neutral | `<repositories-root>\<RepositoryName>` |
| Windows default | `C:\Repositories\<RepositoryName>` |
| Scripts | `Get-RepositoryPath` or env var |

Do not hardcode `C:\Repositories` in new active guidance.

## Agent memory refresh

After moving the folder, refresh Custom GPT Knowledge, Cursor workspace roots,
and any vendor rules that cite the old path.

## Related

- [CrossPlatformRepositoryPaths.md](CrossPlatformRepositoryPaths.md)
- [RepositoryPaths.ps1](../Capabilities/GitHubWorkflow/RepositoryPaths.ps1)
- [RepositoriesRootMigrationPlan.md](../Plans/RepositoriesRootMigrationPlan.md)
