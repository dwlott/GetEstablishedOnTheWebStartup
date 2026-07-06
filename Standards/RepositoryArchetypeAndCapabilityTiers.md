<!--
IndexTitle: Repository Archetype And Capability Tiers
IndexDescription: Three-tier Capability model — Universal, Archetype, Commissioned — for Get Established and related repositories.
IndexType: Standard
IndexStatus: Active
LastEdited: 2026-05-30
-->

# Repository Archetype And Capability Tiers

## Purpose

Explain why **GetEstablishedOnTheWeb**, **a commissioned instance**, and future repositories (for example Write a Book) carry different Capabilities without treating one repo as universally "ahead."

Capabilities are grouped into **tiers**. The registry **Tier** column tags each module.

**Related:** [RepositoryCoreStandard.md](RepositoryCoreStandard.md), [CrossRepoCapabilityGapMatrix.md](../Project/CrossRepoCapabilityGapMatrix.md), [RepositoryArchetypeModel.md](../Project/RepositoryArchetypeModel.md) (planner summary).

## The Three Tiers

| Tier | Meaning | Lives on parent? | Lives on commissioned child? |
| --- | --- | --- | --- |
| **Universal** | Every strong repository should offer these workflows; folder shapes may differ | Catalog + migrate over time | Active implementations |
| **Archetype** | Tied to the **Get Established On The Web** offer (web presence, business or personal portfolio) | **Home** — product site, setup markdowns, review library | Adopted or extended from parent |
| **Commissioned** | This repository **in service** for one owner, business, or project | **Not on parent** | **Home** — intake, domain rules, owner paths |

```text
Universal  →  applies to almost any capable repo (ingest chat, index files, local tool setup)
Archetype  →  Get Established product (website harmony, publishing reviews, template)
Commissioned →  a commissioned instance (email intake, domain claims, tax planning prompts)
```

## Get Established Archetype Identity

**GetEstablishedOnTheWeb** is the **archetype host**, not a commissioned business repo.

It offers:

- A **clean, ready repository** with setup markdowns and agent rules.
- **Website source drafts** under `Content/Website/Pages/` in harmony with the Get Established product story.
- **Archetype Capabilities** such as quality reviews, publishing readiness, and template guidance.
- A growing **universal Capability catalog** (ChatToMarkdown, Indexing, LocalAgentToolSetup; some still in `Docs/Prompts/` during migration).

It does **not** carry a commissioned instance's email inboxes, domain-specific claim rules, or other commissioned-only modules.

## Commissioned Instance

A **commissioned instance** is the first **commissioned** repository: Get Established put into service for a real business.

- Proves the template under real material (`Planning/`, `PossibleWebPages/`, `Owner/`).
- **Adopts** universal and archetype patterns from the parent where they fit.
- **Adds** commissioned Capabilities (EmailIntake, ScanIntake, TaxPlanningQuestions).
- **May diverge** from parent on **archetype** modules (for example a commissioned instance's ContentReview v2 Rules) without changing tier — still Archetype, not Commissioned.
- **Provisions** folders only when a Capability **SetupPrompt** runs (see [RepositoryCoreStandard.md](RepositoryCoreStandard.md)).

A commissioned instance is a reference, not something to copy wholesale into a new archetype repo.

## Other Archetypes (Illustrative Only)

A **Write a Book** repository would be a **different archetype**, not a commissioned Get Established instance.

| | Get Established (web presence) | Write a Book (illustrative) |
| --- | --- | --- |
| Universal | ChatToMarkdown, Indexing, local tool setup | Same universal ideas |
| Archetype | Website pages, publishing reviews, web-presence discovery | Chapter structure, manuscript review, citation rules |
| Commissioned | commissioned intake, domain copy | One author's series, publisher handoff |

**This repository does not implement Write a Book.** The comparison clarifies why tier tags matter when comparing GEOTW to a commissioned instance.

## Provisioned Structure (All Tiers)

Folders required by a Capability are created only when that Capability's **SetupPrompt** runs in an approved session.

- Universal Capabilities may provision indexes or intake paths when adopted.
- Archetype Capabilities on the parent usually document the pattern without creating business inboxes.
- Commissioned Capabilities on a child own paths such as `Inbox/Emails/` (on a commissioned instance).

Do not `mkdir` for Capability-owned paths during unrelated tasks.

## Registry Tier Column

Tag every row in [Docs/Capabilities/README.md](../Capabilities/README.md):

| Tier value | Use when |
| --- | --- |
| `Universal` | Any capable repo should have this (ChatToMarkdown, Indexing, LocalAgentToolSetup) |
| `Archetype` | Get Established web-presence offer (reviews, discovery, product ContentReview) |
| `Commissioned` | Only on a commissioned child (document on parent as N/A or "child only") |
| `N/A` | Deprecated, meta, or workflow launcher not a Capability |

**Indexing on GEOTW:** May remain metadata-profile-only until a Capability folder exists; a commissioned instance's **Indexing** is the envelope implementation reference.

On **GetEstablishedOnTheWeb**, commissioned-tier rows appear only in the gap matrix or parent notes pointing at a commissioned instance — not as Active Capabilities on the parent. **ContentReview** stays **Archetype** on both repos when a commissioned instance diverges; tag divergence in Rules, not as Commissioned tier.

## Commissioning Flow (Summary)

1. Start from Get Established archetype (copy or fork template per [TemplateGuidance.md](../Setup/TemplateGuidance.md)).
2. Customize identity, `Owner/`, and business or personal content areas.
3. Add **commissioned** Capabilities and `Structure.md` / `SetupPrompt.md` as needed.
4. Run Setup when folders must exist; do not pre-create empty intake trees.
5. Declare **ParentCapability** and **Divergence from parent** when adapting archetype modules.

## Agent Rules

1. Read **Tier** in the registry before copying a Capability from a commissioned instance to GEOTW or vice versa.
2. Do not expect EmailIntake on the parent template.
3. Do not treat missing universal Capabilities on GEOTW (prompt-only) as "the commissioned instance wins" — check tier and migration status in the gap matrix.
4. For cross-archetype work (book vs web), do not reuse Get Established website paths without an explicit archetype decision.

## Related Standards

- [RepositoryCoreStandard.md](RepositoryCoreStandard.md) — packaging, registry, provisioned structure
