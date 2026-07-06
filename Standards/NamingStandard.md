<!--
IndexTitle: Naming Standard
IndexDescription: Naming guidance for repository files, folders, roles, and agent workflow terminology.
IndexType: Standard
IndexStatus: Draft
LastEdited: 2026-06-08
-->

# Naming Standard

Use this standard when naming new files, folders, sections, workflow roles, and future generated indexes.

Do not rename existing files in this pass. Existing names may remain until a future task explicitly asks for a controlled rename.

## General Rules

- Keep names short, role-clear, and stable.
- Prefer plain words over internal shorthand.
- Use predictable folder names.
- Avoid stacked prefixes.
- Avoid names that only make sense inside one chat session.
- Use the same term for the same concept across docs.
- Preserve existing file names unless a rename is explicitly requested.

## Agent Terminology

Use **Agent** for general agent workflow.

Use explicit product names only when specifically referring to:

- A specific product, app, or permission model.
- A product-specific prompt that truly depends on that tool.
- A documented product-specific behavior or permission flow.
- A historical note where the specific tool still materially matters.

Use role labels when the workflow applies across tools:

- Worker agent.
- Planning agent.
- Review agent.
- Future agent.

Use **worker agent** as the preferred short term for implementation-agent-style local repository work. Use **worker** only after the role is already clear.

Use **planning agent** for planning and review conversations. Use **planner** only after the role is already clear.

Avoid **builder agent** as a preferred role term because "build" can be confused with website build work, deployment work, or generated build output.

Use **planner/worker workflow** or **access-aware planner/worker workflow** for the active repository collaboration model.

Avoid **Cloud-To-Local** as a primary workflow label. It is deprecated because planner access varies by session; a planner may have GitHub connector access, local filesystem access, uploaded files, pasted files, a worker handoff, or no reliable repository access.

## Core Planning Terms

Use these as formal repository terms with different weights. The
[GoalsIdeasPlansCapabilitiesModel.md](../Plans/GoalsIdeasPlansCapabilitiesModel.md)
model and the linked source files are the definitions; this standard only fixes
the names.

