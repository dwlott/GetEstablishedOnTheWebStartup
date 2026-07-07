# WordPressContentUpdate Prompt

Read [Rules.md](Rules.md) first. Parent checklist:
[../WordPressWebsite/NewCommissionSiteChecklist.md](../WordPressWebsite/NewCommissionSiteChecklist.md).

## When to use

- Sync approved Markdown or manifests into local WordPress
- Run `ges-build.php` (dry-run or owner-approved `--write`)
- Adapt `content-manifest.php`, `nav-menu-manifest.php`, `page-layout-manifest.php`

## Pre-flight (required)

1. **WordPressMigrationBackup** completed if pass includes `--write`.
2. Manifests trimmed for owner site — not GEOTW showcase slugs (Get Listed, Capabilities, etc.).
3. Pages exist under `Content/Website/Pages/` for slugs referenced in manifests.

## Starter build commands

Scripts shipped in this starter:

```text
ges-theme-css-sync.php
ges-content-setup.php
ges-front-page-sync.php
ges-nav-menu-sync.php
```

**Dry-run (no DB writes from orchestrator — verify each script's own flags):**

```powershell
cd Workspace\LocalWordPressBuild
php ges-build.php --only=ges-theme-css-sync,ges-content-setup,ges-nav-menu-sync
```

**With front-page sections:**

```powershell
php ges-build.php --only=ges-theme-css-sync,ges-content-setup,ges-front-page-sync,ges-nav-menu-sync
```

Do **not** run full `ges-build.php` without `--only` — product-only steps are not in this package.

## Worker handoff

Report: scripts run, exit codes, `{localUrl}` verification, manifest files changed, next step.
