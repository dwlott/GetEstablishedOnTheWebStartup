<!--
IndexTitle: WebPresence Startup Repair Spec
IndexDescription: Keep/remove, rewrite, detach, and verification rules for GetEstablishedOnTheWebStartup packaging (base WebPresence + WebPowered WordPress extension).
IndexType: Capability
CapabilityName: StarterRepositoryPackage
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-07-16
-->

# WebPresence Startup Repair Spec

Use this spec to repair a fresh copy of
`C:\Repositories\GetEstablishedOnTheWeb` into the disposable starter workspace
`C:\Repositories\GetEstablishedOnTheWebStartup`.

Starter profile: `GetEstablishedOnTheWebStartup`  
Verify profile: **`WebPresenceWordPress`** (31 Capabilities; WordPress layer present)

This is a packaging profile for the downloadable / cloneable starter — not a
public product repository and not a commissioned customer site.

## Two-Phase Packaging

| Phase | Spec | Result |
| --- | --- | --- |
| **1 — Base WebPresence** | This file (Keep / Remove / Identity) | Starter-safe WebPresence pack; no host `.git` / agent runtime |
| **2 — WebPowered extension** | [WebPoweredStartupExtensionSpec.md](WebPoweredStartupExtensionSpec.md) | +5 WordPress Caps, `Workspace/LocalWordPressBuild/`, WordPress Save **Plans + Automation** |

Always apply Phase 2 after Phase 1 for the current shipped starter. Phase 1 may
remove `Workspace/LocalWordPressBuild/` at robocopy time; Phase 2 **re-adds** it
as generalized bootstrap.

Boot templates: [WebPresenceBootSnippets.md](WebPresenceBootSnippets.md).

## Expected Outcome (final — after both phases)

| Item | Target |
| --- | --- |
| Source workspace | `C:\Repositories\GetEstablishedOnTheWeb` |
| Startup workspace | `C:\Repositories\GetEstablishedOnTheWebStartup` |
| Git metadata | Removed from packaging workspace (owner re-inits after adopt) |
| Agent runtime config | `.cursor/`, `.claude/` removed at package time |
| Capability folders | **31** (26 base + 5 WordPress extension) |
| Plans Markdown files | **24** (see whitelist) |
| WordPress Save | `Plans/WordPressSaveWorkflow.md` + `Automation/WordPressSave/` — **not** `Capabilities/WordPressSave/` |
| AltitudeProOverlay / High Altitude | **Absent** (commissioned repos only) |
| Example content | GEOTW product drafts under `Content/Website/Pages/` only |
| Production launch | Out of scope |

## Keep Matrix (final)

Keep these top-level surfaces after both phases:

```text
AGENTS.md
LICENSE.md
README.md
Capabilities/
Content/Website/
Content/OnePageBusinessWebsite/
Ideas/
Plans/
Standards/
Workspace/
Automation/
```

### Capability folders (base)

```text
Capabilities/GettingStarted/
Capabilities/RepositoryScaffold/
Capabilities/GitHubWorkflow/
Capabilities/ChatToMarkdown/
Capabilities/ContentReview/
Capabilities/WebPresenceNode/
Capabilities/LocalAgentToolSetup/
Capabilities/SituationalAwareness/
Capabilities/AssistedAgenticWorkflow/
Capabilities/ManualIndexing/
Capabilities/Indexing/
Capabilities/OnePageWebsite/
Capabilities/InstructionCapture/
Capabilities/MirrorToWindows/
Capabilities/MirrorToDropbox/
Capabilities/MirrorToGoogleDrive/
Capabilities/GoogleDriveLink/
Capabilities/DropboxLink/
Capabilities/CapabilityAudit/
Capabilities/CapabilityCreate/
Capabilities/CapabilityHarmonize/
Capabilities/RepositoryInitialize/
Capabilities/StarterRepositoryPackage/
Capabilities/GoogleBusinessProfile/
Capabilities/YelpBusinessProfile/
Capabilities/BusinessPlan/
```

### Capability folders (WebPowered extension — Phase 2)

```text
Capabilities/MirrorWebAssets/
Capabilities/WordPressWebsite/
Capabilities/WordPressContentUpdate/
Capabilities/StudioPressGenesisChildTheme/
Capabilities/WordPressMigrationBackup/
```

### Plans files (final whitelist)

