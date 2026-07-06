# Shared helpers for MirrorWebAssets — WAMP www ↔ Dropbox Webs folder pairs.

function Get-WebAssetsRepoRoot {
	return (Resolve-Path (Join-Path $PSScriptRoot '..\..')).Path
}

function Expand-WebAssetsConfigPath {
	param([string] $Value)

	if (-not $Value) {
		return ''
	}

	return [Environment]::ExpandEnvironmentVariables(
		$Value.Replace('${USERPROFILE}', $env:USERPROFILE)
	)
}

function Get-DropboxWebsRoot {
	param(
		[string] $ExplicitPath,
		[string] $ManifestValue
	)

	if ($ExplicitPath) {
		return (Expand-WebAssetsConfigPath $ExplicitPath).TrimEnd('\', '/')
	}

	if ($ManifestValue) {
		return (Expand-WebAssetsConfigPath $ManifestValue).TrimEnd('\', '/')
	}

	if ($env:DROPBOX_WEBS_ROOT -and $env:DROPBOX_WEBS_ROOT.Trim()) {
		return $env:DROPBOX_WEBS_ROOT.Trim().TrimEnd('\', '/')
	}

	return (Join-Path $env:USERPROFILE 'Dropbox\Webs')
}

function Get-WebAssetsManifestPath {
	param([string] $ExplicitPath = '')

	if ($ExplicitPath) {
		return (Resolve-Path -LiteralPath $ExplicitPath).Path
	}

	return (Join-Path $PSScriptRoot 'WebAssetsSites.json')
}

function Get-WebAssetsConfig {
	param([string] $ManifestPath)

	if (-not (Test-Path -LiteralPath $ManifestPath)) {
		throw "Manifest not found: $ManifestPath"
	}

	return (Get-Content -LiteralPath $ManifestPath -Raw | ConvertFrom-Json)
}

function Get-WebAssetsSites {
	param(
		$Config,
		[string] $SiteKey = ''
	)

	$sites = @($Config.sites)
	if ($SiteKey) {
		$sites = @($sites | Where-Object { $_.siteKey -eq $SiteKey })
		if ($sites.Count -eq 0) {
			throw "No site matched SiteKey '$SiteKey' in manifest."
		}
	}

	return $sites
}

function Test-RobocopySuccess {
	param([int] $ExitCode)

	return ($ExitCode -ge 0 -and $ExitCode -le 7)
}

function Get-FolderInventory {
	param([string] $RootPath)

	if (-not (Test-Path -LiteralPath $RootPath)) {
		return @()
	}

	$root = (Resolve-Path -LiteralPath $RootPath).Path
	$items = @()

	Get-ChildItem -LiteralPath $root -Recurse -File -Force -ErrorAction SilentlyContinue |
		ForEach-Object {
			$relative = $_.FullName.Substring($root.Length).TrimStart('\', '/')
			$items += [PSCustomObject]@{
				RelativePath = $relative.Replace('/', '\')
				Length = [int64]$_.Length
			}
		}

	return $items
}

function Test-WebAssetsVerification {
	param(
		[string] $SourcePath,
		[string] $DestPath,
		[string] $Label
	)

	$sourceItems = @(Get-FolderInventory -RootPath $SourcePath)
	$destItems = @(Get-FolderInventory -RootPath $DestPath)

	$sourceMap = @{}
	foreach ($item in $sourceItems) {
		$sourceMap[$item.RelativePath] = $item.Length
	}

	$destMap = @{}
	foreach ($item in $destItems) {
		$destMap[$item.RelativePath] = $item.Length
	}

	$missing = @()
	$sizeMismatch = @()
	$extra = @()

	foreach ($path in $sourceMap.Keys) {
		if (-not $destMap.ContainsKey($path)) {
			$missing += $path
			continue
		}
		if ($sourceMap[$path] -ne $destMap[$path]) {
			$sizeMismatch += $path
		}
	}

	foreach ($path in $destMap.Keys) {
		if (-not $sourceMap.ContainsKey($path)) {
			$extra += $path
		}
	}

	$sourceBytes = ($sourceItems | Measure-Object -Property Length -Sum).Sum
	if (-not $sourceBytes) { $sourceBytes = 0 }
	$destBytes = ($destItems | Measure-Object -Property Length -Sum).Sum
	if (-not $destBytes) { $destBytes = 0 }

	return [PSCustomObject]@{
		Label = $Label
		Ok = ($missing.Count -eq 0 -and $sizeMismatch.Count -eq 0)
		SourceFiles = $sourceItems.Count
		DestFiles = $destItems.Count
		SourceBytes = $sourceBytes
		DestBytes = $destBytes
		MissingCount = $missing.Count
		SizeMismatchCount = $sizeMismatch.Count
		ExtraCount = $extra.Count
		MissingSample = ($missing | Select-Object -First 5)
		SizeMismatchSample = ($sizeMismatch | Select-Object -First 5)
		ExtraSample = ($extra | Select-Object -First 5)
	}
}

function Invoke-WebAssetsFolderCopy {
	param(
		[string] $SourcePath,
		[string] $DestPath,
		[switch] $WhatIfOnly
	)

	if (-not (Test-Path -LiteralPath $SourcePath)) {
		throw "Source folder not found: $SourcePath"
	}

	if (-not (Test-Path -LiteralPath $DestPath)) {
		if ($WhatIfOnly) {
			Write-Host "Would create destination: $DestPath"
		}
		else {
			New-Item -ItemType Directory -Path $DestPath -Force | Out-Null
		}
	}

	if ($WhatIfOnly) {
		Write-Host "Would copy: $SourcePath -> $DestPath"
		return 0
	}

	$null = & robocopy $SourcePath $DestPath /E /FFT /R:2 /W:2 /NFL /NDL /NJH /NJS /NP
	return $LASTEXITCODE
}

function Write-WebAssetsVerificationResult {
	param($Verification)

	if (-not $Verification) {
		return
	}

	if ($Verification.Ok) {
		Write-Host "    verify: OK ($($Verification.SourceFiles) files, $([math]::Round($Verification.SourceBytes / 1MB, 2)) MB)"
		return
	}

	Write-Host '    verify: FAILED'
	Write-Host "      missing: $($Verification.MissingCount)"
	Write-Host "      size mismatch: $($Verification.SizeMismatchCount)"
	Write-Host "      extra: $($Verification.ExtraCount)"
	if ($Verification.MissingSample.Count -gt 0) {
		Write-Host "      missing sample: $($Verification.MissingSample -join ', ')"
	}
}

function Invoke-WebAssetsSync {
	param(
		[ValidateSet('ToDropbox', 'FromDropbox')]
		[string] $Direction,
		[string] $SiteKey = '',
		[string] $ManifestPath = '',
		[string] $DropboxWebsRoot = '',
		[switch] $SkipVerification,
		[switch] $WhatIf
	)

	. (Join-Path $PSScriptRoot '..\LocalWordPress\WampPaths.ps1')

	$manifest = Get-WebAssetsManifestPath -ExplicitPath $ManifestPath
	$config = Get-WebAssetsConfig -ManifestPath $manifest
	$dropboxRoot = Get-DropboxWebsRoot -ExplicitPath $DropboxWebsRoot -ManifestValue $config.dropboxWebsRoot
	$wampRoot = Get-WampWwwRoot
	$verify = $config.verifyMirror -and -not $SkipVerification
	$sites = Get-WebAssetsSites -Config $config -SiteKey $SiteKey

	$directionLabel = if ($Direction -eq 'ToDropbox') { 'WAMP -> Dropbox' } else { 'Dropbox -> WAMP' }

	Write-Host "Direction:         $directionLabel"
	Write-Host "WAMP www root:     $wampRoot"
	Write-Host "Dropbox Webs root: $dropboxRoot"
	Write-Host "Verify copy:       $verify"
	Write-Host "WhatIf:            $($WhatIf.IsPresent)"
	Write-Host ''

	$results = @()
	$failed = $false

	foreach ($site in $sites) {
		$wpRoot = Join-Path $wampRoot $site.wpSiteFolder
		$siteDropboxRoot = Join-Path $dropboxRoot $site.siteKey

		Write-Host "Site: $($site.siteKey)"
		Write-Host "  WordPress root: $wpRoot"
		Write-Host "  Dropbox root:   $siteDropboxRoot"

		if ($Direction -eq 'ToDropbox' -and -not (Test-Path -LiteralPath $wpRoot)) {
			throw "WordPress site folder not found: $wpRoot"
		}

		foreach ($folder in @($site.folders)) {
			$wampPath = Join-Path $wpRoot $folder.sourceRelative
			$dropboxPath = Join-Path $siteDropboxRoot $folder.destName
			$label = "$($site.siteKey)/$($folder.destName)"

			if ($Direction -eq 'ToDropbox') {
				$source = $wampPath
				$dest = $dropboxPath
				$verb = 'Mirror'
			}
			else {
				$source = $dropboxPath
				$dest = $wampPath
				$verb = 'Restore'
			}

			Write-Host "  $verb $label"
			Write-Host "    from: $source"
			Write-Host "    to:   $dest"

			$exitCode = Invoke-WebAssetsFolderCopy -SourcePath $source -DestPath $dest -WhatIfOnly:$WhatIf
			if (-not $WhatIf -and -not (Test-RobocopySuccess -ExitCode $exitCode)) {
				throw "Robocopy failed for $label (exit $exitCode)"
			}

			$verification = $null
			if ($verify -and -not $WhatIf) {
				$verification = Test-WebAssetsVerification -SourcePath $source -DestPath $dest -Label $label
				if (-not $verification.Ok) {
					$failed = $true
				}
			}

			$results += [PSCustomObject]@{
				Direction = $Direction
				SiteKey = $site.siteKey
				Folder = $folder.destName
				Source = $source
				Destination = $dest
				RobocopyExitCode = $exitCode
				Verified = [bool]$verification
				VerificationOk = if ($verification) { $verification.Ok } else { $null }
				SourceFiles = if ($verification) { $verification.SourceFiles } else { $null }
				DestFiles = if ($verification) { $verification.DestFiles } else { $null }
			}

			Write-WebAssetsVerificationResult -Verification $verification
		}

		Write-Host ''
	}

	Write-Host 'Summary:'
	$results | Format-Table Direction, SiteKey, Folder, Verified, VerificationOk, SourceFiles, DestFiles -AutoSize

	if ($failed) {
		throw 'Verification failed for one or more folders.'
	}

	if ($WhatIf) {
		Write-Host 'WhatIf complete — no files copied.'
	}
	else {
		$completeLabel = if ($Direction -eq 'ToDropbox') { 'Mirror complete.' } else { 'Restore complete.' }
		Write-Host $completeLabel
	}
}
