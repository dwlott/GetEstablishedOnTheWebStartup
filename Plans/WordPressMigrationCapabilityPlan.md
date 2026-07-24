<!--
IndexTitle: WordPress Migration Capability Plan
IndexDescription: Path A full DB clone and Path A re-push for Bluehost — ops plan for new projects from this starter.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-07-24
-->

# WordPress Migration Capability Plan

Starter-safe ops plan learned from commissioned go-lives (US1 Movers first
push; DansRepairService Bluehost prep pattern). Does not author a full
`WordPressSiteMigration` Capability yet — use with
[SiteDeployProfiles/_TEMPLATE.md](../Workspace/SiteDeployProfiles/_TEMPLATE.md)
and [Automation/BluehostDatabasePrep/](../Automation/BluehostDatabasePrep/).

## Path A — Full database clone (first go-live)

Use when production DB is **empty/new** and local WAMP is source of truth.

1. Align **local and production table prefix** (all-lowercase; see
   [LowercaseTablePrefixPolicy.md](LowercaseTablePrefixPolicy.md)).
2. Fill `Workspace/SiteDeployProfiles/{SiteKey}.md` from `_TEMPLATE.md`.
3. Export Bluehost-ready SQL via `Export-BluehostReadyDatabase.ps1` (rewrites
   local URL → public URL).
4. Import into the selected Bluehost database (no `CREATE DATABASE` in dump).
5. Wire production `wp-config.php` (credentials + single `$table_prefix`).
6. Upload WordPress files / copy theme + uploads as needed.
7. Re-save Permalinks; serialization-safe URL cleanup if anything remains;
   flush caches; smoke-test.

**Gotcha:** `$table_prefix` is a PHP variable — the **last** assignment wins.
Duplicate lines cause the “famous five-minute install” on a populated DB.

## Path A re-push (live site already exists)

Use when local is source of truth again and production already has a working
site. **Owner build-pass required.**

1. Approve localhost.
2. **Back up production** SQL outside Git.
3. Prep local SQL with BluehostDatabasePrep (same prefix).
4. Import to production (overwrites tables).
5. Copy theme + needed uploads.
6. Verify prefix, Permalinks, caches, forms, images.

Full overwrite can destroy live form entries / users that exist only on
Bluehost. Prefer canceling if unique production data was not merged into local.

## Path B — WXR content-only (investigating)

Native Tools → Export / Import for posts and pages only. Does not move settings,
plugins, theme, or widgets. Validate before encoding as a Capability.

## Related

- [NewCommissionSiteChecklist.md](../Capabilities/WordPressWebsite/NewCommissionSiteChecklist.md)
- [LocalWordPressSetupPlan.md](LocalWordPressSetupPlan.md)
- [WordPressWebsiteCapabilityGroupPlan.md](WordPressWebsiteCapabilityGroupPlan.md)
