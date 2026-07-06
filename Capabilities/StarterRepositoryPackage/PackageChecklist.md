<!--
IndexTitle: Starter Repository Package Checklist
IndexDescription: Include and exclude matrix for consumer Get Established starter repository packaging.
IndexType: Capability
CapabilityName: StarterRepositoryPackage
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-10
-->

# Starter Repository Package Checklist

Use during [WorkflowIndex.md](WorkflowIndex.md) Step 6 verification.
Deterministic lists: **[ConsumerRepairSpec.md](ConsumerRepairSpec.md)**.

Adjust only with owner approval; record changes in the repair handoff.

## Include (Consumer Starter)

| Area | Keep | Notes |
| --- | --- | --- |
| Boot | `AGENTS.md`, `README.md` | Rewrite for starter identity — see [ConsumerBootSnippets.md](ConsumerBootSnippets.md) |
| Quick Startup | `Capabilities/GettingStarted/` | Entry for first session; trigger `Begin Quick Startup from AGENTS.md` |
| Repository scaffold | `Capabilities/RepositoryScaffold/` | Core scaffold repair; intended growth tree |
| Owner Goals | `Workspace/OwnerGoals.md` | Empty register scaffold |
| Owner Preferences | `Workspace/OwnerPreferences.md` | Empty preferences scaffold; manual indexing default |
| Valuable References | `Workspace/ValuableReferences.md` | Empty URL register; Suggested/Owner-confirmed tiers |
| Core Capabilities | See ConsumerRepairSpec § F | 11 core + optional GoogleDriveLink |
| Pre-indexed starter | `Indexes/` populated; Indexing + ManualIndexing | Exclude CodeAssistedIndexing |
| Standards | `Standards/` | Consumer wording in AgentSituationalAwareness |
| Setup guides | `Plans/UserSetupGuide.md`, `Plans/SampleUserJourney.md` | Beginner paths |
| Ideas layer | `Ideas/`, `Plans/Ideas.md` | Light register |
| Website drafts | `Content/Website/Pages/` | Public site source; CTA **Get Established** |
| Registry slice | RouterIndex, AgentCapabilityGuide, README | **Full rewrite required** — starter subset only |

## Exclude (Archetype Host Only)

| Area | Action | Reason |
| --- | --- | --- |
| `Intake/` | Remove from starter | Source reference; not consumer product |
| `Archive/MigrationReports/` | Remove | Host migration history |
| `Archive/HistoricalReviews/` | Remove | Host review artifacts |
| `Archive/SupersededPlans/` | Remove | Host cleanup |
| Host-only `Plans/` | Remove all not in whitelist | Keep exactly 10 files — see ConsumerRepairSpec § G |
| `Automation/GoogleDriveRepositoryRefresh/` | Remove | Host GDrive mirror tooling |
| `Automation/RepositoryRefresh/` | Remove | Host GDrive mirror tooling (nested path) |
| `Automation/AgentReplies/` | Remove | Host workflow reply artifacts |
| Nested `.git` under `Intake/` | Remove | Stray reference metadata |
| `.git/` at packaging root | Remove (Option A default) | Required when origin is host remote |
| `.claude/`, `.cursor/` | Remove | IDE agent runtime config |
| Host path literals | Replace | `C:\Repositories\GetEstablished` → `<YourProjectName>` guidance |
| `Inbox/` | Remove from starter | Capability-provisioned on Setup |
| `Capabilities/CodeAssistedIndexing/` | Remove from starter | Manual-only starter |
| `Content/OnePageBusinessWebsite/` | Remove from starter | OnePageWebsite when adopted |
| Empty `Workspace/*` child folders | Remove | Core boot files only |
| `Workspace/**/.gitkeep` | Remove | No empty stub folders |
| Host-only Capabilities | Remove | Full list: ConsumerRepairSpec § E |

## Trim To Consumer Subset

All REMOVE/KEEP lists are authoritative in [ConsumerRepairSpec.md](ConsumerRepairSpec.md).
Do not invent lists during repair.

| Area | Guidance |
| --- | --- |
| `Capabilities/` | Remove § E; keep § F; GoogleDriveLink per Step 0 |
| `Plans/` | Whitelist § G only (10 files) |
| `Content/` | Keep `Content/Website/Pages/`; remove OnePageBusinessWebsite, Product |

## Verify Before ZIP

- [ ] **VerifyStarterPackage.ps1** exit code **0**
- [ ] No `AGENTS.md.placeholder`, `README.md.placeholder`, or `STRUCTURE_MANIFEST.md`
- [ ] `Plans/StartHere.md` links only whitelisted Plans files
- [ ] Packaging workspace is **not** the archetype host folder.
- [ ] **Fresh mirror** repair completed (do not assume prior repair).
- [ ] **No `.git`** in packaging workspace (Option A) **or** no `origin` to host repo.
- [ ] No `.claude/` or `.cursor/` in packaging tree.
- [ ] `README.md` describes **Get Established Workspace**, not archetype host.
- [ ] `AGENTS.md` routes Quick Startup **before** host migration backlog.
- [ ] `AGENTS.md` contains **Quick Start** section (see ConsumerBootSnippets).
- [ ] Trigger documented: `Begin Quick Startup from AGENTS.md`.
- [ ] Website link intents use clean-root paths.
- [ ] Public CTA **Get Established** on `Content/Website/Pages/Home.md`.
- [ ] No secrets, tokens, or `.env` files.
- [ ] Quick Startup points to `Workspace/OwnerGoals.md`.
- [ ] `Workspace/` contains boot files only (README, OwnerGoals, OwnerPreferences, ValuableReferences).
- [ ] No `Inbox/` or empty Workspace child scaffolds.
- [ ] Capability folder count matches ConsumerRepairSpec (11 or 12).
- [ ] `RouterIndex.md` row count matches Capability folders.
- [ ] Plans count = **10** (whitelist).
- [ ] `AgentTaskBacklog.md` Ready Next = Quick Startup (not host migration).
- [ ] Boot files clean of host-only Capability names (including RepositorySpawn).
- [ ] `Indexes/` pre-indexed (Step 6b).
- [ ] `CodeAssistedIndexing/` absent.
- [ ] `RepositoryScaffold/` present with IntendedRepositoryTree.md.
- [ ] Post-download GitHub path documented (GitHubWorkflow Setup).
- [ ] ConsumerRepairSpec § K PowerShell verification passed.

## Manual ZIP (v1)

Automation is out of scope. After verification:

1. Owner confirms repair handoff.
2. Zip the packaging workspace folder (exclude `.git` if Option A).
3. Smoke-test: extract → `Begin Quick Startup from AGENTS.md` → GettingStarted.

## Related

- [ConsumerRepairSpec.md](ConsumerRepairSpec.md)
- [ConsumerBootSnippets.md](ConsumerBootSnippets.md)
- [AgentConfigDetach.md](AgentConfigDetach.md)
- [Rules.md](Rules.md)
