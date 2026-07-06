<!--
IndexTitle: Workspace Adoption Prep
IndexDescription: Automatic reset of stale starter boot files when Quick Startup begins in an adopted copy.
IndexType: Capability
CapabilityName: GettingStarted
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-07-06
-->

# Workspace Adoption Prep

**Agents run this automatically** at the start of Quick Startup — before the
greeting and before asking whether to overwrite anything. This is how an adopted
copy (for example `DansRepairServices` copied from `GetEstablishedOnTheWebStartup`
to build `dansrepairservice.com`) becomes **this owner's** workspace instead of
still carrying the starter template's goals.

Do **not** ask the owner for permission to reset stale scaffold content. Reset,
tell them briefly what you did, then continue with
[QuickStartupGreeting.md](QuickStartupGreeting.md).

## When To Run

Run on every **Begin Quick Startup from AGENTS.md** pass until the owner has
filled in their own Owner Goals from a completed first session.

Also run when **any** stale signal is present (see detection below).

## Stale Signals (any one triggers prep)

| Signal | Example |
| --- | --- |
| Owner Goals register is not scaffold-only | Rows about GetEstablishedOnTheWeb.com, building Capabilities, publishing the starter, harmonizing the product repo |
| Valuable References has non-scaffold rows | Real URLs left from a prior project or template smoke test |
| Import section has a prior source path | `Last source path` is not `*(none yet)*` on a fresh adopt |
| Local repository root is still a placeholder | `<YourWebProjectName>`, `<YourProjectName>`, or `GetEstablishedOnTheWebStartup` while the folder name differs |

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
repository folder path (for example `C:\Repositories\DansRepairServices`).

Do **not** wipe WAMP, mirror, or WordPress sections the owner may have already
filled in during a resumed session.

## What NOT To Reset

- `Content/` — example website drafts stay until the owner replaces them
- `Capabilities/`, `Plans/`, `Standards/` — repository machinery
- Owner Goals the owner **already captured in this session's chat** before prep
  ran (rare — prep runs first)

## Owner Message (one line, then continue)

After prep, say something like:

```text
I reset leftover starter goals and references so this workspace matches your
project. Next: a short greeting and five setup questions.
```

Then display [QuickStartupGreeting.md](QuickStartupGreeting.md) — do not ask
"should I overwrite?" or "these look like leftover starter content."

## Packaging Note

The shipped starter must ship with scaffold-only boot files. Repair passes use
[StarterRepositoryPackage/ConsumerRepairSpec.md](../StarterRepositoryPackage/ConsumerRepairSpec.md)
§ H reset lists. This prep catches copies that still inherited product-builder
content.

## Related

- [QuickStartupGreeting.md](QuickStartupGreeting.md)
- [GettingStarted.md](GettingStarted.md)
- [Rules.md](Rules.md)
- [../StarterRepositoryPackage/ConsumerRepairSpec.md](../StarterRepositoryPackage/ConsumerRepairSpec.md)
