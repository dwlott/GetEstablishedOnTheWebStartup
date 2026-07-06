param(
	[string] $WpConfigPath = 'G:\wamp64\www\getestablishedontheweb\wp-config.php',
	[string] $OutputPath,
	[string] $MysqldumpPath = ''
)

$ErrorActionPreference = 'Stop'

function Get-RepoRoot {
	return (Resolve-Path (Join-Path $PSScriptRoot '..\..')).Path
}

function Get-WpConfigValue {
	param(
		[string] $Text,
		[string] $Name
	)

	$pattern = 'define\s*\(\s*[''"]' + [regex]::Escape($Name) + '[''"]\s*,\s*[''"](?<value>[^''"]*)[''"]\s*\)'
	$match = [regex]::Match($Text, $pattern)
	if (-not $match.Success) {
		throw "Could not find $Name in $WpConfigPath"
	}
	return $match.Groups['value'].Value
}

function Find-Mysqldump {
	param([string] $ExplicitPath)

	if ($ExplicitPath) {
		if (Test-Path -LiteralPath $ExplicitPath) {
			return (Resolve-Path -LiteralPath $ExplicitPath).Path
		}
		throw "mysqldump was not found at: $ExplicitPath"
	}

	$candidates = @(
		'G:\wamp64\bin\mysql\*\bin\mysqldump.exe',
		'C:\wamp64\bin\mysql\*\bin\mysqldump.exe',
		'C:\wamp\bin\mysql\*\bin\mysqldump.exe'
	)

	foreach ($candidate in $candidates) {
		$match = Get-ChildItem -Path $candidate -ErrorAction SilentlyContinue |
			Sort-Object FullName -Descending |
			Select-Object -First 1
		if ($match) {
			return $match.FullName
		}
	}

	throw 'mysqldump.exe was not found under the expected WAMP MySQL folders.'
}

function Compress-SqlFile {
	param(
		[string] $SourcePath,
		[string] $DestinationPath
	)

	if (Test-Path -LiteralPath $DestinationPath) {
		Remove-Item -LiteralPath $DestinationPath -Force
	}

	$source = [System.IO.File]::OpenRead($SourcePath)
	try {
		$destination = [System.IO.File]::Create($DestinationPath)
		try {
			$gzip = [System.IO.Compression.GzipStream]::new($destination, [System.IO.Compression.CompressionLevel]::Optimal)
			try {
				$source.CopyTo($gzip)
			}
			finally {
				$gzip.Dispose()
			}
		}
		finally {
			$destination.Dispose()
		}
	}
	finally {
		$source.Dispose()
	}
}

$repoRoot = Get-RepoRoot
if (-not $OutputPath) {
	$OutputPath = Join-Path $repoRoot 'Content\Website\Database\getestablishedontheweb-local.sql.gz'
}

if (-not (Test-Path -LiteralPath $WpConfigPath)) {
	throw "wp-config.php was not found: $WpConfigPath"
}

$wpConfig = Get-Content -LiteralPath $WpConfigPath -Raw
$dbName = Get-WpConfigValue -Text $wpConfig -Name 'DB_NAME'
$dbUser = Get-WpConfigValue -Text $wpConfig -Name 'DB_USER'
$dbPassword = Get-WpConfigValue -Text $wpConfig -Name 'DB_PASSWORD'
$dbHost = Get-WpConfigValue -Text $wpConfig -Name 'DB_HOST'
$mysqldump = Find-Mysqldump -ExplicitPath $MysqldumpPath

$outputDirectory = Split-Path -Parent $OutputPath
if (-not (Test-Path -LiteralPath $outputDirectory)) {
	New-Item -ItemType Directory -Path $outputDirectory | Out-Null
}

$tempSql = Join-Path $outputDirectory ((Split-Path -Leaf $OutputPath) + '.tmp.sql')
if (Test-Path -LiteralPath $tempSql) {
	Remove-Item -LiteralPath $tempSql -Force
}

$arguments = @(
	'--single-transaction',
	'--quick',
	'--default-character-set=utf8mb4',
	'--skip-comments',
	'--host', $dbHost,
	'--user', $dbUser,
	$dbName
)

$process = [System.Diagnostics.Process]::new()
$process.StartInfo.FileName = $mysqldump
foreach ($argument in $arguments) {
	[void] $process.StartInfo.ArgumentList.Add($argument)
}
$process.StartInfo.RedirectStandardOutput = $true
$process.StartInfo.RedirectStandardError = $true
$process.StartInfo.UseShellExecute = $false
$process.StartInfo.CreateNoWindow = $true
if ($dbPassword -ne '') {
	$process.StartInfo.EnvironmentVariables['MYSQL_PWD'] = $dbPassword
}

[void] $process.Start()
$output = [System.IO.File]::Create($tempSql)
try {
	$process.StandardOutput.BaseStream.CopyTo($output)
}
finally {
	$output.Dispose()
}
$stderr = $process.StandardError.ReadToEnd()
$process.WaitForExit()

if ($process.ExitCode -ne 0) {
	if (Test-Path -LiteralPath $tempSql) {
		Remove-Item -LiteralPath $tempSql -Force
	}
	throw "mysqldump failed with exit code $($process.ExitCode): $stderr"
}

if ((Get-Item -LiteralPath $tempSql).Length -le 0) {
	Remove-Item -LiteralPath $tempSql -Force
	throw 'mysqldump produced an empty SQL file.'
}

Compress-SqlFile -SourcePath $tempSql -DestinationPath $OutputPath
Remove-Item -LiteralPath $tempSql -Force

$size = (Get-Item -LiteralPath $OutputPath).Length

[pscustomobject]@{
	Database = $dbName
	Host = $dbHost
	User = $dbUser
	PasswordStatus = if ($dbPassword -eq '') { 'blank' } else { 'set' }
	DumpPath = (Resolve-Path -LiteralPath $OutputPath).Path
	DumpSizeBytes = $size
	MysqldumpPath = $mysqldump
	TablesExcluded = 'none'
}
