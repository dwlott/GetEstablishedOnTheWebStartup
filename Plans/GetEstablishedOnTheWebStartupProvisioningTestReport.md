<!--
IndexTitle: GetEstablishedOnTheWebStartup Provisioning Test Report
IndexDescription: Results and friction capture from GEOTW to GEOTWStartup provisioning passes.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-06-19
-->

# GetEstablishedOnTheWebStartup Provisioning Test Report

## Summary

Controlled packaging passes from:

```text
Source:  C:\Repositories\GetEstablishedOnTheWeb
Target:  C:\Repositories\GetEstablishedOnTheWebStartup
Profile: GetEstablishedOnTheWebStartup
Capability: StarterRepositoryPackage + WebPresenceStartupRepairSpec.md
```

**Pass 2 (2026-06-19):** Startup workspace recreated via robocopy (excluding
`.git`/`.cursor`/`.claude`), remove-matrix trim, Plans whitelist, identity
rewrite, and verification. Test packaging only — no ZIP, public release, or
launch work.

**Pass 1 (2026-06-19):** Initial controlled test documented below; established
`WebPresenceStartupRepairSpec.md` and GEOTW routing.

## Pass 2 — Verification Results

| Check | Result |
| --- | --- |
| Startup workspace exists | Pass |
| `.git`, `.cursor`, `.claude` absent | Pass |
| `Intake/`, `Archive/`, production build folders absent | Pass |
| `Workspace/LocalWordPressBuild.md` removed | Pass (after repair) |
| Capability folders with `README.md` | 24 |
| Capability folders missing from router | 0 |
| Capability folders missing from registry | 0 |
| Plans files (whitelist) | 14 |
| `AGENTS.md` / `README.md` read as starter | Pass |
| Private paths in `OwnerPreferences.md` | Pass (reset) |
| Google/Yelp status clear | Pass: both Planned |

## Pass 2 — Repair Applied

- Robocopy GEOTW → startup excluding Git and agent runtime folders.
- Removed: `Workspace/LocalWordPressBuild/`, `Workspace/Reference/`,
  `Workspace/Intake/`, `Workspace/Legacy/`, `Content/Website/Assets/`,
  `Content/Website/Capabilities/`.
- Plans trimmed from 47 → 14 (whitelist in repair spec).
- Identity rewrite: `AGENTS.md`, `README.md`, `Plans/RepositorySearchMap.md`,
  `Plans/AgentTaskBacklog.md`, `Plans/WebsiteGoals.md`, `Plans/GEOTWProductGoals.md`,
  `Plans/OpenQuestions.md`, `Workspace/OwnerGoals.md`, `Workspace/OwnerPreferences.md`,
  `Workspace/ValuableReferences.md` (created), `Capabilities/README.md`,
  `Capabilities/RouterIndex.md`, `Capabilities/AgentCapabilityGuide.md`,
  `Content/Website/README.md`, `Ideas/FutureIdeas.md`, `Automation/README.md`.
- Scrubbed product paths in `AssistedAgenticWorkflow` Prompt/README.
- Deleted orphaned `Workspace/LocalWordPressBuild.md`.

## Pass 2 — Frictions Captured

1. **WorkflowIndex still routes to `ConsumerRepairSpec` steps and host
   `VerifyStarterPackage.ps1`.** WebPresence profile needs its own Step 2–6
   branch or profile parameter; generic verifier expects 12 Capabilities / 10
   Plans and would fail a correct WebPresence startup (24 / 14).
2. **`Prompt.md` still targets `GetEstablishedStartup` only.** Worker entry
   does not mention `WebPresenceStartupRepairSpec.md`.
3. **Remove matrix incomplete for Workspace subtrees.** Spec lists
   `Workspace/LocalWordPressBuild/` and `Workspace/Reference/` but not
   `Workspace/Intake/`, `Workspace/Legacy/`, or orphan
   `Workspace/LocalWordPressBuild.md`. All carried product-only material.
4. **No WebPresence boot snippets.** `ConsumerBootSnippets.md` is
   GetEstablishedStartup-only; agent invented startup AGENTS/backlog shapes.
