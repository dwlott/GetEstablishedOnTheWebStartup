<!--
IndexTitle: Dropbox Intake Workflow
IndexDescription: IncomingIdeas cloud intake protected from mirror operations.
IndexType: Capability
CapabilityName: DropboxLink
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-05
-->

# Dropbox Intake Workflow

## Concept

**Incoming ideas** land in cloud staging first, get processed later, and
eventually become durable repository content in local Git.

| Stage | Location | Role |
| --- | --- | --- |
| Capture | `/Repositories/<Name>/IncomingIdeas/` | ChatGPT or owner writes raw ideas |
| Protected | Same folder | Excluded from mirror deletion — see [MirrorWorkflow.md](MirrorWorkflow.md) |
| Process | Local Git | Codex promotes to `Ideas/`, `Plans/`, etc. |
| Complete | Owner decision | Archive or delete cloud staging after promotion |

Google Drive uses My Drive **root** Google Docs for the same concept.
Dropbox uses a repository **folder** because ChatGPT can write `.md` files
inside the repository tree.

---

## IncomingIdeas Folder

Recommended path:

```text
/Repositories/GetEstablished/IncomingIdeas/
```

Local synced equivalent:

```text
%USERPROFILE%\Dropbox\Repositories\GetEstablished\IncomingIdeas\
```

Create the folder once when the owner approves cloud intake. ChatGPT may
create it when writing the first intake file if the connector allows folder
creation and the owner approved intake writes.

---

## Capture Rules

- ChatGPT may write `.md`, `.txt`, and other text-oriented files here.
- Filenames should be descriptive: `Topic-Idea-2026-06-05.md`.
- Do not treat `IncomingIdeas/` content as source of truth until promoted.
- Do not commit `IncomingIdeas/` cloud-only captures to Git unless the owner
  promotes them into local `Ideas/` or another folder.

---

## Mirror Protection

[MirrorWorkflow.md](MirrorWorkflow.md) excludes `IncomingIdeas/` from Robocopy
`/MIR`. Agent-owned intake files survive mirror runs.

`Intake/` (migration reference inside the repo) is also excluded from mirror.

---

## Processing Pass (Codex)

When the owner scopes an intake processing pass:

1. Read files from local synced `IncomingIdeas/` or ask ChatGPT for paths.
2. Triage each file:
   - Idea → local `Ideas/<file>.md`
   - Plan-worthy → local `Plans/<file>.md`
   - Noise → owner decision
3. Edit **local Git** only for promotion.
4. Report promoted paths in the worker handoff.
5. Owner decides whether to archive or delete Dropbox staging files.

---

## Relation To Local Ideas/

| Folder | Role |
| --- | --- |
| `IncomingIdeas/` (Dropbox) | Cloud staging — unprocessed |
| `Ideas/` (local Git) | Promoted possibilities — durable |
| `Intake/` (local Git) | Migration reference — do not modify without scope |

Do not route routine idea capture directly to local `Ideas/` when the owner
intended cloud staging first.

---

## Related

- [WorkflowIndex.md](WorkflowIndex.md) Step 7
- [RepositoryAccessWorkflow.md](RepositoryAccessWorkflow.md)
- [MirrorWorkflow.md](MirrorWorkflow.md)
