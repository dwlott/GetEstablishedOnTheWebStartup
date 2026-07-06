<!--
IndexTitle: Clean Root Migration Playbook
IndexDescription: Reusable checklist for harmonizing a commissioned or legacy repository onto the clean-root GetEstablished tree.
IndexType: Capability
CapabilityName: CapabilityHarmonize
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-06-19
-->

# Clean Root Migration Playbook

Use this playbook when a repository should visually and operationally match the
clean GetEstablished root shape:

```text
Capabilities/
Plans/
Standards/
Workspace/
Content/
Ideas/
Indexes/
Automation/
Archive/
AGENTS.md
README.md
.gitignore
```

This is a structural harmonization workflow. It does not authorize rewriting
customer-facing claims, deleting source material, or erasing commissioned
Capabilities.

## When To Use

- A commissioned or legacy repo still uses older roots such as `Docs/`,
  `Owner/`, `Planning/`, or `PossibleWebPages/`.
- Agents need fewer repo-specific boot instructions and path translations.
- A repo is a compatibility test for future starter/template exports.
- A repository already has valuable content that must be preserved while the
  tree converges on the clean-root standard.

## Preflight

1. Confirm the repo root and branch.
2. Confirm a clean git status before moving files.
3. Inventory current roots and whether each holds active instructions, source
   material, reviewed content, owner working files, indexes, intake, or archive.
4. Identify commissioned Capabilities and business-specific content that must
   stay owned by the child repo.
5. Define the migration map before moving anything.

## Default Migration Map

| Legacy path | Clean-root path | Rule |
| --- | --- | --- |
| `Docs/Capabilities/` | `Capabilities/` | Active workflow modules route from root |
| `Docs/Project/` | `Plans/` | Plans, reports, backlog, setup notes, and maps |
| `Docs/Standards/` | `Standards/` | Durable standards live at root |
| `Docs/Setup/` | `Plans/Setup/` | Setup/reference docs are project planning material |
| `Docs/Operations/` | `Workspace/Operations/` | Internal operations are owner working material |
| `Docs/Prompts/` | `Archive/LegacyPrompts/` | Active prompts belong in Capabilities |
| `Owner/` | `Workspace/` | Clean root replaces old owner folder names |
| `Planning/` | `Plans/SourcePlanning/` | Preserve source planning history |
| `PossibleWebPages/` | `Content/Website/Candidates/` | Candidate pages are content source |
| `Inbox/` | `Inbox/` | Keep capability-provisioned intake unless a standard changes |
| `Indexes/` | `Indexes/` | Keep and refresh path references |

Adjust only when the repo has a clear, documented profile reason.

## Controlled Move

1. Use history-preserving moves (`git mv` style).
2. Move roots first, then flatten accidental nested paths.
3. Add short README files for newly materialized clean-root folders such as
   `Ideas/` and `Archive/` when missing.
4. Do not move capability-provisioned intake folders during unrelated tree work.
5. Do not rewrite customer-facing content while moving it; path metadata updates
   are acceptable when needed for indexes and source references.

## Reference Refresh

After moving files, update active instructions in this order:

1. `AGENTS.md` boot order.
2. `README.md` repository shape.
3. `Plans/RepositorySearchMap.md` as the canonical search map.
4. `Capabilities/RouterIndex.md`.
5. `Capabilities/AgentCapabilityGuide.md`.
6. `Capabilities/README.md`.
7. Index files such as `Indexes/ChatMarkdownIndex.md`,
   `Indexes/FollowThroughIndex.md`, and `Indexes/InboxFileIndex.md`.
8. Active Capability links and path examples.

Remove temporary compatibility-bridge language once the tree has migrated. The
goal is clean-root truth, not permanent legacy translation.

## Smoke Tests

Run a routing smoke test before calling the migration complete:

| Intent | Expected clean-root route |
| --- | --- |
| Content review | `Capabilities/ContentReview/` |
| Chat-to-markdown | `Capabilities/ChatToMarkdown/` |
| Email or scan intake | Intake Capability plus `Inbox/` and `Indexes/InboxFileIndex.md` |
| Capability import | `Capabilities/ImportCapabilitiesFromRepository/` |
| Capability harmonize | `Capabilities/CapabilityHarmonize/` |
| Owner preferences | `Workspace/OwnerPreferences.md` or owning import Capability |
| Boot path | `AGENTS.md` -> SituationalAwareness -> `Plans/RepositorySearchMap.md` -> RouterIndex |

Also verify:

- no active instruction still boots from legacy roots;
- old root folders no longer exist in the working tree unless intentionally
  retained and documented;
- source content was moved or path-metadata refreshed only;
- customer-facing claims were not rewritten.

## Report Shape

Create a short report in `Plans/` with:

1. pass date, repo, and pass type;
2. migration map;
3. preserved boundaries;
4. verification targets;
5. smoke-test results;
6. follow-up notes.

Reference case study: US1Movers `Plans/US1CleanRootMigrationReport.md`.

## Lessons From US1Movers

- A bridge-only compatibility pass reduces immediate risk but leaves friction for
  future agents. Full tree parity removes most path translation.
- Move first, then rewrite references. Trying to keep both old and new roots in
  active instructions creates confusing hybrid guidance.
- Historical reports can keep old paths as historical record; active boot,
  routing, index, and Capability files should speak clean-root only.
- Search results need interpretation: old path hits in migration reports are
  expected, but old path hits in active instructions are defects.
- Do not treat commissioned differences as structural differences. Commissioned
  business content can live under the same clean roots as reusable repositories.
