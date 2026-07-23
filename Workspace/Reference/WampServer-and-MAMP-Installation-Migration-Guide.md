<!--
IndexTitle: WampServer and MAMP Installation Migration Guide
IndexDescription: Practical WampServer (Windows) and MAMP (macOS) install, migration, backup, restore, and troubleshooting.
IndexType: Reference
IndexStatus: Active
LastEdited: 2026-07-23
CapabilityRoute: Capabilities/WordPressWebsite/WampServerAndMampSetup.md
Source: GetEstablishedOnTheWeb/Workspace/Reference (processed into Startup)
-->

# WampServer on Windows and MAMP on macOS

A practical installation, migration, backup, restore, and troubleshooting guide.

**Capability route:** [WampServerAndMampSetup.md](../../Capabilities/WordPressWebsite/WampServerAndMampSetup.md)

> **Scope**
>
> This guide focuses on:
>
> - **WampServer** for Windows
> - **MAMP** for macOS
>
> It intentionally does not cover XAMPP, Docker, LocalWP, DDEV, or other local-development stacks.

---

## 1. Which one should you use?

Use **WampServer on Windows** and **MAMP on macOS**.

Both provide a local web-development environment containing the core pieces needed for PHP and database-backed websites:

- a web server
- PHP
- MySQL or a compatible database server
- phpMyAdmin or similar database tools
- a local document root for websites

For a Windows workstation used for PHP, WordPress, MySQL administration, and local website testing, WampServer is a strong fit because it exposes the individual services and configuration files without requiring a container workflow.

For a Mac, MAMP is the closest practical equivalent. MAMP provides Apache or Nginx, PHP, and MySQL in a packaged local environment.

---

# Part I — WampServer on Windows

## 2. What WampServer is

WampServer is a Windows local-development platform. The name traditionally refers to:

- **W**indows
- **A**pache
- **M**ySQL or MariaDB
- **P**HP

It is intended for local development and testing. A normal WampServer installation is not automatically suitable as a public production server.

Typical uses include:

- local WordPress development
- testing PHP applications
- database administration
- maintaining legacy PHP sites
- evaluating upgrades to PHP, Apache, MySQL, or MariaDB
- running internal tools on `localhost`
- restoring a website before publishing it elsewhere

---

## 3. The WampServer download trick

Downloading WampServer is less obvious than it should be.

A web search may lead to pages with:

- large advertisement-style download buttons
- third-party download portals
- wrapper installers
- outdated versions
- pages that redirect through several screens
- files that are not the current full WampServer installer

### Use the WampServer files and add-ons site

Use:

<https://wampserver.aviatechno.net/>

This is the maintained WampServer files, add-ons, prerequisite, and update site.

### The important trick

Do not simply click the first large button that looks like a download button.

Instead:

1. Open the Aviatechno WampServer page.
2. Read the prerequisites shown on the page.
3. Locate the current **full WampServer installer**, not only an update or add-on.
4. Confirm that the installer is for the correct architecture, normally 64-bit on a current Windows 11 computer.
5. Download the current prerequisite checker from the same site.
6. Run the prerequisite checker before installing WampServer.
7. Download a fresh copy of the checker when reinstalling; the site specifically warns against relying on an old saved copy.

The same page also hosts component updates and add-ons. An Apache, PHP, MySQL, or MariaDB add-on is not a substitute for the initial full WampServer installation.

### Why not preserve one permanent direct `.exe` link?

Installer filenames and component versions change. A direct link that works today may later point to an obsolete release or stop working.

The durable instruction is:

> Begin at the Aviatechno WampServer files page, use the current full installer, and use the current prerequisite checker offered there.

### Avoid

- software aggregation sites
- “download manager” wrappers
- repackaged installers
- old installers copied from another PC
- random links in forum posts
- installing an update package before the base WampServer package

---

## 4. Before installation

### 4.1 Back up the old computer first

Before replacing, upgrading, or removing an existing WAMP installation, preserve:

