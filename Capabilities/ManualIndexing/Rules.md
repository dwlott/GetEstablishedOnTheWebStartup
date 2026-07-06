<!--
IndexTitle: ManualIndexing Rules
IndexDescription: Operating rules for default agent-driven indexing, plus the repetition detector, re-offer logic, and counter governing optional code-assisted indexing.
IndexType: Capability
CapabilityName: ManualIndexing
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-07
-->

# ManualIndexing Rules

Canonical operating rules for the **default** indexing mode on the GetEstablished
clean-root profile. An agent refreshes `Indexes/` on request. No scripts,
schedulers, or mirroring code run inside this Capability.

Profile: **archetypeHost**. Index format and column specs:
[../Indexing/Structure.md](../Indexing/Structure.md).

## Operating Rules

- Write **only** under `Indexes/` during a refresh.
- Read source folders only to describe them; never move, rename, delete, or
  rewrite source bodies.
- Never invent decisions; never mark Ready For Website **Yes** without owner
  review.
- If `Indexes/` is missing, offer [../Indexing/SetupPrompt.md](../Indexing/SetupPrompt.md)
  and stop. Never `mkdir Indexes/` outside Setup.
- End every refresh with one fenced `text` worker handoff per `AGENTS.md`.

## Source Folders (archetypeHost — clean root)

- `Plans/` — planning tracks, maps, backlog, registers
- `Content/Website/Pages/` — publishable page drafts
- `Workspace/` — describe owner paths; pointer only; do not relocate content
- `Capabilities/README.md` and `Capabilities/AgentCapabilityGuide.md` — routing snapshot rows

Do not index `Intake/`, `Archive/`, or commissioned-only envelope paths unless
the owner explicitly expands scope.

## Output Files

| File | Role |
| --- | --- |
| `Indexes/ChatMarkdownIndex.md` | Per-file inventory: topic, status, decisions, routing, Ready For Website |
| `Indexes/FollowThroughIndex.md` | Aggregated tasks and questions from source planning files |

Column specs: [../Indexing/Structure.md](../Indexing/Structure.md).

## Repetition Detector And Code-Assisted Re-Offer

Manual indexing is the default. The optional
[CodeAssistedIndexing](../CodeAssistedIndexing/README.md) Capability is offered
**only** when it would genuinely help and the owner has not declined. This logic
is triggered by the **repeated manual indexing** signal in
[../SituationalAwareness/Rules.md](../SituationalAwareness/Rules.md).

### Step 1 — Presence Check First

- If `Capabilities/CodeAssistedIndexing/` is **not** present in the registry
  (`Capabilities/README.md` / `AgentCapabilityGuide.md`), do **nothing** — stay
  manual silently. Agents do not know it exists, so they never offer it. This is
  the intended behavior for the shipped starter.
- Only continue when `CodeAssistedIndexing` is present.

### Step 2 — Read Owner Preferences

Read the **Indexing** section of
[../../Workspace/OwnerPreferences.md](../../Workspace/OwnerPreferences.md):

| Field | Meaning |
| --- | --- |
| `Indexing mode` | `Manual` (default) or `CodeAssisted` |
| `Code-assisted decision` | `Undecided`, `Deferred`, `Declined`, or `Adopted` |
| `Re-offer count` | How many times code-assisted indexing has been re-offered |
| `Last offered` | Date of the most recent offer |

### Step 3 — Decide Whether To Re-Offer

| Decision state | Action |
| --- | --- |
| `Declined` | **Never** offer again. Do not prompt. |
| `Adopted` / mode `CodeAssisted` | Already in use; no offer needed. |
| `Deferred` or `Undecided`, AND repeated manual indexing detected, AND `Re-offer count` < cap | Offer code-assisted indexing once. Increment `Re-offer count`; update `Last offered`. |
| `Re-offer count` >= cap | Go quiet; do not offer again until the owner raises it. |

- **Re-offer cap:** 3 (adjustable by the owner in Owner Preferences).
- "Repeated manual indexing detected" means the agent has performed (or been
  asked to perform) manual indexing multiple times for the same repository in a
  short span — the signal raised by SituationalAwareness.
- Keep the offer soft. Do **not** say "strongly recommend." Use wording like:
  *Newly created files are indexed by an agent to keep chat fast. The repository
  seems to be used more heavily now; code-assisted indexing can automate this if
  you'd like. It's okay to keep things manual.*
- Record the owner's answer in Owner Preferences with their approval. A **No**
  sets `Code-assisted decision` to `Declined`.

## Health Check (Read-Only, Shared)

Use [../Indexing/IndexHealthCheck.md](../Indexing/IndexHealthCheck.md) before a
refresh when drift is suspected. The health check writes nothing under `Indexes/`.

## Related

- [WorkflowIndex.md](WorkflowIndex.md)
- [Prompt.md](Prompt.md)
- [../Indexing/Rules.md](../Indexing/Rules.md)
- [../CodeAssistedIndexing/README.md](../CodeAssistedIndexing/README.md)
- [../SituationalAwareness/Rules.md](../SituationalAwareness/Rules.md)
