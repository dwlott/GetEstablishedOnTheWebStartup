<!--
IndexTitle: Plan Template
IndexDescription: Standard shape for new planning files in Plans/ from a selected Idea.
IndexType: Standard
IndexStatus: Active
LastEdited: 2026-06-06
-->

# Plan Template

Use when an **Idea** has enough shape to become structured work in `Plans/`.
Copy this scaffold into `Plans/<DescriptiveName>Plan.md` (PascalCase filename).

See [GoalsIdeasPlansCapabilitiesModel.md](../Plans/GoalsIdeasPlansCapabilitiesModel.md)
and [PromotionChecklist.md](PromotionChecklist.md).

## Metadata Block (Required)

```markdown
<!--
IndexTitle: <Plan Title>
IndexDescription: <One sentence — what this plan achieves>
IndexType: Project
IndexStatus: Active
LastEdited: YYYY-MM-DD
PromotedFrom: <Ideas/<Name>.md or Plans/Ideas.md row — or chat capture date>
-->
```

**IndexStatus values:** Active, Draft, Blocked, Superseded, Archive.

## Plan Body

```markdown
# <Plan Title>

## Purpose

Why this plan exists and which Goal it serves (Repository Goal and/or Owner Goal).

## Scope

What this pass includes.

## Out Of Scope

What this pass explicitly excludes (build, platform, automation, commit, push,
etc.).

## Background

Optional: link source Idea, review, or chat capture path.

## Deliverables

| Deliverable | Destination | Owner |
| --- | --- | --- |
| | | Agent / Owner |

## Validation

How to know the plan succeeded (checklist or review criteria).

## Open Questions

Non-blocking items → `Plans/OpenQuestions.md` when they affect multiple plans.

## Related

- [GoalsIdeasPlansCapabilitiesModel.md](GoalsIdeasPlansCapabilitiesModel.md)
- Source Idea or parent plan links
```

## Naming

- Filename: `PascalCase` + `Plan` suffix when the file is a planning track
  (for example `FirstRunStreamlinePlan.md`).
- Reviews: `*Review.md` in `Plans/` until archived to `Archive/HistoricalReviews/`.

## After The Plan Completes

| Outcome | Action |
| --- | --- |
| One-time work done | Mark plan **Superseded** or move to `Archive/SupersededPlans/` |
| Repeatable workflow proven | Follow [PromotionChecklist.md](PromotionChecklist.md) → CapabilityCreate |
| New convention proven | Promote to `Standards/` with owner approval |

Do not delete the plan until the promoted destination holds the knowledge.
See [ArchiveAndDeprecationRules.md](ArchiveAndDeprecationRules.md).

## Related

- [IdeaCaptureTemplate.md](IdeaCaptureTemplate.md)
- [PromotionChecklist.md](PromotionChecklist.md)
- [../Capabilities/CapabilityCreate/Prompt.md](../Capabilities/CapabilityCreate/Prompt.md)
