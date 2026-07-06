<!-- Index: Install and configure local vendor agent apps using index-first pointers. -->
<!--
IndexTitle: LocalAgentToolSetup Capability
IndexDescription: Index-first workflow to install local agent apps and offer post-install configuration.
IndexType: Capability
CapabilityName: LocalAgentToolSetup
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-05-29
-->

# LocalAgentToolSetup Capability

- **Version:** 1
- **Purpose:** Help users install and configure local vendor agent applications (Cursor first) using official documentation pointers, a vendor index, and a mandatory post-install configuration offer—not a copy of vendor manuals in git.
- **Inputs:** User names a vendor or asks to install/configure a local agent app; optional OS hint (Windows, macOS, Linux).
- **Outputs:** Install guidance from official links; post-install checklist walkthrough; optional copy-ready config snippet; optional live config edit only when the user approves in session.
- **WhenToUse:** Install Cursor; configure Cursor settings; word wrap or editor preferences; open GEOTW multi-root workspace after install.
- **ParentCapability:** GEOTW-specific (reference pattern for child repos: link to parent, do not copy vendor sheets into envelopes unless adapted).

## How To Run

1. Read [VendorToolIndex.md](VendorToolIndex.md) and match the vendor.
2. Open the pointer sheet under `Vendors/`.
3. Run [Prompt.md](Prompt.md) (copy-ready fenced block).
4. Follow [Rules.md](Rules.md).

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | promoted workflow — GEOTW local agent setup |
| **SourceSummary** | Index-first vendor install and configuration (Cursor first) |
| **PromotionStatus** | Active |
| **Dependencies** | VendorToolIndex, Vendors/Cursor, Vendors/ClaudeCode |
| **RelatedFiles** | Rules.md, Prompt.md, VendorToolIndex.md |
| **LastReviewed** | 2026-06-05 |
| **HarmonizationNotes** | Pointer sheets — not copies of vendor manuals |

## Related

- [Rules.md](Rules.md)
- [Prompt.md](Prompt.md)
- [VendorToolIndex.md](VendorToolIndex.md)
- [AgentSandboxAndPermissions.md](AgentSandboxAndPermissions.md)
- [AgentCapabilityGuide.md](../AgentCapabilityGuide.md)

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-05-29 | 1 | Initial Capability; Cursor pointer sheet | Install is not the end; index-first routing | README, Rules, Prompt, VendorToolIndex, Vendors/Cursor |
| 2026-06-07 | 1 | Claude Code vendor sheet; profile memory harmonization | Smoke test showed memory vs repo drift; repo-first rule | Vendors/ClaudeCode, VendorToolIndex |
