<!--
IndexTitle: Cross Platform Repository Paths
IndexDescription: Device-appropriate path language for repository instructions; Windows examples labeled as local-primary variants.
IndexType: Standard
IndexStatus: Draft
LastEdited: 2026-06-09
-->

# Cross Platform Repository Paths

Principles only. Runnable setup steps live in Capabilities — not here.

**Draft standard.** Do not treat as Active until owner approves and a non-Windows
path sample is validated.

## Purpose

Reduce Windows-specific assumptions in repository instructions while preserving
local-primary workflows. Derived from
[CrossPlatformCompatibilityNotes.md](../Plans/CrossPlatformCompatibilityNotes.md)
and
[CloudOnlyPlanningAndMeasurementDevicePlan.md](../Plans/CloudOnlyPlanningAndMeasurementDevicePlan.md)
§Repository Behavior.

## Default Wording Rules

1. **Planning and Capability Rules** — use platform-neutral language:
   - "local repository root" not a hardcoded drive path — use `<repositories-root>\<RepositoryName>`
   - "cloud review mirror folder" not `H:\My Drive\...`
   - "terminal" not "PowerShell" unless the operating profile is local-primary

2. **Setup docs and command examples** — may include platform-specific examples
   when labeled:
   - `**Local-primary (Windows):**` before PowerShell blocks
   - `**Local-primary (macOS):**` when tested (future)

3. **Remote-only profiles** — never default to local paths or shell commands.
   Use GitHub web/mobile surfaces (**device-appropriate paths**).

Formal terms: [NamingStandard.md](NamingStandard.md) §Environment-Adaptive Model.

## Operating Profile And Path Language

| Operating profile | Path language |
| --- | --- |
| Remote-only | GitHub repository URL; no local paths |
| GitHub-then-local | GitHub first; local paths only when user adopts clone |
| Dual-surface | Both GitHub URL and local repository root |
| Local-primary | Local repository root + optional mirror paths (labeled per OS) |

## Common Path Patterns (Local-Primary)

Examples are **machine-specific**. Discover or ask; do not assume drive letters.

| Concept | Windows example (labeled) | Neutral term |
| --- | --- | --- |
| Local Git root | `C:\Repositories\GetEstablished` | `<repositories-root>` — see [LocalRepositoriesRoot.md](LocalRepositoriesRoot.md) |
| Google Drive mirror | `H:\My Drive\Repositories\GetEstablished` | `<gdrive-mirror-root>` |
| Dropbox mirror | `%USERPROFILE%\Dropbox\Repositories\GetEstablished` | `<dropbox-mirror-root>` |

Path discovery plans: `Plans/GoogleDrivePathDiscoveryPlan.md` (deferred),
`Plans/DropboxLocalBridgePathDiscoveryPlan.md`.

## Mostly Cross-Platform By Nature

These areas should avoid platform-specific assumptions:

- Repository folder structure
- Markdown documentation, prompts, and planning files
- GitHub web workflow (Issues, PRs, file edit)
- Website source content in `Content/`

## Outside Scope

- Excel/VBA workflows
- macOS automation scripts (not approved yet)
- Environment auto-detection logic (deferred Capability extension)

## Related

- [LocalRepositoriesRoot.md](LocalRepositoriesRoot.md)
- [CrossPlatformCompatibilityNotes.md](../Plans/CrossPlatformCompatibilityNotes.md)
- [CloudOnlyPlanningAndMeasurementDevicePlan.md](../Plans/CloudOnlyPlanningAndMeasurementDevicePlan.md)
- [AgentSituationalAwareness.md](AgentSituationalAwareness.md)
- [SourceOfTruthAndMirrorStandard.md](SourceOfTruthAndMirrorStandard.md)
