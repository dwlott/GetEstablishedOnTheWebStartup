# Shared WAMP path resolution for MoverCalcs local WordPress scripts.
# Requires user env var WAMP_WWW_ROOT (e.g. C:\wamp\www) or a discoverable install.

function Get-WampWwwRoot {
	if ($env:WAMP_WWW_ROOT -and $env:WAMP_WWW_ROOT.Trim()) {
		return $env:WAMP_WWW_ROOT.Trim().TrimEnd('\', '/')
	}

	$candidates = @(
		'C:\wamp\www',
		'G:\wamp64\www',
		'C:\wamp64\www',
		'D:\wamp64\www'
	)

	foreach ($candidate in $candidates) {
		if (Test-Path -LiteralPath (Join-Path $candidate 'movercalcs\wp-config.php')) {
			return $candidate
		}
	}

	throw @(
		'WAMP_WWW_ROOT is not set and no MoverCalcs WordPress install was found.'
		'Set the user environment variable WAMP_WWW_ROOT to your WAMP www folder'
		'(e.g. C:\wamp\www or G:\wamp64\www). See Workspace/OwnerPreferences.md.'
	) -join ' '
}

function Get-MoverCalcsWpRoot {
	return Join-Path (Get-WampWwwRoot) 'movercalcs'
}

function Get-MoverCalcsWpConfigPath {
	param(
		[string] $ExplicitPath = ''
	)

	if ($ExplicitPath -and (Test-Path -LiteralPath $ExplicitPath)) {
		return (Resolve-Path -LiteralPath $ExplicitPath).Path
	}

	$config = Join-Path (Get-MoverCalcsWpRoot) 'wp-config.php'
	if (-not (Test-Path -LiteralPath $config)) {
		throw "wp-config.php not found: $config"
	}
	return (Resolve-Path -LiteralPath $config).Path
}

function Get-WampInstallRoot {
	return Split-Path (Get-WampWwwRoot) -Parent
}

function Find-WampMysql {
	param(
		[string] $ExplicitPath = ''
	)

	if ($ExplicitPath) {
		if (Test-Path -LiteralPath $ExplicitPath) {
			return (Resolve-Path -LiteralPath $ExplicitPath).Path
		}
		throw "mysql.exe was not found at: $ExplicitPath"
	}

	$candidates = @(
		(Join-Path (Get-WampInstallRoot) 'bin\mysql\*\bin\mysql.exe'),
		'C:\wamp\bin\mysql\*\bin\mysql.exe',
		'G:\wamp64\bin\mysql\*\bin\mysql.exe',
		'C:\wamp64\bin\mysql\*\bin\mysql.exe'
	)

	foreach ($candidate in $candidates) {
		$match = Get-ChildItem -Path $candidate -ErrorAction SilentlyContinue |
			Sort-Object FullName -Descending |
			Select-Object -First 1
		if ($match) {
			return $match.FullName
		}
	}

	throw 'mysql.exe was not found under the WAMP install or common WAMP folders.'
}

function Find-WampMysqldump {
	param(
		[string] $ExplicitPath = ''
	)

	if ($ExplicitPath) {
		if (Test-Path -LiteralPath $ExplicitPath) {
			return (Resolve-Path -LiteralPath $ExplicitPath).Path
		}
		throw "mysqldump.exe was not found at: $ExplicitPath"
	}

	$mysql = Find-WampMysql
	$mysqldump = Join-Path (Split-Path $mysql -Parent) 'mysqldump.exe'
	if (Test-Path -LiteralPath $mysqldump) {
		return (Resolve-Path -LiteralPath $mysqldump).Path
	}

	throw "mysqldump.exe was not found next to mysql.exe: $mysql"
}
