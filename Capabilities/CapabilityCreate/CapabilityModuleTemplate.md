<!--
IndexTitle: Capability Module Template
IndexDescription: Copy-ready scaffold for new GetEstablished Capability folders.
IndexType: Capability
CapabilityName: CapabilityCreate
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-05
-->

# Capability Module Template

Copy this scaffold when authoring a new Capability. Replace `<CapabilityName>`
and fill every `TODO` before marking **IndexStatus: Active**.

Read [CapabilityMetadataStandard.md](../../Standards/CapabilityMetadataStandard.md)
and [Rules.md](Rules.md) before creating files.

---

## README.md

```markdown
<!-- Index: TODO one-line folder purpose. -->
<!--
IndexTitle: <CapabilityName> Capability
IndexDescription: TODO short description for indexes.
IndexType: Capability
CapabilityName: <CapabilityName>
CapabilityVersion: 1
IndexStatus: Draft
LastEdited: YYYY-MM-DD
-->

# <CapabilityName> Capability

- **Version:** 1
- **Tier:** Universal | Archetype | Commissioned | N/A
- **Purpose:** TODO what this Capability does.
- **Inputs:** TODO what the owner or agent supplies.
- **Outputs:** TODO files, handoffs, or decisions produced.
- **WhenToUse:** TODO user intents that trigger this Capability.

## Start Here

TODO primary entry file — often Prompt.md or WorkflowIndex.md.

## Harmonization Metadata

| Field | Value |
| --- | --- |
| **CreatedFrom** | CapabilityCreate |
| **SourceSummary** | TODO why this Capability exists |
| **PromotionStatus** | Draft |
| **Dependencies** | TODO Capabilities, Standards, tools — or None |
| **RelatedFiles** | Prompt.md, Rules.md |
| **LastReviewed** | YYYY-MM-DD |
| **HarmonizationNotes** | None |

## Capability Changelog

| Date | Ver | Change | Lesson / why | Files |
| --- | ---: | --- | --- | --- |
| YYYY-MM-DD | 1 | Initial Capability scaffold | TODO | README, Rules, Prompt |

## Related

- [AgentCapabilityGuide.md](../AgentCapabilityGuide.md)
- [CapabilityMetadataStandard.md](../../Standards/CapabilityMetadataStandard.md)
```

---

## Rules.md

```markdown
<!--
IndexTitle: <CapabilityName> Rules
IndexDescription: Operating rules for <CapabilityName>.
IndexType: Capability
CapabilityName: <CapabilityName>
CapabilityVersion: 1
IndexStatus: Draft
LastEdited: YYYY-MM-DD
-->

# <CapabilityName> Rules

## Scope

In scope:
- TODO

Out of scope unless separately approved:
- TODO

## Situational Awareness

When **<CapabilityName>** is the active Capability (after core SA):

- TODO checks before mutation

## Related

- [README.md](README.md)
- [Prompt.md](Prompt.md)
```

---

## Prompt.md

```markdown
<!--
IndexTitle: <CapabilityName> Prompt
IndexDescription: Copy-ready worker prompt for <CapabilityName>.
IndexType: Capability
CapabilityName: <CapabilityName>
CapabilityVersion: 1
IndexStatus: Draft
LastEdited: YYYY-MM-DD
-->

# <CapabilityName> Prompt

Read [Rules.md](Rules.md) before using this prompt.

\`\`\`text
# Worker pass: <CapabilityName>

Read first:
- AGENTS.md
- Capabilities/<CapabilityName>/README.md
- Capabilities/<CapabilityName>/Rules.md

Goal:
TODO scoped goal.

Rules:
- TODO

End with one fenced handoff:
Summary, Files Changed, Planning Files To Review,
Questions Added Or Changed, Next Recommended Task
\`\`\`
```

---

## After Creating The Module

1. Add a registry row to `Capabilities/README.md`.
2. Add a routing row to `Capabilities/AgentCapabilityGuide.md`.
3. Add to `AGENTS.md` Capability Discovery when **IndexStatus** is Active.
4. Record open questions in `Plans/OpenQuestions.md` if placement is unsettled.

## Related

- [Structure.md](Structure.md) — optional provisioned paths
- [Prompt.md](Prompt.md) — CapabilityCreate worker entry
- [Rules.md](Rules.md) — placement and tier rules
