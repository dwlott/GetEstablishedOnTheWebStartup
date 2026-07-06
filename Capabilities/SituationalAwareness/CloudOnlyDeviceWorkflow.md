<!--
IndexTitle: Remote-Only Device Workflow
IndexDescription: Task routing for remote-only and GitHub-then-local profiles; device-appropriate paths on phones, tablets, and browser-only devices.
IndexType: Capability
CapabilityName: SituationalAwareness
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-09
-->

# Remote-Only Device Workflow

Filename `CloudOnlyDeviceWorkflow.md` kept for link stability.

Route work when operating profile is **Remote-only** or **GitHub-then-local**
and the user cannot run local agents.

Formal terms: [NamingStandard.md](../../Standards/NamingStandard.md)
§Environment-Adaptive Model.

Planning source:
[CloudOnlyPlanningAndMeasurementDevicePlan.md](../../Plans/CloudOnlyPlanningAndMeasurementDevicePlan.md).

## Authority

- **GitHub-primary collaboration** until a local clone exists.
- Use **device-appropriate paths** — do not require Dropbox, Google Drive,
  PowerShell, or local paths for remote-only profiles.
- Private repositories are valid; public is optional.

See [SourceOfTruthAndMirrorStandard.md](../../Standards/SourceOfTruthAndMirrorStandard.md)
§When No Local Clone Exists.

## Good Tasks On Non-Local-Agent Devices

| Task | Route |
| --- | --- |
| Goal capture | GettingStarted → `Workspace/OwnerGoals.md` (or Issue/chat until writable) |
| Idea capture | ChatMemoryCapture, ChatToMarkdown, InstructionCapture |
| Business planning | GettingStarted, UserDiscoveryPrompt |
| Review hosted-agent work | GitHubWorkflow → Issues/PR review |
| Decision logs | ChatMemoryCapture; GitHub file edit or Issue |
| Progress / success updates | OwnerGoals register; `Workspace/OwnerMilestones.md` |
| Guide agent activity | GitHub Issues, PR comments, hosted-agent assignment |
| Approve or reject plans | Owner reply; PR review on GitHub |

## Poor Tasks — Redirect Or Defer

| Task | Instead |
| --- | --- |
| Run local scripts | Assign to hosted agent via GitHub; or defer until local clone |
| Maintain local mirrors | Skip; mirrors never required for remote-only |
| Run index builders | Defer to hosted-agent PR or local clone later |
| PowerShell / `C:\Repositories` setup | Use GitHub-primary workflow per CloudOnlyGitHubWorkflow |
| Complex merge conflict resolution | Hosted agent or defer until desktop available |

## Capability Routing Table

| Profile | Primary | Skip unless requested |
| --- | --- | --- |
| Remote-only | GitHubWorkflow, ChatMemoryCapture, GettingStarted | DropboxLink, GoogleDriveLink, LocalAgentToolSetup |
| GitHub-then-local | Same as remote-only | Local clone steps until user adopts |
| Dual-surface | GettingStarted, GitHubWorkflow, AssistedAgenticWorkflow | — |
| Local-primary | GettingStarted, GitHubWorkflow, LocalAgentToolSetup | — |

## Device-Appropriate Instruction Variants

**Do show:** Open GitHub, create Issue, review PR, add planning note, capture
idea, summarize next action.

**Do not show by default:** Open PowerShell, `cd C:\Repositories`, robocopy, drive
letter paths, mirror sync.

Label Windows/PowerShell steps as **local-primary** when mentioned for upgrade
path only.

## Upgrade To Local

When the user later clones:

1. Local Git becomes source of truth per standard hierarchy.
2. Enable LocalAgentToolSetup, optional mirrors, AssistedAgenticWorkflow.
3. No migration of GitHub-era content — clone continues from GitHub history.

## Related

- [EnvironmentDetectionQuestions.md](EnvironmentDetectionQuestions.md)
- [CloudOnlyGitHubWorkflow.md](../GitHubWorkflow/CloudOnlyGitHubWorkflow.md)
- [ChatMemoryCapture/Rules.md](../ChatMemoryCapture/Rules.md)
- [Rules.md](Rules.md)
