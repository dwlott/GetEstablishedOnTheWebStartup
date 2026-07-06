<!--
IndexTitle: WordPressContentUpdate Capability
IndexDescription: Sync approved Markdown and manifests into WordPress when owner approves a build pass.
IndexType: Capability
CapabilityName: WordPressContentUpdate
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-07-06
-->

# WordPressContentUpdate Capability

- **Version:** 1
- **Tier:** Archetype
- **Purpose:** Sync approved Markdown and manifests into WordPress when owner approves a build pass.
- **WhenToUse:** Owner approves ges-build.php --write or a scoped content sync.

## Start Here

[WorkflowIndex.md](WorkflowIndex.md) → [Rules.md](Rules.md) → [Prompt.md](Prompt.md)

## Related Plans

- [Plans/LocalWordPressSetupPlan.md](../../Plans/LocalWordPressSetupPlan.md)
- [Plans/WordPressSaveWorkflow.md](../../Plans/WordPressSaveWorkflow.md)
- [Plans/WordPressWebsiteCapabilityGroupPlan.md](../../Plans/WordPressWebsiteCapabilityGroupPlan.md)

## Stop Conditions

- No --write without owner approval and database backup.
- No production launch, DNS, CF7, or analytics without owner build-pass approval.
