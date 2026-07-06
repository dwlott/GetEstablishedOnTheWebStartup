<!--
IndexTitle: RepositoryScaffold Rules
IndexDescription: Core scaffold boundaries and on-demand Capability provisioning rules.
IndexType: Capability
CapabilityName: RepositoryScaffold
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-06
-->

# RepositoryScaffold Rules

Read [Standards/CapabilityProvisionedStructure.md](../../Standards/CapabilityProvisionedStructure.md) before creating folders.

## Core Scaffold (May Exist On Day One)

These paths are **not** Capability-provisioned in the consumer starter:

```text
AGENTS.md
README.md
Capabilities/          <- core Capability folders with real files (not empty stubs)
Standards/
Plans/                 <- consumer setup plans only
Ideas/README.md
Content/Website/Pages/ <- starter website drafts (product content)
Workspace/
  README.md
  OwnerGoals.md
  OwnerPreferences.md
```

**RepositoryScaffold SetupPrompt.md** may create or repair **only** the
`Workspace/` boot files above — not Capability-owned trees.

## Capability Scaffold (On Demand Only)

Do **not** create these until the listed Capability **SetupPrompt** runs in session:

| Path pattern | Provisioner |
| --- | --- |
| `Inbox/**` | EmailIntake, ScanIntake (commissioned) or future intake Capabilities |
| `Indexes/**` | Indexing SetupPrompt |
| `Content/OnePageBusinessWebsite/**` | OnePageWebsite / business one-page workflow when adopted |
| `Workspace/Assets`, `Drafts`, `Inbox`, etc. | Owner adds when real files exist + folder README |

## Agent Behavior

1. **Never** `mkdir` Capability-owned paths during unrelated edits.
2. If structure is missing and the user only asked to operate → offer Setup once; do not mkdir.
3. If the user asked to set up → run the owning Capability **SetupPrompt.md**.
4. If the user asked "what folders should I have?" → show
   [IntendedRepositoryTree.md](IntendedRepositoryTree.md); recommend **one** next Setup.
5. **Workspace tidy:** do not pre-create empty child folders with `.gitkeep` in consumer repos.

## Distinction From Other Capabilities

| Capability | Role |
| --- | --- |
| **StarterRepositoryPackage** | Host-only repair pass → consumer starter ZIP tree |
| **RepositoryInitialize** | Bootstrap new empty GitHub repo (host/archetype spawn path) |
| **GitHubWorkflow** | Create GitHub repo then Initialize |
| **RepositoryScaffold** | Consumer-side core repair + growth map + Setup routing |

## Related

- [README.md](README.md)
- [Prompt.md](Prompt.md)
- [SetupPrompt.md](SetupPrompt.md)
- [IntendedRepositoryTree.md](IntendedRepositoryTree.md)
