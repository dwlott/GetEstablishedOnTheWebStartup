<!--
IndexTitle: GEOTW Core Release Workflow
IndexDescription: Step order for one-way core release from GetEstablished host to GEOTW, including staged self-provisioning promotion.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-06-19
-->

# GEOTW Core Release Workflow

One-way **core release pass** from method host to product repository / candidate
web-presence archetype host. Not a Git fork. Not **StarterRepositoryPackage**
(that targets starter packaging workspaces).

Spec: [GEOTWCoreReceiveSpec.md](GEOTWCoreReceiveSpec.md)

---

## Roles

| Role | Path | Agent may edit? |
| --- | --- | --- |
| **Archetype host** | `C:\Repositories\GetEstablished` | Yes (method development) |
| **Product repo (GEOTW)** | `C:\Repositories\GetEstablishedOnTheWeb` | Yes during receive pass |
| **Intake snapshot** | `GE/Intake/GetEstablishedOnTheWeb/` | **Never** — reference only |

---

## When To Run

- After GE Capability add/rename (run GE C1 + RoutingTestSet first).
- After website Markdown or publishing plan updates on GE **before** canonical move completes — prefer editing GEOTW directly once migration is done.
- Monthly while GEOTW website work is active.
- Before promoting GEOTW toward self-provisioning, read
  [GEOTWSelfProvisioningPromotionPlan.md](GEOTWSelfProvisioningPromotionPlan.md).

---

## Step 0 — Confirm Scope

Before any pass after the first core release (2026-06-07), read
[GEOTWSecondCoreReleaseReadiness.md](GEOTWSecondCoreReleaseReadiness.md).
Defer robocopy if stability gates are open.

Record in handoff:

```text
Host: C:\Repositories\GetEstablished
Product: C:\Repositories\GetEstablishedOnTheWeb
Pass type: first migration | core release only | content only
Owner approved: yes
```

If first migration: run [GEOTWRepositoryStateAuditReport.md](GEOTWRepositoryStateAuditReport.md) checklist.

---

## Step 1 — Remove GEOTW Agent Traps

Delete on GEOTW only:

- `AGENTS.md.placeholder`, `README.md.placeholder`, `STRUCTURE_MANIFEST.md`
- `Capabilities/ImportCapabilitiesFromRepository/`
- `Capabilities/ImportOwnerPreferencesFromRepository/`

---

## Step 2 — Receive Baseline Capabilities

From host → GEOTW, copy folders in
[GEOTWCoreReceiveSpec.md](GEOTWCoreReceiveSpec.md) § E (overwrite):

```powershell
$host = "C:\Repositories\GetEstablished"
$geotw = "C:\Repositories\GetEstablishedOnTheWeb"
$caps = @(
  "GettingStarted","RepositoryScaffold","GitHubWorkflow","ChatToMarkdown",
  "ContentReview","LocalAgentToolSetup","SituationalAwareness",
  "AssistedAgenticWorkflow","ManualIndexing","Indexing","OnePageWebsite",
  "InstructionCapture","GoogleDriveLink","DropboxLink"
)
foreach ($c in $caps) {
  robocopy "$host\Capabilities\$c" "$geotw\Capabilities\$c" /E /NFL /NDL /NJH /NJS /nc /ns /np
}
```

Copy registry root files (§ F); trim RouterIndex rows to match GEOTW folders.

Apply [PathTranslation.md](../Capabilities/ImportCapabilitiesFromRepository/PathTranslation.md) if any `Docs/` literals remain in GEOTW after copy.

### Step 2b — Self-Provisioning Promotion (Optional, Separate Scope)

Do not expand GEOTW beyond the baseline receive list unless the owner approves a
self-provisioning promotion pass. Use
[GEOTWSelfProvisioningPromotionPlan.md](GEOTWSelfProvisioningPromotionPlan.md)
and [GEOTWCoreReceiveSpec.md](GEOTWCoreReceiveSpec.md) § E2.

