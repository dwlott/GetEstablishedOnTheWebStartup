<!--
IndexTitle: Consumer Repair Spec
IndexDescription: Single source of truth for GetEstablishedStartup mirror repair — REMOVE/KEEP lists, file rewrite checklist, and verification commands.
IndexType: Capability
CapabilityName: StarterRepositoryPackage
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-06-19
-->

# Consumer Repair Spec

**Read this during every `GetEstablishedStartup` packaging pass.** Deterministic
lists for repairing a fresh mirror of the `GetEstablished` archetype host into a
**Get Established Workspace** consumer starter. See [WorkflowIndex.md](WorkflowIndex.md)
for step order.

Starter profile: `GetEstablishedStartup`.

Do not use this spec unchanged for `GetEstablishedOnTheWebStartup`. That future
profile needs its own WebPresence keep/remove list, identity rewrite checklist,
and verification commands.

A **fresh mirror resets to ~28 Capability folders** — do not assume a prior
repair persisted.

---

## A. Expected Outcome Counts

| Item | Count | Notes |
| --- | ---: | --- |
| Core Capability folders | **11** | Always (see § F) |
| Optional Capability | **+1** | `GoogleDriveLink` — default **keep full**; owner confirms at Step 0 |
| Mirror Capability (Policy B) | **+1** | `MirrorToWindows` — default **keep full** (docs-only); Step 0 |
| Plans files | **10** | Whitelist only |
| Workspace boot files | **4** | README, OwnerGoals, OwnerPreferences, ValuableReferences |
| `.git` | **0** | Option A default |
| `Intake/` | **0** | Remove |
| `CodeAssistedIndexing/` | **0** | Remove |

**Target Capability count:** **12** folders with Policy B default (see § F + MirrorToWindows).

**RouterIndex parity:** one router table row per remaining `Capabilities/<Name>/`
folder (excluding `SkillRegistry.md` and other non-folder assets at registry root).

---

## B. Host Trees — REMOVE (Step 2)

```text
Intake/
Archive/MigrationReports/
Archive/HistoricalReviews/
Archive/SupersededPlans/
```

Also remove stray nested `.git` metadata (for example under former `Intake/`).

**Agent traps — remove from packaging workspace (Step 2b):**

```text
AGENTS.md.placeholder
README.md.placeholder
STRUCTURE_MANIFEST.md
```

These confuse agents (for example reading `.placeholder` instead of `AGENTS.md`).

---

## C. Automation — REMOVE

```text
Automation/GoogleDriveRepositoryRefresh/
Automation/RepositoryRefresh/
Automation/AgentReplies/
```

---

## D. Automation — KEEP

```text
Automation/IndexHealthCheck/
Automation/README.md          <- rewrite to list IndexHealthCheck only
```

---

## E. Capability Folders — REMOVE (Step 2c)

Remove these folders from the **packaging workspace** only:

```text
Capabilities/CapabilityAudit/
Capabilities/CapabilityCreate/
Capabilities/CapabilityDefinition/
Capabilities/CapabilityHarmonize/
Capabilities/ChatMemoryCapture/
Capabilities/CodeAssistedIndexing/
Capabilities/DropboxLink/
Capabilities/ImportCapabilitiesFromRepository/
Capabilities/ImportOwnerPreferencesFromRepository/
Capabilities/InstructionCapture/
Capabilities/OneDriveLink/
Capabilities/OnePageWebsite/
Capabilities/RepositoryInitialize/
Capabilities/RepositoryLearning/
Capabilities/RepositorySpawn/
Capabilities/StarterRepositoryPackage/
Capabilities/MirrorToDropbox/
```

---

## F. Capability Folders — KEEP (consumer core)

```text
Capabilities/GettingStarted/
Capabilities/RepositoryScaffold/
Capabilities/GitHubWorkflow/
Capabilities/ChatToMarkdown/
Capabilities/ContentReview/
Capabilities/LocalAgentToolSetup/
Capabilities/SituationalAwareness/
Capabilities/AssistedAgenticWorkflow/
Capabilities/ManualIndexing/
Capabilities/Indexing/
Capabilities/MirrorToWindows/   <- Policy B default keep (Step 0)
```

