<!--
IndexTitle: ChatToMarkdown Rules
IndexDescription: Canonical rules for chat-to-markdown conversion on GetEstablishedOnTheWeb.
IndexType: Standard
CapabilityName: ChatToMarkdown
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-01
-->

# ChatToMarkdown Rules

Canonical home for GEOTW chat conversion structure. Adapted from US1Movers ChatToMarkdown (Universal tier).

Do not embed a second copy of this rules file or a nested `# Title` / `## Document Metadata` template inside converted documents.

## Destination And Category

Choose the destination before generating or saving the markdown file.
Classify the document by repository role, not by the chat export title.

ChatToMarkdown creates durable repository Markdown. It is separate from the
GoogleDriveLink pattern where ChatGPT may create a native Google Doc in the
Drive root as a temporary communication layer for a long or complex planning
note or Codex prompt.

If a Drive-root Google Doc contains content that should become durable, read
or export the actual document content, then save it as real Markdown in the
repository path chosen here. Do not treat `.gdoc` pointer files or raw `.md`
Drive upload attempts as the default ChatToMarkdown workflow.

Ask one concise clarification question only when the destination is genuinely
ambiguous and a reasonable default would risk putting source material in the
wrong folder. If the uncertainty is minor, default to `Docs/Project/` with a
clear planning or review filename.

| Category | Folder | Use when the chat output is mainly |
| --- | --- | --- |
| Project | `Docs/Project/` | Planning, reviews, decisions, repository direction, workflow comparisons, or non-final recommendations |
| Setup | `Docs/Setup/` | Local setup steps, setup logs, tool configuration, machine-specific onboarding notes, or reproducible setup guides |
| Capability | `Docs/Capabilities/<CapabilityName>/` | Reusable workflow rules, prompts, examples, setup instructions, or capability metadata for an existing or explicitly approved Capability |
| Prompt | `Docs/Prompts/` or a Capability `Prompt.md` | Copy-ready prompt text intended to be reused by agents or humans |
| Standard | `Docs/Standards/` | Cross-repository rules, naming conventions, metadata standards, or durable policy |
| Maintenance | `Docs/Maintenance/` | Housekeeping, cleanup notes, future ideas, stale-file tracking, proposed renames, or repository maintenance |

Additional GEOTW destinations:

| Content type | Folder |
| --- | --- |
| Framework-neutral website page draft | `Content/Website/Pages/` only when the user targets a public page draft |
| Owner-specific notes, not website pages | `Workspace/Notes/` or `Workspace/OpenQuestions/` when those folders exist (create on first use; see Workspace/README.md) |
| One-page business website user track | `Content/OnePageBusinessWebsite/` only when the user explicitly scopes that track |

Routing rules:

- If a chat proposes a future Capability but does not approve creating or
  editing that Capability, save planning as
  `Docs/Project/<Subject>CapabilityPlan.md`.
- If a chat produces an actual reusable prompt for an Active Capability, use
  that Capability's `Prompt.md` only when the task explicitly scopes that
  update.
- If a chat identifies a possible rename, log or plan it; do not rename
  existing files unless the task explicitly asks for a controlled rename.
- Do not create Capability-owned provisioned folders such as `Inbox/` or
  `Indexes/` during ChatToMarkdown conversion.

**Not on GEOTW:** US1 envelope folders (`Planning/`, `PossibleWebPages/`, commissioned inbox paths). Commissioned instances document those in their own Capability Rules.

## Filename Harmonization

Create the filename after choosing the destination category and before writing
the file.

Use this pattern:

```text
<SpecificSubject><OptionalQualifier><DocumentRole>.md
```

Rules:

- Use PascalCase with no spaces or punctuation:
  `WebsiteContentPlan.md`.
- Ignore generic export labels. Treat `Chat`, `Conversation`, `Export`,
  `Transcript`, `Untitled`, `Workflow`, `Notes`, and date-only names as
  non-names.
