<!--
IndexTitle: Workspace Adoption Prep
IndexDescription: Automatic reset of stale starter boot files and Git detach when Quick Startup begins in an adopted copy.
IndexType: Capability
CapabilityName: GettingStarted
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-09-03
-->

# Workspace Adoption Prep

**Agents run this automatically** at the start of Quick Startup — before the
greeting. This is how an adopted copy of a Startup repository becomes **this
owner's** workspace instead of still carrying the template's goals or Git remote.

Field lesson (2026-09-03, folder `NP` copied from
`GetEstablishedOnTheWebStartup`): asking a blocking Git-remote question stalled
first session. The owner deleted `.git` by hand. **Do not block.** Detach, say
one line, continue.

**Preferred adopt path:** copy **without** `.git` — run
`Automation/Copy-StartupToProject.ps1`, or Explorer-copy then delete `.git`.
Then Quick Startup never inherits the starter remote. Human steps:
[HowToAdoptThisStarter.md](HowToAdoptThisStarter.md).

Do **not** ask permission to reset stale scaffold content. Reset, tell them
briefly what you did, then continue with
[QuickStartupGreeting.md](QuickStartupGreeting.md).

**Example references** in this starter come from building
**GetEstablishedOnTheWeb** only. Do not cite DansRepairService, MoverCalcs.com,
US1Movers, or other customer websites as templates.

## When To Run

Run on every **Begin Quick Startup from AGENTS.md** pass until the owner has
filled in their own Owner Goals from a completed first session.

Also run when **any** stale signal is present (see detection below).

## Stale Signals (any one triggers prep)

| Signal | Example |
| --- | --- |
| Owner Goals register is not scaffold-only | Rows about GetEstablishedOnTheWeb.com product launch, building Capabilities, publishing the starter |
| Valuable References has non-scaffold rows | Real URLs left from a prior project or template smoke test |
| Import section has a prior source path | `Last source path` is not `*(none yet)*` on a fresh adopt |
| Local repository root is still a placeholder | `<YourWebProjectName>`, `<YourProjectName>`, or a Startup folder name while the current folder name differs |
| **`Plans/OpenQuestions.md` is product-builder content** | GEOTW storefront launch decisions, free-magnet download URLs, method-host paths |
| **Starter Git metadata** | `.git/` exists and `origin` points at a starter or host repo while this folder name is a different project |

## What To Reset (automatic)

### 1. `Workspace/OwnerGoals.md`

Replace the **Owner Goals Register** table body with the scaffold row only:

```markdown
| Goal | Status | Notes / Next step |
| --- | --- | --- |
| *(capture during Quick Startup)* | Open | | |
```

Keep the file header, How To Use, and Related sections unchanged.

### 2. `Workspace/ValuableReferences.md`

Replace the register with the scaffold row only:

```markdown
| Reference | Used for | Confidence | Status |
| --- | --- | --- | --- |
| *(capture during Quick Startup)* | | Suggested | Open |
```

### 3. `Workspace/OwnerPreferences.md`

Reset **Import** only:

```markdown
| Last source path | *(none yet)* |
| Last import date | *(none yet)* |
```

If **Local repository root** is still a placeholder, set it to the actual
repository folder path (for example `C:\Repositories\<YourWebProjectName>`).

Do **not** wipe WAMP, mirror, or WordPress sections the owner may have already
filled in during a resumed session.

### 4. `Plans/OpenQuestions.md`

When stale product-builder content is detected (GEOTW launch rows, storefront
decisions, method-host paths), replace the file with the consumer scaffold —
one Open row and empty Decided table. Do **not** preserve host history in
adopted copies.

## Git Detach (automatic — do not block)

After boot-file reset, decide Git state **without stopping for a menu**.

### If `.git/` is already gone

This is a valid adopted state (owner used `Copy-StartupToProject.ps1`, deleted
`.git` after copy, or the ZIP had no Git). **Do not** run `git remote` or
`git status`. Record in `Workspace/OwnerPreferences.md` § Git remote (adoption):

| Field | Value |
| --- | --- |
| Adoption choice | fresh-copy-no-git |
| Origin remote URL | *(none)* |

