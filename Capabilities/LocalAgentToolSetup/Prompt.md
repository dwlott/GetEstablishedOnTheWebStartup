<!--
IndexTitle: LocalAgentToolSetup Prompt
IndexDescription: Copy-ready prompt for vendor local agent install and post-install configuration.
IndexType: Capability
CapabilityName: LocalAgentToolSetup
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-05-29
-->

# LocalAgentToolSetup Prompt

Read [Rules.md](Rules.md) and [VendorToolIndex.md](VendorToolIndex.md) before using the block below.

```text
# Worker or planning pass: LocalAgentToolSetup

Repository: GetEstablished (paths may reference related repos in workspace)
Branch: main

Read AGENTS.md Capability Discovery, then:
- Capabilities/LocalAgentToolSetup/Rules.md
- Capabilities/LocalAgentToolSetup/VendorToolIndex.md
- The matching Capabilities/LocalAgentToolSetup/Vendors/<Vendor>.md

Goal:
Help the user install and configure a local vendor agent application without duplicating vendor documentation in chat or repository files.

Steps:

1. Identify the vendor from the user message (examples: Cursor, Codex, Claude Code).
   If unclear, ask once which application they mean.

2. Open VendorToolIndex.md. If the vendor is Planned or missing, say so and offer Cursor if appropriate.

3. Open the vendor pointer sheet. Use official doc links from that sheet for install facts.
   Do not invent download URLs or feature claims.

4. Install phase:
   - State OS assumptions and confirm with the user if needed.
   - Point to official install/download (pointer sheet links).
   - Confirm the app launches; do not end the task here.

5. Mandatory transition (say explicitly):
   "Install is not the end. I can help with a configuration pass next."

6. Configuration phase:
   - Walk the post-install checklist on the pointer sheet item by item.
   - For settings files: provide a copy-ready fenced block first (json or other).
   - Offer to apply changes to the live user config file only if the user approves in this session.
   - Never commit user settings into GetEstablished.

7. GEOTW hooks (only if relevant):
   - Opening this repository or a multi-root workspace.
   - AGENTS.md, AgentSandboxAndPermissions.md, planner/worker workflow.

Stop conditions:
- Sandbox or permission concerns: Capabilities/LocalAgentToolSetup/AgentSandboxAndPermissions.md
- Unrelated software, credentials, or Full Access without clear user intent

If you changed repository files, end with exactly one fenced text handoff block:
Summary, Files Changed, Planning Files To Review,
Questions Added Or Changed, Next Recommended Task.
Use ~72 characters per line; one path per line under Files Changed.
```

## Prompt history

- **2026-05-29 (v1):** Initial LocalAgentToolSetup prompt with index-first routing and install-not-end rule.
