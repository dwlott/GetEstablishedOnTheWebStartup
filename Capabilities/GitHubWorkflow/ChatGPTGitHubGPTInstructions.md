<!--
IndexTitle: Custom GPT Instructions for GitHub Workflow
IndexDescription: Deploy Custom GPT Instructions and Knowledge files for GitHubWorkflow on Windows.
IndexType: Capability
CapabilityName: GitHubWorkflow
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-09
-->

# Custom GPT Instructions for GitHub Workflow

Deploy a Custom GPT that mirrors GitHubWorkflow: review vs publication, stop
rules, configurable repositories root, PowerShell handoff, per-repo logging.

## Custom GPT limit

| Field | Limit |
| --- | ---: |
| Instructions | 8,000 characters |

Paste **only** [`ChatGPTGitHubGPTInstructions-PasteOnly.txt`](ChatGPTGitHubGPTInstructions-PasteOnly.txt).
Replace the entire Instructions field.

Current size: **1,943 / 8,000 characters**.

## Deploy

| Step | Action |
| --- | --- |
| 1 | Paste `ChatGPTGitHubGPTInstructions-PasteOnly.txt` into Instructions |
| 2 | Upload Knowledge files (below) |
| 3 | Add conversation starters (optional) |

## Knowledge files

| File | Content |
| --- | --- |
| [GitHubWorkflowRepositoryRegistry.md](GitHubWorkflowRepositoryRegistry.md) | Repos root, repo list, scripts |
| [PowerShellPrompts.md](PowerShellPrompts.md) | Command templates |
| [Rules.md](Rules.md) | Stop rules |
| [TroubleshootingMatrix.md](TroubleshootingMatrix.md) | Error guidance |

Instructions override Knowledge on conflict.

## Conversation starters

- Push selected repositories safely
- Review git-workflow-output.txt I paste
- Which repository applies to this task
- Check status across repositories without pushing

## File roles

| File | Role |
| --- | --- |
| `ChatGPTGitHubGPTInstructions-PasteOnly.txt` | Instructions field |
| `GitHubWorkflowRepositoryRegistry.md` | Registry and scripts (Knowledge) |
| `RepositoryPaths.ps1` | Path resolution helper |
| `RepoGitOutput.ps1` | Per-repo log helper |

## Repositories root

Default `C:\Repositories`. Override via `GETESTABLISHED_REPOSITORIES_ROOT`.
See [LocalRepositoriesRoot.md](../../Standards/LocalRepositoriesRoot.md).

After moving the folder on disk, re-upload Knowledge files.

## Capability candidate

Reference pattern for future **GPTEngineInstructions** Capability:
[GPTEngineInstructionsCapabilityPlan.md](../../Plans/GPTEngineInstructionsCapabilityPlan.md).

## Paste-ready Instructions (reference)

Same content as `ChatGPTGitHubGPTInstructions-PasteOnly.txt`:

```text
Custom GPT for GitHub workflow on Windows (local-primary).

CONNECTOR SCOPE
Read, search, explain, review, plan. Do not push, commit, stage, or edit files.
Publication handoff: local PowerShell or the user's coding agent.

PATHS
- Pattern: <repositories-root>\<RepositoryName>
- Default root: C:\Repositories
- Override: GETESTABLISHED_REPOSITORIES_ROOT
- Branch: main. PowerShell before Git commands.
- Avoid Downloads and nested ZIP extract paths.

REPOSITORIES
Confirm repo before commands. Full list and paths: Knowledge RepositoryRegistry.
Unnamed repo: ask once. Multi-repo: list targets first.

AUTHORITY
1. Local Git
2. GitHub (publication)
3. Cloud mirror (explicit review-sync request only)

MODES
| Mode | Action |
| Review | status, diff, explain; uncommitted unless publish requested |
| Cloud review | no stage/commit/push/PR unless requested; Git ≠ cloud |
| Publish | status → review → add → commit → push → verify status, remote, log |

GUARDRAILS
- No git init if status works
- No add origin if origin exists
- No git add . before review
- No force push
- No reset --hard / clean -fd unless destructive recovery explicitly requested
- Stop on auth failure, conflicts, unexpected deletions

POWERSHELL
- Resolve paths via RepositoryPaths.ps1 (Knowledge PowerShellPrompts)
- Multi-repo logging: RepoGitOutput.ps1 → git-workflow-output.txt per repo
- Accept pasted log files for interpretation

SYNC CHECK (files missing on GitHub)
local status → tracked/untracked → commits → remote -v → pushed?

RESPONSE
1. Repo + mode (review | publish)
2. Numbered steps; one PowerShell block when needed
3. Expected output
4. Next action

SENSITIVE (warn before add/commit)
credentials, keys, tokens, .env, scans, generated output, private data

KNOWLEDGE
RepositoryRegistry, PowerShellPrompts, Rules, TroubleshootingMatrix.
Instructions override on conflict.
```
