<!--
IndexTitle: Open Questions
IndexDescription: Non-blocking owner decisions for GetEstablishedOnTheWeb.com product work (publishing, offer, launch).
IndexType: Project
IndexStatus: Active
LastEdited: 2026-06-14
-->

# Open Questions

Non-blocking decisions for batch review on the **GetEstablishedOnTheWeb product
repository**. Agents should keep working unless a question blocks the immediate
task.

Owner-specific facts belong in `Workspace/`, not in Capability files. Full
decision history and method-host questions live on the archetype host:
`C:\Repositories\GetEstablished\Plans\OpenQuestions.md`.

## Track Distinction

| Track | What it is |
| --- | --- |
| **Get Established On The Web public site** | GetEstablishedOnTheWeb.com — explains the method and **Get Established** starter offer |
| **User one-page business website** | Future output from guided setup — `Content/OnePageBusinessWebsite/` when used |

Do not merge public-site decisions with user-output platform choices.

## Decided

| Topic | Decision | Record |
| --- | --- | --- |
| Publishing platform direction | WordPress on Bluehost, StudioPress Genesis + Altitude | [Phase4PublishingPlatformDecision.md](Phase4PublishingPlatformDecision.md) (2026-06-07) |
| Public platform naming on live site | Keep vendor names as drafted (Option A) | [StripMapOwnerDecisions.md](StripMapOwnerDecisions.md) (2026-06-12) |
| Primary public CTA | Dual path: **GetEstablishedStartup** (free magnet) + **GetEstablishedOnTheWebStartup** (paid) | [RepositoryOfferLadder.md](RepositoryOfferLadder.md) (2026-06-14) |
| Primary offer direction | Guided setup for the Get Established Workspace | [Offers.md](../Content/Website/Pages/Offers.md); draft hedging kept until offer finalized |
| Page content phase | Owner satisfied with core page drafts; P1/P2 publish dry runs complete | [WordPressP1DryRuns.md](WordPressP1DryRuns.md), [WordPressP2DryRuns.md](WordPressP2DryRuns.md) (2026-06-12) |
| Contact Form 7 | Deferred until first pages live and privacy reviewed | [Phase4PublishingPlatformDecision.md](Phase4PublishingPlatformDecision.md) |
| GitHub Pages harmony | Static export built in `docs/`; **Pages not enabled** until owner publish pass | [GitHubPagesHarmonyPlan.md](GitHubPagesHarmonyPlan.md) | Prep done (2026-06-20) |
| About origin story | Mission-first for now; personal origin optional later | Method host `C:\Repositories\GetEstablished\Plans\OpenQuestions.md` § Public Origin Story |
| Markdown source of truth | Repo `Content/Website/Pages/` until owner approves WP-as-source per page | [WebsiteGoals.md](WebsiteGoals.md) Goal 7 |
| Local WAMP staging build | Genesis + Altitude on `G:\wamp64\www\getestablishedontheweb` (2026-06-13) | [LocalWordPressBuildReport.md](LocalWordPressBuildReport.md) |
| Messaging lead | Visitor-first web establishment; GetEstablishedOnTheWebStartup as web offer | [ProductLanguageAndPositioning.md](ProductLanguageAndPositioning.md) (2026-06-13) |
| Repository offer model | **Parallel products** on one shelf — not a serial purchase ladder | [RepositoryOfferLadder.md](RepositoryOfferLadder.md) (2026-06-14) |
| GetEstablishedStartup commercial posture | **Free magnet** — lead-in download; harmonized core instructions | [RepositoryOfferLadder.md](RepositoryOfferLadder.md) (2026-06-14) |
| GetEstablishedOnTheWebStartup commercial posture | **First paid repository product** — for sale; includes web + WordPress/StudioPress Capabilities | [RepositoryOfferLadder.md](RepositoryOfferLadder.md) (2026-06-14) |
| Future specialty repositories | Additional **parallel for-sale** offers on the same GEOTW storefront | [RepositoryOfferLadder.md](RepositoryOfferLadder.md) (2026-06-14) |
| Repository hub pages Phase 1 | Slug `/getestablished/`; title **GetEstablished**; parallel to future `/get-established-on-the-web/` | [RepositoryOfferPagesPlan.md](RepositoryOfferPagesPlan.md) (2026-06-14) |

## Open — Launch And Build