- the entire website document root
- all databases
- custom Apache configuration
- virtual-host configuration
- custom PHP configuration
- SSL certificates used for local development
- scheduled backup scripts
- custom aliases
- application-specific configuration files
- notes about PHP and database versions

Do not assume that copying the website files alone is enough. Most WordPress and PHP applications also depend on one or more databases.

### 4.2 Record versions

On the old system, record:

- WampServer version
- Apache version
- PHP version
- MySQL version
- MariaDB version, when used
- phpMyAdmin version
- enabled PHP extensions
- database character sets and collations
- ports used by Apache and the database service

This matters when a site depends on an older PHP feature, a removed extension, or behavior that changed between database versions.

### 4.3 Check ports

Common ports are:

| Service | Common port |
|---|---:|
| HTTP | 80 |
| HTTPS | 443 |
| MySQL | 3306 |

Other software may already be using those ports. Common conflicts include:

- IIS
- another Apache installation
- another MySQL service
- VPN or security software
- web-deployment tools
- vendor utilities that install a local web service

Useful PowerShell checks:

```powershell
Get-NetTCPConnection -State Listen |
    Where-Object LocalPort -in 80,443,3306 |
    Sort-Object LocalPort |
    Format-Table LocalAddress,LocalPort,OwningProcess
```

Then identify a process:

```powershell
Get-Process -Id <OwningProcessId>
```

Do not terminate an unfamiliar service until you understand what installed it and whether it is required.

---

## 5. Visual C++ prerequisites

WampServer relies on Microsoft Visual C++ runtime packages used by Apache, PHP, MySQL, MariaDB, and their extensions.

Missing runtime packages can cause:

- installation refusal
- Apache failing to start
- PHP modules failing to load
- missing DLL errors
- a WampServer tray icon that never reaches the fully running state
- an application that starts and immediately stops

### Recommended method

Use the current prerequisite tools supplied on:

<https://wampserver.aviatechno.net/>

The site provides:

- a checker for required Visual C++ packages
- a current bundled runtime installer
- prerequisite notices for current WampServer components

Run the prerequisite installer as Administrator when directed, restart Windows when appropriate, and then run the checker again.

### Do not guess from an old package list

The exact runtime requirements can change as newer builds of Apache, PHP, and database engines are added. An old checklist can be incomplete even though it was correct when written.

Use the current checker as the deciding authority.

---

## 6. Clean WampServer installation

### Recommended location

Use the default path unless there is a strong reason not to:

```text
C:\wamp64
```

Advantages:

- most instructions assume it
- add-ons expect the normal folder layout
- migration notes are easier to follow
- fewer path and permission surprises
- no dependency on a user-profile folder

Avoid installing under:

```text
C:\Program Files
```

unless the current WampServer installer specifically directs otherwise. Local server software often needs to modify configuration and content beneath its own installation tree.

### Installation sequence

1. Install and verify the required Visual C++ runtimes.
2. Close applications that may reserve ports 80, 443, or 3306.
3. Run the current full WampServer installer.
4. Keep the default installation path.
5. Select the preferred browser and text editor when prompted.
6. Finish the installation.
7. Start WampServer.
8. Wait for the tray icon to indicate that services are running.
9. Open `http://localhost/`.
10. Open phpMyAdmin from the WampServer menu or local home page.
11. Confirm Apache and the selected database service are running.

### First validation

Create a small PHP test file in the document root:

```php
<?php
declare(strict_types=1);

echo 'PHP is running.<br>';
echo 'PHP version: ' . PHP_VERSION;
```

Save it as:

```text
C:\wamp64\www\php-test.php
```

Open:

```text
http://localhost/php-test.php
```

Delete the test file after validation.

---

## 7. Understanding the WampServer tray icon

The WampServer tray menu is the control center for:

- starting and stopping services
- restarting all services
- selecting PHP versions
- selecting Apache versions
- selecting MySQL or MariaDB versions
- opening configuration files
- launching phpMyAdmin
- opening logs
- testing ports
- managing virtual hosts
- enabling or disabling PHP extensions

