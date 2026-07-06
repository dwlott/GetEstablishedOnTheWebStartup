<!--
IndexTitle: Owner Preferences
IndexDescription: Durable register for owner-specific settings, connector choices, and import decisions.
IndexType: Workspace
IndexStatus: Active
LastEdited: 2026-06-19
-->

# Owner Preferences

This file is the durable home for **Owner Preferences** — instance settings for
this workspace. It is separate from **Owner Goals** in `Workspace/OwnerGoals.md`
and from reusable workflow rules in `Capabilities/`.

Do not store credentials, tokens, or API secrets here.

## How To Use

1. Capture preferences during **Quick Startup** or when choosing connector behavior.
2. Agents read this file before connector, import, or intake passes.
3. Update only with owner approval.

## Connectors

| Preference | Value | Notes |
| --- | --- | --- |
| Mirror mode | on-demand | Default: no automatic cloud copy after local edits |
| Local repository root | `C:\Repositories\GetEstablishedOnTheWebStartup` | Update to your adopted path |
| Mirror target path | *(not set)* | Set when owner chooses backup or review mirror |
| Mirror platform | *(not set)* | Windows typical; see MirrorToWindows |
| Mirror purpose | *(not set)* | backup or review |
| Purge on mirror | no | Confirm with owner |
| Include `.git` | no | Opt-in for backup only |
| Last mirror refresh | *(none yet)* | |

## Intake

| Preference | Value | Notes |
| --- | --- | --- |
| Email incoming path | *(not set)* | When EmailIntake is adopted |
| Scan incoming path | *(not set)* | When ScanIntake is adopted |
| Archive move policy | owner approval required | |

## Decisions

| Decision | Source | Status |
| --- | --- | --- |
| *(add during Quick Startup)* | | Open |

## Related

- [OwnerGoals.md](OwnerGoals.md)
- [../Capabilities/MirrorToWindows/README.md](../Capabilities/MirrorToWindows/README.md)
