<!--
IndexTitle: Markdown Index Metadata Standard
IndexDescription: Standard metadata block for important Markdown files and future repository indexes.
IndexType: Standard
IndexStatus: Draft
LastEdited: 2026-05-30
-->

# Markdown Index Metadata Standard

Important Markdown files should include a simple metadata block near the top of the file.

The goal is to make future repository index generation easier without adding YAML front matter, dependencies, or complex parsing rules.

## Recommended Metadata Block

Use this pattern:

```markdown
<!--
IndexTitle: Human readable title
IndexDescription: Short extractable description for repository indexes.
IndexType: Standard | Project | Prompt | Setup | Content | Workflow | Review | README | Capability | Skill
IndexStatus: Draft | Active | Review | Stable | Deprecated
LastEdited: YYYY-MM-DD
-->
```

Capability files may also include `CapabilityName`, `CapabilityVersion`, and
optional `ParentCapability`.

Skill files may also include `SkillName`, `Capability`, `SkillVersion`, and
optional `Runtime`.

## Placement Rules

- The metadata block should be the first meaningful content in the file.
- For folder `README.md` files, keep the existing first-line folder index comment:

```markdown
<!-- Index: Short folder purpose sentence. -->
```

- For folder `README.md` files, put the Markdown metadata block immediately after the first-line folder index comment.
- The visible Markdown heading should come after the metadata block.

## Field Rules

- `IndexTitle` should be a human-readable document title.
- `IndexDescription` should be short enough to fit in a repository index.
- `IndexType` should use one of the recommended values unless a new type is clearly needed.
- `IndexStatus` should describe the current document state.
- `LastEdited` should use ISO date format: `YYYY-MM-DD`.
- Skill metadata should name the owning Capability so future indexes can route
  from a Skill back to its governing rules.

## Why Not YAML Front Matter

Avoid YAML front matter for now.

HTML comments keep the files plain Markdown and easy for simple scripts to parse without changing how the documents render in common Markdown viewers.

## Future Index Builder Notes

Future index builders can extract:

- Folder purpose from the first-line `<!-- Index: ... -->` comment in folder `README.md` files.
- Document metadata from the Markdown metadata block in important `.md` files.
- Skill discovery fields from `SKILL.md` metadata and `Capabilities/SkillRegistry.md`.

Run [IndexHealthCheck.md](../Capabilities/Indexing/IndexHealthCheck.md) or
[Run-IndexHealthCheck.ps1](../Automation/IndexHealthCheck/Run-IndexHealthCheck.ps1)
before refresh. See [IndexHealthStandard.md](IndexHealthStandard.md).

Index builders should tolerate files without metadata during the pilot period. Apply this standard gradually to active, useful documents first.

## Task Capture Notes

Metadata describes a document; it is not the durable task queue.

`Next Recommended Task` sections that should survive the chat belong in
`Plans/AgentTaskBacklog.md`. After the Indexing Capability is
provisioned, important durable tasks may also be surfaced in
`Indexes/FollowThroughIndex.md`.

Do not add task lists to metadata blocks.

## Agent Notes

When adding metadata, keep the block short and accurate. Do not update every Markdown file in a broad sweep unless the backlog explicitly asks for a metadata expansion pass.
