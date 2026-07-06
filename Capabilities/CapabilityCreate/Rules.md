<!--
IndexTitle: CapabilityCreate Rules
IndexDescription: Tier choice, placement analysis, and guardrails for authoring new Capabilities without folder sprawl.
IndexType: Capability
CapabilityName: CapabilityCreate
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-05
-->

# CapabilityCreate Rules

Read before running [Prompt.md](Prompt.md). Canonical placement and tier rules for **authoring** Capabilities on any repository in the Get Established family.

New Capabilities must follow [CapabilityMetadataStandard.md](../../Standards/CapabilityMetadataStandard.md) and start from [CapabilityModuleTemplate.md](CapabilityModuleTemplate.md).

## Learned constraints

- **Never treat Structure.md as a mkdir checklist.** Adapt or shrink proposed paths; omit `SetupPrompt.md` when the Capability only edits existing trees or external systems.
- **Do not put integration artifacts in `Owner/`** unless the Capability is explicitly about owner decisions (use `Owner/OpenQuestions/` or `Owner/Notes/` for questions, not for Dropbox sync folders or API notes).
- **Do not store credentials** in the repository (`.env`, tokens, OAuth secrets). Document external setup in Rules or a vendor pointer sheet.
- **One Capability per worker pass** unless the user approves a batch.
- **Commissioned-only intake** (email, scan, tax) belongs on commissioned envelopes — tag Tier **Commissioned** and reference US1 patterns; do not provision US1 paths on the archetype host unless the owner explicitly adopts them on GEOTW.

## When to run

| Situation | Action |
| --- | --- |
| User says create / turn into / add a Capability | Run **CapabilityCreate** |
| User only wants a one-off script or doc | Use normal edit; do not author a Capability unless asked |
| User wants to migrate `Docs/Prompts/` to a folder | Run **CapabilityCreate** with `migrationFromPrompt` noted in README |
| Missing registry row for an existing folder | Fix registry and guide only; do not duplicate Capability |

## Proactive offer (agents)

Offer **CapabilityCreate** in one short sentence when **all** apply:

1. The session produced a **repeatable** workflow (not a single typo fix).
2. The work would otherwise leave **ad-hoc** files or paths (for example a new folder under `Owner/` or random `Automation/` notes without a module).
3. The user has not already declined formalizing it.

**Example offer:** "This Dropbox hookup looks reusable — want me to turn it into a Capability so the next agent routes to it?"

Do not nag. Offer once per thread unless the user revisits the topic.

## Tier selection

| Tier | Choose when | Examples |
| --- | --- | --- |
| **Universal** | Any capable repo should reuse the workflow; paths may differ by profile | ChatToMarkdown, Indexing, LocalAgentToolSetup, **CapabilityCreate** |
| **Archetype** | Tied to Get Established web-presence product | ContentReview, publishing reviews, website discovery |
| **Commissioned** | One owner or business envelope only | EmailIntake, ScanIntake, mover-specific rules |
| **N/A** | Meta or repo-lifecycle, not a day-to-day owner workflow | CapabilityHarmonize (future) |

When unsure between Universal and Archetype, prefer **Universal** if a Write a Book or code repo could reuse the *idea* with different folders.

## Placement analysis (required before Structure.md)

Before proposing provisioned paths, read in order:

1. Root `AGENTS.md` and repository shape section.
2. `Docs/Project/RepositoryMap.md` (or child equivalent).
3. `Docs/Capabilities/README.md` — avoid duplicate Capabilities.
4. `Docs/Standards/CapabilityProvisionedStructure.md`.
5. For commissioned repos: `Owner/` README if present; do not relocate owner content.

Record placement decisions in the new Capability `README.md` **Inputs/Outputs** or a short **Placement** subsection in `Rules.md`.

## Repository-write context

When a CapabilityCreate pass is asked to "write", "save", or "add" files,
verify the repository before writing. Use the explicitly named repository; if
none is named, infer from active session context, verify the repository exists,
verify write permission and branch, then read `AGENTS.md` before choosing paths.
If more than one repository is plausible, ask one concise clarification.

If direct repository write access is unavailable, provide a download or
copy-ready block and clearly state that repository write access was unavailable.

### Placement matrix (adapt, do not copy blindly)

| Work type | Prefer | Usually avoid |
| --- | --- | --- |
| Cloud files (Dropbox, Drive, OneDrive) | `Automation/` scripts or documented steps; `Docs/Project/` integration note; commissioned `Inbox/` only if true **intake** | `Owner/`, `Content/Website/Pages/` |
| Email / scan intake | Commissioned `Inbox/<Channel>/` per US1 Structure specs | GEOTW parent unless owner adopts |
| Website page draft | `Content/Website/Pages/` | `Docs/Capabilities/` body text |
| Internal planning | `Docs/Project/` (GEOTW) or `Planning/` (US1 envelope) | Capability Prompt fenced blocks |
| Owner decision | `Owner/OpenQuestions.md` | New Capability folder under `Owner/` |
| Agent tool install | **LocalAgentToolSetup** vendor sheet | New duplicate Capability |
| Index / inventory | **Indexing** `Indexes/` via Setup | Scatter index files in repo root |
| Secrets / API keys | External store; pointer doc only | Any committed path |

### Unsupported cloud or vendor (example: Dropbox)

1. Confirm no existing Capability (search registry and `AgentCapabilityGuide`).
2. Name in **PascalCase** (for example `DropboxLink` or `CloudStorageDropbox` — one clear name).
3. Default **Tier:** Universal if pattern applies to many repos; **Commissioned** if only this business uses it.
4. **Operate** workflow: document connect steps, folder naming, and triage — not live sync secrets.
5. **Provisioned paths:** only if the owner needs a drop zone; prefer shared `Inbox/` patterns on commissioned repos; on GEOTW prefer `Automation/` + README unless intake is approved.
6. Add **OpenQuestions** row if vendor approval or legal retention is unsettled.

## Capability module files (authoring checklist)

| File | Required when |
| --- | --- |
| `README.md` | Always — version, purpose, inputs, outputs, WhenToUse, changelog |
| `Prompt.md` | Active — one fenced `text` block |
| `Rules.md` | Durable constraints, folder maps, learned constraints |
| `Structure.md` | Capability may provision paths — **label as suggestions** |
| `SetupPrompt.md` | Only when Structure lists paths Setup may create |
| `Examples.md` | Optional — one scenario (for example cloud connect) |

## Registry and routing updates

After creating files:

1. Add row to `Docs/Capabilities/README.md` with correct **Tier**, **Status**, **Entry**.
2. Add intent row to `Docs/Capabilities/AgentCapabilityGuide.md`.
3. Add row to root `AGENTS.md` Capability Discovery table when **Active**.
4. On commissioned child: append **Capability Changelog** per US1 `CapabilityStandard.md` if that repo maintains it.
5. Update [CrossRepoCapabilityGapMatrix.md](../../Project/CrossRepoCapabilityGapMatrix.md) only when user asked for cross-repo tracking or harmonize pass.

## Related

- [Structure.md](Structure.md) — starter kit
- [CapabilityProvisionedStructure.md](../../Standards/CapabilityProvisionedStructure.md)
- US1 reference: `Docs/Standards/CapabilityStandard.md`
