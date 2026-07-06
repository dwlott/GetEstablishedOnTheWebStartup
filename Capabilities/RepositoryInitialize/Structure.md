<!--
IndexTitle: RepositoryInitialize Structure
IndexDescription: Core shell paths RepositoryInitialize may create per profile.
IndexType: Capability
CapabilityName: RepositoryInitialize
CapabilityVersion: 1
LastEdited: 2026-05-28
-->

# RepositoryInitialize Structure

Paths below are **init-owned**. Capability-owned paths (Inbox, Indexes, etc.) are not listed here.

## All Profiles (Core Shell)

```text
AGENTS.md
README.md
.gitignore
Docs/Capabilities/README.md
Docs/Capabilities/AgentCapabilityGuide.md
Docs/Standards/README.md
Docs/Standards/NamingStandard.md          <- copy from GEOTW or link note
Docs/Standards/MarkdownIndexMetadataStandard.md
Docs/Standards/RepositoryCoreStandard.md
Docs/Standards/RepositoryArchetypeAndCapabilityTiers.md
Docs/Standards/CapabilityProvisionedStructure.md
Docs/Project/RepositoryMap.md
Docs/Project/OpenQuestions.md
Docs/Setup/README.md
```

On **child or meta** profiles also create:

```text
Docs/Setup/ParentWorkflowLink.md
```

## Profile: archetypeHost

Additional optional (create README only when useful):

```text
Docs/Prompts/README.md                    <- stub pointing to Capabilities migration
Content/Website/Pages/README.md           <- scaffold note only
Owner/README.md
Docs/Project/RepositoryMap.md           <- GEOTW-specific map content
```

Active Capability folders to copy from template (GEOTW self):

- `Docs/Capabilities/ChatToMarkdown/`
- `Docs/Capabilities/LocalAgentToolSetup/`
- `Docs/Capabilities/ContentReview/`
- `Docs/Capabilities/RepositoryInitialize/`
- `Docs/Capabilities/Indexing/` (Planned template with Structure + SetupPrompt)

## Profile: commissionedWebPresence

Additional:

```text
Owner/README.md
Content/Website/Pages/README.md
Planning/README.md                        <- source archive pointer only
PossibleWebPages/README.md
```

Registry includes commissioned **Planned** rows (EmailIntake, ScanIntake, TaxPlanningQuestions) with US1 reference paths — **no** Inbox mkdir.

Copy Active universal capabilities from GEOTW; add Indexing as Planned with US1 reference for envelope Rules.

## Profile: agenticMeta

Additional (meta orchestration layer):

```text
Docs/Workflows/README.md
Docs/Decisions/README.md
Prompts/README.md
Prompts/Codex/README.md
Prompts/ChatGPT/README.md
Reports/README.md
Reports/Codex/README.md
Reports/Reviews/README.md
Automation/README.md
```

Do **not** create `Content/Website/Pages/` unless owner requests web-presence scope change.

Copy Active: ChatToMarkdown, LocalAgentToolSetup, RepositoryInitialize (stub or local), Indexing Planned.

See Agentic `Docs/Project/RepositoryArchetypeDecision.md` for hybrid rationale.

## Profile: codeRepo

Minimal shell:

```text
Docs/Plans/README.md
Automation/README.md
Indexes/README.md                         <- pointer to generated indexes profile
```

No `Docs/Capabilities/` web-presence modules except optional LocalAgentToolSetup. Point to RepositoryCoreStandard code profile.

## Not In Any Init Pass

```text
Inbox/
Indexes/                                  <- Indexing Setup only
.env
credentials/
```
