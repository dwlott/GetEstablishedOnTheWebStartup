param(
	[string] $ManifestPath = '',
	[switch] $IncludeOptional,
	[switch] $Json
)

$ErrorActionPreference = 'Stop'
. (Join-Path $PSScriptRoot '..\LocalWordPress\WampPaths.ps1')

function Get-WordPressSaveRepoRoot {
	return (Resolve-Path (Join-Path $PSScriptRoot '..\..')).Path
}

function Get-WordPressSaveManifest {
	param([string] $ExplicitPath)

	if (-not $ExplicitPath) {
		$ExplicitPath = Join-Path $PSScriptRoot 'ThemeTrackManifest.json'
	}

	if (-not (Test-Path -LiteralPath $ExplicitPath)) {
		throw "Manifest not found: $ExplicitPath"
	}

	return (Get-Content -LiteralPath $ExplicitPath -Raw | ConvertFrom-Json)
}

function Get-FileSha256 {
	param([string] $Path)

	if (-not (Test-Path -LiteralPath $Path)) {
		return $null
	}

	return (Get-FileHash -LiteralPath $Path -Algorithm SHA256).Hash
}

function Test-WordPressThemeFileChanged {
	param(
		[string] $ThemePath,
		[string] $RepoPath
	)

	if (-not (Test-Path -LiteralPath $ThemePath)) {
		return [PSCustomObject]@{
			Changed = $false
			Status = 'missing-theme'
			ThemeHash = $null
			RepoHash = $null
		}
	}

	$themeHash = Get-FileSha256 -Path $ThemePath
	if (-not (Test-Path -LiteralPath $RepoPath)) {
		return [PSCustomObject]@{
			Changed = $true
			Status = 'new-in-theme'
			ThemeHash = $themeHash
			RepoHash = $null
		}
	}

	$repoHash = Get-FileSha256 -Path $RepoPath
	return [PSCustomObject]@{
		Changed = ($themeHash -ne $repoHash)
		Status = if ($themeHash -eq $repoHash) { 'unchanged' } else { 'modified' }
		ThemeHash = $themeHash
		RepoHash = $repoHash
	}
}

$manifest = Get-WordPressSaveManifest -ExplicitPath $ManifestPath
$repoRoot = Get-WordPressSaveRepoRoot
$wampRoot = Get-WampWwwRoot
$wpRoot = Join-Path $wampRoot $manifest.wpSiteFolder
$themeRoot = Join-Path $wpRoot $manifest.themeRelativeRoot

$entries = @($manifest.gitTrackedFiles)
if ($IncludeOptional) {
	$entries += @($manifest.gitOptionalFiles)
}

$results = @()
foreach ($entry in $entries) {
	$themePath = Join-Path $themeRoot ($entry.themeRelative -replace '/', '\')
	$repoPath = Join-Path $repoRoot ($entry.repoRelative -replace '/', '\')
	$change = Test-WordPressThemeFileChanged -ThemePath $themePath -RepoPath $repoPath

	$results += [PSCustomObject]@{
		Category = $entry.category
		Role = $entry.role
		ThemeRelative = $entry.themeRelative
		RepoRelative = $entry.repoRelative
		ThemePath = $themePath
		RepoPath = $repoPath
		Changed = $change.Changed
		Status = $change.Status
		ThemeLastWrite = if (Test-Path -LiteralPath $themePath) {
			(Get-Item -LiteralPath $themePath).LastWriteTime.ToString('yyyy-MM-dd HH:mm:ss')
		} else { $null }
		ThemeBytes = if (Test-Path -LiteralPath $themePath) {
			(Get-Item -LiteralPath $themePath).Length
		} else { $null }
	}
}

$changed = @($results | Where-Object { $_.Changed })
$unchanged = @($results | Where-Object { -not $_.Changed })

Write-Host "WordPress theme change scan"
Write-Host "  WAMP theme root: $themeRoot"
Write-Host "  Tracked files:   $($results.Count)"
Write-Host "  Changed:         $($changed.Count)"
Write-Host "  Unchanged:       $($unchanged.Count)"
Write-Host ''

if ($changed.Count -gt 0) {
	Write-Host 'Changed files (candidates for Git save):'
	$changed | Sort-Object Category, ThemeRelative |
		Format-Table Category, Status, ThemeRelative, RepoRelative, ThemeLastWrite, ThemeBytes -AutoSize
}
else {
	Write-Host 'No tracked theme files differ from the repository.'
}

if ($Json) {
	$changed | ConvertTo-Json -Depth 4
}

return $results
