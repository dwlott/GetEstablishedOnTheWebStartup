<!--
IndexTitle: GoogleDriveLink Human Setup Decision Prompt
IndexDescription: Copy-ready prompt for choosing the first safe GoogleDriveLink setup target before live auth.
IndexType: Capability
CapabilityName: GoogleDriveLink
IndexStatus: Active
LastEdited: 2026-06-02
-->

# GoogleDriveLink Human Setup Decision Prompt

## Purpose

Use this prompt to choose the first safe GoogleDriveLink setup target before
any live OAuth, Google Cloud setup, MCP auth, credentials, sync automation, or
Skill creation.

## Copy-Ready Prompt

```text
# GoogleDriveLink human setup decision

Repository: GetEstablished
Branch: main

Goal:
Decide the first safe GoogleDriveLink setup target before any live OAuth,
Google Cloud setup, MCP auth, credentials, sync automation, or Skill
creation.

Context:
The GoogleDriveLink Capability is active and documentation-only. It is
intended to standardize how GetEstablished connects to Google Drive safely.
No live account connection should happen until these human decisions are
answered.

Please answer these setup decisions:

1. Google account or Workspace ownership

Which account should own the Google Drive connection?

Options:

* My personal Google account
* A dedicated GetEstablished Google account
* A Google Workspace account
* Not decided yet

Decision:

2. Internal/testing or external/public app status

Should the first setup be internal/testing only, or should it be planned
as an external/public OAuth app?

Recommended first choice:

* Internal/testing only

Decision:

3. First MCP-capable client target

Which client should be the first target for testing GoogleDriveLink?

Options:

* Local MCP-capable desktop agent
* OpenAI API / Responses API connector path
* Cursor if MCP support is configured
* Documentation-only for now
* Not decided yet

Decision:

4. First access level

What access level should the first test use?

Recommended first choice:

* Read-only or file-specific access
* Avoid broad Drive access unless clearly needed

Options:

* File-specific access only
* Read-only access
* Create/update access in a limited test folder
* Broad Drive access
* Not decided yet

Decision:

5. First non-sensitive Drive file or folder for testing

What Drive file or folder should be used for the first test?

Rules:

* Use non-sensitive files only.
* Do not use financial, legal, medical, private customer, credential, or
  identity documents.
* Prefer a temporary test folder created only for GetEstablished experiments.

Decision:

6. Drive role in the GetEstablished workflow

What role should Google Drive play first?

Options:

* Source: read selected Drive documents into repository planning
* Intake: collect files before they are reviewed and moved into repo docs
* Archive: store exported copies or backups
* Export: receive generated Markdown or reports
* Reference: hold external files that agents may inspect but not modify
* Not decided yet

Decision:

7. Future Skill discovery surface

If repeated executable Google Drive setup or validation steps become
useful later, where should a future Skill be discoverable?

Recommended first choice:

* Keep Skills out of scope now.
* Later propose Automation/Skills/GoogleDriveMcpConnect/SKILL.md only
  after repeated steps are proven useful.

Decision:

Safety confirmation:

* Do not commit credentials, tokens, OAuth client secrets, refresh
  tokens, .env files, or generated credential JSON.
* Do not run live OAuth or MCP auth until the decisions above are clear.
* Do not create sync automation in the first setup pass.
* Do not put Google Drive integration artifacts in Workspace/ or Content/.
* Keep the first test small, reversible, and non-sensitive.

Final setup target summary:

Google account / Workspace:
OAuth app status:
First client target:
Access level:
Test file or folder:
Drive workflow role:
Future Skill approach:
```

## Related

- [README.md](README.md)
- [Rules.md](Rules.md)
- [../../Plans/GoogleDriveLinkCapabilityPlan.md](../../Plans/GoogleDriveLinkCapabilityPlan.md)
- [../../Archive/HistoricalReviews/GoogleDriveLinkCapabilityReview.md](../../Archive/HistoricalReviews/GoogleDriveLinkCapabilityReview.md) (if it exists)
