# WordPressWebsite Rules

## Scope

**Parent router** for local WordPress bootstrap in GetEstablishedOnTheWebStartup.

In scope:

- New commission site configuration (manifests, WAMP mapping, checklist)
- WampServer (Windows) / MAMP (macOS) stack install routing via
  [WampServerAndMampSetup.md](WampServerAndMampSetup.md)
- Routing to child Capabilities (ContentUpdate, MigrationBackup, ChildTheme, MirrorWebAssets)
- Safety gates before `--write` builds

Out of scope unless owner approves:

- Production launch, DNS, CF7, analytics
- Running full GEOTW product showcase sync (capability catalog, offer hubs, messaging)
- Inventing business facts, pricing, or legal claims

## Before any pass

1. Read [NewCommissionSiteChecklist.md](NewCommissionSiteChecklist.md).
2. **Offer** (do not force) [WampServerAndMampSetup.md](WampServerAndMampSetup.md)
   when the stack may be missing or the owner asks about install/migration.
3. Read `Workspace/LocalWordPressBuild/site-manifest.json`.
4. Confirm whether this is a **commission site** or mistaken product-showcase work.
5. Route child Capabilities; do not duplicate their scripts here.

## Table prefix

Use a **lowercase** random prefix at WordPress install (3–4 characters + `_`,
for example `m7k_`). Record in `site-manifest.json`.

## Related

- [Prompt.md](Prompt.md)
- [WorkflowIndex.md](WorkflowIndex.md)
- [NewCommissionSiteChecklist.md](NewCommissionSiteChecklist.md)
- [WampServerAndMampSetup.md](WampServerAndMampSetup.md)
