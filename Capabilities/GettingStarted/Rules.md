<!--
IndexTitle: GettingStarted Rules
IndexDescription: Boundaries and routing rules for the first getting-started path.
IndexType: Capability
CapabilityName: GettingStarted
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-09
-->

# GettingStarted Rules

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
this Capability: orient, capture three to five Owner Goals, route the next task.

Owner Goals route early setup work. Repository Goals govern how the learning
repository stays organized, indexed, reusable, and safe.

## First Setup Questions

**Canonical greeting and questions:** [QuickStartupGreeting.md](QuickStartupGreeting.md).
Agents **must display that file's opening and five numbered questions** — do not
invent a different set (for example website-only or UserDiscovery-style questions).

Summary (see greeting file for copy-ready blocks):

1. What business, project, or workspace setup are you establishing? (Not website-only.)
2. First three to five outcomes for this workspace → Owner Goals.
3. What matters first in the next few sessions?
4. Devices and agent tools → `Workspace/OwnerPreferences.md`.
5. Prior folder or repository? → path note only; owner approval before any copy.

Stop after the answer is good enough to choose a next task. Route audience/offer
detail to [UserDiscoveryPrompt.md](UserDiscoveryPrompt.md) **after** Owner Goals
when needed — not during this greeting.

## Profile-Aware Quick Startup

When device or environment is unknown — or the user may be on phone, tablet,
Chromebook, or browser-only — use a **short** environment interview before
routing. Formal terms:
[NamingStandard.md](../../Standards/NamingStandard.md) §Environment-Adaptive Model.

1. Run questions from
   [EnvironmentDetectionQuestions.md](../SituationalAwareness/EnvironmentDetectionQuestions.md)
   (not a long intake form). Persist to `Workspace/OwnerEnvironment.md`.
2. **Offer optional uploads** if the user has screenshots, logos, existing copy,
   or prior material to share — see EnvironmentDetectionQuestions §Optional
   Uploads. Not required.
3. Recommend operating profile per
   [CloudOnlyDeviceWorkflow.md](../SituationalAwareness/CloudOnlyDeviceWorkflow.md).
4. Use [EnvironmentAwareStartupPrompt.md](EnvironmentAwareStartupPrompt.md) as
   the copy-ready variant.

**Remote-only / GitHub-then-local:** route to GitHubWorkflow
([CloudOnlyGitHubWorkflow.md](../GitHubWorkflow/CloudOnlyGitHubWorkflow.md)),
ChatMemoryCapture — skip LocalAgentToolSetup and mirror Capabilities unless
requested. Use **device-appropriate paths**.

**Local-primary:** follow standard Quick Startup; optional
[FirstRunStreamlinePlan.md](../../Plans/FirstRunStreamlinePlan.md) consumer path.

Private GitHub repository is a valid start; public is optional.

## Valuable References (After Goals)

Once Owner Goals and direction are clear:

1. Add **two to five** candidate rows to `Workspace/ValuableReferences.md`.
2. Each row needs: URL or search term, title/source, **Used for** (which goal or
   next task), `Confidence: Suggested`, and brief review notes if uncertain.
3. Use the **external information ladder** (SituationalAwareness section 9):
   suggest a URL → else search term + starting site → else record candidate only.
4. Never end with "go find a URL" as the only instruction.
5. Offer optional owner review via [ReferenceReviewPrompt.md](ReferenceReviewPrompt.md).
6. Do not block Quick Startup on reference validation.

Project-specific folders (for example `Study/References/`) may **link to** or
summarize from `ValuableReferences.md`; do not duplicate an unmanaged link dump.

## Routing From Owner Goals

| Owner goal signal | Route first |
| --- | --- |
| Basic orientation | `Capabilities/GettingStarted/GettingStarted.md`, then `Plans/UserSetupGuide.md` |
| Cursor demo / recording | `Plans/OneWindowCursorDemoScript.md`, `Plans/CursorYouTubeDemoGuide.md` |
| GitHub setup or sync | `GitHubWorkflow` Capability |
| Agent app setup | `LocalAgentToolSetup` Capability |
| Cloud handoff when ChatGPT plans without repo access | `GoogleDriveLink` (assisted workflow); in Cursor, read repo directly |
| OneDrive / phone capture (planning) | `OneDriveLink` (Planned) |
| Website draft review | `ContentReview` Capability |
| Identity, audience, offer, proof, or first pages | `Capabilities/GettingStarted/UserDiscoveryPrompt.md` |
| Business-plan inputs; North Star goal capture | `BusinessPlan` Capability (`Capabilities/BusinessPlan/Prompt.md`) |
| Save important chat decisions | `ChatMemoryCapture` or `ChatToMarkdown` as appropriate |
| Prior repo, archive, or import from old folder | **ImportOwnerPreferencesFromRepository** then **ImportCapabilitiesFromRepository** (owner checklist per module) |

If no owner goals are available, ask for three to five practical setup goals
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
- route the next task to an existing Capability or prompt;
- keep setup guidance beginner-friendly;
- update planning notes when a getting-started decision is resolved.

GettingStarted must not:

- build the website;
- choose a platform;
- add dependencies or automation;
- create generated indexes;
- create Skills or runtime adapters;
- provision new folders;
- move owner content;
- commit or push unless explicitly instructed.

## Good Enough Standard

A first getting-started pass is complete when:

- the user can identify the first read path;
- three to five owner goals are requested or captured in chat;
- zero to five **Suggested** valuable reference rows are captured when direction
  implies external canonical sources (optional but encouraged);
- Repository Goals remain separate and linked;
- the next setup task is routed to one existing guide, prompt, or Capability;
- no unapproved structure, platform, automation, or publishing decision is
  introduced.

## Related

- [AgentSituationalAwareness.md](../../Standards/AgentSituationalAwareness.md)
- [CloudOnlyPlanningAndMeasurementDevicePlan.md](../../Plans/CloudOnlyPlanningAndMeasurementDevicePlan.md)
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
