[CmdletBinding()]
param(
    [string] $Root = (Get-Location).Path
)

$ErrorActionPreference = 'Stop'
$rootPath = [IO.Path]::GetFullPath($Root)
$identityPath = Join-Path $rootPath 'Workspace\RepositoryIdentity.md'

function Fail([string] $Message) {
    Write-Error $Message
    exit 1
}

if (-not (Test-Path -LiteralPath $rootPath -PathType Container)) {
    Fail "Repository root not found: $rootPath"
}

$remote = ''
if (Test-Path -LiteralPath (Join-Path $rootPath '.git')) {
    $remote = (& git -C $rootPath remote get-url origin 2>$null)
    if ($remote) { $remote = ($remote | Select-Object -First 1).Trim() }
}

$startupRemote = $remote -match 'GetEstablishedOnTheWebStartup(\.git)?$'
$productRemote = $remote -match 'GetEstablishedOnTheWeb(\.git)?$' -and -not $startupRemote
$canonicalRoot = $rootPath.TrimEnd('\') -ieq 'C:\Repositories\GetEstablishedOnTheWebStartup'
$productRoot = $rootPath.TrimEnd('\') -ieq 'C:\Repositories\GetEstablishedOnTheWeb'

if ($canonicalRoot) {
    Write-Output 'Identity mode: canonical-template'
    Write-Output 'Result: Startup identity is preserved; adopted cleanup is not applicable.'
    exit 0
}

if ($productRoot) {
    Write-Output 'Identity mode: product'
    Write-Output 'Result: Product identity is preserved; adopted cleanup is not applicable.'
    exit 0
}

if ($startupRemote -or $productRemote) {
    Fail "Stale template or product remote found in noncanonical repository: $remote"
}

if (-not (Test-Path -LiteralPath $identityPath -PathType Leaf)) {
    Fail "Adopted project identity record is missing: $identityPath"
}

$identity = Get-Content -LiteralPath $identityPath -Raw
if ($identity -notmatch '(?im)^\s*Identity mode:\s*adopted-project\s*$') {
    Fail 'Identity record does not declare Identity mode: adopted-project.'
}
if ($identity -notmatch '(?im)^\s*Repository name:\s*\S+') {
    Fail 'Identity record does not contain an owner-confirmed repository name.'
}
if ($identity -notmatch '(?im)^\s*Local root:\s*\S+') {
    Fail 'Identity record does not contain a local root.'
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
    $text = Get-Content -LiteralPath $file -Raw
    if ($text -match 'This is (a |the )?Get.?Established.?On.?The.?Web.?Startup|this (is|repo is) .*starter repository|Repository:\s*GetEstablishedOnTheWebStartup') {
        $stale += $file
    }
}

if ($stale.Count -gt 0) {
    Fail ("Active adopted-project identity remains in:" + [Environment]::NewLine + ($stale -join [Environment]::NewLine))
}

Write-Output 'Identity mode: adopted-project'
Write-Output "Repository root: $rootPath"
Write-Output "Git remote: $remote"
Write-Output 'Result: adopted identity record and active boot surfaces are consistent.'
