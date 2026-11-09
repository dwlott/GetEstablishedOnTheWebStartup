<!--
IndexTitle: Web-Powered Startup Extension Spec
IndexDescription: ADD matrix for generalized WordPress ops on GetEstablishedOnTheWebStartup after base WebPresence packaging.
IndexType: Capability
CapabilityName: StarterRepositoryPackage
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-11-09
-->

# Web-Powered Startup Extension Spec

## Maintained source and runner contract — 2026-11-09

For the current WebPresenceWordPress profile, the maintained Git repository
`C:/Repositories/GetEstablishedOnTheWebStartup` owns the reusable WordPress
runner, child scripts, and operating instructions. GEOTW owns product-site
publishing, commerce, license sources, and release records. The old base-copy
and extension matrices below describe historical reconstruction; never apply
them over the maintained checkout or replace its WordPress layer with the base.
Make an isolated packaging copy from a reviewed Startup source snapshot. Preserve
canonical Git metadata and owner registers. A source snapshot with uncommitted
repairs must be identified by base commit plus file list/checksums.

Retain the following as one matched set from Startup:

- `Workspace/LocalWordPressBuild/README.md` and `ges-build-contract.php`.
- `ges-build.php`, guarded CSS/content/nav/front-page children, and their library.
- CSS/customization helpers and the site's declarative source manifests.
- `Automation/LocalWordPress/test_build_runner.py` and the current package verifier.
- The matching WordPressWebsite/ContentUpdate/ChildTheme operating guidance.

The default runner is a static plan for CSS → content → navigation. `--write`
is explicit and owner/backup gated. Optional front-page sync requires a configured
`front-page-manifest.php` and referenced Markdown; do not silently ship product
content to satisfy that prerequisite. The legacy local initializer cannot apply.
Use the shared README for configuration precedence and supported target rules.
Do not regenerate the runner by prefix-replacing GEOTW's product orchestrator.

The current retained profile is **33 Capabilities / 29 Plans**; derive inventory
from the retained lists and update whitelist/verifier together when it changes.
Run the current package verifier against the isolated copy, then run:

```powershell
python Automation/LocalWordPress/test_build_runner.py --php C:/path/to/php.exe --source-root C:/path/to/isolated-copy
```

Run the tests from repository root. Package presence checks alone do not prove
preview safety or live WordPress behavior. No public release, ZIP staging,
production build, or payment activation follows automatically from these checks.

## Historical reconstruction reference

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
| Total Plans files | **29** (current repair-spec whitelist and verifier) |
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
  ges-build-contract.php                        <- shared validated plan/apply guard
  README.md                                     <- execution contract
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

Runner and guarded children must use `ges-build-contract.php` to validate `site-manifest.json`; no implicit product target or automatic site discovery is permitted.

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
