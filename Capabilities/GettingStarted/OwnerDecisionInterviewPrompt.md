<!--
IndexTitle: Owner Decision Interview Prompt
IndexDescription: Copy-ready prompt for interviewing an owner from an existing multiple-choice decision options file.
IndexType: Capability
CapabilityName: GettingStarted
IndexStatus: Active
LastEdited: 2026-06-03
-->

# Owner Decision Interview Prompt

## Purpose

Use this prompt when a planning agent should interview the owner from an existing multiple-choice decision options file.

The owner should answer in chat. The owner should not need to manually edit Markdown files just to answer a decision packet.

This prompt is reusable for any decision options file. It is ready to use with `Plans/PublishingOwnerDecisionOptions.md`.

## Copy-Ready Prompt

```text
You are helping me answer a repository decision packet as a planning agent.

Repository branch: main

Repository path:
C:\Repositories\GetEstablished

Use repository files as the source of truth.

Decision options file:
[PASTE PATH TO DECISION OPTIONS FILE HERE]

Example:
Plans/PublishingOwnerDecisionOptions.md

Goal:
Interview me conversationally from the decision options file and produce a clean answer summary that can later be pasted into an implementation-agent capture prompt.

Read first:
- AGENTS.md
- README.md
- Plans/RepositoryMap.md
- Plans/OpenQuestions.md
- Plans/AgentTaskBacklog.md
- The decision options file named above

Rules:
- Ask the questions in chat.
- Do not tell me to edit Markdown files.
- Use the decision options file as the source of truth for question wording, choices, recommended defaults, open-decision choices, and custom-answer choices.
- If the decision packet is long, ask one manageable group of questions at a time.
- Keep each question easy to answer.
- Let me answer by option letter, short phrase, or custom answer.
- If I choose a custom answer, restate it briefly and ask for confirmation if the answer could change scope.
- If my answer appears to approve a platform, build, deployment, domain, hosting, analytics, privacy, contact form, automation, external service, credential, billing, launch, file move, or owner-content creation, pause and confirm that approval explicitly before treating it as approved.
- Do not invent owner answers.
- Do not choose a publishing platform unless I explicitly approve that choice.
- Do not update repository files unless I explicitly ask you to do that after answers are gathered.

For publishing decision interviews, preserve this distinction:
- Get Established On The Web public website: the public site for GetEstablishedOnTheWeb.com.
- Future user one-page business websites: later user-facing outputs created from a user's approved business inputs.

Interview process:
1. Briefly tell me which decision options file you are using.
2. Ask the first manageable group of questions.
3. After I answer, summarize that group and ask the next group.
4. Continue until all decisions are answered, skipped, or intentionally left open.
5. At the end, produce a clean answer summary.

Final answer summary format:

Owner decision interview summary:

Source decision options file:

Decisions answered:

Decisions left open:

Explicit approvals:

Explicit non-approvals:

Scope cautions:

Copy-ready implementation-agent capture notes:

The final answer summary should be concise, practical, and easy to paste into a later implementation-agent prompt that captures approved answers into planning files.
```

## Agent Notes

- This prompt gathers owner answers; it does not capture them into repository files by itself.
- Use it after a multiple-choice decision options file exists.
- Keep the interview conversational and manageable.
- Preserve explicit approval boundaries for platform, build, deployment, hosting, analytics, contact-form, privacy, domain, launch, automation, dependencies, and owner-content work.
