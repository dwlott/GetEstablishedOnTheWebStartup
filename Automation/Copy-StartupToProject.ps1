# Copy GetEstablishedOnTheWebStartup into a new project folder WITHOUT .git.
# Prefer this over Explorer copy — avoids inheriting the starter remote.
#
# Example:
#   .\Automation\Copy-StartupToProject.ps1 -DestinationName NaturalGasTurbineGenerator
#   .\Automation\Copy-StartupToProject.ps1 -Source C:\Repositories\GetEstablishedOnTheWebStartup -Destination C:\Repositories\MySite

param(
	[string] $Source = '',
	[string] $Destination = '',
	[string] $DestinationName = '',
	[string] $RepositoriesRoot = 'C:\Repositories',
	[switch] $WhatIf
)

$ErrorActionPreference = 'Stop'

if (-not $Source) {
	$Source = Split-Path -Parent $PSScriptRoot
	if ((Split-Path -Leaf $Source) -ne 'GetEstablishedOnTheWebStartup') {
		$Source = Join-Path $RepositoriesRoot 'GetEstablishedOnTheWebStartup'
	}
}

if (-not $Destination) {
	if (-not $DestinationName) {
		throw 'Pass -DestinationName MyProject or -Destination C:\Repositories\MyProject'
	}
	$Destination = Join-Path $RepositoriesRoot $DestinationName
}

if (-not (Test-Path -LiteralPath $Source)) {
	throw "Source not found: $Source"
}

$leaf = Split-Path -Leaf $Destination
if ($leaf -eq 'GetEstablishedOnTheWebStartup' -or $leaf -eq 'GetEstablishedOnTheWeb') {
	throw "Destination folder name must be the new project name, not '$leaf'."
}

if (Test-Path -LiteralPath $Destination) {
	throw "Destination already exists: $Destination"
}

Write-Host 'Adopt starter copy (no .git)'
Write-Host "  Source:      $Source"
Write-Host "  Destination: $Destination"
Write-Host ''

if ($WhatIf) {
	Write-Host 'WhatIf: would robocopy excluding .git .cursor .claude'
	exit 0
}

New-Item -ItemType Directory -Path $Destination -Force | Out-Null

$xd = @('.git', '.cursor', '.claude')
$robolog = & robocopy $Source $Destination /E /XD $xd /NFL /NDL /NJH /NJS /nc /ns /np
$rc = $LASTEXITCODE
# robocopy: 0-7 success-ish; >=8 failure
if ($rc -ge 8) {
	throw "robocopy failed with exit code $rc"
}

if (Test-Path -LiteralPath (Join-Path $Destination '.git')) {
	throw 'Copy still contains .git — aborting. Delete destination and retry.'
}

Write-Host 'Copy complete (no .git).'
Write-Host ''
Write-Host 'Next:'
Write-Host "  1. Open $Destination in Cursor"
Write-Host '  2. Say: Begin Quick Startup from AGENTS.md'
Write-Host '  3. When ready for GitHub: GitHubWorkflow SetupPrompt (git init + new repo)'
Write-Host ''
Write-Host "robocopy exit: $rc"
