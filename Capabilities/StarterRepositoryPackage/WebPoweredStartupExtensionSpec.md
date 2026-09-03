<!--
IndexTitle: Web-Powered Startup Extension Spec
IndexDescription: ADD matrix for generalized WordPress ops on GetEstablishedOnTheWebStartup after base WebPresence packaging.
IndexType: Capability
CapabilityName: StarterRepositoryPackage
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-09-03
-->

# Web-Powered Startup Extension Spec

Apply **after** [WebPresenceStartupRepairSpec.md](WebPresenceStartupRepairSpec.md) base packaging
into `C:\Repositories\GetEstablishedOnTheWebStartup`.

This pass adds generalized WordPress bootstrap ops proven on an existing WordPress
project and GEOTW localhost — without copying site-specific content or breaking source repos.

## Expected Outcome (extension)

| Item | Target |
| --- | --- |
| Capability folders (extension) | +6 (`MirrorWebAssets`, WordPress group ×5 incl. WordPressSave) |
| Total Capability folders | **33** (26 base + 6 extension + CPanelEmail) |
| Plans files (extension) | WordPress setup / Save / group plan (+ audit & model docs kept) |
| Total Plans files | **25** (see repair-spec whitelist; includes CrossRepoCapabilityGapMatrix) |
| `Workspace/LocalWordPressBuild/` | Present with `ges-*` scripts |
| WordPress Save | **WordPressSave** Capability + `Plans/WordPressSaveWorkflow.md` pointer + `Automation/WordPressSave/` |
| AltitudeProOverlay | **Do not add** (commissioned repos only) |
| `Workspace/Reference/WordPressGenesisOperatingGuide/` | Curated starter subset |
| Production launch | Still out of scope |

## ADD — Capability Folders

Copy or create in startup workspace:

```text
Capabilities/MirrorWebAssets/                    <- generalized from an existing WordPress project
Capabilities/WordPressWebsite/                   <- NEW starter-safe
Capabilities/WordPressContentUpdate/             <- NEW starter-safe
Capabilities/StudioPressGenesisChildTheme/       <- NEW starter-safe
Capabilities/WordPressMigrationBackup/           <- NEW starter-safe
Capabilities/WordPressSave/                      <- promoted single-site (2026-09-03)
```

Promote WordPress group to **Active** in startup registry only. GEOTW product
repo keeps Draft status until separate owner promotion.

## ADD — Automation

```text
Automation/MirrorWebAssets/                      <- generalized from an existing WordPress project
Automation/WordPressSave/                        <- generalized from an existing WordPress project
Automation/DatabaseBackups/                      <- GEOTW canonical + repair script
Automation/BluehostDatabasePrep/                 <- generalized from an existing WordPress project
Automation/LocalWordPress/WampPaths.ps1          <- generalized from an existing WordPress project
Automation/VerifyStarterPackage.ps1              <- GetEstablishedStartup + WebPresenceWordPress profile
```

Update `Automation/README.md` to list all folders above.

## ADD — Plans

```text
Plans/LocalWordPressSetupPlan.md                 <- generalized from an existing WordPress project
Plans/WordPressSaveWorkflow.md                   <- generalized from an existing WordPress project
Plans/WordPressWebsiteCapabilityGroupPlan.md     <- NEW
Plans/WordPressMailDeliveryPlan.md               <- NEW (2026-09-03)
```

## ADD — Workspace

```text
Workspace/LocalWordPressBuild/
  site-manifest.json                             <- owner config template
  ges-build.php                                  <- orchestrator
  ges-wp-content-lib.php                         <- from geotw-wp-content-lib.php
  ges-nav-menu-sync.php
  ges-front-page-sync.php
  ges-content-setup.php
  ges-local-setup.php
  ges-sync-all.php
  page-layout-manifest.php                       <- minimal template
  content-manifest.php                           <- minimal template
  nav-menu-manifest.php                          <- minimal template

Workspace/Reference/WordPressGenesisOperatingGuide/
  README.md
  Pages/01-GenesisQueryArgsAndArchivePages.md
  Pages/11-GEOTWPageInteriors.md                 <- rename context to generic in README

Workspace/Reference/WampServer-and-MAMP-Installation-Migration-Guide.md
Capabilities/WordPressWebsite/WampServerAndMampSetup.md
```

## ADD — Content

```text
Content/Website/Database/README.md               <- template; no product .sql.gz
Content/Website/Theme/README.md                  <- placeholder for saved theme text
```

## Generalization Rules

| Token | Replace with |
| --- | --- |
| `yoursite` | `{siteKey}` in docs and manifest templates |
| `geotw` script prefix | `ges` in startup `Workspace/LocalWordPressBuild/` |
| `getestablishedontheweb` | `{siteKey}` in templates |
| `your-site.example` | `{productionUrl}` |
| `http://localhost/yoursite` | `{localUrl}` |

Scripts must read `site-manifest.json` for runtime values where feasible.

## Identity Updates (extension pass)

Rewrite in startup only:

| File | Change |
| --- | --- |
| `AGENTS.md` | WebPresence starter + WordPress Quick Start rows |
| `README.md` | GetEstablishedOnTheWebStartup identity |
| `Capabilities/RouterIndex.md` | Add extension Capability rows |
| `Capabilities/AgentCapabilityGuide.md` | WordPress bootstrap path |
| `Capabilities/README.md` | Registry parity |
| `Plans/RepositorySearchMap.md` | WordPress placement map |
| `Plans/AgentTaskBacklog.md` | site-manifest Ready Next |
| `Workspace/OwnerPreferences.md` | WAMP + Dropbox template sections |

Templates: [WebPresenceBootSnippets.md](WebPresenceBootSnippets.md).

## Verification

```powershell
$startup = "C:\Repositories\GetEstablishedOnTheWebStartup"
Test-Path "$startup\Workspace\LocalWordPressBuild\ges-build.php"
Test-Path "$startup\Capabilities\MirrorWebAssets\README.md"
Test-Path "$startup\Automation\WordPressSave\Save-LocalWordPress.ps1"
(Get-ChildItem "$startup\Capabilities" -Directory | Where-Object { Test-Path "$($_.FullName)\README.md" }).Count
(Get-ChildItem "$startup\Plans\*.md").Count
```

Run:

```powershell
.\Automation\VerifyStarterPackage.ps1 -Profile WebPresenceWordPress
```

## Stop Conditions (unchanged)

- No DNS, CF7, analytics, or public launch without owner approval.
- No `--write` WordPress build without owner approval + DB backup.
- Do not edit source WordPress project or GEOTW product WAMP paths during this pass.

## Related

- [WebPresenceStartupRepairSpec.md](WebPresenceStartupRepairSpec.md)
- [WebPresenceBootSnippets.md](WebPresenceBootSnippets.md)
