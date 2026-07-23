<!--
IndexTitle: StudioPressGenesisChildTheme Capability
IndexDescription: Genesis child-theme and Altitude overlay rules for local WordPress sites.
IndexType: Capability
CapabilityName: StudioPressGenesisChildTheme
CapabilityVersion: 3
IndexStatus: Active
LastEdited: 2026-07-23
-->

# StudioPressGenesisChildTheme Capability

- **Version:** 3
- **Tier:** Archetype
- **Purpose:** Genesis child-theme overlay, Altitude hooks, layout modes, and CSS sync boundaries.
- **WhenToUse:** Theme CSS, custom PHP hooks, Altitude layout work on local WAMP.

## Start Here

[WorkflowIndex.md](WorkflowIndex.md) → [Rules.md](Rules.md) → [Prompt.md](Prompt.md)

Build step: `ges-theme-css-sync.php` via **WordPressContentUpdate**.

Commissioned brand tokens / Element Registry / CommonTweaks stay on project repos
via **AltitudeProOverlay** (not shipped in this starter). Keep theme work inside
this Archetype Capability and do not invent site-specific brand CSS in chat.

## Archetype defaults (from commissioned go-live)

When copying Altitude Dark Theme to a new site, prefer these proven defaults
unless the owner chooses otherwise:

| Default | Value | Why |
| --- | --- | --- |
| Header title-area | **360×76** (retina asset 720×152) | Stock Altitude banner; lock via theme-supports |
| Content wrap | **1200** px (vs some sources at 1280) | Match header wrap so inner pages align |
| Workflow | Copy shared overlay CSS first, brand second | Avoid restyling each element in chat |

## Related Plans

- [Plans/WordPressSaveWorkflow.md](../../Plans/WordPressSaveWorkflow.md)
- [Plans/WordPressWebsiteCapabilityGroupPlan.md](../../Plans/WordPressWebsiteCapabilityGroupPlan.md)
- [Plans/CrossRepoCapabilityGapMatrix.md](../../Plans/CrossRepoCapabilityGapMatrix.md)

## Stop Conditions

- No `--write` without owner approval and database backup.
- No production launch, DNS, CF7, or analytics without owner build-pass approval.

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-07-23 | 3 | Document 360×76 / 1200 wrap defaults from commissioned go-live | CommonTweaks stay on project repos; starter keeps archetype defaults only | README |
| 2026-07-07 | 2 | Active on starter | Theme boundaries for local WAMP | Capability folder |
