<!--
IndexTitle: Workspace Adoption Prep
IndexDescription: Automatic reset of stale starter boot files and fresh-Git detach when Quick Startup begins in an adopted copy.
IndexType: Capability
CapabilityName: GettingStarted
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-07-16
-->

# Workspace Adoption Prep

**Agents run this automatically** at the start of Quick Startup — before the
greeting and before asking whether to overwrite anything. This is how an adopted
copy of `GetEstablishedOnTheWebStartup` (renamed to the owner's project folder)
becomes **this owner's** workspace instead of still carrying the starter
template's goals or Git remote.

Do **not** ask the owner for permission to reset stale scaffold content. Reset,
tell them briefly what you did, then continue with
[QuickStartupGreeting.md](QuickStartupGreeting.md).

**Preferred adopt path:** copy the starter **without** `.git` (delete `.git`
after an Explorer copy, or run
`Automation/Copy-StartupToProject.ps1`). Then Quick Startup never inherits the
starter remote.

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
| Local repository root is still a placeholder | `<YourWebProjectName>`, `<YourProjectName>`, or `GetEstablishedOnTheWebStartup` while the folder name differs |
| **`Plans/OpenQuestions.md` is product-builder content** | GEOTW storefront launch decisions, free-magnet download URLs, method-host paths |
| **`origin` still points at the starter template** | `git remote -v` shows `GetEstablishedOnTheWebStartup`, archetype host, or product repo while the local folder name differs |

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
decisions, method-host paths), replace the file with the consumer scaffold from
the shipped starter `Plans/OpenQuestions.md` template — one Open row and empty
Decided table. Do **not** preserve host history in adopted copies.

## Git After Folder Copy (automatic — no stop-and-ask)

Preferred owner workflow (document this; do not invent a third path):

```text
1. Copy GetEstablishedOnTheWebStartup → C:\Repositories\<YourProjectName>
   (or run Automation\Copy-StartupToProject.ps1 -DestinationName <YourProjectName>)
2. Delete the copied .git folder if it is still there
3. Open the new folder → Begin Quick Startup from AGENTS.md
4. Connect GitHub later via GitHubWorkflow (git init + new repo)
```

After boot-file reset, check Git state:

```powershell
Test-Path .git
# if .git exists:
git remote -v
git status -sb
```

### Case A — No `.git/` (ideal)

Record in `Workspace/OwnerPreferences.md` § Git remote:

| Field | Value |
| --- | --- |
| Adoption choice | fresh-copy-no-git |
| Origin remote URL | *(none yet)* |

Continue straight to the greeting. Offer GitHub connect later — do **not** block.

### Case B — Stale starter / host remote (auto-detach)

**Stale** when `.git/` exists, the local folder name is **not** the starter/host
name, and `origin` URL contains any of:

- `GetEstablishedOnTheWebStartup`
- `GetEstablishedOnTheWeb` (product repo, not `…Startup`)
- `GetEstablished` (archetype host, not `…Startup`)

**Default action (do this automatically — do not ask):**

1. Tell the owner in one line: the copy still had the starter Git history/remote;
   removing `.git` so this project starts clean.
2. `Remove-Item -Recurse -Force .git`
3. `git init` (local-only empty repo; no `origin` yet)
4. Record adoption choice `removed-starter-git` in OwnerPreferences
5. Continue with the greeting — **do not stop** for park / new-repo / leave-as-is

Owner can connect a new GitHub remote later via **GitHubWorkflow**.

**Exception — only ask** if the owner already said they want to keep starter
history, or `origin` already points at a **different** project remote that
matches the folder name. Do not auto-delete in those cases.

### Case C — `.git/` present, origin already matches this project

Leave Git alone. Continue.

**Never** push to a starter-template or archetype-host remote during adoption prep.

## Owner Intake Files

When the owner attaches source material during Quick Startup (resume, logo,
prior notes):

- Save raw files under `Workspace/Documents/` (create the folder if needed).
- Record the path in `Workspace/OwnerPreferences.md` Import section.
- Do **not** use `Workspace/Reference/` or ad hoc folders for owner uploads.

See [Workspace/README.md](../../Workspace/README.md).

## What NOT To Reset

- `Content/` — **GetEstablishedOnTheWeb example drafts** stay until the owner
  replaces them (see `Content/README.md`)
- `Capabilities/`, `Plans/` machinery (except stale `OpenQuestions.md` per §4)
- Owner Goals the owner **already captured in this session's chat** before prep
  ran (rare — prep runs first)

## Owner Message (one or two lines, then continue)

After prep, say something like:

```text
I reset leftover starter goals, references, and open questions so this workspace
matches your project.
```

If starter `.git` was removed, add one line (for example "Removed the copied
starter `.git` so this project is not linked to GetEstablishedOnTheWebStartup.").

Otherwise:

```text
Next: a short greeting and five setup questions.
```

Then display [QuickStartupGreeting.md](QuickStartupGreeting.md) — do not ask
"should I overwrite?" or "these look like leftover starter content."

## Packaging Note

The shipped starter must ship with scaffold-only boot files and consumer
`Plans/OpenQuestions.md`. Repair passes use
[StarterRepositoryPackage/ConsumerRepairSpec.md](../StarterRepositoryPackage/ConsumerRepairSpec.md)
§ H reset lists. This prep catches copies that still inherited product-builder
content or a starter-template `.git` after Explorer folder copy.

New project copies should use
[Automation/Copy-StartupToProject.ps1](../../Automation/Copy-StartupToProject.ps1)
(or delete `.git` after copy) so Case B is rare.

## Related

- [QuickStartupGreeting.md](QuickStartupGreeting.md)
- [GettingStarted.md](GettingStarted.md)
- [Rules.md](Rules.md)
- [../../Automation/Copy-StartupToProject.ps1](../../Automation/Copy-StartupToProject.ps1)
- [../GitHubWorkflow/SetupPrompt.md](../GitHubWorkflow/SetupPrompt.md)
- [../StarterRepositoryPackage/AgentConfigDetach.md](../StarterRepositoryPackage/AgentConfigDetach.md)
- [../StarterRepositoryPackage/ConsumerRepairSpec.md](../StarterRepositoryPackage/ConsumerRepairSpec.md)
- [../../Plans/StartupRepositoryAudit-20260714.md](../../Plans/StartupRepositoryAudit-20260714.md)
