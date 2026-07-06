param(
	[string] $SiteKey = '',
	[string] $ManifestPath = '',
	[string] $DropboxWebsRoot = '',
	[switch] $SkipVerification,
	[switch] $WhatIf
)

$ErrorActionPreference = 'Stop'
. (Join-Path $PSScriptRoot 'WebAssetsMirrorLib.ps1')

Invoke-WebAssetsSync -Direction ToDropbox `
	-SiteKey $SiteKey `
	-ManifestPath $ManifestPath `
	-DropboxWebsRoot $DropboxWebsRoot `
	-SkipVerification:$SkipVerification `
	-WhatIf:$WhatIf

exit 0
