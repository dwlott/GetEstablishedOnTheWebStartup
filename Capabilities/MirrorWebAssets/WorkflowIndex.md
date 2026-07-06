<!--
IndexTitle: MirrorWebAssets Workflow Index
IndexDescription: Runnable index for mirroring WordPress uploads and theme folders between WAMP www and Dropbox Webs backup paths.
IndexType: Capability
CapabilityName: MirrorWebAssets
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-07-01
-->

# MirrorWebAssets Workflow Index

**Start here** for **WordPress web asset backup or restore** (uploads + child theme).

Full apply steps: [MirrorWebAssetsWorkflow.md](MirrorWebAssetsWorkflow.md)

## When To Run

| Intent | Script |
| --- | --- |
| Backup local www → Dropbox | `Mirror-WebAssetsToDropbox.ps1` |
| Restore Dropbox → local www | `Restore-WebAssetsFromDropbox.ps1` |
| Add another site | Edit `WebAssetsSites.json` |

**Do not run** for Git repository mirror — use **MirrorToWindows**.

## Steps

1. Read `Workspace/OwnerPreferences.md` § **Web asset mirror**.
2. Read [Rules.md](Rules.md) and [MirrorWebAssetsWorkflow.md](MirrorWebAssetsWorkflow.md).
3. Confirm `WAMP_WWW_ROOT` and Dropbox Webs root.
4. Run the script for the requested direction from repository root.
5. Report the matching report block from MirrorWebAssetsWorkflow.md.

## Quick Commands ({siteKey})

```powershell
# Backup
.\Automation\MirrorWebAssets\Mirror-WebAssetsToDropbox.ps1 -SiteKey {siteKey}

# Restore local www from Dropbox
.\Automation\MirrorWebAssets\Restore-WebAssetsFromDropbox.ps1 -SiteKey {siteKey}
```

## Related

- [Prompt.md](Prompt.md)
- [Rules.md](Rules.md)
- [MirrorWebAssetsWorkflow.md](MirrorWebAssetsWorkflow.md)
