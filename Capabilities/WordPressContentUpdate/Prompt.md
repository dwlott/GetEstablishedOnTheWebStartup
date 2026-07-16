<!--
IndexTitle: WordPressContentUpdate Prompt
IndexDescription: How to sync approved Markdown and manifests into local WordPress from this starter.
IndexType: Capability
CapabilityName: WordPressContentUpdate
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-07-16
-->

# WordPressContentUpdate Prompt

Read [Rules.md](Rules.md) first. Parent checklist:
[../WordPressWebsite/NewCommissionSiteChecklist.md](../WordPressWebsite/NewCommissionSiteChecklist.md).

## When to use

- Sync approved Markdown or manifests into local WordPress
- Run `ges-build.php` (dry-run or owner-approved `--write`)
- Adapt `content-manifest.php`, `nav-menu-manifest.php`, `page-layout-manifest.php`
- Create or update pages/posts with the intro stack

## Pre-flight (required)

1. **WordPressMigrationBackup** completed if pass includes `--write`.
2. Manifests trimmed for owner site — not GEOTW showcase slugs (Get Listed, Capabilities, etc.).
3. Pages exist under `Content/Website/Pages/` for slugs referenced in manifests.
4. Every page/post follows the intro stack in [Rules.md](Rules.md):
   (**Intro Photo → Intro Hero → Intro Body → Intro Pitch**) —
   `page-layout-manifest.php` + two lead/deck Markdown paragraphs + pitch;
   Genesis title hidden; visible title is `h1.ges-page-title`.

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

Report: scripts run, exit codes, `{localUrl}` verification, manifest files changed,
intro-stack compliance, next step.
