<!--
IndexTitle: GEOTW Core Receive Spec
IndexDescription: KEEP/REMOVE lists for receiving GetEstablished core into GEOTW, including staged self-provisioning promotion.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-06-19
-->

# GEOTW Core Receive Spec

**Read during every core release pass.** Inverse of
[ConsumerRepairSpec.md](../Capabilities/StarterRepositoryPackage/ConsumerRepairSpec.md):
the method **host** releases a scoped subset into the **product / candidate
web-presence archetype host** repository.

Workflow: [GEOTWCoreReleaseWorkflow.md](GEOTWCoreReleaseWorkflow.md)

---

## A. Expected Outcome Counts

| Item | Count | Notes |
| --- | ---: | --- |
| Capability folders | **14–17 baseline** | See § E whitelist + optional cloud links + mirror platform (docs-only); self-provisioning promotion may add more by approval |
| Registry root files | **4** | RouterIndex, AgentCapabilityGuide, README, SkillRegistry |
| Standards | **Full copy** | From GE host each release |
| Plans (product) | **Growing** | Publishing, WebsiteGoals, product backlog — not GE method Plans |
| `Content/Website/` | **Canonical here** | Not on GE host after migration |
| `Intake/`, `Archive/` | **0** | Never receive from host |

**RouterIndex parity:** one row per Capability folder on disk after trim.

---

## B. Never Copy From Host

```text
Intake/
Archive/
Automation/GoogleDriveRepositoryRefresh/   (host mirror tooling)
Automation/RepositoryRefresh/
Automation/AgentReplies/
Capabilities/StarterRepositoryPackage/
Capabilities/CapabilityCreate/
Capabilities/CapabilityDefinition/
Capabilities/CapabilityHarmonize/
Capabilities/CapabilityAudit/
Capabilities/RepositoryLearning/
Capabilities/RepositoryInitialize/
Capabilities/ImportCapabilitiesFromRepository/
Capabilities/ImportOwnerPreferencesFromRepository/
Capabilities/CodeAssistedIndexing/         (optional later)
Capabilities/ChatMemoryCapture/            (host meta)
Plans/*.md                                 (bulk — use product plan list only)
Indexes/                                   (provision on GEOTW when needed)
```

Self-provisioning promotion can override selected Capability exclusions only
after [GEOTWSelfProvisioningPromotionPlan.md](GEOTWSelfProvisioningPromotionPlan.md)
classifies the Capability as GEOTW-needed. Do not bulk-copy host Plans or private
host automation as part of that promotion.

---

## C. Remove From GEOTW Before / During Receive

```text
AGENTS.md.placeholder
README.md.placeholder
STRUCTURE_MANIFEST.md
Capabilities/ImportCapabilitiesFromRepository/
Capabilities/ImportOwnerPreferencesFromRepository/
```

---

## D. Automation — KEEP (from host)

```text
Automation/IndexHealthCheck/
Automation/README.md                       <- rewrite to IndexHealthCheck only
```

Create `Automation/` on GEOTW if absent.

---

## E. Capability Folders — RECEIVE (copy from host)

**Core (always):**

```text
Capabilities/GettingStarted/
Capabilities/RepositoryScaffold/
Capabilities/GitHubWorkflow/
Capabilities/ChatToMarkdown/
Capabilities/ContentReview/
Capabilities/LocalAgentToolSetup/
Capabilities/SituationalAwareness/
Capabilities/AssistedAgenticWorkflow/
Capabilities/ManualIndexing/
Capabilities/Indexing/
Capabilities/OnePageWebsite/
Capabilities/InstructionCapture/
```

**Optional (default keep for product repo):**

```text
Capabilities/GoogleDriveLink/
Capabilities/DropboxLink/
```

**Mirror platform (docs-only — default keep after 2026-06-12):**

```text
Capabilities/MirrorToWindows/      <- docs-only; no Automation/RepositoryMirror/
Capabilities/MirrorToDropbox/      <- stub alias → MirrorToWindows
Capabilities/MirrorToGoogleDrive/  <- stub alias → MirrorToWindows
```

Product repo may invoke the archetype host launcher
(`GetEstablished/Automation/RepositoryMirror/`) until local automation is approved.
See [RepositoryMirrorStandard.md](../Standards/RepositoryMirrorStandard.md).

