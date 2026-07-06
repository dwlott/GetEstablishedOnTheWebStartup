<!--
IndexTitle: Promotion Checklist
IndexDescription: Runnable checklist for Idea to Plan to Capability or Standard promotion.
IndexType: Standard
IndexStatus: Active
LastEdited: 2026-06-06
-->

# Promotion Checklist

Formal chain: **Ideas** → **Plans** → **Capabilities** / **Standards** /
implemented folders (`Content/`, `Automation/`, etc.).

Model reference: [GoalsIdeasPlansCapabilitiesModel.md](../Plans/GoalsIdeasPlansCapabilitiesModel.md).

## Stage 0 — Capture (Chat Or Session)

- [ ] Source context recorded (date, chat title, or file path)
- [ ] Capture category chosen (idea, plan, open question, capability enhancement, deprecated practice)
- [ ] Routed through [InstructionCapture](../Capabilities/InstructionCapture/Prompt.md) or [ChatToMarkdown](../Capabilities/ChatToMarkdown/Prompt.md)

## Stage 1 — Raw Idea → Tracked Idea

Promote when the possibility supports a Repository Goal or Owner Goal and has
enough shape to track.

- [ ] Raw note in `Ideas/FutureIdeas.md` **or** `Ideas/<Name>.md` using [IdeaCaptureTemplate.md](IdeaCaptureTemplate.md)
- [ ] Row added to [Plans/Ideas.md](../Plans/Ideas.md) with status **Open** or **Planning**
- [ ] Linked Goal named (Repository Goals and/or Owner Goals)
- [ ] Owner approved tracking (implicit OK for agent capture prep; explicit for scope expansion)

## Stage 2 — Idea → Plan

Promote when the Idea needs steps, decisions, sequencing, or a worker pass.

- [ ] [PlanTemplate.md](PlanTemplate.md) used for new `Plans/<Name>Plan.md`
- [ ] **Purpose**, **Scope**, and **Out Of Scope** filled
- [ ] `Plans/Ideas.md` row status → **Planning** or **Promoted**
- [ ] `PromotedFrom` metadata links back to source Idea
- [ ] No vague ideas promoted directly to Capabilities

## Stage 3 — Plan → Capability Candidate

Promote only when **all** hold:

- [ ] **Repeatable** — same kind of task recurs
- [ ] **Reusable** — future agents or repositories could reuse it
- [ ] **Worth routing** — belongs in [Capabilities/README.md](../Capabilities/README.md)

Then:

- [ ] Owner approved CapabilityCreate scope
- [ ] [CapabilityCreate](../Capabilities/CapabilityCreate/Prompt.md) pass run
- [ ] [CapabilityMetadataStandard.md](CapabilityMetadataStandard.md) and Harmonization Metadata filled
- [ ] [AgentCapabilityGuide.md](../Capabilities/AgentCapabilityGuide.md) and registry updated
- [ ] Source plan marked **Superseded** or archived — not deleted until destination is complete

## Stage 4 — Plan → Standard

Promote when the outcome is a **cross-cutting convention**, not a workflow.

- [ ] Outcome is stable, short, and repository-wide
- [ ] New or updated file in `Standards/`
- [ ] [Standards/README.md](README.md) updated
- [ ] Source plan archived per [ArchiveAndDeprecationRules.md](ArchiveAndDeprecationRules.md)

## Stage 5 — Plan → Implemented Work (One-Time)

Many plans end here — no Capability required.

- [ ] Work landed in correct folder (`Content/`, `Workspace/`, `Automation/`, etc.)
- [ ] Plan validation checklist satisfied
- [ ] Plan status → **Superseded** or moved to Archive
- [ ] Optional: row in `Automation/AgentReplies/` for substantial passes

## Stage 6 — Index And Navigation (When Structural)

- [ ] [RepositorySearchMap.md](../Plans/RepositorySearchMap.md) updated if placement changed
- [ ] Folder README updated if new folder created
- [ ] **Indexing** Capability refresh when `Indexes/` is provisioned and owner approved

## Stop Rules

- Do not promote vague chat fragments into Capabilities.
- Do not delete plan files until promoted destination holds the knowledge.
- Do not move owner-specific facts into Capability `Rules.md` unless owner explicitly promotes a pattern.
- Commit and push only when the owner requests a milestone.

## Related

- [ArchiveAndDeprecationRules.md](ArchiveAndDeprecationRules.md)
- [IdeaCaptureTemplate.md](IdeaCaptureTemplate.md)
- [PlanTemplate.md](PlanTemplate.md)
- [../AGENTS.md](../AGENTS.md) — How To Promote Work
