<!--
IndexTitle: CapabilityCreate Structure
IndexDescription: Suggested Capability module layout and example provisioned paths — adapt per repository, not a fixed mkdir list.
IndexType: Capability
CapabilityName: CapabilityCreate
CapabilityVersion: 1
LastEdited: 2026-06-05
-->

# CapabilityCreate Structure

## How to read this file

Paths below are **starting ideas**. The agent running **CapabilityCreate** must:

1. Complete placement analysis in [Rules.md](Rules.md).
2. Keep, rename, or **delete** each proposed path with a one-line reason in the new Capability `README.md` or `Rules.md`.
3. Add `SetupPrompt.md` only for paths the Capability **owns** and the owner will run once.

**CapabilityCreate itself** only creates `Capabilities/<NewName>/` plus registry
and routing docs — not business intake trees unless the new Capability's Setup
explicitly requires them.

## A. Always create (Capability module)

Use [CapabilityModuleTemplate.md](CapabilityModuleTemplate.md) and
[CapabilityMetadataStandard.md](../../Standards/CapabilityMetadataStandard.md).

```text
Capabilities/<CapabilityName>/
  README.md
  Prompt.md
  Rules.md                    (recommended)
  Structure.md                (optional; if provisioned paths possible)
  SetupPrompt.md              (only if Setup is justified)
  Examples.md                 (optional)
```

Legacy path name in older notes: `Docs/Capabilities/<CapabilityName>/` — clean
root uses `Capabilities/<CapabilityName>/`.

`<CapabilityName>` = PascalCase, matches registry (for example `DropboxLink`).

## B. Suggested updates outside the module

```text
Capabilities/README.md
Capabilities/AgentCapabilityGuide.md
AGENTS.md                             (Capability Discovery row when Active)
Plans/OpenQuestions.md
```

## C. Example provisioned paths (pick zero or one pattern)

### Pattern 1 — Documentation-only integration (no new folders)

Use when connect steps live outside the repo (OAuth in vendor UI) and operation is checklist-only.

```text
(no repo mkdir)
```

Document external paths in `Rules.md`. Optional pointer under `Automation/README.md`.

### Pattern 2 — Automation-first (archetype host friendly)

Use for Dropbox/Drive-style links on GEOTW-like repos without mail intake.

```text
Automation/<CapabilityName>/
  README.md                 (what the script or manual steps do)
```

Do **not** default to `Owner/` for scripts or API notes.

### Pattern 3 — Shared intake (commissioned envelope)

Use when files arrive in bulk and need triage. Align with a commissioned instance's `Inbox/` conventions.

```text
Inbox/
  <Channel>/                  (for example CloudExports/ or DropboxIncoming/)
    README.md
    Incoming/
    Archive/
Indexes/
  InboxFileIndex.md           (create or extend via Setup + Indexing)
```

Only on repos where **EmailIntake** / envelope rules already apply or owner approved intake.

### Pattern 4 — Project-held integration spec

Use when the workflow is planning and configuration, not file drop.

```text
Docs/Project/<CapabilityName>Integration.md
```

Link from Capability `README.md`; do not duplicate long specs inside `Prompt.md` fenced block.

## D. Anti-patterns (do not propose without explicit owner ask)

```text
Owner/<CapabilityName>/          # wrong — Owner is for owner content, not modules
Docs/Capabilities/foo/data/    # wrong — no data lakes inside Capability docs
Content/Website/Pages/...      # wrong — unless Capability is website authoring
.env / secrets/                # never
```

## E. Registry metadata (suggested row shape)

| Column | Example |
| --- | --- |
| Tier | Universal |
| Capability | DropboxLink |
| User intent (short) | Connect Dropbox; export triage |
| Status | Active |
| Version | 1 |
| Entry | Prompt.md |
| Rules | Rules.md |

## Related

- [Rules.md](Rules.md) — placement matrix
- [CapabilityProvisionedStructure.md](../../Standards/CapabilityProvisionedStructure.md)
