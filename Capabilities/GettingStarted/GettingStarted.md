<!--
IndexTitle: Getting Started
IndexDescription: Beginner-friendly entry point for understanding Markdown, read-first files, and the repository workflow.
IndexType: Setup
IndexStatus: Active
LastEdited: 2026-07-06
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
three to five practical outcomes you want this setup to produce.

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

First session order:

1. Read `AGENTS.md` and `README.md`.
2. **Workspace Adoption Prep** — run [WorkspaceAdoptionPrep.md](WorkspaceAdoptionPrep.md)
   automatically. Reset stale starter boot files (Owner Goals, Valuable References,
   Import rows, stale `Plans/OpenQuestions.md`) **without asking permission**.
   If `.git/` exists and `origin` still points at the starter template, run
   `git remote -v` and **ask the owner to choose** before the five setup questions
   (park as `starter-template`, new GitHub repo, remove origin, or leave as-is).
   One-line notice to the owner, then continue.
3. Display the opening and five setup questions from
   [QuickStartupGreeting.md](QuickStartupGreeting.md) — **do not invent questions**.
   (Use [UserDiscoveryPrompt.md](UserDiscoveryPrompt.md) only **after** Owner Goals
   when business or page clarity is the next step.)
   When device or environment is unknown, use the **profile-aware** path in
   [Rules.md](Rules.md) §Profile-Aware Quick Startup — short environment
   interview, optional uploads if the user has files to share, persist to
   `Workspace/OwnerEnvironment.md`.
4. Write three to five Owner Goals in `Workspace/OwnerGoals.md` from the owner's
   answers (replace the scaffold row).
5. Ask: **Do you have a prior repository folder or archive to import from?**
   If yes, record the path in `Workspace/OwnerPreferences.md`, then route
   **ImportOwnerPreferencesFromRepository** first, then
   **ImportCapabilitiesFromRepository** (owner-approved module checklist).
   See [FirstRunAgentPrompts.md](FirstRunAgentPrompts.md).
6. **Capture candidate valuable references** (two to five rows max for the first
   pass). Once direction is clear, add likely URLs or search terms to
   `Workspace/ValuableReferences.md` with `Confidence: Suggested` and short
   commentary (what each link is for). Do not tell the owner to "go find a URL"
   without offering a specific link or search term first — see
   [SituationalAwareness/Rules.md](../SituationalAwareness/Rules.md) section 9.
7. **Offer reference review (optional).** Offer a short owner pass over
   Suggested rows — now or later — using
   [ReferenceReviewPrompt.md](ReferenceReviewPrompt.md). Do not block startup.
8. Route **one** next task per
   [PostQuickStartupRouting.md](PostQuickStartupRouting.md) — then confirm in
   `Capabilities/AgentCapabilityGuide.md`. **Do not** route **RepositoryScaffold**
   for packaging validation or "consumer scaffold check."
9. Park GitHub until the owner chooses.
10. **Last step — offer indexing (soft).** Tell the owner, without strongly
   recommending it:

   > Newly created files will be indexed by an agent to speed up chat
   > processing. This works well when the repository is used only a few times a
   > day. If the repository is being used more heavily, code-assisted indexing
   > can be offered. It's okay to wait on this decision — I'll offer it again
   > when I think it would help.

   Record the choice in `Workspace/OwnerPreferences.md` (Indexing section). Do
   not block startup waiting for the decision. Manual indexing
   (`Capabilities/ManualIndexing/`) is the default either way.

11. **Close the session for the owner** using
    [PostQuickStartupRouting.md](PostQuickStartupRouting.md) § Quick Startup
    complete. Do **not** end with a fenced worker handoff unless the owner
    explicitly requested PlannerWorker workflow. Assume **no planning agent** is
    waiting.

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
- Preserve human control with reviewable changes, batched questions, and clear
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
