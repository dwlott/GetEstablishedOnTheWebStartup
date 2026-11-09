<!--
IndexTitle: WordPressContentUpdate Prompt
IndexDescription: How to sync approved Markdown and manifests into local WordPress from this starter.
IndexType: Capability
CapabilityName: WordPressContentUpdate
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-11-09
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

Follow [the execution contract](../../Workspace/LocalWordPressBuild/README.md).
Configure the adopted site manifest and target first. Default steps are CSS,
content and navigation; product-only scripts are never selected.

```powershell
cd Workspace/LocalWordPressBuild
php ges-build.php --plan
```

This is a static preview: no WordPress bootstrap, PHP manifest execution, or
file/database writes. After owner approval and the required backups:

```powershell
php ges-build.php --write
```

Use `--only` for a subset. Add optional `ges-front-page-sync` only after configuring
its front-page manifest and Markdown. Every direct child also defaults to plan.
Failures stop the runner; previous successful steps are not rolled back.

## Worker handoff

Report: scripts run, exit codes, `{localUrl}` verification, manifest files changed,
intro-stack compliance, next step.
