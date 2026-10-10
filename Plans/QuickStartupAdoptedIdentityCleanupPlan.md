<!--
IndexTitle: Quick Startup Adopted Identity Cleanup Plan
IndexDescription: Make the final Quick Startup step identify an adopted project as its own repository rather than as the startup template.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-10-10
PromotedFrom: Owner request - Quick Startup identity correction
-->

# Quick Startup Adopted Identity Cleanup Plan

## Purpose

Keep the canonical GetEstablishedOnTheWebStartup repository clearly identified
as the reusable template while ensuring a new project copied from it stops
presenting itself as the startup repository after Quick Startup.

## Scope

- Add an adopted-project identity phase as the final operational Quick Startup
  step.
- Create Workspace/RepositoryIdentity.md for an adopted project.
- Rewrite active copied boot and routing instructions using an allowlist.
- Preserve intentional source-template, packaging, historical, and product
  references.
- Verify the result without changing the owner-selected GitHub remote.

## Out Of Scope

- Rewriting identity in the canonical Startup repository itself.
- Removing every occurrence of GetEstablishedOnTheWebStartup from the copy.
- Automatically creating or changing a GitHub remote.
- Website, WordPress, deployment, or public-launch work.
- Changing owner facts stored outside identity surfaces.

## Identity Modes

| Mode | Detection | Behavior |
| --- | --- | --- |
| Canonical template | Root is the Startup checkout and its remote matches the Startup repository | Preserve Startup identity; do not run adopted rewrite |
| Fresh adopted copy | Noncanonical root explicitly identified by the owner as their Startup copy | Create adopted identity and rewrite active boot surfaces |
| Stale copied repository | Noncanonical root has Startup, product, or host remote that does not match the named project | Report the stale binding, detach according to Git rules, then rewrite identity |
| Adopted project | Project remote and identity record agree | Preserve project remote and maintain project identity |

Folder name alone is not enough to determine the mode. Use the active root,
remote state, and Workspace/RepositoryIdentity.md together.

## Final Quick Startup Step

After Owner Goals, references, preferences, and the soft indexing offer, run
adopted identity cleanup before the owner-facing session close.

The agent must:

1. Confirm whether the current root is the canonical Startup repository or an
   adopted project.
2. Record project name, local root, branch, remote, source of truth, and
   identity mode in Workspace/RepositoryIdentity.md.
3. Rewrite only active identity surfaces that still identify the project as the
   Startup repository or as the GEOTW product.
4. Preserve intentional references to the template, product, packaging process,
   historical records, and related repositories.
5. Run adopted-identity verification checks.
6. Report the identity result in the normal Quick Startup close.

If the project name or source of truth is unknown, stop the cleanup and report
the missing decision. Do not invent a project identity.

## Rewrite Allowlist

The adopted cleanup may update:

- AGENTS.md
- README.md
- Capabilities/README.md
- Capabilities/RouterIndex.md
- Capabilities/AgentCapabilityGuide.md
- Plans/README.md
- Plans/RepositorySearchMap.md
- Plans/AgentTaskBacklog.md
- Plans/OpenQuestions.md when stale template rows remain
- Workspace/OwnerGoals.md
- Workspace/OwnerPreferences.md
- copied GettingStarted and SituationalAwareness active instructions
- active prompts containing a hardcoded repository name or root path

Do not perform a repository-wide blind replacement. Startup names may remain
when text explains where the project came from or how to use the packaging
Capability.

## Required Identity Record

The adopted project should contain:

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

The canonical Startup repository should not contain a filled-in owner project
identity. It should contain only the template and instructions for creating it.

## Verification Matrix

Test these cases:

1. Canonical Startup repository: Startup identity remains unchanged.
2. Fresh copy with no .git: adopted identity is created without a remote.
3. Copied folder with stale Startup remote: stale binding is detected and
   handled by existing Git safety rules.
4. Adopted project with its own GitHub remote: remote remains unchanged and all
   active boot files identify the adopted project.

When `.git` exists, inspect root, remote, branch, and status. When it is absent,
record `(none)` for remote and branch and skip Git commands. A plain folder is
a valid adopted workspace.

Also run the repository identity/source scan, active-boot-file scan, and any
available Startup package or navigation validation.

## Deliverables

| Deliverable | Destination | Owner |
| --- | --- | --- |
| Identity mode rules | Capabilities/GettingStarted/Rules.md | Agent |
| Final Quick Startup step | Capabilities/GettingStarted/GettingStarted.md | Agent |
| Copy-ready prompts | Capabilities/GettingStarted/Prompt.md and FirstRunAgentPrompts.md | Agent |
| Adoption implementation | Capabilities/GettingStarted/WorkspaceAdoptionPrep.md | Agent |
| Identity record template | Workspace identity guidance | Agent |
| Verification result | Quick Startup close and plan handoff | Agent |

## Acceptance Criteria

- The canonical Startup repository still identifies itself as the Startup.
- A new adopted project no longer presents itself as the Startup repository in
  active boot instructions.
- The adopted project has a durable identity record.
- Git remote handling remains owner-controlled and safe.
- Historical, packaging, and source-template references remain when intentional.
- Identity record, root instructions, router surfaces, and Git state agree.
- The final Quick Startup action is identity cleanup, followed by session close.

## Related

- Capabilities/GettingStarted/GettingStarted.md
- Capabilities/GettingStarted/Prompt.md
- Capabilities/GettingStarted/Rules.md
- Capabilities/GettingStarted/WorkspaceAdoptionPrep.md
- Capabilities/GettingStarted/FirstRunAgentPrompts.md
- Capabilities/GettingStarted/PostQuickStartupRouting.md
- Capabilities/StarterRepositoryPackage/WebPresenceStartupRepairSpec.md
- C:\Repositories\GetEstablishedOnTheWeb\Plans\RepositoryIdentityModeAdoptionPlan.md

## Adoption Readiness Refresh — 2026-10-10

The adopted-project gate now precedes all reset and Git-detach instructions.
Canonical template and product roots, established projects, previously captured
owner goals, and project-owned remotes are preserved. Copy-ready prompts use
the actual project identity. Indexing is offered without blocking startup.
The seven-field record and read-only verifier agree on root, remote, branch,
source of truth, and creation source. The package whitelist retains this plan
and the WordPress extension's migration and theme-pointer plans (29 total).


### Verification Results — 2026-10-10

- `VerifyStarterPackage.ps1 -Profile WebPresenceWordPress`: passed, with 33
  Capability folders/router entries and 29 Plans. The declared Plans whitelist
  exactly matches the retained files; the WordPress layer remains present.
- `Test-AdoptedRepositoryIdentityMatrix.ps1`: all eight scenarios passed,
  covering canonical product and Startup, fresh no-Git adoption, formatted
  stale identity, intentional provenance, stale template remote before/after
  detach, and an adopted project with its own remote.
- Actual `Copy-StartupToProject.ps1` temporary-folder smoke test: passed.
  `.git`, `.cursor`, and `.claude` were excluded; an existing destination was
  rejected; the copied package passed structure verification.
- Fixture identity checks rejected a missing record, unrewritten copied
  template declarations, and mismatched root/branch, then accepted a simulated
  adopted identity retaining its creation source.
- SHA-256 comparisons confirmed canonical Git config, Owner Goals,
  preferences, references, and Open Questions were unchanged by the tests.
- All 16 newly added local Markdown links resolved; `git diff --check` passed.

Ready for a new local project copy. The real owner's five-question Quick
Startup and project-specific identity cleanup happen in that copy. Temporary
fixtures were removed. Changes remain uncommitted; no push or deployment.
