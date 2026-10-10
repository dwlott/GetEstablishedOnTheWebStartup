<!--
IndexTitle: Workspace Adoption Prep
IndexDescription: Automatic reset of stale starter boot files and Git detach when Quick Startup begins in an adopted copy.
IndexType: Capability
CapabilityName: GettingStarted
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-10-10
-->

# Workspace Adoption Prep

Read this before Quick Startup. Its reset and Git-detach operations apply only
after the active repository is positively classified as an **adopted-project**
copy of `GetEstablishedOnTheWebStartup`. The folder name alone is never enough
to authorize adoption mutations.

Before changing files or Git metadata:

1. Resolve the open repository root.
2. Inspect the Git remote when `.git` exists.
3. Check `Workspace/RepositoryIdentity.md` when it exists.
4. Confirm with the owner that a noncanonical folder is their adopted Startup
   copy when the record has not been created yet.

If the root is either canonical repository, the owner does not confirm
adoption, or the signals conflict, stop and report the ambiguity without
changing files or Git metadata.

Never reset files or remove `.git` from either canonical root:

- `C:\Repositories\GetEstablishedOnTheWeb`
- `C:\Repositories\GetEstablishedOnTheWebStartup`

For an established repository, preserve existing owner goals, preferences,
open questions, and Git history.

Field lesson (2026-09-03, folder `NP` copied from
`GetEstablishedOnTheWebStartup`): asking a blocking Git-remote question stalled
first session. The owner deleted `.git` by hand. **Do not block.** Detach, say
one line, continue.

Human copy steps: [HowToAdoptThisStarter.md](HowToAdoptThisStarter.md).

Do **not** ask permission to reset stale scaffold content. Reset, tell them
briefly what you did, then continue with
[QuickStartupGreeting.md](QuickStartupGreeting.md).

**Example references** in GetEstablishedOnTheWeb starters come from building
**GetEstablishedOnTheWeb** only. Do not cite DansRepairService, MoverCalcs.com,
US1Movers, or other customer websites as templates.

## When To Run

Run only on a noncanonical root that the owner identifies as an adopted Startup
copy, or whose existing `Workspace/RepositoryIdentity.md` records
`Identity mode: adopted-project`. A stale Startup remote in a noncanonical root
is evidence to inspect, not permission by itself.

On the product, canonical Startup, established-project, or ambiguous checkout,
stale signals are review-only; do not run reset or Git-detach actions.

## New Copy Versus Resumed Project

Boot-register resets apply once, to template residue in a confirmed fresh copy.
Nonempty registers, reference URLs, and prior import paths alone are not stale:
they may be the owner's project data. Preserve them in a resumed project.
When a record already declares adopted-project, update identity paths and Git
facts as needed without clearing its owner registers. Resolve conflicting
signals before mutations. Owner confirmation in the current session satisfies
the adoption check; do not ask for it again.

## Stale Signals (confirmed fresh copies only)

| Signal | Example |
| --- | --- |
| Owner Goals are demonstrably leftover template or product goals | Rows about GetEstablishedOnTheWeb.com product launch, building Capabilities, publishing the starter |
| Valuable References contains identified template residue | References known to belong to the template smoke test, rather than this project |
| Import section has a prior source path | `Last source path` is not `*(none yet)*` on a fresh adopt |
| Local repository root is still a placeholder | `<YourWebProjectName>`, `<YourProjectName>`, or a Startup folder name while the current folder name differs |
| **`Plans/OpenQuestions.md` is product-builder content** | GEOTW storefront launch decisions, free-magnet download URLs, method-host paths |
| **Starter Git metadata** | `.git/` exists and `origin` points at a starter or host repo while this folder name is a different project |

## What To Reset (confirmed template residue only)

Apply each reset only when that register contains identified template residue
in a confirmed fresh copy. Otherwise keep the register, including owner data
already captured in chat. Do not erase project facts just because a register
is nonempty.

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

This is a valid adopted state (owner deleted it after copy, or the ZIP had no
Git). **Do not** run `git remote` or `git status`. Record in
`Workspace/OwnerPreferences.md` § Git remote (adoption):

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

**Default action (folder-copy / clone-of-template):** remove `.git` entirely so
this project cannot push to the starter.

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
Preserve existing owner goals and preferences when resuming. Continue.

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

## First-session indexes (optional, after greeting work)

Adoption prep itself does not index. After Owner Goals and references are
written, offer indexing. If `Indexes/` is missing, provision it only through
owner-approved [Indexing Setup](../Indexing/SetupPrompt.md). If it already
exists, refresh it through **ManualIndexing**. Declining indexing does not block
Quick Startup — see [GettingStarted.md](GettingStarted.md).

## Final adopted-project identity phase

After Owner Goals and preferences are captured, and after the optional indexing
decision, every classified adopted project must:

1. Create or complete `Workspace/RepositoryIdentity.md` using
   [RepositoryIdentityTemplate.md](RepositoryIdentityTemplate.md).
2. Rewrite only the active identity surfaces allowed by
   [WebPresenceStartupRepairSpec.md](../StarterRepositoryPackage/WebPresenceStartupRepairSpec.md).
3. Preserve packaging, source-template, and historical references.
4. Run `Automation/Test-AdoptedRepositoryIdentity.ps1` and resolve failures.
5. Report rewritten and intentionally retained identity references in the
   Quick Startup summary.

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
**developer** Startup clone still inherit remotes — this prep and
[HowToAdoptThisStarter.md](HowToAdoptThisStarter.md) are the safety net.

Repair passes: [StarterRepositoryPackage](../StarterRepositoryPackage/WorkflowIndex.md).

## Related

- [HowToAdoptThisStarter.md](HowToAdoptThisStarter.md)
- [QuickStartupGreeting.md](QuickStartupGreeting.md)
- [GettingStarted.md](GettingStarted.md)
- [Rules.md](Rules.md)
- [../GitHubWorkflow/SetupPrompt.md](../GitHubWorkflow/SetupPrompt.md)
- [../StarterRepositoryPackage/AgentConfigDetach.md](../StarterRepositoryPackage/AgentConfigDetach.md)
