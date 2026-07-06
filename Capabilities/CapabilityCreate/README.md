<!-- Index: Turn proven workflow work into a new repository Capability safely. -->
<!--
IndexTitle: CapabilityCreate Capability
IndexDescription: Author new Capabilities from session work with tier choice and placement-aware structure, not hard-coded folder dumps.
IndexType: Capability
CapabilityName: CapabilityCreate
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-07
-->

# CapabilityCreate Capability

- **Version:** 1
- **Tier:** Universal (authors Capabilities at any tier when appropriate)
- **Purpose:** Turn durable workflow work (integrations, intake patterns, reviews, tools) into a bounded **Capability** module under `Docs/Capabilities/<Name>/`, with registry and routing updates — without polluting `Owner/`, website content, or other folders that belong to different workflows.
- **Inputs:** Summary of what worked in the current or recent session; optional name hint; target repository; whether provisioned disk paths are needed.
- **Outputs:** New or updated Capability folder (`README.md`, `Prompt.md`, optional `Rules.md`, optional `Structure.md` as **suggestions**, optional `SetupPrompt.md` only when paths are justified); registry row; `AgentCapabilityGuide` row when Active; optional `OpenQuestions.md` rows for unsettled placement.
- **WhenToUse:** User asks to create a Capability, turn work into a Capability, or add a module for an unsupported integration (for example Dropbox). Agents may **offer** this Capability when session work is clearly repeatable — see [Rules.md](Rules.md) **Proactive offer**.
- **Does not replace:** Migrating legacy `Docs/Prompts/` files (still one Capability per scoped pass); **CapabilityHarmonize** (cross-repo compare, future).

## Design stance

- **Structure.md is a starter kit, not a script.** Paths are proposals the agent adapts after reading the repository map, existing Capabilities, and [Rules.md](Rules.md) placement tables.
- **Provisioned paths** follow [CapabilityProvisionedStructure.md](../../Standards/CapabilityProvisionedStructure.md): only list paths in `Structure.md` and ship `SetupPrompt.md` when the Capability truly owns them.
- **Owner/ and customer content stay clean.** Capability instructions live under `Docs/Capabilities/`; facts and drafts stay in their home folders per repository profile.

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | promoted workflow — meta Capability authoring |
| **SourceSummary** | Placement-first authoring of new Capability modules |
| **PromotionStatus** | Active |
| **Dependencies** | CapabilityMetadataStandard, CapabilityModuleTemplate, RepositoryArchetypeAndCapabilityTiers |
| **RelatedFiles** | Rules.md, Structure.md, CapabilityModuleTemplate.md, Prompt.md |
| **LastReviewed** | 2026-06-05 |
| **HarmonizationNotes** | Use CapabilityModuleTemplate for all new Capabilities |

## Related

- Placement and tier rules: [Rules.md](Rules.md)
- Suggested module files and example path ideas: [Structure.md](Structure.md)
- Worker entry: [Prompt.md](Prompt.md)
- Packaging standard: [RepositoryCoreStandard.md](../../Standards/RepositoryCoreStandard.md)
- Provisioned folders: [CapabilityProvisionedStructure.md](../../Standards/CapabilityProvisionedStructure.md)
- Tiers: [RepositoryArchetypeAndCapabilityTiers.md](../../Standards/RepositoryArchetypeAndCapabilityTiers.md)

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-05-28 | 1 | Initial CapabilityCreate meta-module | Placement-first; Structure as suggestions; proactive offer | README, Rules, Structure, Prompt |
