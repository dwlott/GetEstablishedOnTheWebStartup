<!--
IndexTitle: User Setup Guide
IndexDescription: Guide for applying the repository pattern to web-presence work.
IndexType: Setup
IndexStatus: Draft
LastEdited: 2026-06-01
-->

# User Setup Guide

Use this guide when you want to apply the GetEstablished repository pattern to your own web-presence work.

This is a planning and workflow guide. It does not require choosing a website framework, adding dependencies, or building a website on day one.

Read this guide first if you are new. Then read `SampleUserJourney.md` to see the first-session flow in action. Use `TemplateGuidance.md` if you want to copy this method into your own repository.

## Who This Is For

This guide is for people who want to:

- Start a practical online presence from loose notes.
- Organize identity, audience, offer, proof, and page ideas.
- Learn GitHub through a real project.
- Use AI agents without handing over control of the work.
- Build gradually from source content toward a future website.

You do not need to know the final website design, platform, or publishing plan before using this guide.

## What You Need Before Starting

Start with whatever you already have. That might be a few notes, a service idea, a business name, an existing website, a social profile, or a blank repository.

Helpful starting material includes:

- A short description of the project, business, or professional identity.
- A rough idea of who you want to help.
- Any existing notes, links, documents, testimonials, examples, or images.
- A willingness to work in small passes instead of trying to finish everything at once.

## What The Repository Pattern Does

The pattern turns scattered ideas into a clear source of truth.

It gives you places for:

- Project direction and decisions.
- Website source content.
- Reusable prompts.
- Setup notes and workflow guidance.
- Open questions for later human review.
- Future automation only when a repeated need is clear.

The repository becomes both the workspace and the record of how the web presence was built.

## Local-First Workflow

Work locally first. Make one focused change at a time, review it, and keep the repository easy to understand.

Use this rhythm for each work session:

1. Pull or sync before starting a work session.
2. Read the repository instructions and relevant planning files.
3. Choose one focused task.
4. Make a small, reviewable change.
5. Review changed files.
6. Keep questions in a batch if they do not block the current task.
7. Commit when a focused task or useful milestone is complete.
8. Push or sync to GitHub at meaningful milestones, not after every tiny edit.

Stop and ask for help if a conflict, unexpected file state, or risky decision appears.

## Start With The Foundation

Before building a website, write down the source material.

Start by naming three to five practical setup goals. These should describe
what you want the first setup work to produce, such as a basic website, a
Google Business Profile improvement, first service pages, reviews or proof,
online estimates, appointments, or a reusable starter repository.

Keep these owner goals separate from the repository's durable North Star in
`Plans/GoalsIdeasPlansCapabilitiesModel.md`. Owner goals route the first tasks; Repository
Goals protect the long-term structure.

Start with:

- **Identity:** Who are you, what is the project, and what should people remember?
- **Audience:** Who are you trying to help, and what do they need?
- **Offer:** What do you provide now, and what outcome should someone expect?
- **Proof:** What experience, examples, results, testimonials, or artifacts support the work?
- **Tone:** How should the website sound, and what should it avoid?
- **Pages:** What first pages should exist, and what should each page do?

Use `Plans/UserDiscoveryPrompt.md` when you want AI help organizing those answers.

The first answers can be rough. The point is to create source material that can be reviewed and improved.

## Draft Website Content First

Keep early website content in plain Markdown.

A useful first page set is:

- Home.
- Start Here.
- How It Works.
- AI Workflow.
- GitHub Workflow.
- Offers.
- About.

Do not worry about design or technology yet. The first goal is clear source content that a human and an AI agent can both understand.

## Use Prompts Without Starting From Scratch

You do not need to write a custom prompt for every pass.

Use the prompt library:

- `Plans/UserDiscoveryPrompt.md` for identity, audience, offer, proof, tone, pages, assets, and next steps.
- `Plans/ContentReviewPrompt.md` for reviewing website page drafts.
- `Plans/AgentSelfDirectedLoop.md` when the repository has a clear backlog and you want an agent to choose the next focused local task.
- `Plans/MobileIdeaCaptureWorkflow.md` when ideas are captured on a phone and need to be reviewed later from the desk.
- `Plans/GitHubPowerShellHelper.md` when you need PowerShell-first GitHub commands.

Give the agent one task at a time. Ask it to read the relevant repository files first. Review the result before moving on.

Think of prompts as reusable work instructions. A good prompt should save you from explaining the same workflow again and again.

For a concrete example of this flow, see `SampleUserJourney.md`.

