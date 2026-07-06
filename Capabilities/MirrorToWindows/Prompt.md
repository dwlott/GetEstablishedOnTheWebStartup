<!--
IndexTitle: MirrorToWindows Prompt
IndexDescription: Copy-ready worker prompt for Windows mirror refresh in consumer starter.
IndexType: Capability
CapabilityName: MirrorToWindows
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-12
-->

# MirrorToWindows Prompt

```text
# Worker pass: MirrorToWindows refresh (consumer starter)

Read first:
- AGENTS.md
- Workspace/OwnerPreferences.md (Connectors)
- Capabilities/MirrorToWindows/WorkflowIndex.md
- Standards/RepositoryMirrorStandard.md

Goal:
Refresh repository mirror on explicit owner request (Windows target path).

If paths unset → SetupPrompt.md.
Confirm purpose and purge before apply.
Apply per MirrorWorkflow.md (manual / Robocopy — docs-only starter).
Update Last mirror refresh on success.
Report Windows Mirror block from MirrorWorkflow Step 4.
```
