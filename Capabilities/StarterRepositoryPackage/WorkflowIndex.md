<!--
IndexTitle: Starter Repository Package Workflow Index
IndexDescription: Runnable repair index for packaging workspace to consumer starter repository.
IndexType: Capability
CapabilityName: StarterRepositoryPackage
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-06-19
-->

# Starter Repository Package Workflow Index

**Start here.** Runnable repair pass to turn a **packaging workspace** (manual
copy of an archetype host) into a **starter repository** for a named starter
profile.

Deterministic lists: **[ConsumerRepairSpec.md](ConsumerRepairSpec.md)** and
**[WebPresenceStartupRepairSpec.md](WebPresenceStartupRepairSpec.md)**.
Boot templates: **[ConsumerBootSnippets.md](ConsumerBootSnippets.md)**.

If `Capabilities/StarterRepositoryPackage/` were removed, these instructions
would be lost. Operational steps live in this Capability.

---

## When To Run This Index

Run when **all** are true:

- The owner copied the archetype host to a **staging folder** (packaging workspace).
- The output should become a **consumer starter repository** (ZIP / download).
- Git, host-only folders, or identity text still reflect the development host.
- The starter profile is named and has an active repair spec.

**Do not run on the archetype host** unless the owner explicitly names that
folder as the packaging workspace for this pass.

**Do not run** when:

- The owner wants a **new empty GitHub repo** → use **GitHubWorkflow** +
  **RepositoryInitialize**.
- The consumer already has a downloaded starter and needs first-session help →
  use **GettingStarted**.

---

## Three Roles

| Role | Typical path | Agent may edit? |
| --- | --- | --- |
| **Archetype host** | `C:\Repositories\GetEstablished` | **No** during this pass |
| **Packaging workspace** | `C:\Repositories\GetEstablishedStartup` | **Yes** |
| **Starter repository** | Output of this index | Result of repairs |

## Starter Profiles

| Profile | Host | Status | Repair spec |
| --- | --- | --- | --- |
| `GetEstablishedStartup` | `C:\Repositories\GetEstablished` | Active | [ConsumerRepairSpec.md](ConsumerRepairSpec.md) |
| `GetEstablishedOnTheWebStartup` | `C:\Repositories\GetEstablishedOnTheWeb` | Active | [WebPresenceStartupRepairSpec.md](WebPresenceStartupRepairSpec.md) |

Stop if the requested profile is planned or missing a repair spec.

---

## Step 0 — Confirm Runtime

| Question | If yes | If no |
| --- | --- | --- |
| Is this pass scoped to the **packaging workspace** only? | Continue | Stop; confirm folder path with owner |
| Does the packaging folder exist and contain `AGENTS.md`? | Continue | Stop; wrong folder or incomplete copy |
| Is the archetype host path recorded in the handoff? | Continue | Ask owner for host path |
| Is the starter profile active and named? | Continue | Stop; choose or define profile |
| Is this a **fresh mirror** of the host? | **Full repair required** — expect ~28 Capability folders | Still verify counts |

**Fresh mirror rule:** Every new copy from the archetype host resets to the full
host tree (~28 Capabilities, ~170 Plans files, host `AGENTS.md`). **Do not assume
a prior repair persisted.**

Confirm at Step 0:

- **GoogleDriveLink:** keep full folder (default) or trim to README pointer only
  — see [ConsumerRepairSpec.md](ConsumerRepairSpec.md) § F.

Record in handoff:

```text
Packaging workspace: <absolute path>
Archetype host: <absolute path>
Starter profile: GetEstablishedStartup | GetEstablishedOnTheWebStartup | other active profile
Repair spec: ConsumerRepairSpec | WebPresenceStartupRepairSpec | other
Fresh mirror: yes | no
GoogleDriveLink: keep full | trim
Host origin detected: <url or none>
Git detach: Option A (default) | B | C
Agent config detach: pending | complete
```

---

## Step 1 — Git And Agent Detach (Required For Host Copy)

Run in the **packaging workspace** only. Read [AgentConfigDetach.md](AgentConfigDetach.md).

```powershell
cd <PackagingWorkspacePath>
git status -sb
git remote -v
git log -3 --oneline
```

### 1a — Interpret

| Finding | Risk | Action |
| --- | --- | --- |
| `origin` → host repo (for example `GetEstablished.git`) | Push could overwrite host history | **Required:** Option A + agent config detach |
| Same remote as archetype host in a multi-root workspace | Two folders show identical sync state | Expected after copy; detach before any push |
| Divergent commits vs host (different SHAs, same files) | Duplicate history noise | Option A recommended |
| No `.git` folder | Already detached | Skip Git removal; still scan agent config |

### 1b — Apply Git Detach (Default Option A)

**Spawn startup default:** remove `.git` entirely when the packaging workspace
was copied from the host and `origin` is the host remote.

