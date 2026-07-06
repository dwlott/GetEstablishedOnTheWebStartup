<!--
IndexTitle: Repository Core Standard
IndexDescription: Parent-generic rules for Capability and Skill registries, repository roles, provisioned structure, and indexing profiles across related repositories.
IndexType: Standard
IndexStatus: Active
LastEdited: 2026-05-30
-->

# Repository Core Standard

## Purpose

Define how **Get Established On The Web** and related repositories package workflow instructions so humans and agents can compare, adopt, and improve them consistently.

This standard is **parent-generic**. It does not include customer-specific folders, business intake paths, or code-repo VBA rules. Those belong in envelope or code repositories.

**Capability tiers:** [RepositoryArchetypeAndCapabilityTiers.md](RepositoryArchetypeAndCapabilityTiers.md) (Universal, Archetype, Commissioned).  
**Reference commissioned instance:** US1Movers `Docs/Standards/CapabilityStandard.md` and `Docs/Capabilities/`.  
**Comparison map:** [CrossRepoCapabilityGapMatrix.md](../Project/CrossRepoCapabilityGapMatrix.md).

## Repository Roles

| Role | Example | Workflow packaging | Owner content |
| --- | --- | --- | --- |
| **Archetype host (parent)** | GetEstablishedOnTheWeb | Archetype + universal catalog; legacy `Docs/Prompts/` during migration | `Owner/` for product; teaches Get Established |
| **Commissioned instance** | US1Movers | Universal + archetype adopters + commissioned Capabilities | `Planning/`, `PossibleWebPages/`, `Owner/` |
| **Code / system repo** | MoverCalcs | `Automation/AgentCommands/` + standards + generated indexes | Plans, VBA, outputs — not web-presence Capabilities |

Child repositories should read the parent standard and declare **ParentCapability** when adapting a workflow module.

## What Is A Capability

A **Capability** is a bounded, swappable unit of workflow instructions. It holds **how** work is done.

| Belongs in Capabilities | Does not belong in Capabilities |
| --- | --- |
| Copy-ready prompts, review checklists, index refresh rules | Customer-facing page copy as final content |
| Output folder pointers and stop conditions | Invented business, legal, or pricing claims |
| Links to AGENTS.md and standards | One-off chat notes without promotion to Rules |

Capabilities are not a substitute for `Docs/Project/` planning files, `Owner/` content, or `Content/` website drafts.

## What Is A Skill

A **Skill** is an optional, agent-executable implementation package owned by a
Capability. A Skill holds runnable **how-to-execute** instructions, usually in a
`SKILL.md` file, while the owning Capability remains the source of truth for
purpose, rules, tier, data boundaries, and setup boundaries.

| Skill rule | Meaning |
| --- | --- |
| Capability-owned | Canonical Skills live under `Docs/Capabilities/<CapabilityName>/Skills/<SkillName>/` |
| Optional | Most Capabilities do not need a Skill |
| Subordinate | A Skill never replaces the owning Capability |
| Back-referenced | Each `SKILL.md` names its owning Capability |
| Runtime-neutral | Do not create `.cursor/skills/` or other runtime adapters until a runtime is adopted |

Use Skills for deterministic or repeated execution paths. Keep judgment-heavy
workflows as Capability prompts and rules until a repeatable executable step is
clear.

## Registry

Every repository using Capabilities must maintain:

- `Docs/Capabilities/README.md` — registry table (required)
- `Docs/Capabilities/SkillRegistry.md` — Skill discovery table when any Skill
  is planned, active, or runtime-adapted
- Optional: intent routing guide (US1 uses `AgentCapabilityGuide.md`)

Open the registry before starting a workflow task. Registry columns should stay comparable across repos:

| Column | Meaning |
| --- | --- |
| Capability | PascalCase canonical name |
| User intent (short) | Plain-language routing |
| Status | Active, Planned, Deprecated, Stub |
| Version | Integer; bump on material behavior change |
| Last material change | Date + short note |
| Entry | Link to Prompt.md, SetupPrompt.md, or legacy prompt |
| Tier | `Universal`, `Archetype`, `Commissioned`, or `N/A` — see [RepositoryArchetypeAndCapabilityTiers.md](RepositoryArchetypeAndCapabilityTiers.md) |

GetEstablishedOnTheWeb registry is in migration stub form until prompts move under `Docs/Capabilities/<Name>/`.

## Capability Tiers

Three tiers explain which modules belong on the parent archetype host versus a commissioned child. Full definitions: [RepositoryArchetypeAndCapabilityTiers.md](RepositoryArchetypeAndCapabilityTiers.md).

