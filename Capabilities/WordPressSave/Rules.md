<!--
IndexTitle: WordPressSave Rules
IndexDescription: Guardrails for saving local WordPress theme files and database to Git and Dropbox.
IndexType: Capability
CapabilityName: WordPressSave
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-09-03
-->

# WordPressSave Rules

## When To Run

Only when the **owner explicitly requests** a WordPress Save pass to capture
direct WAMP/WordPress edits — not as the normal path for Git-first page work.

Typical triggers:

- Finished wp-admin, Customizer, or theme CSS/PHP session on WAMP
- After local theme experiments when WAMP was edited directly

Prefer **WordPressContentUpdate** / `ges-build.php` for Markdown-first content.

## Authority Rule

Git is authoritative for page drafts, build scripts, manifests, and tracked
theme files. WAMP is a deploy and verification target. Direct wp-admin edits are
provisional until this workflow captures them and the owner reviews the diff.

## Single-Site Default

```powershell
.\Automation\WordPressSave\Save-LocalWordPress.ps1
```

Uses [`ThemeTrackManifest.json`](../../Automation/WordPressSave/ThemeTrackManifest.json)
for the configured `siteKey`.

Database export target: value in manifest `databaseSnapshot.repoRelative`
(typically `Content/Website/Database/{siteKey}-local.sql.gz`).

Dropbox mirror (optional):

```powershell
.\Automation\MirrorWebAssets\Mirror-WebAssetsToDropbox.ps1 -SiteKey <siteKey>
```

## Changed-Only Rule

Theme save copies a file only when SHA256 differs from the repo copy. Unchanged
stock Genesis/Altitude files are never saved.

## Agent Report Block

```text
WordPress Save:
- Site: <siteKey from manifest>
- Theme files changed: <count> (list repo paths)
- Database snapshot: <path> (<bytes>)
- Dropbox mirror: success | skipped | failed
- Git commit: not performed (owner must request)
```

## Related

- [WorkflowIndex.md](WorkflowIndex.md)
- [../MirrorWebAssets/Rules.md](../MirrorWebAssets/Rules.md)
- [../WordPressMigrationBackup/Rules.md](../WordPressMigrationBackup/Rules.md)
