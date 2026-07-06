<!--
IndexTitle: SituationalAwareness Prompt
IndexDescription: Copy-ready orientation block for the start of every agent pass.
IndexType: Capability
CapabilityName: SituationalAwareness
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-07
-->

# SituationalAwareness Prompt

Read [Rules.md](Rules.md) before every pass. Paste or follow this block at
session start, before any other Capability worker prompt.

```text
# Orientation: SituationalAwareness (read before acting)

Repository: GetEstablished
Write path: C:\Repositories\GetEstablished

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
2. Confirm the active repository is C:\Repositories\GetEstablished for writes.
3. Identify connector/environment (local, Dropbox inspect-only, Drive, GitHub).
4. Pick destination folder (Capabilities, Standards, Plans, Ideas, Content, Archive).
5. If using a Capability, read its Situational Awareness checks in Rules.md.

Do not confuse GetEstablished with GetEstablishedOnTheWeb or Intake copies.
Do not treat connector inspection as authorization to write locally unless
the owner scoped execution in the same pass.
```
