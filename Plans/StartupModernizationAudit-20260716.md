<!--
IndexTitle: Startup Modernization Audit 2026-07-16
IndexDescription: Confirms GetEstablishedOnTheWebStartup packaging, boot docs, and WordPress layer match the modernized WebPresenceWordPress profile.
IndexType: Plan
IndexStatus: Active
LastEdited: 2026-07-16
-->

# Startup Modernization Audit — 2026-07-16

## Verdict

**Modernized for starter shape.** Packaging specs, boot docs, WordPress
ContentUpdate intro contract, Save script WampPaths wiring, and
`VerifyStarterPackage.ps1` now match the shipped WebPresenceWordPress profile
(**31** Caps / **24** Plans).

Commissioned-only surfaces remain correctly **absent**:

- `Capabilities/AltitudeProOverlay/`
- `Capabilities/WordPressSave/` (Plans + Automation only)

## What changed this pass

| Area | Change |
| --- | --- |
| Repair spec | Two-phase packaging; final keep matrix; LocalWordPressBuild restored by extension |
| WorkflowIndex | Explicit Step 2e WebPowered extension; verify counts 31 / 24 |
| Extension spec | Plans target 24; do-not-add Altitude / WordPressSave Cap |
| AGENTS + boot snippets | Intro stack via WordPressContentUpdate; WordPress Save = Plans+Automation; Altitude next-repo |
| WordPressContentUpdate | Starter-safe intro-stack Rules + Prompt |
| NewCommissionSiteChecklist | Neutral business-site framing; Altitude disambiguation |
| Save-LocalWordPress.ps1 | Manifest-derived wp-config via `WampPaths.ps1` |
| VerifyStarterPackage.ps1 | ExpectedPlans 24; assert commissioned Caps absent; allow adopted-starter `.git` |

## Prior audit

[StartupRepositoryAudit-20260714.md](StartupRepositoryAudit-20260714.md) confirmed
starter-shaped tree; this pass closed packaging/docs/automation lag.

## Verify

```powershell
cd C:\Repositories\GetEstablishedOnTheWebStartup
.\Automation\VerifyStarterPackage.ps1 -Profile WebPresenceWordPress
```

Expect exit 0.

## Still out of scope (intentional)

- Shipping High Altitude / AltitudeProOverlay into the starter
- Promoting `Capabilities/WordPressSave/` (commissioned Cap folder)
- Production launch, DNS, CF7, analytics without owner build-pass
