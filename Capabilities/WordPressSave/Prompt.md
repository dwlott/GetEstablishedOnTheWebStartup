<!--
IndexTitle: WordPressSave Prompt
IndexDescription: Copy-ready prompt for single-site WordPress Save passes.
IndexType: Capability
CapabilityName: WordPressSave
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-09-03
-->

# WordPressSave Prompt

## Worker pass — WordPress Save

```text
Read Capabilities/WordPressSave/Rules.md and WorkflowIndex.md.
Owner approved WordPress Save for the siteKey in ThemeTrackManifest.json.

Run Save-LocalWordPress.ps1 (WhatIf first if unsure).
Report theme files changed, database snapshot path, Dropbox mirror result.
Do not commit unless owner asked.
```

## Worker pass — theme changes scan only

```text
Read Capabilities/WordPressSave/Rules.md.

Run Get-WordPressThemeChanges.ps1.
List changed files with repo targets. No copies unless owner confirms save.
```
