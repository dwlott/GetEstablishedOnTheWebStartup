<!--
IndexTitle: WordPress Genesis Operating Guide
IndexDescription: Reference bundle for Genesis category-ID workflow, plugins, and GEOTW content architecture.
IndexType: Reference
IndexStatus: Active
LastEdited: 2026-06-22
-->

# WordPress Genesis Operating Guide

Operating reference for **GetEstablishedOnTheWeb** WordPress builds using the
owner's proven **kirby-smith** patterns:

- Genesis **`query_args`** archive pages
- Category and media **ID** workflow (Reveal IDs)
- Phased **plugin stack**
- Growing **Posts** vs static **Pages**
- **PHP CLI automation** for categories, archive pages, and posts

## Start here

1. [SourceIndex.md](SourceIndex.md) — full file list
2. [Pages/01-GenesisQueryArgsAndArchivePages.md](Pages/01-GenesisQueryArgsAndArchivePages.md) — core archive pattern
3. [Pages/05-GEOTWContentArchitecture.md](Pages/05-GEOTWContentArchitecture.md) — planned GEOTW categories
4. [Pages/08-WordPressContentAutomation.md](Pages/08-WordPressContentAutomation.md) — automate content setup

## Reference sites

| Site | Role | URL |
| --- | --- | --- |
| kirby-smith (read-only) | Full plugin + category reference | http://localhost/kirby-smith/ · https://www.scv-kirby-smith.org/ |
| GEOTW local (write) | Staging build | http://localhost/getestablishedontheweb/ |

## Local WAMP Path Awareness

The owner works from more than one PC. Known WAMP roots:

- `Magnito` / XPS 8900: `C:\wamp\www`
- `Vanilla_XPS`: `G:\wamp64\www`

When the active WAMP path is unclear, run the path check in
[Workspace/LocalWordPressBuild.md](../../LocalWordPressBuild.md) before running
PHP sync scripts or touching local WordPress files. If neither known path exists,
ask the owner for the current WAMP root.

## Boundaries

- kirby-smith: **read-only** for agents — never modify
- GEOTW repo Markdown: canonical for **pages** until owner approves otherwise
- Do not commit `.wpress`, `wp-config.php`, or commercial plugin keys to Git

## Related GEOTW docs

- [Workspace/LocalWordPressBuild.md](../../LocalWordPressBuild.md)
- [Plans/LocalWordPressReferenceAudit.md](../../../Plans/LocalWordPressReferenceAudit.md)
- [Plans/LocalWordPressBuildReport.md](../../../Plans/LocalWordPressBuildReport.md)

## Method host (Capability planning)

Future promotion to `Capabilities/` on GetEstablished:

- `C:/Repositories/GetEstablished/Plans/WordPressWebsiteCapabilityGroupPlan.md`
- `C:/Repositories/GetEstablished/Plans/WordPressPluginCapabilityNotes.md`
- `C:/Repositories/GetEstablished/Plans/WordPressLocalSiteInventory.md`
- `C:/Repositories/GetEstablished/Plans/StudioPressGenesisBuildStory.md`
- Draft Capabilities (2026-06-14): `WordPressWebsite`, `WordPressContentUpdate`,
  `StudioPressGenesisChildTheme`, `WordPressMigrationBackup`

This bundle is the **product-side operating guide** for GEOTW agents and owner.

## Altitude theme reference (separate bundle)

Front page widgets and Customizer:

- [StudioPressAltitudeProInstructions/SourceIndex.md](../StudioPressAltitudeProInstructions/SourceIndex.md)
