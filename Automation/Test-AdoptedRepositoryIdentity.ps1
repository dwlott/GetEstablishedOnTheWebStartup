[CmdletBinding()]
param(
    [string] $Root = (Get-Location).Path,
    [string] $CanonicalProductRoot = 'C:\Repositories\GetEstablishedOnTheWeb',
    [string] $CanonicalStartupRoot = 'C:\Repositories\GetEstablishedOnTheWebStartup'
)

$ErrorActionPreference = 'Stop'

function Get-NormalizedPath([string] $Path) {
    return [IO.Path]::GetFullPath($Path).TrimEnd('\', '/')
}

function Get-NormalizedRemote([string] $Remote) {
    if ([string]::IsNullOrWhiteSpace($Remote) -or $Remote -match '^\(?none\)?$') {
        return ''
    }
    $value = $Remote.Trim().TrimEnd('/')
    if ($value.EndsWith('.git', [StringComparison]::OrdinalIgnoreCase)) {
        $value = $value.Substring(0, $value.Length - 4)
    }
    return $value.ToLowerInvariant()
}

function Get-IdentityValue([string] $Text, [string] $Field) {
    $pattern = '(?im)^\s*' + [regex]::Escape($Field) + ':\s*(.+?)\s*$'
    $match = [regex]::Match($Text, $pattern)
    if (-not $match.Success) {
        throw "$Field is missing from the identity record."
    }
    $value = $match.Groups[1].Value.Trim()
    if ([string]::IsNullOrWhiteSpace($value) -or $value -match '^<.+>$') {
        throw "$Field is empty or still contains a placeholder."
    }
    return $value
}

$rootPath = Get-NormalizedPath $Root
$productRoot = Get-NormalizedPath $CanonicalProductRoot
$startupRoot = Get-NormalizedPath $CanonicalStartupRoot
$identityPath = Join-Path $rootPath 'Workspace\RepositoryIdentity.md'

if (-not (Test-Path -LiteralPath $rootPath -PathType Container)) {
    throw "Repository root not found: $rootPath"
}

$hasGit = Test-Path -LiteralPath (Join-Path $rootPath '.git')
$remote = ''
$branch = ''
if ($hasGit) {
    $insideWorkTree = (& git -C $rootPath rev-parse --is-inside-work-tree 2>$null)
    if ($LASTEXITCODE -ne 0 -or $insideWorkTree -ne 'true') {
        throw "Git metadata exists but is not a valid work tree: $rootPath"
    }

    $remoteOutput = (& git -C $rootPath remote get-url origin 2>$null)
    if ($LASTEXITCODE -eq 0 -and $remoteOutput) {
        $remote = ($remoteOutput | Select-Object -First 1).Trim()
    }

    $branchOutput = (& git -C $rootPath symbolic-ref --quiet --short HEAD 2>$null)
    if ($LASTEXITCODE -eq 0 -and $branchOutput) {
        $branch = ($branchOutput | Select-Object -First 1).Trim()
    }
}

$startupRemote = $remote -match 'GetEstablishedOnTheWebStartup(\.git)?/?$'
$productRemote = $remote -match 'GetEstablishedOnTheWeb(\.git)?/?$' -and -not $startupRemote
$canonicalStartup = $rootPath -ieq $startupRoot
$canonicalProduct = $rootPath -ieq $productRoot

if ($canonicalStartup) {
    if ($productRemote) {
        throw "Canonical Startup root points at the product remote: $remote"
    }
    Write-Output 'Identity mode: canonical-template'
    exit 0
}
if ($canonicalProduct) {
    if ($startupRemote) {
        throw "Canonical product root points at the Startup remote: $remote"
    }
    Write-Output 'Identity mode: product'
    exit 0
}
if ($startupRemote -or $productRemote) {
    throw "Stale template or product remote found in noncanonical repository: $remote"
}
if (-not (Test-Path -LiteralPath $identityPath -PathType Leaf)) {
    throw "Adopted project identity record is missing: $identityPath"
}

$identity = Get-Content -LiteralPath $identityPath -Raw
$repositoryName = Get-IdentityValue $identity 'Repository name'
$identityMode = Get-IdentityValue $identity 'Identity mode'
$recordedRoot = Get-IdentityValue $identity 'Local root'
$recordedRemote = Get-IdentityValue $identity 'Git remote'
$recordedBranch = Get-IdentityValue $identity 'Branch'
$sourceOfTruth = Get-IdentityValue $identity 'Source of truth'
$creationSource = Get-IdentityValue $identity 'Creation source'

if ($identityMode -cne 'adopted-project') {
    throw "Identity mode must be adopted-project; found: $identityMode"
}
if ($repositoryName -match '^GetEstablishedOnTheWeb(StartUp)?$') {
    throw "Adopted repository name retains a canonical name: $repositoryName"
}
if ((Get-NormalizedPath $recordedRoot) -ine $rootPath) {
    throw "Recorded Local root does not match the active root: $recordedRoot"
}
if ((Get-NormalizedRemote $recordedRemote) -cne (Get-NormalizedRemote $remote)) {
    throw "Recorded Git remote does not match origin. Recorded: $recordedRemote; Actual: $remote"
}

$actualBranch = if ($branch) { $branch } else { '(none)' }
if ($recordedBranch -ine $actualBranch) {
    throw "Recorded Branch does not match Git state. Recorded: $recordedBranch; Actual: $actualBranch"
}

$sourceMatch = [regex]::Match($sourceOfTruth, '(?i)^Local repository at\s+(.+)$')
if (-not $sourceMatch.Success -or
    (Get-NormalizedPath $sourceMatch.Groups[1].Value.Trim()) -ine $rootPath) {
    throw "Source of truth must identify the active local repository: $rootPath"
}
if ($creationSource -cne 'GetEstablishedOnTheWebStartup') {
    throw "Creation source must be GetEstablishedOnTheWebStartup; found: $creationSource"
}

$activeFiles = @(
    'AGENTS.md',
    'README.md',
    'Capabilities\README.md',
    'Capabilities\RouterIndex.md',
    'Capabilities\AgentCapabilityGuide.md',
    'Plans\README.md',
    'Plans\RepositorySearchMap.md',
    'Plans\AgentTaskBacklog.md'
) | ForEach-Object { Join-Path $rootPath $_ } | Where-Object {
    Test-Path -LiteralPath $_ -PathType Leaf
}

$stale = @()
foreach ($file in $activeFiles) {
    $text = (Get-Content -LiteralPath $file -Raw) -replace '\*\*|`', ''
    if ($text -match 'This is (a |the )?Get.?Established.?On.?The.?Web.?Startup|this (is|repo is) .*starter repository|Repository:\s*GetEstablishedOnTheWebStartup' -or
        $text -match '(?im)^\s*(?:#\s+|IndexTitle:\s*)(?:Get Established On The Web Startup|GetEstablishedOnTheWebStartup)\s*$') {
        $stale += $file
    }
}

if ($stale.Count -gt 0) {
    throw ("Active adopted-project identity remains in:" + [Environment]::NewLine + ($stale -join [Environment]::NewLine))
}

Write-Output 'Identity mode: adopted-project'
Write-Output "Repository name: $repositoryName"
Write-Output "Repository root: $rootPath"
Write-Output "Git remote: $(if ($remote) { $remote } else { '(none)' })"
Write-Output "Branch: $actualBranch"
Write-Output 'Result: identity record is valid.'
