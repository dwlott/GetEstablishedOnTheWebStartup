<!--
IndexTitle: CPanelEmail Prompt
IndexDescription: Copy-ready worker prompt for cPanel email accounts, forwarders, and Thunderbird.
IndexType: Capability
CapabilityName: CPanelEmail
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-07-17
-->

# CPanelEmail Prompt

Read [Rules.md](Rules.md) before using the block below.

```text
# Worker or planning pass: CPanelEmail

Repository: GetEstablishedOnTheWebStartup (or adopted project root)
Branch: main

Read AGENTS.md Capability Discovery, then:
- Capabilities/CPanelEmail/Rules.md
- Capabilities/CPanelEmail/README.md

Goal:
Help the owner add or reuse a cPanel/Bluehost email address and, when asked,
configure Thunderbird — preferring forwarders when mailbox slots are exhausted,
and manual IMAP/SMTP settings from Connect Devices.

Owner inputs (use what they already gave; ask once only if missing):
- Desired address (local part + domain)
- Full mailbox vs forwarder-only
- Destination inbox if forwarding
- Whether they need Thunderbird receive and/or send-as

Steps:

1. Confirm hosting context: Bluehost cPanel Email Accounts / Forwarders.
   Note mailbox Used / Available. If Available is 0 and they only need an
   address into an existing inbox, route to Forwarders — do not insist on
   Create Email Account.

2. Full mailbox path (only when a slot exists and a separate inbox is needed):
   - Email Accounts → + Create
   - Full address + strong password (owner sets; never write password into repo)
   - Connect Devices → copy Secure SSL/TLS manual settings
   - Thunderbird: Account Actions → Add Mail Account → manual if needed
   - Typical: IMAP mail.<domain>:993 SSL/TLS; SMTP mail.<domain>:465 SSL/TLS;
     username = full email address

3. Forwarder path (preferred at mailbox limit):
   - Forwarders → Add Forwarder (not Add Domain Forwarder)
   - Local part + domain on this cPanel account
   - Forward to Email Address = existing mailbox
   - Verify list row; send a test message from an external account
   - Optional Thunderbird: Manage Identities on destination account for send-as

4. Domain check: if the domain is missing from the cPanel dropdown, stop and
   explain — domain must be on this account and MX must point here.

5. Verify: external test message received; send-as works if requested.
   Prefer IMAP. Do not recommend POP3 unless the owner asks.

Stop conditions:
- No passwords or secrets in repository files
- No DNS/MX changes without owner confirmation
- No inventing spam/deliverability guarantees

If you changed repository files, end with exactly one fenced text handoff:
Summary, Files Changed, Planning Files To Review,
Questions Added Or Changed, Next Recommended Task.
Use ~72 characters per line; one path per line under Files Changed.
```

## Prompt history

- **2026-07-17 (v1):** Initial prompt from proven Bluehost forwarder + Thunderbird manual setup session.
