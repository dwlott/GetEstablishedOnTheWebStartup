<!--
IndexTitle: Agent Permissions
IndexDescription: Public-facing website page draft explaining agent permission prompts, sandbox behavior, and safe review habits.
IndexType: Content
IndexStatus: Draft
LastEdited: 2026-06-17
-->

# Agent Permissions

Know what an agent is asking to do before you approve it.

This page explains permission prompts, sandbox boundaries, and safer approval habits in plain language.

AI agents are most useful when they can read the right project files and make focused changes with your approval.

**Get Established Workspace** is a prepared foundation for using AI to build your online presence. It is an *AI-ready* folder of organized files, with the **Get Established Repository** as the technical **source of truth** when file history and agent instructions matter.

That prepared foundation helps agents work from clear instructions, page drafts, prompts, and planning notes instead of guessing what your online presence should become.

Sometimes an agent needs permission before it can read a file, run a command, or make a change. Those permission prompts are part of keeping the work visible and *reviewable*.

## Why Agents Ask For Permission

Agents ask for permission when a task needs access outside the normal working area, when a command could change files, or when the app wants you to approve a local action before it continues.

A permission prompt does not automatically mean something is wrong. It means the agent is asking before doing more.

## What The Sandbox Means

Think of the sandbox as a working boundary around the agent.

It helps limit what the agent can read or change during a task. The goal is to let the agent work inside the project while keeping broader access controlled.

The sandbox is not a promise that every action is safe. It is one part of a careful workflow: read the request, check the command, keep the task focused, and review the result.

## When The Sandbox Falls Back

Sometimes the sandbox does not start cleanly or cannot complete an ordinary repository read.

When that happens, the agent may ask to continue with safe local reads. For example, it may need to read the repository instructions, setup notes, or page drafts so it can follow the project workflow.

That fallback should stay narrow. A sandbox issue is not a reason to approve broad access or unrelated commands.

## Lower-Risk Read-Only Reads

Read-only repository commands are usually lower risk when they only display trusted project files.

Examples include reading files such as:

- `AGENTS.md`
- `README.md`
- Project planning notes
- Website page drafts
- Setup guidance files

These reads help the agent understand the workspace before it suggests or edits anything.

Still, check what the command is trying to read. A familiar read-only file command is different from a broad command that scans private folders or changes the system.

## How To Decide What To Click

Before approving a permission prompt, ask three simple questions:

1. Does this match the task I gave the agent?
2. Is the agent asking for the smallest access that can do the job?
3. Do I understand whether the action only reads files or can change something?

If the answer is not clear, pause and ask the agent to explain the request in plain language.

For a documentation task, a request to read known project files is usually different from a request for Full Access, system changes, software installation, or a GitHub push. Full Access should be a careful, explicit choice for a clear reason, not the default fix when a sandbox has trouble.

## Higher-Risk Actions

Be more careful with actions that:

- Change, delete, move, or rename files.
- Install software or dependencies.
- Push changes to GitHub.
- Change system settings.
- Run broad scripts you do not recognize.
- Ask for full access when the task only needs a simple file read.

Full Access should not be the default response to a sandbox problem. Use the smallest permission that fits the task.

## When To Stop

Stop and ask for help when:

- You do not understand what a command is trying to do.
- The requested access seems broader than the task needs.
- The agent asks to change system settings for a simple documentation task.
- A prompt asks you to approve something unrelated to the repository.
- You feel rushed to approve access before reviewing it.

It is reasonable to pause. A good agent workflow should make the next action understandable.

## How This Fits The Workspace

The **Get Established Workspace** is designed so agents can start with organized files, clear instructions, and small *reviewable* tasks.

That makes permission decisions easier. The agent can read the prepared foundation, follow the repository rules, and explain what it needs before it makes changes.

The goal is practical progress: use AI with clear context, keep the work reviewable, and avoid approving more access than the task requires.

## Where To Go Next

- Want the bigger picture of how agents assist? **[AI Workflow](AIWorkflow.md)**.
- Curious how work is saved and synced? **[GitHub Workflow](GitHubWorkflow.md)**.
- New here? **[Start Here](StartHere.md)**.
