<!--
IndexTitle: Skill Registry
IndexDescription: Reference registry for legacy Capability-owned Skill notes and future Skills decisions.
IndexType: README
IndexStatus: Active
LastEdited: 2026-06-01
-->

# Skill Registry

## Purpose

This file is a reference registry for legacy Capability-owned Skill notes and
future Skills decisions in the clean GetEstablished root.

`Skills` may exist as a scaffold in the clean root, and some Capability folders
may contain Skill-related references from earlier planning. No Skills migration
is approved yet. This registry does not authorize creating Skills content,
runtime adapters, generated indexes, scripts, or new Skill folders.

## How To Use

1. Route the request to an owning Capability through [README.md](README.md) or [AgentCapabilityGuide.md](AgentCapabilityGuide.md).
2. Check this registry only when the user asks about a Skill, `SKILL.md`, or an executable package.
3. Treat entries here as reference/scaffold information unless the owner explicitly approves active Skills work.
4. Do not create runtime adapter folders, scripts, generated indexes, vendor-specific Skill folders, or new `Skills` content unless the current task explicitly approves that scope.

## Registry Columns

| Column | Meaning |
| --- | --- |
| Skill | PascalCase Skill name |
| Owning Capability | Capability that would govern the Skill |
| User intent | Plain-language routing phrase |
| Status | Reference, Scaffold, Planned, Active, Runtime-adapted, or Deprecated |
| Current reference path | Existing reference path if present |
| Runtime | Runtime adapter status, if any |
| Notes | Scope boundaries and next action |

## Skill References

| Skill | Owning Capability | User intent | Status | Current reference path | Runtime | Notes |
| --- | --- | --- | --- | --- | --- | --- |
| IndexRefresh | [Indexing](Indexing/) | Refresh repository indexes from source metadata | Reference | [SKILL.md](Indexing/Skills/IndexRefresh/SKILL.md) | None | Legacy runtime-neutral pilot reference. Do not create generated indexes or runtime adapters without owner approval. |
| GDriveRepositoryRefresh | [GoogleDriveLink](GoogleDriveLink/) | Keep the Google Drive repository copy current after local repository edits | Reference | [SKILL.md](GoogleDriveLink/Skills/GDriveRepositoryRefresh/SKILL.md) | None | Legacy scaffold reference. Use approved `Automation\GoogleDriveRepositoryRefresh` scripts only when the task explicitly calls for them. |

## Current Boundaries

- No repository-wide Skills migration is approved yet.
- The root `Skills` folder, if present, is scaffold only.
- Capability-level Skill references are not permission to create new Skill content.
- No runtime adapter folders are approved.
- No additional `Skills` folders should be created as placeholders.
- Runtime adapters, new scripts, new automation, and generated indexes remain future-only until explicitly approved.

## Clean-Root Path Notes

Use clean-root paths when referring to current repository files:

- `Capabilities` for Capability folders and Capability-owned guidance.
- `Plans` for preserved prompts, planning reports, and migration records.
- `Standards` for reusable repository rules.
- `Automation` for approved scripts and executable workflows.
- `Skills` only as a scaffold or future owner-approved model.

Old paths such as `Docs\Capabilities` or `Docs\Prompts` should appear only as
historical/source paths under `Intake\GetEstablishedOnTheWeb\Docs\...`.

## Related

- [README.md](README.md)
- [AgentCapabilityGuide.md](AgentCapabilityGuide.md)
- [Indexing/README.md](Indexing/README.md)
- [RepositoryCoreStandard.md](../Standards/RepositoryCoreStandard.md)
- [SkillsAndCapabilitiesModel.md](../Plans/SkillsAndCapabilitiesModel.md)
- [SkillsFolderStructureProposal.md](../Plans/SkillsFolderStructureProposal.md)
