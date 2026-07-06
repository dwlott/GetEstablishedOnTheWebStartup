<!-- Index: Route vendor install and config requests to pointer sheets. -->
<!--
IndexTitle: Vendor Tool Index
IndexDescription: Routing table for LocalAgentToolSetup vendor pointer sheets.
IndexType: Capability
CapabilityName: LocalAgentToolSetup
CapabilityVersion: 1
LastEdited: 2026-05-29
-->

# Vendor Tool Index

**Read this file first** for any LocalAgentToolSetup task. Then open the pointer sheet in `Vendors/`.

| Vendor | Status | Intent keywords (examples) | Pointer sheet | Config paths (summary) |
| --- | --- | --- | --- | --- |
| Cursor | Active | install cursor; cursor settings; word wrap; cursor config; set up cursor | [Vendors/Cursor.md](Vendors/Cursor.md) | Windows: `%APPDATA%\Cursor\User\settings.json` |
| CodexCLI | Planned | codex cli; openai codex terminal | TBD | TBD |
| ClaudeCode | Active | claude code; anthropic cli; claude memory; claude profile | [Vendors/ClaudeCode.md](Vendors/ClaudeCode.md) | Windows: `%USERPROFILE%\.claude\projects\` |

## Agent Notes

- **Active:** run [Prompt.md](Prompt.md) after reading the pointer sheet.
- **Planned:** tell the user the vendor is not indexed yet; offer Cursor sheet or ask which tool they mean.
- Refresh official doc URLs on the pointer sheet when links break; do not duplicate vendor manuals here.
