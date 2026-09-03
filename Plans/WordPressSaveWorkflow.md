<!--
IndexTitle: WordPress Save Workflow
IndexDescription: Pointer banner — WordPressSave Capability owns the save workflow.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-09-03
-->

# WordPress Save Workflow

> **Canonical home:** [Capabilities/WordPressSave/](../Capabilities/WordPressSave/README.md)
>
> Read [Rules.md](../Capabilities/WordPressSave/Rules.md) and
> [WorkflowIndex.md](../Capabilities/WordPressSave/WorkflowIndex.md) for commands,
> manifest setup, and agent report blocks.

After local WordPress edits (Customizer, wp-admin, theme CSS/PHP), run **WordPressSave**
to persist theme text + database snapshot to Git and mirror large assets to Dropbox.

```powershell
.\Automation\WordPressSave\Save-LocalWordPress.ps1
```

Automation: [`Automation/WordPressSave/`](../Automation/WordPressSave/).