| Tier | GetEstablishedOnTheWeb | Commissioned child (example US1) |
| --- | --- | --- |
| **Universal** | Catalog; migrate from prompts (ChatToMarkdown, Indexing, LocalAgentToolSetup) | Often **Active** first |
| **Archetype** | Product website, reviews, template, setup markdowns | Adopted; may diverge (ContentReview) |
| **Commissioned** | Not implemented on parent | EmailIntake, tax, domain-specific rules |

## Folder Layout

```text
Docs/Capabilities/
  README.md                 <- registry (required)
  SkillRegistry.md          <- flat Skill discovery table (when Skills exist or are planned)
  <CapabilityName>/
    README.md               <- purpose, version, inputs, outputs, when to use
    Prompt.md               <- copy-ready fenced text block (required when Active)
    Rules.md                <- optional durable constraints
    SetupPrompt.md          <- optional; creates provisioned paths only
    Structure.md            <- optional; folder spec for Setup-owned paths
    Examples.md             <- optional
    Skills/                 <- optional; only when a Skill exists
      <SkillName>/
        SKILL.md            <- required for a Skill
        SetupPrompt.md      <- optional; only when the Skill provisions paths or helpers
        scripts/            <- optional; provisioned only by SetupPrompt
        prompts/            <- optional
        examples/           <- optional
```

Use a folder when a Capability needs Prompt plus Rules or examples. During migration, the legacy file may remain in `Docs/Prompts/` until a scoped move task copies it into `Prompt.md` and leaves a stub redirect.

Do not create a `Skills/` folder under documentation-only Capabilities or as a
placeholder. Add it only when a scoped Skill pass creates a real `SKILL.md`.

## Prompt And Metadata Rules

- One primary copy-ready fenced `text` block per `Prompt.md`.
- Instructions, changelog, and prompt history stay **outside** the fenced block.
- Use HTML metadata per [MarkdownIndexMetadataStandard.md](MarkdownIndexMetadataStandard.md).
- Recommended Capability fields: `IndexType: Capability`, `CapabilityName`, `CapabilityVersion`, `LastEdited`, optional `ParentCapability`.
- Recommended Skill fields: `IndexType: Skill`, `SkillName`, `Capability`,
  `SkillVersion`, `LastEdited`, optional `Runtime`.

Each Active Capability `README.md` should end with a **Capability Changelog** table. Each `Prompt.md` should include **Prompt history** below the fenced block.

Each Skill `SKILL.md` should include:

- A short metadata block using the Skill fields above.
- Runtime-compatible front matter when useful.
- The owning Capability path.
- Inputs, outputs, stop conditions, and data boundaries when applicable.
- A clear note when scripts, generated indexes, runtime adapters, or external
  systems are out of scope.

### Data Boundaries (Conditionally Required)

A Capability that touches **owner information, customer content, inbox or scan intake, or any external system** must include a **Data boundaries** section in its `README.md` or `Rules.md`. The section should state:

- What data the Capability may read or write.
- What it must never store, invent, or expose (for example credentials, business/legal/pricing claims, or private owner facts).
- Where outputs are allowed to land.

This section is **not required** for Capabilities that only operate on repository workflow files and touch none of the data above.

## Parent And Child Repositories

**Parent (GetEstablishedOnTheWeb):**

- Ships generic Capabilities and review prompts.
- Maintains [CrossRepoCapabilityGapMatrix.md](../Project/CrossRepoCapabilityGapMatrix.md).
- Does not store child customer material.

**Child (commissioned instances such as US1Movers):**

- Adopts or diverges from parent Capabilities.
- Documents divergence in README when `ParentCapability` is set:

```markdown
## Divergence from parent

| Topic | Parent (GEOTW) | Child | Reason |
| --- | --- | --- | --- |
```

- Links parent via `Docs/Setup/ParentWorkflowLink.md` (child repo file).

**Rules:**

- Do not copy child `.git` or customer content into the parent.
- Do not global-replace repository names in parent docs.
- Commits stay repository-specific in multi-root workspaces.

## Provisioned Structure (Generic Pattern)

Some Capabilities need folders that must not be created during unrelated agent tasks.

| Concept | Rule |
| --- | --- |
| **Provisioner** | The Capability that owns a path |
| **Structure.md** | Lists folders, README hooks, and index files Setup may create |
| **SetupPrompt.md** | Only normal way to create owned paths; owner agrees in session |
| **Operate prompt** | Lists or triages files; if structure missing, offer Setup — do not `mkdir` |

**Parent template:** Document the pattern only. Do not create envelope intake folders (for example mail or scan inboxes) on GetEstablishedOnTheWeb unless a future approved Capability needs them. See [CapabilityProvisionedStructure.md](CapabilityProvisionedStructure.md).

