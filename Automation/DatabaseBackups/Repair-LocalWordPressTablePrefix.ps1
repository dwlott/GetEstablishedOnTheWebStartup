param(
	[string] $WpConfigPath = '',
	[string] $ExpectedPrefix = 'Lr4_',
	[switch] $Apply,
	[string] $MysqlPath = ''
)

$ErrorActionPreference = 'Stop'
. (Join-Path $PSScriptRoot '..\LocalWordPress\WampPaths.ps1')

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

function Set-WpTablePrefix {
	param(
		[string] $Text,
		[string] $NewPrefix
	)

	if ($Text -notmatch '\$table_prefix\s*=\s*[''"][^''"]+[''"]\s*;') {
		throw 'Could not locate $table_prefix assignment to update.'
	}

	return [regex]::Replace(
		$Text,
		'\$table_prefix\s*=\s*[''"][^''"]+[''"]\s*;',
		"`$table_prefix = '$NewPrefix';",
		1
	)
}

function Get-DatabaseTablePrefixes {
	param(
		[string] $MysqlExe,
		[string] $DbName,
		[string] $DbUser,
		[string] $DbPassword,
		[string] $DbHost
	)

	$query = @"
SELECT table_name
FROM information_schema.tables
WHERE table_schema = '$DbName'
  AND table_name LIKE '%options'
ORDER BY table_name;
"@

	if ($DbPassword -ne '') {
		$env:MYSQL_PWD = $DbPassword
	}

	try {
		$stdout = & $MysqlExe @(
			'--host', $DbHost,
			'--user', $DbUser,
			'--batch',
			'--skip-column-names',
			'-e', $query,
			$DbName
		) 2>&1
		if ($LASTEXITCODE -ne 0) {
			throw "mysql query failed (exit $LASTEXITCODE): $stdout"
		}
	}
	finally {
		Remove-Item Env:MYSQL_PWD -ErrorAction SilentlyContinue
	}

	$prefixes = @()
	foreach ($line in ($stdout -split "`r?`n")) {
		$table = $line.Trim()
		if ($table -match '^(?<prefix>.+)_options$') {
			$prefixes += $Matches['prefix'] + '_'
		}
	}
	return $prefixes | Select-Object -Unique
}

$wpConfigPath = Get-MoverCalcsWpConfigPath -ExplicitPath $WpConfigPath
$wpConfig = Get-Content -LiteralPath $wpConfigPath -Raw
$dbName = Get-WpConfigDefine -Text $wpConfig -Name 'DB_NAME'
$dbUser = Get-WpConfigDefine -Text $wpConfig -Name 'DB_USER'
$dbPassword = Get-WpConfigDefine -Text $wpConfig -Name 'DB_PASSWORD'
$dbHost = Get-WpConfigDefine -Text $wpConfig -Name 'DB_HOST'
$currentPrefix = Get-WpTablePrefix -Text $wpConfig
$mysqlExe = Find-WampMysql -ExplicitPath $MysqlPath

Write-Host "WAMP_WWW_ROOT: $env:WAMP_WWW_ROOT"
Write-Host "wamp www:      $(Get-WampWwwRoot)"
Write-Host "wp-config:     $wpConfigPath"
Write-Host "database:      $dbName @ $dbHost"
Write-Host "prefix in wp-config.php: '$currentPrefix'"
Write-Host "expected prefix:         '$ExpectedPrefix'"

$dbPrefixes = Get-DatabaseTablePrefixes -MysqlExe $mysqlExe -DbName $dbName -DbUser $dbUser -DbPassword $dbPassword -DbHost $dbHost
if ($dbPrefixes.Count -eq 0) {
	throw "No *_options table found in database '$dbName'. Import Content/Website/Database/movercalcs-local.sql.gz first."
}

Write-Host ("tables found with prefixes: {0}" -f (($dbPrefixes | ForEach-Object { "'$_'" }) -join ', '))

$detectedPrefix = $null
foreach ($candidate in @($ExpectedPrefix, 'Lr4_', 'lr4_', 'wp_')) {
	foreach ($dbPrefix in $dbPrefixes) {
		if ($dbPrefix -eq $candidate -or $dbPrefix.ToLower() -eq $candidate.ToLower()) {
			$detectedPrefix = $ExpectedPrefix
			break
		}
	}
	if ($detectedPrefix) { break }
}

if (-not $detectedPrefix) {
	$detectedPrefix = $dbPrefixes[0]
	Write-Host "Warning: could not match expected prefix; using first detected '$detectedPrefix'"
}

$needsFix = ($currentPrefix -ne $detectedPrefix)
if (-not $needsFix) {
	Write-Host 'Table prefix already matches. Reload http://localhost/movercalcs/ — if install screen persists, check DB_NAME or restore the snapshot.'
	exit 0
}

Write-Host "Repair needed: '$currentPrefix' -> '$detectedPrefix'"

if (-not $Apply) {
	Write-Host 'Dry run only. Re-run with -Apply to update wp-config.php (a .bak copy is created first).'
	exit 2
}

$backupPath = "$wpConfigPath.bak-$(Get-Date -Format 'yyyyMMdd-HHmmss')"
Copy-Item -LiteralPath $wpConfigPath -Destination $backupPath -Force
$updated = Set-WpTablePrefix -Text $wpConfig -NewPrefix $detectedPrefix
Set-Content -LiteralPath $wpConfigPath -Value $updated -Encoding UTF8

Write-Host "Updated wp-config.php (backup: $backupPath)"
Write-Host 'Reload http://localhost/movercalcs/ — the WordPress install screen should be gone.'
