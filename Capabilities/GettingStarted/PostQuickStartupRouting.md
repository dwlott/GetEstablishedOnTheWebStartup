<!--
IndexTitle: Post Quick Startup Routing
IndexDescription: Canonical next-step routing after Owner Goals are captured — prevents misroutes to RepositoryScaffold for packaging validation.
IndexType: Capability
CapabilityName: GettingStarted
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-07-06
-->

# Post Quick Startup Routing

Use at **GettingStarted first-session step 7** after Owner Goals are written.
Read [AgentCapabilityGuide.md](../AgentCapabilityGuide.md) only to confirm.

## Quick Startup complete (say this)

Close in **plain chat for the owner**. Do **not** end with a fenced worker
handoff block unless the owner explicitly asked for **PlannerWorker** or
**AssistedAgenticWorkflow** (see
[AssistedAgenticWorkflow/PlannerWorkerWorkflow.md](../AssistedAgenticWorkflow/PlannerWorkerWorkflow.md)).

**Default assumption:** there is **no planning agent waiting**. The same agent
(or the owner in a new chat) may continue later — that is not an automatic
handoff to another role.

```text
Quick Startup is complete for this session.

What I did:
- (one line per boot-file update — prep, goals, references, preferences)
- (git remote adoption if resolved — e.g. parked starter-template)

Owner Goals are in Workspace/OwnerGoals.md.
GitHub: (parked starter-template | new repo connected | local-only | unchanged — match OwnerPreferences).
Do not push until the owner explicitly asks.

Suggested next step (optional — you can do this now or later):
- (one Capability or prompt from the routing table below)

Indexing: (soft offer from GettingStarted step 10 — manual default; code-assisted optional later)
```

Do **not** format the close as `Summary / Files Changed / Planning Files To Review /
Next Recommended Task` unless the owner is in an explicit planner/worker loop.

## Route exactly one next task

| If the owner's goals or answer emphasize... | Route | Entry |
| --- | --- | --- |
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
3. Tell the owner this download is already the **Get Established Workspace**
   consumer tree. Re-verify if needed:

```powershell
powershell -NoProfile -ExecutionPolicy Bypass -File .\Automation\VerifyStarterPackage.ps1
```

(If the script is absent, the owner received a pre-validated package; method-host
repair is documented on the GetEstablished archetype host.)

4. **Next owner actions** (pick one): connect **GitHubWorkflow**; run
   **ContentReview** on sample pages; use the repo for real project work; or
   (packaging operator only) ZIP for distribution on the method host.

## Default when unclear

**ContentReview** on `Content/Website/Pages/Home.md` or **UserDiscoveryPrompt**
if business direction is still open — not RepositoryScaffold.

## Related

- [GettingStarted.md](GettingStarted.md) — first-session order step 7
- [QuickStartupGreeting.md](QuickStartupGreeting.md)
- [Plans/GetEstablishedStartupPostDialogImprovementPlan.md](../../Plans/GetEstablishedStartupPostDialogImprovementPlan.md)