Mobile notes, screenshots, or chat ideas can be useful, but they are draft material until they are moved into repository files. Use `Plans/MobileIdeaCaptureWorkflow.md` to keep mobile ideas from derailing the current local implementation pass.

## Use Click-To-Copy Handoffs

Ask agents to end normal passes with a short fenced `text` block that is easy to copy into a planning tool, future ChatGPT thread, or next agent session.

Normal handoffs should list only:

- Summary.
- Files Changed.
- Planning Files To Review.
- Questions Added Or Changed.
- Next Recommended Task.

The useful project memory should live in repository files, not in a long chat summary. The planning agent can review the listed files and decide what should happen next.

Do not ask for full `git status` in every normal handoff. Include it only when there is a conflict, unexpected dirty state, requested commit or sync, or blocking condition.

## Use The Handoff Between The Worker Agent And ChatGPT

The recommended loop uses two agent roles:

- A worker agent is the implementation agent that edits local repository files.
- ChatGPT is the planning and review agent that reviews the handoff and prepares the next worker prompt.

When the worker agent finishes a task, copy the full fenced implementation handoff into the planning-agent conversation. For a tiny pass, you can summarize the handoff manually, but the full block is preferred.

Make sure the handoff includes:

- Summary.
- Files Changed.
- Planning Files To Review.
- Questions Added Or Changed.
- Next Recommended Task.

Then tell ChatGPT:

```text
Review this implementation handoff and provide the next worker prompt.
```

ChatGPT should review the handoff, look at the listed repository files when needed, and decide whether to continue, pause, ask a human question, or write the next worker prompt.

A copied handoff is only a communication step. It is not a commit, not a GitHub sync, and not a substitute for the repository files. The repository remains the source of truth. The human supervises the loop and decides when to pause, commit, sync, or ask for review. If you provide only part of the handoff, ChatGPT may ask you for the full handoff before it decides the next task.

This keeps the implementation-agent and planning-agent loop clear while making the workflow easy to demonstrate.

## Use Open Questions For Batch Review

Not every question needs to interrupt the work.

Use `Plans/OpenQuestions.md` for non-blocking human decisions, such as:

- Which offer should be public first?
- What should the homepage ask visitors to do?
- When should the project choose a publishing approach?
- What proof or credibility assets should be gathered?

Each question should include why it matters, the current default assumption, and the decision status.

Agents should keep working when a question does not block the immediate task.

Use open questions for decisions that matter but can wait. Do not use them to avoid a decision that blocks the current task.

## When To Stop And Ask

Stop immediately when:

- A merge conflict appears.
- The working tree has unexpected changes that affect the task.
- A change would delete or replace user-authored content.
- A credential, secret, privacy, or security concern appears.
- The task requires business facts, pricing, legal claims, credentials, or proof that should not be invented.
- The task requires a framework, dependency, deployment, automation, or website build decision that has not been explicitly requested.

These stops protect the user from accidental scope, risky edits, and invented details.

## When To Sync Or Push

Sync or push at meaningful milestones.

Good milestones include:

- A focused planning pass is complete.
- First website content drafts are ready for review.
- A prompt library update is complete.
- A documentation structure pass is complete.
- A human has reviewed and approved a batch of local changes.

Do not push after every tiny edit unless that is the workflow the project owner wants.

## First-Session Checklist

Use this checklist for a first local session:

- Read `AGENTS.md`.
- Read `README.md`.
- Read `Plans/RepositoryMap.md`.
- Name three to five practical setup goals.
- Create or review your identity statement.
- Define your target audience.
- Draft your first offer direction.
- List proof or credibility assets you already have.
- Choose the first website pages.
- Use `Plans/UserDiscoveryPrompt.md` if you need help organizing the answers.
- Add non-blocking decisions to `Plans/OpenQuestions.md`.
- Make one focused local change.
- Review changed files.
- Report in a short copy-ready fenced block with summary, files changed, planning files to review, questions added or changed, and next recommended task.

## Simple First Session

A good first session might be:

1. Use the user discovery prompt.
2. Save the identity, audience, offer, proof, tone, and page notes.
3. Draft or review the first page list.
4. Add any non-blocking decisions to `OpenQuestions.md`.
5. Stop with a clear next task.

That is a successful session even if no website exists yet.

## Good First Outcome

By the end of the first session, you should have a clearer project direction, a few useful source files, and a next task that does not require guessing.

That is enough. The website build can wait until the content and decisions are ready.

When you are ready to reuse this pattern elsewhere, use `TemplateGuidance.md` to decide what to copy and what to customize.
