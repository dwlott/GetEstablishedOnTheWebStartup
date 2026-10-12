<!--
IndexTitle: Startup Adoption Readiness Workflow
IndexDescription: Maintain and verify GetEstablishedOnTheWebStartup adoption instructions before copying it into a new project.
IndexType: Workflow
CapabilityName: StarterRepositoryPackage
IndexStatus: Active
LastEdited: 2026-10-11
-->

# Startup Adoption Readiness Workflow

Use this procedure to prepare **GetEstablishedOnTheWebStartup** for the next
project copy. It captures the adoption-readiness work validated on 2026-10-10,
including the safeguards, verification steps, and lessons needed to repeat it.

This is maintenance of an existing Startup template. It does not rebuild the
template from the product repository or perform the new owner's Quick Startup.
For a fresh packaging build, use [WorkflowIndex.md](WorkflowIndex.md) and the
active profile's repair specification instead.

To repeat this pass, ask:

```text
Prepare GetEstablishedOnTheWebStartup for the next project copy. Follow
Capabilities/StarterRepositoryPackage/StartupAdoptionReadinessWorkflow.md.
Preserve the canonical template and existing owner data. Report the checks
and readiness result; do not begin a real project's Quick Startup.
```

## Document Metadata

- Canonical repository: GetEstablishedOnTheWeb
- Destination: `Capabilities/StarterRepositoryPackage/StartupAdoptionReadinessWorkflow.md`
- Maintained copy: same relative path in GetEstablishedOnTheWebStartup
- Source: Owner-requested adoption-readiness pass and workflow capture,
  2026-10-10; implementation commit `7657deb` in Startup
- Intent: Make preparation repeatable before copying Startup into a new project
- Confidence: High; package, identity, and temporary-copy checks passed
- Follow-up: Apply this workflow when adoption instructions change or drift is suspected
- Status: Active; internal maintenance instructions

Keep the canonical document and its Startup copy identical when updating this
procedure. Read each target's own boot instructions before modifying it. Write
only to repositories covered by the owner's request; preserve unrelated edits.

## 1. Establish The Mode And Scope

| Surface | Role | Action in this workflow |
| --- | --- | --- |
| `C:\Repositories\GetEstablishedOnTheWeb` | Product and source of reusable guidance | Read current adoption guidance; edit only when scoped |
| `C:\Repositories\GetEstablishedOnTheWebStartup` | Canonical reusable Startup checkout | Update adoption instructions; preserve Git and blank owner scaffolds |
| New project folder | Owner-adopted Startup copy | Inspect only until adoption or Quick Startup is authorized |
| Temporary test folder | Disposable copy fixture | Test copy safety and identity behavior; remove after testing |

Read the target's `AGENTS.md`, `Standards/AgentSituationalAwareness.md`,
`Plans/RepositorySearchMap.md`, `Capabilities/RouterIndex.md`, and
`Capabilities/AgentCapabilityGuide.md`. Then read GettingStarted's rules and
the profile's repair specification.

Record the verified roots, Git branches and remotes, existing changes, and
active profile. In a Git checkout, inspect:

```powershell
git -C C:\Repositories\GetEstablishedOnTheWebStartup status -sb
git -C C:\Repositories\GetEstablishedOnTheWebStartup remote -v
git -C C:\Repositories\GetEstablishedOnTheWebStartup log -1 --oneline
```

The canonical Startup remote is its own repository, not the product remote.
A copied project must not continue using the template's remote. If `.git`
is absent in a new project, skip Git commands; a plain folder is valid.

Never delete `.git`, clear owner registers, or perform adopted identity
rewrites in the canonical Startup or product checkout during this pass.
Never infer authorization to reset a folder from its name or a stale remote.

## 2. Compare The Adoption Instructions

Review these surfaces in the product and Startup repositories. The product
provides current safeguards; the Startup retains its own profile-specific
instructions, including the WordPress extension.

| Area | Files |
| --- | --- |
| Human and agent entry points | `README.md`, `AGENTS.md`, `Plans/RepositorySearchMap.md`, `Plans/AgentTaskBacklog.md` |
| First-session operation | GettingStarted `Rules.md`, `Prompt.md`, `GettingStarted.md`, `WorkspaceAdoptionPrep.md` |
| Owner prompts | GettingStarted `HowToAdoptThisStarter.md`, `FirstRunAgentPrompts.md`, `QuickStartupGreeting.md`, `EnvironmentAwareStartupPrompt.md`, `PostQuickStartupRouting.md`, `QuickStartupWalkthrough.md`, `ExistingWebsiteStartup.md` |
| Identity contract | GettingStarted `RepositoryIdentityTemplate.md`; `Automation/Test-AdoptedRepositoryIdentity.ps1` and its matrix |
| Package contract | `WebPresenceStartupRepairSpec.md`; `Automation/VerifyStarterPackage.ps1` |

