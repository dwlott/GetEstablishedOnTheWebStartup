<!--
IndexTitle: ContentReview Prompt
IndexDescription: Copy-ready prompt to review Get Established website page drafts.
IndexType: Capability
CapabilityName: ContentReview
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-04
-->

# ContentReview Prompt

Canonical home for Get Established content review. Legacy redirect: `Intake/GetEstablishedOnTheWeb/Docs/Prompts/ContentReviewPrompt.md`.

Read [Rules.md](Rules.md) before running the review.

```text
You are reviewing website source drafts for Get Established On The Web.

Read AGENTS.md and Capabilities/ContentReview/Rules.md first.

Repository identity split:
- GetEstablished host repository: Plans/RepositoryGoals.md — ideas → plans → implemented work; workflow learning; Situational Awareness. Not "product and the proof."
- Get Established On The Web product and public site: Plans/ProductLanguageAndPositioning.md — prepared foundation, Workspace, and offered Repository naming. Website drafts may describe the offered workspace as method and working proof for customers.

Project context (GEOTW website drafts only):
Get Established On The Web helps people build a practical online presence while learning GitHub and AI-assisted workflows. The offered Get Established Workspace may be presented as a working example of the method—not the GetEstablished host repository.

Review these Markdown page drafts unless the user specifies a subset:
- Content/Website/Pages/Index.md
- Content/Website/Pages/Home.md
- Content/Website/Pages/StartHere.md
- Content/Website/Pages/HowItWorks.md
- Content/Website/Pages/AIWorkflow.md
- Content/Website/Pages/AgentPermissions.md
- Content/Website/Pages/GitHubWorkflow.md
- Content/Website/Pages/Offers.md
- Content/Website/Pages/About.md

Goal:
Identify practical improvements to the page drafts without building the website, choosing a framework, adding dependencies, or changing deployment plans.

Review for:

1. Clarity
   - Is the main message easy to understand?
   - Does each page have a clear purpose?

2. Credibility
   - Does the content sound grounded and believable?
   - Are any claims too broad, vague, or unsupported?

3. Completeness
   - Is any essential first-pass content missing?
   - Are there obvious questions a visitor would still have?

4. Tone Consistency
   - Does the content stay practical, credible, calm, and business-focused?
   - Does it avoid hype, jargon, and overpromising?

5. Practical Next Steps
   - Does each page point toward a useful next action or future decision?
   - Are future notes specific enough to guide later work?

6. Framework Neutrality
   - Does the content stay in plain Markdown?
   - Does it avoid implementation details that should wait until the website build phase?

7. Product Language (when multiple pages are in scope)
   - Are prepared foundation, Workspace, Repository, and user website output distinctions consistent?

Output:
- A short overall assessment.
- Page-by-page notes with the most important suggested improvements.
- Any unsupported or hype-like claims to revise.
- Missing content or decisions to gather from the project owner.
- A prioritized next-step checklist.
- A Ready For Website recommendation per page: No, Partial, AdvanceToOwnerReview, ReadyForExtract, or OnHold (owner judgment; do not mark ReadyForExtract without owner review of claims and tone).

Keep the review concise and actionable. Do not rewrite every page unless specifically asked.
```

## Prompt history

- **2026-05-28 (v1):** Migrated from `Docs/Prompts/ContentReviewPrompt.md`; added Rules.md reference, AgentPermissions.md in default page list, product-language check.
- **2026-05-29 (v1):** Cross-pollination (CapabilityHarmonize Option A) — added a per-page Ready For Website recommendation using the shared vocabulary with a commissioned instance's ContentReview.
