<!--
IndexTitle: Template Guidance
IndexDescription: Guidance for copying this repository method into a user's own web-presence repository.
IndexType: Standard
IndexStatus: Active
LastEdited: 2026-06-05
-->

# Template Guidance

Use this guide when you want to copy the Get Established repository method into a new web-presence repository.

If you are new to the method, read `Plans/UserSetupGuide.md` first. If you want to see the method in motion before copying it, read `Plans/SampleUserJourney.md`.

The goal is not to copy every file forever. The goal is to copy the useful pattern: clear instructions, local-first work, reusable prompts, framework-neutral content drafts, batched questions, and lightweight standards.

## Archetype Versus Commissioned

GetEstablished is the **Get Established archetype host** (web presence for business or personal portfolio). A **commissioned** repository is that method put into service for one owner or business.

| Copy from parent | Do not copy from commissioned instance wholesale |
| --- | --- |
| Universal + archetype Capability patterns | EmailIntake, ScanIntake, TaxPlanningQuestions |
| Setup markdowns, standards, review prompts | Envelope body copy from a live commissioned repo |
| Template and [RepositoryArchetypeAndCapabilityTiers.md](RepositoryArchetypeAndCapabilityTiers.md) | Provisioned inbox paths unless you commission them |

**US1Movers** is the reference **commissioned** instance (first real business on the template). See [RepositoryArchetypeAndCapabilityTiers.md](RepositoryArchetypeAndCapabilityTiers.md) for tier rules — not live paths in other repositories.

**Other archetypes** (for example Write a Book) reuse **universal** ideas but need different archetype Capabilities and folder structures—not this website template.

## Initialize A New Repository

Prefer Capabilities over ad-hoc foundation prompts:

1. **GitHubWorkflow** — create the GitHub repo and clone ([GitHubWorkflow/SetupPrompt.md](../Capabilities/GitHubWorkflow/SetupPrompt.md)).
2. **RepositoryInitialize** — bootstrap shell, registry, and AGENTS.md ([RepositoryInitialize/Prompt.md](../Capabilities/RepositoryInitialize/Prompt.md)).
3. Choose profile: `archetypeHost`, `commissionedWebPresence`, `agenticMeta`, or `codeRepo` (see [RepositoryInitialize/Rules.md](../Capabilities/RepositoryInitialize/Rules.md)).
4. Run Capability **Setup** only when needed (Indexing, EmailIntake, etc.) — do not pre-create empty inbox trees.

Legacy prompt `AgentStartRepositoryFoundation.md` is deprecated; use **RepositoryInitialize**.

## Prepare A Starter Download (Get Established)

When packaging a **consumer starter repository** for GetEstablishedOnTheWeb.com:

1. Keep developing on the **archetype host** (`GetEstablished`).
2. Manually copy to a **packaging workspace** (for example `GetEstablishedStartup`).
3. Run **StarterRepositoryPackage** — [WorkflowIndex.md](../Capabilities/StarterRepositoryPackage/WorkflowIndex.md).

That Capability provides agent instructions to repair Git remotes, remove host-only
trees, rewrite consumer identity, and verify the package before ZIP. It does not
replace **RepositoryInitialize** (empty shell) or **GettingStarted** (first session
after download).

## What To Copy

Start with the parts that make the workflow repeatable:

- A root `README.md` that explains the project identity, purpose, and current structure.
- An `AGENTS.md` file with clear rules for AI agents and maintainers.
- A `Plans/` folder for direction, plans, roadmap, backlog, reviews, and open questions.
- A `Capabilities/` folder for reusable workflow prompts and operating knowledge.
- A `Standards/` folder for folder README and Markdown metadata rules.
- A `Content/Website/Pages` folder for plain Markdown website source drafts.
- Folder `README.md` files with first-line `<!-- Index: ... -->` comments.
- Markdown metadata blocks for important documents.
- A `Plans/RepositoryExcellenceHighlights.md` file for tutorial, demo, and selling points.

Keep the structure shallow at first. Add folders only when there are real files to put in them.

## What To Customize

Customize the parts that describe the actual person, business, project, or offer:

- Repository name and project identity.
- Mission, audience, use cases, and offer direction.
- Proof or credibility assets.
- Tone and words to avoid.
- First website page list.
- Open questions that need human judgment.
- Backlog tasks.
- Public calls to action.

