<!--
IndexTitle: GettingStarted Prompt
IndexDescription: Copy-ready worker prompt for first-session setup orientation and owner-goal routing.
IndexType: Capability
CapabilityName: GettingStarted
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-07-06
-->

# GettingStarted Prompt

Use this prompt when the user wants to get started, prepare the first setup
path, clarify owner setup goals, or route the next beginner setup task.

```text
# Worker pass: GettingStarted

Repository: GetEstablished
Branch: main

Read first:
- AGENTS.md
- Standards/AgentSituationalAwareness.md
- README.md
- Plans/RepositorySearchMap.md
- Capabilities/GettingStarted/README.md
- Capabilities/GettingStarted/Rules.md
- Capabilities/GettingStarted/GettingStarted.md
- Capabilities/GettingStarted/WorkspaceAdoptionPrep.md
- Capabilities/GettingStarted/QuickStartupGreeting.md
- Plans/UserSetupGuide.md
- Plans/RepositoryGoals.md
- Plans/AgentTaskBacklog.md

Goal:
Make the getting-started path clear enough for a new owner or agent to use.
On Quick Startup, run Workspace Adoption Prep first (reset stale boot files
automatically), then collect three to five practical owner setup goals, keep those
separate from Repository Goals, and route the next setup task through existing
guides, prompts, or Capabilities.

In scope:
- Run WorkspaceAdoptionPrep when Quick Startup begins (no permission ask for stale template content).
- Clarify beginner-facing setup guidance.
- Confirm the read-first path.
- Ask for or summarize three to five owner setup goals.
- Point to Plans/RepositoryGoals.md as the repository North Star.
- Route the next task to an existing Capability or prompt.
- Update setup or planning docs only when the change is small and directly
  supports the getting-started path.

Out of scope:
- Building the website.
- Choosing a platform, host, theme, framework, or dependency.
- Adding automation, generated indexes, Skills, or runtime adapters.
- Creating new Workspace folders or storing private owner facts in Capability
  files.
- Moving files.
- Committing or pushing unless explicitly instructed.

Quality checks:
- Owner goals and Repository Goals remain separate.
- Any owner-goal examples are practical and beginner-friendly.
- The next task is one focused step, not a broad plan.
- Missing structure is handled by routing or a one-sentence setup offer, not
  by creating folders during this pass.
- Reusable workflow rules stay in Capability files; owner-specific facts do
  not.

Final response (Quick Startup):
Close with the owner-facing session summary in
[PostQuickStartupRouting.md](PostQuickStartupRouting.md) § Quick Startup complete.
Do **not** assume a planning agent is waiting. Do **not** use a fenced worker
handoff block unless the owner explicitly requested PlannerWorker workflow.

Final response (other GettingStarted passes — not Quick Startup):
End with a short plain-language summary and one optional next step. Use a fenced
worker handoff only when the owner asked for PlannerWorker or AssistedAgenticWorkflow.
```

## Prompt History

| Date | Ver | Change |
| --- | ---: | --- |
| 2026-07-06 | 3 | Quick Startup closes for the owner, not a planner handoff | Agents assumed a planning agent was waiting | Prompt, Rules, PostQuickStartupRouting |
| 2026-07-06 | 2 | Workspace Adoption Prep on Quick Startup; auto-reset stale boot files | Adopted copies kept product-builder Owner Goals; agents stalled asking permission | Prompt, WorkspaceAdoptionPrep, Rules, QuickStartupGreeting, GettingStarted |
| 2026-06-01 | 1 | Initial GettingStarted operate prompt |
