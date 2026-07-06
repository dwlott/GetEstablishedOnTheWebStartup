<!-- Index: Triage chat and session output into Ideas, Plans, and durable repository files. -->
<!--
IndexTitle: InstructionCapture Capability
IndexDescription: Triage chat or session output into Ideas, Plans, OpenQuestions, or ChatToMarkdown saves.
IndexType: Capability
CapabilityName: InstructionCapture
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-06
-->

# InstructionCapture Capability

- **Version:** 1
- **Tier:** Universal
- **Purpose:** Turn chat transcripts, session summaries, or owner notes into
  **durable repository artifacts** using a consistent triage path: raw capture →
  tracked Idea → Plan → promotion. Wraps **ChatToMarkdown** when the full body
  must be saved; uses **IdeaCaptureTemplate** and **PlanTemplate** when shaping
  work.
- **Inputs:** Chat paste, session summary, review output, or owner instruction
  to "capture this."
- **Outputs:** File(s) in `Ideas/`, row in `Plans/Ideas.md`, new `Plans/*Plan.md`,
  row in `Plans/OpenQuestions.md`, or delegated ChatToMarkdown file; triage
  handoff with next promotion step.
- **WhenToUse:** After a useful chat; when the owner says capture, promote, or
  save this to the repo; before inventing a new Plan or Capability from memory.

## Start Here

[Prompt.md](Prompt.md) — triage and capture workflow.

Read [Rules.md](Rules.md) before editing.

## Workflow Summary

```text
Session or chat
  → classify capture type (Rules.md)
  → choose destination (Ideas / Plans / OpenQuestions / ChatToMarkdown)
  → write using Standards templates
  → update Plans/Ideas.md when tracked
  → recommend next step via PromotionChecklist
```

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | Instruction Embedding Roadmap Phase 4 |
| **SourceSummary** | Formalize chat-to-Idea-to-Plan flow; wrap ChatToMarkdown + triage |
| **PromotionStatus** | Active |
| **Dependencies** | ChatToMarkdown, IdeaCaptureTemplate, PlanTemplate, PromotionChecklist |
| **RelatedFiles** | Rules.md, Prompt.md |
| **LastReviewed** | 2026-06-06 |
| **HarmonizationNotes** | Does not replace ChatToMarkdown — routes to it for full-body saves |

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-06-06 | 1 | Initial Universal InstructionCapture for Phase 4 | Chats need triage before random Plans appear | README, Rules, Prompt |

## Related

- [ChatToMarkdown](../ChatToMarkdown/README.md)
- [IdeaCaptureTemplate.md](../../Standards/IdeaCaptureTemplate.md)
- [PlanTemplate.md](../../Standards/PlanTemplate.md)
- [PromotionChecklist.md](../../Standards/PromotionChecklist.md)
- [GoalsIdeasPlansCapabilitiesModel.md](../../Plans/GoalsIdeasPlansCapabilitiesModel.md)
