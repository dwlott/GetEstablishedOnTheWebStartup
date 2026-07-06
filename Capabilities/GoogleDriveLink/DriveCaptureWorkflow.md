<!--
IndexTitle: Google Drive Capture Workflow
IndexDescription: Save To GCloud and Drive-root capture workflow for promoting useful Google Docs into local repository Markdown.
IndexType: Capability
CapabilityName: GoogleDriveLink
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-01
-->

# Google Drive Capture Workflow

## Purpose

Document the proven Google Drive capture pattern for prompts, planning notes,
test documents, and handoffs that begin in ChatGPT or Drive and later need to
be promoted into the real local Git repository.

Google Drive is the capture and read path. Local Git is the edit source of
truth at the desk.

## App vs Plugin Roles

ChatGPT Google Drive App:

- On-the-go repository reading and chat bootstrapping.
- Finds the repository under
  `My Drive / Repositories / <RepositoryName>`.
- Reads `AGENTS.md` and `Plans/RepositorySearchMap.md`.
- Saves **Save To GCloud** captures as native Google Docs in My Drive root.
- Can use native Google Docs in My Drive root as the communication layer for
  long or complex planning notes and Codex prompts.
- Can create and update native Google Docs in My Drive root.
- Does not currently save real raw `.md` files directly to Drive.

Codex Google Drive Plugin:

- Desk workflow for reading Drive captures.
- Lists Google Drive root documents.
- Reads or exports Google Docs created by Save To GCloud.
- Converts useful capture content into real Markdown.
- Writes durable Markdown into the local Git repository.
- Skips empty, duplicate, or test-only documents.

Local Git:

- Source of truth for edits and commits.
- Destination for real Markdown documentation.
- Place where implementation agents should write durable repository changes.

Google Drive Desktop:

- Optional convenience for local Drive visibility.
- Useful for browsing, but not required for ChatGPT repository access.
- Sync or mirror setup is optional and was not required for the final
  workflow.
- Native Google Docs appear locally as `.gdoc` pointer files. Do not copy
  those pointer files into the repository; they are links to cloud documents,
  not durable Markdown content.

## Save To GCloud

**Save To GCloud** means:

```text
Create a temporary Google Doc in the connected Google Drive account's
My Drive root for later sorting.
```

Current proven write target:

- My Drive root.

Current proven write types:

- Google Doc creation.
- Google Doc content update.

Not proven:

- Direct write into a selected nested repository folder.
- Direct write into a selected GCloudIntake folder.

Useful phrase:

```text
Save this to GCloud.
```

Meaning: create a temporary Google Doc in My Drive root for later sorting.

## GDrive Enhanced Agentic Workflow Trigger

Use this trigger when live desk work needs Google Drive as a temporary handoff
and verification surface between a planning agent, the local repository, and
an implementation agent.

Use the enhanced workflow when one or more of these is true:

- The user is at the desk and actively coordinating a planning agent, Google
  Drive, a local repository, and an implementation agent.
- A generated implementation prompt is long enough that copying from chat is
  awkward, truncated, horizontally awkward, broken, or hard to inspect.
- The implementation agent needs a stable handoff document.
- The user wants a short pointer prompt instead of a long prompt.
- An implementation agent reports file changes and the planning agent needs
  refreshed repository verification before creating the next task.
- The user is moving quickly through planning, implementation, review, and
  follow-up loops.

Do not use this trigger when:

- The user is only capturing chat notes for later.
- The user wants Markdown saved for future processing.
- The task is small enough to paste directly.
- The Google Drive connector/app is not active and the user does not want to
  activate it.
- The receiving agent cannot access Google Drive links and no export or paste
  fallback is available.
- The repository source of truth would become unclear.

This differs from ChatToMarkdown and save-now-process-later workflows:
ChatToMarkdown converts useful chat material into repository Markdown. The
enhanced workflow coordinates live planner-to-implementation work and may use
a temporary cloud handoff document. Durable plans, prompts, rules, and reports
still belong in the repository.

## Long Prompt GDrive Handoff

