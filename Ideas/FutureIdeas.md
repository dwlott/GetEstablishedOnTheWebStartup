<!--
IndexTitle: Future Ideas
IndexDescription: Parking lot for useful ideas that may become scoped repository tasks later.
IndexType: Maintenance
IndexStatus: Draft
LastEdited: 2026-05-27
-->

# Future Ideas

## Purpose

Capture useful ideas that are not ready for immediate implementation.

This file is for ideas from planning conversations, mobile capture, demonstrations, reviews, or future product thinking. It is not a task list by itself. Before implementation, an idea should become a scoped prompt, backlog item, planning note, or human decision.

This is the low-friction raw parking lot. When a raw idea here has enough shape to track toward a Plan or Capability, promote it to the curated register in `Plans/Ideas.md`. See `Plans/GoalsIdeasPlansCapabilitiesModel.md` for how the two files relate.

Use `Docs/Maintenance/RepositoryHousekeeping.md` instead when the idea is specifically about file organization confusion, stale files, proposed moves, proposed renames, indexing gaps, folder growth, or terminology cleanup.

## Ideas To Consider Soon

- Chat-to-Markdown memory capture and sync workflow: plan a future workflow for preserving important chat decisions, creative phrases, slogans, owner preferences, and workflow decisions in durable indexed Markdown records. The workflow should detect cloud-only, local, and hybrid contexts; prompt the owner conversationally when something should be saved; avoid making the owner manually edit Markdown or reconstruct lost context; provide pull reminders, commit/push handoff guidance, and concise commit messages when appropriate; keep owner preferences separate from core repository defaults; and use strong indexing so later agents can retrieve the right memory without old chat history. See `Plans/ChatMemoryCaptureWorkflowPlan.md`.
- Reusable agent-ready repository core: plan a future reusable core engine for new repositories that gives agents what they need to work efficiently from the start. The core should include agent-ready instructions, workflow files, best-practice indexing plans, clear repository talent or purpose guidance, owner preference separation, owner document and owner code separation, clean upgrade workflows, and user-friendly refresh of core files without overwriting owner-specific material. This is only a future idea, not an approved implementation task.
- Reference Source Registry: create a future registry for current information pointers, not stale pricing tables or copied comparison data. It should point agents toward durable source locations and review dates rather than pretending external facts stay fixed.
- Owner decision interview workflow: use a repeatable flow where an agent creates a multiple-choice decision packet from repository files, a planning agent interviews the owner in chat from that packet, and a later implementation-agent pass captures approved answers into planning files. The first reusable interview prompt now exists, but the broader workflow can still be refined across future decision packets. Future packets should surface the strongest known repository-backed options so owners can choose from clear choices instead of manually editing Markdown or reconstructing lost chat context.
- PowerShell-first GitHub helper instructions: keep GitHub command help practical and Windows-first for current GEOTW users, with copy-ready commands and clear stop conditions.
- Workflow teaching package pattern: each important workflow may eventually have a repository workflow doc, a matching public webpage, and a tutorial video embedded or linked on that webpage.

## Ideas For Later

- Python index path documentation: when the path registry task is approved, add a brief note under `Automation` or `Plans/RepositoryOrganizationPlan.md` that index generation may use Python under `Automation/IndexBuilders`. See `Docs/Setup/InitialSetupLog.md` session wrap.
- Offered repository versus GEOTW product repository distinction: clarify how the public Get Established Workspace differs from this product/proof repository when the offered product becomes more formal.
- Modular repository upgrade pattern: document how helper logic, prompts, standards, reference files, and future indexes can be upgraded without overwriting owner-owned content.
- Upgradeable repository workflow: plan a future workflow that lets core repository files be replaced or refreshed with minimal customization loss. Owner preferences, owner documents, and owner code should live in separate protected folders or files so replacing core folders does not overwrite owner-specific material. Owner preference files should clearly override core defaults, or feed a future customization workflow that adapts key core files. A future upgrade workflow should explain how to update the core repository safely, preserve owner-owned content, and include one ready-to-go prompt that guides agents through the upgrade process. This is only a future idea, not an approved implementation task.
- Resume/profile/portfolio helper module: plan a future module for individuals who need a professional presence rather than a business website.
- Apple/macOS compatibility notes for non-Excel workflows: document how Markdown, prompts, GitHub, and website content can work across platforms after Windows-first guidance is stable.

## Ideas Requiring Human Decision

- Decide when a Reference Source Registry becomes useful enough to create.
- Decide whether the offered repository needs a distinct template version separate from the GEOTW product/proof repository.
- Decide what quality checks should be public website guidance versus internal agent review guidance.
- Decide when macOS instructions should be added, and whether they should be separate from PowerShell-first setup notes.

## Ideas Moved Into Scoped Tasks

- PowerShell-first GitHub helper instructions: moved into `Docs/Setup/GitHubPowerShellHelper.md` as a scoped setup guide.
- Mobile idea capture workflow: moved into `Docs/Setup/MobileIdeaCaptureWorkflow.md` as a scoped workflow note.
- Cross-platform compatibility note: moved into `Plans/CrossPlatformCompatibilityNotes.md` as a planning note.
- Web presence quality check guidance: moved into `Plans/WebPresenceQualityReviewIdeas.md` and connected to `Plans/RepositoryQualityReviewPlan.md` as a high-level planning track.
- One-window Cursor demo script: moved into `Docs/Setup/OneWindowCursorDemoScript.md` as a scoped 60-second demonstration script for the access-aware planner/worker loop.

## Resolved Ideas

No resolved ideas yet.
