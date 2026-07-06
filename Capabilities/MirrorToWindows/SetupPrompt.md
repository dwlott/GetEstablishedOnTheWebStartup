<!--
IndexTitle: MirrorToWindows Setup Prompt
IndexDescription: First-time Windows mirror setup for consumer starter.
IndexType: Capability
CapabilityName: MirrorToWindows
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-12
-->

# MirrorToWindows Setup Prompt

```text
# Worker pass: MirrorToWindows Setup (consumer starter)

Read first:
- AGENTS.md
- Workspace/OwnerPreferences.md
- Capabilities/MirrorToWindows/Rules.md
- Standards/RepositoryMirrorStandard.md

Goal:
Discover local source and mirror target on Windows; confirm purpose; write
OwnerPreferences § Connectors with owner approval.

Explain briefly:
- Local Git = SoT; GitHub = version backup.
- Mirror target = any folder (Dropbox, GDrive Desktop, D:\Backup\, etc.).
- Purpose: review | backup | portability — controls Robocopy /MIR vs /E.
- This starter ships docs-only — manual Robocopy or copy unless owner adopts host automation.

Write rows: Local repository root, Mirror target path, Mirror platform=Windows,
Mirror purpose, Purge on mirror, Include .git, Mirror mode=on-demand,
Last mirror refresh.

Optional first mirror: offer manual apply per MirrorWorkflow.md.

End handoff: Summary, paths written, first mirror (yes/no/deferred).
```
