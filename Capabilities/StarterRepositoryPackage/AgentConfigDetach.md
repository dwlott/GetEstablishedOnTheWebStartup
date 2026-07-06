<!--
IndexTitle: Agent And Git Detach
IndexDescription: Required detach of Git metadata and IDE agent runtime config when packaging host copy to consumer starter.
IndexType: Capability
CapabilityName: StarterRepositoryPackage
CapabilityVersion: 2
IndexStatus: Draft
LastEdited: 2026-06-06
-->

# Agent And Git Detach

Apply in **Step 1** of [WorkflowIndex.md](WorkflowIndex.md) immediately after
reporting `git remote -v`. This is **required** when the packaging workspace
was copied from the archetype host and still points at the host GitHub remote
(for example `github.com/<owner>/GetEstablished.git`).

## Why This Is Required

A folder copy brings along:

- The host **`.git`** directory → same `origin` as `GetEstablished`
- **IDE agent runtime config** → Claude/Cursor settings tied to the host session

If left in place:

- `git push` from the packaging folder can **overwrite host history**
- Cursor and Claude may show **confusing sync state** (two folders, one remote)
- Consumer download carries **developer machine config**, not a clean starter

**Repository instructions stay:** `AGENTS.md` is **not** removed — it is
repository workflow guidance, not IDE runtime config.

## Default For Spawn Startup

When packaging **`GetEstablished` → `GetEstablishedStartup`** (or any host copy):

| Step | Default action |
| --- | --- |
| Report | `git remote -v`, `git status -sb` in handoff |
| Git detach | **Option A — remove `.git` entirely** (required unless owner explicitly chooses B) |
| Agent config | Remove all paths in the table below |
| Mirror next time | Exclude `.git` and agent config when copying host → packaging workspace |

Option B (keep `.git`, remove `origin`) is only when the owner wants local
history without host remote — still remove agent config.

## Remove From Packaging Workspace

```text
.git/                          <- entire directory; removes host origin binding
**/.git/                       <- nested copies (for example under Intake/)
.claude/                       <- root and any nested
.cursor/                       <- root and any nested (plans, rules, skills adapters)
.vscode/settings.json          <- only if machine-specific; keep shared extensions.json if team uses it
.cursorignore                  <- optional remove; consumer may recreate
```

Search before ZIP:

```powershell
cd <PackagingWorkspacePath>
Get-ChildItem -Force -Recurse -Directory -Filter .git -ErrorAction SilentlyContinue |
  Select-Object -ExpandProperty FullName
Get-ChildItem -Force -Recurse -Directory -Filter .claude -ErrorAction SilentlyContinue |
  Select-Object -ExpandProperty FullName
Get-ChildItem -Force -Recurse -Directory -Filter .cursor -ErrorAction SilentlyContinue |
  Select-Object -ExpandProperty FullName
```

Remove each path found. Record removed paths in handoff.

## Keep In Consumer Starter

```text
AGENTS.md                      <- repository agent workflow (required)
Capabilities/                  <- Capability prompts and rules
Standards/
README.md
.gitignore                     <- create or keep if present; practical ignore rules
```

Consumer connects Git later via **GitHubWorkflow SetupPrompt** — new remote,
new history.

## Handoff Fields

```text
Host origin before detach: <url or none>
Git detach applied: Option A | B | C
.git removed: yes | no
Agent config paths removed: <list>
Cursor will show Git: no repo until owner runs GitHubWorkflow Setup
```

## Related

- [Rules.md](Rules.md)
- [WorkflowIndex.md](WorkflowIndex.md)
- [PackageChecklist.md](PackageChecklist.md)
- [../GitHubWorkflow/SetupPrompt.md](../GitHubWorkflow/SetupPrompt.md)