## E2. Self-Provisioning Promotion Additions

These are **not** part of the baseline trimmed receive list. They may be copied
only for an owner-approved GEOTW self-provisioning promotion pass:

```text
Capabilities/CapabilityCreate/
Capabilities/CapabilityHarmonize/
Capabilities/CapabilityAudit/
Capabilities/RepositoryInitialize/
Capabilities/StarterRepositoryPackage/
Capabilities/CodeAssistedIndexing/          (opt-in only)
Capabilities/GoogleBusinessProfile/         (planned WebPresence)
Capabilities/YelpBusinessProfile/           (planned WebPresence)
```

After copying any of these to GEOTW, update GEOTW registry/router/guide parity
and ensure planned Capabilities are labeled planned. The 2026-06-19
`GetEstablishedOnTheWebStartup` provisioning test received this set except
`CodeAssistedIndexing`, which remains opt-in.

---

## F. Registry Root Files — RECEIVE

Copy from host, then **trim RouterIndex and guide** to whitelist folders only:

```text
Capabilities/RouterIndex.md
Capabilities/AgentCapabilityGuide.md
Capabilities/README.md
Capabilities/SkillRegistry.md
```

After copy, remove registry rows for host-only Capabilities not on disk in GEOTW.

---

## G. Standards — RECEIVE

Copy entire `Standards/` tree from host (authoritative conventions).

---

## H. Plans — Product Whitelist (GEOTW canonical)

**Keep / create on GEOTW (not bulk host Plans):**

```text
Plans/README.md
Plans/WebsiteGoals.md
Plans/GEOTWProductGoals.md
Plans/AgentTaskBacklog.md
Plans/OpenQuestions.md
Plans/RepositorySearchMap.md              <- GEOTW-scoped map
Plans/Phase4PublishingPlatformDecision.md
Plans/GitHubPagesHarmonyPlan.md
Plans/PublicWebsitePageStructurePlan.md
Plans/PublicWebsitePageStructurePassReport.md
Plans/ProductLanguageAndPositioning.md
Plans/WordPressBuildChecklist.md
Plans/GEOTWCoreReceiveSpec.md             <- copy from host
Plans/GEOTWCoreReleaseWorkflow.md
Plans/UserSetupGuide.md                   <- optional; link to starter docs
Plans/GEOTWSelfProvisioningPromotionPlan.md <- optional; host-authored promotion plan
```

Do not copy ~170 host method Plans to GEOTW.

---

## I. Identity Rewrites (after file copy)

| File | Product repo identity |
| --- | --- |
| `README.md` | Get Established On The Web **product** repository |
| `AGENTS.md` | Product + website work; canonical `Content/Website/` |
| `Plans/RepositorySearchMap.md` | GEOTW paths; pointer to GE host for method development |

When GEOTW becomes self-provisioning, identity rewrites must distinguish:

- method development still centered in `GetEstablished`;
- web-presence archetype packaging centered in `GetEstablishedOnTheWeb`;
- `GetEstablishedOnTheWebStartup` as starter output, not the development repo.

---

## J. Verification Commands

```powershell
$geotw = "C:\Repositories\GetEstablishedOnTheWeb"
(Get-ChildItem "$geotw\Capabilities" -Directory | Where-Object { Test-Path "$($_.FullName)\README.md" }).Count
Test-Path "$geotw\Content\Website\Pages\Home.md"
Test-Path "$geotw\Plans\WebsiteGoals.md"
Get-ChildItem "$geotw\Capabilities\Import*" -ErrorAction SilentlyContinue
```

Expect: 14–17 Capability folders; no `Import*` folders; WebsiteGoals present;
`Standards/RepositoryMirrorStandard.md` present after mirror modernization pass.

---

## Related

- [GEOTWRepositoryStateAuditReport.md](GEOTWRepositoryStateAuditReport.md)
- [GEOTWCoreReleaseWorkflow.md](GEOTWCoreReleaseWorkflow.md)
- [../Capabilities/ImportCapabilitiesFromRepository/PathTranslation.md](../Capabilities/ImportCapabilitiesFromRepository/PathTranslation.md)
