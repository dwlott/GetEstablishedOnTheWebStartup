<!--
IndexTitle: GettingStarted Prompt
IndexDescription: Copy-ready worker prompt for first-session setup orientation and owner-goal routing.
IndexType: Capability
CapabilityName: GettingStarted
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-01
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
- Plans/UserSetupGuide.md
- Plans/RepositoryGoals.md
- Plans/AgentTaskBacklog.md

Goal:
Make the getting-started path clear enough for a new owner or agent to use.
Collect or request three to five practical owner setup goals, keep those
separate from Repository Goals, and route the next setup task through existing
guides, prompts, or Capabilities.

In scope:
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

Final response:
End with exactly one fenced text handoff with these fields:
Summary
Files Changed
Planning Files To Review
Questions Added Or Changed
Next Recommended Task
```

## Prompt History

| Date | Ver | Change |
| --- | ---: | --- |
| 2026-06-01 | 1 | Initial GettingStarted operate prompt |
