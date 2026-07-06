<!--
IndexTitle: Beginner GitHub + AI Tool Onboarding
IndexDescription: Beginner-friendly GitHub, ChatGPT, Codex, Cursor, Claude Code, and Google Drive onboarding for repository workflows.
IndexType: Capability
CapabilityName: GitHubWorkflow
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-08
-->

# Beginner GitHub + AI Tool Onboarding

## Purpose

Help a beginner connect GitHub and AI tools with confidence before editing
repository files. This guide explains what each tool is for, how to verify
access, and when to stop and ask for help.

Use this with the GitHubWorkflow rules, command prompts, and troubleshooting
matrix. Keep the workflow generic and safe for any beginner using a
GitHub-backed Get Established repository.

## Why You Are In Good Shape

This repository was planned to help beginners work with GitHub and AI tools.
You do not need to master GitHub all at once.

Most routine steps are guided by ChatGPT, Codex, Cursor, Claude Code, or
GitHub itself. The safest habit is to let the assistant explain the next step
before running commands.

Codex and Claude Code can often help with Git tasks once they are connected
and pointed at the right repository. But reviewing documentation changes does
not require publishing them to GitHub first. When a command is needed, this
Capability keeps the commands short, copy-ready, and easy to verify.

GitHub may feel unfamiliar at first, but the workflow becomes routine quickly:
check where you are, make a small local edit, and publish to GitHub only when
the owner decides. Optional cloud review sync (Google Drive or Dropbox) happens
**only when explicitly requested** — not after every edit. In **Cursor** with
the repository open, skip cloud copy and read local files directly.

## What The Tools Do

| Tool | Beginner role |
| --- | --- |
| GitHub | Stores the repository, tracks changes, manages branches, and supports pull requests. |
| ChatGPT with GitHub connected | Reads, searches, explains, reviews, and helps plan repository work. Do not treat it as the normal push or edit path. |
| Codex | Helps make local repository edits, run on-demand cloud review sync when explicitly requested, and handle Git publication steps when explicitly asked. |
| Cursor | Local editor and agent workspace for opening the repository, editing files, reviewing diffs, and using terminal commands when needed. |
| Claude Code | Local or connected coding assistant workflow for reading the repository, editing files, explaining changes, and helping with Git tasks. Exact interface details may vary. |
| Google Drive | Optional disposable review mirror and intake path when explicitly requested. It is not the edit source of truth. Git and cloud are not connected. |

## GitHub Account And Repository Access

1. Sign in to GitHub with the account that should own or access the
   repository.
2. Accept the repository invitation if GitHub shows one.
3. Open the repository in GitHub.
4. Confirm that `README.md` and `AGENTS.md` are visible.
5. Confirm the branch shown by GitHub before editing or asking a tool to edit.

Stop if the repository is not visible, the wrong account is signed in, or the
repository name does not match the folder you intend to use.

## Connect ChatGPT To GitHub

Connect ChatGPT to GitHub from the current ChatGPT settings, Apps, or
connectors interface. UI labels can change, so follow the live product flow
instead of relying on a stale screenshot.

After connecting, start with a read-only verification prompt. ChatGPT with
GitHub access is best used to read, search, explain, review, and plan
repository work. Do not assume it is the normal place to push commits.

For a Custom GitHub GPT, deploy instructions and Knowledge files per
[ChatGPTGitHubGPTInstructions.md](ChatGPTGitHubGPTInstructions.md). Paste
only the `.txt` file into Instructions; upload RepositoryRegistry and related
Knowledge files.

## Connect Codex To GitHub

Connect Codex to GitHub from the Codex interface and choose the intended
repository and branch. Start with a read-only verification prompt before
asking Codex to edit files.

Codex can make local repository edits in the workspace. When the owner or
planner explicitly requests review sync, Codex can run the on-demand mirror
workflow so ChatGPT can review from Google Drive or Dropbox. Codex may also
support stage, commit, push, and pull request steps through its interface,
but those are publication steps for when the owner explicitly asks.

## Use Cursor With The Repository

Open the local repository folder in Cursor:

```powershell
C:\Repositories\<RepositoryName>
```

Read `AGENTS.md` before making changes. Use Cursor to edit files, inspect
diffs, and run terminal commands when needed. Do not work from `Downloads` or
from a nested extracted ZIP folder.

## Use Claude Code With The Repository

Use Claude Code only after it can see the intended local folder or connected
repository. Ask it to read `AGENTS.md` and the GitHubWorkflow files before
editing.

Keep requests small at first. A safe first task is a documentation-only
change. Commit or pull request steps can wait until the owner decides to
publish. Cloud review sync is optional and only when explicitly requested.

## Two Different Workflows

**Default:** edit local Git only. No automatic cloud copy.

