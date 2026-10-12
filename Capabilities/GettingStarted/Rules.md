<!--
IndexTitle: GettingStarted Rules
IndexDescription: Boundaries and routing rules for the first getting-started path.
IndexType: Capability
CapabilityName: GettingStarted
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-10-11
-->

# GettingStarted Rules


## Workspace Adoption Prep (First)

When **Begin Quick Startup from AGENTS.md** fires, read
[WorkspaceAdoptionPrep.md](WorkspaceAdoptionPrep.md) before the greeting.
Classify the active root using [RepositoryIdentityTemplate.md](RepositoryIdentityTemplate.md).
Run resets and Git detach only in a confirmed adopted Startup copy. Preserve
the canonical Startup, the product repository, and established projects.
Folder name alone never authorizes adoption mutations.

- Prefer copies made without `.git` using `Automation/Copy-StartupToProject.ps1`.
- Confirm a noncanonical folder is the owner's adopted copy if it has no
  adopted-project identity record. An owner statement in this session counts.
- In that confirmed copy, reset only stale template content. Preserve goals
  and preferences already captured for the project or a resumed session.
- If stale starter Git metadata remains, detach it automatically as documented;
  do not present a blocking Git menu. Preserve the project's own Git remote.
- If `.git` is absent, record that and continue without Git commands.
- State what prep did, then display [QuickStartupGreeting.md](QuickStartupGreeting.md).

## Repository Identity Cleanup (Last Operational Step)

After goals and preferences, and the optional indexing decision, every
confirmed adopted project must create or complete `Workspace/RepositoryIdentity.md`.
Use the seven-field schema and active-surface allowlist in
[RepositoryIdentityTemplate.md](RepositoryIdentityTemplate.md), then run:

```powershell
.\Automation\Test-AdoptedRepositoryIdentity.ps1 -Root (Get-Location).Path
```

Preserve intentional source-template, packaging, historical, and related-repo
references. Skip this adopted rewrite in both canonical repositories.
Resolve missing identity information before declaring Quick Startup complete.

## Core Rule

GettingStarted should reduce first-session friction without turning startup
into a full business plan, platform decision, website build, or questionnaire.

Ask for enough direction to route the next task, then use the existing
repository docs and Capabilities.

## Required Distinction

Keep these goal types separate:

| Goal type | Meaning | Home |
| --- | --- | --- |
| Owner Goals | Practical outcomes the owner wants from setup; refined as they work | **Quick Startup** capture; durable home: `Workspace/OwnerGoals.md` |
| Repository Goals | Core durable Goals set for this learning repository | `Plans/RepositoryGoals.md` |

**Quick Startup** is the owner-facing name for the first-session path through
this Capability: orient, capture one or more Owner Goals, route the next task.

Owner Goals route early setup work. Repository Goals govern how the learning
repository stays organized, indexed, reusable, and safe.

## First Setup Questions

**Canonical preview:** [QuickStartupGreeting.md](QuickStartupGreeting.md).
**Interview protocol:** [QuickStartupWalkthrough.md](QuickStartupWalkthrough.md).

Show all five questions once, then ask one unanswered question at a time with
Question N of 5 and a short topic. Wait for the actual answer, save progress,
and lead into the next without making the owner copy questions or type "next."
Reuse supplied facts and accept explicit skips or deferrals. One concrete goal
is enough; additional goals are optional. Never invent outcomes to reach a quota.

Question 1 identifies existing-site maintenance, new work, or another direction.
For an existing site, use [ExistingWebsiteStartup.md](ExistingWebsiteStartup.md)
for only missing maintenance context. Audience/offer discovery belongs after
startup when it is useful to the owner's actual task.

## Profile-Aware Quick Startup

Combine environment discovery with setup question 4. Inspect accessible
paths, OS/runtime, and tools read-only; distinguish observed facts from owner
preferences. Ask only about missing details needed for the next action, one at
a time. Do not add a separate environment questionnaire or ask again about
tools already supplied. Persist relevant facts to `OwnerPreferences.md`; use
`OwnerEnvironment.md` when that register exists or a profile-aware capture
needs it. No new Workspace folder is required.