- Match the durable subject of the document, not the chat title.
- Prefer established repository vocabulary, including Capability names,
  Standard names, folder names, and workflow names.
- Use a short role suffix when it clarifies the file:
  `Plan`, `Review`, `Troubleshooting`, `Checklist`, `Guide`, `Prompt`,
  `Standard`, `Rules`, `Setup`, `Log`, or `Decision`.
- Keep names concise. Aim for two to four meaningful words before `.md`.
- Avoid stacked prefixes such as
  `ProjectChatToMarkdownWorkflowPlanReview.md`.
- Use dates only when chronology is the main purpose.
- Resolve filename collisions by adding the narrowest useful qualifier, never
  by appending `2`.

Examples:

| Generic export name | Category | Destination | Repository-ready filename |
| --- | --- | --- | --- |
| `Chat.md` | Project | `Docs/Project/` | `ChatToMarkdownFilenameHarmonizationReview.md` |
| `Conversation.md` | Setup | `Docs/Setup/` | `OneDrivePhoneWorkflow.md` |
| `Export.md` | Project | `Docs/Project/` | `CloudInboxCapabilityPlan.md` |
| `Workflow.md` | Project | `Docs/Project/` | `GitHubWorkflowTroubleshooting.md` |
| `Notes.md` | Standard | `Docs/Standards/` | `RepositoryFilenameNamingStandard.md` |
| `Prompt.md` | Prompt | `Docs/Prompts/` | `WebsiteContentReadinessReviewPrompt.md` |

## Required File Structure

```markdown
<!--
IndexTitle: Document Title
IndexDescription: One sentence for indexes.
IndexType: Project
IndexStatus: Draft
LastEdited: YYYY-MM-DD
-->

# Document Title

## Document Metadata

- Repository: GetEstablishedOnTheWeb
- Branch: main
- Folder: Docs/Project
- Source: Chat conversion summary (one line)
- Status: Draft

## Core Purpose

## Main Discussion Points

## Product Or Website Copy

## Internal Planning Notes

## Suggested Future Sections

## Indexing Notes

## Related Future Documents

## Planning Questions

## Next Recommended Documents
```

## Normalized Metadata Fields

Use these bullet names in `## Document Metadata`:

- Repository
- Branch
- Folder
- Source
- Status
- Audience (Product | Internal | Both) when helpful

## Section Rules

- Separate product or website copy from internal planning.
- Use standard ASCII punctuation in customer-facing text.
- Stay **framework-neutral** (plain Markdown; no hosting or framework decisions in converted files).
- Do not invent pricing, guarantees, certifications, or regulatory claims.
- Mark uncertain items as future decisions in Planning Questions, not settled facts.
- One H1 for the document title.
- Do not include nested template blocks or a copy of this Rules file inside the saved file.
- Preserve distinctions in [ProductLanguageAndPositioning.md](../../Project/ProductLanguageAndPositioning.md) when writing website-related copy.

## Related Guidance

- File naming standard:
  [NamingStandard.md](../../Standards/NamingStandard.md)
- Implementation planning review:
  [ChatToMarkdownFilenameHarmonizationReview.md](../../Project/ChatToMarkdownFilenameHarmonizationReview.md)

## After Conversion

Recommend updating `Docs/Project/RepositoryMap.md` or a future **Indexing** Capability pass if the new file should appear in a formal index. Do not bulk-edit unrelated files.

Worker agents end with one fenced `text` handoff block per `AGENTS.md` (~72 characters per line).

## Learned constraints

- Choose folder before writing; default internal notes to `Docs/Project/` unless the user names a website page target.
- Choose category, destination, and repository-ready filename before writing.
- Do not embed workflow instructions or a copy of Rules.md inside converted documents.
- ChatMemoryCapture is a separate archetype workflow (capture-prep); do not merge into this Capability without an explicit task.
