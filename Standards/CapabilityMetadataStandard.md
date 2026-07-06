<!--
IndexTitle: Capability Metadata Standard
IndexDescription: Harmonization-ready metadata for GetEstablished Capability modules and routing files.
IndexType: Standard
IndexStatus: Active
LastEdited: 2026-06-05
-->

# Capability Metadata Standard

Defines metadata for **Capability modules** (`Capabilities/<Name>/`) so agents
can route, compare, harmonize, and promote workflows without losing intent.

Builds on [MarkdownIndexMetadataStandard.md](MarkdownIndexMetadataStandard.md).
Do not use YAML front matter.

## Scope

In scope:

- `Capabilities/<CapabilityName>/README.md` (canonical metadata home)
- `Capabilities/<CapabilityName>/Rules.md`, `Prompt.md`, and workflow files
- Registry rows in `Capabilities/README.md`
- Routing rows in `Capabilities/AgentCapabilityGuide.md`

Out of scope unless a pass explicitly targets them:

- Bulk metadata updates to every file in `Plans/` or `Intake/`
- Skills migration (`Skills/` scaffold remains unapproved)

## Apply Gradually

1. **New Capabilities** — use [CapabilityModuleTemplate.md](../Capabilities/CapabilityCreate/CapabilityModuleTemplate.md) fully.
2. **Existing Capabilities** — add **Harmonization Metadata** when touched; do not rewrite entire READMEs unless scoped.
3. **Phase passes** — CapabilityAudit or CapabilityHarmonize may batch-fill gaps with owner approval.

## File Header (HTML Comment Block)

Every Capability `README.md` must include this block immediately after the
first-line folder index comment (`<!-- Index: ... -->`):

```markdown
<!--
IndexTitle: <CapabilityName> Capability
IndexDescription: One sentence for indexes and registry extraction.
IndexType: Capability
CapabilityName: <CapabilityName>
CapabilityVersion: 1
IndexStatus: Active | Draft | Planned | Deprecated
LastEdited: YYYY-MM-DD
-->
```

Optional header fields when relevant:

- `ParentCapability: <Name>` — when nested under another Capability concept
- `PromotionStatus: Active | Draft | Planned` — when promoted from Plans

`Rules.md` and `Prompt.md` should repeat `CapabilityName`, `CapabilityVersion`,
and `IndexStatus` in their header blocks per Markdown Index Metadata Standard.

## README Body (Operating Summary)

Immediately under the `# <Name> Capability` heading, use these bullets when
they apply:

| Field | Required | Notes |
| --- | --- | --- |
| **Version** | Yes | Integer; bump on breaking workflow change |
| **Tier** | Yes | Universal, Archetype, Commissioned, or N/A — see RepositoryArchetypeAndCapabilityTiers |
| **Purpose** | Yes | One short paragraph |
| **Inputs** | Yes | What the agent or owner supplies |
| **Outputs** | Yes | Files, handoffs, or decisions produced |
| **WhenToUse** | Yes | User intents that trigger this Capability |
| **ParentCapability** | If nested | Otherwise omit or N/A |

Do not duplicate long workflow steps in README when a dedicated workflow file
exists — link to it (for example `WorkflowIndex.md`).

## Harmonization Metadata Section

Add this section to every active Capability `README.md`. Place it after
operating summary sections and before **Capability Changelog**.

```markdown
## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | chat \| plan file \| promoted workflow \| imported repository \| CapabilityCreate |
| **SourceSummary** | Why this Capability exists (one or two sentences) |
| **PromotionStatus** | Active \| Draft \| Planned \| Deprecated |
| **Dependencies** | Capabilities, Standards, or external tools required |
| **RelatedFiles** | Primary entry files beyond README |
| **LastReviewed** | YYYY-MM-DD |
| **HarmonizationNotes** | Cross-repo compare hints, rename history, or merge candidates |
```

Use `—` or `None` for unknown fields; fill them when known.

## Capability Module Files

Minimum active Capability folder:

```text
Capabilities/<CapabilityName>/
  README.md          required — metadata + summary
  Prompt.md          recommended — copy-ready worker entry
  Rules.md           recommended — canonical operating rules
```

Optional:

- `WorkflowIndex.md` or named workflow files — runnable indexes (preferred for cloud links)
- `Structure.md` — provisioned paths (CapabilityCreate pattern)
- `SetupPrompt.md` — one-time human setup when justified
- `Skills/<SkillName>/SKILL.md` — only when owner approves Skills content

See [CapabilityModuleTemplate.md](../Capabilities/CapabilityCreate/CapabilityModuleTemplate.md).

## Per-Capability Situational Awareness

Each Capability with `Rules.md` should include a **Situational Awareness**
section (short) with checks specific to that Capability. Core orientation
remains in `Capabilities/SituationalAwareness/`.

## Capability Changelog

Active Capabilities should maintain a **Capability Changelog** table at the
bottom of `README.md`:

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |

Route recurring lessons to **RepositoryLearning** when they apply across
Capabilities.

## Canonical Routing Source

`Capabilities/AgentCapabilityGuide.md` is the **canonical** routing table. These
surfaces are **derived views** that must stay in parity with it:

| Surface | Role |
| --- | --- |
| `Capabilities/AgentCapabilityGuide.md` | **Canonical** intent → Capability routing |
| `Capabilities/RouterIndex.md` | Compact boot-time router (one row per Capability) |
| `Capabilities/README.md` | Registry (tier/status/entry) |
| `AGENTS.md` Capability Discovery list | Folder roll-call for agents |

Parity rule: every `Capabilities/<Name>/` folder on disk must appear, with a
matching `IndexStatus`, in all four surfaces. Drift is a **Must-fix** finding.
The parity check is run manually via
[CapabilityAudit AuditChecklist.md](../Capabilities/CapabilityAudit/AuditChecklist.md)
section C. When adding, renaming, or retiring a Capability, update all four
surfaces in the same pass.

## Registry And Routing

`Capabilities/README.md` registry rows should align with this standard:

| Column | Source |
| --- | --- |
| Tier | README **Tier** |
| Capability | Folder name (PascalCase) |
| User intent | README **WhenToUse** (short) |
| Status | Header **IndexStatus** |
| Entry | Primary file — `Prompt.md`, `WorkflowIndex.md`, etc. |
| Rules | `Rules.md` if present |

`Capabilities/AgentCapabilityGuide.md` adds routing columns:

| Column | Meaning |
| --- | --- |
| User intent | Match phrase |
| Capability | PascalCase name |
| Entry | Primary file link |
| Status | Active, Planned, Preserved in Plans |
| Tier | Universal, Archetype, etc. |
| Pre-Checks | Files or Standards to read first |
| Expected Output | Handoff, docs, or review artifact |
| Related Standards | Standards that govern this Capability |

## Workflow File Metadata

Workflow files inside a Capability (for example `WorkflowIndex.md`) use the
Markdown metadata block with:

- `IndexType: Capability`
- Same `CapabilityName` and `CapabilityVersion` as the parent README

## Promotion From Plans

When promoting a `Plans/` prompt to a Capability:

1. Copy durable workflow into `Capabilities/<Name>/`.
2. Fill **CreatedFrom** and **SourceSummary** with the plan file path.
3. Set **PromotionStatus** to Active only after owner approval.
4. Leave a stub or redirect in `Plans/` if historical links exist.
5. Update registry, AgentCapabilityGuide, and AGENTS.md Capability Discovery.

## Related

- [MarkdownIndexMetadataStandard.md](MarkdownIndexMetadataStandard.md)
- [CapabilityModuleTemplate.md](../Capabilities/CapabilityCreate/CapabilityModuleTemplate.md)
- [RepositoryArchetypeAndCapabilityTiers.md](RepositoryArchetypeAndCapabilityTiers.md)
- [CapabilityProvisionedStructure.md](CapabilityProvisionedStructure.md)
- [../Plans/InstructionEmbeddingRoadmap.md](../Plans/InstructionEmbeddingRoadmap.md)
