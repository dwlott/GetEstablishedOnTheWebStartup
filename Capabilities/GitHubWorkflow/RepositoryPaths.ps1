# RepositoryPaths.ps1
#
# Resolve the local repositories parent folder and named repository paths.
#
# Dot-source:
#   . C:\Repositories\GetEstablished\Capabilities\GitHubWorkflow\RepositoryPaths.ps1
#
# Override parent folder:
#   $env:GETESTABLISHED_REPOSITORIES_ROOT = 'D:\Repos'

Set-StrictMode -Version Latest

function Get-RepositoriesRoot {
    if ($env:GETESTABLISHED_REPOSITORIES_ROOT) {
        return $env:GETESTABLISHED_REPOSITORIES_ROOT
    }
    return 'C:\Repositories'
}

function Get-RepositoryPath {
    param(
        [Parameter(Mandatory = $true, Position = 0)]
        [string]$Name
    )

    Join-Path (Get-RepositoriesRoot) $Name
}