### GoogleDriveLink (owner choice at Step 0)

| Option | Action |
| --- | --- |
| **Keep full** (default) | Leave `Capabilities/GoogleDriveLink/` — for ChatGPT planner + on-demand Drive review |
| Trim to pointer | Remove folder; add README stub only — rarely needed |

GoogleDriveLink is **not** for routine Cursor work. Default: **keep full**.

### MirrorToWindows (Policy B — default at Step 0)

| Option | Action |
| --- | --- |
| **Keep full** (default) | Copy `Capabilities/MirrorToWindows/` — docs-only mirror refresh; reads `Workspace/OwnerPreferences.md` |
| Omit | Remove folder; GoogleDriveLink stub MirrorWorkflow still redirects — prefer keep for routing parity |

**Docs-only:** do not copy `Automation/RepositoryMirror/` into consumer package (RM-5).

Always **remove** `Capabilities/MirrorToDropbox/`, `Capabilities/MirrorToGoogleDrive/`,
and `Capabilities/MirrorToMac/` from packaging workspace.

After keep, update consumer **RouterIndex**, **AgentCapabilityGuide**, **AGENTS.md**
Active Workflow Signals, **SituationalAwareness** §13, and **SourceOfTruthAndMirrorStandard**
to match GE platform mirror routing (consumer-trimmed paths).

**VerifyStarterPackage.ps1:** `-ExpectedCaps 12` when Policy B default.

---

## G. Plans — KEEP (whitelist, Step 2d)

Keep **exactly** these files under `Plans/`:

```text
Plans/README.md
Plans/UserSetupGuide.md
Plans/SampleUserJourney.md
Plans/Ideas.md
Plans/OpenQuestions.md
Plans/RepositoryGoals.md
Plans/RepositorySearchMap.md
Plans/GoalsIdeasPlansCapabilitiesModel.md
Plans/StartHere.md
Plans/AgentTaskBacklog.md
```

**Delete all other** `Plans/*.md` in the packaging workspace.

Rewrite `AgentTaskBacklog.md` to consumer scaffold — see
[ConsumerBootSnippets.md](ConsumerBootSnippets.md).

---

## H. Scaffold Trim (Step 2b)

Per [ScaffoldPolicy.md](ScaffoldPolicy.md). Run **after** Steps 2c and 2d.

```text
Inbox/
Content/OnePageBusinessWebsite/
Content/Product/
Workspace/Assets/
Workspace/Documents/
Workspace/Drafts/
Workspace/Exports/
Workspace/Inbox/
Workspace/Intake/
Workspace/References/
Workspace/Scratch/
Workspace/Templates/
Workspace/**/.gitkeep
```

**Keep:**

```text
Workspace/README.md
Workspace/OwnerGoals.md
Workspace/OwnerPreferences.md
Workspace/ValuableReferences.md
Indexes/                    <- populate in Step 6b; do not remove
```

**Reset Workspace boot files** (every repair pass):

- `Workspace/OwnerGoals.md` — empty scaffold (owner fills on Quick Startup)
- `Workspace/ValuableReferences.md` — empty register from archetype host template
- `Workspace/OwnerPreferences.md` — fresh Import/Indexing rows; `Code-assisted decision: Undecided`

---

## H2. Archive Trim (Step 2b continued)

Remove method-host migration history from `Archive/`. **Keep** `Archive/README.md`
only (consumer-oriented pointer). Remove for example:

```text
Archive/DeprecatedCapabilities/
Archive/StarterRecommission*/
Archive/LegacyDocs/
Archive/DeprecatedWorkflows/
Archive/*.md   (except README.md)
```

---

## H3. Website Content (Step 2c)

If host `Content/Website/` is stub-only, copy publishable pages from the product
repo before consumer rewrite:

```text
Source: C:\Repositories\GetEstablishedOnTheWeb\Content\Website\
Target: <PackagingWorkspace>\Content\Website\
```

Do not copy product `Plans/` or host-only Capabilities.

---

## I. Files Requiring Consumer Rewrite (Step 3)

**Full rewrite required** for registry surfaces — not a optional note at top.

| File | Key changes |
| --- | --- |
| `README.md` | Get Established Workspace identity; `C:\Repositories\<YourProjectName>` |
| `AGENTS.md` | Consumer boot; see [ConsumerBootSnippets.md](ConsumerBootSnippets.md) |
| `Capabilities/RouterIndex.md` | Starter subset only; one row per remaining folder |
| `Capabilities/AgentCapabilityGuide.md` | Starter banner + routing table matching folders |
| `Capabilities/README.md` | Starter registry table only |
| `Plans/AgentTaskBacklog.md` | Ready Next = Quick Startup; no host migration |
| `Plans/RepositorySearchMap.md` | Consumer boot path; Quick Startup before backlog |
| `Plans/RepositoryGoals.md` | Workspace framing, not archetype learning host |
| `Plans/README.md` | Points at 10-file consumer set only |
| `Plans/StartHere.md` | Consumer Plans orientation; Quick Startup via AGENTS.md; whitelist links only |
| `Capabilities/GettingStarted/PostQuickStartupRouting.md` | Step 7 routing; no RepositoryScaffold for packaging validation |
| `Capabilities/GettingStarted/QuickStartupGreeting.md` | Ship with GettingStarted; canonical opening + five questions |
| `Capabilities/GettingStarted/WorkspaceAdoptionPrep.md` | Auto-reset stale boot files and OpenQuestions on Quick Startup; git remote safety prompt |
| `Automation/VerifyStarterPackage.ps1` | Copy from StarterRepositoryPackage; document in Automation/README |
| `Capabilities/GettingStarted/GettingStarted.md` | Step 2 → QuickStartupGreeting; no invented questions; no Import* routing |
| `Capabilities/GettingStarted/Rules.md` | Prior-repo row = manual copy only |
| `Capabilities/GettingStarted/FirstRunAgentPrompts.md` | Archive prompt = record path only |
| `Workspace/ValuableReferences.md` | Empty register; Suggested/Owner-confirmed tiers |
| `Workspace/OwnerPreferences.md` | Fresh Import/Indexing rows; no smoke-test dates |
| `Plans/RepositoryGoals.md` | Consumer workspace framing — see ConsumerBootSnippets |
| `Plans/OpenQuestions.md` | Consumer banner at top (host history preserved below) |
| `Standards/TemplateGuidance.md` | GitHubWorkflow only; no RepositoryInitialize |
| `Standards/CapabilityProvisionedStructure.md` | Lazy-init routes to GitHubWorkflow |
| `Capabilities/Indexing/IndexHealthCheck.md` | No CapabilityAudit links |
| `Standards/IndexHealthStandard.md` | No CapabilityAudit links |
| `Archive/README.md` | Minimal consumer pointer only |
| `Capabilities/SituationalAwareness/Prompt.md` | Generic workspace root |
| `Capabilities/SituationalAwareness/Rules.md` | No host paths; no CodeAssistedIndexing re-offer |
| `Standards/AgentSituationalAwareness.md` | Generic Cursor path; drop deleted Plans references |
| `Automation/README.md` | IndexHealthCheck only |

---

## J. Path And Link Repair (Step 4)

Search packaging workspace for:

```text
C:\Repositories\GetEstablished
Docs/Setup/
Docs/Prompts/
Docs/Project/
Docs/Capabilities/
Intake/
```