Continue with the greeting.

### If `.git/` exists

Probe only:

```powershell
git remote -v
```

If Git says this is not a repository, treat as `.git` absent and continue.

**Stale origin** when `origin` fetch/push URL contains any of:

- `GetEstablishedOnTheWebStartup`
- `GetEstablishedStartup`
- `GetEstablishedOnTheWeb` (product repo)
- `GetEstablished` (archetype host)

…while the local folder name is **not** that repository name (for example folder
`NP` but remote `…/GetEstablishedOnTheWebStartup.git`).

**Default action:** remove `.git` entirely so this project cannot push to the
starter. Optional next: `git init` for a local-only empty repo with no `origin`.

```powershell
Remove-Item -Recurse -Force .git
```

Run this **only** in the adopted project folder — never in the original Startup
folder, product repo, or method host.

Record:

| Field | Value |
| --- | --- |
| Adoption choice | removed-starter-git |
| Origin remote URL | *(none — will set via GitHubWorkflow later)* |
| Starter template remote parked as | *(n/a)* |

One-line notice, then **continue**. Do not wait for confirmation. Do not commit
or push.

If the owner **already said** to remove Git files, park the remote, or dismissed
an older Git question: apply this default immediately. If they already deleted
`.git` while you were asking, skip Git commands.

**Never** push to a starter-template or archetype-host remote.

**Never** treat a missing `.git` as a failure. `git remote remove origin` after
the folder is no longer a repo is the wrong recovery.

### If origin is already this project's GitHub

Leave Git alone. Record the URL and adoption choice `already-project-remote`.
Continue.

### Owner override (only if they speak first)

If the owner explicitly asks **before or during** prep to keep history: park
`origin` as `starter-template` instead of deleting `.git`. Do not offer this as
a blocking menu.

## Owner Intake Files

When the owner attaches source material during Quick Startup (resume, logo,
prior notes):

- Save raw files under `Workspace/Documents/` (create the folder if needed).
- Record the path in `Workspace/OwnerPreferences.md` Import section.
- Do **not** use `Workspace/Reference/` or ad hoc folders for owner uploads.

See [Workspace/README.md](../../Workspace/README.md).

## What NOT To Reset

- `Content/` — example drafts stay until the owner replaces them
- `Capabilities/`, `Plans/` machinery (except stale `OpenQuestions.md` per §4)
- Owner Goals the owner **already captured in this session's chat** before prep
  ran (rare — prep runs first)

## First-session indexes (after greeting work)

Adoption prep itself does not index. After Owner Goals and references are
written, Quick Startup **provisions `Indexes/` if missing** and runs
**ManualIndexing** by default — see [GettingStarted.md](GettingStarted.md).
Do not leave indexing as an optional later question.

## Owner Message (one or two lines, then continue)

After prep, say something like:

```text
I reset leftover starter goals and references so this workspace matches your
project. Starter Git metadata is detached — this folder is yours. We can
connect GitHub later.
```

If `.git` was already gone:

```text
Boot files are ready. This folder has no Git history yet, which is correct
after a Startup copy. Next: five setup questions.
```

Then display [QuickStartupGreeting.md](QuickStartupGreeting.md) — do not ask
"should I overwrite?" or present a Git-remote multiple-choice that blocks
startup.

## Packaging Note

Shipped starters should omit `.git/` (repair Option A). Folder copies of a
**developer** Startup clone still inherit remotes — this prep,
`Copy-StartupToProject.ps1`, and
[HowToAdoptThisStarter.md](HowToAdoptThisStarter.md) are the safety net.

Repair passes: [StarterRepositoryPackage](../StarterRepositoryPackage/WorkflowIndex.md).

## Related

- [HowToAdoptThisStarter.md](HowToAdoptThisStarter.md)
- [QuickStartupGreeting.md](QuickStartupGreeting.md)
- [GettingStarted.md](GettingStarted.md)
- [Rules.md](Rules.md)
- [../GitHubWorkflow/SetupPrompt.md](../GitHubWorkflow/SetupPrompt.md)
- [../StarterRepositoryPackage/AgentConfigDetach.md](../StarterRepositoryPackage/AgentConfigDetach.md)
