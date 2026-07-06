<!--
IndexTitle: Agent Self-Directed Loop
IndexDescription: Preferred prompt for an agent to choose and complete one focused local backlog task.
IndexType: Capability
CapabilityName: AssistedAgenticWorkflow
IndexStatus: Active
LastEdited: 2026-06-02
-->

# Agent Self-Directed Loop

Use this prompt when you want a worker agent to continue local repository work with minimal human prompting.

```text
You are working locally in C:\Repositories\GetEstablished.

Do not push to GitHub unless explicitly instructed.

Operate in one focused local pass.

Loop:

1. Read required repository instructions and workflow docs:
   - AGENTS.md
   - README.md
   - Plans/RepositoryMap.md
   - Plans/RepositoryExcellenceHighlights.md
   - Plans/AgentWorkflowModes.md
   - Plans/AgentReviewChecklist.md
   - Plans/AgentTaskBacklog.md
   - Plans/OpenQuestions.md

2. Check `git status`.

3. Read `Plans/AgentTaskBacklog.md`.

4. Choose the next task from the `Ready Next` section.

5. Complete one focused pass only.
   - Before beginning, read any task-specific files called out in the backlog task description, such as prompt files, content source files, or review docs.
   - Keep changes small and reviewable.
   - Prefer plain Markdown unless the selected task explicitly requires something else.
   - Do not make unrelated edits.

6. If non-blocking questions arise, add them to `Plans/OpenQuestions.md`.
   - Include the question.
   - Explain why it matters.
   - Add the current default assumption.
   - Mark the decision status.
   - Keep working if the question does not block the immediate task.

7. Stop immediately and ask for human input only for:
   - Merge conflicts.
   - Unexpected working tree changes that affect the task.
   - Unsafe or destructive changes.
   - Credential, secret, privacy, or security concerns.
   - Business facts, legal claims, pricing, credentials, or proof that must not be invented.
   - Framework, dependency, deployment, or automation decisions not explicitly requested.
   - Website build or deployment decisions not explicitly requested.

8. Update `Plans/AgentTaskBacklog.md` if the selected task's status changes.
   - Use Ready Next for the current top pass.
   - Use Later for useful non-urgent follow-ups.
   - Use Blocked for tasks waiting on a prerequisite.
   - Move done work to Completed Local Passes.
   - If the final Next Recommended Task should survive the chat, add it to the backlog.

9. Before handing off, review the changed files.

10. Leave useful planning or review files in the repository when the task produces durable context.
   - The worker agent should create or update planning, review, backlog, or question files when they are useful.
   - The planning agent should review those repository files instead of relying on long chat summaries.
   - Keep document-local next steps in their planning file when they do not need backlog tracking.

11. End with exactly one copy-ready fenced `text` handoff block. This is a worker pass, so the fenced block is required:
   - Summary.
   - Files Changed.
   - Planning Files To Review.
   - Questions Added Or Changed.
   - Next Recommended Task.

12. After the worker agent reports, the user may copy the full fenced handoff into the planning-agent conversation. The copied handoff is only a communication step. It is not a Git commit, not a GitHub sync, and not a replacement for repository files.

13. The user can then tell ChatGPT:

Review this worker handoff and provide the next worker prompt.

Do not include full `git status` in normal reports. Include git status only for conflicts, unexpected dirty state, requested commit or sync, or blocking conditions.

Keep reports brief, click-to-copy friendly, and free of long chat summaries.

Do not add extra commentary outside the final handoff block unless reporting a blocking condition.

Reusable prompts should always be placed in fenced `text` blocks. Avoid mixing explanatory prose into copyable prompt blocks.

Do not push unless explicitly instructed.
```

This prompt is for worker passes. A worker agent using this prompt always ends with exactly one copy-ready fenced `text` handoff block. Planning agents such as ChatGPT reviewing progress and deciding direction do not follow the same rule - their summaries may be natural readable chat text unless the user asks for a copy-ready prompt, command, report, or handoff.

In the normal loop, a worker agent edits files and ChatGPT, or another planning conversation, is the planning and review agent. The human supervises the loop and decides when to pause, commit, sync, or ask for review. When the full worker handoff is copied into the planning conversation, the planning agent should review the handoff, use the listed repository files as the source of truth, and decide whether to continue, pause, ask a human question, or create the next tuned worker prompt. If only part of the handoff is provided, the planning agent may ask for the full handoff before deciding the next task.
