<!--
IndexTitle: How To Adopt This Starter
IndexDescription: Copy the Startup into a new project without inheriting its Git binding, then complete verified Quick Startup.
IndexType: Capability
CapabilityName: GettingStarted
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-10-11
-->

# How To Adopt This Starter

Use this to create a new project from **GetEstablishedOnTheWebStartup**.
Keep the original Startup checkout as the reusable template. The new copy
becomes the project's local source of truth.

## 1 — Choose a new destination

Choose a project name, one-line purpose, and one initial outcome (more are optional).
The destination must not already exist. If you already have a repository with
work in it, plan a reviewed import rather than copying over it.

## 2 — Copy without Git

In PowerShell, preview first if useful:

```powershell
& "C:\Repositories\GetEstablishedOnTheWebStartup\Automation\Copy-StartupToProject.ps1" -DestinationName "YourProjectName" -WhatIf
```

Then make the copy:

```powershell
& "C:\Repositories\GetEstablishedOnTheWebStartup\Automation\Copy-StartupToProject.ps1" -DestinationName "YourProjectName"
```

The script excludes `.git`, `.cursor`, and `.claude`, and refuses an existing
destination. Use `-Destination` with an absolute path for a different location.
The original template's Git history and remote stay intact.

If using Explorer or cloning the template instead, remove inherited Git only
from the verified new copy before using it. Never remove `.git` from the
canonical Startup or product repository. A clone still points `origin` at the
template until it is detached. [Workspace Adoption Prep](WorkspaceAdoptionPrep.md)
handles stale template Git after the owner confirms this is an adopted copy.
Do not push to a template remote.

## 3 — Open the project and begin Quick Startup

Open the **new folder** in your agent app, then say:

```text
This is my new project copied from GetEstablishedOnTheWebStartup.
Begin Quick Startup from AGENTS.md. This is not an app launch.
```

The agent verifies the active root, preserves canonical and established
repositories, clears only stale template setup, and displays the five setup
questions as a preview, then asks them one at a time with Question N of 5
and saves each answer. One initial goal is enough; a partial interview resumes
from its checkpoint. Existing sites get a brief maintenance follow-up.
You only answer; the agent leads into the next question without making you copy
questions or ask it to continue. After your answers it captures goals, preferences, and reference
candidates, offers indexing, and routes one next task. Existing project goals
and the project's own Git remote remain intact when resuming.

## 4 — Verify project identity

The agent completes `Workspace/RepositoryIdentity.md`, updates only allowlisted
active identity surfaces, and runs:

```powershell
.\Automation\Test-AdoptedRepositoryIdentity.ps1 -Root (Get-Location).Path
```

The project name, local root, Git state, and source of truth must agree.
Historical and source-template references remain where intentional.
A plain folder without Git is valid; GitHub setup can follow later through
[GitHubWorkflow](../GitHubWorkflow/SetupPrompt.md). Commit and push only when asked.

## 5 — Configure WordPress only if your goals require it

Use [New Commission Site Checklist](../WordPressWebsite/NewCommissionSiteChecklist.md)
for site manifests, local paths, and owner content. Replace example pages and
navigation before building. Database backup and owner build approval precede
WordPress writes; production launch has its own approval.

## Ready To Work

The copy is ready when its identity verification passes, goals and preferences
describe the project, and one next task is recorded. Indexing may be deferred.
Any configured `origin` belongs to this project.

## Related

- [WorkspaceAdoptionPrep.md](WorkspaceAdoptionPrep.md)
- [RepositoryIdentityTemplate.md](RepositoryIdentityTemplate.md)
- [GettingStarted.md](GettingStarted.md)
- [FirstRunAgentPrompts.md](FirstRunAgentPrompts.md)
