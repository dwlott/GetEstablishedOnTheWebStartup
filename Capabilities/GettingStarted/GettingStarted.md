<!--
IndexTitle: Getting Started
IndexDescription: Beginner-friendly entry point for understanding Markdown, read-first files, and the repository workflow.
IndexType: Setup
IndexStatus: Active
LastEdited: 2026-10-11
-->

# Getting Started

Start here if this repository feels unfamiliar.

You do not need to know GitHub, Markdown, AI agents, or web publishing before
reading this page. The goal is to give you a calm first look at what the
repository is doing and which files matter first.

This guide sits between the root `README.md` and the fuller
`Plans/UserSetupGuide.md`.

## Quick Startup: Name Your Owner Goals

**Quick Startup** is the first-session path through the `GettingStarted`
Capability. Before choosing tools, platforms, or website structure, write down
one or more practical outcomes you want this setup to produce.

Useful first goals might be:

- get a basic website online;
- improve a Google Business Profile;
- collect reviews or proof;
- draft service pages;
- add a request, estimate, or appointment path;
- prepare a reusable starter repository.

These are **Owner Goals**. They help route the next setup tasks and refine as
you work. When ready, record them in `Workspace/OwnerGoals.md`.

Current owner goals and the operating loop:
[Workspace/OwnerGoals.md](../../Workspace/OwnerGoals.md) and
[OwnerGoalOperatingLoop.md](OwnerGoalOperatingLoop.md).

They are separate from **Repository Goals**—the core durable **Goals** set for
how this learning repository stays organized, indexed, reusable, and safe.
Read `Plans/RepositoryGoals.md` when you need that source of truth.

## Quick Startup: How To Start (Humans And Agents)

**Quick Startup is a workflow, not an app launch.** Agents should read
`AGENTS.md` and this file — not invoke generic `/run` or server-start skills.

| Good trigger | Avoid |
| --- | --- |
| **Begin Quick Startup from AGENTS.md** (deterministic; case-insensitive) | run Quick Startup |
| Start Quick Startup from the repo | run the app |
| Lets go through the quick startup | launch the project |
| Start up from the repo | any phrase starting with **run** |

The **deterministic trigger** is for smoke tests and multi-agent handoffs: match
case-insensitively, then read `AGENTS.md` and route to this Capability — not
`/run`, not app launch.

Copy-ready prompts for Cursor, Claude, and ChatGPT:
[FirstRunAgentPrompts.md](FirstRunAgentPrompts.md).

Owners starting a new project: prefer a copy without `.git` using
`Automation/Copy-StartupToProject.ps1`; for Explorer copies, remove `.git` only
in the confirmed new copy —
[HowToAdoptThisStarter.md](HowToAdoptThisStarter.md).

First session order:

1. Read `AGENTS.md`, `README.md`, the owner registers, and the current backlog.
   If `Workspace/QuickStartupProgress.md` exists, resume it rather than restarting.
2. Read [WorkspaceAdoptionPrep.md](WorkspaceAdoptionPrep.md) and classify the
   root before mutations. Apply resets and Git detach only to identified
   template residue in a confirmed adopted copy. Preserve canonical roots,
   established projects, existing owner data, and project-owned Git history.
3. Follow [QuickStartupWalkthrough.md](QuickStartupWalkthrough.md): show the
   [five-question preview](QuickStartupGreeting.md) once, then ask one unanswered
   question at a time with **Question N of 5 — topic**. Save each answer and
   next prompt. Accept skips and deferrals; one clear goal is enough.
4. Capture supplied outcomes in `Workspace/OwnerGoals.md` as answers arrive.
   Save tool/context facts and prior-material paths in `OwnerPreferences.md`.
   Reuse answers instead of asking the prior-folder question again. Inspect
   available Capabilities before suggesting an import; copying requires authorization.
5. For an existing website, use [ExistingWebsiteStartup.md](ExistingWebsiteStartup.md)
   to establish only missing local/live, freshness, backup, and work-scope facts.
   Choose read-only diagnosis when scope remains unclear. No site write is
   authorized merely by completing startup.