When WampServer is not fully running, inspect the service state and logs instead of repeatedly reinstalling.

---

## 8. Website document root

The default local document root is commonly:

```text
C:\wamp64\www
```

A simple site can be placed at:

```text
C:\wamp64\www\MySite
```

and opened at:

```text
http://localhost/MySite/
```

For multiple maintained sites, virtual hosts are usually cleaner than placing everything directly beneath `localhost`.

---

## 9. Virtual hosts

Virtual hosts provide names such as:

```text
http://movercalcs.local/
http://testsite.local/
```

instead of:

```text
http://localhost/movercalcs/
```

Benefits include:

- cleaner paths
- fewer absolute-path problems
- easier testing of multiple sites
- behavior closer to a hosted website
- separate document roots

Use the WampServer virtual-host tools when available instead of editing several files manually.

After creating a virtual host:

1. restart DNS resolution or Windows when necessary
2. restart WampServer services
3. test the hostname
4. verify the document root
5. verify rewrite rules
6. confirm that no public network exposure was introduced

---

## 10. Database backup strategy

A reliable backup should include both:

1. database exports
2. website and application files

### Individual database backup

Example batch file:

```bat
@echo off
setlocal

set "MYSQL_BIN=C:\wamp64\bin\mysql\mysql8.0.XX\bin"
set "BACKUP_DIR=C:\WampBackups"
set "DATABASE=example_database"
set "MYSQL_USER=root"

if not exist "%BACKUP_DIR%" mkdir "%BACKUP_DIR%"

for /f "tokens=1-4 delims=/ " %%a in ("%date%") do (
    set "DATESTAMP=%%d-%%b-%%c"
)

"%MYSQL_BIN%\mysqldump.exe" ^
  --user=%MYSQL_USER% ^
  --databases "%DATABASE%" ^
  --routines ^
  --events ^
  --triggers ^
  --single-transaction ^
  --default-character-set=utf8mb4 ^
  > "%BACKUP_DIR%\%DATABASE%_%DATESTAMP%.sql"

if errorlevel 1 (
    echo Backup failed.
    exit /b 1
)

echo Backup completed.
endlocal
```

Replace `mysql8.0.XX` with the installed MySQL folder.

### Full logical backup

```bat
@echo off
setlocal

set "MYSQL_BIN=C:\wamp64\bin\mysql\mysql8.0.XX\bin"
set "BACKUP_DIR=C:\WampBackups"
set "MYSQL_USER=root"

if not exist "%BACKUP_DIR%" mkdir "%BACKUP_DIR%"

for /f %%i in ('powershell -NoProfile -Command "Get-Date -Format yyyy-MM-dd_HHmmss"') do set "STAMP=%%i"

"%MYSQL_BIN%\mysqldump.exe" ^
  --user=%MYSQL_USER% ^
  --all-databases ^
  --routines ^
  --events ^
  --triggers ^
  --single-transaction ^
  --default-character-set=utf8mb4 ^
  > "%BACKUP_DIR%\all_databases_%STAMP%.sql"

if errorlevel 1 (
    echo Backup failed.
    exit /b 1
)

echo Backup completed:
echo "%BACKUP_DIR%\all_databases_%STAMP%.sql"
endlocal
```

### Password handling

Do not hard-code a real database password in a public repository.

Safer options include:

- allow the command to prompt
- use a protected MySQL option file
- store secrets outside the repository
- document required environment variables without committing their values

### What `--single-transaction` does

For transactional tables such as InnoDB, it helps create a consistent logical backup without locking tables for the entire export.

It is not a universal guarantee for every storage engine. Confirm restore behavior for important systems.

---

## 11. Restoring databases

### Restore with MySQL command line

```powershell
$mysql = "C:\wamp64\bin\mysql\mysql8.0.XX\bin\mysql.exe"
& $mysql --user=root < "C:\WampBackups\all_databases_2026-07-23_120000.sql"
```

PowerShell redirection can behave differently depending on shell version and command type. A robust alternative is:

