<!--
IndexTitle: One-Page Website Draft Prompt
IndexDescription: Reusable prompt for turning approved business inputs into a plain Markdown one-page website draft.
IndexType: Capability
CapabilityName: OnePageWebsite
IndexStatus: Active
LastEdited: 2026-06-03
-->

# One-Page Website Draft Prompt

## Purpose

Use this prompt when a user explicitly wants an implementation agent to turn approved business-plan or one-page website inputs into a plain Markdown one-page business website draft.

Do not use this prompt to invent missing business facts, build a website, create HTML, choose a publishing platform, add automation, or add dependencies.

## Copy-Ready Prompt

```text
You are working locally in C:\Repositories\GetEstablished.

Do not push to GitHub unless explicitly instructed.

Use the repository workflow.

Read:
- AGENTS.md
- README.md
- Plans/BusinessPlanHelperPlan.md
- Plans/OnePageBusinessWebsitePlan.md
- Archive/HistoricalReviews/OnePageBusinessWebsiteRefinedReview.md
- Plans/OpenQuestions.md
- Content/OnePageBusinessWebsite/README.md
- Content/OnePageBusinessWebsite/OnePageWebsiteInputs.md
- Content/OnePageBusinessWebsite/OnePageWebsiteSections.md

Task:
Create a plain Markdown one-page business website draft only from approved or clearly provided inputs.

Default output path, unless the user specifies another Markdown path:
- Content/OnePageBusinessWebsite/OnePageWebsiteDraft.md

Use the input fields from:
- Content/OnePageBusinessWebsite/OnePageWebsiteInputs.md

Use the section guidance from:
- Content/OnePageBusinessWebsite/OnePageWebsiteSections.md

Essential approved inputs required before drafting:
- Business Name Or Site Title
- Tagline
- Short Business Description
- Services
- Service Area
- Why Choose Us
- About
- Contact / Preferred Contact Method
- Call To Action

Stop condition:
If any essential approved input is missing, do not create the one-page website draft. Instead, report the missing essential inputs and recommend adding them to the source inputs or Plans/OpenQuestions.md.

If blocked, report using this format:
Blocked Reason:
Missing Essential Inputs:
Safe Defaults Used:
Questions To Add To OpenQuestions.md:
Next Recommended Human Action:

Safe defaults should only describe the decision to stop, preserve blanks, or use existing approved inputs. Do not use safe defaults to invent business facts.

Drafting rules:
- Create a plain Markdown draft only.
- Do not create HTML.
- Do not choose WordPress, GitHub Pages, a website builder, or any other publishing platform.
- Do not add automation.
- Do not add dependencies.
- Do not invent claims, testimonials, proof, credentials, service areas, pricing, guarantees, business history, contact details, legal language, policy language, or business details.
- Use only approved or clearly provided inputs.
- Use placeholders for optional missing details only when they are clearly marked as placeholders.
- Add or update Plans/OpenQuestions.md only for non-blocking decisions that should be batched for human review.
- Keep the draft compatible in concept with WordPress-style sites and website builders.
- Keep child pages as future-only expansion.
- Preserve framework-neutral source content.

Recommended one-page draft sections:
- Hero
- Services
- About
- Why Choose Us
- Testimonials Or Proof
- Frequently Asked Questions
- Contact
- Footer

If proof, testimonials, credentials, pricing, policies, or legal language are not confirmed, keep them out of the public-facing draft or mark them as draft placeholders for human review.

Do not edit unrelated files.
Do not build the website.
Do not choose a publishing platform.
Do not create HTML.
Do not add automation.
Do not add dependencies.

After finishing, report using one copy-ready fenced text block only.

Use this report format:
Summary:
Files Changed:
Planning Files To Review:
Questions Added Or Changed:
Next Recommended Task:
```

## Agent Notes

This prompt creates source content only when essential approved inputs exist.

If the agent cannot identify approved essentials, the correct output is a short blocked report, not a guessed website draft.

Upstream discovery: use `Capabilities/BusinessPlan/BusinessPlanDiscoveryPrompt.md` when inputs are not yet collected.
