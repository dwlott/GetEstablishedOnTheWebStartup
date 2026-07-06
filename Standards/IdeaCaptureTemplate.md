<!--
IndexTitle: Idea Capture Template
IndexDescription: Standard shape for capturing one Idea from chat or notes before it becomes a Plan.
IndexType: Standard
IndexStatus: Active
LastEdited: 2026-06-06
-->

# Idea Capture Template

Use when an agent or owner turns a chat insight, note, or session output into
**one tracked Idea**. Pair with [InstructionCapture](../Capabilities/InstructionCapture/Prompt.md)
for triage or [ChatToMarkdown](../Capabilities/ChatToMarkdown/Prompt.md) when
the full chat body must be saved first.

See [GoalsIdeasPlansCapabilitiesModel.md](../Plans/GoalsIdeasPlansCapabilitiesModel.md)
and [Ideas.md](../Plans/Ideas.md).

## When To Use

| Destination | Use when |
| --- | --- |
| `Ideas/FutureIdeas.md` | Raw, unscoped — capture fast; no curation yet |
| `Ideas/<ShortName>.md` | One Idea needs its own note before promotion |
| Row in `Plans/Ideas.md` | Idea is mature enough to track toward a Plan |

Promote from raw → tracked using [PromotionChecklist.md](PromotionChecklist.md).

## Metadata Block (Optional File In `Ideas/`)

```markdown
<!--
IndexTitle: <Short Idea Title>
IndexDescription: <One sentence — what this possibility is>
IndexType: Idea
IndexStatus: Open
LastEdited: YYYY-MM-DD
SourceContext: <chat, mobile note, review pass, etc.>
-->
```

## Idea Note Body

```markdown
# <Short Idea Title>

## Summary

One paragraph: what the Idea is and why it might matter.

## Supports Which Goal

- [ ] Repository Goal — link `Plans/RepositoryGoals.md` section if known
- [ ] Owner Goal — link `Workspace/OwnerGoals.md` row if known
- [ ] Neither yet — explain why capture anyway

## Source

| Field | Value |
| --- | --- |
| Date | YYYY-MM-DD |
| Source context | Chat / review / owner note / import |
| Source path or chat title | `<path or label>` |
| Confidence | High / Medium / Low |

## Proposed Destination

| If promoted, likely becomes | Path |
| --- | --- |
| Plan | `Plans/<Name>Plan.md` |
| Capability candidate | `Capabilities/<Name>/` via CapabilityCreate |
| Standard | `Standards/<Name>.md` |
| Content | `Content/...` |
| Parked | Stay in Ideas only |

## Open Questions

- 

## Next Step

One focused action if the owner approves moving forward.

## Related

- [Plans/Ideas.md](../Plans/Ideas.md) — register row when tracked
- [PromotionChecklist.md](PromotionChecklist.md)
```

## Register Row (`Plans/Ideas.md`)

When the Idea is tracked in the register, add one table row:

```markdown
| <Short title> | Open | <One-line next step; link Ideas/ file if present> |
```

Statuses: **Open**, **Planning**, **Promoted**, **Parked**, **Declined**.

## Split Rule

One chat note may produce **multiple Ideas**. Split when possibilities would
mature on different paths or support different Goals.

## Related

- [PlanTemplate.md](PlanTemplate.md)
- [PromotionChecklist.md](PromotionChecklist.md)
- [../Capabilities/InstructionCapture/README.md](../Capabilities/InstructionCapture/README.md)