```powershell
$mysql = "C:\wamp64\bin\mysql\mysql8.0.XX\bin\mysql.exe"
Get-Content -Raw "C:\WampBackups\example_database.sql" |
    & $mysql --user=root
```

For very large SQL files, use `cmd.exe` redirection to avoid loading the entire file into memory:

```powershell
cmd /c '"C:\wamp64\bin\mysql\mysql8.0.XX\bin\mysql.exe" --user=root < "C:\WampBackups\example_database.sql"'
```

### Restore with phpMyAdmin

phpMyAdmin is convenient for:

- one database
- small or moderate SQL files
- inspecting tables before and after restore

For large files, command-line restore is generally more reliable because web upload and PHP execution limits may interrupt phpMyAdmin imports.

### Validate after restore

Check:

- database exists
- expected tables exist
- row counts appear plausible
- stored routines are present when required
- events are present when required
- triggers are present
- users and grants are appropriate
- application login works
- application reads and writes data
- character encoding is correct

A successful import message is not the same as a successful application recovery.

---

## 12. Migrating a WordPress site

A WordPress migration normally requires:

- site files
- WordPress database
- matching database credentials
- correct site URL values
- correct file permissions
- working PHP extensions
- a compatible PHP version
- working rewrite rules

### Basic migration sequence

1. Export the WordPress database.
2. Copy the complete WordPress site folder.
3. Install WampServer on the new computer.
4. Start Apache and MySQL or MariaDB.
5. Create or restore the database.
6. Copy the site into the WampServer document root or virtual-host path.
7. update `wp-config.php` only when credentials or database names changed.
8. open the site locally.
9. update old URLs when the local hostname changed.
10. resave WordPress permalinks if rewrite rules need regeneration.
11. test the front end and administrator area.

### `wp-config.php`

Typical database settings:

```php
define('DB_NAME', 'wordpress_database');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
```

Do not publish real production credentials.

### URL changes

WordPress stores URLs in the database. When moving from one hostname to another, a simple text replacement can damage serialized values.

Use a WordPress-aware search-and-replace tool or WP-CLI rather than an unrestricted SQL text replacement when serialized plugin or theme settings may exist.

### After migration

Test:

- home page
- administrator login
- media library
- forms
- email behavior
- permalinks
- plugin pages
- custom post types
- database writes
- scheduled tasks
- uploads
- PHP error log

---

## 13. Migrating a general PHP application

Preserve:

- source files
- database
- environment configuration
- uploaded content
- generated assets required at runtime
- cron or scheduled-task definitions
- PHP extensions
- URL rewrite configuration
- external service endpoints
- encryption keys
- application secrets

Do not commit secrets merely because the repository is private. Keep secrets in an appropriate local configuration mechanism and document how they are supplied.

---

## 14. PHP version management

WampServer can support multiple PHP versions through compatible add-ons.

Before changing PHP versions:

1. back up the site and database
2. review the application's supported PHP range
3. check required extensions
4. switch versions through WampServer
5. restart services
6. test the application
7. inspect PHP and Apache logs
8. run automated tests when available

Common upgrade failures include:

- removed functions
- changed error handling
- stricter type behavior
- deprecated syntax
- extension incompatibility
- changed default settings
- outdated WordPress plugins or themes

Do not assume that a page loading means the entire application is compatible.

---

## 15. Apache and PHP logs

When a site fails, inspect logs before making broad configuration changes.

Likely locations are under the WampServer installation tree and can be opened from the tray menu.

Useful evidence includes:

- Apache startup errors
- port binding errors
- missing DLL messages
- PHP fatal errors
- extension load failures
- rewrite errors
- database connection failures

Capture the exact timestamp and error message. Avoid troubleshooting from only the browser's generic “500 Internal Server Error” page.

---

## 16. Common WampServer problems

### Tray icon never reaches the running state

Check:

- Apache service
- MySQL or MariaDB service
- ports 80, 443, and 3306
- Visual C++ prerequisites
- Apache error log
- Windows Event Viewer
- duplicate Windows services from an old installation

