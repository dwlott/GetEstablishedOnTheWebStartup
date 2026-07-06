<!--
IndexTitle: Agent Sandbox And Permissions
IndexDescription: Guidance for sandbox failures, local-read fallback, permissions prompts, and safe repository startup workflow.
IndexType: Setup
IndexStatus: Draft
LastEdited: 2026-05-29
-->

# Agent Sandbox And Permissions

Purpose

- Explain common agent startup and permissions issues.
- Reduce repeated permission prompts during repository work.
- Provide a calm fallback workflow when the sandbox fails.
- Help demonstrations remain smooth and professional.

---

## Preferred Workflow

Ideal startup flow:

1. Launch the agent normally.
2. Open the repository workspace.
3. Allow the repository bootstrap reads.
4. Let the agent read:
   - AGENTS.md
   - README.md
   - Task-specific planning files
5. Continue with the scoped task.

Preferred state:

- Sandbox initializes successfully.
- Repository reads work normally.
- No repeated permission prompts appear.
- The repository remains the source of truth.

---

## Sandbox Failure Workflow

Sometimes the sandbox fails to initialize.

Typical symptoms:

- Repeated prompts for `Get-Content -Raw ...`
- The agent says it is using approved local reads.
- Repository startup files require repeated approval.

This does not necessarily mean the repository is damaged.

The agent may still continue safely using local read access.

---

## Recommended Recovery Steps

### Step 1 - Restart The Agent Session

Close the current run and reopen the repository workspace.

---

### Step 2 - Run As Administrator

If permissions continue failing:

1. Close the agent.
2. Restart the agent application in administrator mode.
3. Reopen the repository.

---

### Step 3 - Allow Trusted Read Commands

If the sandbox still fails but the agent is only reading repository guidance files, allow safe read-only commands such as:

```powershell
Get-Content -Raw AGENTS.md
```

or:

```powershell
Get-Content -Raw README.md
```

For repeated repository startup reads, it may be reasonable to allow read-only `Get-Content -Raw` commands for the repository.

Do not blindly allow unrelated command types.

---

## Safe Fallback Philosophy

The repository is designed so agents can continue safely even when the sandbox layer fails.

Fallback workflow:

- Use repository source files.
- Continue scoped planning or editing work.
- Avoid dangerous system changes.
- Keep implementation tasks narrow.
- Preserve the repository as the source of truth.

---

## Demonstration Guidance

For demonstrations:

- Prefer clean sandbox startup when possible.
- Use local-read fallback only when necessary.
- Keep prompts and handoffs concise.
- Avoid repeated approval interruptions.
- Use copy-ready implementation handoffs.
- Use natural readable planning discussion.

The repository is designed to support real-world AI workflow friction professionally.

---

## Related Files

- AGENTS.md
- Capabilities/LocalAgentToolSetup/ — install and configure local agent apps (Cursor); offer config after install
- Capabilities/AgentCapabilityGuide.md
- Plans/AgentWorkflowModes.md
- Plans/AgentReviewChecklist.md
- Plans/AgentSelfDirectedLoop.md
- Archive/RepositoryHousekeeping.md
