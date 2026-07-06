<!--
IndexTitle: WebPresenceNode Capability
IndexDescription: Parent WebPresence Capability for planning, tracking, and harmonizing one external web-presence node such as Google, Bing, Yelp, Facebook, Nextdoor, Foursquare, BBB, Apple Maps, or Yellow Pages.
IndexType: Capability
CapabilityName: WebPresenceNode
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-27
-->

# WebPresenceNode Capability

- **Version:** 1
- **Tier:** Archetype
- **Status:** Active
- **Purpose:** Help a repository owner plan, track, and maintain one external
  web-presence node at a time, using official vendor references and conservative
  claims boundaries.
- **Inputs:** Owner-approved business facts; selected vendor or platform;
  current listing/profile status if known; relevant GEOTW listing-guide page;
  official vendor links.
- **Outputs:** Repository Markdown checklist, status note, owner decision list,
  or next-step plan. No external profile edits until the owner explicitly
  approves an external-site pass.
- **WhenToUse:** A web-presence repository needs to get established, update, or
  review status on Google, Bing, Yelp, Facebook, Nextdoor, Apple Maps, Yellow
  Pages, Foursquare, BBB, or a similar public profile/listing surface.

## Vendor Source Pages

Current public content sources:

```text
Content/Website/Pages/GoogleBusinessProfileBasics.md
Content/Website/Pages/BingPlacesBasics.md
Content/Website/Pages/FacebookBusinessPageBasics.md
Content/Website/Pages/NextdoorBusinessPageBasics.md
Content/Website/Pages/FoursquareBusinessListingBasics.md
Content/Website/Pages/BetterBusinessBureauProfileBasics.md
Content/Website/Pages/YelpBasics.md
Content/Website/Pages/AppleMapsBasics.md
Content/Website/Pages/YellowPagesBasics.md
```

Those pages are source references for visitor-facing guidance. This Capability
is the reusable workflow wrapper that tells agents how to gather facts, avoid
overclaims, route by vendor, and keep node status in repository Markdown.

## Placement

This Capability does not provision folders by default. It writes to existing
project planning or owner-approved Markdown surfaces chosen by the active
repository. In GEOTW product work, vendor guide copy stays under
`Content/Website/Pages/`; owner-specific business facts belong in the adopted
starter or customer repository, not the GEOTW marketing source.

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | Owner request after listing-guide expansion |
| **SourceSummary** | Parent workflow for external web-presence vendor nodes |
| **PromotionStatus** | Active |
| **Dependencies** | ContentReview; official vendor references; WebPresenceCapabilityPack |
| **RelatedFiles** | Prompt.md, Rules.md, Content/Website/Capabilities/WebPresenceNode.md |
| **LastReviewed** | 2026-06-27 |
| **HarmonizationNotes** | Replaces one-off vendor Capability sprawl with one parent node workflow; vendor-specific Capabilities may still be promoted later when a platform needs special rules. |

## Related

- [Prompt.md](Prompt.md)
- [Rules.md](Rules.md)
- [WebPresenceCapabilityPack.md](../../Plans/WebPresenceCapabilityPack.md)
- [ContentReview](../ContentReview/README.md)

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| 2026-06-27 | 1 | Created active parent Capability | Listing guides need a reusable node workflow so Google/Bing/Yelp/Facebook/Nextdoor/Foursquare/BBB-style work is routed consistently | README, Prompt, Rules |
