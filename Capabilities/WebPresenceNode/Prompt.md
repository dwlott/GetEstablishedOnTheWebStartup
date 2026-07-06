<!--
IndexTitle: WebPresenceNode Prompt
IndexDescription: Copy-ready worker prompt for planning or reviewing one external web-presence node.
IndexType: Capability
CapabilityName: WebPresenceNode
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-27
-->

# WebPresenceNode Prompt

Read [Rules.md](Rules.md) before using this prompt.

```text
# Worker pass: WebPresenceNode

Repository: {{REPOSITORY_NAME}}
Node / vendor: {{GOOGLE | BING | FACEBOOK | NEXTDOOR | FOURSQUARE | BBB | YELP | APPLE_MAPS | YELLOW_PAGES | OTHER}}

Goal:
Help the owner plan, check, or update one external web-presence node using
owner-approved business facts and official vendor references. Keep outputs in
repository Markdown unless the owner explicitly approves an external-site pass.

First:
1. Read AGENTS.md, Capabilities/WebPresenceNode/README.md, and
   Capabilities/WebPresenceNode/Rules.md.
2. Identify the selected node and read the matching source page under
   Content/Website/Pages/.
3. If the vendor is unclear, ask one concise clarification before proceeding.

Workflow:
1. Confirm the purpose:
   - get listed for the first time;
   - claim an existing listing/profile;
   - review current status;
   - update known business facts;
   - compare multiple nodes for consistency.
2. Gather only owner-approved facts:
   business name, category, address or service area, phone, website, hours,
   description, photos/assets available, account owner, and verification owner.
3. Search the repository for any existing status note before creating a new one.
4. Produce a compact node status using:
   Node, Official link, Status, Owner account, Verification owner,
   Business facts needed, Open decisions, Next action, Last reviewed.
5. Use official vendor links from the source page. If a link appears stale,
   flag it and suggest an owner review; do not invent replacement steps.
6. If external-site action is requested, pause and confirm the external-site pass
   checklist in Rules.md before changing anything outside Git.

Do not:
- Store credentials, verification codes, payment details, or recovery details.
- Invent business facts.
- Promise rankings, leads, calls, reviews, messages, accreditation, approval, or
  revenue.
- Create duplicate vendor-specific Capability folders unless the owner asks for
  a CapabilityCreate pass for that vendor.

End with:
Summary
Node status
Facts still needed
Official links used
External-site action taken (yes/no)
Next recommended action
```

## Prompt history

- **2026-06-27 (v1):** Initial active prompt for one-node vendor/profile planning.