- **Goals** — umbrella term for what matters. Split into **Repository Goals**
  (core durable set) and **Owner Goals** (owner's practical outcomes).
- **Repository Goals** — core north-star outcomes for the learning repository.
  Source of truth: `Plans/RepositoryGoals.md`.
- **Owner Goals** — three to five practical outcomes the owner wants from setup.
  Captured during **Quick Startup** (`Capabilities/GettingStarted/`); durable
  home: `Workspace/OwnerGoals.md`; refined as the owner works.
- **Idea** — one tracked possibility not yet committed to a Plan. Register:
  `Plans/Ideas.md` (one row per Idea).
- **Ideas** — the collective register and folder layer for possibilities.
  Register: `Plans/Ideas.md`. Folder: `Ideas/`. Raw parking lot:
  `Ideas/FutureIdeas.md`.
- **Plans** — structured approaches that move selected Ideas toward Owner Goals
  and Repository Goals. Home: `Plans/`.
- **Capabilities** — reusable, registry-routable units of operational
  knowledge. Home: `Capabilities/<CapabilityName>/`.
- **Skills** — optional executable packages owned by Capabilities. Home:
  `Capabilities/<CapabilityName>/Skills/<SkillName>/`; registry:
  `Capabilities/SkillRegistry.md`.

Formal chain: **Goals** → **Ideas** → **Plans** → **Capabilities** (→ **Skills**
when executable). Use **Repository Goals** when referring to the north-star
file; **Owner Goals** for Quick Startup outcomes; **Idea** / **Ideas** / **Plans**
as above.

Keep Goals, Ideas, Plans, Capabilities, and Skills **indexed for agent
efficiency**: search maps (`Plans/RepositorySearchMap.md`), Capability registries,
metadata frontmatter, and `Indexes/` when provisioned through the Indexing
Capability.

## Skill Naming

Use **Skill** for an executable package with a `SKILL.md` file. Do not use
Skill as a synonym for Capability, Plan, prompt, helper, or automation idea.

Skill folder names should use PascalCase, such as `IndexRefresh`.

Runtime-facing `name` fields inside `SKILL.md` front matter may use lowercase
kebab-case when a runtime expects it, such as `index-refresh`.

Do not create a top-level `Skills/` folder or runtime-specific Skill folder as
a naming convenience. Canonical Skill names live under their owning Capability
until a runtime adapter is explicitly adopted.

## File Naming

Prefer names that describe the file's role:

- `RepositoryMap.md`
- `AgentTaskBacklog.md`
- `OpenQuestions.md`
- `RepositoryHousekeeping.md`
- `RepositoryOrganizationPlan.md`

Avoid stacked prefixes such as:

- `AgentWorkflowReviewPlan.md`
- `ProjectRepositoryPlanningReviewNotes.md`

If a name needs more than three or four concepts, the file may need a clearer role or a better folder.

### Generated Chat Filenames

When converting chat exports to markdown, transform export labels into durable
repository filenames before saving. Follow
[ChatToMarkdown Rules](../Capabilities/ChatToMarkdown/Rules.md). The planning
trail is in
[ChatToMarkdownFilenameHarmonizationReview.md](../Project/ChatToMarkdownFilenameHarmonizationReview.md).

Use:

```text
<SpecificSubject><OptionalQualifier><DocumentRole>.md
```

Reject generic export names such as `Chat.md`, `Conversation.md`,
`Export.md`, `Transcript.md`, `Untitled.md`, `Workflow.md`, `Notes.md`, and
date-only names.

Prefer concise PascalCase names such as:

- `OneDrivePhoneWorkflow.md`
- `GitHubWorkflowTroubleshooting.md`
- `CloudInboxCapabilityPlan.md`

Existing files should not be renamed during ordinary ChatToMarkdown
conversion. Proposed renames still follow the Rename Rule below.

## Folder Naming

Use folder names that describe durable repository roles:

- `Docs/Project`
- `Docs/Plans`
- `Docs/Reviews`
- `Docs/Workflows`
- `Docs/Maintenance`
- `Docs/Standards`
- `Content`

Do not create empty future folders just to reserve names. Create a folder when there is an immediate file and a clear purpose.

## Prompt Naming

Prompt file names should stay stable because they may be referenced by workflow docs and handoff prompts.

Use a product name in a prompt file only when the prompt is specifically for that product or permission context.

For new general prompts, prefer names that describe the task:

- `ContentReviewPrompt.md`
- `BusinessPlanDiscoveryPrompt.md`
- `OnePageWebsiteDraftPrompt.md`

## Environment-Adaptive Model (Harmonization Terminology)

Use these formal terms in new prose. Deprecated brainstorm aliases are for
legacy search and link stability only.

Source plan:
[CloudOnlyPlanningAndMeasurementDevicePlan.md](../Plans/CloudOnlyPlanningAndMeasurementDevicePlan.md)
§Terminology.

### Layer 1 — Repository principles

| Avoid (deprecated) | Prefer (formal) | Use when |
| --- | --- | --- |
| Cloud First | **Environment-adaptive** | North star: repo adapts to user device and comfort |
| Cloud-first repository | **GitHub-primary collaboration** | SoT story: GitHub is universal surface; local clone optional |
| Device independence | **Device-appropriate paths** | Instruction policy: show paths that match the device |

### Layer 2 — Operating profiles

| Avoid (deprecated) | Prefer (formal) | Use when |
| --- | --- | --- |
| Operating modes | **Operating profiles** | Routing user's environment to workflow |
| Cloud Only | **Remote-only** | No local agent on current device |
| Cloud First With Local Later | **GitHub-then-local** | Start without local clone; adopt local later |
| Hybrid Cloud And Local | **Dual-surface** | Local clone and GitHub from early on |
| Local Power User | **Local-primary** | Local Git + local agents (host default) |
| Cloud agent | **Hosted agent** | Agent implementing via GitHub PRs without local workstation |

Do not rename harmonization filenames (for example `CloudOnlyDeviceWorkflow.md`)
unless a task explicitly requests a controlled rename pass.

## Rename Rule

Agents must not rename existing files unless the task explicitly asks for renames.

If a name seems unclear, log the concern in `Docs/Maintenance/RepositoryHousekeeping.md` under `Proposed Renames`.

## Link Safety

Before any future rename, identify:

- Files that link to the current name.
- Prompts that mention the current name.
- README files and maps that list the current name.
- Any future registry or generated index entries.

Update links in the same controlled pass as the rename.
