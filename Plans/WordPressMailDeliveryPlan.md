<!--
IndexTitle: WordPress Mail Delivery Plan
IndexDescription: Draft method for WordPress site mail, DNS authentication, and cPanel mailbox setup — separate concerns.
IndexType: Project
IndexStatus: Draft
LastEdited: 2026-09-03
-->

# WordPress Mail Delivery Plan

Draft method for **GetEstablishedOnTheWebStartup** and commissioned WordPress
sites. Separates three layers learned from US1Movers and MoverCalcsWeb.

**GetEstablished** (`C:\Repositories\GetEstablished`) is the general method host
for **non-web** work (books, resumes, and similar). Do not promote WordPress
mail Capabilities there.

## Three Layers (Do Not Conflate)

| Layer | What it covers | Active home today |
| --- | --- | --- |
| **CPanelEmail** | Mailboxes, forwarders, Thunderbird IMAP/SMTP | This starter `Capabilities/CPanelEmail/` |
| **WordPress mail transport** | `wp_mail()`, contact forms, REST mailer plugins, health checks | Commissioned — MoverCalcsWeb `BluehostEmailDelivery` |
| **DNS authentication** | SPF, DKIM, DMARC for a sending domain | Document in SiteDeployProfiles + owner DNS UI |

**CPanelEmail** answers: "How do I receive mail and configure a desktop client?"

**WordPress mail transport** answers: "How does the website send mail without
`mailto:` fallbacks?"

They share a domain but use different setup steps.

## CPanelEmail (this starter)

Proven on US1Movers (2026-07-17); Active here.

Key lessons:

1. **Mailbox limit vs forwarder** — forwarders usually do not consume a slot.
2. **Manual Connect Devices / Thunderbird** — IMAP 993, SMTP 465, SSL/TLS.
3. **Send-as** — Thunderbird Manage Identities for forwarded addresses.
4. **No credentials in Git.**

## WordPress Mail Transport (commissioned pattern)

Reference implementation: MoverCalcsWeb **BluehostEmailDelivery** (2026-09).

Method outline for future commissioned sites:

1. **Health endpoint** — secret-free JSON (`/wp-json/.../health`) for transport status.
2. **Fail closed** — missing production config must not send mail.
3. **Plugin boundary** — site-specific plugin in `wp-content/plugins/`; not in starter ZIP.
4. **DNS before launch** — verify SPF/DKIM/DMARC after first test send.
5. **Rollback path** — keep `mailto:` or manual workflow until live acceptance passes.

Do **not** copy `movercalcs-mailer` into this starter.

## Starter Owner Workflow

| Need | Route |
| --- | --- |
| New mailbox or forwarder | **CPanelEmail** |
| Thunderbird setup | **CPanelEmail** |
| WordPress contact form sends from site | Commissioned pass or owner-approved plugin — document in SiteDeployProfiles |
| Bluehost SQL / site launch | **WordPressMigrationBackup** + SiteDeployProfiles |

## SiteDeployProfiles Fields (mail)

Add to `Workspace/SiteDeployProfiles/<Site>.md` when mail work begins:

| Field | Example |
| --- | --- |
| Primary domain | `example.com` |
| Mail host | `mail.example.com` |
| From address | `hello@example.com` |
| SPF/DKIM/DMARC status | verified / pending / owner action |
| WordPress mail plugin | none / CF7 default / custom plugin name |

No passwords or API secrets in profiles.

## Promotion Path

| Step | Repo | Action |
| --- | --- | --- |
| 1 | GetEstablishedOnTheWebStartup | **CPanelEmail** Active; this plan lives here |
| 2 | Commissioned site | Site-specific BluehostEmailDelivery or equivalent |
| 3 | GetEstablishedOnTheWeb | Public page mentions only; no commissioned plugin |
| — | GetEstablished | Out of scope (non-web method host) |

## Related

- [CPanelEmail](../Capabilities/CPanelEmail/README.md)
- [WordPressMigrationBackup](../Capabilities/WordPressMigrationBackup/README.md)
- [CrossRepoCapabilityGapMatrix.md](CrossRepoCapabilityGapMatrix.md)
- MoverCalcsWeb: `Capabilities/BluehostEmailDelivery/`
- MoverCalcsWeb: `Plans/BluehostToolbarEmailIntegrationPlan.md`