Use [EnvironmentDetectionQuestions.md](../SituationalAwareness/EnvironmentDetectionQuestions.md)
as a question bank and [EnvironmentAwareStartupPrompt.md](EnvironmentAwareStartupPrompt.md)
as the same interview's device-aware variant. Recommend a profile in plain
language using [CloudOnlyDeviceWorkflow.md](../SituationalAwareness/CloudOnlyDeviceWorkflow.md).
Do not impose local PowerShell or cloud mirrors on browser-only users. GitHub
setup and cloud review remain optional unless they are the owner's stated task.

## Valuable References (After Goals)

Add suggested links or search terms only when useful to the actual goal,
with what each source is for and `Confidence: Suggested`, in
`Workspace/ValuableReferences.md`. There is no minimum number of references.
Use the external information ladder from SituationalAwareness rather than
telling the owner to go find a URL unaided. Offer review only when it helps;
do not block startup or create a research detour to fill a quota.

Optional choices follow [QuickStartupWalkthrough.md](QuickStartupWalkthrough.md).
Indexing gets one benefit-based offer, unless a preference is already recorded.
Set up missing indexes only after acceptance. GitHub waits until requested.
Ask at most one optional question at a time; preserve unanswered decisions as
unanswered rather than inventing consent, rejection, or deferral.

## Routing From Owner Goals

| Owner goal signal | Route first |
| --- | --- |
| Existing website maintenance | [ExistingWebsiteStartup.md](ExistingWebsiteStartup.md); inspect the current registry before selecting implementation |
| Basic orientation | `Capabilities/GettingStarted/GettingStarted.md`, then `Plans/UserSetupGuide.md` |
| Cursor demo / recording | `Plans/OneWindowCursorDemoScript.md`, `Plans/CursorYouTubeDemoGuide.md` |
| GitHub setup or sync | `GitHubWorkflow` Capability |
| Agent app setup | `LocalAgentToolSetup` Capability |
| Cloud handoff when ChatGPT plans without repo access | `GoogleDriveLink` (assisted workflow); in Cursor, read repo directly |
| OneDrive / phone capture (planning) | `OneDriveLink` (Planned) |
| Website draft review | `ContentReview` Capability |
| Identity, audience, offer, proof, or first pages | `Capabilities/GettingStarted/UserDiscoveryPrompt.md` |
| Business-plan inputs; North Star goal capture | `BusinessPlan` Capability (`Capabilities/BusinessPlan/Prompt.md`) |
| Save important chat decisions | `InstructionCapture` or `ChatToMarkdown` as appropriate |
| Prior repo, archive, or import from old folder | Record source path; inspect local routing, review proposed files, and obtain authorization before copying |

If no owner goals are available, ask for one or more practical setup goals
before selecting optional Capabilities.

## Situational Awareness (Cloud Versus Cursor)

Mirror [AgentSituationalAwareness.md](../../Standards/AgentSituationalAwareness.md):

- **Cursor with repo open:** read and edit local Git directly. Do not invoke
  `GoogleDriveLink` or copy to cloud on Quick Startup unless the owner explicitly
  requests review sync for a ChatGPT planner session.
- **ChatGPT plans without repo access:** use `GoogleDriveLink` (assisted workflow)
  when the owner needs a cloud review mirror — not the default for every pass.

## Claude Profile Memory (When Offered)

When **Claude Code** offers to save session memory or recalls profile memory
at session start:

1. Read repo registers first — [ClaudeCode vendor sheet](../LocalAgentToolSetup/Vendors/ClaudeCode.md).
2. **Repo wins** over profile memory when they conflict.
3. Record durable decisions in `Workspace/OwnerGoals.md`,
   `Workspace/OwnerPreferences.md`, or `Workspace/ValuableReferences.md` —
   not profile-only.
4. Offer owner choice: repo only | repo + aligned memory | skip.

During Quick Startup, if the owner already consented to startup, **proceed** to
questions — do not re-ask "run Quick Startup now?"

## Session Close (Not A Planner Handoff)

Quick Startup ends with an **owner-facing session summary** in plain chat — not
a fenced worker handoff block.

