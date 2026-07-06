<!--
IndexTitle: MirrorToWindows Path Discovery
IndexDescription: Path discovery for local Git root and Windows mirror target in consumer starter.
IndexType: Capability
CapabilityName: MirrorToWindows
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-12
-->

# MirrorToWindows Path Discovery

Resolve paths with owner confirmation — do not guess drive letters.

## Local Source

1. `Workspace/OwnerPreferences.md` → **Local repository root**
2. `GETESTABLISHED_LOCAL_REPO_ROOT` if set
3. Current workspace root with `AGENTS.md` and `Capabilities/`

## Mirror Target

1. `Workspace/OwnerPreferences.md` → **Mirror target path**
2. **Google Drive mirror root** if mirror target unset
3. `GETESTABLISHED_MIRROR_TARGET_ROOT` if set
4. Propose common patterns (owner confirms):

   ```text
   %USERPROFILE%\Dropbox\Repositories\<RepositoryName>
   %USERPROFILE%\Google Drive\Repositories\<RepositoryName>
   D:\Backup\Repositories\<RepositoryName>
   ```

5. Fail with clear discovery steps if unresolved.

Write confirmed paths via [SetupPrompt.md](SetupPrompt.md).

## Related

- [MirrorWorkflow.md](MirrorWorkflow.md)
