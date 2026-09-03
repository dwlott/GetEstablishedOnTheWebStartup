<!--
IndexTitle: New Commission Site Checklist
IndexDescription: Owner and agent checklist for bootstrapping a new local WordPress site from this starter (not GEOTW product showcase).
IndexType: Capability
CapabilityName: WordPressWebsite
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-07-24
-->

# New Commission Site Checklist

Use when adopting this starter for a **new business site** — not when maintaining
the GetEstablishedOnTheWeb product showcase.

Route through **WordPressWebsite** first; delegate steps to child Capabilities.

## Phase 0 — Adopt and configure

| Step | Owner / agent action | File or Capability |
| --- | --- | --- |
| 0.1 | Copy starter **without** `.git` — `Automation/Copy-StartupToProject.ps1 -DestinationName YourProject` (or Explorer copy then delete `.git`) | Local project folder |
| 0.2 | Run Quick Startup; capture Owner Goals | **GettingStarted** |
| 0.3 | Set `siteKey`, `localUrl`, `tablePrefix` (lowercase random, e.g. `m7k_`) | `Workspace/LocalWordPressBuild/site-manifest.json` |
| 0.4 | Match WAMP folder and Dropbox site key | `Automation/MirrorWebAssets/WebAssetsSites.json` |
| 0.5 | Match theme save targets | `Automation/WordPressSave/ThemeTrackManifest.json` |
| 0.6 | Record WAMP root and mirror paths | `Workspace/OwnerPreferences.md` |
| 0.7 | Copy deploy profile template → `{SiteKey}.md`; fill Bluehost/local fields | `Workspace/SiteDeployProfiles/_TEMPLATE.md` |
| 0.8 | Optional: mailbox / forwarder / Thunderbird plan | **CPanelEmail** |

## Phase 1 — Local stack + WordPress install

| Step | Action | Reference |
| --- | --- | --- |
| 1.0 | **Optional — offer:** Install **WampServer** (Windows) or **MAMP** (macOS) if the owner wants stack help or has no local server yet. Skip when already installed and running. | [WampServerAndMampSetup.md](WampServerAndMampSetup.md) |
| 1.1 | Fresh WordPress on the local stack (Genesis + Altitude child) | [LocalWordPressSetupPlan.md](../../Plans/LocalWordPressSetupPlan.md) |
| 1.2 | Use **lowercase** table prefix at install (3–4 chars + `_`) | Install screen |
| 1.3 | Confirm site loads at `{localUrl}` | Browser |
| 1.4 | Record `WAMP_WWW_ROOT` / MAMP htdocs + ports in OwnerPreferences (if not already set) | `Workspace/OwnerPreferences.md` |
| 1.5 | Optional: restore uploads/theme from Dropbox | **MirrorWebAssets** |

At Phase 1 start, **offer** step 1.0 once (do not force it). Example: “Local stack: install/migrate WampServer or MAMP now, or skip if yours is already running?”

## Phase 2 — Replace GEOTW example content (required for commission sites)

The starter ships **GEOTW showcase** manifests and pages. Replace before build:

| Artifact | Action |
| --- | --- |
| `Content/Website/Pages/` | Draft owner's pages (or use **OnePageWebsite** → adapt) |
| `content-manifest.php` | Trim to owner's categories/archives, or empty arrays |
| `nav-menu-manifest.php` | Owner nav tree (Services, About, Contact — not Get Listed / Use AI) |
| `page-layout-manifest.php` | Owner page slugs only; every page uses intro stack (**Photo → Hero → Body → Pitch**, `intro_paragraphs` => 2) |
| `Workspace/SiteDeployProfiles/` | Keep `{SiteKey}.md`; do not leave product-only profiles |

Do **not** run a full build until manifests match the owner's site map.
Do **not** copy another customer's commissioned theme Cap (AltitudeProOverlay)
into this starter — promote that Cap on the project repo after adopt (see
HighAltitudeThemeMethod).

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
| 5.2 | Run WordPress Save | **WordPressSave** → `Save-LocalWordPress.ps1` |
| 5.3 | Commit Git changes when owner asks | **GitHubWorkflow** |

## Phase 6 — Production (later, owner-approved)

| Step | Action | Reference |
| --- | --- | --- |
| 6.1 | Fill/confirm deploy profile | `Workspace/SiteDeployProfiles/{SiteKey}.md` |
| 6.2 | Bluehost-ready SQL export | `Automation/BluehostDatabasePrep/` |
| 6.3 | First go-live vs re-push of live site | [WordPressMigrationCapabilityPlan.md](../../Plans/WordPressMigrationCapabilityPlan.md) |
| 6.4 | If live site already has data: **back up production** before import | Path A re-push |
| 6.5 | Import SQL; copy theme + uploads; Permalinks; smoke-test | Owner build-pass |
| 6.6 | DNS, CF7, analytics | Out of scope until build-pass |

## Disambiguation

| Situation | Route |
| --- | --- |
| New local business site | This checklist → **WordPressWebsite** |
| Sync Markdown to WordPress | **WordPressContentUpdate** |
| Theme CSS / Genesis child basics | **StudioPressGenesisChildTheme** |
| High Altitude / branded overlay CSS | Method plan → promote **AltitudeProOverlay** on project repo |
| Backup before experiment | **WordPressMigrationBackup** |
| Large uploads/theme handoff | **MirrorWebAssets** |
| WordPress Save (theme + DB + Dropbox) | **WordPressSave** |
| Bluehost mailbox / Thunderbird | **CPanelEmail** |
| GEOTW product showcase site | Use product repo, not this starter |

## Related

- [Prompt.md](Prompt.md)
- [Rules.md](Rules.md)
- [../WordPressContentUpdate/Prompt.md](../WordPressContentUpdate/Prompt.md)
- [../CPanelEmail/Prompt.md](../CPanelEmail/Prompt.md)
- [../../Plans/WordPressWebsiteCapabilityGroupPlan.md](../../Plans/WordPressWebsiteCapabilityGroupPlan.md)
- [../../Plans/WordPressMigrationCapabilityPlan.md](../../Plans/WordPressMigrationCapabilityPlan.md)
- [../../Plans/HighAltitudeThemeMethod.md](../../Plans/HighAltitudeThemeMethod.md)
