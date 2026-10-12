<!--
IndexTitle: Post Quick Startup Routing
IndexDescription: Canonical next-step routing after Owner Goals are captured — prevents misroutes to RepositoryScaffold for packaging validation.
IndexType: Capability
CapabilityName: GettingStarted
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-10-11
-->

# Post Quick Startup Routing

Use after the final adopted-project identity cleanup and Owner Goals are
written.
Read [AgentCapabilityGuide.md](../AgentCapabilityGuide.md) only to confirm.

## Quick Startup complete (say this)

Lead with what the workspace now supports and the owner's first priority,
then one concrete next action. Use plain language; Capability names and boot-file
details are supporting information. Do not claim the first project goal is
achieved merely because startup is complete.

```text
Your workspace is ready to support <owner's actual project>.
First priority: <owner's outcome>.
Next: <one concrete action; optional when no work has been requested>.
Working scope: <confirmed local/live boundary, if relevant>.

Saved: <brief links to goals/preferences and interview progress>.
Indexing: <actual status>. GitHub: <actual status>.
Identity verification: <actual result or not applicable>.
```

Close in normal owner-facing prose. Use a fenced worker handoff only when
explicitly requested or when an explicit separate planner/worker workflow needs
one. Optional choices may remain unresolved; accurately report their state.
If all outcomes were deferred, say that setup information is saved and the next
outcome is undecided, rather than choosing a starter example for the owner.

## Route exactly one next task

| If the owner's goals or answer emphasize... | Route | Entry |
| --- | --- | --- |
| Maintain an existing website | **GettingStarted** maintenance orientation, then a present project maintenance Capability | [ExistingWebsiteStartup.md](ExistingWebsiteStartup.md) |
| Business plan inputs, North Star, offer/audience clarity | **BusinessPlan** | [Prompt.md](../BusinessPlan/Prompt.md) |
| Draft the owner's one-page business website | **OnePageWebsite** | [Prompt.md](../OnePageWebsite/Prompt.md) — after essentials exist |
| Review public website page drafts | **ContentReview** | [Prompt.md](../ContentReview/Prompt.md) |
| Business clarity — audience, offer, tone, pages | **UserDiscoveryPrompt** | [UserDiscoveryPrompt.md](UserDiscoveryPrompt.md) |
| Git status, push, new GitHub repo | **GitHubWorkflow** | [SetupPrompt.md](../GitHubWorkflow/SetupPrompt.md) — owner must ask |
| Refresh Indexes/ after new files | **ManualIndexing** | [WorkflowIndex.md](../ManualIndexing/WorkflowIndex.md) |
| Install or configure Cursor / local agent | **LocalAgentToolSetup** | [Prompt.md](../LocalAgentToolSetup/Prompt.md) |
| Add Workspace folders when real content exists | **RepositoryScaffold** | [IntendedRepositoryTree.md](../RepositoryScaffold/IntendedRepositoryTree.md) |

## Packaging validation — special case

If Owner Goals mention **validate starter**, **smoke test**, **package ready**,
or **distribution**:

1. **Do not** route **RepositoryScaffold** — it is for folder growth, not ZIP
   readiness.
2. **Do not** search for a `VerifyStarterPackage` Capability — it is not in the
   registry.

3. For template package checks, use the explicit WordPress starter profile:

```powershell
.\Automation\VerifyStarterPackage.ps1 -Root (Get-Location).Path -Profile WebPresenceWordPress
```

   This checks template structure, not adopted-project identity. In an adopted
   project, use `Automation/Test-AdoptedRepositoryIdentity.ps1` for identity.
   Package readiness does not authorize distribution or production changes.
4. Route one next task from the owner's goals. Do not run adoption mutations in
   the canonical template for a smoke test; create a temporary copy first.

## Default when unclear

Use the supplied first goal and project direction. If the next action is still
unclear, ask one focused clarification or record the outcome as deferred.
Do not choose starter example pages, a new website build, or repository repair
by default. For an existing website, choose read-only diagnosis until work scope
is established; use only implementation workflows present in the registry.

## Related

- [GettingStarted.md](GettingStarted.md) — first-session order
- [QuickStartupGreeting.md](QuickStartupGreeting.md)
- [RepositoryIdentityTemplate.md](RepositoryIdentityTemplate.md)
