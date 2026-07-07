# WordPressWebsite Prompt

Read [Rules.md](Rules.md) and [NewCommissionSiteChecklist.md](NewCommissionSiteChecklist.md) first.

## When to use

- Bootstrapping a **new local WordPress site** from this starter
- Configuring `site-manifest.json` and related manifests
- Routing WordPress work to the correct child Capability

## Worker pass

```text
# Worker pass: WordPressWebsite

Read first:
- Capabilities/WordPressWebsite/NewCommissionSiteChecklist.md
- Workspace/LocalWordPressBuild/site-manifest.json
- Plans/LocalWordPressSetupPlan.md

Goal: Configure or advance local WordPress bootstrap for {siteKey}.

Checklist (report pass/fail per row):
[ ] site-manifest.json filled (siteKey, localUrl, tablePrefix lowercase)
[ ] WebAssetsSites.json + ThemeTrackManifest.json match siteKey
[ ] WAMP install complete and site loads
[ ] GEOTW showcase manifests replaced or trimmed for owner site map
[ ] Backup taken if --write build requested (WordPressMigrationBackup)
[ ] Build uses ges-build.php --only= (starter script set only)

Route child work:
- Backup → WordPressMigrationBackup
- ges-build / Markdown sync → WordPressContentUpdate
- Theme CSS / Altitude → StudioPressGenesisChildTheme
- Dropbox uploads/theme → MirrorWebAssets

Stop: no --write, DNS, CF7, analytics, or launch without owner approval.

Handoff: Summary, checklist status, files to review, next step.
```
