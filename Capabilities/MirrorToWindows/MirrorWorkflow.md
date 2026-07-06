<!--
IndexTitle: Windows Mirror Workflow
IndexDescription: Manual apply steps for Windows repository mirror in consumer starter (docs-only).
IndexType: Capability
CapabilityName: MirrorToWindows
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-12
-->

# Windows Mirror Workflow

Run only when [WorkflowIndex.md](WorkflowIndex.md) approves. **No mirroring is the default.**

One-way: **local Git → mirror target**. Never sync target back as authority.

## Step 1 — Discover Paths

[PathDiscovery.md](PathDiscovery.md) + Owner Preferences. Read **Mirror purpose**.

## Step 2 — Confirm Before Apply

Report source, destination, purpose, purge policy, `.git` policy, and exclusions.

When owner said **backup**, confirm **Purge on mirror = no** before apply.

## Step 3 — Run Mirror (Apply)

**Consumer starter (default):** **documentation only** — no bundled automation.
Use one of:

1. **Manual selective copy** — handoff-listed files to same paths under mirror root.
2. **Robocopy** — owner runs locally. **Default = fast mirror** (incremental, no purge). Run a **full mirror** only when the owner explicitly asks for one:

| Style | Robocopy | When |
| --- | --- | --- |
| **fast** (default) | `/E` (no purge) | Every mirror unless a full mirror is requested |
| full | `/MIR` (purge extras) | Only on explicit owner request |

```powershell
$Source = "<local-repo-root>"
$Dest   = "<mirror-target-path>"
$Style  = "fast"   # fast = incremental/no purge (DEFAULT); full = /MIR purge (explicit request only)

$XD = @(".git", "node_modules", ".venv", "Intake", "IncomingIdeas")
$XF = @(".env", "*.pem", "*.key")

if ($Style -eq "full") {
  robocopy $Source $Dest /MIR /FFT /R:2 /W:2 /XD $XD /XF $XF
} else {
  robocopy $Source $Dest /E /FFT /R:2 /W:2 /XD $XD /XF $XF
}
```

Robocopy exit codes **0–7** = success band; **8+** = error.

Owners on the **GetEstablished archetype** may adopt `Automation/RepositoryMirror/`
separately — not required for this starter.

## Step 4 — Report Result

```text
Windows Mirror:
- Purpose: <review|backup|portability>
- Purge: yes|no
- Method: manual | robocopy
- Source / Destination
- Result: success | failed
```

Update **Last mirror refresh** in Owner Preferences (ISO date).

If purpose is **review** and target is GDrive, tell planner via GoogleDriveLink.

See [RepositoryMirrorStandard.md](../../Standards/RepositoryMirrorStandard.md).
