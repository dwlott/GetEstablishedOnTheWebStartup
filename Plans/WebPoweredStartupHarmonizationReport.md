<!--
IndexTitle: Web-Powered Startup Harmonization Report
IndexDescription: Results from GEOTW + MoverCalcsWeb harmonization into GetEstablishedOnTheWebStartup.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-07-06
-->

# Web-Powered Startup Harmonization Report

## Summary

Harmonization pass completed **2026-07-06**. Created
`C:\Repositories\GetEstablishedOnTheWebStartup` as the web-powered starter for
new local WordPress sites.

| Phase | Result |
| --- | --- |
| Git hygiene | GEOTW `.gitignore` updated for `*.code-workspace`; MoverCalcsWeb and GES clean |
| Source polish | WebPresence repair spec, boot snippets, GES doc drift fixed |
| Base packaging | 26 Capability folders, 14 Plans (WebPresence + self-provisioning) |
| WordPress extension | +5 Capabilities, +4 Plans, `ges-*` build toolkit, automation tree |
| Identity rewrite | AGENTS, README, router, backlog, OwnerPreferences templated |
| Verification | `VerifyStarterPackage.ps1 -Profile WebPresenceWordPress` — **PACKAGE READY** |

## Final Counts

| Item | Count |
| --- | ---: |
| Capability folders | 31 |
| Plans files | 19 |
| `ges-build.php` scripts | 13 files in `Workspace/LocalWordPressBuild/` |
| Automation folders | 6 (MirrorWebAssets, WordPressSave, DatabaseBackups, BluehostDatabasePrep, LocalWordPress, IndexHealthCheck) |

## Smoke Tests

| Test | Result | Notes |
| --- | --- | --- |
| `Save-LocalWordPress.ps1 -WhatIf` | Pass | Uses `yoursite` from ThemeTrackManifest; WAMP path resolves |
| `Export-LocalWordPressDatabase.ps1` | Expected fail | No `yoursite` WAMP install yet — script correctly errors on missing wp-config |
| `ges-build.php` dry-run | Deferred | Requires owner WAMP site + PHP CLI path |
| Router/registry parity | Pass | 31 folders = 31 router rows after CapabilityCreate fix |

## Source Repos Untouched (functional)

- MoverCalcsWeb localhost `movercalcs` — no script edits
- GEOTW localhost `getestablishedontheweb` — no script edits
- Live DB snapshots in source repos — not overwritten

## Frictions Captured

1. **IndexHealthCheck on GES** — `Run-IndexHealthCheck.ps1` has a PowerShell parse error; not fixed in this pass (pre-existing).
2. **Save-LocalWordPress hardcoded paths** — generalized in startup copy only; MoverCalcsWeb unchanged.
3. **ges-build.php** — simplified orchestrator from GEOTW `geotw-sync-all.php`; owner must configure PHP binary path per PC.
4. **GEOTWStartup has no `.git`** — by design (disposable packaging workspace); owner initializes Git via GitHubWorkflow when ready.

## CapabilityHarmonize Notes

Startup promotes WordPress group to **Active**; GEOTW product repo keeps Draft
status per [WebPresenceCapabilityPack.md](WebPresenceCapabilityPack.md).

Horizontal harmonized core (GettingStarted, GitHubWorkflow, ContentReview, …)
matches GES/GEOTW routing patterns.

## Next Recommended Tasks

1. Owner adopts startup folder and runs `Begin Quick Startup from AGENTS.md`
2. Configure `site-manifest.json` + `ThemeTrackManifest.json` for first real site key
3. Fresh WAMP install per `LocalWordPressSetupPlan.md`
4. Owner-approved `ges-build.php` dry-run, then `--write` with DB backup
5. Initialize Git in startup workspace when owner requests

## Related

- [WebPoweredGeneralizationMatrix.md](WebPoweredGeneralizationMatrix.md)
- [WordPressWebsiteCapabilityGroupPlan.md](WordPressWebsiteCapabilityGroupPlan.md)
- [../Capabilities/StarterRepositoryPackage/WebPoweredStartupExtensionSpec.md](../Capabilities/StarterRepositoryPackage/WebPoweredStartupExtensionSpec.md)
