<!--
IndexTitle: ChatToMarkdown Prompt
IndexDescription: Copy-ready worker prompt to convert chat into GEOTW markdown source files.
IndexType: Capability
CapabilityName: ChatToMarkdown
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-05-30
-->

# ChatToMarkdown Prompt

Read [Rules.md](Rules.md) before using this prompt.

```text
# Worker pass: ChatToMarkdown

Repository: GetEstablishedOnTheWeb
Branch: main

Read AGENTS.md and Docs/Capabilities/ChatToMarkdown/Rules.md before editing.

Structure check:
- Output folders per Rules.md must exist or be creatable as ordinary project paths (not Inbox/Indexes).
- If a Capability-owned path is required and missing, follow CapabilityProvisionedStructure — offer Setup, do not mkdir for Inbox/Indexes.

Goal:
Convert the chat content provided by the user into one structured markdown source file with the correct category, destination folder, and repository-ready filename.

Before writing:
- Classify the document as Project, Setup, Capability, Prompt, Standard, or Maintenance.
- Choose the destination folder from Rules.md before generating the file.
- Create a concise PascalCase filename from the durable subject and document role.
- Do not use generic export names such as Chat.md, Conversation.md, Export.md, Workflow.md, Notes.md, or date-only names.
- Ask one concise clarification question only if the destination is genuinely ambiguous and Docs/Project/ would be a risky default.

Folder choices:
- Docs/Project/ for internal planning, workflow, reviews, decisions, or project notes
- Docs/Setup/ for setup guides, setup logs, and local tool configuration notes
- Docs/Capabilities/<CapabilityName>/ only for an existing or explicitly approved Capability update
- Docs/Prompts/ or a Capability Prompt.md for reusable copy-ready prompts
- Docs/Standards/ for durable cross-repository standards
- Docs/Maintenance/ for housekeeping, cleanup notes, future ideas, and proposed renames
- Content/Website/Pages/ for framework-neutral website page drafts when the user targets a page
- Owner/Notes/ or Owner/OpenQuestions/ for owner-specific material not meant as site pages
- Do not use US1 envelope paths (Planning/, PossibleWebPages/, Inbox/)

Rules:
- Follow Docs/Capabilities/ChatToMarkdown/Rules.md for structure and metadata.
- Add the HTML comment metadata block at the top, then one H1 title, then sections per Rules.md.
- Separate product or website copy from internal planning notes.
- Stay framework-neutral; do not invent pricing, guarantees, or regulatory claims.
- Mark uncertain items as future decisions in Planning Questions, not as settled facts.
- Do not embed a nested template, second H1 document title block, or copy of Rules.md inside the output file.
- Do not edit unrelated files except the new or explicitly named target file.

After saving:
- In the final handoff, state the chosen category, destination, and filename.
- Recommend whether Docs/Project/RepositoryMap.md needs a cross-link update.
- Do not bulk-edit other source files.

End with exactly one fenced text handoff: Summary, Files Changed, Planning Files To Review, Questions Added Or Changed, Next Recommended Task.
```

## Prompt history

- **2026-05-30 (v1):** Added category-first destination and filename harmonization steps.
- **2026-05-31 (v1):** Initial worker prompt; migrated from US1 ChatToMarkdown pattern with GEOTW folder map.
