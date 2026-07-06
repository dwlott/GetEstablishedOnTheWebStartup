<!-- Index: Convert chat discussions into structured Get Established markdown files. -->
<!--
IndexTitle: ChatToMarkdown Capability
IndexDescription: Convert chat into repository-ready markdown with clear destination and filename choices.
IndexType: Capability
CapabilityName: ChatToMarkdown
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-07
-->

# ChatToMarkdown Capability

- **Version:** 1
- **Tier:** Universal
- **Purpose:** Turn chat planning or brainstorming into searchable, reusable markdown with a repository-ready destination folder and concise filename, without embedding templates inside output files.
- **Inputs:** Chat text (pasted or summarized by user); target folder and filename decision per [Rules.md](Rules.md).
- **Outputs:** One new or updated markdown file per Rules, using a non-generic PascalCase filename.
- **WhenToUse:** After a ChatGPT or Cursor session produced useful product, workflow, or website-draft notes that should become repository source material. For triage before save, use **InstructionCapture** first when the session may produce multiple Ideas or a Plan.
- **ParentCapability:** Pattern from a commissioned instance; GEOTW folder map differs (no `Planning/` / `PossibleWebPages/`).

## Boundary With Google Drive Handoffs

Use ChatToMarkdown when the goal is durable repository Markdown.

Google Drive native Docs may be used as temporary communication artifacts for
long or complex planning notes and Codex prompts. Those Drive-root Docs do not
need a `.md` extension and do not replace repository files. When their content
should become durable, read or export the Google Doc and save the result into
the repository path chosen by [Rules.md](Rules.md).

Do not make raw `.md` upload to Drive the default ChatToMarkdown path.

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | imported repository — commissioned-instance pattern |
| **SourceSummary** | Convert chat sessions into durable repository Markdown |
| **PromotionStatus** | Active |
| **Dependencies** | None |
| **RelatedFiles** | Rules.md, Prompt.md |
| **LastReviewed** | 2026-06-05 |
| **HarmonizationNotes** | Complements GoogleDriveLink long handoffs — promote Docs to repo Markdown |

## Related

- Canonical rules: [Rules.md](Rules.md)
- Worker entry: [Prompt.md](Prompt.md)
- Triage workflow: [InstructionCapture](../InstructionCapture/README.md)
- Naming guidance: [NamingStandard.md](../../Standards/NamingStandard.md)
- Filename planning review: [ChatToMarkdownFilenameHarmonizationReview.md](../../Project/ChatToMarkdownFilenameHarmonizationReview.md)
- Generic filename dry run: [ChatToMarkdownGenericFilenameDryRun.md](../../Project/ChatToMarkdownGenericFilenameDryRun.md)
- Envelope reference: a commissioned instance's ChatToMarkdown Capability
- Distinct workflow: [ChatMemoryCapturePrompt.md](../../Prompts/ChatMemoryCapturePrompt.md) (capture-prep; migrate to ChatMemoryCapture Capability)

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-06-01 | 1 | Added Google Drive handoff boundary | Drive-root native Google Docs can carry temporary handoffs, but durable chat conversion still becomes repository Markdown through Rules | README, Rules |
| 2026-05-30 | 1 | Added filename harmonization and destination classification guidance | Reduce manual cleanup after chat export; reject generic names before save | README, Rules, Prompt, NamingStandard |
| 2026-05-31 | 1 | Initial Universal migration from a commissioned-instance pattern | GEOTW paths in Rules.md; keep prompts copy-clean | README, Rules, Prompt |
| 2026-05-31 | 1 | Linked generic filename dry run | Confirm generic export names can stay temporary while final files use repository-ready names | README |
