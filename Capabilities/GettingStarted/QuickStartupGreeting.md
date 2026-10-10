<!--
IndexTitle: Quick Startup Greeting
IndexDescription: Canonical opening greeting and five setup questions agents display after Workspace Adoption Prep.
IndexType: Capability
CapabilityName: GettingStarted
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-10-10
-->

# Quick Startup Greeting


**Agents:** Read [WorkspaceAdoptionPrep.md](WorkspaceAdoptionPrep.md) first and
classify the active repository before changing files. Apply resets and Git
detach only to a confirmed adopted copy. Preserve canonical repositories and
previously captured project goals. In a fresh adopted copy, display this
greeting and these five questions; do not invent a different set.

Do not write real Owner Goals until the owner answers. When resuming an
established project, use its existing goals and backlog rather than repeating
new-copy prep. Read `AGENTS.md` and [GettingStarted.md](GettingStarted.md) first.

## Opening (display to owner)

```text
Welcome — this workspace is ready for your project.

This folder helps you capture Ideas, turn them into Plans, and reach outcomes
you choose — with agents in small, reviewable steps. A website or online
presence is one supported path when your goals point that way; it is not the
only purpose of this repository.

Before I route any work, I need a short picture of your goals. Five questions
below — answer as briefly or fully as you like, and skip what does not apply
yet. When you answer, I will record practical outcomes in Workspace/OwnerGoals.md
and suggest one next step.

Take your time.
```

## Five setup questions (canonical)

Display exactly these — numbered. Examples are **illustrative**, not a
website-only default.

```text
1. What business, project, or workspace setup are you trying to establish?
   (Examples: organize a project in one repo, draft a book, stand up a service
   business, prepare website content before choosing a platform — not
   website-only.)

2. What are the first three to five outcomes you want this workspace to produce?
   (These become Owner Goals — practical results for your project, not
   method-builder or starter-template tasks.)

3. What should matter first in the next few sessions — repository organization,
   drafts, credibility, leads, reviews, or something else?

4. What devices and tools are you using for this work?
   (For example: Windows with Cursor, phone for notes only, browser-only on
   a tablet. I will note environment in OwnerPreferences.md.)

5. Do you have a prior folder, archive, notes, or repository to learn from?
   (If yes, describe it and roughly where it lives — I will record the path
   only; I will not copy anything without your approval.)
```

## After the owner answers

Follow [GettingStarted.md](GettingStarted.md) first-session order from step 4
onward: write Owner Goals (replace scaffold row), prior-repo path in Import
section if applicable, valuable references, optional reference review, **one**
suggested next task per [PostQuickStartupRouting.md](PostQuickStartupRouting.md),
park GitHub, offer optional indexing, finalize and verify adopted identity,
then **close for the owner**
(plain chat — not a planner handoff block).

## Do not

- Reset goals or detach Git before the repository is confirmed as an adopted
  copy. Follow [WorkspaceAdoptionPrep.md](WorkspaceAdoptionPrep.md).
- End with a fenced worker handoff block — Quick Startup closes for the **owner**
  in plain chat unless PlannerWorker workflow was explicitly requested.
- Assume a **planning agent** is waiting to receive a handoff.
- Substitute **UserDiscovery** questions (audience, offer, tone) for this
  greeting — route [UserDiscoveryPrompt.md](UserDiscoveryPrompt.md) **after**
  Owner Goals when business or page clarity is the next step.
- Lead with website-only examples as if every download is a web-presence project.
- Write Owner Goals before the owner responds.
- Use the word **run** when naming Quick Startup to the owner.

## Related

- [WorkspaceAdoptionPrep.md](WorkspaceAdoptionPrep.md) — reset stale boot files first
- [Rules.md](Rules.md) — boundaries and routing
- [FirstRunAgentPrompts.md](FirstRunAgentPrompts.md)
- [RepositoryIdentityTemplate.md](RepositoryIdentityTemplate.md) — final identity verification
