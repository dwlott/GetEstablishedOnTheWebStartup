<!--
IndexTitle: Site Deploy Profile Template
IndexDescription: Copy to {SiteKey}.md and fill Bluehost / local deploy fields (no credentials).
IndexType: Reference
IndexStatus: Active
LastEdited: 2026-07-24
-->

# {SiteName} — Site Deploy Profile

Copy this file to `{SiteKey}.md` after Quick Startup. Replace braced placeholders.
Never commit DB passwords, `wp-config.php`, or `.sql` dumps.

| Field | Value |
| --- | --- |
| Live URL | `https://{productionDomain}` |
| Local URL | `http://localhost/{siteKey}` |
| Local WAMP root | `G:\wamp64\www\{siteKey}` (or `C:\wamp\www\...`) |
| Local DB | `{siteKey}` |
| Local / production table prefix | `{lowercasePrefix_}` (must match exactly) |
| Production DB (Bluehost) | `{cpanelUser}_{siteKey}` |
| cPanel host | Bluehost (account `{cpanelUser}`) |
| SSH / WP-CLI available? | unknown / yes / no |
| Default deploy mode | `full` for first empty-DB go-live; otherwise owner-gated |
| Full-DB push safe? | **yes** only if production has no unique live data; **no** after go-live with forms/users |
| Backup folder (outside Git) | Downloads / local backup |
| Last first go-live | *(none yet)* |
| Last Bluehost prep | *(none yet)* |
| Production push | owner-gated |

## Live-site caution

A full database import **overwrites** production tables. After the site is live,
back up production first. Form entries, comments, or users that exist only on
Bluehost can be destroyed. See
[WordPressMigrationCapabilityPlan.md](../../Plans/WordPressMigrationCapabilityPlan.md)
(Path A re-push).

## Prep command (SQL only — does not go live)

```powershell
cd C:\Repositories\{ProjectFolder}
.\Automation\BluehostDatabasePrep\Export-BluehostReadyDatabase.ps1 `
  -SiteKey {siteKey} `
  -BluehostDatabaseName '{cpanelUser}_{siteKey}' `
  -ExpectedTablePrefix '{lowercasePrefix_}' `
  -LocalUrl 'http://localhost/{siteKey}' `
  -PublicUrl 'https://{productionDomain}' `
  -OutputPath "$env:USERPROFILE\Downloads\{siteKey}-bluehost-ready.sql" `
  -Force
```

## Post-import checklist (owner-approved)

1. Confirm production `wp-config.php`: DB credentials + single matching `$table_prefix`.
2. Copy theme (e.g. `altitude-pro` / High Altitude) and needed `uploads`.
3. Re-save **Settings → Permalinks**; flush caches.
4. Smoke-test home, menus, forms, and key images.
