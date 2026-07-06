<!--
IndexTitle: GDriveRepositoryRefresh Skill
IndexDescription: Runtime-neutral Skill scaffold for refreshing the Google Drive repository copy after local repository edits.
IndexType: Skill
SkillName: GDriveRepositoryRefresh
Capability: GoogleDriveLink
SkillVersion: 1
IndexStatus: Scaffolded
LastEdited: 2026-06-04
-->
---
name: gdrive-repository-refresh
description: Keep the Google Drive repository reference mirror current after local Git repository edits using the approved FastMirror apply-first workflow. Use when Codex or another local agent changed repository files and ChatGPT needs to review the refreshed Google Drive copy, or when the user asks to refresh the gdrive repo copy.
---

# GDriveRepositoryRefresh Skill

Owning Capability: [GoogleDriveLink](../../README.md)

## Purpose

Keep the gdrive repo copy current after local repository edits so ChatGPT can
review the latest repository files through Google Drive.

When a task is read-only and the gdrive repo copy is current, ChatGPT should
read that copy directly instead of sending the task to Codex just to inspect
files. Use Codex when durable local repository edits are needed.

This Skill packages the proven operating pattern. It does not replace
GoogleDriveLink rules, the refresh automation README, or human approval for
deletion-capable mirror apply.

## Source And Destination

Source:

```text
C:\Repositories\GetEstablished
```

Destination:

```text
H:\My Drive\Repositories\GetEstablished
```

Direction:

```text
Local Git repository -> gdrive repo copy only
```

Never sync from Google Drive back into local Git. Local Git and GitHub remain
the source of truth. The gdrive repo copy is a disposable reference mirror,
not a backup.

## Required Reads

Before operating, read:

- [../../README.md](../../README.md)
- [../../GDriveRepositoryRefreshSkillPlan.md](../../GDriveRepositoryRefreshSkillPlan.md)
- [../../../../Plans/CapabilityWorkflowCaptureAndSkillPromotionPlan.md](../../../../Plans/CapabilityWorkflowCaptureAndSkillPromotionPlan.md)
- [../../../../Plans/CodexGDriveRefreshPermissionConfigPlan.md](../../../../Plans/CodexGDriveRefreshPermissionConfigPlan.md)
- [../../../../Automation/GoogleDriveRepositoryRefresh/README.md](../../../../Automation/GoogleDriveRepositoryRefresh/README.md)

Read the automation scripts only when command behavior, output, or error
handling needs to be verified:

- [../../../../Automation/GoogleDriveRepositoryRefresh/Run-GDriveFastMirror.cmd](../../../../Automation/GoogleDriveRepositoryRefresh/Run-GDriveFastMirror.cmd)
- [../../../../Automation/GoogleDriveRepositoryRefresh/Run-GDriveRefreshCheck.cmd](../../../../Automation/GoogleDriveRepositoryRefresh/Run-GDriveRefreshCheck.cmd)
- [../../../../Automation/GoogleDriveRepositoryRefresh/Refresh-GDriveRepository.ps1](../../../../Automation/GoogleDriveRepositoryRefresh/Refresh-GDriveRepository.ps1)
- [../../../../Automation/GoogleDriveRepositoryRefresh/refresh_gdrive_repository.py](../../../../Automation/GoogleDriveRepositoryRefresh/refresh_gdrive_repository.py)

## When To Use

Use this Skill after Codex or another local agent changes repository files and
the user wants ChatGPT to review the updated gdrive repo copy.

Use it before a Google Drive repository-aware ChatGPT review when local files
have changed.

Also use it when the user explicitly asks to refresh the gdrive repo copy.

## What This Skill Does

1. Remind or trigger the refresh workflow after local edits.
2. Run or instruct the normal FastMirror apply-first workflow by default.
3. Use the dry-run check launcher only for optional manual investigation.
4. Apply the one-way refresh immediately in FastMirror mode after path
   validation; do not require a pre-apply dry-run for normal workflow.
5. Treat removals as normal mirror behavior when files are absent locally.
6. Run final Python and robocopy verification after FastMirror apply.
7. Treat the Drive copy as current for ChatGPT review only when final
   verification reports `Final verification clean: yes`.
8. Report `GDrive Refresh` status in the final handoff.

## Trusted Command Candidates

Normal FastMirror command:

```text
Automation\GoogleDriveRepositoryRefresh\Run-GDriveFastMirror.cmd
```

Optional dry-run check command:

```text
Automation\GoogleDriveRepositoryRefresh\Run-GDriveRefreshCheck.cmd
```

Manual apply command:

