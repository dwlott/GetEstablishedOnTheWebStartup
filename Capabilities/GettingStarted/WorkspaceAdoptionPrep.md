<!--
IndexTitle: Workspace Adoption Prep
IndexDescription: Automatic reset of stale starter boot files and git-remote safety when Quick Startup begins in an adopted copy.
IndexType: Capability
CapabilityName: GettingStarted
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-07-14
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

## Git Remote Safety (detect — owner chooses)

After boot-file reset, if `.git/` exists, run:

```powershell
git remote -v
git status -sb
```

**Stale origin** when `origin` fetch/push URL contains any of:

- `GetEstablishedOnTheWebStartup`
- `GetEstablishedOnTheWeb` (product repo)
- `GetEstablished` (archetype host)

…while the local folder name is **not** that repository name (for example folder
`MyBusinessSite` but remote `…/GetEstablishedOnTheWebStartup.git`).

When stale, **stop before the five setup questions** and ask the owner to choose.
Do **not** commit or push until resolved. Explain in plain language: pushing now
would send this project's content to the **starter template** repository.

**Present these options (numbered):**

1. **Park it (recommended default)** — rename `origin` to `starter-template` so
   accidental pushes to the template are blocked; keep the URL as reference.
2. **Create new GitHub repo now** — use **GitHubWorkflow**
   ([SetupPrompt.md](../GitHubWorkflow/SetupPrompt.md)) with `gh repo create` for
   the owner's project name; set `origin` to the new repo.
3. **Remove origin entirely** — local-only Git until the owner connects GitHub later.
4. **Leave as-is for now** — owner accepts the risk; record that choice; never push
   without explicit owner request.
5. **Other** — owner describes a different approach.

After the owner chooses, record in `Workspace/OwnerPreferences.md` § Git remote
(adoption). Then continue with [QuickStartupGreeting.md](QuickStartupGreeting.md).

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

If git remote was stale and the owner resolved it, add one line about what changed
(for example "Parked starter template remote as starter-template.").

If git remote still needs a choice, ask that **before** the greeting.

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
content or a starter-template `origin` after folder copy or `git clone`.

## Related

- [QuickStartupGreeting.md](QuickStartupGreeting.md)
- [GettingStarted.md](GettingStarted.md)
- [Rules.md](Rules.md)
- [../GitHubWorkflow/SetupPrompt.md](../GitHubWorkflow/SetupPrompt.md)
- [../StarterRepositoryPackage/AgentConfigDetach.md](../StarterRepositoryPackage/AgentConfigDetach.md)
- [../StarterRepositoryPackage/ConsumerRepairSpec.md](../StarterRepositoryPackage/ConsumerRepairSpec.md)
- [../../Plans/StartupRepositoryAudit-20260714.md](../../Plans/StartupRepositoryAudit-20260714.md)
