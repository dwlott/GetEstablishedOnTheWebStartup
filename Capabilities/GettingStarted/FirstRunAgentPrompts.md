<!--
IndexTitle: First Run Agent Prompts
IndexDescription: Copy-ready agent prompts for Quick Startup across Cursor, Claude Code, and ChatGPT-style workers.
IndexType: Capability
CapabilityName: GettingStarted
IndexStatus: Active
LastEdited: 2026-06-10
-->

# First Run Agent Prompts

Use when the owner opens a fresh **Get Established Workspace** and wants
**Quick Startup**. These prompts avoid the word **run** (which some agents
map to app-launch skills).

## Preferred Owner Phrases

**Deterministic trigger (smoke tests, Claude-safe):**

- `Begin Quick Startup from AGENTS.md` — match **case-insensitive**; always
  means read `AGENTS.md` then this Capability; **not** an app launch.

Other good phrases:

- `Start Quick Startup from the repo`
- `Lets go through the quick startup`
- `Start up from the repo`

Avoid: `run Quick Startup` (may trigger app-launch skills in Claude). You cannot
reliably override Claude's `/run` by keeping the word **run** in the phrase —
**drop run entirely**.

## Packaging Validation (Full Session — Required After Repair)

Use after StarterRepositoryPackage repair when optimization or release requires
human Quick Startup — not verify-only.

```text
Repository folder: C:\Repositories\GetEstablishedStartup

Begin Quick Startup from AGENTS.md. Full first-session order.
This is not an app launch.

Read AGENTS.md, then Capabilities/GettingStarted/GettingStarted.md and Rules.md.

Display the opening and five setup questions from QuickStartupGreeting.md (do not
invent questions). Wait for owner answers before writing Workspace/OwnerGoals.md.
Then capture three to five Owner Goals from their answers.

Ask about prior repository import; add two to five Suggested rows to
Workspace/ValuableReferences.md when direction implies external sources.

Offer optional reference review; route exactly one next task; park GitHub;
end with the soft indexing offer from GettingStarted.md step 9.
```

## Cursor Or Claude Code (Local Folder — smoke test)

Use the **deterministic trigger** when testing a fresh starter copy:

```text
Repository folder: C:\Repositories\<YourProjectName>

Begin Quick Startup from AGENTS.md. This is not an app launch.

Read AGENTS.md, then Capabilities/GettingStarted/GettingStarted.md.
Proceed through the first-session order — do not ask again whether to run
Quick Startup if I already agreed. Follow through Owner Goals, valuable
reference candidates, and the soft indexing offer.
```

## Cursor Or Claude Code (Local Folder)

```text
Repository folder: C:\Repositories\<YourProjectName>

Start Quick Startup from the repo. This is not an app launch.

Read AGENTS.md, then Capabilities/GettingStarted/GettingStarted.md.

Help me capture three to five Owner Goals in Workspace/OwnerGoals.md.

Then add two to five candidate rows to Workspace/ValuableReferences.md for
likely external sources (URLs or search terms with commentary, Confidence:
Suggested). Do not tell me to "go find a URL" without suggesting a link or
search term first.

Offer optional reference review (ReferenceReviewPrompt.md), then recommend
exactly one focused next task. Do not start GitHub setup unless I ask.

As the last step, offer indexing softly (do not strongly recommend): newly
created files will be indexed by an agent to speed up chat processing; this
works well when the repository is used only a few times a day; if used more
heavily, code-assisted indexing can be offered. Say it's okay to wait and that
you will offer it again when it would help. Record my choice in
Workspace/OwnerPreferences.md; do not block startup on it.
```

## Claude Code — Boot With Memory Awareness

```text
Repository folder: C:\Repositories\<YourProjectName>

Begin Quick Startup from AGENTS.md. This is not an app launch.

Read AGENTS.md and repo registers (Workspace/OwnerGoals.md,
Workspace/OwnerPreferences.md, Workspace/ValuableReferences.md) before
trusting any Claude profile memory from a prior session.

If I already agreed to Quick Startup, proceed through the session order —
do not ask again whether to run Quick Startup now.

At session end, if you offer to save Claude memory, harmonize per
Capabilities/LocalAgentToolSetup/Vendors/ClaudeCode.md: update the repo
for durable decisions first; memory is optional and should complement the repo.
```

## Claude Code (After Quick Startup Complete)

```text
Repository folder: C:\Repositories\<YourProjectName>

Owner Goals are in Workspace/OwnerGoals.md. Skip GitHub for now.

Route the next task through Capabilities/AgentCapabilityGuide.md — prefer
ContentReview on Content/Website/Pages/ or UserDiscoveryPrompt if I have
not clarified my business yet.
```

## ChatGPT (Connected Repo — Read Only First)

```text
Read AGENTS.md and Capabilities/GettingStarted/GettingStarted.md through the
connected repository. Start Quick Startup: explain the five setup questions and
help me draft Owner Goals for Workspace/OwnerGoals.md. Do not edit files yet.
```

## After Quick Startup — Prior Archive Import

```text
Repository folder: C:\Repositories\US1Movers
Source archive: C:\Repositories\US1MoversArchive

Owner Goals are in Workspace/OwnerGoals.md.

Import owner preferences from the source archive into Workspace/OwnerPreferences.md
only. Do not write preferences into Capability Rules.md.

Then present the capability module checklist from
Plans/RepositoryImportPilotPlan.md (or ImportCapabilitiesFromRepository).
Wait for my approval per module before copying.

Start with ImportOwnerPreferencesFromRepository, then ImportCapabilitiesFromRepository.
```

## Agent Read Order (Quick Startup)

1. `AGENTS.md`
2. `Standards/AgentSituationalAwareness.md`
3. `README.md`
4. `Capabilities/GettingStarted/GettingStarted.md`
5. `Capabilities/GettingStarted/Rules.md`
6. `Workspace/OwnerGoals.md`
7. `Workspace/ValuableReferences.md` (create or update during Quick Startup)
8. `Workspace/OwnerPreferences.md` (when import or connector work)
9. `Capabilities/LocalAgentToolSetup/Vendors/ClaudeCode.md` (when Claude offers profile memory)

## Related

- [ReferenceReviewPrompt.md](ReferenceReviewPrompt.md)
- [GettingStarted.md](GettingStarted.md)
- [Prompt.md](Prompt.md)
- [../../Plans/FirstRunStreamlinePlan.md](../../Plans/FirstRunStreamlinePlan.md)
