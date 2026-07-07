# WordPressContentUpdate Rules

## Scope

Markdown and manifest sync into local WordPress via `Workspace/LocalWordPressBuild/ges-*.php`.

In scope:

- Editing manifests for the **owner's** site map
- Running starter sync scripts with `--only`
- Dry-run before owner-approved write passes

Out of scope:

- Full GEOTW product sync (capability catalog, offer hubs, messaging) — scripts not shipped
- `--write` without **WordPressMigrationBackup** first
- Production deploy

## Manifest edit rules

| File | Commission site |
| --- | --- |
| `content-manifest.php` | Owner categories/archives only; remove showcase/MoverCalcs rows |
| `nav-menu-manifest.php` | Owner nav; remove Get Listed / Use AI unless owner wants them |
| `page-layout-manifest.php` | Slugs that exist in `Content/Website/Pages/` |

## Related

- [Prompt.md](Prompt.md)
- [../WordPressWebsite/NewCommissionSiteChecklist.md](../WordPressWebsite/NewCommissionSiteChecklist.md)