```text
Plans/README.md
Plans/WebsiteGoals.md
Plans/GEOTWProductGoals.md
Plans/AgentTaskBacklog.md
Plans/OpenQuestions.md
Plans/RepositorySearchMap.md
Plans/UserSetupGuide.md
Plans/GEOTWCoreReceiveSpec.md
Plans/GEOTWCoreReleaseWorkflow.md
Plans/GEOTWSelfProvisioningPromotionPlan.md
Plans/WebPresenceCapabilityPack.md
Plans/SelfProvisioningRepositoryModel.md
Plans/SelfProvisioningVerificationChecklist.md
Plans/GetEstablishedOnTheWebStartupProvisioningTestReport.md
Plans/LocalWordPressSetupPlan.md
Plans/WordPressSaveWorkflow.md
Plans/WordPressWebsiteCapabilityGroupPlan.md
Plans/LowercaseTablePrefixPolicy.md
Plans/StartupRepositoryAudit-20260714.md
Plans/StartupModernizationAudit-20260716.md
Plans/GoalsIdeasPlansCapabilitiesModel.md
Plans/Ideas.md
Plans/RepositoryGoals.md
Plans/SampleUserJourney.md
```

(Count = **24** Markdown files under `Plans/` including `README.md`.)

## Remove Matrix (Phase 1 — base)

Remove these from the startup workspace during base repair:

```text
.git/
.cursor/
.claude/
Intake/
Archive/
Automation/AgentReplies/
Automation/GoogleDriveRepositoryRefresh/
Automation/RepositoryRefresh/
Capabilities/CodeAssistedIndexing/
Capabilities/ImportCapabilitiesFromRepository/
Capabilities/ImportOwnerPreferencesFromRepository/
Capabilities/AltitudeProOverlay/
Capabilities/WordPressSave/
Workspace/LocalWordPressBuild.md
Workspace/Intake/
Workspace/Legacy/
```

**Note:** `Workspace/LocalWordPressBuild/` and `Workspace/Reference/` may be
stripped in base robocopy excludes, then **restored** by
[WebPoweredStartupExtensionSpec.md](WebPoweredStartupExtensionSpec.md).

Do **not** copy commissioned-only surfaces into the starter:

- `Capabilities/AltitudeProOverlay/` / High Altitude method plans
- `Capabilities/WordPressSave/` (commissioned Cap folder — starter uses Plans + Automation)
- Customer deploy profiles (`DansRepairService`, `US1Movers`, etc.)

## Robocopy Exclude List (copy time)

```text
.git
.cursor
.claude
Intake
Archive
Workspace\Intake
Workspace\Legacy
Automation\AgentReplies
Automation\GoogleDriveRepositoryRefresh
Automation\RepositoryRefresh
```

Example:

```powershell
$src = "C:\Repositories\GetEstablishedOnTheWeb"
$dst = "C:\Repositories\GetEstablishedOnTheWebStartup"
$xd = @(".git",".cursor",".claude","Intake","Archive")
robocopy $src $dst /E /XD $xd
```

Then run Phase 1 identity rewrite + Phase 2 WebPowered ADD matrix.

## Identity Rewrite Rules

| File | Startup identity |
| --- | --- |
| `AGENTS.md` | WebPresence + WordPress bootstrap starter; SoT is the adopted workspace |
| `README.md` | `GetEstablishedOnTheWebStartup` starter repository |
| `Plans/RepositorySearchMap.md` | Starter-first paths; no production GEOTW publishing routes |
| `Plans/AgentTaskBacklog.md` | Starter Ready Next; Quick Startup + site-manifest |
| `Plans/OpenQuestions.md` | Consumer banner; reset launch decisions |
| `Workspace/OwnerGoals.md` | Web-presence starter framing |
| `Workspace/OwnerPreferences.md` | Fresh WAMP/mirror rows; no private owner paths |
| `Workspace/ValuableReferences.md` | Create if missing; empty register |
| `Capabilities/README.md` | Startup registry + WordPress extension + “not shipped” commissioned Caps |
| `Capabilities/RouterIndex.md` | One row per kept Capability folder (31) |
| `Capabilities/AgentCapabilityGuide.md` | Starter routing; WordPress Save = Plans+Automation |

## Status Rules

- `GoogleBusinessProfile` and `YelpBusinessProfile` remain **Planned** until
  promoted.
- Local WordPress **bootstrap** (ges-build dry-run, manifests, WordPress Save
  scripts) is **in scope** for this starter.
- Production launch, DNS, CF7 install, analytics, and public deploy remain
  **out of scope** without owner build-pass approval.
- `Content/Website/` may contain GEOTW example Markdown only — fence as examples.
- Cloud mirror Capabilities are docs-only onboarding aids (no private paths).
- **AltitudeProOverlay / High Altitude** stay commissioned-only; AGENTS may
  point to “next repo” after commission without shipping those Caps.

## Verification

```powershell
cd C:\Repositories\GetEstablishedOnTheWebStartup
.\Automation\VerifyStarterPackage.ps1 -Profile WebPresenceWordPress
```

Expected:

- Capability folder count **31** equals RouterIndex / registry.
- WordPress layer files present (ges-build, site-manifest, WordPressSave script, Plans).
- No `Capabilities/AltitudeProOverlay/` or `Capabilities/WordPressSave/`.
- `AGENTS.md` / `README.md` read as starter, not product host.
