param(
	[string] $SiteKey = '',
	[string] $BluehostDatabaseName = 'youraccount_yoursite',
	[string] $ExpectedTablePrefix = 'wp_',
	[string] $PublicUrl = 'https://your-site.example',
	[string] $LocalUrl = 'http://localhost/yoursite',
	[string] $OutputPath = '',
	[string] $WorkDirectory = '',
	[switch] $Force,
	[switch] $KeepIntermediate,
	[string] $MysqldumpPath = ''
)

$ErrorActionPreference = 'Stop'
. (Join-Path $PSScriptRoot '..\LocalWordPress\WampPaths.ps1')

function Get-RepoRoot {
	return (Resolve-Path (Join-Path $PSScriptRoot '..\..')).Path
}

function Get-WpConfigDefine {
	param(
		[string] $Text,
		[string] $Name
	)

	$pattern = 'define\s*\(\s*[''"]' + [regex]::Escape($Name) + '[''"]\s*,\s*[''"](?<value>[^''"]*)[''"]\s*\)'
	$match = [regex]::Match($Text, $pattern)
	if (-not $match.Success) {
		throw "Could not find define('$Name') in wp-config.php"
	}
	return $match.Groups['value'].Value
}

function Get-WpTablePrefix {
	param([string] $Text)

	if ($Text -match '\$table_prefix\s*=\s*[''"](?<value>[^''"]+)[''"]\s*;') {
		return $Matches['value']
	}
	throw 'Could not find $table_prefix in wp-config.php'
}

function Expand-GzipFile {
	param(
		[string] $SourcePath,
		[string] $DestinationPath
	)

	$inputStream = [System.IO.File]::OpenRead($SourcePath)
	try {
		$gzip = [System.IO.Compression.GzipStream]::new($inputStream, [System.IO.Compression.CompressionMode]::Decompress)
		try {
			$outputStream = [System.IO.File]::Create($DestinationPath)
			try {
				$gzip.CopyTo($outputStream)
			}
			finally {
				$outputStream.Dispose()
			}
		}
		finally {
			$gzip.Dispose()
		}
	}
	finally {
		$inputStream.Dispose()
	}
}

function Invoke-PythonAdapter {
	param(
		[string] $AdapterPath,
		[string[]] $AdapterArgs
	)

	$py = Get-Command py -ErrorAction SilentlyContinue
	if ($py) {
		$args = @('-3', $AdapterPath) + $AdapterArgs
		$output = & $py.Source @args 2>&1
		$code = $LASTEXITCODE
		$output | ForEach-Object { Write-Host $_ }
		return [int]$code
	}

	$python = Get-Command python -ErrorAction SilentlyContinue
	if ($python) {
		$args = @($AdapterPath) + $AdapterArgs
		$output = & $python.Source @args 2>&1
		$code = $LASTEXITCODE
		$output | ForEach-Object { Write-Host $_ }
		return [int]$code
	}

	throw 'Python was not found. Install Python or make py/python available on PATH.'
}

$repoRoot = Get-RepoRoot
$wpConfigPath = Get-SiteWpConfigPath -SiteKey $SiteKey
$wpConfig = Get-Content -LiteralPath $wpConfigPath -Raw
$localDbName = Get-WpConfigDefine -Text $wpConfig -Name 'DB_NAME'
$localDbUser = Get-WpConfigDefine -Text $wpConfig -Name 'DB_USER'
$localDbHost = Get-WpConfigDefine -Text $wpConfig -Name 'DB_HOST'
$localPrefix = Get-WpTablePrefix -Text $wpConfig

if (-not $WorkDirectory) {
	$WorkDirectory = Join-Path ([System.IO.Path]::GetTempPath()) 'WordPressBluehostPrep'
}
if (-not $OutputPath) {
	$OutputPath = Join-Path (Join-Path $env:USERPROFILE 'Downloads') 'wordpress-bluehost-ready.sql'
}

$WorkDirectory = $ExecutionContext.SessionState.Path.GetUnresolvedProviderPathFromPSPath($WorkDirectory)
$outputDirectory = Split-Path -Parent $OutputPath
if (-not (Test-Path -LiteralPath $WorkDirectory)) {
	New-Item -ItemType Directory -Path $WorkDirectory -Force | Out-Null
}
if (-not (Test-Path -LiteralPath $outputDirectory)) {
	New-Item -ItemType Directory -Path $outputDirectory -Force | Out-Null
}

$timestamp = Get-Date -Format 'yyyyMMdd-HHmmss'
$exportGzip = Join-Path $WorkDirectory "wordpress-local-export-$timestamp.sql.gz"
$rawSql = Join-Path $WorkDirectory "wordpress-local-export-$timestamp.sql"
$reportPath = "$OutputPath.report.json"
$adapterPath = Join-Path $PSScriptRoot 'prepare_bluehost_sql.py'

Write-Host 'WordPress Bluehost database prep'
Write-Host "  Local wp-config:       $wpConfigPath"
Write-Host "  Local database:        $localDbName @ $localDbHost"
Write-Host "  Local database user:   $localDbUser"
Write-Host "  Local table prefix:    $localPrefix"
Write-Host ''
Write-Host "  Bluehost database:     $BluehostDatabaseName"
Write-Host "  Bluehost table prefix: $ExpectedTablePrefix"
Write-Host "  Replace URL:           $LocalUrl -> $PublicUrl"
Write-Host "  Output SQL:            $OutputPath"
Write-Host "  Report:                $reportPath"
Write-Host ''

if (-not $Force) {
	$answer = Read-Host 'Type YES to export and prepare this Bluehost import SQL'
	if ($answer -ne 'YES') {
		throw 'Bluehost prep cancelled. Re-run after confirming database name and table prefix.'
	}
}

$exportScript = Join-Path $repoRoot 'Automation\DatabaseBackups\Export-LocalWordPressDatabase.ps1'
$exportResult = & $exportScript -OutputPath $exportGzip -MysqldumpPath $MysqldumpPath
$exportResult | Format-List

Expand-GzipFile -SourcePath $exportGzip -DestinationPath $rawSql

$adapterArgs = @(
	'--input', $rawSql,
	'--output', $OutputPath,
	'--local-url', $LocalUrl.TrimEnd('/'),
	'--public-url', $PublicUrl.TrimEnd('/'),
	'--target-database', $BluehostDatabaseName,
	'--expected-prefix', $ExpectedTablePrefix,
	'--report', $reportPath
)

$exitCode = Invoke-PythonAdapter -AdapterPath $adapterPath -AdapterArgs $adapterArgs
if ($exitCode -ne 0) {
	throw "Bluehost SQL adapter failed with exit code $exitCode"
}

if (-not $KeepIntermediate) {
	Remove-Item -LiteralPath $exportGzip -Force -ErrorAction SilentlyContinue
	Remove-Item -LiteralPath $rawSql -Force -ErrorAction SilentlyContinue
}

$outputItem = Get-Item -LiteralPath $OutputPath
Write-Host ''
Write-Host 'Bluehost-ready database export complete.'
Write-Host "  Output: $($outputItem.FullName)"
Write-Host "  Bytes:  $($outputItem.Length)"
Write-Host "  Upload this SQL into phpMyAdmin database '$BluehostDatabaseName'."
