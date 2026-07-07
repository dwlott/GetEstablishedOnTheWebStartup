<!--
IndexTitle: New Commission Site Checklist
IndexDescription: Owner and agent checklist for bootstrapping a new local WordPress site from this starter (not GEOTW product showcase).
IndexType: Capability
CapabilityName: WordPressWebsite
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-07-07
-->

# New Commission Site Checklist

Use when adopting this starter for a **new business site** (for example Dan's Repair
Service) — not when maintaining the GetEstablishedOnTheWeb product showcase.

Route through **WordPressWebsite** first; delegate steps to child Capabilities.

## Phase 0 — Adopt and configure

| Step | Owner / agent action | File or Capability |
| --- | --- | --- |
| 0.1 | Clone or copy this starter; rename folder to the project | Local Git root |
| 0.2 | Run Quick Startup; capture Owner Goals | **GettingStarted** |
| 0.3 | Set `siteKey`, `localUrl`, `tablePrefix` (lowercase random, e.g. `m7k_`) | `Workspace/LocalWordPressBuild/site-manifest.json` |
| 0.4 | Match WAMP folder and Dropbox site key | `Automation/MirrorWebAssets/WebAssetsSites.json` |
| 0.5 | Match theme save targets | `Automation/WordPressSave/ThemeTrackManifest.json` |
| 0.6 | Record WAMP root and mirror paths | `Workspace/OwnerPreferences.md` |

## Phase 1 — WAMP install

| Step | Action | Reference |
| --- | --- | --- |
| 1.1 | Fresh WordPress on WAMP (Genesis + Altitude child) | [LocalWordPressSetupPlan.md](../../Plans/LocalWordPressSetupPlan.md) |
| 1.2 | Use **lowercase** table prefix at install (3–4 chars + `_`) | Install screen |
| 1.3 | Confirm site loads at `{localUrl}` | Browser |
| 1.4 | Optional: restore uploads/theme from Dropbox | **MirrorWebAssets** |

## Phase 2 — Replace GEOTW example content (required for commission sites)

The starter ships **GEOTW showcase** manifests and pages. Replace before build:

| Artifact | Action |
| --- | --- |
| `Content/Website/Pages/` | Draft owner's pages (or use **OnePageWebsite** → adapt) |
| `content-manifest.php` | Trim to owner's categories/archives, or empty arrays |
| `nav-menu-manifest.php` | Owner nav tree (Services, About, Contact — not Get Listed / Use AI) |
| `page-layout-manifest.php` | Owner page slugs only |
| `Workspace/SiteDeployProfiles/` | Add `{SiteKey}.md`; remove product-only profiles if confusing |

Do **not** run a full build until manifests match the owner's site map.

## Phase 3 — Backup gate (before any write)

| Step | Action | Capability |
| --- | --- | --- |
| 3.1 | Export DB snapshot | **WordPressMigrationBackup** |
| 3.2 | Optional: MirrorWebAssets backup | **MirrorWebAssets** |
| 3.3 | Owner approves `--write` pass | **WordPressContentUpdate** |

## Phase 4 — Minimal build (starter scripts on disk)

Only these sync scripts ship in the starter package:

```text
ges-theme-css-sync.php
ges-content-setup.php
ges-front-page-sync.php   (optional — Altitude front-page widgets)
ges-nav-menu-sync.php
```

**Minimal orchestrator** (dry-run first, no `--write` until approved):

```powershell
cd Workspace\LocalWordPressBuild
php ges-build.php --only=ges-theme-css-sync,ges-content-setup,ges-nav-menu-sync
```

Add `ges-front-page-sync` when front-page Markdown sections exist under
`Content/Website/Pages/FrontPage/`.

Full `ges-build.php` without `--only` references **product-only** steps not
shipped in this starter — always use `--only` until a product sync pack is added.

## Phase 5 — Save and iterate

| Step | Action |
| --- | --- |
| 5.1 | Edit in wp-admin / Customizer as needed |
| 5.2 | Run WordPress Save | `Automation/WordPressSave/Save-LocalWordPress.ps1` |
| 5.3 | Commit Git changes when owner asks | **GitHubWorkflow** |

## Phase 6 — Production (later, owner-approved)

| Step | Action |
| --- | --- |
| 6.1 | Bluehost-ready SQL export | `Automation/BluehostDatabasePrep/` |
| 6.2 | DNS, CF7, analytics | Out of scope until build-pass |

## Disambiguation

| Situation | Route |
| --- | --- |
| New local business site | This checklist → **WordPressWebsite** |
| Sync Markdown to WordPress | **WordPressContentUpdate** |
| Theme CSS / Altitude overlay | **StudioPressGenesisChildTheme** |
| Backup before experiment | **WordPressMigrationBackup** |
| Large uploads/theme handoff | **MirrorWebAssets** |
| GEOTW product showcase site | Use product repo, not this starter |

## Related

- [Prompt.md](Prompt.md)
- [Rules.md](Rules.md)
- [../WordPressContentUpdate/Prompt.md](../WordPressContentUpdate/Prompt.md)
- [../../Plans/WordPressWebsiteCapabilityGroupPlan.md](../../Plans/WordPressWebsiteCapabilityGroupPlan.md)