**Commissioned instance:** May provision paths such as `Inbox/<Channel>/Incoming/` per commissioned Capability `Structure.md`. See US1 `CapabilityProvisionedStructure.md` (envelope detail).

Skills follow the same provisioned-structure rule. A Skill may include
`scripts/`, `prompts/`, `examples/`, generated-output paths, or runtime adapter
folders only when its own `SetupPrompt.md` or an explicit in-session task
approves that structure.

## Indexing Profiles

Repositories use different index mechanisms. Do not merge them without an explicit task.

| Profile | Typical repo | Source of truth | Agent rule |
| --- | --- | --- | --- |
| **Markdown metadata** | GEOTW, US1 | `<!-- Index: ... -->` on folder READMEs; metadata block on important `.md` files | Refresh map and housekeeping; future index builder |
| **Chat and source indexes** | US1 envelope | `Indexes/*.md` (for example chat markdown, followthrough, inbox file ledger) | Run **Indexing** Capability; do not move `Planning/` bodies during index-only passes |
| **Generated code indexes** | MoverCalcs | `Indexes/VBAIndexes/*.tsv`, `Indexes/RepoIndexes/` | Index-first reads; regenerate with index builders after source edits — never hand-edit generated TSV |

When a Capability named **Indexing** exists, its `Rules.md` must state which profile it uses.

## Review-Only Versus Implementation

Align with [RepositoryQualityReviewPlan.md](../Project/RepositoryQualityReviewPlan.md):

- **Review-only passes** produce findings in dated review files, backlog notes, or open questions. No scoring, certification, or "AI proved excellent" claims.
- **Implementation passes** change prompts, Capabilities, content, or structure after a scoped approval.

Quality **review** workflows may stay as `Docs/Prompts/*ReviewPrompt.md` until migrated. Prefer the `Review*` Capability prefix when migrating (for example `ReviewRepositoryStructure`).

## Code Repository Profile (MoverCalcs)

MoverCalcs does not use `Docs/Capabilities/` for primary workflows. Equivalent modules live under `Automation/AgentCommands/` with launchers and durable outputs under `Docs/Plans/`.

Cross-repo comparison maps:

| Canonical name | MoverCalcs module |
| --- | --- |
| RepositoryStructureReview | `RepositoryAudit` + repository enhancement workflow |
| VBAAudit / enhancement | VBA audit + enhancement workflow |

See [CrossRepoCapabilityGapMatrix.md](../Project/CrossRepoCapabilityGapMatrix.md) section I.

## Migration From Docs/Prompts (GetEstablishedOnTheWeb)

**Current state:** Workflow tools live in `Docs/Prompts/`. Registry stub: [Docs/Capabilities/README.md](../Capabilities/README.md).

**Migration rules:**

1. One Capability per scoped worker pass unless the user approves a batch. For net-new modules (not legacy prompt moves), use **CapabilityCreate** ([Prompt.md](../Capabilities/CapabilityCreate/Prompt.md)) so placement and tier are chosen before any Setup-owned paths.
2. Copy prompt body into `Docs/Capabilities/<Name>/Prompt.md`; keep **Prompt history**.
3. Add Capability `README.md` with changelog row.
4. Update registry row from Stub to Active.
5. Replace `Docs/Prompts/<OldName>.md` with a short stub pointing to the Capability (optional in same pass).
6. Update `Docs/Prompts/README.md` and this registry.

**Suggested P1 order:** `ContentReview`, `ChatToMarkdown`, `ChatMemoryCapture`.

## Agent Discovery

Before a workflow task on any repo in this family:

1. Read root `AGENTS.md`.
2. Open `Docs/Capabilities/README.md` (or child equivalent).
3. If the task asks for a Skill or `SKILL.md`, open
   `Docs/Capabilities/SkillRegistry.md` if present.
4. If missing, use `Docs/Prompts/README.md` on GEOTW during migration.
5. For cross-repo work, read [CrossRepoCapabilityGapMatrix.md](../Project/CrossRepoCapabilityGapMatrix.md).
6. For local agent app install, use [LocalAgentToolSetup](../Capabilities/LocalAgentToolSetup/) and [AgentCapabilityGuide.md](../Capabilities/AgentCapabilityGuide.md).

## Related Standards

- [RepositoryArchetypeAndCapabilityTiers.md](RepositoryArchetypeAndCapabilityTiers.md)
- [MarkdownIndexMetadataStandard.md](MarkdownIndexMetadataStandard.md)
- [FolderReadmeStandard.md](FolderReadmeStandard.md)
- [NamingStandard.md](NamingStandard.md)
- US1 (reference): `CapabilityStandard.md`, `CapabilityProvisionedStructure.md`
