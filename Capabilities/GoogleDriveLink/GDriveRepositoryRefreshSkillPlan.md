<!--
IndexTitle: GDrive Repository Refresh Skill Plan
IndexDescription: Plan for a GoogleDriveLink-owned Skill that keeps the Google Drive repository copy current after local repository edits.
IndexType: Capability
CapabilityName: GoogleDriveLink
IndexStatus: Completed
LastEdited: 2026-06-04
-->

# GDrive Repository Refresh Skill Plan

## Purpose

Plan and track the runtime-neutral `GDriveRepositoryRefresh` Skill that helps
agents keep the Google Drive repository copy current after local repository
work.

The Skill should protect this one-way workflow:

```text
C:\Repositories\GetEstablished
  -> H:\My Drive\Repositories\GetEstablished
```

Local Git and GitHub remain the source of truth. The Google Drive repository
copy is a disposable reference mirror for ChatGPT read/bootstrap access, not
a backup.

## Problem To Solve

After Codex or another local agent changes repository files, the Google Drive
copy can become stale. The user should not need to remember a separate prompt
or manual checklist every time local files change.

The Skill should make the refresh step hard to forget and easy to trigger,
while keeping apply mode explicit because mirror refreshes can delete
destination files.

## Owning Capability

Owning Capability: `GoogleDriveLink`

Reason: the workflow exists to support Google Drive repository access for
ChatGPT, and it inherits GoogleDriveLink's source-of-truth and Drive-boundary
rules.

Related surfaces:

- `Capabilities/GoogleDriveLink/README.md`
- `Capabilities/GoogleDriveLink/RepositoryAccessWorkflow.md`
- `Capabilities/SkillRegistry.md`
- `Automation/GoogleDriveRepositoryRefresh/`

## Candidate Triggers

- Remind after Codex completes local repository edits when the Google Drive
  copy may be needed for ChatGPT review.
- Run the safe check when local files changed and a Drive copy refresh is
  useful for the next review or handoff.
- Apply only after a clean check and explicit user approval.
- Accept explicit user commands such as:

```text
refresh gdrive repo
```

## Skill Behavior

MVP behavior:

1. Notice when local repository edits may make the Google Drive copy stale.
2. Identify the source and destination paths.
3. Run or offer the normal FastMirror launcher by default:

   ```text
   Automation/GoogleDriveRepositoryRefresh/Run-GDriveFastMirror.cmd
   ```

4. Validate paths, apply immediately, and run final verification.
5. Treat removals as normal mirror behavior when files are absent locally.
6. Use the dry-run/check launcher only for optional manual investigation:

   ```text
   Automation/GoogleDriveRepositoryRefresh/Run-GDriveRefreshCheck.cmd
   ```

7. Confirm the Google Drive repository copy is current enough for ChatGPT
   read/bootstrap access only when final verification reports
   `Final verification clean: yes`.

MVP trigger and permission behavior is decided in:

- [../../Plans/CapabilityWorkflowCaptureAndSkillPromotionPlan.md](../../Plans/CapabilityWorkflowCaptureAndSkillPromotionPlan.md)
- [../../Plans/CodexGDriveRefreshPermissionConfigPlan.md](../../Plans/CodexGDriveRefreshPermissionConfigPlan.md)

Use those documents as the policy source before expanding the Skill beyond the
runtime-neutral scaffold.

## Codex Permission Configuration Policy

No repository-owned Codex config file is currently defined for this trusted
workflow. Do not edit external Codex settings from this repository pass. The
service plan for this narrow exception is documented in
[../../Plans/CodexGDriveRefreshPermissionConfigPlan.md](../../Plans/CodexGDriveRefreshPermissionConfigPlan.md).

If the user later chooses to reduce repeated prompts, the trusted candidates
are:

```text
Automation\GoogleDriveRepositoryRefresh\Run-GDriveFastMirror.cmd
```

```text
Automation\GoogleDriveRepositoryRefresh\Run-GDriveRefreshCheck.cmd
```

```text
powershell -ExecutionPolicy Bypass -File "Automation\GoogleDriveRepositoryRefresh\Refresh-GDriveRepository.ps1" -SourcePath "C:\Repositories\GetEstablished" -DestinationPath "H:\My Drive\Repositories\GetEstablished" -Apply
```

The trust rule is narrow:

```text
C:\Repositories\GetEstablished
  -> H:\My Drive\Repositories\GetEstablished
```

Local Git remains the edit source of truth. The gdrive repo copy is disposable
refresh output. Do not broaden this into unrestricted PowerShell permission,
unrestricted `cmd`, arbitrary writes to `H:`, arbitrary writes to Google Drive,
or sync from Google Drive back into local Git.

Expected permission behavior:

- The first few check runs may ask for permission to inspect `H:`.
- The first few apply runs may ask for permission to write to `H:`.
- This is expected, not a failure.
- The user may choose Yes for each run.
- The user may later choose "Yes, and don't ask again" only for the exact
  command patterns above after reviewing dry-run and apply behavior.