Use this when a generated implementation prompt is long enough that normal
copying from chat is awkward, unreliable, truncated, or hard to review.

Normally, planning agents should provide Codex prompts in a click-to-copy
code block in chat. A planning file or Google Drive handoff does not replace
the click-to-copy prompt unless the prompt is too long or complex for normal
chat use.

This is a handoff convenience, not repository storage. The Google Doc lives in
My Drive root as a temporary prompt artifact and does not need to end in
`.md`. Final plans, reports, Capability docs, and source-of-truth updates
still belong in the local Git repository.

Google Docs are the Drive communication layer for this workflow. Do not make
raw `.md` upload the default.

Workflow:

1. Keep short or moderate prompts in chat as copy-ready fenced blocks.
2. Detect that the prompt is too long or awkward for normal click-to-copy use.
3. Confirm the streamlined Google Drive workflow is appropriate for the task.
4. Check that the Google Drive connector/app is active before attempting any
   Drive save or write.
5. If Drive is not active, stop and remind the user to load or enable the
   connector/app before retrying.
6. Create a native Google Doc in My Drive root for the full implementation
   prompt.
7. Fill the doc with the complete prompt, including repository branch,
   source-file context, scope boundaries, and report-back format.
8. Return the Google Docs link.
9. Provide a short click-to-copy pointer prompt in chat with the Google Doc
   URL.
10. If the Drive write fails, do not retry repeatedly. Stop and remind the user
   to load or enable the connector/app.
11. Retry only once after the user confirms Drive is active.
12. If Drive remains unavailable, return the full prompt in a click-to-copy
    block and optionally provide a local downloadable file.

Use this vendor-neutral pointer prompt shape:

```text
Read this cloud handoff document and execute it against:

<RepositoryPath>

<Google Doc URL>

Follow the repository instructions first, then follow the handoff document.
Report back with the changed files, any planning files to review, questions
added or changed, and the next recommended task.
```

OpenAI/Codex example:

```text
**Repository branch:** main

Read this Google Docs handoff first:

<Google Doc URL>

Then perform the repository task described there.

Follow AGENTS.md and Plans/RepositorySearchMap.md first.
End with the standard fenced text handoff block.
```

When an implementation agent receives this pointer prompt, it should read
repository instructions first, then read the Google Doc prompt, then execute
against the real local repository. Do not claim the prompt was saved inside a
repository folder unless that nested-folder write has been proven. Do not copy
`.gdoc` pointer files into the repository.

## Google Drive Root Handoff Notes

Use compact root handoff notes when a future ChatGPT session should pick up
from the refreshed gdrive repo copy. The note is a pointer, not the source of
truth.

Standard resume phrase:

```text
Pick up from where we left off in the last chat.
```

When the user says this, the agent should search the Google Drive root for the
active project's handoff note. For GEOTW, use:

```text
Pick Up Here - GEOTW
```

Read the root note first, then boot from the gdrive repo copy using
`AGENTS.md`, `Plans/RepositorySearchMap.md`,
`Plans/AgentTaskBacklog.md`, and any task-specific files named in the
note or backlog. Confirm the current Ready Next task before proceeding.

If the user says `Read Pick Up Here - GEOTW`, follow the same path, starting
from that named root note.

If the user says `Pick up from the planning folder` or names a specific
planning folder or project area, still boot from `AGENTS.md` and
`Plans/RepositorySearchMap.md` first. Then inspect the named planning
area using the map and backlog for context.

If the resulting task is read-only, use the refreshed gdrive repo directly. If
durable repository edits are needed, prepare or use an implementation agent
against the real local Git repository.

Template:

```text
# Pick Up Here - <ProjectName>

Current project:
<ProjectName>.

Current task:
<one-line task name>

Why this is next:
- <short reason>
- <short reason>

Read next:
- My Drive / Repositories / <RepositoryName> / AGENTS.md
- Plans/RepositorySearchMap.md
- Plans/AgentTaskBacklog.md
- <task-specific files>

Boundary:
Use the gdrive repo for read-only review. Use an implementation agent
only for durable repository edits in the local repository.

Caution:
<optional short caution, only if task-specific>
```