```text
powershell -ExecutionPolicy Bypass -File "Automation\GoogleDriveRepositoryRefresh\Refresh-GDriveRepository.ps1" -SourcePath "C:\Repositories\GetEstablished" -DestinationPath "H:\My Drive\Repositories\GetEstablished" -Apply
```

Do not treat these as unrestricted PowerShell, unrestricted `cmd`, arbitrary
`H:` writes, arbitrary Google Drive writes, or permission to sync from Google
Drive back into local Git.

## Permission Policy

- This repository has no repo-owned Codex permission config file for this
  workflow. Use
  [../../../../Plans/CodexGDriveRefreshPermissionConfigPlan.md](../../../../Plans/CodexGDriveRefreshPermissionConfigPlan.md)
  as the service plan before changing local Codex settings.
- Permission prompts to inspect `H:` are expected.
- Permission prompts to apply the one-way refresh are expected.
- The user may click Yes each time.
- The user may later choose "Yes, and don't ask again" only for the exact
  known command patterns above after trust is established.
- Do not treat this as unrestricted PowerShell permission.
- Do not silently apply destructive mirror operations.

## Blocking Conditions

Stop and report instead of running FastMirror if validation shows:

- Source or destination path failure.
- Destination is blank or a drive root.
- Source/destination mismatch.

Stop and report instead of applying if optional dry-run output shows:

- Nested repository folder creation.
- `.git` content.
- Credential files.
- Token or secret files.
- Cache, log, temp, or build output.
- Large intake content.
- Source/destination mismatch.
- Drive-to-local direction.
- Anything other than expected adds, changes, or removals.
- Output the agent cannot confidently interpret.

## Output That Permits ChatGPT Review

FastMirror apply is permitted after path validation without a pre-apply
dry-run. Final verification must still be clean before ChatGPT should trust
the review copy.

For optional dry-run investigation, review added, changed, and removed files
before any manual `-Apply` run. Removals alone do not block FastMirror when
path validation passes and final verification succeeds.

Robocopy exit code `1` is nonfatal when the refresh script reports that
robocopy completed without a fatal error.

## Extra Safe-Check Passes

Run a final verification dry-run after apply.

Run an extra safe check after permission/config changes, refresh workflow
changes, source/destination rule changes, or Skill behavior changes.

If the final dry-run reports `added: 0`, `changed: 0`, and `removed: 0`, the
gdrive repo copy can be treated as current enough for ChatGPT review.

Extra checks should reduce risk, not create an endless review loop. Report the
extra check clearly under `GDrive Refresh` in the final handoff.

## Handoff Requirements

When refresh runs, the worker handoff must include a `GDrive Refresh` section
with:

- Whether check ran.
- Whether apply ran.
- Dry-run summary.
- Final verification dry-run summary if apply ran.
- Suspicious output status.
- Robocopy exit code if apply ran.
- Whether the exit code was fatal or nonfatal.
- Dry-run report path.
- Dry-run log path.
- Apply log path if apply ran.

## Existing Automation Relationship

This Skill relies on the existing automation:

- `Automation/GoogleDriveRepositoryRefresh/Run-GDriveFastMirror.cmd`
- `Automation/GoogleDriveRepositoryRefresh/Run-GDriveRefreshCheck.cmd`
- `Automation/GoogleDriveRepositoryRefresh/Refresh-GDriveRepository.ps1`
- `Automation/GoogleDriveRepositoryRefresh/refresh_gdrive_repository.py`

FastMirror is the normal entry point. The check launcher remains the optional
dry-run entry point. PowerShell remains the preferred apply engine. Python
remains the preferred review/report/verification engine.

Do not add new automation scripts from this Skill scaffold.

## GoogleDriveLink Relationship

This Skill is owned by GoogleDriveLink because it keeps the Google Drive
repository copy current for ChatGPT repository access.

The Google Drive copy exists for read/bootstrap reference-mirror visibility.
It does not replace local Git, GitHub, or the repository's normal
source-of-truth rules.

## Non-Goals

This Skill does not:

- Edit from the gdrive repo copy.
- Sync from Google Drive back to local Git.
- Replace local Git or GitHub.
- Manage arbitrary Google Drive folders.
- Upload raw Markdown through the ChatGPT Google Drive App.
- Make broad Codex PowerShell permissions.
- Create runtime adapter folders.
- Add new scripts or automation.

## Version Notes

| Date | Version | Change |
| --- | ---: | --- |
| 2026-06-04 | 1 | FastMirror is the normal apply-first workflow; dry-run is optional for manual investigation; final verification remains required. |
| 2026-06-01 | 1 | Clarified that dry-run is mandatory but not a completed refresh; apply and final verification are required before ChatGPT review uses the Drive copy. |
| 2026-05-31 | 1 | Initial runtime-neutral Skill scaffold for the GoogleDriveLink Capability. |
