<!-- Index: Standard for folder README files and future index generation metadata. -->
<!--
IndexTitle: Folder README Standard
IndexDescription: Standard for folder README files, first-line folder index comments, and agent-readable sections.
IndexType: Standard
IndexStatus: Active
LastEdited: 2026-05-23
-->

# Folder README Standard

Every active folder should have a `README.md`.

Folder README files help humans and agents understand where files belong without reading the whole repository.

## Index Comment Rule

The first line of each folder `README.md` must be an HTML comment beginning with:

```text
<!-- Index:
```

Use this pattern:

```text
<!-- Index: Short folder purpose sentence. -->
```

That first comment line is intended for future repository index generation. Keep it short, plain, and descriptive.

## Heading Rule

The visible heading should come after the index comment.

Example:

```markdown
<!-- Index: Reusable copy-ready prompts for AI-assisted work. -->

# Prompts
```

## Recommended Sections

Each folder README should include:

- Folder purpose.
- What belongs here.
- What does not belong here.
- Important files or expected future files.
- Agent notes.

## Writing Guidance

- Keep descriptions short and clear.
- Use plain Markdown.
- Prefer practical folder boundaries over long explanations.
- Do not create deep empty folder trees just to document future ideas.
- Update the README when a folder's purpose changes.
