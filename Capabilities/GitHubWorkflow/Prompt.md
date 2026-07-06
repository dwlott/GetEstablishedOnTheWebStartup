<!--
IndexTitle: GitHubWorkflow Prompt
IndexDescription: Copy-ready worker prompt for GitHub maintenance, onboarding, and downloaded-folder setup help.
IndexType: Capability
CapabilityName: GitHubWorkflow
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-05
-->

# GitHubWorkflow Prompt

Read [Rules.md](Rules.md) before using this prompt.

```text
# Worker pass: GitHubWorkflow

Repository: {{REPOSITORY_NAME}}
Branch: main

Read AGENTS.md, Capabilities/GitHubWorkflow/README.md,
Capabilities/GitHubWorkflow/Rules.md,
Capabilities/GitHubWorkflow/BeginnerGitHubOnboarding.md,
Capabilities/GitHubWorkflow/PowerShellPrompts.md, and
Capabilities/GitHubWorkflow/TroubleshootingMatrix.md.

Goal:
Help the user safely complete a GitHub workflow task. Cover both normal
maintenance and beginner setup from a downloaded Get Established starter
folder. When the user is new to GitHub or AI tool connections, use
BeginnerGitHubOnboarding.md to explain GitHub, ChatGPT, Codex, Cursor,
Claude Code, and Google Drive roles without overclaiming tool UI details.

First classify the user's starting path:
- A. I have a ZIP folder
- B. I have a normal folder
- C. I already cloned it
- D. I already created the GitHub repo

Use the nearest safe path:
- For ZIP or normal folder setup, recommend moving the folder out of
  Downloads and into C:\Repositories\<RepositoryName>.
- For an existing clone, do not run git init. Start with git status.
- For an existing GitHub repo, check git remote -v before changing origin.

Required safety checks:
- Do not run git init if git status already works.
- Do not add origin if origin already exists.
- Do not use git add . until the user has reviewed files.
- Do not force push.
- Do not use git reset --hard or git clean -fd unless the user explicitly
  asks for destructive recovery and the warning is clear.
- If expected GitHub files are missing, stop and ask whether the user pushed
  the local work.

For first local commit:
- Warn the user to review files before git add .
- Do not commit credentials, API keys, tokens, local .env files, scans,
  generated output folders, or private customer files.
- Add .gitignore guidance when local-only folders are present.

For normal maintenance:
- Check status.
- Pull only when the user is ready to sync from GitHub.
- Review changed file names before any publication command.
- Leave local changes uncommitted when the task is for cloud-assisted review,
  ChatGPT review from Drive or Dropbox, or an assisted agentic workflow that
  has not yet reached publication.
- Commit focused changes only when the owner explicitly asks to publish.
- Push only when the owner explicitly asks for push.
- Verify with git status, git remote -v, and recent log output when
  publication commands are used.

For cloud-assisted review (only when owner or planner explicitly requests
review sync):
- If the user says "GDrive assisted agentic workflow", "GDrive workflow",
  "ChatGPT review from Drive", or asks for a review sync, do not stage,
  commit, push, or create a pull request unless explicitly requested.
- Do not mirror automatically after local edits. Mirror runs only on explicit
  request.
- Follow Capabilities/GoogleDriveLink/WorkflowIndex.md (or DropboxLink when
  Dropbox is the review surface) for on-demand mirror steps and verification.
- Leave local changes uncommitted for owner review.
- In Cursor with the repository open, skip cloud copy — read local files
  directly.

For beginner AI tool onboarding:
- Start with read-only verification prompts before file edits.
- Explain that ChatGPT with GitHub connected is mainly for reading,
  searching, reviewing, explaining, and planning.
- Explain that Codex, Cursor, and Claude Code can help with local edits and
  Git tasks once pointed at the correct repository.
- Keep Google Drive or Dropbox framed as optional review mirrors — not the
  edit source of truth and not automatic after every pass.
- Prefer a small docs-only first task.

Command style:
- Use plain PowerShell command sequences.
- Do not use Write-Host report scripts unless the user asks for a script.
- Prefer commands from PowerShellPrompts.md.

End with exactly one fenced text handoff:
Summary, Files Changed, Planning Files To Review, Questions Added Or Changed,
Review Sync Status, Next Recommended Task.
```

## Prompt history

- **2026-05-30 (v1):** Initial GitHubWorkflow operate prompt for maintenance and downloaded-folder setup.
- **2026-06-05 (v1):** Aligned cloud review steps with on-demand mirror model.
