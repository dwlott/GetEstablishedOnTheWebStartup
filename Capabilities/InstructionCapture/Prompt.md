<!--
IndexTitle: InstructionCapture Prompt
IndexDescription: Copy-ready worker prompt for chat and session capture triage.
IndexType: Capability
CapabilityName: InstructionCapture
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-06
-->

# InstructionCapture Prompt

Read [Rules.md](Rules.md) before using this prompt.

```text
# Worker pass: InstructionCapture

Repository: C:\Repositories\GetEstablished
Branch: main

Read first:
- AGENTS.md
- Capabilities/InstructionCapture/Rules.md
- Standards/IdeaCaptureTemplate.md
- Standards/PlanTemplate.md
- Standards/PromotionChecklist.md
- Plans/Ideas.md
- Plans/GoalsIdeasPlansCapabilitiesModel.md

Source material:
<Paste chat summary, session notes, or describe the capture request>

Goal:
Triage this material into durable repository artifacts. Classify each distinct
intent, choose destinations, and write files using the Standards templates.
Do not skip capture metadata (date, source, intent, destination, confidence).

In scope:
- Raw or tracked Ideas (Ideas/, Plans/Ideas.md)
- New Plan scaffold (Plans/<Name>Plan.md) when steps and scope are needed
- OpenQuestions row when non-blocking decision
- Delegate full chat body to ChatToMarkdown when the entire transcript must be saved
- Recommend next promotion step from PromotionChecklist.md

Out of scope:
- CapabilityCreate unless owner explicitly approved and checklist Stage 3 passes
- Commit, push, website build, automation, external services
- Overwriting Workspace/OwnerGoals.md

Sequence:
1. List distinct captures found in source material.
2. For each: category, destination path, which template applies.
3. Write files; update Plans/Ideas.md rows when tracking.
4. Set one Next Recommended Task (often Plan implementation or ContentReview).

End with exactly one fenced text handoff:
Summary
Captures written (paths)
Ideas register updates
Plans created or updated
Promotion stage reached
Files Changed
Questions Added Or Changed
Next Recommended Task
```

## Prompt history

- **2026-06-06 (v1):** Initial Phase 4 capture triage prompt.

## Related

- [README.md](README.md)
- [../ChatToMarkdown/Prompt.md](../ChatToMarkdown/Prompt.md)