**For review (when explicitly requested):** the assistant edits local files,
runs the on-demand mirror workflow from
[GoogleDriveLink/WorkflowIndex.md](../GoogleDriveLink/WorkflowIndex.md) or
[DropboxLink/WorkflowIndex.md](../DropboxLink/WorkflowIndex.md), and ChatGPT
reviews from the cloud copy. Local changes stay uncommitted.

**For publication:** the owner later decides whether to stage, commit, push, or
open a pull request.

**Cursor:** with the repository open in the IDE, skip cloud copy — read local
files directly.

Beginners do not need to understand every Git publishing step before reviewing
documentation changes. Cloud review lets ChatGPT inspect updated files while
local changes remain uncommitted.

## First Safe Beginner Workflow

1. Confirm GitHub account access.
2. Confirm the repository name and branch.
3. Read `AGENTS.md`.
4. Read [README.md](README.md) and [Rules.md](Rules.md).
5. Start with a read-only verification prompt.
6. Prefer one small documentation-only change.
7. If the owner or planner explicitly requests cloud review sync, run the
   on-demand mirror workflow so ChatGPT can review. Otherwise skip cloud copy.
8. Stage, commit, push, or create a pull request only after the owner
   explicitly asks to publish.

Avoid direct edits to `main` unless the workflow explicitly allows it. A
short docs branch is usually safer for learning.

## Copy-Ready Verification Prompts

### ChatGPT

```text
Read the GitHub repository through the connected GitHub app.
Start with AGENTS.md. Tell me the main working rules, which Capability owns
beginner GitHub onboarding, and what file I should read next before editing
anything.
```

### Codex

```text
Repository: <RepositoryOwner>/<RepositoryName>
Branch: main

Read AGENTS.md and Capabilities/GitHubWorkflow/README.md.
Do not edit files yet. Confirm whether you can see the repository,
summarize the beginner workflow rules, and recommend the first safe
docs-only task.
```

### Cursor

```text
Repository folder: C:\Repositories\<RepositoryName>

Read AGENTS.md and Capabilities/GitHubWorkflow/README.md.
Confirm the repository rules, identify the owning Capability for GitHub
onboarding, and do not edit files yet.
```

### Claude Code

```text
Repository folder: <RepositoryPath>

Read AGENTS.md and Capabilities/GitHubWorkflow/README.md.
Do not edit files yet. Confirm the repository rules, explain the safest
beginner workflow, and recommend one small documentation-only first task.
```

## Common Problems

| Problem | Safe response |
| --- | --- |
| Repository invitation is not accepted | Sign in to the correct GitHub account and accept the invitation before connecting tools. |
| Wrong GitHub account is active | Stop and switch accounts before granting access or running commands. |
| Tool cannot see the repository | Confirm the repository exists, the account has access, and the connector or local folder is pointed at the right place. |
| ChatGPT can read but cannot publish work | Use ChatGPT for review and planning. Publication can happen later through Codex, Cursor, Claude Code, or local Git when the owner asks. |
| Codex or Claude Code can read but cannot commit | This does not block optional cloud review. If review sync was explicitly requested, run the on-demand mirror workflow for ChatGPT review. Handle Git publishing later if the owner asks. |
| Cursor opened the wrong folder | Close the folder and open `C:\Repositories\<RepositoryName>`. |
| Commands are running from `Downloads` | Stop and move the folder to a stable path before continuing. |
| Google Drive copy is open | Use it for reading or capture only. Make durable edits in the local Git repository. Mirror only when review sync is explicitly requested. |

## Stop Rules

- Stop if the repository is not visible in GitHub.
- Stop if the wrong GitHub account is signed in.
- Stop if the local folder is under `Downloads`.
- Stop if `git status` reports conflicts or unmerged files.
- Stop before staging, committing, pushing, or opening a pull request during
  a cloud-assisted review workflow unless the owner explicitly asks.
- Stop before committing credentials, tokens, local `.env` files, scans,
  generated output folders, or private customer files.
- Stop before pushing directly to a protected or shared `main` branch.
- Stop if a tool asks for permissions you do not understand.

Do not use force-push or destructive recovery commands in a beginner setup
flow.

## Related Files

- [README.md](README.md)
- [Rules.md](Rules.md)
- [Prompt.md](Prompt.md)
- [SetupPrompt.md](SetupPrompt.md)
- [PowerShellPrompts.md](PowerShellPrompts.md)
- [TroubleshootingMatrix.md](TroubleshootingMatrix.md)
- [../LocalAgentToolSetup/Vendors/Cursor.md](../LocalAgentToolSetup/Vendors/Cursor.md)
- [../GoogleDriveLink/WorkflowIndex.md](../GoogleDriveLink/WorkflowIndex.md)
