param(
	[switch] $ThemeOnly,
	[switch] $DatabaseOnly,
	[switch] $DropboxOnly,
	[switch] $IncludeOptionalThemeFiles,
	[switch] $WhatIf,
	[switch] $SkipDropboxMirror,
	[string] $ManifestPath = ''
)

$ErrorActionPreference = 'Stop'

function Get-WordPressSaveRepoRoot {
	return (Resolve-Path (Join-Path $PSScriptRoot '..\..')).Path
}

$repoRoot = Get-WordPressSaveRepoRoot
$manifestPathResolved = if ($ManifestPath) { $ManifestPath } else { Join-Path $PSScriptRoot 'ThemeTrackManifest.json' }
$manifest = Get-Content -LiteralPath $manifestPathResolved -Raw | ConvertFrom-Json
$siteKey = $manifest.siteKey
$dbTarget = $manifest.databaseSnapshot.repoRelative

$changesScript = Join-Path $PSScriptRoot 'Get-WordPressThemeChanges.ps1'
$dbExportScript = Join-Path $PSScriptRoot '..\DatabaseBackups\Export-LocalWordPressDatabase.ps1'
$dropboxMirrorScript = Join-Path $PSScriptRoot '..\MirrorWebAssets\Mirror-WebAssetsToDropbox.ps1'

$runDatabase = -not $ThemeOnly -and -not $DropboxOnly
$runTheme = -not $DatabaseOnly -and -not $DropboxOnly
$runDropbox = -not $ThemeOnly -and -not $DatabaseOnly -and -not $SkipDropboxMirror

if ($ThemeOnly) { $runTheme = $true }
if ($DatabaseOnly) { $runDatabase = $true }
if ($DropboxOnly) { $runDropbox = $true }

Write-Host 'WordPress Save workflow'
Write-Host "  Repository:      $repoRoot"
Write-Host "  Save theme:      $runTheme"
Write-Host "  Save database:   $runDatabase"
Write-Host "  Mirror Dropbox:  $runDropbox"
Write-Host "  WhatIf:          $($WhatIf.IsPresent)"
Write-Host ''

$themeSaved = @()
$themeSkipped = @()

if ($runTheme) {
	Write-Host '=== Step 1 — Theme files to Git (changed tracked files only) ==='

	$changeArgs = @()
	if ($ManifestPath) { $changeArgs += '-ManifestPath', $ManifestPath }
	if ($IncludeOptionalThemeFiles) { $changeArgs += '-IncludeOptional' }

	$scan = & $changesScript @changeArgs
	$changed = @($scan | Where-Object { $_.Changed })

	if ($changed.Count -eq 0) {
		Write-Host 'No tracked theme files changed — nothing copied to Git.'
	}
	else {
		foreach ($item in $changed) {
			if (-not (Test-Path -LiteralPath $item.ThemePath)) {
				Write-Host "  skip (missing): $($item.ThemeRelative)"
				$themeSkipped += $item
				continue
			}

			$destDir = Split-Path -Parent $item.RepoPath
			if ($WhatIf) {
				Write-Host "  would copy: $($item.ThemeRelative) -> $($item.RepoRelative)"
				$themeSaved += $item
				continue
			}

			if (-not (Test-Path -LiteralPath $destDir)) {
				New-Item -ItemType Directory -Path $destDir -Force | Out-Null
			}

			Copy-Item -LiteralPath $item.ThemePath -Destination $item.RepoPath -Force
			Write-Host "  copied: $($item.ThemeRelative) -> $($item.RepoRelative)"
			$themeSaved += $item
		}
	}

	Write-Host ''
}

$dbResult = $null
if ($runDatabase) {
	Write-Host '=== Step 2 — Database snapshot to Git ==='

	if ($WhatIf) {
		Write-Host '  would run: Export-LocalWordPressDatabase.ps1'
		Write-Host "  target:    $dbTarget"
	}
	else {
		$dbResult = & $dbExportScript
		$dbResult | Format-List
	}

	Write-Host ''
}

if ($runDropbox) {
	Write-Host '=== Step 3 — Large assets to Dropbox ==='
	Write-Host "  uploads:          Dropbox\Webs\$siteKey\uploads"
	Write-Host "  theme images:     Dropbox\Webs\$siteKey\altitude-pro\images"
	Write-Host "  full child theme: Dropbox\Webs\$siteKey\altitude-pro (via MirrorWebAssets)"

	if ($WhatIf) {
		Write-Host "  would run: Mirror-WebAssetsToDropbox.ps1 -SiteKey $siteKey"
	}
	else {
		& $dropboxMirrorScript -SiteKey $siteKey
	}

	Write-Host ''
}

Write-Host 'Summary'
Write-Host "  Theme files saved:     $($themeSaved.Count)"
Write-Host "  Theme files skipped:   $($themeSkipped.Count)"
if ($dbResult) {
	Write-Host "  Database snapshot:     $($dbResult.DumpPath) ($($dbResult.DumpSizeBytes) bytes)"
}
Write-Host "  Dropbox mirror:        $(if ($runDropbox) { if ($WhatIf) { 'planned' } else { 'completed' } } else { 'skipped' })"

if ($WhatIf) {
	Write-Host 'WhatIf complete — no files written.'
}
else {
	Write-Host 'WordPress Save complete.'
}

exit 0
