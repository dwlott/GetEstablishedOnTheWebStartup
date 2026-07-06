<!--
IndexTitle: AssistedAgenticWorkflow Rules
IndexDescription: Owner supervision, agent pass, connector inspection, source-of-truth, mutation guardrail, and summary rules for the assisted agentic workflow.
IndexType: Capability
CapabilityName: AssistedAgenticWorkflow
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-03
-->

# AssistedAgenticWorkflow Rules

Canonical operating rules for the owner-supervised agentic workflow on
GetEstablished. Adapted from the planning baseline in
[AssistedAgenticWorkflowCapturePlan.md](../../Plans/AssistedAgenticWorkflowCapturePlan.md).

---

## 1. Owner Supervision Rules

- The owner reads each agent summary before approving the next pass.
- The owner sets scope before each pass. Agents do not expand scope without
  explicit approval.
- The owner decides when a pass is complete and when to continue.
- Approval of one pass does not authorize additional passes. Each pass needs
  its own explicit scope.
- The owner is the final authority on file changes, promotions, deletions,
  and folder structure decisions.
- The owner does not need to be a technical expert in each tool. The workflow
  should produce readable summaries and clear handoff notes.
- When the owner **re-pastes** a prior handoff into a new chat, treat it as
  normal ball confusion — follow [SituationalAwareness Rules](../SituationalAwareness/Rules.md)
  section 2 (duplicate summary detection; offer options if new needs are mixed in).

---

## 2. Agent Pass Rules

- Each pass should be small, focused, and clearly scoped.
- Agents must read `AGENTS.md` and any named task files before making changes.
- Agents must work only in the active local repository root.
- Do not modify files inside `Intake` unless the owner explicitly approves
  that scope.
- Agents must not create folders, move files, rename files, or delete files
  without explicit owner approval.
- Agents must end each pass with a concise summary: files changed,
  verification result, owner decisions needed, and next recommended task.
- Reports belong in `Plans/` unless the owner names another destination.
- Do not implement rename automation, bulk path rewrites, or large structural
  changes without a specific approved plan.
- Prefer targeted edits over broad sweeps. Broad sweeps risk unintended
  changes that are hard to review.
- When a path destination is unclear, list it as an owner-decision item in
  the pass report. Do not guess.

---

## 3. Connector Inspection Rules (Dropbox Profile)

These rules apply when ChatGPT or another external assistant inspects the
repository through the Dropbox connector.

### 3.1 Verify Connector Availability First

Before inspecting, the assistant must confirm the Dropbox connector is
available and active. If the connector is not available or not enabled, say
so immediately. Do not pretend to inspect Dropbox, fabricate file listings,
or guess at current state.

### 3.2 Use Exact Repository Paths

Use only the confirmed active path:

```text
/Repositories/GetEstablished
```

The old source-reference path is:

```text
/Repositories/GetEstablishedOnTheWeb
```

Do not confuse these two paths. The old path is source/reference only and
reflects a prior repository name. Do not silently switch to another cloud
folder or path.

### 3.3 Inspect The Root First

Start with a shallow folder listing of `/Repositories/GetEstablished` using
`max_depth=1`. Confirm the clean-root folders are visible before drawing
conclusions about repository state:

```text
Capabilities
Standards
Plans
Ideas
Automation
Workspace
Content
Archive
Intake
```

Do not proceed to deep subfolder inspection until the top-level structure
is confirmed.

When `Intake/` appears in the root listing, do not recurse into it during
routine inspection. `Intake/GetEstablishedOnTheWeb/` contains the old
source repository (~3,400 files including `.git/`, `.cursor/`, and
`.claude/` hidden directories). It is source/reference only and must not
be traversed during normal repository status checks.

### 3.4 Verify Named Files With Metadata

When a specific file's existence matters, check it by name and path. Report
exact results:

- A file that exists: confirm the path.
- A file that does not exist: report it as `NOT_FOUND` at its expected path.

Do not hide `NOT_FOUND` results. A missing file is useful information, not
an error to suppress.

### 3.5 Fetch File Content Only When Necessary

Listing folders is sufficient for existence checks. Fetch file text only
when the task requires inspecting wording, links, or structure — for example,
checking whether stale paths remain in a specific file.

