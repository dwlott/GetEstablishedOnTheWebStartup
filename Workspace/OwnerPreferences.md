<!--
IndexTitle: Owner Preferences
IndexDescription: Starter template for owner-specific settings, WAMP paths, and mirror choices.
IndexType: Workspace
IndexStatus: Active
LastEdited: 2026-07-06
-->

# Owner Preferences

Durable register for **Owner Preferences** in this web-presence starter workspace.
Separate from **Owner Goals** (`Workspace/OwnerGoals.md`).

Do not store credentials, tokens, or API secrets here.

## Import

| Field | Value |
| --- | --- |
| Last source path | *(none yet)* |
| Last import date | *(none yet)* |

## Connectors

| Preference | Value | Notes |
| --- | --- | --- |
| Mirror mode | on-demand | No automatic cloud copy after local edits |
| Default mirror style | fast | Incremental `/E`; no purge unless owner asks |
| Local repository root | `C:\Repositories\<YourWebProjectName>` | Set after adoption |
| Mirror target path | *(owner sets)* | Dropbox or GDrive repository mirror |
| Mirror platform | Windows | **MirrorToWindows** docs-only |
| Mirror purpose | backup | Confirm with owner |
| Purge on mirror | no | |
| Include `.git` | no | |

## Local WordPress (WAMP)

| Setting | Value |
| --- | --- |
| `WAMP_WWW_ROOT` | *(owner sets — e.g. `C:\wamp64\www`)* |
| Site folder | `www\{siteKey}` |
| Local URL | `http://localhost/{siteKey}` |
| Site manifest | `Workspace/LocalWordPressBuild/site-manifest.json` |

## Web asset mirror (Dropbox)

| Setting | Value |
| --- | --- |
| Dropbox Webs root | `Dropbox\Webs\{siteKey}` |
| Manifest | `Automation/MirrorWebAssets/WebAssetsSites.json` |
| Backup | `.\Automation\MirrorWebAssets\Mirror-WebAssetsToDropbox.ps1` |
| Restore | `.\Automation\MirrorWebAssets\Restore-WebAssetsFromDropbox.ps1` |

## WordPress Save

```powershell
.\Automation\WordPressSave\Save-LocalWordPress.ps1
```

Preview: add `-WhatIf`. See [Plans/WordPressSaveWorkflow.md](../Plans/WordPressSaveWorkflow.md).

## Related

- [OwnerGoals.md](OwnerGoals.md)
- [../Plans/LocalWordPressSetupPlan.md](../Plans/LocalWordPressSetupPlan.md)
