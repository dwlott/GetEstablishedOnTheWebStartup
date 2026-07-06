<!--
IndexTitle: MirrorToWindows Rules
IndexDescription: Operating rules for on-demand Windows repository mirror in consumer starter (docs-only).
IndexType: Capability
CapabilityName: MirrorToWindows
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-12
-->

# MirrorToWindows Rules

Canonical rules for **Windows repository mirror refresh** in this starter.
Connector workflows live in **GoogleDriveLink**.

## Before Any Mirror Pass

1. Read `Workspace/OwnerPreferences.md` § **Connectors**.
2. If paths are unset, run [SetupPrompt.md](SetupPrompt.md).
3. Confirm **Mirror purpose** — especially "backup" vs "review".
4. Confirm the owner **explicitly requested** mirror refresh.
5. **Cursor unified:** skip mirror unless review sync or mirror was requested.

## Operating Rules

- **Default style = fast mirror** — incremental copy of new/changed files, **no purge** (robocopy `/E /FFT`). Run a **full mirror** (`/MIR`, purges extras in the target) **only when the owner explicitly asks for a full mirror**.
- **On-demand only** — no automatic mirror after routine passes.
- **One-way:** local Git → mirror target. Never treat target as SoT.
- **Purpose drives purge** — see [RepositoryMirrorStandard.md](../../Standards/RepositoryMirrorStandard.md).
- **Default:** exclude `.git/` unless **Include `.git`** is `yes` with owner approval.
- **Consumer starter:** apply is **manual** (Robocopy or selective copy) — no bundled launcher.
- Update **Last mirror refresh** after successful apply with owner approval.

## Disambiguation

| User says | Route |
| --- | --- |
| Mirror / backup / refresh repository (Windows) | This Capability |
| Refresh Google Drive / mirror to GDrive | This Capability (GDrive Desktop path = target) |
| Drive capture / Copilot planner boot | GoogleDriveLink |

## Related

- [WorkflowIndex.md](WorkflowIndex.md)
- [../../Standards/RepositoryMirrorStandard.md](../../Standards/RepositoryMirrorStandard.md)
