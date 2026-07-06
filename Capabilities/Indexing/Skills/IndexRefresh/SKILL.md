<!--
IndexTitle: IndexRefresh Skill
IndexDescription: Runtime-neutral Skill package for refreshing repository indexes under the Indexing Capability.
IndexType: Skill
SkillName: IndexRefresh
Capability: Indexing
SkillVersion: 1
IndexStatus: Active
LastEdited: 2026-05-30
-->
---
name: index-refresh
description: Refresh repository index files from approved source metadata under the Indexing Capability rules.
---

# IndexRefresh Skill

Owning Capability: [Indexing](../../README.md)

## Purpose

Run the repeatable index-refresh workflow defined by the **Indexing**
Capability.

This Skill packages the operating steps for agents. It does not replace
[Rules.md](../../Rules.md), [Structure.md](../../Structure.md), or
[SetupPrompt.md](../../SetupPrompt.md).

## When To Use

Use this Skill when the user asks to refresh repository indexes, update
`ChatMarkdownIndex`, update `FollowThroughIndex`, or inventory source Markdown
according to the Indexing Capability.

## Required Reads

Before operating, read:

- [../../README.md](../../README.md)
- [../../Rules.md](../../Rules.md)
- [../../Structure.md](../../Structure.md)
- [../../SetupPrompt.md](../../SetupPrompt.md), only if index structure is
  missing or partially provisioned

## Inputs

- Source Markdown under the folders listed in [Rules.md](../../Rules.md).
- Existing files under `Indexes/`, if provisioned.
- Current index column definitions from [Structure.md](../../Structure.md).

## Outputs

- Updated index files under `Indexes/` only.

Do not write source files, move files, create generated indexes outside
`Indexes/`, or create folders that are not approved by the Indexing
`SetupPrompt.md`.

## Operating Steps

0. Run index health check when drift is suspected or before first refresh.
   - [IndexHealthCheck.md](../../IndexHealthCheck.md) or
     [Run-IndexHealthCheck.ps1](../../../../Automation/IndexHealthCheck/Run-IndexHealthCheck.ps1)
   - Fix Must-fix findings or document in handoff before refresh.
1. Verify the requested index scope.
   - If the user did not name a specific index, refresh only the smallest
     index set needed by the request.
   - Do not expand the task into a broad metadata sweep.
2. Verify index structure.
   - If `Indexes/` is missing, offer the Indexing
     [SetupPrompt.md](../../SetupPrompt.md) and stop.
   - If required index files or headers are missing, treat the repository as
     partially provisioned; offer setup or a scoped repair pass and stop.
3. Read the approved source folders from [Rules.md](../../Rules.md).
4. Update only the approved index files under `Indexes/`.
5. Preserve source bodies.
   - Do not move, rename, delete, rewrite, or reclassify source files.
   - Do not invent decisions, owner facts, business claims, or publishing
     readiness.
6. End with the repository-standard worker handoff block from `AGENTS.md`.

## Data Boundaries

This Skill inherits the Indexing Capability data boundaries:

- **May read:** approved source Markdown folders and existing index files.
- **May write:** only approved files under `Indexes/`.
- **Must not store:** credentials, private facts not already present in source
  files, invented decisions, or generated claims.
- **Must not expose:** owner content beyond short index descriptions and source
  file pointers.

## Stop Conditions

Stop and ask for human input when:

- `Indexes/` is missing and setup has not been approved.
- Existing index files are partially provisioned or structurally inconsistent.
- The requested work would require moving, deleting, renaming, or rewriting
  source files.
- The requested work would require scripts, automation, generated indexes, or a
  runtime adapter folder.
- The requested work would require judging business facts, legal claims,
  pricing, credentials, or final website readiness.

## Out Of Scope

This Skill does not create:

- Runtime adapter folders such as `.cursor/skills/`.
- Scripts or automation helpers.
- Generated index builders.
- New index files outside the Indexing [Structure.md](../../Structure.md).
- Source-file rewrites or migrations.

## Version Notes

| Date | Version | Change |
| --- | ---: | --- |
| 2026-06-06 | 2 | Added health check step before refresh; clean-root Rules alignment | Index accuracy depends on metadata and links |
| 2026-05-30 | 1 | Initial runtime-neutral Skill scaffold for the Indexing Capability. |
