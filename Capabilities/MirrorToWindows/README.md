<!--
IndexTitle: MirrorToWindows Capability
IndexDescription: On-demand repository copy from local Git to owner-chosen Windows target; purpose-aware docs-only consumer starter.
IndexType: Capability
CapabilityName: MirrorToWindows
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-12
-->

# MirrorToWindows Capability

- **Version:** 1
- **Tier:** Universal
- **Purpose:** Refresh a **repository mirror copy** on owner request on **Windows**.
  Reads **Mirror purpose** and paths from `Workspace/OwnerPreferences.md`.
- **Consumer starter:** **docs-only** — no bundled `Automation/RepositoryMirror/`
  scripts on this product repo. Manual Robocopy or File Explorer copy per
  [MirrorWorkflow.md](MirrorWorkflow.md), **or** invoke the archetype host launcher:
  `C:\Repositories\GetEstablished\Automation\RepositoryMirror\Run-WindowsMirror.cmd`
  with explicit destination and purpose (see friction report on host
  `Automation/AgentReplies/MirrorToGEOTWDropboxFriction-20260612.md`).
- **WhenToUse:** Mirror repository, backup copy, refresh mirror, sync to Dropbox
  or Google Drive Desktop path on Windows.

## Start Here

- First-time setup: [SetupPrompt.md](SetupPrompt.md)
- Refresh pass: [WorkflowIndex.md](WorkflowIndex.md)
- Apply details: [MirrorWorkflow.md](MirrorWorkflow.md)

## Does Not Replace

- **GoogleDriveLink** — connector boot, capture, planner loop
- **GitHubWorkflow** — version backup on GitHub
- Automatic mirroring after every edit (default is **no** mirror)

See [RepositoryMirrorStandard.md](../../Standards/RepositoryMirrorStandard.md).

## Related

- [../GoogleDriveLink/README.md](../GoogleDriveLink/README.md)
- [../../Workspace/OwnerPreferences.md](../../Workspace/OwnerPreferences.md)
