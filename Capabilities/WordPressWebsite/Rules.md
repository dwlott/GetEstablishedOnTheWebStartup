# WordPressWebsite Rules

## Scope

**Parent router** for local WordPress bootstrap in GetEstablishedOnTheWebStartup.

In scope:

- New commission site configuration (manifests, WAMP mapping, checklist)
- Routing to child Capabilities (ContentUpdate, MigrationBackup, ChildTheme, MirrorWebAssets)
- Safety gates before `--write` builds

Out of scope unless owner approves:

- Production launch, DNS, CF7, analytics
- Running full GEOTW product showcase sync (capability catalog, offer hubs, messaging)
- Inventing business facts, pricing, or legal claims

## Before any pass

1. Read [NewCommissionSiteChecklist.md](NewCommissionSiteChecklist.md).
2. Read `Workspace/LocalWordPressBuild/site-manifest.json`.
3. Confirm whether this is a **commission site** or mistaken product-showcase work.
4. Route child Capabilities; do not duplicate their scripts here.

## Table prefix

Use a **lowercase** random prefix at WordPress install (3–4 characters + `_`,
for example `m7k_`). Record in `site-manifest.json`.

## Related

- [Prompt.md](Prompt.md)
- [WorkflowIndex.md](WorkflowIndex.md)
- [NewCommissionSiteChecklist.md](NewCommissionSiteChecklist.md)
