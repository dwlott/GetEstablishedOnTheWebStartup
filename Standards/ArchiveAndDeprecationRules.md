<!--
IndexTitle: Archive And Deprecation Rules
IndexDescription: When to supersede, redirect, archive, or delete repository files after promotion.
IndexType: Standard
IndexStatus: Active
LastEdited: 2026-06-06
-->

# Archive And Deprecation Rules

Use after promotion, plan completion, or when guidance is replaced. Pair with
[PromotionChecklist.md](PromotionChecklist.md).

## Principles

1. **Repository-first memory** — knowledge moves to durable homes, not chat alone.
2. **No silent deletion** — delete only when content is duplicated elsewhere or owner explicitly approves removal.
3. **Redirects beat broken links** — superseded active files get a short pointer stub when still linked from navigation.

## Status Labels

| Label | Meaning | Typical location |
| --- | --- | --- |
| **Active** | Current operating guidance | Original path |
| **Draft** | In progress; not yet routable | Original path |
| **Superseded** | Replaced; pointer or archive | Stub in place or `Archive/SupersededPlans/` |
| **Deprecated** | Do not use for new work; may remain for history | README note + optional Archive move |
| **Archive** | Historical record only | `Archive/` subtree |

## Plan Files

| Situation | Action |
| --- | --- |
| Plan completed; one-time outcome done | Set `IndexStatus: Superseded`; add one-line pointer to outcome files; optionally move to `Archive/SupersededPlans/` |
| Plan promoted to Capability | Mark plan **Superseded**; link to `Capabilities/<Name>/`; move to Archive when stable |
| Plan promoted to Standard | Mark **Superseded**; link to `Standards/<Name>.md` |
| Plan abandoned | Mark **Declined** in `Plans/Ideas.md` if applicable; move to Archive or delete stub only with owner approval |
| Review-only output (`*Review.md`) | After validation, sync to `Archive/HistoricalReviews/`; leave redirect stub in `Plans/` if still linked |

## Idea Files

| Situation | Action |
| --- | --- |
| Idea became a Plan | `Plans/Ideas.md` status → **Promoted**; link to plan file |
| Idea declined | Status → **Declined**; one-line reason |
| Raw note in `FutureIdeas.md` | Leave or trim when promoted; no requirement to delete raw capture |

## Capability Files

| Situation | Action |
| --- | --- |
| Capability replaced | Set **IndexStatus: Deprecated** on README; add Successor link; do not delete until successor is Active |
| Capability merged | Document in Harmonization Metadata; archive loser to `Archive/` or mark Deprecated |
| Prompt preserved in Plans only | Keep in `Plans/` until CapabilityCreate promotion |

## Archive Subtrees

| Folder | Use |
| --- | --- |
| `Archive/SupersededPlans/` | Implemented or replaced planning tracks |
| `Archive/HistoricalReviews/` | Validation and review artifacts |
| `Archive/MigrationReports/` | Host migration history (archetype host) |
| `Archive/HistoricalReviews/` | Batch review outputs |

Consumer starter packages **exclude** host Archive trees. See
[StarterRepositoryPackage/PackageChecklist.md](../Capabilities/StarterRepositoryPackage/PackageChecklist.md).

## Redirect Stub Pattern

When an active file is superseded but still linked:

```markdown
<!--
IndexStatus: Superseded
-->

# <Original Title>

> **Superseded.** Canonical guidance: [NewPath](NewPath).
> Historical copy: [Archive/...](../Archive/...).
```

## Delete Rules (Owner Approval Required)

Delete only when:

- Exact duplicate exists in the promoted destination, **and**
- No navigation file still links to the old path, **or**
- Owner explicitly requests removal (for example packaging trim)

Never delete:

- The only copy of owner decisions
- Plans before Capability or Standard promotion is verified complete
- `Intake/` (archetype host — reference only; do not delete without owner scope)

## Agent Reply Records

Substantial passes may append summary to `Automation/AgentReplies/` when useful
for the next agent. Not required for every edit.

## Related

- [PromotionChecklist.md](PromotionChecklist.md)
- [FolderReadmeStandard.md](FolderReadmeStandard.md)
- [../Plans/PlansBatch4ArchiveReport.md](../Plans/PlansBatch4ArchiveReport.md) — historical archive pass pattern
