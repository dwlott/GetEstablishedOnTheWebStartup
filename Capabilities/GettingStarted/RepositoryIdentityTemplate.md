<!--
IndexTitle: Repository Identity Template
IndexDescription: Identity modes and adopted-project record used by the Startup package.
IndexType: Capability
CapabilityName: GettingStarted
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-10-10
-->

# Repository Identity Template

The product repository and canonical Startup repository retain their own
identities. Only an adopted project created from the Startup package receives
the adopted-project identity rewrite.

| Mode | Meaning |
| --- | --- |
| canonical-template | GetEstablishedOnTheWebStartup itself |
| product | GetEstablishedOnTheWeb itself |
| adopted-project | An owner-named copy of the Startup package |

Use the open repository root, Git remote when available, and
Workspace/RepositoryIdentity.md. Folder name alone is not authoritative. A
Startup or product remote in a noncanonical root is a stale binding.

For an adopted project, create `Workspace/RepositoryIdentity.md` with this
schema. Replace every placeholder; use `(none)` when Git or `origin` is absent.

```markdown
# Repository Identity

Repository name: <owner-confirmed project name>
Identity mode: adopted-project
Local root: <absolute repository root>
Git remote: <origin URL or (none)>
Branch: <current branch or (none)>
Source of truth: Local repository at <absolute repository root>
Creation source: GetEstablishedOnTheWebStartup
```

All seven fields are required. The local root, Git remote, and branch must
agree with the active repository state. The project name must not retain the
canonical product or Startup name.

Rewrite only active boot, registry, routing, and workspace identity surfaces.
Preserve source-template, product-packaging, historical, and related-repository
references when their purpose is clear.

## Classify Before Any Adoption Mutation

The canonical roots are `C:\Repositories\GetEstablishedOnTheWebStartup` and
`C:\Repositories\GetEstablishedOnTheWeb`. Preserve their identity, Git history,
and owner registers. Preserve established projects when resuming.

A noncanonical folder is eligible for adoption only when the owner identifies
it as their new Startup copy, or an existing identity record declares
`Identity mode: adopted-project`. A different folder name, missing `.git`, or
a template remote alone does not authorize resets. If signals conflict, stop
before changing files or Git metadata and clarify the mode.

## Active Identity Rewrite Allowlist

In a confirmed adopted project, update identity statements and active path
anchors only in:

- `AGENTS.md` and `README.md`
- `Capabilities/README.md`, `RouterIndex.md`, and `AgentCapabilityGuide.md`
- `Plans/README.md`, `RepositorySearchMap.md`, and `AgentTaskBacklog.md`
- `Plans/OpenQuestions.md` when stale template decisions remain
- `Workspace/OwnerGoals.md` and `Workspace/OwnerPreferences.md`
- copied GettingStarted and SituationalAwareness active instructions
- active prompts containing a hardcoded repository name or root

Do not rewrite workflow descriptions about the source template, packaging,
related repositories, or historical work. Owner goals already captured for
this project remain intact.

## Verify

```powershell
.\Automation\Test-AdoptedRepositoryIdentity.ps1 -Root (Get-Location).Path
```

The verifier reads only. If Git is absent, record `(none)` for remote and
branch; a plain folder is a valid starting workspace. Complete identity cleanup
before the owner-facing close. If indexes were refreshed, include the identity
record and changed boot files in that refresh.
