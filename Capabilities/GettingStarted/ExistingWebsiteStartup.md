<!--
IndexTitle: Existing Website Startup
IndexDescription: Read-only orientation and owner-defined local/live boundaries for an existing website.
IndexType: Workflow
CapabilityName: GettingStarted
IndexStatus: Active
LastEdited: 2026-10-11
-->

# Existing Website Startup

Use when the first setup answer identifies an existing website. This workflow
belongs to GettingStarted and is usable even if the package lacks a specialized
maintenance Capability. It captures context; startup itself does not deploy,
import, update plugins, change products, or modify a website database.

## Short maintenance follow-up

After the five-question walkthrough, review what is already known and inspect
accessible local files read-only. Ask about only missing facts, one at a time,
and save each answer in `Workspace/OwnerPreferences.md` and the interview
checkpoint. Do not assume that a path for an existing site authorizes an import.

| Context | What to establish |
| --- | --- |
| Website | Owner-supplied live address and the immediate maintenance problem |
| Local copy | Local folder and URL, or explicit absence of a local copy |
| Platform | Observed or owner-supplied platform/tools; do not guess credentials |
| Freshness | Whether local matches live; Unknown is valid and must remain visible |
| Scope | Where agents may work and who handles live updates |
| Backup | Known backup location/status; record unverified backups as unverified |

Ask only for missing scope that changes the proposed action. If scope or
freshness remains unknown, choose a read-only diagnostic next step. Treat
local and live databases as separate authorities; never overwrite live data
with a local database just to change one product or setting.

## Select the next action

Describe a concrete step tied to the owner's first outcome, such as inspecting
the affected product or checking why an update fails. Check the local Capability
registry before naming an implementation workflow. Use a project maintenance
Capability if one exists. Otherwise prepare a small diagnostic plan within
GettingStarted and route implementation only to a present, suitable Capability.
Do not invent a missing module or use new-site bootstrap to repair an existing
site. Starter pages and build manifests are examples, not the site's content.

Before a later write pass, obtain the authorization and backup required by the
project's instructions. Record the requested change, target environment, backup,
verification, and rollback. Live actions require explicit live authorization;
if the owner handles live updates, provide manual instructions after local work.

## Owner-facing close example

```text
Your workspace is organized for maintaining the existing website.
The first priority is <owner's outcome>. Agent work is limited to <confirmed scope>.
Next: <specific inspection or other authorized action>.
Local/live freshness: <confirmed state or unknown>.
```

Use actual facts, not this example as evidence that work has been performed.

## Related

- [QuickStartupWalkthrough.md](QuickStartupWalkthrough.md)
- [PostQuickStartupRouting.md](PostQuickStartupRouting.md)
