<!-- Index: Mirror WordPress uploads and theme folders between WAMP www and Dropbox Webs for backup and restore. -->
<!--
IndexTitle: MirrorWebAssets Capability
IndexDescription: On-demand backup and restore of WordPress uploads and child-theme folders between local WAMP www and Dropbox Webs paths.
IndexType: Capability
CapabilityName: MirrorWebAssets
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-07-01
-->

# MirrorWebAssets Capability

- **Version:** 2
- **Tier:** Universal
- **Purpose:** Backup and restore large, non-Git WordPress assets (uploads + child
  theme) between local WAMP `www` and a flat Dropbox `Webs\<siteKey>\` layout.
- **Inputs:** Site manifest (`Automation/MirrorWebAssets/WebAssetsSites.json`),
  `WAMP_WWW_ROOT`, Dropbox Desktop sync folder.
- **Outputs:** Updated Dropbox backup or restored local www folders; report in reply.
- **WhenToUse:** Owner asks to mirror/backup uploads/theme to Dropbox, restore
  local www from Dropbox, or hand off web assets between machines.

## Start Here

[WorkflowIndex.md](WorkflowIndex.md) → [MirrorWebAssetsWorkflow.md](MirrorWebAssetsWorkflow.md)

## Scripts

| Script | Direction |
| --- | --- |
| [Mirror-WebAssetsToDropbox.ps1](../../Automation/MirrorWebAssets/Mirror-WebAssetsToDropbox.ps1) | WAMP → Dropbox |
| [Restore-WebAssetsFromDropbox.ps1](../../Automation/MirrorWebAssets/Restore-WebAssetsFromDropbox.ps1) | Dropbox → WAMP |
| [WebAssetsMirrorLib.ps1](../../Automation/MirrorWebAssets/WebAssetsMirrorLib.ps1) | Shared logic |

## Why Not Git

Uploads and theme folders can contain large media and many files. This workflow
keeps them out of the Git repository while still providing off-site backup and
machine-to-machine handoff via Dropbox Desktop sync.

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | Owner workflow 2026-07-01 |
| **SourceSummary** | {siteKey} uploads + altitude-pro ↔ Dropbox Webs |
| **PromotionStatus** | Active |
| **Dependencies** | MirrorToWindows rules (backup style, no purge); WampPaths.ps1 |
| **RelatedFiles** | WorkflowIndex.md, MirrorWebAssetsWorkflow.md, Rules.md, Prompt.md |
| **LastReviewed** | 2026-07-01 |
| **HarmonizationNotes** | v2 adds restore direction and shared lib |

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-07-01 | 1 | Initial Capability — {siteKey} pilot | Large www assets belong in Dropbox, not Git | README, Rules, Prompt, WorkflowIndex, mirror script |
| 2026-07-01 | 2 | Restore direction + modular lib | Proven handoff: mirror then update local www | WebAssetsMirrorLib, Restore script, MirrorWebAssetsWorkflow |

## Related

- [AgentCapabilityGuide.md](../AgentCapabilityGuide.md)
- [../../Workspace/OwnerPreferences.md](../../Workspace/OwnerPreferences.md)
