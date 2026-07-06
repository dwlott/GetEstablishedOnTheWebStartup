<!--
IndexTitle: WebPresenceNode Rules
IndexDescription: Safety, data, claims, and routing boundaries for external web-presence node workflows.
IndexType: Capability
CapabilityName: WebPresenceNode
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-27
-->

# WebPresenceNode Rules

Use this Capability for one external web-presence node at a time: Google, Bing,
Yelp, Facebook, Nextdoor, Apple Maps, Yellow Pages, Foursquare, BBB, or a
similar public listing/profile surface.

## Data Boundaries

- May read owner-approved business facts in repository Markdown.
- May cite official vendor links and GEOTW guide pages.
- May write repository Markdown checklists, status notes, and next-step plans.
- Must not store passwords, verification codes, recovery details, payment
  details, private account identifiers, or credential screenshots in Git.
- Must not enter or change external vendor data without a separate
  owner-approved external-site pass.
- Must not invent business name, address, service area, category, hours, phone
  number, website URL, photos, ownership facts, licensing facts, or business age.

## Claims Boundaries

- Do not promise rankings, map placement, leads, calls, messages, reviews,
  recommendations, verification, approval, revenue, or accreditation.
- Do not imply any vendor endorses the repository, owner, or service.
- Do not treat official links as proof of platform endorsement.
- Do not advise review incentives.
- For Yelp specifically, do not advise asking customers, friends, family, or
  mailing-list subscribers for Yelp reviews.
- For BBB specifically, keep free Business Profile and paid Accreditation
  separate.

## Vendor Routing

Start with the parent node workflow, then consult the source page for the
selected vendor:

| Vendor / node | Source page |
| --- | --- |
| Google Business Profile | `Content/Website/Pages/GoogleBusinessProfileBasics.md` |
| Bing Places | `Content/Website/Pages/BingPlacesBasics.md` |
| Facebook Business Page | `Content/Website/Pages/FacebookBusinessPageBasics.md` |
| Nextdoor Business Page | `Content/Website/Pages/NextdoorBusinessPageBasics.md` |
| Foursquare Business Listing | `Content/Website/Pages/FoursquareBusinessListingBasics.md` |
| BBB Business Profile | `Content/Website/Pages/BetterBusinessBureauProfileBasics.md` |
| Yelp Business Page | `Content/Website/Pages/YelpBasics.md` |
| Apple Maps | `Content/Website/Pages/AppleMapsBasics.md` |
| Yellow Pages / YP.com | `Content/Website/Pages/YellowPagesBasics.md` |

If a vendor needs special policy boundaries beyond this parent workflow, promote
a vendor-specific child Capability later. Until then, do not create one-off
Capability folders for each guide page.

## Suggested Node Status Shape

When writing a repository note, use a compact status shape:

```text
Node:
Official link:
Status: not started | search needed | found unclaimed | claimed | needs verification | live | needs update | blocked
Owner account:
Verification owner:
Business facts needed:
Open decisions:
Next action:
Last reviewed:
```

Do not add this as a required file structure unless the owner approves a setup
pass for a starter or customer repository.

## External-Site Pass Rule

Before changing anything on a vendor site, confirm:

1. The owner explicitly asked for external-site action.
2. The business facts are owner-approved.
3. The account owner is present or has approved the action.
4. No credentials or verification codes will be pasted into chat or committed.
5. The result will be summarized back into repository Markdown.

## Related

- [Prompt.md](Prompt.md)
- [README.md](README.md)
- [WebPresenceCapabilityPack.md](../../Plans/WebPresenceCapabilityPack.md)
