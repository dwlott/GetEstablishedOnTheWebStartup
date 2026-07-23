<!--
IndexTitle: WordPressWebsite Capability
IndexDescription: Parent router and safety rules for local WordPress site bootstrap in the web-presence starter.
IndexType: Capability
CapabilityName: WordPressWebsite
CapabilityVersion: 2
IndexStatus: Active
LastEdited: 2026-07-07
-->

# WordPressWebsite Capability

- **Version:** 2
- **Tier:** Archetype
- **Purpose:** Parent router for local WordPress bootstrap — especially **new commission sites**.
- **WhenToUse:** Owner adopts this starter for a new WAMP site; configure manifests; route WordPress work.

## Start Here

**New business site?** → [NewCommissionSiteChecklist.md](NewCommissionSiteChecklist.md)

Then [WorkflowIndex.md](WorkflowIndex.md) → [Rules.md](Rules.md) → [Prompt.md](Prompt.md)

## Child Capabilities

| Child | Use for |
| --- | --- |
| WordPressContentUpdate | `ges-build.php`, Markdown/manifest sync |
| WordPressMigrationBackup | DB snapshot before experiments |
| StudioPressGenesisChildTheme | Altitude CSS and child-theme overlay |
| MirrorWebAssets | Uploads/theme ↔ Dropbox |

## Related Plans

- [Plans/LocalWordPressSetupPlan.md](../../Plans/LocalWordPressSetupPlan.md)
- [Plans/WordPressSaveWorkflow.md](../../Plans/WordPressSaveWorkflow.md) + `Automation/WordPressSave/`
- [Plans/CrossRepoCapabilityGapMatrix.md](../../Plans/CrossRepoCapabilityGapMatrix.md)
- [Plans/WordPressWebsiteCapabilityGroupPlan.md](../../Plans/WordPressWebsiteCapabilityGroupPlan.md)

## Stop Conditions

- No `--write` without owner approval and database backup.
- No production launch without separate owner build-pass approval.