See [Rules.md](Rules.md) Git Repair Options:

- **Option A (default):** Remove `.git` entirely — **required** for GetEstablishedStartup packaging.
- **Option B:** `git remote remove origin` only if owner explicitly keeps history locally.
- **Option C:** Remove host `origin`; new remote later.

```powershell
# Option A — after owner confirms or spawn-default applies
Remove-Item -Recurse -Force .git
```

**Never push** to the host remote during this pass.

### 1c — Remove Agent Runtime Config

Per [AgentConfigDetach.md](AgentConfigDetach.md), remove from packaging workspace:

```text
.claude/
.cursor/          (any nested path, including under Intake/)
**/.git/          (any nested stray .git)
```

Do **not** remove `AGENTS.md`.

Report after detach step:

```text
Git detach applied: <A|B|C>
Host origin before detach: <url>
.git removed: yes | no
Agent config paths removed: <list>
```

---

## Step 2 — Remove Host-Only Trees

Use the active repair spec for the starter profile:

| Profile | Spec | Step 2 removals |
| --- | --- | --- |
| `GetEstablishedStartup` | [ConsumerRepairSpec.md](ConsumerRepairSpec.md) § B, § C | Intake, Archive subsets, Automation refresh |
| `GetEstablishedOnTheWebStartup` | [WebPresenceStartupRepairSpec.md](WebPresenceStartupRepairSpec.md) § Remove Matrix | Full Intake, Archive, product Workspace subtrees |

**GetEstablishedStartup** default removals:

```text
Intake/
Archive/MigrationReports/
Archive/HistoricalReviews/
Archive/SupersededPlans/
Automation/GoogleDriveRepositoryRefresh/
Automation/RepositoryRefresh/
Automation/AgentReplies/
```

Also remove stray nested Git metadata (for example under former `Intake/`).

**Do not delete** without listing paths in the handoff. Delete in packaging
workspace only.

---

## Step 2c — Capability Subset Trim

Remove host-only Capability folders **before** registry rewrite.

| Profile | Spec | Target count |
| --- | --- | --- |
| `GetEstablishedStartup` | [ConsumerRepairSpec.md](ConsumerRepairSpec.md) § E, § F | **11** or **12** |
| `GetEstablishedOnTheWebStartup` | [WebPresenceStartupRepairSpec.md](WebPresenceStartupRepairSpec.md) § Keep Matrix | **24** |

**GetEstablishedStartup:** full list [ConsumerRepairSpec.md](ConsumerRepairSpec.md) § E.
**Keep** consumer core (§ F). Apply GoogleDriveLink choice from Step 0.

After trim, verify folder count matches the active profile target.

Record removed Capability paths in handoff.

---

## Step 2d — Plans Whitelist Trim

| Profile | Spec | Target count |
| --- | --- | --- |
| `GetEstablishedStartup` | [ConsumerRepairSpec.md](ConsumerRepairSpec.md) § G | **10** |
| `GetEstablishedOnTheWebStartup` | [WebPresenceStartupRepairSpec.md](WebPresenceStartupRepairSpec.md) § Keep Matrix | **14** (+ extension spec additions) |

Delete all other `Plans/*.md` in the packaging workspace not listed in the active spec.

Record Plans removed count in handoff.

---

## Step 2b — Scaffold Trim (Lazy Scaffold)

Apply [ScaffoldPolicy.md](ScaffoldPolicy.md) and [ConsumerRepairSpec.md](ConsumerRepairSpec.md) § H.
Run **after** Steps 2c and 2d so counts are stable.

Consumer starter ships **core scaffold only**; Capability-owned folders appear
when Setup runs.

**Do not remove `Indexes/`.** Populate in Step 6b.

**Ensure core Workspace boot files remain:**

```text
Workspace/README.md
Workspace/OwnerGoals.md
Workspace/OwnerPreferences.md
Workspace/ValuableReferences.md
```

Copy **RepositoryScaffold** from archetype host if missing.

Record trimmed paths in handoff.

---

## Step 3 — Identity Repair

Rewrite consumer-facing boot files in the **packaging workspace**.
Checklist: active repair spec § Identity Rewrite Rules.
Templates:

| Profile | Boot snippets |
| --- | --- |
| `GetEstablishedStartup` | [ConsumerBootSnippets.md](ConsumerBootSnippets.md) |
| `GetEstablishedOnTheWebStartup` | [WebPresenceBootSnippets.md](WebPresenceBootSnippets.md) |

### README.md

- Product: **Get Established Workspace** / **Get Established Repository**.
- Public site: GetEstablishedOnTheWeb.com; CTA: **Get Established**.
- Remove archetype-host framing.
- Replace host path with `C:\Repositories\<YourProjectName>`.
- Keep Source Of Truth table.

### AGENTS.md