| Question | Why it matters | Default assumption | Status |
| --- | --- | --- | --- |
| Build pass approval | Platform choice ≠ execution approval | Wait until owner explicitly approves a build pass | Open (Bluehost production) |
| Bluehost / WordPress admin / Genesis + Altitude access | [WordPressBuildChecklist.md](WordPressBuildChecklist.md) prerequisite | Owner confirms at build session | Open (production); local WAMP done |
| **GetEstablishedStartup** free download URL | Free-magnet CTA on `/getestablished/` and Offers | GitHub template or ZIP when owner publishes | Open |
| **GetEstablishedOnTheWebStartup** purchase/download path | Paid product CTA; repo may not exist on GitHub yet | Named offer on site; price and delivery TBD — do not invent | Open |
| Future companion repo offer timing | Future GEOTW companion repo | Mention on Offers/About only when ready | Open |
| Capability harmonization on GitHub (community model) | Long-term downloadable Capabilities story | Planning language only until model defined | Open |
| Specialty companion repo packaging | Showcase on GEOTW; apps on separate sites | Harmony story now; download paths later | Open |
| Front-page section link paths | `FrontPageHero.md` / `FrontPageCta.md` hardcode local subdir `/getestablishedontheweb/...`; wrong at production domain root | Fix via sync-side href rewrite or templating during the build pass (not by editing local-staging paths now) | Open |
| DNS / SSL / public launch sign-off | Launch gate | No public launch without owner approval | Open |
| Analytics and privacy tooling | Post-launch | None until separately approved | Open |

## Open — Offer And Marketing

| Question | Why it matters | Default assumption | Status |
| --- | --- | --- | --- |
| Final offer packaging | Service vs template vs workshop vs hybrid | Guided setup remains primary; see `Offers.md` Open Decisions | Open |
| Pricing and delivery model | Public sales copy | Non-blocking for repo work; no invented pricing | Open |
| Public contact path | After download-first CTA | Contact later; CF7 deferred | Open |
| Exact homepage button text | Polish at launch | **Get Established** is the CTA direction; wording may refine | Open |

## Open — Proof And Credibility

| Question | Why it matters | Default assumption | Status |
| --- | --- | --- | --- |
| Screenshots and tutorial demonstrations | [WebsiteGoals.md](WebsiteGoals.md) Goal 6 | Repository-as-proof first | Open |
| AI evaluation public wording | Avoid unsupported "testimonials" | Clear source and limits required | Open |
| Personal founder origin on About | Optional later pass | Mission-first copy is sufficient for now | Open |

## Open — Content Source Coverage

Surfaced 2026-06-17 during the website content-improvement pass. Most
reader-facing copy is Markdown source of truth ([WebsiteGoals.md](WebsiteGoals.md)
Goal 7), but two surfaces are not yet:

| Question | Why it matters | Default assumption | Status |
| --- | --- | --- | --- |
| Archive intro copy source | `showcase`, `movercalcs`, `updates`, `tutorials` intros live as inline `intro_html` in `Workspace/LocalWordPressBuild/content-manifest.php`, not Markdown | Recommended: back each with a small `.md` via the existing `build_from_markdown` pattern (as `/capabilities/` already does) — implement and verify on WAMP, not blind | Open |
| Posts authoring workflow | Real `showcase` / `updates` / `movercalcs` / `tutorials` posts (currently HTML sample placeholders) | **Showcase:** Markdown in `Content/Website/Posts/Showcase/` + `geotw-showcase-posts-sync.php` (draft until `--publish`); Updates/MoverCalcs still open | Partial (2026-06-20) |

Implementation of Markdown-backed archive intros is a **build change** (new `.md`
files, `content-manifest.php` edit, archive render changes title handling) — do
it as its own tested pass on local WAMP, per the build-pass guardrails.

## Consumer Starter (Not This File)

First-session setup questions (Owner Goals, project folder name, GitHub repo name)
belong on the **consumer starter** repository:

```text
C:\Repositories\GetEstablishedStartup\Workspace\OwnerGoals.md
```

Use **GettingStarted** / Quick Startup there — not this product repo.

## How To Use

1. Batch non-blocking product decisions here instead of blocking small tasks.
2. Mark **Decided** with date and a pointer when the owner answers.
3. Do not duplicate method-host ENV, Capability, or Intake questions — link to
   the host file instead.
4. Page copy changes stay in `Content/Website/Pages/` unless a build pass applies
   strip-map actions at publish time only.

## Related

- [WebsiteGoals.md](WebsiteGoals.md)
- [GEOTWProductGoals.md](GEOTWProductGoals.md)
- [Phase4PublishingPlatformDecision.md](Phase4PublishingPlatformDecision.md)
- [StripMapOwnerDecisions.md](StripMapOwnerDecisions.md)
- [WordPressBuildChecklist.md](WordPressBuildChecklist.md)
- [AgentTaskBacklog.md](AgentTaskBacklog.md)
- [ProductLanguageAndPositioning.md](ProductLanguageAndPositioning.md)
- [RepositoryOfferLadder.md](RepositoryOfferLadder.md)
- Method host archive: `C:\Repositories\GetEstablished\Plans\OpenQuestions.md`
- Method host packet: `C:\Repositories\GetEstablished\Plans\PublishingOwnerDecisionOptions.md`
