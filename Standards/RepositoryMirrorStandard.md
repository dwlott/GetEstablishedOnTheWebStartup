<!--
IndexTitle: Repository Mirror Standard
IndexDescription: Apply rules for platform mirror Capabilities — purpose, purge, exclusions, and path ownership.
IndexType: Standard
IndexStatus: Active
LastEdited: 2026-06-12
-->

# Repository Mirror Standard

Apply rules for **platform mirror Capabilities** (`MirrorToWindows`,
`MirrorToMac`). Authority hierarchy lives in
[SourceOfTruthAndMirrorStandard.md](SourceOfTruthAndMirrorStandard.md).

## Core Model

```text
Local Git (SoT)  →  owner-chosen mirror target path
Platform:         Windows | Mac — apply engine matches OS
Purpose:          review | backup | portability
GitHub:           version backup (history, collaboration) — not replaced by mirror
```

The mirror target may be **any reachable folder** — Dropbox Desktop sync path,
Google Drive Desktop path, `D:\Backup\`, USB, LAN share — not a vendor Capability.

## Purpose Matrix

| Purpose | Windows (Robocopy) | Mac (rsync) | Purge extras | Include `.git` | Primary use |
| --- | --- | --- | --- | --- | --- |
| **review** | `/MIR` | `-av --delete` | Yes | No | Remote planner reads files |
| **backup** | `/E` | `-av` (no `--delete`) | **No** | Owner opt-in | Off-site file safety |
| **portability** | `/MIR` | `-av --delete` | Yes | No | Second machine / USB handoff |

Agents **must confirm purpose** when the owner says "backup" — do not run
review-mirror `/MIR` without warning.

## OwnerPreferences Ownership

`Workspace/OwnerPreferences.md` § **Connectors** (or § **Mirrors** when split)
holds instance paths and purpose. Platform mirror Capabilities read and write
these rows with owner approval:

| Preference | Role |
| --- | --- |
| Local repository root | SoT path |
| Mirror target path | Primary destination (any folder) |
| Mirror platform | `Windows` \| `Mac` |
| Mirror purpose | `review` \| `backup` \| `portability` |
| Purge on mirror | `yes` \| `no` — **`no` for backup** |
| Include `.git` | `no` \| `yes` — opt-in for backup |
| Dropbox / GDrive mirror root | Legacy or secondary targets; may equal mirror target |
| Last mirror refresh | ISO date after most recent successful apply (any target) |
| Last mirror refresh (Dropbox) | ISO date after successful apply to Dropbox mirror root |
| Last mirror refresh (GDrive) | ISO date after successful apply to Google Drive mirror root |

Do not store credentials in Owner Preferences.

## Default Exclusions

Always exclude from mirror apply (unless owner overrides in Notes):

- `Intake/`, `IncomingIdeas/`
- Build caches, virtualenvs, `node_modules`, temp folders
- Secret file patterns (`.env`, keys, tokens)

Exclude `.git/` by default. Include only when **Include `.git`** is `yes` and
owner approved backup purpose.

## Robocopy Exit Codes (Windows)

Codes **0–7** usually mean success or acceptable differences. Code **3** means
files copied **and** extras removed — normal for `/MIR`, not a failure.
Codes **8 and above** indicate errors — report the log path.

## rsync Exit Codes (Mac)

Exit code **0** = success. Non-zero = error — report the log path. When using
`--delete`, removed files on destination are expected for review/portability purpose.

## Runnable Capabilities

| Platform | Capability | Apply |
| --- | --- | --- |
| Windows | `Capabilities/MirrorToWindows/` | `Automation/RepositoryMirror/Run-WindowsMirror.cmd` |
| Mac | `Capabilities/MirrorToMac/` | `Automation/RepositoryMirror/run-mac-mirror.sh` |

Vendor-named stubs (`MirrorToDropbox`, `MirrorToGoogleDrive`) redirect to
**MirrorToWindows** on Windows and **MirrorToMac** on macOS.

## Connector Capabilities

**DropboxLink** and **GoogleDriveLink** remain **connector/planner only**.
Mirror apply delegates to the platform Capability — not to vendor-named mirror caps.

## Related

- [SourceOfTruthAndMirrorStandard.md](SourceOfTruthAndMirrorStandard.md)
- [../Plans/RepositoryMirrorCapabilityStreamlinePlan.md](../Plans/RepositoryMirrorCapabilityStreamlinePlan.md)
- [../Capabilities/MirrorToWindows/README.md](../Capabilities/MirrorToWindows/README.md)
- [../Capabilities/MirrorToMac/README.md](../Capabilities/MirrorToMac/README.md)