If a fetch by file ID fails or is blocked, retry once using the exact Dropbox
path. If the second attempt fails, report the failure and stop.

### 3.6 Avoid Broad Recursive Scans By Default

Use targeted folder listings and named file checks. Broad recursive scans
covering many subfolders or many files should be explicitly scoped by the
owner because they are slow, noisy, and risk including irrelevant or sensitive
content.

### 3.7 Connector Inspection Is Read-Only By Default

The external assistant should inspect and report. It must not create, share,
move, rename, or delete files in Dropbox without an explicit owner-approved
mutation plan.

If the owner approves a mutation, define the exact mutation (file path,
operation, content) before acting.

### 3.8 Do Not Treat The Connector View As The Source Of Truth

The local repository is the source of truth. Dropbox may lag behind local
state if sync is incomplete. If the Dropbox view and local state differ,
the owner or local agent should verify the local repository before treating
the connector view as final.

When reporting discrepancies, describe both states: what Dropbox shows and
what local state is expected to be. Do not resolve the discrepancy without
owner confirmation.

### 3.9 Report In A Way That Helps The Next Agent

End inspection reports with enough detail for the next agent to resume:

- List exact files confirmed present, with paths.
- List exact files not found, with expected paths.
- List folders inspected.
- State whether the Dropbox view appeared current or lagged.
- Include the next recommended task.
- Put the final summary in a fenced text block for easy copying.

---

## 4. Source-Of-Truth Rules

- The active local repository is the source of truth for all file content.
- A synced Dropbox folder is an inspection surface. If Dropbox and local
  state differ, the local repository takes precedence unless the owner
  explicitly approves a cloud-to-local update.
- `Intake/GetEstablishedOnTheWeb` is the source/reference copy of the old
  repository. It is not the source of truth for active clean-root work.
- An external assistant viewing the repository through a connector may see
  a version slightly behind local state if sync has not completed. Agents
  and the owner should be aware of this latency.
- Agents must not treat an external assistant's connector view as more
  authoritative than the local repository. If there is a discrepancy, check
  the local file first.

---

## 5. Mutation Guardrails

Do not perform any of the following without explicit owner approval:

| Operation | Guardrail |
| --- | --- |
| Delete files | Require explicit owner approval naming the file. |
| Move or rename files | Require explicit owner approval naming source and destination. |
| Create folders | Require explicit owner approval naming the folder path. |
| Bulk path rewrites | Require a specific approved plan before execution. |
| Overwrite existing files without checking | Read the file first; compare before writing. |
| Modify Intake files | Require explicit scope approval for each pass. |
| Run Dropbox mutations from connector | Require an explicit owner-approved mutation plan with exact paths. |

---

## 6. Final Summary Expectations

Every agent pass ends with exactly one fenced text block using these fields:

```text
Summary
Files Changed
Files Created
Files Deleted
Verification
Owner Decisions Needed
Next Recommended Task
```

Rules:

- Keep lines roughly 72 characters where practical.
- Put each file path on its own line under Files Changed.
- State any `NOT_FOUND` files explicitly under Verification.
- List only genuine owner decisions under Owner Decisions Needed; do not
  list items the agent can resolve independently.
- Name one concrete next task.

---

## 7. Instruction Optimization

Shared orientation lives in
[Capabilities/SituationalAwareness/Rules.md](../SituationalAwareness/Rules.md)
Section 6. This Capability adds supervised-pass execution rules below.

---

## Situational Awareness

When **AssistedAgenticWorkflow** is the active Capability (after core SA):

- Confirm **owner-approved scope** for this pass before any mutation.
- Confirm **local repository** is the write target; connector view is inspect-only.
- Apply **mutation guardrails** — no moves, deletes, or promotions without explicit approval.

## Learned Constraints

- Do not expand pass scope without owner approval; one focused task per pass
  is safer than a broad sweep.
- Connector availability must be confirmed before any inspection claim.
- `NOT_FOUND` is a result, not a failure; report it clearly.
- The old repository path `/Repositories/GetEstablishedOnTheWeb` is
  source/reference only; do not navigate to it as the active repository.
- The owner's pass summary is the handoff; keep it concise and copyable.
- Reports default to `Plans/` unless the owner names another destination.
