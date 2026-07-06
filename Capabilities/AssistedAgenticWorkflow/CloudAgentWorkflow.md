<!--
IndexTitle: Hosted-Agent PR Workflow
IndexDescription: Owner-supervised pass cycle when hosted agents work against GitHub and the owner reviews Pull Requests without a local workstation.
IndexType: Capability
CapabilityName: AssistedAgenticWorkflow
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-09
-->

# Hosted-Agent PR Workflow

Filename `CloudAgentWorkflow.md` kept for link stability.

Variant of the owner-supervised pass cycle when **hosted agents** implement
changes on GitHub and the **owner reviews Pull Requests** — no local
workstation required.

Formal terms: [NamingStandard.md](../../Standards/NamingStandard.md)
§Environment-Adaptive Model.

Planning source:
[CloudOnlyPlanningAndMeasurementDevicePlan.md](../../Plans/CloudOnlyPlanningAndMeasurementDevicePlan.md).

Distinct from the default AssistedAgenticWorkflow loop (local agent writes,
optional cloud mirror inspection). See [Rules.md](Rules.md) for local passes.

## When To Use

All must be true:

- Operating profile is **Remote-only** or **GitHub-then-local**.
- User has GitHub access (private repository is fine).
- Hosted agent can open PRs against the repository. **Tier 1 platforms** (ENV-4
  resolved 2026-06-09): **Cursor Cloud** for implementation; **GitHub web** for
  owner PR review and merge.
- Owner will review and merge PRs before treating work as complete.

## Authority

- **GitHub-primary collaboration** until local clone exists.
- Owner is final authority on merge, scope, and stop conditions.
- Progress counts when **GitHub matches the claim** (merged PR, expected files
  on default branch).

## Pass Cycle

```text
1. Owner sets scoped task (Issue, chat brief, or PlannerWorkerTaskBriefPrompt)
2. Hosted agent implements against GitHub branch
3. Hosted agent opens Pull Request with summary
4. Owner reviews PR on GitHub (web or mobile)
5. Owner approves, requests changes, or stops
6. On merge: update Owner Goals / milestones; capture decisions via ChatMemoryCapture if needed
7. Owner scopes next pass or stops
```

## Owner Supervision (Remote Variant)

- Same supervision discipline as local AAW: one scoped pass at a time.
- Owner reads PR diff and description before merge.
- Approval of one PR does not authorize unscoped follow-on work.
- Re-pasted handoff summaries: follow SituationalAwareness Rules section 2.

## Task Brief Shape

Use [PlannerWorkerTaskBriefPrompt.md](PlannerWorkerTaskBriefPrompt.md) adapted
for GitHub:

- Repository URL and branch
- Files or areas in scope
- Out of scope
- Success criteria (what the PR should contain)
- Private repo reminder if applicable

## Good Owner Tasks Via Hosted Agent

- Update planning files (`Plans/`, `Ideas/`)
- Add or refine Capability Rules and README content
- Capture Ideas register rows
- Content draft updates
- Index refresh rows (when agent has repo write access)

## Poor Fit — Defer Or Use Local

- Large structural migrations needing local verification
- Automation script testing requiring local shell
- Mirror sync or Dropbox/GDrive setup (optional; not required for remote-only)

## Platform Priority (ENV-4)

Document concrete examples for **tier 1** first:

| Tier | Platform | Role |
| --- | --- | --- |
| 1 | **GitHub web** | PR review, merge, Issues — all remote profiles |
| 1 | **Cursor Cloud** | Hosted-agent implementation passes |
| 2 | GitHub Copilot Workspace | Defer until owner uses it |
| 3 | Other hosted agents | Generic fallback only |

## Boundaries

- Do not require local clone, PowerShell, or mirror sync.
- Do not merge without owner review.
- Do not treat chat-only summaries as merged work.
- When user later clones locally, switch to standard AAW Rules for local passes.

## Related

- [Rules.md](Rules.md)
- [PlannerWorkerTaskBriefPrompt.md](PlannerWorkerTaskBriefPrompt.md)
- [CloudOnlyGitHubWorkflow.md](../GitHubWorkflow/CloudOnlyGitHubWorkflow.md)
- [CloudOnlyDeviceWorkflow.md](../SituationalAwareness/CloudOnlyDeviceWorkflow.md)
- [ChatMemoryCapture/Rules.md](../ChatMemoryCapture/Rules.md)

