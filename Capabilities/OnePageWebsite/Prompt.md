<!--
IndexTitle: OnePageWebsite Prompt
IndexDescription: Copy-ready worker prompt for creating a one-page business website Markdown draft.
IndexType: Capability
CapabilityName: OnePageWebsite
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-03
-->

# OnePageWebsite Prompt

Use this prompt when the user wants a one-page business website draft from
approved inputs.

```text
# Worker pass: OnePageWebsite

Repository: GetEstablished
Branch: main
Repository path: C:\Repositories\GetEstablished

Read first:
- AGENTS.md
- README.md
- Capabilities/OnePageWebsite/README.md
- Capabilities/OnePageWebsite/Rules.md
- Capabilities/OnePageWebsite/OnePageWebsiteDraftPrompt.md
- Content/OnePageBusinessWebsite/README.md
- Content/OnePageBusinessWebsite/OnePageWebsiteInputs.md
- Plans/OpenQuestions.md

Goal:
Create a plain Markdown one-page business website draft only when essential
approved inputs exist. If essentials are missing, stop with a blocked report.

Use the copy-ready prompt body in:
Capabilities/OnePageWebsite/OnePageWebsiteDraftPrompt.md

Do not build the website, create HTML, choose a platform, add automation, add
dependencies, invent business facts, commit, or push unless explicitly
instructed.

Report using one copy-ready fenced text block:
Summary:
Files Changed:
Planning Files To Review:
Questions Added Or Changed:
Next Recommended Task:
```
