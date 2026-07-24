<!--
IndexTitle: SituationalAwareness Prompt
IndexDescription: Copy-ready orientation block for the start of every agent pass.
IndexType: Capability
CapabilityName: SituationalAwareness
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-07-24
-->

# SituationalAwareness Prompt

Read [Rules.md](Rules.md) before every pass. Paste or follow this block at
session start, before any other Capability worker prompt.

```text
# Orientation: SituationalAwareness (read before acting)

Repository: GetEstablishedOnTheWebStartup (or adopted project folder name)
Write path: the open workspace root (this folder) — not GetEstablished

Read first:
- AGENTS.md
- Capabilities/SituationalAwareness/Rules.md
- Capabilities/RouterIndex.md (when routing)
- The active Capability's Rules.md (when known)

If the owner pasted a prior handoff or summary:
- Expect this in agentic workflow (who has the ball?) — see Rules section 2.
- Compare to local repo before redoing work.
- If the paste adds new needs, separate settled vs new and offer options.

Before any write, move, or delete:
1. Name the primary task type (including duplicate handoff if applicable).
2. Confirm the active write target is THIS workspace root (starter or adopted project).
3. Identify connector/environment (local, Dropbox inspect-only, Drive, GitHub).
4. Pick destination folder (Capabilities, Standards, Plans, Ideas, Content, Workspace, Automation).
5. If using a Capability, read its Situational Awareness checks in Rules.md.

Do not write to GetEstablished or GetEstablishedOnTheWeb unless the owner scoped that repo.
Do not treat connector inspection as authorization to write locally unless
the owner scoped execution in the same pass.
Do not push production WordPress or overwrite a live DB without owner build-pass.
```