### Apache will not start

Likely causes:

- port 80 or 443 already in use
- invalid Apache configuration
- incompatible Apache or PHP combination
- missing runtime DLL
- malformed virtual-host entry
- security software blocking the executable

Test the Apache configuration using the tools offered by WampServer before editing unrelated Windows settings.

### Database service will not start

Likely causes:

- port 3306 already in use
- damaged data directory
- version mismatch
- abrupt shutdown
- invalid database configuration
- another MySQL Windows service already running

Do not overwrite or delete the database data directory as a first response. Preserve a copy before repair attempts.

### phpMyAdmin import fails

Possible causes:

- upload-size limit
- execution-time limit
- SQL file too large
- character-set mismatch
- unsupported SQL syntax
- target server version difference
- duplicate database or table objects

Use command-line import for large files and read the first actual SQL error rather than retrying blindly.

### WordPress opens but links fail

Check:

- Apache rewrite module
- `.htaccess`
- virtual-host document root
- WordPress site URL
- home URL
- permalink settings

### Browser shows the wrong local site

Check:

- hosts-file entry
- virtual-host order
- browser cache
- DNS cache
- HTTP versus HTTPS
- whether another web server is listening

---

## 17. Performance and background services

WampServer does not need to run constantly.

For a lean Windows workstation:

- do not add WampServer to startup unless needed
- start it only for development
- stop services when finished
- keep database backups outside the WampServer installation folder
- avoid real-time scanning exclusions unless justified and narrowly scoped
- do not expose Apache or MySQL to the public network unnecessarily

Performance problems are more often caused by:

- antivirus scanning a very large project tree
- slow or cloud-synchronized project storage
- excessive PHP debugging
- database queries
- browser extensions
- large log files
- application code

Keep active development projects on reliable local storage. Use cloud sync for backup or handoff only when the application's file-locking and database behavior are understood.

---

## 18. Security

WampServer is designed primarily for local development.

Recommended safeguards:

- bind services to local interfaces unless LAN access is intentional
- use Windows Firewall
- do not expose phpMyAdmin publicly
- do not use blank production passwords
- do not copy production secrets into public repositories
- keep backups outside the web document root
- remove diagnostic files such as `phpinfo()` pages
- review virtual-host access rules
- stop WampServer when it is not needed

A development machine can still contain valuable data. “Local only” does not eliminate the need for backups and access control.

---

## 19. Recommended WampServer backup layout

```text
C:\WampBackups\
├── Databases\
│   ├── all_databases_YYYY-MM-DD_HHMMSS.sql
│   └── individual\
├── Websites\
│   ├── SiteA\
│   └── SiteB\
├── Configuration\
│   ├── Apache\
│   ├── PHP\
│   ├── MySQL\
│   └── VirtualHosts\
└── Notes\
    └── InstalledVersions.md
```

Store at least one additional copy on another device or backup service.

A backup that exists only on the same disk as the working environment is not sufficient protection against disk failure.

---

## 20. Recovery checklist

After a new Windows installation:

- [ ] Install current Visual C++ prerequisites.
- [ ] Run the WampServer prerequisite checker.
- [ ] Install the full current WampServer package.
- [ ] Confirm Apache starts.
- [ ] Confirm MySQL or MariaDB starts.
- [ ] Confirm `localhost` opens.
- [ ] Confirm phpMyAdmin opens.
- [ ] Restore databases.
- [ ] Restore website folders.
- [ ] Restore virtual hosts.
- [ ] Restore only necessary custom configuration.
- [ ] Test each site.
- [ ] Inspect logs.
- [ ] Create a fresh full backup.
- [ ] Record installed versions.

---

# Part II — MAMP on macOS

## 21. What MAMP is

MAMP is a packaged local server environment available for macOS and Windows. On macOS it is the practical counterpart to WampServer.

The free MAMP package provides a local environment with:

- Apache
- Nginx
- PHP
- MySQL

