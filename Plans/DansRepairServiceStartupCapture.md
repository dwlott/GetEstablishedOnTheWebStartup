<!--
IndexTitle: DansRepairService Startup Capture
IndexDescription: Pass 1 and pass 2 Quick Startup observations from adopting GetEstablishedOnTheWebStartup for dansrepairservice.com.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-07-06
-->

# DansRepairService Startup Capture

Consumer adoption test: copy **GetEstablishedOnTheWebStartup** →
`C:\Repositories\DansRepairService` → **Begin Quick Startup from AGENTS.md** in
Claude Code. Use this file to feed **GettingStarted** and **StarterRepositoryPackage**
improvements.

## Pass 2 — Validated (2026-07-06)

| Behavior | Result |
| --- | --- |
| Workspace Adoption Prep | Reset `<YourWebProjectName>` → `C:\Repositories\DansRepairService` automatically |
| Owner Goals / Valuable References scaffolds | Already clean; no permission stall |
| Greeting + five canonical questions | Displayed before writes |
| Owner answered in one turn + resume attach | Agent recorded goals, preferences, references |
| No planner handoff block at Quick Startup close | Improved (see session-close rules) |

**Owner script (condensed):** Dan's Repair Service, handyman in Vernal UT;
business plan + website markdown together; WordPress/StudioPress/Altitude;
establish Google/Yelp; target `dansrepairservice.com`; resume attached.

## Pass 2 — Remaining friction

| Issue | Notes | Suggested fix |
| --- | --- | --- |
| Same session rolled into **BusinessPlan** | Agent created `Content/OnePageBusinessWebsite/BusinessPlanDiscoveryNotes.md` after answers — useful, but blurs Quick Startup end vs next Capability | Quick Startup close first (owner session summary), then ask owner whether to continue with BusinessPlan now |
| **Claude project memory** saved | Agent reported "Saved a project memory" | Repo-first: prefer `Workspace/` registers; memory optional with owner choice per `ClaudeCode.md` |
| **`Plans/OpenQuestions.md` stale** | Still carries GEOTW/storefront template rows | Consumer repair should reset or banner OpenQuestions on adopt; agent correctly flagged leakage |
| **Resume folder** | Pass 1 used `Workspace/Reference/`; canonical place is `Workspace/Documents/` | Document in GettingStarted optional-upload routing; agent should use Documents/ for owner source files |
| **Private contact from resume** | Phone/email surfaced in discovery questions | Good for internal notes; mark do-not-publish in discovery notes (agent did ask about public contact) |

## Pass 1 — Failure modes (fixed or superseded)

- Stale product-builder **OwnerGoals** blocked greeting → **WorkspaceAdoptionPrep**
- Agent asked permission to overwrite goals → prep runs without asking
- Fenced **planner handoff** at end → **session close for owner** (plain chat)

## Recommended next smoke test

1. Fresh copy from latest `GetEstablishedOnTheWebStartup` `main`.
2. `Begin Quick Startup from AGENTS.md` — answer through step 11 close only; stop.
3. Confirm close shape in `PostQuickStartupRouting.md` § Quick Startup complete.
4. Owner says "continue with BusinessPlan" as a **separate** turn.
5. Save Claude transcript via **ChatToMarkdown** into `Plans/` or `Archive/`.

## Related

- [GettingStarted/WorkspaceAdoptionPrep.md](../Capabilities/GettingStarted/WorkspaceAdoptionPrep.md)
- [GettingStarted/PostQuickStartupRouting.md](../Capabilities/GettingStarted/PostQuickStartupRouting.md)
- [GetEstablishedOnTheWebStartupProvisioningTestReport.md](GetEstablishedOnTheWebStartupProvisioningTestReport.md)
- [LocalAgentToolSetup/Vendors/ClaudeCode.md](../Capabilities/LocalAgentToolSetup/Vendors/ClaudeCode.md)
