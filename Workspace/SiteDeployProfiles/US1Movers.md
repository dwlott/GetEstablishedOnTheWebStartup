<!--
IndexTitle: US1Movers Deploy Profile
IndexDescription: Site-specific data and first local-to-live database deploy steps for us1movers.com on Bluehost.
IndexType: Reference
IndexStatus: Draft
LastEdited: 2026-06-25
-->

# US1Movers Deploy Profile

First real run of the local → live database deploy
([method](../Reference/WordPressGenesisOperatingGuide/Pages/17-PhpMyAdminDatabaseExportAndEdit.md#deploy-modes-draft)).
Goal: push the local WAMP build **up** to production so `us1movers.com` gets its
database for the first time.

## Site data

| Field | Value |
| --- | --- |
| Live URL | `https://us1movers.com` (confirm — owner also wrote `us1mover.com`) |
| cPanel host | `wp1.bluehost.com:2083` (account `mindfxa6_`) |
| Production DB | `mindfxa6_us1movers` |
| Production prefix | **TBD** — expand the DB in phpMyAdmin and read it |
| Local URL | **TBD** — e.g. `http://localhost/us1movers` |
| Local WAMP root | **TBD** — `C:\wamp\www\...` or `G:\wamp64\www\...` |
| Local DB / prefix | **TBD** |
| SSH / WP-CLI available? | **TBD** (Bluehost supports WP-CLI over SSH) |
| Default deploy mode | `full` (first run); switch to `standard-partial` after go-live |
| Full-DB push safe? | **Yes** — production DB is new/empty, no live data to lose |
| Extra exclude tables | *(none yet — add if CF7/Flamingo or live users/comments appear)* |
| Backup folder (outside Git) | **TBD** local path |
| Last deploy | (none yet) |

## Why full push is safe here

Production `mindfxa6_us1movers` appears empty/fresh, so a
[full deploy](../Reference/WordPressGenesisOperatingGuide/Pages/17-PhpMyAdminDatabaseExportAndEdit.md#mode-full)
loses nothing. After the site goes live and starts collecting form entries or
users, set `Default deploy mode: standard-partial` in this profile.

## Deploy steps (first run)

### 0. Capture the TBDs above

- Expand `mindfxa6_us1movers` in phpMyAdmin → note the production table prefix.
- Confirm the local build's WAMP root, local URL, local DB name, and local prefix.
- Confirm the exact live domain (`us1movers.com` vs `us1mover.com`).

### 1. Align the table prefix

A raw import does not rewrite the prefix. Make local and production match — set
local `$table_prefix` to the production value (Better Search Replace prefix tool,
or edit `wp-config.php` + rename tables). Record the chosen prefix above.

### 2. Back up production (record, even if empty)

phpMyAdmin → select `mindfxa6_us1movers` → **Export** → SQL →
`us1movers-prod-empty-2026-06-24.sql` (store outside Git).

### 3. Export the local database (full mode)

- phpMyAdmin (local) → Export the local us1movers DB → `.sql`, **or**
- `wp db export us1movers-local-full.sql` if WP-CLI is set up locally.

### 4. Import to production

phpMyAdmin (Bluehost) → select `mindfxa6_us1movers` → **Import** → choose the
local `.sql` → Go.

### 5. Fix URLs (serialization-safe)

On production, **not** a raw SQL find-replace:

```bash
wp search-replace 'http://localhost/us1movers' 'https://us1movers.com' --all-tables --report-changed-only
wp cache flush
```

No SSH? Use the **Better Search Replace** plugin (dry-run first), same from/to.

### 6. Finish and verify

- Re-save **Settings → Permalinks** on production.
- Confirm `wp-config.php` on production has the correct `$table_prefix` and DB
  credentials (Bluehost-side; never in Git).
- Load `https://us1movers.com` and click through key pages.

## Notes / open items

- Production prefix is the key missing value — capture it first (step 0).
- If the local build does not exist yet, this is a build task before deploy.
