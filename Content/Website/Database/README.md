# Local WordPress Database Snapshot

This folder holds the current local WAMP WordPress database snapshot for the
GetEstablishedOnTheWeb site. The snapshot is meant for safekeeping in Git alongside the
site content source.

Current snapshot:

- `getestablishedontheweb-local.sql.gz`

Local WordPress files are backed up separately. This folder is only for the
database export.

## Refresh

From the repository root:

```powershell
.\Automation\DatabaseBackups\Export-LocalWordPressDatabase.ps1
```

The script reads local database settings from:

```text
G:\wamp64\www\getestablishedontheweb\wp-config.php
```

It uses WAMP `mysqldump`, writes a temporary SQL file, compresses it to
`getestablishedontheweb-local.sql.gz`, and removes the temporary SQL file. It prints the
database name, host, user, password status, dump path, dump size, and table
exclusion status. It does not print the database password.

No tables are excluded. The goal is a complete local restore snapshot with
WordPress content, options, menus, widgets, and local user records intact.

## Restore Locally

Use this only for a local WAMP restore. Confirm the target database name before
importing.

1. Create the database if it does not exist:

```powershell
G:\wamp64\bin\mysql\mysql9.1.0\bin\mysql.exe -u root -e "CREATE DATABASE IF NOT EXISTS getestablishedontheweb DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

2. Expand the snapshot to a temporary SQL file:

```powershell
$source = "Content\Website\Database\getestablishedontheweb-local.sql.gz"
$target = "$env:TEMP\getestablishedontheweb-local.sql"
$inputStream = [System.IO.File]::OpenRead((Resolve-Path $source))
$gzip = [System.IO.Compression.GzipStream]::new($inputStream, [System.IO.Compression.CompressionMode]::Decompress)
$outputStream = [System.IO.File]::Create($target)
$gzip.CopyTo($outputStream)
$outputStream.Dispose()
$gzip.Dispose()
$inputStream.Dispose()
```

3. Import the SQL into the local database:

```powershell
G:\wamp64\bin\mysql\mysql9.1.0\bin\mysql.exe -u root getestablishedontheweb < $env:TEMP\getestablishedontheweb-local.sql
```

4. Verify the local site loads:

```text
http://localhost/getestablishedontheweb/
```

## Safety Notes

- Do not commit `wp-config.php`.
- Do not use this workflow for production credentials or production databases.
- The snapshot may contain local WordPress user records and site settings; keep
  repository visibility appropriate for that content.