Do not copy claims, offers, testimonials, credentials, pricing, or origin stories unless they are true for the new project.

## Use Local-First Workflow

Work locally before syncing or pushing. Use one focused pass at a time:

1. Read `AGENTS.md`.
2. Read the current project plan, backlog, and open questions.
3. Choose one small task.
4. Make a reviewable change.
5. Leave durable context in repository files.
6. Report with a short copy-ready fenced `text` block.
7. Sync or push only at meaningful milestones.

Commit and sync are milestone actions. They are not the default next task after every edit.

## Use Reusable Prompts

Reusable prompts prevent every session from starting from scratch.

Good starter prompts include:

- A discovery prompt for identity, audience, offer, proof, tone, pages, assets, and next steps.
- A content review prompt for website page drafts.
- A self-directed loop prompt for choosing the next focused backlog task.
- Foundation prompts for creating planning docs and first content drafts.

Keep copyable prompt content inside fenced `text` blocks. Put explanations before or after the block, not inside it.

## Keep Website Content Framework-Neutral First

Start website work as source content, not a website build.

Use plain Markdown page drafts for:

- Home.
- Start Here.
- How It Works.
- AI Workflow.
- GitHub Workflow.
- Offers.
- About.

Do not choose a framework, theme, deployment platform, or dependency until the core message, offer, and first pages are clearer.

## Use Open Questions For Batch Decisions

Use `Plans/OpenQuestions.md` for important decisions that do not block the current task.

Good entries include:

- The question.
- Why it matters.
- The current default assumption.
- Decision status.

Agents should keep working when the question is non-blocking. Stop only when the answer is required to complete the immediate task safely.

## Maintain Folder READMEs And Markdown Metadata

Each active folder should have a `README.md` that explains:

- Folder purpose.
- What belongs here.
- What does not belong here.
- Important files or expected files.
- Agent notes.

The first line should be an index comment:

```text
<!-- Index: Short folder purpose sentence. -->
```

Important Markdown files should use the repository metadata block:

```text
<!--
IndexTitle: Human readable title
IndexDescription: Short extractable description for repository indexes.
IndexType: Standard | Project | Prompt | Setup | Content | Workflow | Review | README
IndexStatus: Draft | Active | Review | Stable | Deprecated
LastEdited: YYYY-MM-DD
-->
```

These small conventions make future repository indexes and agent reviews easier.

## Maintain Repository Excellence Highlights

Use `Plans/RepositoryExcellenceHighlights.md` as a living list of tutorial and selling points.

Update it when the repository gains a meaningful workflow lesson, reusable pattern, demo feature, or sales-page proof point. Do not update it for every small edit.

Examples worth tracking:

- A clearer local-first workflow.
- A reusable prompt that saves repeated explanation.
- A better handoff pattern.
- A content review workflow.
- A metadata or indexing convention.
- A practical setup guide a beginner can follow.

## When To Stop And Ask

Stop for human input when:

- A merge conflict appears.
- Unexpected working tree changes affect the task.
- A change would delete or replace user-authored content.
- The task needs business facts, pricing, legal claims, credentials, or proof that should not be invented.
- The task requires a framework, dependency, deployment, automation, or website build decision that was not explicitly requested.
- A privacy, security, credential, or secret concern appears.

Use default assumptions only for non-blocking draft work.

## A Good First Week

A useful first week can stay entirely in Markdown.

Day 1:

- Create the repository foundation.
- Add `AGENTS.md`, `README.md`, and the first folder structure.
- Write the first identity and mission notes.

Day 2:

- Define the target audience and first offer direction.
- Add proof or credibility assets to gather.
- Start `Plans/OpenQuestions.md` for non-blocking decisions.

Day 3:

- Draft the first website page list.
- Create framework-neutral Markdown page drafts.
- Keep design and publishing decisions out of scope.

Day 4:

- Review the page drafts for clarity, credibility, tone, practical next steps, and unsupported claims.
- Add recommendations to a review document before editing pages.

Day 5:

- Refine the content drafts from the review.
- Update the backlog with the next useful local pass.
- Add meaningful repository strengths to `Plans/RepositoryExcellenceHighlights.md`.

By the end of the week, the project should have a clear message, a working repository pattern, reusable prompts, batched questions, and source content ready for future website decisions.

For a smaller first-session example, see `Plans/SampleUserJourney.md`.
