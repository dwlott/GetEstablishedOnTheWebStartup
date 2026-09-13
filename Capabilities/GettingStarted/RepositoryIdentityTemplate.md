<!--
IndexTitle: Repository Identity Template
IndexDescription: Durable identity record and mode rules for the canonical template and adopted project copies.
IndexType: Capability
CapabilityName: GettingStarted
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-09-13
-->

# Repository Identity Template

## Identity Modes

| Mode | Meaning | Required behavior |
| --- | --- | --- |
| canonical-template | The GetEstablishedOnTheWebStartup repository itself | Preserve Startup identity; never run adopted cleanup |
| product | The GetEstablishedOnTheWeb product repository | Preserve product identity; package the Startup intentionally |
| adopted-project | A project created from the Startup repository | Use the owner's project identity in active boot instructions |

Folder names are clues only. Confirm the mode from the open repository root,
Git remote when available, and this identity record. A Startup or product
remote in a noncanonical root is a stale binding, not proof of canonical mode.

## Adopted Project Record

Create this file only for an adopted project:

    # Repository Identity

    Repository name: <owner-confirmed project name>
    Repository role: adopted project
    Local root: <verified path>
    Git remote: <verified URL or none>
    Branch: <verified branch>
    Source of truth: local Git repository
    Created from: GetEstablishedOnTheWebStartup
    Identity mode: adopted-project

Do not fill this record with guessed owner or repository information.

## Rewrite Boundary

Adopted cleanup may rewrite active boot, registry, routing, and workspace
identity surfaces. It must not perform a blind repository-wide replacement.
References to the source template, product packaging, historical work, or
related repositories may remain when their purpose is clear.

## Related

- GettingStarted.md
- Prompt.md
- Rules.md
- WorkspaceAdoptionPrep.md
- PostQuickStartupRouting.md
