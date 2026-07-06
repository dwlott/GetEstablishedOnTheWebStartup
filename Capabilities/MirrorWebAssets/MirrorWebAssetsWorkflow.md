<!--
IndexTitle: MirrorWebAssets Workflow
IndexDescription: Apply steps for mirroring WordPress uploads and theme folders between WAMP www and Dropbox Webs backup paths.
IndexType: Capability
CapabilityName: MirrorWebAssets
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-07-01
-->

# MirrorWebAssets Workflow

Run only when [WorkflowIndex.md](WorkflowIndex.md) approves. **No mirroring is the default.**

Large WordPress assets (uploads + child theme) stay out of Git. Dropbox holds the
cloud backup using a **flat layout** under `Dropbox\Webs\<siteKey>\`.

## Site Manifest

All paths come from [WebAssetsSites.json](../../Automation/MirrorWebAssets/WebAssetsSites.json).

| Manifest field | Role |
| --- | --- |
| `siteKey` | Dropbox folder name (`{siteKey}`) |
| `wpSiteFolder` | WAMP site folder under `%WAMP_WWW_ROOT%` |
| `folders[].sourceRelative` | Path under WordPress root (`wp-content/uploads`, etc.) |
| `folders[].destName` | Flat Dropbox folder name (`uploads`, `altitude-pro`) |

## Direction A — Backup (WAMP → Dropbox)

**When:** After local media or theme edits; routine cloud backup refresh.

```powershell
.\Automation\MirrorWebAssets\Mirror-WebAssetsToDropbox.ps1 -SiteKey {siteKey}
```

- Source of truth: **local WAMP www**
- Robocopy `/E` (incremental, no purge)
- Verification optional (`verifyMirror` in manifest or `-SkipVerification`)

## Direction B — Restore (Dropbox → WAMP)

**When:** Owner explicitly asks to update local www from Dropbox — new machine,
wiped WAMP, or Dropbox has the files you want on this PC.

```powershell
.\Automation\MirrorWebAssets\Restore-WebAssetsFromDropbox.ps1 -SiteKey {siteKey}
```

- Source of truth for this pass: **Dropbox backup** (uploads + theme folders only)
- Same folder pairs as backup, direction reversed
- Does **not** restore WordPress core, plugins, Genesis, database, or `mu-plugins`

After restore, confirm the site loads:

```text
http://localhost/{siteKey}/
```

Database and `wp-config.php` are separate — use database restore scripts if needed.

## Shared Parameters

| Parameter | Purpose |
| --- | --- |
| `-SiteKey {siteKey}` | One site from manifest |
| `-SkipVerification` | Skip post-copy verify |
| `-WhatIf` | Print planned copies only |
| `-DropboxWebsRoot` | Override Dropbox root for this run |

## Typical Two-Step Handoff (proven workflow)

1. **On source PC** — backup to Dropbox:
   `Mirror-WebAssetsToDropbox.ps1 -SiteKey {siteKey}`
2. **On target PC** — restore local www:
   `Restore-WebAssetsFromDropbox.ps1 -SiteKey {siteKey}`

Wait for Dropbox Desktop sync between steps when machines differ.

## Report Blocks

**Backup:**

```text
Web Asset Mirror (WAMP -> Dropbox):
- Site: {siteKey}
- Folders: uploads, altitude-pro
- Verify: pass | skipped
- Result: success | failed
```

**Restore:**

```text
Web Asset Restore (Dropbox -> WAMP):
- Site: {siteKey}
- Folders: uploads, altitude-pro
- Verify: pass | skipped
- Result: success | failed
```

## Implementation

Shared logic: [WebAssetsMirrorLib.ps1](../../Automation/MirrorWebAssets/WebAssetsMirrorLib.ps1)

## Related

- [Rules.md](Rules.md)
- [WorkflowIndex.md](WorkflowIndex.md)
