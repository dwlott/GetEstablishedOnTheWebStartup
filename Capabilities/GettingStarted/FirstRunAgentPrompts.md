<!--
IndexTitle: First Run Agent Prompts
IndexDescription: Quick Startup prompts for confirmed adopted copies, template smoke tests, and resumed projects.
IndexType: Capability
CapabilityName: GettingStarted
IndexStatus: Active
LastEdited: 2026-10-11
-->

# First Run Agent Prompts

**Begin Quick Startup from AGENTS.md** is the deterministic trigger. It means
the first-session workflow, not an app launch. Replace the project path below
with the folder you actually opened.

## New Adopted Project — Codex, Cursor, Or Claude Code

```text
Repository folder: C:\Repositories\<YourProjectName>
This is my new project copied from GetEstablishedOnTheWebStartup.

Begin Quick Startup from AGENTS.md. This is not an app launch.

Read AGENTS.md, Standards/AgentSituationalAwareness.md, and GettingStarted's
Rules.md, GettingStarted.md, WorkspaceAdoptionPrep.md, and
RepositoryIdentityTemplate.md. Verify the active root and classify it before
changes. Preserve the canonical Startup, product, and established projects.
In this confirmed adopted copy, clear only stale template setup and detach
stale starter Git. Preserve goals already captured for this project and any
project-owned remote. Missing .git is a valid state; do not create Git yet.

Display QuickStartupGreeting.md's opening and five questions once as a preview.
Follow QuickStartupWalkthrough.md: ask one unanswered question at a time with
Question N of 5, wait for the answer, save progress, and lead into the next.
One clear outcome is enough; reuse supplied facts and accept skips or deferrals.
Resume Workspace/QuickStartupProgress.md rather than repeating answered questions.
Combine environment discovery with question 4; ask only for missing information.
If this is an existing website, use ExistingWebsiteStartup.md to establish the
missing local/live and work-scope facts before proposing changes.
Capture goals and preferences as answers arrive. References are optional when
useful. Offer indexing through its benefit and create it only after acceptance.
Leave GitHub until requested. Finish required adopted identity checks and close
with the owner's first priority and one concrete next action.

Complete Workspace/RepositoryIdentity.md using its seven required fields.
Rewrite only allowlisted active identity surfaces and preserve intentional
source-template, historical, packaging, and related-repository references.
Run Automation/Test-AdoptedRepositoryIdentity.ps1 and resolve failures.
Include changed identity files in any accepted index refresh. Close with a
plain owner-facing summary, including identity verification and indexing state.
```

## Packaging Smoke Test

Create a temporary new copy with `Automation/Copy-StartupToProject.ps1` from
the canonical Startup checkout (use that checkout if the product lacks the helper), then
use the new-project prompt above **in that copy**. Do not perform adopted
resets or Git detach in the canonical Startup checkout. A readiness check
does not authorize public distribution, WordPress writes, or production launch.

To check the canonical template's package structure, run these commands from
the Startup checkout where the verification scripts are supplied:

```powershell
.\Automation\VerifyStarterPackage.ps1 -Root (Get-Location).Path -Profile WebPresenceWordPress
.\Automation\Test-AdoptedRepositoryIdentity.ps1 -Root (Get-Location).Path
```

## Resume An Established Project

```text
Repository folder: C:\Repositories\<YourProjectName>
This is an established project. Read AGENTS.md, Workspace/RepositoryIdentity.md
if present, the owner registers, Workspace/QuickStartupProgress.md if present,
and Plans/AgentTaskBacklog.md. Resume a partial interview at its next prompt. Preserve existing
goals, preferences, Git history, and remote. Continue the recorded next task;
do not repeat new-copy resets or infer adoption from the folder name.
```

## Claude Code Memory Awareness

Read the owner registers before trusting profile memory. Repository decisions
win over conflicting memory. Store durable decisions in the repo first; any
profile memory should agree with them. See
[ClaudeCode.md](../LocalAgentToolSetup/Vendors/ClaudeCode.md).

## ChatGPT With Read-Only Repository Access

```text
Read AGENTS.md, GettingStarted.md, and QuickStartupWalkthrough.md through the
connected repository. Show the five-question preview once, then guide one
unanswered question at a time and wait for each answer. One outcome is enough.
Reuse facts, accept skips/deferrals, and supply a compact unsaved checkpoint so
we can resume. Draft Owner Goals from my answers; do not edit files from
read-only access. Close with my priority and one concrete next action.
```

## Prior Repository Material

Record the source path in `Workspace/OwnerPreferences.md`. Inspect local routing
before selecting an import capability; do not route to modules absent from this
starter. Review the proposed files and obtain owner authorization before copying.

## Related

- [HowToAdoptThisStarter.md](HowToAdoptThisStarter.md)
- [WorkspaceAdoptionPrep.md](WorkspaceAdoptionPrep.md)
- [RepositoryIdentityTemplate.md](RepositoryIdentityTemplate.md)
- [GettingStarted.md](GettingStarted.md)
- [PostQuickStartupRouting.md](PostQuickStartupRouting.md)
