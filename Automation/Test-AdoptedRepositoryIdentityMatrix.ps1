[CmdletBinding()]
param([string] $ProductRoot)

$ErrorActionPreference = 'Stop'
if ([string]::IsNullOrWhiteSpace($ProductRoot)) {
    $ProductRoot = Split-Path -Parent $PSScriptRoot
}
$verifier = Join-Path $PSScriptRoot 'Test-AdoptedRepositoryIdentity.ps1'
$tempBase = [IO.Path]::GetFullPath([IO.Path]::GetTempPath()).TrimEnd('\', '/')
$matrixRoot = Join-Path $tempBase ("GEOTWIdentityMatrix-" + [guid]::NewGuid().ToString('N'))
$matrixRoot = [IO.Path]::GetFullPath($matrixRoot)

if (-not $matrixRoot.StartsWith($tempBase + [IO.Path]::DirectorySeparatorChar,
        [StringComparison]::OrdinalIgnoreCase)) {
    throw "Unsafe matrix root: $matrixRoot"
}

function Invoke-IdentityVerifier(
    [string] $Root,
    [string] $CanonicalProductRoot,
    [string] $CanonicalStartupRoot
) {
    $commandArgs = @(
        '-NoProfile',
        '-ExecutionPolicy', 'Bypass',
        '-File', $verifier,
        '-Root', $Root,
        '-CanonicalProductRoot', $CanonicalProductRoot,
        '-CanonicalStartupRoot', $CanonicalStartupRoot
    )
    $previousPreference = $ErrorActionPreference
    $ErrorActionPreference = 'Continue'
    $output = (& powershell @commandArgs 2>&1 | Out-String).Trim()
    $exitCode = $LASTEXITCODE
    $ErrorActionPreference = $previousPreference
    return [pscustomobject]@{ ExitCode = $exitCode; Output = $output }
}

function Assert-Passed([string] $Name, $Result, [string] $Pattern) {
    if ($Result.ExitCode -ne 0 -or $Result.Output -notmatch $Pattern) {
        throw "$Name failed unexpectedly.`n$($Result.Output)"
    }
    Write-Output "PASS: $Name"
}

function Assert-Failed([string] $Name, $Result, [string] $Pattern) {
    if ($Result.ExitCode -eq 0 -or $Result.Output -notmatch $Pattern) {
        throw "$Name did not fail as expected.`n$($Result.Output)"
    }
    Write-Output "PASS: $Name (expected rejection)"
}

function Write-IdentityRecord(
    [string] $Root,
    [string] $Name,
    [string] $Remote,
    [string] $Branch
) {
    $workspace = Join-Path $Root 'Workspace'
    New-Item -ItemType Directory -Path $workspace -Force | Out-Null
    @(
        '# Repository Identity',
        '',
        "Repository name: $Name",
        'Identity mode: adopted-project',
        "Local root: $Root",
        "Git remote: $Remote",
        "Branch: $Branch",
        "Source of truth: Local repository at $Root",
        'Creation source: GetEstablishedOnTheWebStartup'
    ) | Set-Content -LiteralPath (Join-Path $workspace 'RepositoryIdentity.md') -Encoding UTF8
}

New-Item -ItemType Directory -Path $matrixRoot | Out-Null

try {
    $canonicalStartup = Join-Path $matrixRoot 'GetEstablishedOnTheWebStartup'
    New-Item -ItemType Directory -Path $canonicalStartup | Out-Null

    $result = Invoke-IdentityVerifier $ProductRoot $ProductRoot $canonicalStartup
    Assert-Passed 'canonical product' $result 'Identity mode: product'

    $result = Invoke-IdentityVerifier $canonicalStartup $ProductRoot $canonicalStartup
    Assert-Passed 'canonical Startup' $result 'Identity mode: canonical-template'

    $freshAdopted = Join-Path $matrixRoot 'FreshAdoptedProject'
    New-Item -ItemType Directory -Path $freshAdopted | Out-Null
    Write-IdentityRecord $freshAdopted 'FreshAdoptedProject' '(none)' '(none)'
    $result = Invoke-IdentityVerifier $freshAdopted $ProductRoot $canonicalStartup
    Assert-Passed 'fresh adopted copy without Git' $result 'identity record is valid'

    $freshBoot = Join-Path $freshAdopted 'AGENTS.md'
    'This is a **Get Established On The Web Startup** repository.' |
        Set-Content -LiteralPath $freshBoot -Encoding UTF8
    $result = Invoke-IdentityVerifier $freshAdopted $ProductRoot $canonicalStartup
    Assert-Failed 'formatted stale template declaration' $result 'Active adopted-project identity remains'

    @('# FreshAdoptedProject', '', 'Creation source: GetEstablishedOnTheWebStartup') |
        Set-Content -LiteralPath $freshBoot -Encoding UTF8
    $result = Invoke-IdentityVerifier $freshAdopted $ProductRoot $canonicalStartup
    Assert-Passed 'intentional source-template reference' $result 'identity record is valid'

    $staleRemote = Join-Path $matrixRoot 'StaleRemoteProject'
    New-Item -ItemType Directory -Path $staleRemote | Out-Null
    & git -C $staleRemote init --quiet
    & git -C $staleRemote remote add origin 'https://github.com/example/GetEstablishedOnTheWebStartup.git'
    $result = Invoke-IdentityVerifier $staleRemote $ProductRoot $canonicalStartup
    Assert-Failed 'noncanonical copy with stale Startup remote' $result 'Stale template or product remote'

    $staleGit = Join-Path $staleRemote '.git'
    if (-not ([IO.Path]::GetFullPath($staleGit)).StartsWith($matrixRoot + [IO.Path]::DirectorySeparatorChar,
            [StringComparison]::OrdinalIgnoreCase)) {
        throw "Unsafe stale Git path: $staleGit"
    }
    Remove-Item -LiteralPath $staleGit -Recurse -Force
    Write-IdentityRecord $staleRemote 'StaleRemoteProject' '(none)' '(none)'
    $result = Invoke-IdentityVerifier $staleRemote $ProductRoot $canonicalStartup
    Assert-Passed 'stale remote after adopted-copy detach' $result 'identity record is valid'

    $ownerRemote = Join-Path $matrixRoot 'OwnerRemoteProject'
    New-Item -ItemType Directory -Path $ownerRemote | Out-Null
    & git -C $ownerRemote init --quiet
    & git -C $ownerRemote remote add origin 'https://github.com/example/OwnerRemoteProject.git'
    $ownerBranch = (& git -C $ownerRemote symbolic-ref --quiet --short HEAD).Trim()
    Write-IdentityRecord $ownerRemote 'OwnerRemoteProject' 'https://github.com/example/OwnerRemoteProject.git' $ownerBranch
    $result = Invoke-IdentityVerifier $ownerRemote $ProductRoot $canonicalStartup
    Assert-Passed 'adopted project with owner remote' $result 'identity record is valid'

    Write-Output 'Result: all repository identity matrix scenarios passed.'
}
finally {
    if (Test-Path -LiteralPath $matrixRoot -PathType Container) {
        if (-not $matrixRoot.StartsWith($tempBase + [IO.Path]::DirectorySeparatorChar,
                [StringComparison]::OrdinalIgnoreCase)) {
            throw "Refusing to remove unsafe matrix root: $matrixRoot"
        }
        Remove-Item -LiteralPath $matrixRoot -Recurse -Force
    }
}
