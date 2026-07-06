<!--
IndexTitle: Website Editorial Style
IndexDescription: House style guide for improving the textual content of GetEstablishedOnTheWeb.com public pages.
IndexType: Standard
IndexStatus: Active
LastEdited: 2026-06-17
-->

# Website Editorial Style

The single bar for improving the textual content of public website pages under
`Content/Website/Pages/`. Every content-improvement pass is measured against this
file so the page set reads as one voice instead of many.

This standard **references** existing rules rather than restating them. It does
not change positioning, claims policy, platform decisions, or page routing.

## Source Rules This Standard Defers To

| Topic | Canonical source |
| --- | --- |
| Positioning, naming, approved/avoided terms | [ProductLanguageAndPositioning.md](../Plans/ProductLanguageAndPositioning.md) |
| Review categories + "Ready For Website" vocabulary | [ContentReview/Rules.md](../Capabilities/ContentReview/Rules.md), [ContentReview/Prompt.md](../Capabilities/ContentReview/Prompt.md) |
| Page title / headline / body role per page | [PublicWebsitePageStructurePlan.md](../Plans/PublicWebsitePageStructurePlan.md) |
| Front-page narrative flow | [GEOTWFrontPageContentStrategyPlan.md](../Plans/GEOTWFrontPageContentStrategyPlan.md) |
| Website outcomes | [WebsiteGoals.md](../Plans/WebsiteGoals.md) |

When this standard and a source rule appear to conflict, the source rule wins;
update this file rather than diverging silently.

## Voice

- Second person ("you"), calm, capable, beginner-friendly.
- Lead with the visitor's practical question or outcome, not a definition.
- Progress and revision over instant completion or guaranteed results.
- Plain words a newcomer understands without insider knowledge; explain a
  repository term the first time it appears on a page.
- Aim for a general-audience reading level: short sentences, active voice,
  concrete nouns.

## Mandatory Page Skeleton

Every reader-facing page follows the pattern from
[PublicWebsitePageStructurePlan.md](../Plans/PublicWebsitePageStructurePlan.md):

1. Page title (`# H1`).
2. One catch phrase or headline — a single sentence directly under the title.
3. Short "why this matters" opening (1–3 sentences) that names the visitor's
   situation before introducing the site or product.
4. Practical sections that support the headline (steps, lists, short prose).
5. One clear next step toward the next useful page.
6. Nothing else rendered to the reader — see Planning Residue below.

## Two Content Modes

Treat each page as one of two jobs and open it accordingly.

| Mode | Pages (examples) | How it opens |
| --- | --- | --- |
| **Persuasion** | `Home`, `Offers`, `About`, `Method`, `Capabilities`, `FrontPage/*` | Lead with the outcome and the parallel free/paid offer story; benefit-driven headline. |
| **Reference** | `GoogleBusinessProfileBasics`, `YelpBasics`, `GitHubWorkflow`, `AIWorkflow`, `AgentPermissions` | Open with a short human "why this matters / what you'll get," then the checklist or steps. Keep the practical value; do not let it read like an internal SOP. |

Reference pages must not begin with internal headings like "Information To
Gather" or "Notes For Future Editing." Put a reader intro first; move maintenance
notes to planning (below).

## Scannability

- Front-load the answer in the first paragraph.
- Short paragraphs (about 1–3 sentences).
- Use ordered lists for sequences, bullets for option sets.
- Bold the key term in a bullet, not whole sentences.
- One primary call to action per page; secondary links are fine but clearly
  subordinate.

## Calls To Action

- Name the next page or action plainly; avoid vague "learn more."
- Keep CTA wording consistent with positioning: practical path (Start Here →
  Google / Yelp basics) and repository path (free **GetEstablishedStartup** /
  paid **GetEstablishedOnTheWebStartup**) as parallel choices.
- Never invent pricing, ship dates, or download URLs. Use the named offer and
  defer specifics, per positioning.

## Planning Residue (Do Not Render To Readers)

Planning artifacts must not appear as visitor-facing prose. This includes
`Link Intent`, `Open Decisions`, "Notes For Future Editing," and similar
agent/maintenance sections.

- Owner decision: relocate this content to **`Plans/`** (not HTML comments).
- Consolidated home: [WebsitePageContentNotes.md](../Plans/WebsitePageContentNotes.md),
  keyed by page, captures link intent and per-page editing notes.
- True non-blocking owner decisions belong in
  [OpenQuestions.md](../Plans/OpenQuestions.md); link-intent and editing notes
  belong in `WebsitePageContentNotes.md`.
- The index metadata comment block at the top of each page stays.

## Guardrails (Unchanged)

Hold every existing constraint while improving copy:

- Framework-neutral plain Markdown; no HTML, theme, or hosting decisions in page
  drafts.
- No invented pricing, ship dates, or download URLs.
- Repository-as-proof before testimonials; no AI-evaluation hype.
- No guarantees about ranking, traffic, leads, or customer outcomes.
- Keep **GetEstablished** (host) distinct from **GetEstablishedOnTheWebStartup**
  (paid product) and **GetEstablishedStartup** (free magnet).
- Owner approval is required for claims, tone sign-off, and any `ReadyForExtract`
  recommendation.

## How To Run A Content-Improvement Pass

1. Run **ContentReview** on the target page(s) to capture a baseline (findings +
   "Ready For Website" recommendation).
2. Apply the per-page checklist:
   - Hook the opening (visitor problem/outcome first).
   - Tighten the middle (scannable, jargon-free, one CTA).
   - Strip planning residue to `Plans/WebsitePageContentNotes.md`.
   - Conform to this standard (voice, terms, skeleton, mode).
3. Re-run **ContentReview**; confirm the recommendation holds or improves.
4. Log the page in [AgentTaskBacklog.md](../Plans/AgentTaskBacklog.md) with its
   recommendation.
5. Improve pages in visitor-journey order (Home → Start Here → Google/Yelp →
   How It Works → AI Workflow / Agent Permissions / GitHub Workflow → Offers /
   Method / Capabilities → About → `FrontPage/*`).

## Related

- [ProductLanguageAndPositioning.md](../Plans/ProductLanguageAndPositioning.md)
- [PublicWebsitePageStructurePlan.md](../Plans/PublicWebsitePageStructurePlan.md)
- [ContentReview/Rules.md](../Capabilities/ContentReview/Rules.md)
- [WebsitePageContentNotes.md](../Plans/WebsitePageContentNotes.md)
- [WebsiteGoals.md](../Plans/WebsiteGoals.md)
