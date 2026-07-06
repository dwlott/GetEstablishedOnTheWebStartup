<!--
IndexTitle: BusinessPlan Prompt
IndexDescription: Copy-ready worker prompt for the BusinessPlan operate workflow: clarify North Star and route to discovery or downstream draft.
IndexType: Capability
CapabilityName: BusinessPlan
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-22
-->

# BusinessPlan Prompt

Read [Rules.md](Rules.md) before using this prompt. The detailed, reusable
discovery questionnaire is [BusinessPlanDiscoveryPrompt.md](BusinessPlanDiscoveryPrompt.md);
use it when collecting inputs in depth.

```text
# Worker pass: BusinessPlan

Read first:
- AGENTS.md
- Capabilities/BusinessPlan/README.md
- Capabilities/BusinessPlan/Rules.md
- Capabilities/BusinessPlan/BusinessPlanDiscoveryPrompt.md
- Workspace/OwnerGoals.md

Goal:
Help the owner clarify a North Star goal and capture practical business-plan
inputs as plain Markdown discovery notes, so downstream web-presence work has a
credible source of truth. This is discovery only.

Steps:
1. Confirm intent: discovery/clarify (stay here) vs draft a one-page website
   (hand off to OnePageWebsite). If unclear, ask one concise question.
2. Capture or refine the North Star outcome in plain language. If it is durable,
   write it to Workspace/OwnerGoals.md (Owner Goals register), not into copy.
3. Collect essential first-draft inputs using BusinessPlanDiscoveryPrompt.md.
   Separate essential from optional/later inputs.
4. Record non-blocking unknowns in Plans/OpenQuestions.md.

Rules:
- Use only owner-provided or owner-approved facts; never invent business facts.
- Do not produce a finished business plan, website draft, HTML, platform choice,
  automation, dependencies, or publishing decisions.
- Do not provide legal, financial, tax, investment, accounting, or insurance
  advice.
- If core inputs are missing and you cannot proceed without inventing facts,
  stop with a blocked report.

Handoff:
- When essentials are clear and the owner wants a site, route to OnePageWebsite.

End with one fenced handoff:
Summary, Files Changed, Planning Files To Review,
Questions Added Or Changed, Next Recommended Task
```

## Related

- [README.md](README.md)
- [Rules.md](Rules.md)
- [BusinessPlanDiscoveryPrompt.md](BusinessPlanDiscoveryPrompt.md)
