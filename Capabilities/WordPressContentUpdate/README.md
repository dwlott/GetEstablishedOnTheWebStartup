<!--
IndexTitle: WordPressContentUpdate Capability
IndexDescription: Sync Markdown and manifests into local WordPress when owner approves a build pass.
IndexType: Capability
CapabilityName: WordPressContentUpdate
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-07-07
-->

# WordPressContentUpdate Capability

- **Version:** 2
- **Tier:** Archetype
- **Purpose:** Gate and run Markdown/manifest sync via starter `ges-*` scripts.
- **WhenToUse:** Owner approves syncing repo content into local WAMP WordPress.

## Start Here

[../WordPressWebsite/NewCommissionSiteChecklist.md](../WordPressWebsite/NewCommissionSiteChecklist.md) (phases 2–4)

→ [WorkflowIndex.md](WorkflowIndex.md) → [Rules.md](Rules.md) → [Prompt.md](Prompt.md)

## Starter script set

Use `ges-build.php --only=` with: `ges-theme-css-sync`, `ges-content-setup`,
`ges-nav-menu-sync`, and optionally `ges-front-page-sync`.

## Stop Conditions

- Backup required before destructive or `--write` passes.
- Manifests must match owner site, not GEOTW product showcase defaults.
