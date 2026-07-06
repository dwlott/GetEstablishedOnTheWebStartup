<!--
IndexTitle: MirrorWebAssets Prompt
IndexDescription: Copy-ready prompts for backing up or restoring WordPress uploads and theme folders via Dropbox.
IndexType: Capability
CapabilityName: MirrorWebAssets
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-07-01
-->

# MirrorWebAssets Prompt

## Worker pass — backup {siteKey} web assets to Dropbox

```text
Read Capabilities/MirrorWebAssets/WorkflowIndex.md, Rules.md, and MirrorWebAssetsWorkflow.md.
Read Workspace/OwnerPreferences.md § Web asset mirror.

Mirror {siteKey} uploads and altitude-pro theme folders to Dropbox.
Run Automation/MirrorWebAssets/Mirror-WebAssetsToDropbox.ps1 -SiteKey {siteKey}.

Report the Web Asset Mirror block from MirrorWebAssetsWorkflow.md when done.
```

## Worker pass — restore local www from Dropbox

```text
Read Capabilities/MirrorWebAssets/WorkflowIndex.md, Rules.md, and MirrorWebAssetsWorkflow.md.
Read Workspace/OwnerPreferences.md § Web asset mirror.

Update local WAMP www from Dropbox for {siteKey} (uploads + altitude-pro).
Run Automation/MirrorWebAssets/Restore-WebAssetsFromDropbox.ps1 -SiteKey {siteKey}.

Confirm http://localhost/{siteKey}/ loads.
Report the Web Asset Restore block from MirrorWebAssetsWorkflow.md when done.
```

## Worker pass — backup then restore (handoff between PCs)

```text
Read Capabilities/MirrorWebAssets/MirrorWebAssetsWorkflow.md § Typical Two-Step Handoff.

On this machine run the appropriate direction only:
- Source PC: Mirror-WebAssetsToDropbox.ps1 -SiteKey {siteKey}
- Target PC: Restore-WebAssetsFromDropbox.ps1 -SiteKey {siteKey}

Report per-direction results.
```

## Worker pass — all configured sites

```text
Read Capabilities/MirrorWebAssets/WorkflowIndex.md and Rules.md.

Run the requested script for every site in WebAssetsSites.json
(Mirror-WebAssetsToDropbox.ps1 or Restore-WebAssetsFromDropbox.ps1).

Report per-site results.
```

## Steady state (verification off)

```text
Read Capabilities/MirrorWebAssets/Rules.md § Verification Lifecycle.

Add -SkipVerification to the mirror or restore script
(or set verifyMirror false in WebAssetsSites.json if owner approved).
```
