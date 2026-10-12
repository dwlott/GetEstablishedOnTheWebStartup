<!--
IndexTitle: GettingStarted Prompt
IndexDescription: Copy-ready worker prompt for first-session setup orientation and owner-goal routing.
IndexType: Capability
CapabilityName: GettingStarted
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-10-11
-->

# GettingStarted Prompt

Use this prompt when the user wants to get started, prepare the first setup
path, clarify owner setup goals, or route the next beginner setup task.

```text
# Worker pass: GettingStarted

Repository: {{ACTIVE_REPOSITORY_NAME}}
Root: {{VERIFIED_ACTIVE_ROOT}}
Branch: {{CURRENT_BRANCH_OR_NONE}}
Identity mode: {{VERIFIED_IDENTITY_MODE}}

Read first:
- AGENTS.md
- Standards/AgentSituationalAwareness.md
- README.md
- Plans/RepositorySearchMap.md
- Capabilities/GettingStarted/README.md
- Capabilities/GettingStarted/Rules.md
- Capabilities/GettingStarted/GettingStarted.md
- Capabilities/GettingStarted/QuickStartupWalkthrough.md
- Capabilities/GettingStarted/ExistingWebsiteStartup.md
- Capabilities/GettingStarted/WorkspaceAdoptionPrep.md
- Capabilities/GettingStarted/RepositoryIdentityTemplate.md
- Capabilities/GettingStarted/QuickStartupGreeting.md
- Plans/UserSetupGuide.md
- Plans/RepositoryGoals.md
- Plans/AgentTaskBacklog.md

Goal:
Make the getting-started path clear enough for a new owner or agent to use.
On Quick Startup, classify the root first. Apply Workspace Adoption Prep
only to a confirmed adopted copy (reset stale template files and detach stale
starter Git). Preserve canonical and established repositories, then collect one or more
practical owner setup goals, keep those separate from Repository Goals, and route
the next setup task through existing guides, prompts, or Capabilities, and
finish with mode-gated adopted-project identity cleanup.

Interview protocol:
Display QuickStartupGreeting.md's opening and five questions once as a preview.
Follow QuickStartupWalkthrough.md: ask one unanswered question at a time with
Question N of 5, wait for the answer, save progress, and lead into the next.
One clear outcome is enough; reuse supplied facts and accept skips or deferrals.
Resume Workspace/QuickStartupProgress.md rather than repeating answered questions.
Combine environment discovery with question 4; ask only for missing information.
If this is an existing website, use ExistingWebsiteStartup.md to establish the
missing local/live and work-scope facts before proposing changes.
Capture goals and preferences as answers arrive. References are optional when
useful. Offer indexing through its benefit and create it only after acceptance.
Leave GitHub until requested. Finish required adopted identity checks and close
with the owner's first priority and one concrete next action.

In scope:
- Read WorkspaceAdoptionPrep and confirm adoption before mutations. Preserve
  canonical roots, project Git remotes, and previously captured project goals.
- Offer optional indexing; complete the identity record and read-only verification
  in every confirmed adopted project.
- Clarify beginner-facing setup guidance.
- Confirm the read-first path.
- Ask for or summarize one or more owner setup goals.
- Show QuickStartupGreeting.md's opening and five-question preview, then follow
  its Agent-led walkthrough. Ask one unanswered question at a time, wait for
  the answer, and lead into the next without requiring the owner to copy
  questions or request continuation. Reuse supplied answers and accept skips
  or deferrals.
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
- One goal is sufficient; progress survives interruption without repeated questions.
- Existing-site work has an appropriate route and confirmed working boundaries.
- Optional choices retain their actual state, and the close leads with the outcome.
- The five-question preview remains visible, and the agent guides each answer
  individually rather than leaving the owner to drive the questionnaire.
- Owner goals and Repository Goals remain separate.
- Any owner-goal examples are practical and beginner-friendly.
- The next task is one focused step, not a broad plan.
- Missing structure is handled by routing or a one-sentence setup offer, not
  by creating folders during this pass.
- Reusable workflow rules stay in Capability files; owner-specific facts do
  not.
- Do not rewrite the canonical Startup repository as though it were an adopted
  project.

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
