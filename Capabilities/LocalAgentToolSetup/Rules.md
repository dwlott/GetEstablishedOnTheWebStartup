<!--
IndexTitle: LocalAgentToolSetup Rules
IndexDescription: Durable constraints for vendor local agent install and configuration workflows.
IndexType: Capability
CapabilityName: LocalAgentToolSetup
CapabilityVersion: 1
LastEdited: 2026-05-29
-->

# LocalAgentToolSetup Rules

Read before running [Prompt.md](Prompt.md).

## Index-first

1. Open [VendorToolIndex.md](VendorToolIndex.md).
2. Open the matching `Vendors/<Vendor>.md` pointer sheet.
3. Do not improvise install steps when a vendor row exists.

## Install is not the end

After install guidance, always offer a **configuration pass** using the vendor post-install checklist. Do not treat "download finished" or "app opens" as task complete.

## Official docs for facts

- Install URLs, licensing, feature names, and version-specific UI: use links on the pointer sheet.
- Do not paste or mirror full vendor documentation into the repository or chat.
- If official docs conflict with a pointer sheet, prefer official docs and note the sheet may need a refresh.

## Configuration file policy

- Default: provide a **copy-ready** config snippet (for example JSON for `settings.json`).
- Also **offer** to apply edits to the user's live config file in the same session.
- Edit live user config **only** when the user explicitly approves in that session.
- Never commit the user's `settings.json` or other machine-local config into GetEstablished.

## Stop conditions

- No unrelated software installs.
- No passwords, API keys, or tokens in repository files or chat.
- Pause for human review on Full Access, system-wide changes, or destructive commands.
- Follow [AgentSandboxAndPermissions.md](AgentSandboxAndPermissions.md) for sandbox and permission prompts.

## Handoffs

Worker passes that change repository files end with one fenced `text` handoff per `AGENTS.md`, with lines about **72 characters** or fewer.

## Adding a vendor

1. Add a row to [VendorToolIndex.md](VendorToolIndex.md).
2. Add `Vendors/<Vendor>.md` using the Cursor sheet as a template.
3. Append Capability Changelog in this folder README.
4. Update [AgentCapabilityGuide.md](../AgentCapabilityGuide.md) intent keywords if needed.
