<!--
IndexTitle: CPanelEmail Rules
IndexDescription: Durable constraints for cPanel mailboxes, forwarders, and Thunderbird setup.
IndexType: Capability
CapabilityName: CPanelEmail
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-07-17
-->

# CPanelEmail Rules

Read before running [Prompt.md](Prompt.md).

## Scope

In scope:

- Creating or explaining **full email accounts** in cPanel (Email Accounts)
- Creating **forwarders** when the plan mailbox limit is already used
- Reading **Connect Devices** / Mail Client Manual Settings for IMAP/SMTP
- Guiding **Thunderbird** account setup and **Manage Identities** send-as
- Choosing which domain hosts the address (any domain on the same cPanel account)

Out of scope unless separately approved:

- Storing passwords, recovery codes, or live credentials in the repository
- Changing DNS / MX without owner confirmation
- WordPress, contact-form plugins, or public launch work
- Inventing deliverability, spam-score, or ranking claims

## Learned constraints (proven 2026-07-17)

1. **Mailbox limit vs forwarder.** Bluehost plans may allow only a small number of full mailboxes (example: two). A **forwarder** (`surveys@example.com` → existing inbox) usually does **not** consume a mailbox slot. Prefer a forwarder when the owner only needs an address that lands in an existing inbox.
2. **Manual settings are the reliable path.** Prefer cPanel **Connect Devices** → **Mail Client Manual Settings**, then Thunderbird **manual config**, over relying on auto-config alone. Auto Config may still be offered; if it fails, use the manual values.
3. **Secure defaults (typical Bluehost / same-domain mail host):**
   - Username: full email address
   - Incoming: IMAP, host `mail.<domain>`, port **993**, SSL/TLS
   - Outgoing: SMTP, host `mail.<domain>`, port **465**, SSL/TLS
   - IMAP/POP3/SMTP require authentication
   - Prefer **IMAP** over POP3 so read/delete state stays coordinated with the server
4. **Domain choice.** The local part can live on any domain present in that cPanel account (for example `surveys@movercalcs.com` forwarding to `dave@davelott.com`), not only the marketing site domain. Confirm the domain appears in the Forwarders domain dropdown; if missing, the domain is not on this hosting account or MX is elsewhere.
5. **Send-as.** Receiving via forwarder does not create a separate Thunderbird account. Add a **Manage Identities** identity on the destination mailbox account so the owner can send From the forwarded address using that account’s SMTP.
6. **Credentials.** Password is the **mailbox** password (or destination mailbox when only a forwarder exists). Never commit passwords. If login fails, reset via cPanel **Manage** on the full mailbox.

## Decision guide

| Need | Use |
| --- | --- |
| Separate inbox, password, storage quota | **Email Accounts → Create** (uses a mailbox slot) |
| Extra address into an existing inbox; at or near slot limit | **Forwarders → Add Forwarder** |
| Desktop client setup | **Connect Devices** → manual IMAP/SMTP → Thunderbird |
| Send From a forwarded address | Thunderbird **Manage Identities** on the destination account |

## Forwarder form (cPanel)

- **Add Forwarder** (not Add Domain Forwarder) for a single address
- Address to Forward: local part only (for example `surveys`)
- Domain: target domain on this account
- Destination: **Forward to Email Address** → full destination address
- Do not select discard/error unless intentionally rejecting mail

## Thunderbird

1. Account Settings → **Account Actions** → **Add Mail Account…** for a full mailbox
2. If auto-detect fails: manual IMAP/SMTP values from Connect Devices
3. For send-as on a forwarder: select the destination account → **Manage Identities…** → Add → Email Address = forwarded address

## Stop conditions

- Do not create a third full mailbox when a forwarder meets the need and the plan is at limit
- Do not store credentials in git or Capability files
- Pause if MX for the chosen domain does not point at this host (forwarder will not receive mail)

## Related

- [README.md](README.md)
- [Prompt.md](Prompt.md)
