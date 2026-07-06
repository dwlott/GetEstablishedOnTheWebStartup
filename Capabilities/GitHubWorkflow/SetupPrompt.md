<!--
IndexTitle: GitHubWorkflow Setup Prompt
IndexDescription: Copy-ready worker prompt for connecting a downloaded starter folder to GitHub.
IndexType: Capability
CapabilityName: GitHubWorkflow
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-05
-->

# GitHubWorkflow Setup Prompt

Use this prompt when the user downloaded a ZIP or starter folder and wants to connect it to their own GitHub repository.

```text
# Worker pass: GitHubWorkflow Setup

Repository: {{LOCAL_FOLDER_OR_REPOSITORY_NAME}}
Branch: main

Read AGENTS.md if present. If AGENTS.md is not present because the folder is
not initialized yet, inspect the folder carefully before making Git changes.
Also read Capabilities/GitHubWorkflow/Rules.md,
Capabilities/GitHubWorkflow/BeginnerGitHubOnboarding.md,
Capabilities/GitHubWorkflow/PowerShellPrompts.md, and
Capabilities/GitHubWorkflow/TroubleshootingMatrix.md when available.

Goal:
Guide the user from a downloaded Get Established starter folder to a first
GitHub-backed repository connection. If the user is also connecting ChatGPT,
Codex, Cursor, or Claude Code, use BeginnerGitHubOnboarding.md for the
read-only verification prompts and beginner stop rules.

If the user says "GDrive assisted agentic workflow", "GDrive workflow",
"ChatGPT review from Drive", or explicitly requests review sync, do not
stage, commit, push, or create a pull request unless explicitly requested.
Leave local changes uncommitted. Do not mirror automatically — run the
on-demand mirror workflow from Capabilities/GoogleDriveLink/WorkflowIndex.md
(or DropboxLink when Dropbox is the review surface) only when review sync
was explicitly requested. In Cursor with the repo open, skip cloud copy.

Start by identifying the user's state:
- A. I have a ZIP folder
- B. I have a normal folder
- C. I already cloned it
- D. I already created the GitHub repo

Beginner folder rule:
- The user should not work directly from Downloads.
- Recommend C:\Repositories\<RepositoryName> as the stable local folder.
- If the folder is still a ZIP, extract it first, then move the extracted
  project folder to C:\Repositories\<RepositoryName>.
- Tell the user to open PowerShell before running the command sequences.

Safe setup sequence:
1. Prepare the stable folder if needed:
   New-Item -ItemType Directory -Force -Path C:\Repositories
   cd C:\Repositories
2. Check status:
   cd C:\Repositories\<RepositoryName>
   git status
3. If git status works, do not run git init.
4. If git status says this is not a Git repository, initialize:
   cd C:\Repositories\<RepositoryName>
   git init
   git branch -M main
   git status
5. Before git add ., warn the user this is an owner-approved publication
   step, not part of the standard cloud-assisted review workflow. Do not commit credentials,
   API keys, tokens, local .env files, scans, generated output folders, or
   private customer files.
6. Make the first local commit only after review and owner approval:
   cd C:\Repositories\<RepositoryName>
   git status
   git add .
   git commit -m "Initial repository setup"
   git status
7. Connect to GitHub only after the user has an empty target repo or confirms
   the target repo is ready:
   cd C:\Repositories\<RepositoryName>
   git remote -v
   git remote add origin https://github.com/<GitHubUserName>/<RepositoryName>.git
   git remote -v
8. If origin already exists, do not add it again. Use:
   cd C:\Repositories\<RepositoryName>
   git remote -v
   git remote set-url origin https://github.com/<GitHubUserName>/<RepositoryName>.git
   git remote -v
9. First push only after the owner explicitly asks to publish:
   cd C:\Repositories\<RepositoryName>
   git status
   git push -u origin main
   git status
10. Verify:
   cd C:\Repositories\<RepositoryName>
   git status
   git remote -v
   git log --oneline --decorate -5

Stop rules:
- Do not force push.
- Do not use git reset --hard or git clean -fd.
- Stop for authentication failure, repository not found, non-fast-forward
  rejection, unmerged files, or unexpected private files.
- If expected GitHub files are missing, ask whether the user pushed the local
  work.

End with exactly one fenced text handoff:
Summary, Files Changed, Planning Files To Review, Questions Added Or Changed,
Review Sync Status, Next Recommended Task.
```

## Prompt history

- **2026-05-30 (v1):** Initial setup prompt for downloaded starter folder to GitHub first push.
- **2026-06-05 (v1):** Aligned cloud review steps with on-demand mirror model.
