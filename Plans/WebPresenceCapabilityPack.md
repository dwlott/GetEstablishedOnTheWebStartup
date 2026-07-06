<!--
IndexTitle: WebPresence Capability Pack
IndexDescription: Capability pack definition for web-presence archetype repositories and future GetEstablishedOnTheWebStartup packaging.
IndexType: Project
IndexStatus: Active
LastEdited: 2026-06-19
-->

# WebPresence Capability Pack

## Purpose

Define the Capabilities that belong together for a web-presence archetype:
website source content, one-page business website drafting, local profile basics,
publishing readiness, and WordPress operations.

This pack is separate from the **self-provisioning core**. The core makes a
repository able to initialize, audit, harmonize, and package a starter. The
WebPresence pack makes that starter useful for web work.

## Candidate Archetype Host

`GetEstablishedOnTheWeb` is the candidate self-provisioning host for this pack.
It already owns canonical public website content under:

```text
C:\Repositories\GetEstablishedOnTheWeb\Content\Website\
```

Before it produces `GetEstablishedOnTheWebStartup`, GEOTW should receive or
develop the self-provisioning core described in
[SelfProvisioningRepositoryModel.md](SelfProvisioningRepositoryModel.md).

## Pack Contents

| Capability | Status | Tier | Role |
| --- | --- | --- | --- |
| `ContentReview` | Active | Archetype | Review website page drafts for clarity, claims, and practical next steps. |
| `OnePageWebsite` | Active | Archetype | Draft an owner's one-page business website from approved inputs. |
| `WordPressWebsite` | Draft | Archetype | Parent router and safety rules for WordPress site work. |
| `WordPressContentUpdate` | Draft | Universal/Archetype support | Sync Markdown/manifests into WordPress when approved. |
| `StudioPressGenesisChildTheme` | Draft | Archetype | Genesis child-theme overlay, hooks, layout modes, and CSS sync. |
| `WordPressMigrationBackup` | Draft | Universal/Archetype support | Backup before WordPress experiments. |
| `GoogleBusinessProfile` | Planned | Archetype | Guide claiming or creating a Google Business Profile without overpromising results. |
| `YelpBusinessProfile` | Planned | Archetype | Guide claiming or creating a Yelp Business Page with review-policy guardrails. |
| `StarterRepositoryPackage` | Active core, profile planned | Archetype/core | Needs a WebPresence starter profile for `GetEstablishedOnTheWebStartup`. |

## Source Content For Planned Local Profile Capabilities

Current source pages live in the product repository:

```text
C:\Repositories\GetEstablishedOnTheWeb\Content\Website\Pages\GoogleBusinessProfileBasics.md
C:\Repositories\GetEstablishedOnTheWeb\Content\Website\Pages\YelpBasics.md
```

Those pages are content sources, not Capability folders. Promote them through a
scoped CapabilityCreate pass before treating them as active reusable workflows.

## Data And Claims Boundaries

WebPresence Capabilities that touch external profiles or public claims must state:

- no credential storage;
- no invented business facts;
- no legal, ranking, lead, review, or revenue guarantees;
- no review incentives;
- official links are references, not proof of platform endorsement;
- outputs stay in repository Markdown unless the owner approves an external-site
  or profile update pass.

## Starter Packaging Direction

`GetEstablishedOnTheWebStartup` should be packaged from a self-provisioning
GEOTW host, not directly from the method host. Its repair spec should decide:

- which self-provisioning core Capabilities remain in the starter;
- which WebPresence Capabilities remain active;
- whether WordPress draft Capabilities ship as active, draft, or omitted;
- whether Google/Yelp Capabilities ship as planned checklists or active workflow
  modules;
- which product content pages are starter examples versus live GEOTW site copy;
- which host or product Plans are excluded.

## Verification

Before marking the pack ready:

- `Capabilities/README.md`, `RouterIndex.md`, and `AgentCapabilityGuide.md`
  identify planned and active pack members consistently;
- Google/Yelp are planned or active Capability folders, not only content pages;
- WordPress Capabilities remain Draft until production/local build boundaries are
  validated;
- GEOTW receive rules do not bulk-copy method Plans;
- no informal role metaphors appear in durable docs.

## Related

- [SelfProvisioningRepositoryModel.md](SelfProvisioningRepositoryModel.md)
- [WordPressWebsiteCapabilityGroupPlan.md](WordPressWebsiteCapabilityGroupPlan.md)
- [GEOTWCoreReleaseWorkflow.md](GEOTWCoreReleaseWorkflow.md)
- [StarterRepositoryPackage](../Capabilities/StarterRepositoryPackage/README.md)
- [ContentReview](../Capabilities/ContentReview/README.md)
- [OnePageWebsite](../Capabilities/OnePageWebsite/README.md)
