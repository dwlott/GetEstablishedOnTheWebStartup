<!--
IndexTitle: Profile-Aware Quick Startup Prompt
IndexDescription: Copy-ready Quick Startup with environment interview and operating profile recommendation.
IndexType: Prompt
IndexStatus: Active
LastEdited: 2026-06-09
-->

# Profile-Aware Quick Startup Prompt

Use when the user's device or environment is unknown, or when they may be on
phone, tablet, Chromebook, or browser-only.

Formal terms: [NamingStandard.md](../../Standards/NamingStandard.md)
§Environment-Adaptive Model.

```text
Start Quick Startup with environment awareness.

Read AGENTS.md and Capabilities/GettingStarted/GettingStarted.md.

1. Ask briefly about my environment (device, OS, Git/GitHub access, cloud tools,
   technical comfort, workflow preference). Use
   Capabilities/SituationalAwareness/EnvironmentDetectionQuestions.md — keep it
   short, not a long form. Persist results to Workspace/OwnerEnvironment.md.

2. If I have files to help get started (screenshots, logo, existing copy, prior
   material), offer to accept them — optional, not required. Route per
   EnvironmentDetectionQuestions.md §Optional Uploads.

3. Recommend an operating profile: Remote-only, GitHub-then-local, Dual-surface,
   or Local-primary.

4. Capture three to five Owner Goals for Workspace/OwnerGoals.md (or a copy-ready
   block if I have no local clone yet).

5. Route exactly one next task using the profile-appropriate Capabilities:
   - Remote-only / GitHub-then-local: GitHubWorkflow (CloudOnlyGitHubWorkflow), ChatMemoryCapture
   - Dual-surface: GettingStarted + GitHubWorkflow
   - Local-primary: GettingStarted + optional LocalAgentToolSetup

6. Use device-appropriate paths — do not require PowerShell, local paths, or
   cloud mirror sync unless I chose Local-primary and have a local clone.

7. Private GitHub repository is fine; do not require public visibility.
```

## Related

- [Rules.md](Rules.md)
- [FirstRunAgentPrompts.md](FirstRunAgentPrompts.md)
- [EnvironmentDetectionQuestions.md](../SituationalAwareness/EnvironmentDetectionQuestions.md)
- [CloudOnlyPlanningAndMeasurementDevicePlan.md](../../Plans/CloudOnlyPlanningAndMeasurementDevicePlan.md)