Check for conflicting instructions, hardcoded project identities, references
to missing import modules, broken navigation, and disagreements between
declared contents and actual files. Distinguish intentional profile
differences from drift. Do not overwrite Startup's WordPress layer with the
product's smaller base profile.

## 3. Reconcile The Instructions

Apply these rules consistently across the entry points:

1. **Classify before mutation.** Adopted resets and Git detach require an
   owner-confirmed new Startup copy, or an existing `adopted-project` record.
   An owner statement in the current session satisfies confirmation; do not
   ask again. Conflicting signals require clarification before mutation.
2. **Reset only identified template residue.** Preserve owner goals,
   preferences, references, and questions already captured for this project.
   Nonempty registers or prior source paths alone do not prove staleness.
   Resumed projects do not repeat fresh-copy resets.
3. **Keep Git handling local to the adopted copy.** Prefer copying without
   `.git`, `.cursor`, and `.claude`. Detach stale inherited Git only after
   adoption is established. Preserve a project's own remote and history.
   Keep GitHub setup separate until requested.
4. **Use the actual project identity.** Prompts should name the active root,
   repository, branch, and mode, rather than assuming a template or host name.
5. **Keep the guided startup flow.** Show the five-question preview once, then
   ask one unanswered question at a time with progress labels. Save each answer
   and the next prompt in an adopted-project checkpoint. One goal is enough;
   combine environment discovery with question 4. Existing-site maintenance
   gets a short context follow-up and a real maintenance route. Reuse facts,
   accept skips, and preserve interrupted interviews.
6. **Offer indexing consistently through its benefit.** Provision missing indexes through accepted
   Indexing Setup; refresh through ManualIndexing. Record deferral without
   blocking startup. Include final identity and boot changes in any refresh.
7. **Keep reference routing usable.** Link to files and capabilities actually
   present in the target. Record a prior source path before proposing imports;
   copy prior material only when authorized.
8. **Close with the outcome and concrete next action.** Report identity
   verification and actual optional-choice states briefly as supporting facts. Use a handoff block only when requested
   or in an explicitly selected planner/worker workflow.

Update only active identity statements in the GettingStarted allowlist.
Keep references whose purpose is source provenance, packaging, history, or
related-repository guidance. Never perform a blind repository-wide rename.

## 4. Keep Identity And Package Verification In Agreement

The adopted identity record requires these seven fields:

| Field | Required value |
| --- | --- |
| Repository name | Owner-confirmed project name |
| Identity mode | `adopted-project` |
| Local root | Verified absolute project root |
| Git remote | Actual `origin` URL, or `(none)` |
| Branch | Actual branch, or `(none)` |
| Source of truth | `Local repository at <verified absolute project root>` |
| Creation source | `GetEstablishedOnTheWebStartup` |

The read-only verifier must reject missing fields, placeholders, mismatched
root/remote/branch, inherited template bindings, and active template identity
declarations. It must recognize formatted Markdown declarations and titles,
while permitting intentional creation-source references. Canonical roots
must retain their canonical identity.

When receiving newer verification scripts, compare their behavior first.
Carry the matching schema, instructions, and scenario tests together; do not
update only the script or only the example record.

Reconcile package counts with the actual retained lists. On 2026-10-10 the
WordPress starter had **33 Capability folders and 29 Plans files**. These are
the validated baseline, not permanent targets for every future package.

Before changing an expected count, identify each difference, confirm why it
belongs, and update the repair-spec whitelist and verifier together. Verify
that the whitelist exactly matches retained Plans and the Capability folders
agree with router and registry entries. Do not lower a check merely to pass it.

Saving a workflow inside this existing Capability adds neither a Capability
folder nor a Plans file, so it does not change those package counts.

## 5. Run The Checks

Set paths explicitly in PowerShell:

```powershell
$StartupRoot = 'C:\Repositories\GetEstablishedOnTheWebStartup'
$ProductRoot = 'C:\Repositories\GetEstablishedOnTheWeb'

& "$StartupRoot\Automation\VerifyStarterPackage.ps1" -Root $StartupRoot -Profile WebPresenceWordPress
```

Run each check as a separate step and inspect its result. Verification scripts
may terminate their calling PowerShell script; use a child PowerShell process
when composing several checks. Stop on unexpected failures.

```powershell
powershell -NoProfile -ExecutionPolicy Bypass -File "$StartupRoot\Automation\Test-AdoptedRepositoryIdentity.ps1" -Root $StartupRoot

powershell -NoProfile -ExecutionPolicy Bypass -File "$StartupRoot\Automation\Test-AdoptedRepositoryIdentityMatrix.ps1" -ProductRoot $ProductRoot

git -C $StartupRoot diff --check
```

The matrix covers canonical product and Startup, fresh adoption without Git,
formatted stale template identity, preserved provenance, stale template remote
before and after fixture detach, and adoption with a project-owned remote.

Also check every newly added relative Markdown link and compare the declared
Plans list with the actual files. Do not claim all existing links were checked
if only newly added links were inspected.

## 6. Smoke-Test The Actual Copy

Use a unique temporary folder, never the intended project or canonical root:

```powershell
$AdoptionTestBase = [IO.Path]::GetFullPath([IO.Path]::GetTempPath()).TrimEnd('\', '/')
$AdoptionTestRoot = Join-Path $AdoptionTestBase ('GEOTWAdoptionSmoke-' + [guid]::NewGuid().ToString('N'))

& "$StartupRoot\Automation\Copy-StartupToProject.ps1" -Source $StartupRoot -Destination $AdoptionTestRoot
```

Before and after testing, compare SHA-256 hashes of the canonical template's
`.git/config`, owner goals, preferences, references, and Open Questions. All
must remain unchanged. Hash only files that exist; missing Git in a packaged
template is valid.

Verify:

- The copy contains the updated instructions and required package files.
- `.git`, `.cursor`, and `.claude` are absent, including nested copies.
- Repeating the copy command to the same destination reports
  `Destination already exists` and preserves the folder.
- The copied package passes `VerifyStarterPackage.ps1` with the same profile.
- Identity verification rejects the fresh copy until its record is completed.
- A fixture record with unrewritten Startup declarations is rejected.
- A simulated adopted record and project boot identity pass while retaining
  source-template provenance; incorrect recorded root and branch are rejected.

Use fixture names and facts for these automated checks. Do not invent real
owner goals, pretend an automated check completed the human interview, or
overwrite another project's files to produce a test result.

Clean up only the verified temporary test directory:

```powershell
if (Test-Path -LiteralPath $AdoptionTestRoot) {
    $AdoptionCleanupRoot = (Resolve-Path -LiteralPath $AdoptionTestRoot).Path
    if (-not $AdoptionCleanupRoot.StartsWith(
        $AdoptionTestBase + [IO.Path]::DirectorySeparatorChar,
        [StringComparison]::OrdinalIgnoreCase)) {
        throw "Refusing cleanup outside temporary directory: $AdoptionCleanupRoot"
    }
    Remove-Item -LiteralPath $AdoptionCleanupRoot -Recurse -Force
}
```

Resolve and validate the target before any recursive deletion. Remove temporary
helper files created for the pass; retain reusable checks intentionally added
to `Automation/`.

## 7. Record Readiness And Hand Off The New Copy

Record changed files, test results, instruction gaps, and remaining work in
the existing Startup identity plan or backlog. Keep the reusable procedure
here, rather than adding another run-specific Plans file each time.

The template is ready to copy when its canonical identity and owner scaffolds
are intact, instructions agree, package checks pass, and the actual-copy smoke
test passes. This does not approve distribution, payment activation,
WordPress writes, or production publishing.

The owner may use the copy script or copy the folder in Explorer. Explorer
copies inherit hidden `.git`; remove it from the confirmed new copy only,
or let authorized Adoption Prep detach it. Preserve the original template.

Open the new folder in the agent app, then use:

```text
<ProjectName> is my new project copied from GetEstablishedOnTheWebStartup.
Begin Quick Startup from AGENTS.md. This is not an app launch.
```

The agent captures actual owner answers, completes the adopted identity
record, and verifies it in that project. GitHub setup follows when requested.
An existing destination requires a reviewed import; do not copy over it.

## 8. Commit And Push Only When Requested

If the owner asks to publish the maintenance changes, follow GitHubWorkflow
in each repository: inspect remotes and branches, fetch remote state, review
the changed files, stage the explicit intended paths, commit, push without
force, and verify clean synchronized status. Do not create an empty commit
in a repository that already has no changes.

Publishing template changes does not update project copies already created
from it. Apply later improvements to those copies only in a separately scoped
pass that preserves their project identity and owner data.

## Validated Example And Lessons

The 2026-10-10 Startup preparation was committed and pushed as `7657deb`:
**Prepare safe Startup adoption and identity verification**. It changed 19
files, passed all eight matrix scenarios and an actual temporary-copy smoke
test, and preserved the canonical Git config and owner registers.

The package's earlier expected Plans count was 28. An added adopted-identity
plan made the actual count 29; the retained lists were reconciled before the
verifier was updated. Bold Markdown declarations also needed recognition in
the identity scan. These checks belong in future passes.

GetEstablishedOnTheWeb had no pending changes and was already synchronized.
`SCV-Kirby-Smith` was inspected as the owner's subsequent project copy: it had
the updated instructions and still inherited the Startup remote. No adoption
reset, Git detach, or real Quick Startup was performed in it by this maintenance
pass. That distinction prevents reporting preparation as completed adoption.

## Related

- [Packaging workflow](WorkflowIndex.md)
- [WebPresence repair specification](WebPresenceStartupRepairSpec.md)
- [Human adoption guide](../GettingStarted/HowToAdoptThisStarter.md)
- [Adoption preparation](../GettingStarted/WorkspaceAdoptionPrep.md)
- [Identity record and allowlist](../GettingStarted/RepositoryIdentityTemplate.md)
- [GitHubWorkflow rules](../GitHubWorkflow/Rules.md)