MAMP PRO adds more site-management and configuration features, but the free version is sufficient for many local PHP and WordPress tasks.

Official site:

<https://www.mamp.info/en/mac/>

Official downloads:

<https://www.mamp.info/en/downloads/>

---

## 22. Installing MAMP on macOS

1. Download the current macOS package from the official MAMP downloads page.
2. Open the installer package.
3. Complete the macOS installation prompts.
4. Leave the installed MAMP folder in its expected location.
5. Open MAMP.
6. Start the servers.
7. Open the MAMP start page.
8. verify PHP and database access.

The MAMP documentation warns not to move or rename the installed MAMP folder because the application expects its standard layout.

Typical installation location:

```text
/Applications/MAMP
```

Typical document root:

```text
/Applications/MAMP/htdocs
```

---

## 23. MAMP and MAMP PRO

The installer may include both MAMP and MAMP PRO.

You can use the free MAMP application without purchasing MAMP PRO.

MAMP PRO is more useful when you need:

- many separately managed sites
- per-site settings
- expanded PHP version handling
- a richer graphical interface
- more advanced host and service configuration

For a simple local WordPress or PHP site, begin with free MAMP and upgrade only when a specific requirement justifies it.

---

## 24. Starting MAMP

The MAMP interface provides a Start control for launching local services.

The application indicates whether:

- all servers are stopped
- all servers are running
- only some services started successfully

When only part of the stack starts, inspect the service settings and logs rather than reinstalling immediately.

---

## 25. MAMP ports

MAMP may use ports different from the standard web ports, depending on configuration.

A local site may therefore open with a URL containing a port number, such as:

```text
http://localhost:8888/
```

MySQL may also use a nonstandard local port.

Record the actual ports shown in MAMP and use them in application configuration.

Example WordPress database host with a custom port:

```php
define('DB_HOST', '127.0.0.1:8889');
```

Use the port MAMP actually reports; do not copy this example blindly.

---

## 26. Migrating from WampServer to MAMP

WampServer and MAMP cannot be copied as whole installations from one operating system to the other.

Move the application assets instead:

- website files
- SQL database exports
- uploaded content
- application configuration
- a record of PHP extensions
- a record of PHP and database versions

### Recommended sequence

1. Export the database from WampServer using `mysqldump`.
2. Copy the website files to the Mac.
3. Install MAMP.
4. Start MAMP.
5. Create or import the database.
6. place the website under MAMP's document root or configure a host.
7. update database host, port, user, and password as needed.
8. update site URLs when required.
9. test the application.
10. inspect PHP and web-server logs.

### Path differences

Windows:

```text
C:\wamp64\www\MySite
```

macOS:

```text
/Applications/MAMP/htdocs/MySite
```

Code that assumes Windows drive letters or backslashes may need correction.

Use portable path handling in PHP:

```php
$path = __DIR__ . DIRECTORY_SEPARATOR . 'data';
```

---

## 27. Database command-line tools in MAMP

MAMP includes database client tools within its installation directories, although exact paths vary by version.

Before scripting, locate the installed `mysql` and `mysqldump` binaries rather than assuming a version-specific path.

Example search:

```bash
find /Applications/MAMP -type f \( -name mysql -o -name mysqldump \) 2>/dev/null
```

Example logical backup after locating `mysqldump`:

```bash
"/path/to/mysqldump" \
  --host=127.0.0.1 \
  --port=8889 \
  --user=root \
  --password \
  --databases example_database \
  --routines \
  --events \
  --triggers \
  --single-transaction \
  > "$HOME/Desktop/example_database.sql"
```

The `--password` option without an inline value prompts for the password and avoids storing it in shell history.

---

## 28. WordPress on MAMP

The same WordPress migration principles apply:

- copy all site files
- import the database
- update `wp-config.php`
- account for MAMP's MySQL port
- update URLs safely
- verify rewrite behavior
- test plugins and themes
- inspect PHP logs

A common difference is the database host and port.

Example only:

```php
define('DB_HOST', '127.0.0.1:8889');
```

