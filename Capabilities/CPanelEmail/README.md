<!-- Index: Guide cPanel/Bluehost email mailboxes, forwarders, and Thunderbird setup. -->
<!--
IndexTitle: CPanelEmail Capability
IndexDescription: Operate cPanel email accounts and forwarders; configure Thunderbird with manual IMAP/SMTP settings.
IndexType: Capability
CapabilityName: CPanelEmail
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-07-24
-->

# CPanelEmail Capability

- **Version:** 1
- **Tier:** Universal
- **Purpose:** Help the owner add or reuse email addresses on Bluehost/cPanel without burning mailbox slots when a forwarder is enough, and configure Thunderbird using proven manual IMAP/SMTP settings.
- **ProvenOn:** US1Movers session 2026-07-17; ported into this starter 2026-07-24.
- **Inputs:** Target address (local part + domain), destination mailbox if forwarding, whether send-as is needed, Thunderbird or webmail preference.
- **Outputs:** Step-by-step cPanel and Thunderbird guidance; optional Thunderbird identity for send-as; short verification checklist. No credentials stored in the repository.
- **WhenToUse:** Add mailbox; hit email account limit; create forwarder/alias; set up Thunderbird or another client; Connect Devices / manual mail settings; send as a forwarded address.

## Start Here

1. Read [Rules.md](Rules.md).
2. Run [Prompt.md](Prompt.md).

## Placement

Operates on **external** cPanel and the owner's mail client. Does not provision repo folders. Do not put passwords, mailbox dumps, or live server host secrets in git.

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | CapabilityCreate — session-proven Bluehost + Thunderbird workflow (2026-07-17) |
| **SourceSummary** | Full mailbox vs forwarder under a 2-account limit; Thunderbird manual IMAP/SMTP; send-as via identities |
| **PromotionStatus** | Active |
| **Dependencies** | None (vendor UI: Bluehost cPanel; client: Thunderbird) |
| **RelatedFiles** | README.md, Rules.md, Prompt.md |
| **LastReviewed** | 2026-07-17 |
| **HarmonizationNotes** | Owner confirmed manual Connect Devices / Thunderbird path is preferred over auto-config alone |

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-07-17 | 1 | Initial Active Capability | Two-mailbox plan; forwarders do not consume slots; manual IMAP 993 / SMTP 465 | README, Rules, Prompt |

## Related

- [Rules.md](Rules.md)
- [Prompt.md](Prompt.md)
- [AgentCapabilityGuide.md](../AgentCapabilityGuide.md)
- [CapabilityMetadataStandard.md](../../Standards/CapabilityMetadataStandard.md)
