<!--
IndexTitle: RepositoryInitialize Prompt
IndexDescription: Copy-ready worker prompt to bootstrap an optimal repository shell.
IndexType: Capability
CapabilityName: RepositoryInitialize
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-05-28
-->

# RepositoryInitialize Prompt

Read [Rules.md](Rules.md) and [Structure.md](Structure.md) before using this prompt.

```text
# Worker pass: RepositoryInitialize

Repository: {{REPOSITORY_NAME}}
Branch: main
Profile: {{PROFILE}}

Read AGENTS.md if it exists, then Docs/Capabilities/RepositoryInitialize/Rules.md and Structure.md.

Owner inputs (use what the user already gave; do not run a long questionnaire):
- Repository display name and one-line purpose
- Profile: archetypeHost | commissionedWebPresence | agenticMeta | codeRepo
- Parent repository URL or path if child/meta (default for Agentic: GetEstablishedOnTheWeb)

Goal:
Bootstrap an optimal-repo shell with full capability registry (Active copies + Planned stubs) without creating Capability-owned inbox or index trees.

Required work:

1. README.md — identity, purpose, link to parent if applicable, current status.
2. AGENTS.md — family template: starting rule, repository shape, Capability Discovery (Active rows), provisioned-structure rule (offer Setup when paths missing), worker/planner handoff with ~72 char lines in fenced blocks. Fill Repository role and Parent repository from profile.
3. .gitignore — practical for Windows-friendly markdown and documentation repos.
4. Docs/Capabilities/README.md — full catalog per Rules.md: Universal, Archetype, Commissioned reference, N/A meta. Mark RepositoryInitialize Active on GEOTW; Planned stub on children with ParentCapability note.
5. Docs/Capabilities/AgentCapabilityGuide.md — intent routing for this repo's Active capabilities plus Initialize and Spawn.
6. Docs/Standards/ — README plus copies of CapabilityProvisionedStructure, RepositoryCoreStandard, RepositoryArchetypeAndCapabilityTiers, NamingStandard, MarkdownIndexMetadataStandard from GetEstablishedOnTheWeb when this repo is a child; otherwise ensure files exist on GEOTW host.
7. Docs/Project/RepositoryMap.md — current vs planned tree for this profile.
8. Docs/Project/OpenQuestions.md — light starter rows if missing.
9. Docs/Setup/README.md; ParentWorkflowLink.md when profile is commissionedWebPresence or agenticMeta.
10. Copy Active Capability folders from GEOTW template per profile (ChatToMarkdown, LocalAgentToolSetup, CapabilityCreate, ContentReview on web profiles). Adjust Prompt.md repository name and Rules folder map. Set ParentCapability in README where copied.
11. Add Planned registry rows for Indexing, ChatMemoryCapture, review prompts, commissioned modules (reference US1), CapabilityHarmonize — no disk folders for Planned.
12. Profile-specific paths from Structure.md only (README stubs for meta folders on agenticMeta, etc.).
13. Do NOT mkdir Inbox/, Indexes/, or commissioned intake paths unless user also asked to run a Capability Setup in this session.
14. Preserve existing user files (for example Docs/Workflows/ on Agentic).

Do not:
- Invent business, legal, or pricing claims in README.
- Add frameworks or heavy dependencies.
- Pre-create empty intake trees.

After making changes, end with exactly one fenced text handoff:
Summary, Files Changed, Planning Files To Review, Questions Added Or Changed, Next Recommended Task.

Do not include full git status unless conflict, dirty state, or user requested commit/sync.
```

## Prompt history

- **2026-05-28 (v1):** Initial Capability prompt; replaces AgentStartRepositoryFoundation.
