<!--
IndexTitle: Use AI on local WordPress
IndexDescription: Agent workflow for connecting an adopted starter project to a running local WordPress installation.
IndexType: Workflow
IndexStatus: Active
LastEdited: 2026-11-12
-->

# Use AI on local WordPress

Open your adopted project repository in your coding agent. Give the agent the WordPress folder and the change you want.

```text
My local WordPress is at <absolute WordPress folder>.
Use this repository to <describe the change>.
Update the local site and give me a link to review.
```

## Agent workflow

1. **Identify the target.** Confirm the project is an adopted copy and locate the supplied installation's `wp-load.php` and `wp-config.php`. Inspect the target locally to identify its home URL, active theme folder and literal table prefix. Ask the owner for a missing detail only if local inspection cannot resolve it. Keep credentials and private configuration out of chat and Git. For a new installation, follow the [new site checklist](NewCommissionSiteChecklist.md).
2. **Connect the project.** Configure the adopted project's `Workspace/LocalWordPressBuild/site-manifest.json` using the [runner contract](../../Workspace/LocalWordPressBuild/README.md). Use the installed PHP for that stack and an explicit WordPress root when needed. Check any existing target configuration before switching sites. The runner expects a loopback URL and a folder whose name matches `siteKey`. If the target fails the contract, identify the mismatch before any apply.
3. **Prepare the requested change.** Follow [WordPressContentUpdate](../WordPressContentUpdate/Prompt.md) for page source, layout, and manifests. Inspect existing runtime content before first taking over a page from the dashboard. For an ordinary page such as About, add its slug and Markdown filename to the `pages` map and select it with `--pages=about`. Route theme work through [StudioPressGenesisChildTheme](../StudioPressGenesisChildTheme/Prompt.md). Include navigation, widget, or theme steps only when the task requires them. Replace starter example content and layout entries with project-specific ones. Check that the image files for the selected page exist before applying.
4. **Plan and apply the local change.** Run the matching static plan and check its target and scope. For the requested local write, follow [WordPressMigrationBackup](../WordPressMigrationBackup/Prompt.md). Pass the exact target's `-WpConfigPath` and a unique project-local `-OutputPath` to the export helper, and preserve any theme files the step will modify. Verify the backup before running the scoped apply. An owner's explicit request to update the identified local site supplies approval for that scoped write. If only a draft or plan was requested, stop at that scope.
5. **Verify and return the result.** Open the changed page at its local URL and check the requested change and any affected links or menus. Give the owner that URL and mention anything that could not be verified. For direct dashboard or runtime edits the owner wants to capture, use [WordPressSave](../WordPressSave/Prompt.md).

For a page edit the agent can use these commands from the repository root, with the adopted site manifest configured.

```powershell
php Workspace/LocalWordPressBuild/ges-build.php --pages=about --plan
php Workspace/LocalWordPressBuild/ges-build.php --pages=about --write
```