Candidate additions include `CapabilityCreate`, `CapabilityHarmonize`,
`CapabilityAudit`, `RepositoryInitialize`, `StarterRepositoryPackage`, planned
`GoogleBusinessProfile`, planned `YelpBusinessProfile`, and opt-in
`CodeAssistedIndexing`.

After any addition, update GEOTW `Capabilities/README.md`,
`RouterIndex.md`, `AgentCapabilityGuide.md`, and `AGENTS.md` folder lists.

---

## Step 3 — Receive Standards And Automation

```powershell
robocopy "$host\Standards" "$geotw\Standards" /E /NFL /NDL /NJH /NJS /nc /ns /np
robocopy "$host\Automation\IndexHealthCheck" "$geotw\Automation\IndexHealthCheck" /E /NFL /NDL /NJH /NJS /nc /ns /np
```

Rewrite `Automation/README.md` on GEOTW to list IndexHealthCheck only.

---

## Step 4 — Website Content (canonical → GEOTW)

**First migration:**

1. Copy `Content/Website/` from host → GEOTW (overwrite stale pages).
2. Replace host `Content/Website/` with stub README pointing to GEOTW.
3. Move publishing Plans from host → GEOTW (see receive spec § H).

**Ongoing:** Edit `Content/Website/` on GEOTW only.

---

## Step 5 — Product Plans And Goals

Ensure on GEOTW:

- [WebsiteGoals.md](WebsiteGoals.md) — create/update on GEOTW
- [GEOTWProductGoals.md](GEOTWProductGoals.md)
- [AgentTaskBacklog.md](AgentTaskBacklog.md) — product Ready Next
- Publishing plans (Phase 4, harmony, page structure)

Copy `GEOTWCoreReceiveSpec.md` and this workflow to GEOTW `Plans/`.

---

## Step 6 — Identity Rewrites (GEOTW)

- `README.md` — product repository for GetEstablishedOnTheWeb.com
- `AGENTS.md` — product boot; not consumer starter wording
- `Plans/RepositorySearchMap.md` — GEOTW-scoped (create if missing)

---

## Step 7 — CapabilityHarmonize Review

Compare each received Capability GE vs GEOTW; **prefer host (GE)** version on
conflict unless GEOTW has intentional product-only edits.

Record summary in `Plans/GEOTWCoreReleaseReport.md` on GEOTW (or host for first pass).

### Step 7b — Method catalog export (when Capabilities change)

If host Capability READMEs changed in this pass:

1. Run [MethodCatalogExportPass.md](MethodCatalogExportPass.md).
2. Update GEOTW `Content/Website/Capabilities/*.md` per [MethodCatalogExportSpec.md](MethodCatalogExportSpec.md).
3. On product machine, run `geotw-capability-catalog-sync.php`.

Skip when no public Capability visibility changes.

---

## Step 8 — Verify

- Capability folder count matches RouterIndex rows.
- No host-only folders on GEOTW.
- `Content/Website/Pages/Home.md` LastEdited current.
- GE host stubs point to GEOTW for website work.
- If self-provisioning promotion was in scope, GEOTW routes
  `GetEstablishedOnTheWebStartup` packaging as active or explicitly planned.

---

## Step 9 — Commit

- **GEOTW:** owner commits product receive pass.
- **GE:** owner commits stubs + charter docs + goal bullet.

Do not push unless owner requests.

---

## Cadence After First Migration

```text
GE develop → GE C1 if registry change → core release Steps 2–3 + harmonize → GEOTW website work
```

Generic GetEstablished starter packaging remains separate on the method host.
GEOTW startup packaging is routed locally through **StarterRepositoryPackage**
and targets the disposable `GetEstablishedOnTheWebStartup` workspace.

---

## Related

- [Phase4PublishingPlatformDecision.md](Phase4PublishingPlatformDecision.md)
- [GEOTWSelfProvisioningPromotionPlan.md](GEOTWSelfProvisioningPromotionPlan.md)
- [../Capabilities/CapabilityHarmonize/README.md](../Capabilities/CapabilityHarmonize/README.md)