6. Combine environment discovery with question 4. Inspect what is available
   read-only; use the question bank only for missing facts needed to choose a
   workable path. The profile-aware variant is the same interview, not an extra form.
7. Suggest useful references only when the immediate task benefits. Record
   suggested sources in `Workspace/ValuableReferences.md`; reference review is
   optional. No URL quota or research detour is required.
8. Offer indexing once with its benefit: a directory that helps future sessions
   find project notes. Reuse a recorded decision. If accepted, use
   [Indexing Setup](../Indexing/SetupPrompt.md) for missing indexes and
   [ManualIndexing](../ManualIndexing/WorkflowIndex.md) for refreshes. Track an
   unanswered offer accurately; optional setup does not block real work.
9. Leave GitHub until requested. Retain the project's current Git state; do not
   start remote setup, commit, or push just to complete the interview.
10. In every confirmed adopted project, complete `Workspace/RepositoryIdentity.md`
    using [RepositoryIdentityTemplate.md](RepositoryIdentityTemplate.md), apply
    allowlisted active-identity cleanup, and verify with
    `Automation/Test-AdoptedRepositoryIdentity.ps1`. Preserve source provenance.
    Skip adopted rewrites in both canonical repositories. Refresh accepted
    indexes after final identity changes.
11. Close with the practical outcome, working boundaries when relevant, and
    one concrete next action per [PostQuickStartupRouting.md](PostQuickStartupRouting.md).
    Give files, indexing/Git status, and identity checks as brief supporting facts.
    Mark the checkpoint Complete only after required capture and verification.
    If the user stops earlier, save the next prompt without claiming completion.

### Consent cascade (all agents)

If the owner already agreed to Quick Startup, the startup sequence, or
**Begin Quick Startup from AGENTS.md**, **proceed** to the setup questions —
do not ask again whether to "run Quick Startup now."

### Claude Code and profile memory

The **repository** is the source of truth. Claude may store optional **profile
memories** outside Git (see
[LocalAgentToolSetup/Vendors/ClaudeCode.md](../LocalAgentToolSetup/Vendors/ClaudeCode.md)).
When Claude offers to save memory at session end, harmonize with
`OwnerGoals`, `OwnerPreferences`, and `ValuableReferences` first — update the
repo for durable decisions; memory is an optional shortcut only.

## What This Repository Is

This repository helps you achieve **your goals** through the easiest path to
**capture Ideas**, turn them into **Plans**, and carry work through to
**desired positive outcomes**.

**Primary goal:** Ideas → Plans → outcomes — not a fixed product type. Owner
Goals in `Workspace/OwnerGoals.md` decide what "success" looks like for your
project.

**Get Established On The Web** and practical online presence are **common
supported outcomes** when your goals point that way and you use workflows such
as GettingStarted, ContentReview, and drafts under `Content/`. Agents may
mention web presence because those Capabilities are present — that is one path,
not the only purpose of the repository.

It is not a finished website, a platform choice, or an automation system. It is
a prepared foundation: notes, plans, prompts, content drafts, and instructions
that help humans and AI helpers work in small reviewable steps.

The repository is the durable source of truth. In Cursor, agents read these
files directly. Chat conversations and copy-ready prompts can help; Google Drive
handoff notes matter mainly when ChatGPT plans without local repo access.

## What Markdown Files Are

Files ending in `.md` are Markdown files.

Markdown is mostly plain text with simple structure. In this repository,
Markdown files are usually notes with headings, lists, links, and copy-ready
prompt blocks.

You can read a Markdown file like a normal document. Its structure also helps
humans and agents scan the page, find the right section, copy prompts cleanly,
and reuse instructions later without starting over.

## First Files To Know

- `README.md` is the front door for a human reader. It explains what the
  repository is, what belongs here, and where to begin.