- The user should not choose "don't ask again" for broad PowerShell or
  unrelated commands.

## Non-Goals

The Skill must not:

- sync Google Drive back into local Git;
- treat the Google Drive repository copy as the edit source of truth;
- silently delete destination files;
- silently run apply after every local edit;
- include `.git`, credentials, tokens, caches, temp files, logs, build output,
  or large intake folders unless explicitly allowed;
- create scheduled tasks or unattended destructive sync;
- over-automate before the FastMirror workflow is trusted.

## Existing Automation Roles

- `Run-GDriveFastMirror.cmd` is the normal apply-first entry point.
- `Run-GDriveRefreshCheck.cmd` is the optional dry-run/check entry point.
- `Refresh-GDriveRepository.ps1` is the preferred apply engine because it uses
  `robocopy /MIR` for Windows mirroring.
- `refresh_gdrive_repository.py` is the preferred review/report/verification
  engine.

The Skill should call or reference these existing scripts instead of
reimplementing mirror logic.

## Skill Files

Current Skill path:

```text
Capabilities/GoogleDriveLink/Skills/GDriveRepositoryRefresh/SKILL.md
```

Optional future files if a later scoped task approves them:

```text
Capabilities/GoogleDriveLink/Skills/GDriveRepositoryRefresh/SetupPrompt.md
Capabilities/GoogleDriveLink/Skills/GDriveRepositoryRefresh/references/RefreshWorkflow.md
```

Runtime adapters remain future-only. Do not create `.cursor/skills/`,
`Automation/Skills/`, or vendor-specific adapter folders without explicit
approval.

## Skill Registry Plan

`GDriveRepositoryRefresh` is listed in `Capabilities/SkillRegistry.md` as
a scaffolded GoogleDriveLink-owned Skill.

## SkillCreate Decision

No separate `SkillCreate` Capability is required before this plan can proceed.
The repository already has a sufficient Skill creation path:

- `Plans/SkillsAndCapabilitiesModel.md`
- `Plans/SkillsFolderStructureProposal.md`
- `Capabilities/SkillRegistry.md`
- `Capabilities/CapabilityCreate/`

A future `SkillCreate` Capability may still be useful if multiple Skills need
repeatable authoring guidance. If created later, it should define how to
promote proven automation into a Capability-owned Skill without creating
runtime adapters or extra structure too early.

## Workflow Updater Reminder

When any of these change, review this plan in the same pass:

- GoogleDriveLink repository access workflow;
- GoogleDriveRepositoryRefresh automation;
- local Git source or destination rules;
- Google Drive repository naming or path;
- `Capabilities/SkillRegistry.md`;
- future Skill or runtime-adapter policy.

This reminder exists so the refresh Skill does not get forgotten when the
Google Drive workflow evolves.

Post-refresh logs and index maintenance should not be forgotten. Refresh logs
are part of the audit trail, and final handoffs must include `GDrive Refresh`
status and log paths when refresh runs. If future indexing is enabled, update
local indexes before refreshing the gdrive copy. If `RepositoryMap.md` or
related index/navigation docs change, still run the gdrive refresh so ChatGPT
can review the latest files.

Dry-run alone is not current enough for ChatGPT review when it reports pending
adds, changes, or removals. It is only an optional safety check.

Extra safe-check passes are appropriate after permission/config changes,
refresh workflow changes, source/destination rule changes, or changes to Skill
behavior. After FastMirror or manual apply, confirm final verification
reports `Final verification clean: yes`. Zero-count verification detail
(`added: 0`, `changed: 0`, `removed: 0`) also means the mirror is clean.
Report the final check clearly in the handoff and then stop; do not turn this
into an endless review loop.

## Later Version

Possible later behavior:

- one-command trusted refresh after user-approved policy exists;
- stronger manifest comparison and stale-copy detection;
- multi-repository source/destination registry;
- support for other repository copies;
- optional scheduled reminder, but not silent destructive sync.

## Open Questions

- Resolved 2026-05-31: exact explicit command can be
  `refresh gdrive repo`.
- Resolved 2026-05-31: Codex should remind after local edits when Drive review
  may be needed; otherwise a short handoff reminder is enough.
- Resolved 2026-06-04: FastMirror is the normal apply-first workflow; dry-run
  check is optional for manual investigation.
- Resolved 2026-05-31: the copy is current enough when FastMirror or manual
  apply is nonfatal, final verification is clean, and the handoff reports logs
  and robocopy result.
- Resolved 2026-05-31: apply remains permission-gated. A future trusted
  "don't ask again" policy may be considered only for the exact approved
  source, destination, and command pattern.

## Next Recommended Task

No further GDriveRepositoryRefresh review is blocking. Future work should be
specific: test the exact saved check permission, add a setup prompt, add a
runtime adapter, or change automation only when explicitly scoped.
