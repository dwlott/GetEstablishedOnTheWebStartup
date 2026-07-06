<!--
IndexTitle: InstructionCapture Rules
IndexDescription: Triage and capture rules for turning chats into durable repository artifacts.
IndexType: Capability
CapabilityName: InstructionCapture
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-06
-->

# InstructionCapture Rules

Read before [Prompt.md](Prompt.md). Pair with
[AgentSituationalAwareness.md](../../Standards/AgentSituationalAwareness.md).

## Scope

In scope:

- Classify session or chat output into a capture category.
- Write raw Ideas, tracked register rows, Plan scaffolds, or OpenQuestions rows.
- Delegate full chat body save to **ChatToMarkdown**.
- Recommend the next promotion step using [PromotionChecklist.md](../../Standards/PromotionChecklist.md).

Out of scope unless separately approved:

- Creating new Capability folders (use **CapabilityCreate** after checklist).
- Commit, push, or GitHub sync.
- Building website, automation, or external services.
- Overwriting `Workspace/OwnerGoals.md` during capture.

## Capture Categories

| Category | Typical destination | Template |
| --- | --- | --- |
| Raw idea | `Ideas/FutureIdeas.md` or `Ideas/<Name>.md` | [IdeaCaptureTemplate.md](../../Standards/IdeaCaptureTemplate.md) |
| Tracked idea | Row in `Plans/Ideas.md` + optional `Ideas/` file | IdeaCaptureTemplate |
| Project plan | `Plans/<Name>Plan.md` | [PlanTemplate.md](../../Standards/PlanTemplate.md) |
| Full chat body | Path chosen by ChatToMarkdown Rules | **ChatToMarkdown** |
| Open question | Row in `Plans/OpenQuestions.md` | — |
| Capability enhancement | Note in Idea or Plan; route **CapabilityCreate** later | PromotionChecklist Stage 3 |
| Standard or convention | Plan first, then `Standards/` | PlanTemplate → PromotionChecklist Stage 4 |
| Deprecated practice | Note + [ArchiveAndDeprecationRules.md](../../Standards/ArchiveAndDeprecationRules.md) | — |

## Required Capture Fields

Every capture should record:

| Field | Required |
| --- | --- |
| Date | Yes |
| Source context | Yes (chat title, session, review pass) |
| User intent summary | Yes — one sentence |
| Proposed destination | Yes — path before writing |
| Confidence | High / Medium / Low |
| Follow-up needed | Yes / No |

## Triage Decision Tree

```text
Is the full chat transcript needed as a file?
  Yes → ChatToMarkdown (then split into Ideas if multiple)
  No → continue

Is it only a rough possibility?
  Yes → Ideas/FutureIdeas.md or Ideas/<Name>.md

Is it tracked toward work?
  Yes → Plans/Ideas.md row (+ Idea file if long)

Does it need steps, scope, and validation?
  Yes → Plans/<Name>Plan.md (PlanTemplate)

Is it a non-blocking owner decision?
  Yes → Plans/OpenQuestions.md row

Is it the same task recurring?
  Note in Plan → CapabilityCreate when checklist Stage 3 passes
```

## Split Rule

One session may produce **multiple** captures. Split when intents differ or Goals differ.

## Stop Rules

- Do not promote vague fragments directly to Capabilities.
- Do not delete source chat references until destination files exist.
- Do not store owner-specific paths in Capability `Rules.md` during capture.
- Ask one clarifying question when destination is genuinely ambiguous.

## Related

- [README.md](README.md)
- [Prompt.md](Prompt.md)
- [../ChatToMarkdown/Rules.md](../ChatToMarkdown/Rules.md)
