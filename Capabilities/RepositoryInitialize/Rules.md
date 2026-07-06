<!--
IndexTitle: RepositoryInitialize Rules
IndexDescription: Profile matrix and mkdir boundaries for repository initialization.
IndexType: Capability
CapabilityName: RepositoryInitialize
CapabilityVersion: 1
LastEdited: 2026-05-28
-->

# RepositoryInitialize Rules

Read [Docs/Standards/CapabilityProvisionedStructure.md](../../Standards/CapabilityProvisionedStructure.md) before editing.

## What Init May Create

Only paths listed in [Structure.md](Structure.md) for the selected profile. Typically:

- Root: `AGENTS.md`, `README.md`, `.gitignore`
- `Docs/Capabilities/` registry + `AgentCapabilityGuide.md`
- `Docs/Standards/` README and copies or links of family standards
- `Docs/Project/RepositoryMap.md`, light `OpenQuestions.md`
- `Docs/Setup/` README; `ParentWorkflowLink.md` when profile is child or meta with parent GEOTW

## What Init Must NOT Create

Defer to Capability **SetupPrompt.md**:

- `Inbox/**`
- `Indexes/**` (unless owner also requests Indexing Setup in same session)
- `Planning/`, `PossibleWebPages/` (commissioned source archives)
- `Content/Website/Pages/` body tree (empty scaffold README only if profile allows)
- Commissioned intake paths

## Profile Matrix

| Item | archetypeHost | commissionedWebPresence | agenticMeta | codeRepo |
| --- | --- | --- | --- | --- |
| ParentWorkflowLink | No | Yes → GEOTW | Yes → GEOTW | Optional |
| Commissioned registry rows | Reference only | Planned stubs | Reference only | No |
| Copy Active universal Caps | From GEOTW parent template | From GEOTW + envelope Indexing pattern | From GEOTW | No |
| Meta folders (`Prompts/`, `Reports/`) | No | No | Yes per Structure | No |
| `Content/Website/Pages/` | Optional README | Scaffold README | No | No |
| `Owner/` | Optional README | Yes README | Optional README | No |

## Full Catalog On Day One

Init must populate `Docs/Capabilities/README.md` with:

- **Active** rows for copied modules (ChatToMarkdown, LocalAgentToolSetup, CapabilityCreate, ContentReview on archetype host; adjust per profile).
- **Planned** rows for Indexing, ChatMemoryCapture, review prompts, commissioned modules (reference a commissioned instance), CapabilityHarmonize.
- **RepositoryInitialize** Active on GEOTW; Planned stubs on children pointing to parent or local copy.

Do not create disk folders for Planned capabilities.

## AGENTS.md Template

Init writes AGENTS.md using the family template:

- Repository role and parent repository lines filled from profile
- Capability Discovery table (Active + Setup offer rule for provisioned capabilities)
- Provisioned-structure inbox rule (from CapabilityProvisionedStructure)
- Worker/planner handoff (72-character line guidance in fenced blocks)

## After Init

- Offer **Indexing Setup** only if profile uses `Indexes/` (envelope or agenticMeta with indexes).
- Offer commissioned **Setup** only when owner opts in during spawn or init session.
