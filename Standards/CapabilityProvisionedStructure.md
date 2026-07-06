<!--
IndexTitle: Capability-Provisioned Structure
IndexDescription: How Capabilities define and create repository folders through Setup prompts (parent-generic).
IndexType: Standard
IndexStatus: Active
LastEdited: 2026-05-28
-->

# Capability-Provisioned Structure

## Principle

**Repository folders appear when a Capability provisions them**, not when an agent improvises during an unrelated task.

| Layer | Role |
| --- | --- |
| **Capability** | Owns a workflow and the paths it needs |
| **Structure.md** | Markdown spec inside the Capability folder (folders, README text, index hooks) |
| **SetupPrompt.md** | Copy-ready worker pass the owner runs once to create that structure |
| **Prompt.md** | Day-to-day operation assuming structure exists, or offering Setup |

Adding a new Capability should answer: **what folders does this Capability create, and what is the Setup prompt?**

Author new Capabilities with **CapabilityCreate** ([Prompt.md](../Capabilities/CapabilityCreate/Prompt.md)): `Structure.md` paths are **suggestions** adapted after repository placement analysis — not a default mkdir list for every integration.

## Rules For Agents

1. Do not `mkdir` for Capability-owned paths unless running that Capability's **SetupPrompt.md** in the current session (or the user explicitly says "run setup" for that Capability).
2. If structure is missing:
   - **Action only** (for example "save this chat") — offer Setup in one sentence; do not mkdir.
   - **Action + setup** (for example "set up email intake") — run **SetupPrompt.md** without extra questionnaire.
3. After Setup or intake passes that add files, run **Indexing** or update index files per Capability instructions.
4. Do not store credentials (`.env`, API keys) in the repository.

## Parent Versus Commissioned

| Repository role | Provisioned paths |
| --- | --- |
| **Archetype host** (GetEstablishedOnTheWeb) | Document pattern; Indexing Setup when adopted; no business inboxes unless a future approved Capability needs them |
| **Commissioned child** (for example US1Movers) | EmailIntake, ScanIntake, and other commissioned `Structure.md` specs |
| **New repo via RepositoryInitialize** | Core shell only; Capability paths via each Capability's Setup |

Commissioned reference implementations: US1Movers `Docs/Capabilities/EmailIntake/`, `ScanIntake/`.

## Lazy Init Routing

| User says | Agent behavior |
| --- | --- |
| Operate action only | Route to Capability **Prompt.md**; if paths missing, offer Setup once |
| Operate + setup | Run **SetupPrompt.md** for that Capability |
| Initialize / bootstrap this repo | **RepositoryInitialize** ([Prompt.md](../Capabilities/RepositoryInitialize/Prompt.md)) |
| Create / spawn a new repository | **GitHubWorkflow** then **RepositoryInitialize** on the new clone |

## Indexing Profile

When **Indexing** provisions `Indexes/`, use [Indexing/Structure.md](../Capabilities/Indexing/Structure.md) on this repository or the envelope reference on US1Movers.

## Related

- [RepositoryCoreStandard.md](RepositoryCoreStandard.md)
- [RepositoryArchetypeAndCapabilityTiers.md](RepositoryArchetypeAndCapabilityTiers.md)
- [AgentCapabilityGuide.md](../Capabilities/AgentCapabilityGuide.md)
- US1 detail: US1Movers `Docs/Standards/CapabilityProvisionedStructure.md`
