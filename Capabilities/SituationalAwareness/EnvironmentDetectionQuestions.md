<!--
IndexTitle: Environment Detection Questions
IndexDescription: Short environment interview for operating profile recommendation; extends SituationalAwareness for user device layer.
IndexType: Capability
CapabilityName: SituationalAwareness
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-09
-->

# Environment Detection Questions

Use at Quick Startup or when local-only instructions would misfire. Keep the
interview **short** — not a full intake form. Stop when you can recommend an
operating profile.

Formal terms: [NamingStandard.md](../../Standards/NamingStandard.md)
§Environment-Adaptive Model.

Planning source:
[CloudOnlyPlanningAndMeasurementDevicePlan.md](../../Plans/CloudOnlyPlanningAndMeasurementDevicePlan.md).

Persist answers in `Workspace/OwnerEnvironment.md` (ENV-1 resolved 2026-06-09:
durable register; chat reads and updates it).

## Interview Questions

Ask only what you do not already know from context:

| # | Field | Question |
| --- | --- | --- |
| 1 | Device type | What device are you using right now? (phone, tablet, laptop, desktop) |
| 2 | Operating system | Which OS? (Windows, macOS, Linux, ChromeOS, iOS, Android, other) |
| 3 | Browser-only capability | Can you work only through a browser, or do you have a full desktop environment? |
| 4 | Local workstation | Do you have a computer available for repository work? |
| 5 | Git availability | Can you install and run Git on a machine you use? |
| 6 | GitHub availability | Can you access GitHub? Do you have a repository (private is fine)? |
| 7 | Cloud services | Which cloud services can you use? (GitHub, Google Drive, Dropbox, OneDrive) |
| 8 | Dropbox | Is Dropbox available for optional review sync? |
| 9 | Google Drive | Is Google Drive available for optional review sync? |
| 10 | Technical comfort | Beginner, comfortable reviewer, or power user comfortable with terminal? |
| 11 | Workflow preference | Phone-first, GitHub-primary, dual-surface, or local-primary? |
| 12 | Local-agent capability | Can you run Cursor, Codex, Claude Code, or similar on a machine you use? |
| 13 | Hosted-agent capability | Can hosted agents work on your GitHub repo (Apps, hosted agents, PR review)? |

## Optional Uploads

During profile-aware startup (ENV-2), after the short interview or in parallel
with Owner Goals capture, **offer** optional uploads if the user has material
that would help get started. Do not require uploads.

Good candidates:

- Screenshots or photos (business, workspace, examples)
- Logo or brand assets
- Existing copy, flyers, or one-pagers
- Prior notes or planning documents
- Archive or folder path for import (route to GettingStarted import steps)

Route by device:

- **Local-primary / Dual-surface:** `Intake/` or `Ideas/` per owner choice;
  mention Git commit when appropriate.
- **Remote-only / GitHub-then-local:** chat attachment, GitHub upload, or
  cloud link the agent can reference; record summary in `OwnerEnvironment.md`
  Notes or `Ideas/` when repo access exists.

## Operating Profile Recommendation

| Signals | Recommended profile |
| --- | --- |
| No local agent; phone/tablet/browser-only | **Remote-only** |
| No local agent now; may clone later | **GitHub-then-local** |
| Local machine + GitHub access from early on | **Dual-surface** |
| Capable local workstation; local agents preferred | **Local-primary** |

State the recommended profile in plain language. Route per
[CloudOnlyDeviceWorkflow.md](CloudOnlyDeviceWorkflow.md).

## Copy-Ready Prompt Block

```text
Before we pick the next task, help me understand your environment briefly.

1. What device and OS are you on?
2. Can you use Git or a local code editor, or mainly browser/GitHub?
3. Do you have a GitHub repository (private is fine)?
4. Any cloud tools you already use (Drive, Dropbox)?
5. Do you prefer phone-first, GitHub-primary, or local-primary work?
6. Do you have screenshots, a logo, or existing copy to share? (Optional.)

Recommend an operating profile: Remote-only, GitHub-then-local, Dual-surface,
or Local-primary. Persist to Workspace/OwnerEnvironment.md. Then route one next task.
```

## Related

- [CloudOnlyDeviceWorkflow.md](CloudOnlyDeviceWorkflow.md)
- [Rules.md](Rules.md)
- [GettingStarted/Rules.md](../GettingStarted/Rules.md)
- [AgentSituationalAwareness.md](../../Standards/AgentSituationalAwareness.md)