- **Quick Start** table at top after intro — see [ConsumerBootSnippets.md](ConsumerBootSnippets.md).
- **Quick Startup before backlog** — do not boot from host migration backlog.
- Trigger: **`Begin Quick Startup from AGENTS.md`** (case-insensitive).
- Heuristic: owner says `agents.md` → read `AGENTS.md` at repo root.
- RouterIndex first for routing; consumer Capability subset only.
- No Intake, no host-only Capability discovery list.
- Link GettingStarted and GitHubWorkflow SetupPrompt.

### Registry — full rewrite required

Update **all four surfaces** to match remaining Capability folders:

- `Capabilities/RouterIndex.md`
- `Capabilities/AgentCapabilityGuide.md`
- `Capabilities/README.md`
- `AGENTS.md` Capability Discovery (or equivalent section)

**Do not** add only a note at top while host rows remain. One router row per
remaining folder. **Do not** list **RepositorySpawn** (retired on method host).

Record every file edited in handoff.

---

## Step 4 — Path And Link Repair

Search packaging workspace per [ConsumerRepairSpec.md](ConsumerRepairSpec.md) § J:

```text
C:\Repositories\GetEstablished
Docs/Setup/
Docs/Prompts/
Docs/Project/
Docs/Capabilities/
Intake/
```

Replace with clean-root paths per [PackageChecklist.md](PackageChecklist.md).

Verify website pages under `Content/Website/Pages/` — link intents should
match starter tree.

---

## Step 6 — Verify

Run **`VerifyStarterPackage.ps1`** — must exit **0** before **Package ready**.

```powershell
powershell -NoProfile -ExecutionPolicy Bypass -File `
  C:\Repositories\GetEstablished\Capabilities\StarterRepositoryPackage\VerifyStarterPackage.ps1 `
  -Root <PackagingWorkspacePath>
```

Also run [PackageChecklist.md](PackageChecklist.md) checkboxes and
[ConsumerRepairSpec.md](ConsumerRepairSpec.md) § K.

Confirm [ScaffoldPolicy.md](ScaffoldPolicy.md): Workspace contains boot files only.
No root `*.placeholder` or `STRUCTURE_MANIFEST.md`.

**If verify fails:** do not mark **Package ready**. Fix blockers, re-run Step 6,
then Step 6b only after pass.

**Parity:**

- Capability folder count = RouterIndex rows
- Plans count = 10
- `AgentTaskBacklog.md` Ready Next = Quick Startup

Set handoff status: **Package ready** | **Package not ready** (list blockers).

---

## Step 6b — Index The Starter (Last Step)

Do this **after** all trims and identity repairs are verified.

1. Confirm `Capabilities/Indexing/` and `Capabilities/ManualIndexing/` present;
   `Capabilities/CodeAssistedIndexing/` **absent**.
2. Provision `Indexes/` via [../Indexing/SetupPrompt.md](../Indexing/SetupPrompt.md)
   if missing.
3. Populate indexes by hand via [../ManualIndexing/Prompt.md](../ManualIndexing/Prompt.md).
4. Verify `Indexes/ChatMarkdownIndex.md` and `Indexes/FollowThroughIndex.md`
   reflect the final tree.

Record populated index files in handoff.

---

## Step 7 — ZIP Handoff (Owner Action)

Agent documents; owner executes v1 ZIP:

1. Confirm **Package ready** in handoff.
2. Close editors locking the folder.
3. Compress packaging workspace (exclude `.git` if Option A).
4. **Smoke test:** extract elsewhere → open in editor → run:

   ```text
   Begin Quick Startup from AGENTS.md. Full first-session order.
   This is not an app launch.
   ```

   Agent must route to GettingStarted and complete the human session (not
   verify-only). See [FirstRunStreamlinePlan.md](../../Plans/FirstRunStreamlinePlan.md).

---

## End Handoff Block

End with exactly one fenced `text` block:

```text
Summary
Packaging workspace
Archetype host
Fresh mirror (yes / no)
Git repair applied
Host-only paths removed
Capability folders remaining (count)
Plans files remaining (count)
Identity files changed
Starter indexed (yes / no; index files)
Instruction gaps found (host — next archetype pass)
Instruction enhancements applied (packaging workspace)
Package status (ready / not ready)
Files Changed
Planning Files To Review
Questions Added Or Changed
Next Recommended Task
```

When instructions were wrong or incomplete, record gaps under **Instruction gaps
found** — do not leave learnings only in chat. See [Rules.md](Rules.md).

---

## Related

- [ConsumerRepairSpec.md](ConsumerRepairSpec.md)
- [ConsumerBootSnippets.md](ConsumerBootSnippets.md)
- [Rules.md](Rules.md)
- [ScaffoldPolicy.md](ScaffoldPolicy.md)
- [AgentConfigDetach.md](AgentConfigDetach.md)
- [PackageChecklist.md](PackageChecklist.md)
- [Prompt.md](Prompt.md)
