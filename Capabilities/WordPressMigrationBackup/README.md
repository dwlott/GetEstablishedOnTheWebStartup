<!--
IndexTitle: WordPressMigrationBackup Capability
IndexDescription: Backup database and assets before WordPress experiments and Bluehost export.
IndexType: Capability
CapabilityName: WordPressMigrationBackup
CapabilityVersion: 3
IndexStatus: Active
LastEdited: 2026-07-23
-->

# WordPressMigrationBackup Capability

- **Version:** 3
- **Tier:** Universal
- **Purpose:** Backup database and assets before WordPress experiments, and
  route **Bluehost-ready** SQL prep (URL rewrite + prefix verify) without
  treating production launch as automatic.
- **WhenToUse:** Before first `--write` build, Bluehost export/import, or risky
  theme experiments.

## Start Here

[Prompt.md](Prompt.md) → [Rules.md](Rules.md) → [WorkflowIndex.md](WorkflowIndex.md)

**Bluehost prep:**  
[Automation/BluehostDatabasePrep/README.md](../../Automation/BluehostDatabasePrep/README.md)  
+ per-site fields in [Workspace/SiteDeployProfiles/](../../Workspace/SiteDeployProfiles/)

## Related Plans

- [Plans/WordPressSaveWorkflow.md](../../Plans/WordPressSaveWorkflow.md)
- [Plans/WordPressWebsiteCapabilityGroupPlan.md](../../Plans/WordPressWebsiteCapabilityGroupPlan.md)
- [Plans/CrossRepoCapabilityGapMatrix.md](../../Plans/CrossRepoCapabilityGapMatrix.md)

## Stop Conditions

- No `--write` without owner approval and database backup.
- No production launch, DNS, CF7, or analytics without owner build-pass approval.
- Preparing Bluehost SQL is **not** the same as importing or pointing DNS —
  still require owner confirmation before phpMyAdmin import.

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | Starter + commissioned Bluehost go-live lessons 2026-07-14 |
| **SourceSummary** | Pre-write / pre-migrate backups; points at BluehostDatabasePrep automation |
| **PromotionStatus** | Active |
| **Dependencies** | SiteDeployProfiles (host DB name, prefix); WordPress Save Plans+Automation for local snapshot |
| **RelatedFiles** | WorkflowIndex.md, Rules.md, Prompt.md |
| **LastReviewed** | 2026-07-23 |
| **HarmonizationNotes** | Serialize-aware replace + SiteDeployProfiles pattern; keep credentials out of Git |

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-07-23 | 3 | Blended Bluehost prep path from commissioned go-live (CapabilityHarmonize Option B) | Naive SQL string replace fails on PHP-serialized widgets/theme_mods; temp DB + search-replace-urls.php then adapter | README, Rules, Prompt, Automation/BluehostDatabasePrep |
| 2026-07-07 | 2 | Capability active on starter | Pre-write backup gate | Capability folder |
| 2026-07-06 | 1 | Capability scaffold | Pre-write backup gate for local WP experiments | Capability folder |

## Related

- [Plans/WordPressSaveWorkflow.md](../../Plans/WordPressSaveWorkflow.md)
- [MirrorWebAssets](../MirrorWebAssets/README.md)
