<!--
IndexTitle: WampServer and MAMP Setup
IndexDescription: Pointer and checklist for installing WampServer (Windows) or MAMP (macOS) before local WordPress bootstrap.
IndexType: Capability
CapabilityName: WordPressWebsite
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-07-23
-->

# WampServer and MAMP Setup

Part of **WordPressWebsite**. **Optional** — offer this when the owner needs a
local stack or asks about WampServer/MAMP download, install, or migration.
Skip when WAMP/MAMP is already installed and services run. Full narrative guide:

[Workspace/Reference/WampServer-and-MAMP-Installation-Migration-Guide.md](../../Workspace/Reference/WampServer-and-MAMP-Installation-Migration-Guide.md)

## Which stack

| OS | Stack | Official / maintained download |
| --- | --- | --- |
| Windows | **WampServer** | <https://wampserver.aviatechno.net/> |
| macOS | **MAMP** | <https://www.mamp.info/en/downloads/> |

Do not use XAMPP, Docker, LocalWP, or DDEV unless the owner explicitly chooses
another stack (out of scope for this guide).

## WampServer download trick (Windows)

Do **not** click the first large advertisement-style download button from a web search.

1. Open <https://wampserver.aviatechno.net/>
2. Read current prerequisites on that page.
3. Download the current **full** WampServer installer (64-bit on current Windows).
4. Download a **fresh** prerequisite / Visual C++ checker from the same page.
5. Run the checker, then install WampServer (prefer `C:\wamp64`).
6. Start services; confirm `http://localhost/` and phpMyAdmin.

An Apache/PHP/MySQL **add-on** is not a substitute for the full installer.

## First validation (Windows)

1. Tray icon shows services running.
2. `http://localhost/` opens.
3. Optional: place `php-test.php` under `C:\wamp64\www\`, open it, then delete it.
4. Record `WAMP_WWW_ROOT` in `Workspace/OwnerPreferences.md` (e.g. `C:\wamp64\www`).

## MAMP (macOS) — short path

1. Download from official MAMP downloads page.
2. Install under `/Applications/MAMP` (do not move/rename the folder).
3. Start servers; record actual HTTP and MySQL ports (often nonstandard).
4. Document root is typically `/Applications/MAMP/htdocs`.

## After the stack is up

Continue **WordPressWebsite** → [NewCommissionSiteChecklist.md](NewCommissionSiteChecklist.md)
Phase 1 (WordPress on WAMP/MAMP) → [LocalWordPressSetupPlan.md](../../Plans/LocalWordPressSetupPlan.md).

## Stop conditions

- Do not expose Apache/MySQL/phpMyAdmin to the public network for this workflow.
- Do not hard-code database passwords into Git.
- Do not treat stack install as WordPress site install — they are separate steps.
- Serialize-aware URL replace when migrating WordPress hostnames (see
  **WordPressMigrationBackup** / BluehostDatabasePrep).

## Related

- Full guide: [WampServer-and-MAMP-Installation-Migration-Guide.md](../../Workspace/Reference/WampServer-and-MAMP-Installation-Migration-Guide.md)
- [NewCommissionSiteChecklist.md](NewCommissionSiteChecklist.md)
- [LocalWordPressSetupPlan.md](../../Plans/LocalWordPressSetupPlan.md)
- [WampPaths.ps1](../../Automation/LocalWordPress/WampPaths.ps1)
