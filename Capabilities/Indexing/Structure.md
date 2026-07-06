<!--
IndexTitle: Indexing Structure
IndexDescription: Indexes folder spec for Indexing Capability Setup on clean-root repos.
IndexType: Capability
CapabilityName: Indexing
CapabilityVersion: 2
LastEdited: 2026-06-06
-->

# Indexing Structure

## Paths Setup May Create

```text
Indexes/README.md
Indexes/ChatMarkdownIndex.md
Indexes/FollowThroughIndex.md
```

Optional when inbox capabilities exist (commissioned envelope):

```text
Indexes/InboxFileIndex.md
```

## ChatMarkdownIndex Columns

| Column | Guidance |
| --- | --- |
| Topic | Plain-language subject |
| Status | From source metadata or inferred |
| Important Decisions | Settled choices |
| Followthrough Needed | Next work |
| Suggested Destination | Future home after migration |
| Ready For Website | No, Partial, or N/A — owner judgment |

## FollowThroughIndex Columns

| Column | Guidance |
| --- | --- |
| Item | Actionable task or question |
| Source File | Path to source markdown |
| Category | Website, Operations, Workflow, etc. |
| Priority | High, Medium, Low |
| Owner | Usually Owner until assigned |
| Status | Open, In Review, Blocked, Done, Deferred |
| Next Action | One clear next step |

## Profile Notes

| Profile | Index source folders |
| --- | --- |
| archetypeHost (GetEstablished clean root) | `Plans/`, `Content/Website/Pages/`, `Workspace/` (pointers), optional Capability registry rows |
| commissionedWebPresence | `Planning/`, `PossibleWebPages/` (US1 reference) |
| legacy envelope | `Docs/Project/`, `Owner/` — historical only; do not use on clean root |

## Health Check Domains

Before refresh, [IndexHealthCheck.md](IndexHealthCheck.md) validates metadata,
README coverage, stale plans, broken links, and source-of-truth alignment per
[IndexHealthStandard.md](../../Standards/IndexHealthStandard.md).

## Related

- [SetupPrompt.md](SetupPrompt.md)
- [Rules.md](Rules.md)
