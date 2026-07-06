<!--
IndexTitle: WebPresence Startup Repair Spec
IndexDescription: Keep/remove, rewrite, detach, and verification rules for GetEstablishedOnTheWebStartup provisioning.
IndexType: Capability
CapabilityName: StarterRepositoryPackage
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-19
-->

# WebPresence Startup Repair Spec

Use this spec to repair a fresh copy of
`C:\Repositories\GetEstablishedOnTheWeb` into the disposable starter workspace
`C:\Repositories\GetEstablishedOnTheWebStartup`.

Starter profile: `GetEstablishedOnTheWebStartup`.

This is a test packaging profile, not a public distribution profile.

## Expected Outcome

| Item | Target |
| --- | --- |
| Source workspace | `C:\Repositories\GetEstablishedOnTheWeb` |
| Startup workspace | `C:\Repositories\GetEstablishedOnTheWebStartup` |
| Git metadata | Removed from startup workspace |
| Agent runtime config | `.cursor/`, `.claude/`, and nested `.git/` removed |
| Capability folders | GEOTW starter-safe rows only; router/registry parity required |
| Website source | Starter-safe examples under `Content/Website/` |
| WordPress production automation | Removed |
| Private review/work files | Removed or reduced to starter-safe scaffolds |

## Keep Matrix

Keep these top-level surfaces after repair:

```text
AGENTS.md
README.md
Capabilities/
Content/Website/
Content/OnePageBusinessWebsite/        (starter scaffold/examples if present)
Ideas/                                 (starter scaffold)
Plans/
Standards/
Workspace/
```

Keep these Capability folders:

```text
Capabilities/GettingStarted/
Capabilities/RepositoryScaffold/
Capabilities/GitHubWorkflow/
Capabilities/ChatToMarkdown/
Capabilities/ContentReview/
Capabilities/LocalAgentToolSetup/
Capabilities/SituationalAwareness/
Capabilities/AssistedAgenticWorkflow/
Capabilities/ManualIndexing/
Capabilities/Indexing/
Capabilities/OnePageWebsite/
Capabilities/InstructionCapture/
Capabilities/MirrorToWindows/
Capabilities/MirrorToDropbox/
Capabilities/MirrorToGoogleDrive/
Capabilities/GoogleDriveLink/
Capabilities/DropboxLink/
Capabilities/CapabilityAudit/
Capabilities/CapabilityCreate/
Capabilities/CapabilityHarmonize/
Capabilities/RepositoryInitialize/
Capabilities/StarterRepositoryPackage/
Capabilities/GoogleBusinessProfile/
Capabilities/YelpBusinessProfile/
```

Keep these Plans files:

```text
Plans/README.md
Plans/WebsiteGoals.md
Plans/GEOTWProductGoals.md
Plans/AgentTaskBacklog.md
Plans/OpenQuestions.md
Plans/RepositorySearchMap.md
Plans/UserSetupGuide.md
Plans/GEOTWCoreReceiveSpec.md
Plans/GEOTWCoreReleaseWorkflow.md
Plans/GEOTWSelfProvisioningPromotionPlan.md
Plans/WebPresenceCapabilityPack.md
Plans/SelfProvisioningRepositoryModel.md
Plans/SelfProvisioningVerificationChecklist.md
Plans/GetEstablishedOnTheWebStartupProvisioningTestReport.md
```

## Remove Matrix

Remove these from the startup workspace:

```text
.git/
.cursor/
.claude/
Intake/
Archive/
Automation/AgentReplies/
Automation/GoogleDriveRepositoryRefresh/
Automation/RepositoryRefresh/
Capabilities/CodeAssistedIndexing/
Capabilities/ImportCapabilitiesFromRepository/
Capabilities/ImportOwnerPreferencesFromRepository/
Workspace/LocalWordPressBuild/
Workspace/Reference/
```

Remove production-only or private product Plans unless deliberately rewritten as
starter-safe examples. Examples include local WordPress build reports, dry-run
paste previews, launch execution notes, brand promotion passes, and production
reference audits.

## Identity Rewrite Rules

Rewrite these files after copy:

| File | Startup identity |
| --- | --- |
| `AGENTS.md` | WebPresence starter boot; source of truth is the startup workspace after owner adopts it |
| `README.md` | `GetEstablishedOnTheWebStartup` starter repository |
| `Plans/RepositorySearchMap.md` | Starter-first paths; no production GEOTW publishing routes |
| `Capabilities/README.md` | Starter-safe Capability registry and statuses |
| `Capabilities/RouterIndex.md` | One row per kept Capability folder |
| `Capabilities/AgentCapabilityGuide.md` | Starter routing, first-run setup, web content, and local-profile planning |

Do not rewrite references inside Capability history that are explicitly about
host/source provenance unless they would confuse first-run routing.

## Status Rules

- `GoogleBusinessProfile` and `YelpBusinessProfile` remain **Planned** until
  their prompts are promoted and reviewed.
- WordPress, DNS, CF7, analytics, launch, and production publishing remain out
  of scope for this starter test.
- `Content/Website/` may contain example Markdown only. Remove claims that read
  as a finished business launch if they are not starter examples.
- Cloud mirror Capabilities may remain as docs-only onboarding aids. They must
  not include private owner paths or credentials.

## Verification

Run or manually confirm:

```powershell
$startup = "C:\Repositories\GetEstablishedOnTheWebStartup"
Test-Path "$startup\.git"
Test-Path "$startup\.cursor"
Test-Path "$startup\.claude"
(Get-ChildItem "$startup\Capabilities" -Directory | Where-Object { Test-Path "$($_.FullName)\README.md" }).Count
Select-String -Path "$startup\AGENTS.md","$startup\README.md" -Pattern "GetEstablishedOnTheWeb.com product repository"
Get-ChildItem "$startup" -Force -Directory | Where-Object Name -in @("Intake","Archive")
```

Expected:

- `.git`, `.cursor`, and `.claude` are absent.
- Capability folder count equals registry and router rows.
- `AGENTS.md` and `README.md` read as starter, not production GEOTW.
- No `Intake/`, private `Archive/`, local WordPress build automation, or
  production-only workspace reference tree remains.
- No informal role metaphors appear in durable docs.
