<!--
IndexTitle: WordPressMigrationBackup Capability
IndexDescription: Backup database and assets before WordPress experiments.
IndexType: Capability
CapabilityName: WordPressMigrationBackup
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-07-06
-->

# WordPressMigrationBackup Capability

- **Version:** 1
- **Tier:** Archetype
- **Purpose:** Backup database and assets before WordPress experiments.
- **WhenToUse:** Before first --write build, Bluehost export, or risky theme experiments.

## Start Here

[WorkflowIndex.md](WorkflowIndex.md) → [Rules.md](Rules.md) → [Prompt.md](Prompt.md)

## Related Plans

- [Plans/LocalWordPressSetupPlan.md](../../Plans/LocalWordPressSetupPlan.md)
- [Plans/WordPressSaveWorkflow.md](../../Plans/WordPressSaveWorkflow.md)
- [Plans/WordPressWebsiteCapabilityGroupPlan.md](../../Plans/WordPressWebsiteCapabilityGroupPlan.md)

## Stop Conditions

- No --write without owner approval and database backup.
- No production launch, DNS, CF7, or analytics without owner build-pass approval.
