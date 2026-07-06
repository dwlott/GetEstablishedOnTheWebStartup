<!--
IndexTitle: GitHubWorkflow Troubleshooting Matrix
IndexDescription: Common Git and GitHub messages with safe beginner responses.
IndexType: Capability
CapabilityName: GitHubWorkflow
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-05
-->

# GitHubWorkflow Troubleshooting Matrix

Use this matrix to choose the safe next step. When the cause is unclear, stop and ask for the exact command output.

| Message | Likely meaning | Safe next step |
| --- | --- | --- |
| `Cannot find path` or `The system cannot find the path specified` | PowerShell is pointed at a folder that does not exist yet, or the folder name is different from the command. | Confirm the extracted folder name. Create `C:\Repositories` if needed, move the project folder there, then rerun `cd C:\Repositories\<RepositoryName>`. |
| `fatal: not a git repository` | The folder is not initialized as a Git repository, or the user is in the wrong folder. | Confirm the stable folder path. If this is the intended downloaded folder, use the initialize sequence in [PowerShellPrompts.md](PowerShellPrompts.md). |
| `remote origin already exists` | The repository already has an `origin` remote. | Run `git remote -v`. If it is correct, leave it alone. If it is wrong, use `git remote set-url origin ...`. |
| `src refspec main does not match any` | The `main` branch does not exist yet, or there is no commit to push. | Run `git status` and `git branch`. Make the first commit, then `git branch -M main`, then push. |
| `rejected non-fast-forward` | GitHub has commits the local branch does not have. | Do not force push. Run `git pull` only after confirming the remote content should merge into this local folder. |
| `authentication failed` | GitHub credentials, token, browser auth, or account selection failed. | Re-authenticate using the approved Git/GitHub method. Do not paste tokens into repository files or chat unless the tool explicitly requires a secure auth flow. |
| `repository not found` | The URL is wrong, the repo does not exist, or the user lacks access. | Check the GitHub owner, repository name, privacy/access, and `git remote -v`. |
| `failed to push some refs` | Local and remote history or branch setup does not match. | Read the lines above the error. Check for non-fast-forward, missing upstream, or missing commit. |
| `nothing to commit, working tree clean` | Local tracked files have no uncommitted changes. | If files are missing on GitHub, check recent commits and whether the user pushed. If files are missing locally, check the folder path. |
| `Everything up-to-date` | Git has nothing new to push to the configured remote/branch. | If GitHub still looks wrong, verify `git remote -v`, current branch, and recent commits. |
| `branch has no upstream branch` | The local branch is not linked to a remote branch. | For first push on `main`, use `git push -u origin main`. |
| Untracked files before first commit | Files are present locally but not tracked by Git. | Review files carefully, update `.gitignore` if needed, then use the first local commit sequence. |
| Unmerged files | A merge or conflict is unresolved. | Stop. Do not add, commit, reset, clean, or push until the conflict is understood and resolved. |
| Repository invitation not accepted | The user has not accepted access to a private or shared repository. | Sign in to the correct GitHub account, accept the invitation, then retry the tool connection or repository open step. |
| Wrong GitHub account | The browser, GitHub app, Git credential helper, or tool is using a different account. | Stop and switch to the intended account before granting access, cloning, pushing, or changing remotes. |
| Repository not visible in ChatGPT | The GitHub connector may not have access, the wrong account may be connected, or the repository may not be selected. | Recheck GitHub account access and connector settings. Use ChatGPT for read, search, explanation, review, and planning once connected. |
| Repository not visible in Codex | Codex may not be connected to GitHub, the repository may not be authorized, or the wrong branch/folder is selected. | Connect or reauthorize Codex, select the intended repository and branch, then start with a read-only verification prompt. |
| Repository not visible in Cursor | Cursor has opened the wrong folder or has not cloned/opened the repository. | Open `C:\Repositories\<RepositoryName>` or clone the repository into `C:\Repositories`, then read `AGENTS.md`. |
| Repository not visible to Claude Code | Claude Code is not pointed at the intended local folder or connected repository. | Point it at the intended repository path, ask it to read `AGENTS.md`, and keep the first request read-only. |
| ChatGPT connected but cannot push | ChatGPT GitHub access is not the normal local edit, commit, or push path. | Use ChatGPT for planning or review, then hand off edits to Codex, Cursor, Claude Code, or local Git. |
| Codex can read but cannot create commit or pull request | Tool permissions, branch protection, GitHub authorization, or repository state may block publishing. | Review permissions and branch rules. If needed, ask Codex to leave a clear diff and handoff for the next commit or pull request step. |
| Claude Code can read files but Git commands fail | Local Git, credentials, current branch, or folder path may be misconfigured. | Run the current repository check in [PowerShellPrompts.md](PowerShellPrompts.md), then fix auth or path before editing further. |
| Protected main prevents direct push | The repository requires branch or pull request workflow. | Create a short docs branch, commit there after review, and open or request a pull request. |
| User is working from Downloads | The folder is temporary or nested from ZIP extraction. | Stop and move or clone the repository to `C:\Repositories\<RepositoryName>`. |
| User is editing the Google Drive copy | Drive is being used as the working folder instead of local Git. | Stop durable edits in Drive. Use the local Git repository for edits. Run on-demand mirror only when review sync is explicitly requested. |
| Codex asks to stage files during a cloud-assisted review workflow | The workflow is drifting into publication before owner approval. | Do not stage. If review sync was requested, follow GoogleDriveLink or DropboxLink mirror workflow. Leave changes uncommitted for ChatGPT review. |
| Codex asks to commit during a cloud-assisted review workflow | Commit is a publication step, not required for cloud review. | Do not commit. Leave local changes uncommitted. Run on-demand mirror only if review sync was explicitly requested. |
| Codex asks to push during a cloud-assisted review workflow | Push is a publication step, not required for cloud review. | Do not push. If review sync was requested, run the on-demand mirror workflow so ChatGPT can review from cloud. |
| ChatGPT cannot see local edits and review sync was requested | The cloud review copy may be stale. | Do not stage, commit, or push just for review. Follow GoogleDriveLink or DropboxLink WorkflowIndex for on-demand mirror and verification. |
| Cloud mirror verification is not clean after on-demand sync | The cloud copy still differs from the local repository. | Do not publish. Recheck mirror output per MirrorWorkflow.md; rerun only if safe; report added, changed, and removed counts. |

## Missing Files On GitHub

If expected files are missing from GitHub:

1. Check whether the user is looking at the right GitHub repository and branch.
2. Check local `git status`.
3. Check `git log --oneline --decorate -5`.
4. Check `git remote -v`.
5. Ask whether the user pushed the local work.

Do not run destructive recovery commands to solve a missing-file question.
