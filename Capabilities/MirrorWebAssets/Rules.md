<!--
IndexTitle: MirrorWebAssets Rules
IndexDescription: Operating rules for mirroring WordPress uploads and theme folders between WAMP www and Dropbox Webs backup paths.
IndexType: Capability
CapabilityName: MirrorWebAssets
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-07-01
-->

# MirrorWebAssets Rules

## Scope

In scope:

- **Backup:** `%WAMP_WWW_ROOT%\<wpSiteFolder>\` uploads + child-theme folders →
  `%DROPBOX_WEBS_ROOT%\<siteKey>\` (flat layout).
- **Restore:** Dropbox → local WAMP www for the same folder pairs when owner
  explicitly requests updating local www from Dropbox.
- Site list in `Automation/MirrorWebAssets/WebAssetsSites.json`.
- Shared implementation in `Automation/MirrorWebAssets/WebAssetsMirrorLib.ps1`.
- Incremental copy (robocopy `/E`, **no purge**).
- Post-copy verification while the workflow is being proven reliable.

Out of scope unless separately approved:

- WordPress core, plugins, Genesis parent theme, full `wp-content`, database,
  `wp-config.php`, static calculator folder, or `mu-plugins`.
- Mirroring the Git repository (`MirrorToWindows` owns that).
- Production/Bluehost deploy or DNS changes.

## Before Any Pass

1. Read `Workspace/OwnerPreferences.md` § **Web asset mirror**.
2. Confirm owner explicitly requested backup **or** restore.
3. Confirm `WAMP_WWW_ROOT` resolves.
4. Confirm Dropbox Desktop is running and `Dropbox\Webs` exists.

## Operating Rules

### Backup (WAMP → Dropbox)

- **Default direction** for routine “mirror web assets” requests.
- Local WAMP www is source of truth.
- On-demand only — no automatic mirror after routine passes.

### Restore (Dropbox → WAMP)

- Run **only** when owner explicitly asks to update local www from Dropbox.
- Dropbox is source of truth **for uploads and theme folders only** during that pass.
- Warn if local theme/uploads have un-backed-up edits that restore would overwrite.

### Both directions

- **Backup style:** robocopy `/E` only — **no `/MIR` purge** unless owner explicitly
  requests a full mirror with purge.
- **Flat Dropbox layout:** `uploads`, `altitude-pro`, etc. under `Dropbox\Webs\<siteKey>\`.
- **Multi-site ready:** add manifest rows; use `-SiteKey` or omit for all sites.
- Do not log routine results in `OwnerPreferences.md` — report in the reply only.

## Verification Lifecycle

| Phase | Setting | Action |
| --- | --- | --- |
| **Proving** | `"verifyMirror": true` in manifest | Verify after every copy |
| **Steady state** | `"verifyMirror": false` or `-SkipVerification` | Skip verify once proven |

## Disambiguation

| User says | Route |
| --- | --- |
| Mirror repository / {siteKey}Web to Dropbox | **MirrorToWindows** |
| Mirror / backup uploads or theme to Dropbox | **MirrorWebAssets** → `Mirror-WebAssetsToDropbox.ps1` |
| Restore / update local www from Dropbox | **MirrorWebAssets** → `Restore-WebAssetsFromDropbox.ps1` |
| Dropbox planner / ChatGPT review | **DropboxLink** |

## Related

- [WorkflowIndex.md](WorkflowIndex.md)
- [MirrorWebAssetsWorkflow.md](MirrorWebAssetsWorkflow.md)
- [../../Standards/RepositoryMirrorStandard.md](../../Standards/RepositoryMirrorStandard.md)
