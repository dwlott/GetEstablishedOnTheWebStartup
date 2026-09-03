<!--
IndexTitle: How To Adopt This Starter
IndexDescription: Owner steps to copy or clone a Startup repository into a new project folder without inheriting the template Git remote.
IndexType: Capability
CapabilityName: GettingStarted
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-09-03
-->

# How To Adopt This Starter

Use this when you start a **new project** from a Startup repository
(`GetEstablishedStartup` or `GetEstablishedOnTheWebStartup`).

The new folder should become **your** workspace. It must not stay linked to the
starter template's GitHub remote.

## Preferred: copy without Git

From the Startup repo:

```powershell
.\Automation\Copy-StartupToProject.ps1 -DestinationName NP
```

Or Explorer-copy the Startup folder to a new name, then **delete `.git`** in
the new copy **before** you open it in Cursor, Claude Code, or another agent.
Then say **Begin Quick Startup from AGENTS.md**.

Windows Explorer: show hidden items, then delete `.git`. PowerShell (in the
**new** folder only):

```powershell
Remove-Item -Recurse -Force .git
```

Do **not** delete `.git` on the original Startup repository.

## If you already opened the copy with `.git` still there

Do not push. The agent should detach automatically (see
[WorkspaceAdoptionPrep.md](WorkspaceAdoptionPrep.md)). You can also delete
`.git` yourself, then continue Quick Startup. The project files stay; only
template history and remotes go away.

## If you cloned the Startup GitHub URL

`git clone` of the starter still sets `origin` to the **template** repo. That is
the same risk as a folder copy. Either:

- delete `.git` in the clone and treat it as a new folder, or
- let Adoption Prep detach it, then connect **your** GitHub repo later via
  **GitHubWorkflow**.

Safer clone path: create an **empty** GitHub repo for the new project, copy
files **without** `.git`, then `git init` and add that `origin`.

## After detach

Quick Startup captures Owner Goals, writes boot files, and **indexes** the
workspace. Connect GitHub when you want history and backup — not before the
folder is yours.

## Related

- [WorkspaceAdoptionPrep.md](WorkspaceAdoptionPrep.md)
- [GettingStarted.md](GettingStarted.md)
- [../GitHubWorkflow/SetupPrompt.md](../GitHubWorkflow/SetupPrompt.md)
