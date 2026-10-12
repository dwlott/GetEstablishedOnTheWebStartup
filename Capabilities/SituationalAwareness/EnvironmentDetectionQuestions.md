<!--
IndexTitle: Environment Detection Questions
IndexDescription: Short environment interview for operating profile recommendation; extends SituationalAwareness for user device layer.
IndexType: Capability
CapabilityName: SituationalAwareness
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-10-11
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

## Quick Startup integration

During Quick Startup, use this bank at setup question 4, not as another
interview. Inspect available environment facts read-only, reuse the owner's
answers, and ask only for missing details needed by the next action, one at a
time. Do not require GitHub/cloud setup or every field in the bank. Record
relevant facts in OwnerPreferences.md; use OwnerEnvironment.md if present or
needed for a profile-aware capture. See
[QuickStartupWalkthrough.md](../GettingStarted/QuickStartupWalkthrough.md).

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
At Quick Startup question 4, use the existing answers and inspect accessible
environment facts read-only. Ask one missing detail at a time only when it
affects our next action. Do not repeat the startup interview or require GitHub
and cloud setup. Recommend a workable profile in plain language and save the
facts in the appropriate owner register. Then continue the saved walkthrough.
```

## Related

- [CloudOnlyDeviceWorkflow.md](CloudOnlyDeviceWorkflow.md)
- [Rules.md](Rules.md)
- [GettingStarted/Rules.md](../GettingStarted/Rules.md)
- [AgentSituationalAwareness.md](../../Standards/AgentSituationalAwareness.md)

