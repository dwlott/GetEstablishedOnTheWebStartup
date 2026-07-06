<!-- Index: Pointer sheet for Claude Code install, profile memory, and repo harmonization. -->
<!--
IndexTitle: Claude Code Vendor Pointer Sheet
IndexDescription: Official links, profile memory paths, repository-first harmonization, and Quick Startup quirks for Claude Code.
IndexType: Capability
CapabilityName: LocalAgentToolSetup
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-07
-->

# Claude Code — Vendor Pointer Sheet

Repository-owned **pointers and checklists** only. For install steps, CLI
details, and memory UI, use **official Anthropic documentation** (links below).

Claude Code is a **local worker**: edit the open repository as source of truth.
Profile **memories** live outside Git — harmonize with repo registers; do not
treat memory alone as durable project state.

## Official sources

| Topic | Link | Notes |
| --- | --- | --- |
| Claude Code product | https://docs.anthropic.com/en/docs/claude-code/overview | Primary reference; refresh if URL moves |
| Anthropic docs home | https://docs.anthropic.com | Account, CLI, features |
| Claude on the web | https://claude.ai | Separate from local Claude Code worker |

Refresh links when the vendor changes paths. Do not mirror vendor manuals in git.

## Profile memory paths (outside the repository)

Claude may store **session or project memories** in the user's profile — not
in the Git repository.

| OS | Typical profile memory root | Notes |
| --- | --- | --- |
| Windows | `%USERPROFILE%\.claude\projects\` | Per-project subfolders; exact folder names vary |
| macOS | `~/.claude/projects/` | Confirm against official docs if paths differ |
| Linux | `~/.claude/projects/` | Confirm against official docs if paths differ |

These paths are **outside Git**. Never commit profile memory files into the
repository. Same boundary as Cursor user settings — see
[SourceOfTruthAndMirrorStandard.md](../../../Standards/SourceOfTruthAndMirrorStandard.md).

Runtime profile: [AgentSituationalAwareness.md](../../../Standards/AgentSituationalAwareness.md)
(Claude Code worker row).

## Repository-first memory

When Claude profile memory and repository files disagree, **the repository wins**
unless the owner explicitly approves updating the repo from memory.

| Durable home | Use for |
| --- | --- |
| `Workspace/OwnerGoals.md` | Owner Goals and practical outcomes |
| `Workspace/OwnerPreferences.md` | Instance preferences and decided settings |
| `Workspace/ValuableReferences.md` | External URLs and search terms (Suggested / Owner-confirmed) |
| `Plans/Ideas.md` | Captured possibilities before Plans |

Principle: [ArchiveAndDeprecationRules.md](../../../Standards/ArchiveAndDeprecationRules.md)
— repository-first memory; chat and profile alone are not enough.

## Memory harmonization (when Claude offers to save memory)

Claude Code may offer to **save a memory** at session end or recall memory at
session start. Harmonize with the repo before accepting or writing memory.

### Session start (memory present)

1. Read `AGENTS.md` and repo registers (`OwnerGoals`, `OwnerPreferences`,
   `ValuableReferences`) before trusting profile memory.
2. If memory **conflicts** with repo content, state the drift briefly; **repo
   wins** until the owner approves a repo update.
3. If memory adds **new** facts not in the repo, offer to record them in the
   appropriate Workspace or Plans file — not memory-only.

### Session end (memory offer)

When Claude asks whether to save session decisions to memory:

1. **Read repo registers first** — compare proposed memory to what is already
   recorded.
2. **Prefer repo updates** for decisions that should survive tool switches
   (Cursor, ChatGPT, Claude).
3. Treat Claude memory as an **optional shortcut** for Claude-only continuity —
   complement the repo, do not duplicate long registers.
4. **Offer owner choice:**
   - update **repo only** (recommended for durable decisions);
   - **repo + aligned memory** (same facts, both places);
   - **skip** memory save.
5. Do **not** store credentials, tokens, API keys, or secrets in memory or repo.

Copy-ready harmonization block:

```text
Before saving Claude memory: read Workspace/OwnerGoals.md,
Workspace/OwnerPreferences.md, and Workspace/ValuableReferences.md.
If the memory duplicates repo content, say so and offer repo-only or skip.
If the memory adds durable decisions, update the repo first, then optional
aligned memory with owner approval.
```

See also [GettingStarted Rules — Claude profile memory](../GettingStarted/Rules.md)
and [SituationalAwareness Rules §10](../../SituationalAwareness/Rules.md).

## Smoke-test and clean-run hygiene

For a **clean first-session or smoke test**, the owner may manually delete or
reset project memory under `.claude/projects/` before opening the repository
again.

- **Owner action only** — agents do not delete profile memory automatically.
- Use when testing Quick Startup, starter ZIP extracts, or fresh consumer copies.
- After reset, boot from `AGENTS.md` — not from assumed prior chat context.

## Quick Startup and Claude quirks

| Topic | Guidance |
| --- | --- |
| Deterministic trigger | **`Begin Quick Startup from AGENTS.md`** (case-insensitive) |
| Avoid | **`run Quick Startup`** — may map to app-launch skills in Claude |
| Read | Root **`AGENTS.md`** — never `AGENTS.md.placeholder` or other `*.placeholder` boot files |
| Boot order | [FirstRunAgentPrompts.md](../../GettingStarted/FirstRunAgentPrompts.md) — Agent Read Order |
| Consent cascade | If the owner already agreed to Quick Startup or the startup sequence, **proceed** to setup questions — do not ask a third time "run Quick Startup now?" |
| External URLs | Use external information ladder — [SituationalAwareness Rules §9](../../SituationalAwareness/Rules.md); record Suggested rows in `ValuableReferences.md` |
| Git / cloud | Edit local Git only; no cloud copy unless owner requests review sync |

## Post-open checklist (configuration pass)

Offer after Claude Code can see the repository folder:

- [ ] **Open workspace:** folder the owner controls (for example `C:\Repositories\<YourProjectName>`)
- [ ] **Read boot files:** `AGENTS.md`, then `Standards/AgentSituationalAwareness.md`
- [ ] **Quick Startup:** use deterministic trigger when owner wants first setup
- [ ] **Summarize repo correctly:** pipeline first (Ideas → Plans → outcomes); web presence only when Owner Goals and Capabilities fit — see [SituationalAwareness Rules §11](../../SituationalAwareness/Rules.md)
- [ ] **Harmonize memory:** if Claude recalls prior memory, compare to repo registers
- [ ] **Permissions:** [AgentSandboxAndPermissions.md](../AgentSandboxAndPermissions.md)
- [ ] **No Drive mirror** per pass unless owner explicitly requests review sync for ChatGPT

## Related

- [LocalAgentToolSetup Prompt.md](../Prompt.md)
- [LocalAgentToolSetup Rules.md](../Rules.md)
- [VendorToolIndex.md](../VendorToolIndex.md)
- [GettingStarted/FirstRunAgentPrompts.md](../../GettingStarted/FirstRunAgentPrompts.md)
- [AgentSituationalAwareness.md](../../../Standards/AgentSituationalAwareness.md)
