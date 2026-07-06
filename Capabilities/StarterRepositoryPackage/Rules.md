<!--
IndexTitle: StarterRepositoryPackage Rules
IndexDescription: Stop rules and scope for repairing a packaging workspace into a starter repository.
IndexType: Capability
CapabilityName: StarterRepositoryPackage
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-07
-->

# StarterRepositoryPackage Rules

Read before running [WorkflowIndex.md](WorkflowIndex.md) or [Prompt.md](Prompt.md).

## Scope

In scope:

- Repair **packaging workspace** copies (staging folder after manual host copy).
- Git remote and history repair (report, detach, remove, or re-init per owner).
- Remove or exclude archetype-host-only trees from the starter output.
- Rewrite consumer-facing identity in `README.md` and `AGENTS.md`.
- Generalize hardcoded host paths (for example `C:\Repositories\GetEstablished`).
- Verify boot path: Quick Startup, website link intents, GitHubWorkflow Setup.
- Apply lazy scaffold trim per [ScaffoldPolicy.md](ScaffoldPolicy.md).
- Include **RepositoryScaffold** in consumer Capabilities subset.
- Produce a repair report and handoff (including instruction-gap fields).

Out of scope unless separately approved:

- Editing the archetype host while repairing the packaging workspace.
- Pushing to any remote without explicit owner request.
- Building or deploying GetEstablishedOnTheWeb.com.
- Creating ZIP automation or release pipelines (document manual ZIP steps only).
- Removing Capabilities the consumer starter still needs (GettingStarted,
  GitHubWorkflow, ChatToMarkdown, ContentReview, etc.).

## Situational Awareness

When **StarterRepositoryPackage** is the active Capability (after core SA):

1. Confirm **which folder** is the packaging workspace — not the archetype host.
2. Confirm the archetype host path and that it stays the development source.
3. Confirm **fresh mirror** — expect full host tree; do not assume prior repair.
4. Run `git remote -v` and `git status -sb` in the packaging workspace before edits.
5. **Stop** if `origin` still points at the host GitHub repo and owner has not
   chosen a Git repair option.
6. Read [ConsumerRepairSpec.md](ConsumerRepairSpec.md) first — use its lists;
   do not invent REMOVE/KEEP sets during repair.

### Instruction gap feedback

During packaging, **do not edit the archetype host** unless the owner explicitly
scopes a follow-up host pass.

When instructions in this Capability are **wrong, incomplete, or ambiguous**:

1. **Continue repair** using judgment aligned with [ConsumerRepairSpec.md](ConsumerRepairSpec.md).
2. Record the gap in the handoff under **Instruction gaps found (host — next
   archetype pass)** — do not leave learnings only in chat.
3. Owner may add a row to [`Plans/OpenQuestions.md`](../../Plans/OpenQuestions.md)
   or approve a follow-up host edit pass.
4. Repeatable gaps: promote into `ConsumerRepairSpec.md` or `WorkflowIndex.md`
   on the **next** archetype-host edit (not during packaging).

See also [SituationalAwareness/Rules.md](../SituationalAwareness/Rules.md) section 7.

## Stop Rules

- **Never push** from a packaging workspace while `origin` points at the
  archetype host remote.
- **Never** run `git push --force` during a packaging repair pass.
- **Do not delete** `Intake/`, `Archive/`, or large `Plans/` trees without an
  owner-approved exclude list recorded in the handoff.
- **Do not commit** secrets, tokens, `.env`, or credentials into the starter tree.
- **Do not** edit both host and packaging workspace in one pass unless the owner
  explicitly scoped both.
- **Stop** before destructive Git operations (`Remove-Item .git`, `git init`
  overwrite) until the owner confirms the chosen Git repair option.

## Git Repair Options (Owner Chooses One)

**Spawn startup packaging default:** when the packaging workspace was copied from
the archetype host and `origin` is the host remote (for example
`GetEstablished.git`), apply **Option A** and [AgentConfigDetach.md](AgentConfigDetach.md)
before other repairs. A host copy must not ship with host Git binding.

| Option | When | Agent action |
| --- | --- | --- |
| **A — ZIP, no Git** | Consumer gets a fresh folder; no history | **Default.** Remove `.git` after report; document in handoff |
| **B — Fresh Git** | Consumer will connect their own GitHub | Remove `origin`; optional `git init` if history is messy |
| **C — Keep Git, new remote** | Separate product repo later | Remove host `origin`; leave local commits; do not push until new remote is set |

Default recommendation for **Get Established** download: **Option A**.

## Agent Runtime Config (Remove From Packaging Workspace)

Per [AgentConfigDetach.md](AgentConfigDetach.md), remove IDE agent runtime config
from the consumer starter — not repository workflow files:

| Remove | Keep |
| --- | --- |
| `.git/`, nested `**/.git/` | `AGENTS.md` |
| `.claude/` | `Capabilities/`, `Standards/` |
| `.cursor/` | `.gitignore` (practical ignores) |

Consumer Git starts fresh via **GitHubWorkflow SetupPrompt** when the owner is ready.

## Distinction From Other Capabilities

| Capability | Role |
| --- | --- |
| **GitHubWorkflow** | Create new GitHub repo + clone |
| **RepositoryInitialize** | Bootstrap empty or skeletal shell |
| **RepositoryScaffold** | Consumer core scaffold + growth map + Setup routing |
| **GettingStarted** | First session inside an already-downloaded starter |
| **StarterRepositoryPackage** | Repair host copy → starter repository before ZIP |

## Related

- [README.md](README.md)
- [WorkflowIndex.md](WorkflowIndex.md)
- [PackageChecklist.md](PackageChecklist.md)
- [ScaffoldPolicy.md](ScaffoldPolicy.md)
- [AgentConfigDetach.md](AgentConfigDetach.md)
- [ConsumerRepairSpec.md](ConsumerRepairSpec.md)
- [ConsumerBootSnippets.md](ConsumerBootSnippets.md)
- [Prompt.md](Prompt.md)
