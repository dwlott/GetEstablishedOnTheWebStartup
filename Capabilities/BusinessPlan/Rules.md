<!--
IndexTitle: BusinessPlan Rules
IndexDescription: Scope, data boundaries, and discovery-only guardrails for the BusinessPlan Capability.
IndexType: Capability
CapabilityName: BusinessPlan
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-22
-->

# BusinessPlan Rules

Read before running [Prompt.md](Prompt.md).

## Scope

In scope:
- Clarify the owner's **North Star** outcome in plain language.
- Collect practical business-plan discovery inputs (identity, offer, audience,
  service area, contact intent, call to action).
- Separate essential first-draft inputs from optional or later inputs.
- Record unknowns as open questions in `Plans/OpenQuestions.md`.

Out of scope unless separately approved:
- A finished business plan, financial model, or 30/60/90 plan.
- A one-page website draft — that is **OnePageWebsite**.
- HTML, platform choice, automation, or dependency setup.
- Publishing, DNS, analytics, or external profile edits.

## Data Boundaries

- Use only information the owner provides or clearly approves.
- Do not invent business facts, credentials, proof, testimonials, client names,
  results, guarantees, pricing, service areas, legal or policy language, or
  contact details.
- If a detail is unknown, mark it unknown or move it to open questions.
- Do not store credentials, passwords, payment details, or private secrets.
- Do not provide legal, financial, tax, investment, accounting, or insurance
  advice; label suggestions as draft-stage only.

## Placement

BusinessPlan operates on existing documentation and discovery notes. It does not
provision new repository folders, so there is no `Structure.md` or
`SetupPrompt.md` for version 1.

- Durable Owner Goals / North Star: `Workspace/OwnerGoals.md`.
- Open questions: `Plans/OpenQuestions.md`.
- Discovery notes and downstream inputs: `Content/OnePageBusinessWebsite/`.

## Situational Awareness

When **BusinessPlan** is the active Capability (after core SA):

- Confirm whether the owner wants discovery (this Capability) or a website draft
  (**OnePageWebsite**) before producing output.
- If core first-draft inputs are missing, ask concise follow-up questions or stop
  with a blocked report — do not guess facts.

## Related

- [README.md](README.md)
- [Prompt.md](Prompt.md)
- [BusinessPlanDiscoveryPrompt.md](BusinessPlanDiscoveryPrompt.md)
- Downstream: [OnePageWebsite/Rules.md](../OnePageWebsite/Rules.md)