Use the values displayed by the installed MAMP configuration.

---

## 29. macOS permissions

If MAMP can start but a site cannot write uploads, caches, or generated files, inspect ownership and permissions.

Avoid making an entire project world-writable.

Instead:

- identify the exact directory that needs write access
- determine which user runs the web server
- apply the narrowest practical permission change
- document the reason

Do not use broad commands such as `chmod -R 777` as a routine fix.

---

## 30. MAMP troubleshooting

### Servers do not start

Check:

- port conflicts
- another Apache or MySQL instance
- MAMP logs
- macOS security prompts
- whether the MAMP folder was moved or renamed
- configuration changes
- available disk space

### Site loads but database connection fails

Check:

- database name
- database user
- password
- host
- MySQL port
- whether MySQL is running
- whether the application uses a Unix socket or TCP connection

Using `127.0.0.1` with the configured port can avoid ambiguity when an application otherwise selects a different socket.

### WordPress redirects to the old address

Check:

- `siteurl`
- `home`
- serialized plugin settings
- browser cache
- hard-coded theme URLs
- web-server redirect rules

Use a WordPress-aware search-and-replace process for serialized data.

---

# Part III — Shared operating practices

## 31. Source of truth

For each local website, define the source of truth clearly.

A sound arrangement is:

- Git repository: source code and safe configuration templates
- database backup: data source of truth
- uploads backup: user-generated files
- local WAMP or MAMP directory: working runtime copy
- remote hosting: publication target, not necessarily the only backup

Do not rely on a live local database with no export history.

---

## 32. What belongs in Git

Usually appropriate:

- PHP source
- themes and plugins you maintain
- configuration examples
- database schema migrations
- scripts without secrets
- documentation
- `.gitignore`
- local setup instructions

Usually inappropriate:

- passwords
- API keys
- private certificates
- production `.env` files
- database dumps containing private data
- user uploads containing private data
- generated caches
- logs
- the entire WampServer or MAMP installation

Before committing, review for:

- credentials
- keys
- tokens
- `.env` files
- private customer data
- database exports
- generated output
- diagnostic reports

---

## 33. Suggested `.gitignore`

Adjust this example to the application:

```gitignore
# Secrets
.env
.env.*
!.env.example

# Logs and caches
*.log
cache/
tmp/
temp/

# Database exports
*.sql
*.sql.gz

# WordPress generated/user content
wp-content/cache/
wp-content/uploads/

# OS files
.DS_Store
Thumbs.db

# IDE files
.vscode/
.idea/
```

Do not ignore maintained source merely because a tool generates some neighboring files.

---

## 34. Final recommendation

For this workflow:

- use **WampServer on Windows**
- use **MAMP on macOS**
- download each from its maintained project site
- preserve database exports separately from website files
- verify prerequisites before troubleshooting
- migrate applications, not whole platform installations
- record versions
- test restores
- keep secrets out of Git
- keep at least one backup off the working computer

The most important WampServer-specific lesson is the download process:

> Use the Aviatechno WampServer files page, distinguish the full installer from add-ons and updates, and download the current prerequisite checker rather than relying on an old copy or a third-party download button.

---

# Official references

## WampServer

- WampServer files, add-ons, prerequisites, updates, and Visual C++ checker:  
  <https://wampserver.aviatechno.net/>

## MAMP

- MAMP for macOS:  
  <https://www.mamp.info/en/mac/>
- Official downloads:  
  <https://www.mamp.info/en/downloads/>
- MAMP macOS installation documentation:  
  <https://documentation.mamp.info/en/MAMP-Mac/Installation/>
- MAMP interface documentation:  
  <https://documentation.mamp.info/en/MAMP-Mac/Reference/Interface/>

---

## Document maintenance note

Component versions, installer names, runtime prerequisites, and download filenames change. Before using this guide for a new installation:

1. check the current WampServer prerequisite notice
2. use the current WampServer full installer
3. download a fresh prerequisite checker
4. check the current MAMP downloads page
5. record the versions actually installed