Do not put full local Git versus gdrive repo workflow, Capability
definitions, general planner/worker rules, long completed-work summaries, or
durable safety rules in the root note. Those belong in repository-owned files.

## Repository Promotion Workflow

1. Capture a prompt, note, summary, or handoff in Google Drive.
2. Give it a descriptive title. A `.md` suffix is optional and not required
   for native Google Doc handoffs.
3. Read back or export the actual Google Doc content.
4. Decide whether the content is a durable plan, reusable prompt, lesson
   learned, test artifact, duplicate, or temporary note.
5. Skip empty tests and pure duplicates unless they document a useful finding.
6. Save durable content as a real Markdown file in the local repository.
7. Place it according to `Plans/RepositorySearchMap.md`.
8. Treat the local repository file as the source of truth after promotion.

Native Google Docs may appear through Google Drive Desktop as `.gdoc` pointer
files. Do not copy `.gdoc` files into the repository. Use the Google Drive
plugin, Drive export, or manual copy to extract the actual document content,
then save that content as real Markdown.

## Useful Capture Types

- Repository access workflows.
- Google Drive App setup notes.
- Save To GCloud behavior and limitations.
- Live desk handoffs where a temporary Google Doc pointer is easier than chat
  copy/paste.
- Long implementation prompts that are easier to hand off through a temporary
  Google Doc pointer than through chat copy/paste.
- Connector limitations and test results.
- Planning prompts that should become future local worker tasks.
- Large-file intake references for scans, PDFs, photos, and assets that should
  not be committed to Git.

## Future Improvements

- Export recent Save To GCloud Google Docs as Markdown or plain text and place
  them into a reviewed repository intake workflow.
- Add a lightweight Drive-root capture index only after repeated use proves it
  helpful.
- If a raw `upload_file` action becomes available later, a future
  **Save To GCloud File** workflow may become a real `.md` upload path instead
  of a temporary Google Doc path.

Do not add scripts, automation, generated indexes, or repository intake folders
until a scoped task approves that structure.

## Drive Documents Processed

| Google Drive title | Classification | Repository action |
| --- | --- | --- |
| `Save To GCloud - Correct Root Target Prompt` | Durable GoogleDriveLink correction prompt | Captured here and in `RepositoryAccessWorkflow.md` as Save To GCloud root-capture guidance. |
| `CodexPrompt-GoogleDriveRepositoryAccess` | Durable repository access prompt | Already represented in `RepositoryAccessWorkflow.md`; key access and App-discovery findings preserved. |
| `PlanGoogleDriveWorkflowLessonsLearned.md` | Durable lessons learned | Captured here as Drive capture, handoff, and Drive-to-Git promotion guidance. |
| `PromptPlanGoogleDriveRootMarkdownMigrationCapability.md` | Future planning prompt | Cataloged as a possible future Drive-root capture migration workflow; no new Capability created. |
| `PromptPlanPlanningFolderExpiredPlansCleanupCapability.md` | Future planning prompt | Cataloged as a possible future planning-folder cleanup workflow; no new Capability created. |
| `PromptPlanGmailFolderCleanupCapability.md` | Empty temporary note | Skipped. |
| `ChatGPTWriteTest.txt` | Write test artifact | Skipped except for proving Google Doc creation/update in My Drive root. |
| `HelloWorld.txt` | Write test artifact | Skipped as a pure content test. |

## Apps Search Note

When searching ChatGPT Apps, several Apps may appear. Search for
`Google Drive` and choose the Google Drive App developed by OpenAI.

During testing, Superpowers appeared under Developer Tools and Pipedrive
appeared under Productivity. Those Apps were not evaluated and are not part of
this Google Drive repository workflow.

## Related

- [README.md](README.md)
- [RepositoryAccessWorkflow.md](RepositoryAccessWorkflow.md)
- [Rules.md](Rules.md)
- [../../Plans/RepositorySearchMap.md](../../Plans/RepositorySearchMap.md)
