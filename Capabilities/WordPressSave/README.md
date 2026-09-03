<!--
IndexTitle: WordPressSave Capability
IndexDescription: Persist local WAMP WordPress theme edits and database snapshots to Git; mirror large assets to Dropbox.
IndexType: Capability
CapabilityName: WordPressSave
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-09-03
-->

# WordPressSave Capability

- **Version:** 1
- **Tier:** Universal
- **Purpose:** Capture owner-approved direct WordPress edits into the Git source
  of truth, save database snapshots, and mirror large assets to Dropbox.
- **Inputs:** Local WAMP install for one `siteKey`, `ThemeTrackManifest.json`,
  `WAMP_WWW_ROOT`, running MySQL, optional Dropbox Desktop.
- **Outputs:** Updated Git theme files and `.sql.gz` snapshots; Dropbox mirror report.
- **WhenToUse:** Owner asks to WordPress Save, persist wp-admin/theme edits, export DB,
  or hand off local site state to Git.

Promoted from MoverCalcsWeb commissioned pattern — **single-site** only in this
starter. Multi-site (help + forum) tracks stay on commissioned repos.

## Start Here

[WorkflowIndex.md](WorkflowIndex.md) → [Rules.md](Rules.md) → [Prompt.md](Prompt.md)

Automation lives under `Automation/WordPressSave/`. The plan file
`Plans/WordPressSaveWorkflow.md` is a pointer banner to this Capability.

## Site manifest

[`Automation/WordPressSave/ThemeTrackManifest.json`](../Automation/WordPressSave/ThemeTrackManifest.json)
defines `siteKey`, theme file mappings, and the database snapshot target for
**one** local WordPress install.

## Dependencies

- [MirrorWebAssets](../MirrorWebAssets/README.md) — Dropbox mirror step
- [WordPressMigrationBackup](../WordPressMigrationBackup/README.md) — backup before risky experiments
- [WordPressContentUpdate](../WordPressContentUpdate/README.md) — Git-first content sync (preferred path)

## Data Boundaries

- Never commit `wp-config.php`, credentials, or full plugins tree to Git.
- Only manifest-listed theme PHP/CSS files copy to Git (SHA256 changed-only).
- Owner must explicitly request save and commit passes.

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | MoverCalcsWeb WordPressSave — generalized single-site (2026-09-03) |
| **SourceSummary** | Theme SHA256 scan + DB export + MirrorWebAssets |
| **PromotionStatus** | Active |
| **Dependencies** | MirrorWebAssets, ThemeTrackManifest.json |
| **RelatedFiles** | README, Rules, WorkflowIndex, Prompt |
| **LastReviewed** | 2026-09-03 |

## Related

- [Plans/WordPressSaveWorkflow.md](../../Plans/WordPressSaveWorkflow.md)
- [Automation/WordPressSave/Save-LocalWordPress.ps1](../../Automation/WordPressSave/Save-LocalWordPress.ps1)
