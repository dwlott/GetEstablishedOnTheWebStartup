<!-- Index: Pointer sheet for Cursor install and post-install configuration. -->
<!--
IndexTitle: Cursor Vendor Pointer Sheet
IndexDescription: Official links, local config paths, and post-install checklist for Cursor.
IndexType: Capability
CapabilityName: LocalAgentToolSetup
CapabilityVersion: 1
LastEdited: 2026-06-04
-->

# Cursor — Vendor Pointer Sheet

Repository-owned **pointers and checklists** only. For install steps, UI details, and feature lists, use **official Cursor documentation** (links below).

## Official sources

| Topic | Link | Notes |
| --- | --- | --- |
| Product and download | https://cursor.com | Use the site download flow for the user's OS |
| Documentation home | https://docs.cursor.com | Primary reference for features and settings |
| Account / plans | https://cursor.com | Sign-in and subscription per vendor site |

Refresh links in this file if the vendor changes domains. Do not mirror docs content in git.

## Local config paths

| OS | User settings | Other |
| --- | --- | --- |
| Windows | `%APPDATA%\Cursor\User\settings.json` | Keybindings: `keybindings.json` in same folder |
| macOS | `~/Library/Application Support/Cursor/User/settings.json` | Same folder pattern as VS Code family |
| Linux | `~/.config/Cursor/User/settings.json` | Confirm path if distro packages differ |

User settings live **outside** this repository. Never commit a user's `settings.json` into GetEstablished.

## Install phase (high level)

1. Confirm OS (Windows, macOS, Linux).
2. Send the user to https://cursor.com for the current installer.
3. Confirm the app launches and the user can open a folder or clone a repo.
4. **Stop claiming success at install only** — proceed to post-install configuration offer.

## Post-install checklist (configuration pass)

Offer to walk these in order. User may skip items.

- [ ] **Word wrap:** `editor.wordWrap` = `on` (see official settings docs); toggle **Alt+Z** in editor
- [ ] **Editor comfort:** optional rulers, autosave, diff wrap (user preference)
- [ ] **Open workspace:** clone or open GetEstablished (and optional US1Movers multi-root)
- [ ] **Read repository rules:** root `AGENTS.md`, then
      `Standards/AgentSituationalAwareness.md` (Cursor: no Drive mirror per pass)
- [ ] **Modes:** Ask (plan/review), Plan (structured plan), Agent (worker edits), Debug — modes do not auto-switch; say the mode on mic when recording
- [ ] **One-window loop:** Plan → Agent (paste worker prompt or `@Plans/RunWorkerPrompt_NextBacklogTask.md`) → Ask (review handoff); see [CursorYouTubeDemoGuide.md](../../../Plans/CursorYouTubeDemoGuide.md)
- [ ] **Optional two chats:** same window, New Chat for Planner vs Worker — clearer on YouTube, not required
- [ ] **No Drive mirror** per pass in Cursor unless user explicitly syncs for ChatGPT review
- [ ] **ChatGPT split-stack:** GoogleDriveLink assisted workflow only when ChatGPT plans without local repo access
- [ ] **Permissions:** [AgentSandboxAndPermissions.md](../AgentSandboxAndPermissions.md)
- [ ] **Backlog shortcut:** [RunWorkerPrompt_NextBacklogTask.md](../../../Plans/RunWorkerPrompt_NextBacklogTask.md)
- [ ] **Handoff line length:** ~72 characters in fenced handoffs per `AGENTS.md`

## Optional settings keys (reference only)

When the user asks for recommendations, these keys are commonly helpful (not a full file mirror):

- `editor.wordWrap`: `"on"`
- `diffEditor.wordWrap`: `"on"`
- `workbench.editor.enablePreview`: `false` (if user prefers tabs to stay open)
- `workbench.editor.wrapTabs`: `true` (multi-root workspaces)

Produce full JSON in a **copy-ready fenced block** when asked. Offer to write the live file only after explicit approval.

## GEOTW repository hooks

- Multi-repo example: see US1Movers `Docs/Setup/ParentWorkflowLink.md` and `Planning/CursorWorkspaceForGetEstablishedAndUS1Movers.md` in that repo when both roots are used.
- This repository does not store the user's Cursor user settings.

## Recording / YouTube

- Short script: [OneWindowCursorDemoScript.md](../../../Plans/OneWindowCursorDemoScript.md)
- Full guide: [CursorYouTubeDemoGuide.md](../../../Plans/CursorYouTubeDemoGuide.md)

## Related

- [LocalAgentToolSetup Prompt.md](../Prompt.md)
- [LocalAgentToolSetup Rules.md](../Rules.md)
- [AgentSituationalAwareness.md](../../../Standards/AgentSituationalAwareness.md)