Replace per [PackageChecklist.md](PackageChecklist.md) path table. In consumer
`AGENTS.md`, host path may appear **only** as a negative example ("do not assume
`C:\Repositories\GetEstablished`").

Boot files must not reference removed host-only Capability names (for example
`CapabilityAudit`, `InstructionCapture`, `StarterRepositoryPackage`,
`RepositorySpawn`).

Consumer registry surfaces (`Capabilities/README.md`, `RouterIndex.md`,
`AgentCapabilityGuide.md`) must **not** list **RepositorySpawn**. New GitHub repo
routing: **GitHubWorkflow** then **RepositoryInitialize** is host-only — consumer
uses **GitHubWorkflow** SetupPrompt only.

---

## K. Verification (Step 6)

Run **`VerifyStarterPackage.ps1`** in the packaging workspace. It must exit **0**
before status is **Package ready**. Script path (archetype host):

```text
Capabilities/StarterRepositoryPackage/VerifyStarterPackage.ps1
```

Copy the script into the packaging workspace if needed, or run it by path from
the host after repair.

```powershell
Set-Location <PackagingWorkspacePath>
powershell -NoProfile -ExecutionPolicy Bypass -File .\VerifyStarterPackage.ps1
# Or from host:
powershell -NoProfile -ExecutionPolicy Bypass -File C:\Repositories\GetEstablished\Capabilities\StarterRepositoryPackage\VerifyStarterPackage.ps1 -Root C:\Repositories\GetEstablishedStartup
```

Manual spot-checks if the script is unavailable:

```powershell
Set-Location <PackagingWorkspacePath>

# Structure
Write-Host "No .git:" (-not (Test-Path ".git"))
Write-Host "No Intake:" (-not (Test-Path "Intake"))
Write-Host "No CodeAssistedIndexing:" (-not (Test-Path "Capabilities/CodeAssistedIndexing"))
Write-Host "No StarterRepositoryPackage:" (-not (Test-Path "Capabilities/StarterRepositoryPackage"))
Write-Host "No GDrive refresh:" (-not (Test-Path "Automation/GoogleDriveRepositoryRefresh"))

# Counts (adjust expected if GoogleDriveLink trimmed)
$capCount = (Get-ChildItem Capabilities -Directory).Count
$plansCount = (Get-ChildItem Plans -File -Filter "*.md").Count
Write-Host "Capability folders:" $capCount "(expect 11 or 12)"
Write-Host "Plans files:" $plansCount "(expect 10)"

# Boot files exist
@(
  "AGENTS.md", "README.md",
  "Workspace/OwnerGoals.md", "Workspace/OwnerPreferences.md",
  "Capabilities/GettingStarted/GettingStarted.md",
  "Capabilities/RouterIndex.md",
  "Indexes/ChatMarkdownIndex.md"
) | ForEach-Object { Write-Host "$_`: $(Test-Path $_)" }

# Host path in boot files (should be minimal)
Select-String -Path README.md,AGENTS.md -Pattern "C:\\GitHub\\GetEstablished" -SimpleMatch |
  ForEach-Object { Write-Host "Host path in:" $_.Path "line" $_.LineNumber }
```

**Parity checks:**

- [ ] `VerifyStarterPackage.ps1` exit code **0**
- [ ] No `*.placeholder` or `STRUCTURE_MANIFEST.md` at repo root
- [ ] `Plans/StartHere.md` references only the 10-file Plans whitelist
- [ ] Capability folder count = RouterIndex table rows
- [ ] Registry and guide list same Capabilities as folders
- [ ] `AgentTaskBacklog.md` Ready Next = Quick Startup (not host migration)
- [ ] Home page has **Get Established** CTA (`Content/Website/Pages/Home.md`)

**Smoke test trigger (Step 7):**

```text
Begin Quick Startup from AGENTS.md
```

Agent must route to `Capabilities/GettingStarted/` — not stale host backlog first.

---

## Related

- [WorkflowIndex.md](WorkflowIndex.md)
- [ConsumerBootSnippets.md](ConsumerBootSnippets.md)
- [PackageChecklist.md](PackageChecklist.md)
- [ScaffoldPolicy.md](ScaffoldPolicy.md)