- **Default:** assume **no planning agent** is waiting. The owner (or the same
  agent in a later chat) may continue when ready.
- Use the close shape in [PostQuickStartupRouting.md](PostQuickStartupRouting.md)
  § Quick Startup complete.
- Offer **one suggested next step** as optional ("now or later") — not a mandate
  for another agent to pick up.
- Use the standard fenced handoff block (`Summary`, `Files Changed`, …) **only**
  when the owner explicitly requested **PlannerWorker** or
  **AssistedAgenticWorkflow** — see
  [PlannerWorkerWorkflow.md](../AssistedAgenticWorkflow/PlannerWorkerWorkflow.md).

## Data Boundaries

- Do not invent owner facts, business claims, legal claims, pricing, proof, or
  final public copy.
- Do not store credentials, tokens, API keys, OAuth secrets, or private account
  details in the repository.
- Do not save owner goals or owner preferences into Capability files.
- Store connector, intake, mirror, and import settings in
  `Workspace/OwnerPreferences.md` unless the owner explicitly promotes a
  pattern into a Capability.
- Store candidate and approved external URLs in `Workspace/ValuableReferences.md`
  only — not in Capability `Rules.md` or chat-only lists.
- Do not create `Workspace/` subfolders during normal GettingStarted operation unless the owner approves the specific structure.
- If owner goals need a durable file, use `Workspace/OwnerGoals.md` or another
  approved owner-owned destination. Keep reusable workflow rules in this
  Capability.

## Scope Boundaries

GettingStarted may:

- clarify read-first paths;
- update setup navigation;
- run Workspace Adoption Prep (including Git detach on adopted copies);
- offer **Indexing Setup** when `Indexes/` is absent; create it only when
  the owner accepts, then refresh through **ManualIndexing**; refresh existing
  indexes when needed;
- route the next task to an existing Capability or prompt;
- keep setup guidance beginner-friendly;
- update planning notes when a getting-started decision is resolved.

GettingStarted must not:

- build the website;
- choose a platform;
- add dependencies or automation;
- create Skills or runtime adapters;
- provision Workspace project folders beyond documented intake paths;
- move owner content;
- commit or push unless explicitly instructed;
- block Quick Startup on a Git-remote multiple-choice.

## Good Enough Standard

A first getting-started pass is complete when:

- the user knows the first priority and concrete next action, or has explicitly deferred choosing an outcome;
- each setup question is covered or explicitly skipped/deferred, and the checkpoint is saved when write access exists;
- at least one owner goal is captured, or all outcomes are explicitly deferred and reported as undecided;
- suggested references are captured only when useful to the actual task;
- indexing is completed when accepted, or its actual optional-choice state is recorded without blocking startup;
- every confirmed adopted project has a verified `Workspace/RepositoryIdentity.md`;
- Repository Goals remain separate and linked;
- the next setup task is routed to one existing guide, prompt, or Capability;
- no unapproved structure, platform, automation, or publishing decision is
  introduced.

## Related

- [AgentSituationalAwareness.md](../../Standards/AgentSituationalAwareness.md)
- [WorkspaceAdoptionPrep.md](WorkspaceAdoptionPrep.md)
- [QuickStartupGreeting.md](QuickStartupGreeting.md)
- [EnvironmentAwareStartupPrompt.md](EnvironmentAwareStartupPrompt.md)
- [OwnerGoalOperatingLoop.md](OwnerGoalOperatingLoop.md)
- [EnvironmentDetectionQuestions.md](../SituationalAwareness/EnvironmentDetectionQuestions.md)
- [ReferenceReviewPrompt.md](ReferenceReviewPrompt.md)
- [Prompt.md](Prompt.md)
- [GettingStarted.md](GettingStarted.md)
- [UserSetupGuide.md](../../Plans/UserSetupGuide.md)
- [RepositoryGoals.md](../../Plans/RepositoryGoals.md)
- [AgentCapabilityGuide.md](../AgentCapabilityGuide.md)
- [LocalAgentToolSetup/Vendors/ClaudeCode.md](../LocalAgentToolSetup/Vendors/ClaudeCode.md)