5. **Full mirror copy before trim is slow.** ~500 Workspace/Intake files copied
   then deleted; robocopy should exclude known product subtrees at copy time.
6. **`OpenQuestions.md` not in identity rewrite table** but ships product launch
   decisions unless reset (same class as OwnerPreferences).
7. **`ValuableReferences.md` missing on GEOTW source.** Starter boot expects
   four Workspace files; source had three — had to create during repair.
8. **Capability prompt residue.** `AssistedAgenticWorkflow`, mirror/link docs,
   and similar files can ship private paths or product repo names; need a
   default private-path scrub pass in the repair spec.
9. **Example content tier.** FrontPage widget snippets retain
   `/getestablishedontheweb/` staging paths; useful as examples but need an
   explicit starter content tier and ContentReview note.
10. **Plans whitelist includes product-process docs.** Files like
    `GEOTWCoreReceiveSpec.md` and `GEOTWCoreReleaseWorkflow.md` are provenance
    useful for advanced users but confuse first-run routing unless rewritten or
    moved to an optional tier.
11. **`StarterRepositoryPackage/README.md` on GEOTW still lists WebPresence
    profile as Planned** while `WorkflowIndex.md` marks it Active — internal
    drift.
12. **No automated registry/router parity script** for WebPresence expected
    counts (24 Capabilities, 14 Plans).

## Capability Improvement Backlog

| Area | Improvement | Status |
| --- | --- | --- |
| `StarterRepositoryPackage` | Add WebPresence profile branch to WorkflowIndex Steps 2–6 | Open |
| `StarterRepositoryPackage` | Add `WebPresenceBootSnippets.md` for AGENTS, backlog, OpenQuestions | Open |
| `StarterRepositoryPackage` | Extend remove matrix: Workspace/Intake, Legacy, LocalWordPressBuild.md | Open |
| `StarterRepositoryPackage` | Add robocopy exclude list to repair spec (pre-copy, not post-delete) | Open |
| `StarterRepositoryPackage` | Add private-path scrub step for Capability Prompt/README files | Open |
| `StarterRepositoryPackage` | Add `VerifyWebPresenceStarter.ps1` or profile params to verifier | Open |
| `StarterRepositoryPackage` | Update `Prompt.md` to branch on starter profile | Open |
| `StarterRepositoryPackage` | Harmonize README vs WorkflowIndex profile status on GEOTW | Open |
| `WebPresenceCapabilityPack` | Define starter content tiers (example pages vs staging URLs vs omit) | Open |
| `WebPresenceCapabilityPack` | Define Plans tiers (required starter vs optional provenance) | Open |
| `CapabilityHarmonize` | Readiness question: starter without product-only residue | Open |
| `GoogleBusinessProfile` / `YelpBusinessProfile` | Promote only after safety boundaries defined | Open |

## Pass 1 — Readiness Answers

| Question | Answer |
| --- | --- |
| Which self-provisioning core Capabilities must GEOTW receive before packaging? | `CapabilityCreate`, `CapabilityHarmonize`, `CapabilityAudit`, `RepositoryInitialize`, and `StarterRepositoryPackage`. |
| Which WebPresence pack members should ship in the starter? | Website/content core plus `GoogleBusinessProfile` and `YelpBusinessProfile` as **Planned**. |
| Which GEOTW product files must be excluded or rewritten? | Git/agent runtime config, private paths, production WordPress build folders, product-only Plans, owner preferences, production backlog. |
| What was missing for a dedicated repair spec? | Added `WebPresenceStartupRepairSpec.md`. |

## Pass 1 — Frictions (Retained)

1. Profile-specific repair specs required before copying.
2. Source-process docs not automatically starter-safe.
3. Content needs tiered keep rules (assets vs page examples).
4. Owner preference files need forced reset.
5. Registry parity needs automated check.
6. Cloud/mirror workflow examples need placeholder scrubbing.

## Current Status

`GetEstablishedOnTheWebStartup` is repaired as a local test workspace and is
ready for owner review. It is not a source of truth, not a public release, and
not a packaged ZIP until the owner approves distribution.

**Suggested owner smoke test:**

```text
Begin Quick Startup from AGENTS.md. Full first-session order.
This is not an app launch.
```
