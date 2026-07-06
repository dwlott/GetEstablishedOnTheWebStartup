<!--
IndexTitle: GitHub-Primary Workflow (No Local Clone)
IndexDescription: GitHub-centric workflow for remote-only and GitHub-then-local profiles; Issues, PR review, private repo startup.
IndexType: Capability
CapabilityName: GitHubWorkflow
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-09
-->

# GitHub-Primary Workflow (No Local Clone)

Filename `CloudOnlyGitHubWorkflow.md` kept for link stability.

For **Remote-only** and **GitHub-then-local** operating profiles when the user
has no local clone or local Git.

Formal terms: [NamingStandard.md](../../Standards/NamingStandard.md)
§Environment-Adaptive Model.

Planning source:
[CloudOnlyPlanningAndMeasurementDevicePlan.md](../../Plans/CloudOnlyPlanningAndMeasurementDevicePlan.md).

## Principles

- **GitHub-primary collaboration** — private repository is a valid start; public is optional.
- **GitHub** is the working collaboration surface until first local clone.
- Hosted agents edit via PRs; the **owner reviews and merges**.
- **Device-appropriate paths** — no PowerShell or local path steps by default.

## Startup (No Local Clone)

1. Create or open a **private** GitHub repository (or use GitHub template).
2. State Owner Goals in chat; capture to `Workspace/OwnerGoals.md` when a
   hosted agent or later local pass can write files.
3. Use GitHub Issues for task briefs to hosted agents.
4. Review Pull Requests on GitHub web or mobile.

See [BeginnerGitHubOnboarding.md](BeginnerGitHubOnboarding.md) for tool roles.

## Typical Remote-Only Loop

```text
1. Owner captures goal or idea (chat, Issue, or mobile note)
2. Owner opens GitHub Issue describing the scoped task
3. Hosted agent opens PR against the repository
4. Owner reviews diff on GitHub (web or mobile)
5. Owner merges or requests changes
6. Owner updates Owner Goals / progress notes
```

## Good Instructions (Device-Appropriate)

- Open the repository on GitHub.
- Create an Issue with a clear task brief.
- Review the Pull Request file tab.
- Add a comment approving or requesting changes.
- Merge when satisfied.
- Use GitHub mobile for quick review on phone or tablet.

## Avoid By Default

- `cd C:\Repositories\...`
- Open PowerShell or terminal.
- `git clone` unless user is upgrading to local-primary.
- Dropbox or Google Drive mirror setup.

## Upgrade Path

When the user adopts a local clone, switch to standard GitHubWorkflow Rules
(**local-primary**). Local Git becomes source of truth; GitHub remains backup.

## Related

- [Rules.md](Rules.md)
- [BeginnerGitHubOnboarding.md](BeginnerGitHubOnboarding.md)
- [CloudOnlyDeviceWorkflow.md](../SituationalAwareness/CloudOnlyDeviceWorkflow.md)
- [SourceOfTruthAndMirrorStandard.md](../../Standards/SourceOfTruthAndMirrorStandard.md)