- `AGENTS.md` is the read-first instruction sheet for agents and maintainers.
  It tells helpers how to work safely in the repository.
- `Plans/RepositorySearchMap.md` is the route map for where to search,
  where to place files, and how to resume work.
- `Capabilities/README.md` is the registry for repeatable workflows.
  It helps agents find the right workflow instead of inventing a new one.
- `Workspace/OwnerGoals.md` holds durable **Owner Goals** after Quick Startup.
- `Workspace/OwnerPreferences.md` holds **Owner Preferences** (connectors,
  intake paths, import source, decided defaults)—not Capability rules.
- `Workspace/ValuableReferences.md` holds **candidate and approved external URLs**
  and search terms — agent-suggested, owner-reviewed.
- `Plans/RepositoryGoals.md` is the North Star for **Repository Goals**. It
  keeps repository goals separate from owner goals.
- `Plans/UserSetupGuide.md` is the fuller beginner guide to read after
  this page.

## How The Workflow Starts

The repository instructions already handle much of the human-agent workflow.
They give agents read-first rules, placement rules, stop conditions, and
handoff rules.

That means a beginner does not need to design the workflow from scratch. A
human can bring an idea, a question, a draft, or a small task. The repository
then helps route that work to the right file, plan, prompt, or Capability.

For agents, the repeatable version of this first setup path is the
`GettingStarted` Capability in `Capabilities/GettingStarted/`.

## Goals To Ideas To Plans To Capabilities

Use this plain-language flow:

```text
Goals decide what matters (Owner Goals from Quick Startup; Repository Goals for the core set).
Ideas are captured before they disappear.
Selected Ideas are nurtured into Plans.
Plans mature through review, sequencing, and small work passes.
Repeatable Plans can become Capabilities.
Capabilities help future humans and agents do better work without starting over.
```

An **Idea** can be rough. It only needs enough shape to save.

A **Plan** is more structured. It explains what should happen, what should wait,
and what boundaries protect the work.

A **Capability** is for repeatable work. If the same kind of task keeps coming
back, a Capability can collect the rules, prompts, and setup notes so future
humans and agents can run it again.

This flow supports a repository that is indexed, modular, customizable, and
ready for expansion without rushing into tools, automation, platform choices,
or website builds.

## Excellence In Repositories

Use this list as a simple picture of what the repository is trying to model:

- Welcome beginners before it asks for expertise.
- Explain what the repository is and what it is not.
- Keep one clear source of truth.
- Give humans and AI helpers a reliable read-first path.
- Capture Ideas before they disappear.
- Shape selected Ideas into Plans before rushing into tools.
- Promote only repeatable, reusable work into Capabilities.
- Keep files modular so the workspace can be customized.
- Use simple indexes and metadata so future agents can find the right context.
- **Curate valuable external references in the Workspace** — candidates plus
  owner-approved URLs; see `Workspace/ValuableReferences.md`.
- Preserve human control with reviewable changes, guided questions, and clear
  handoffs.
- Expand only when there is a real need.

This repository already supports this through:

- `AGENTS.md`
- `README.md`
- `Plans/RepositorySearchMap.md`
- `Workspace/ValuableReferences.md`
- `Plans/GoalsIdeasPlansCapabilitiesModel.md`
- `Capabilities/README.md`

## What Good Early Progress Looks Like

Early progress does not require building a website.

Good first progress can look like:

- capturing ideas before they disappear;
- recording a few **candidate valuable references** with commentary;
- choosing one small next task;
- writing a short plan before rushing into tools;
- reviewing a draft before treating it as final;
- adding reusable guidance only when a workflow repeats.

## Read Next

For a beginner human path:

1. `README.md`
2. `Capabilities/GettingStarted/GettingStarted.md`
3. `Plans/UserSetupGuide.md`
4. `Plans/SampleUserJourney.md`

For an agent or maintainer path:

1. `AGENTS.md`
2. `README.md`
3. `Plans/RepositorySearchMap.md`
4. The task-specific planning file, setup file, or Capability
