<!--
IndexTitle: CapabilityCreate Prompt
IndexDescription: Copy-ready worker prompt to author a new Capability from session work with placement-first structure.
IndexType: Capability
CapabilityName: CapabilityCreate
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-05-28
-->

# CapabilityCreate Prompt

Read [Rules.md](Rules.md) and [Structure.md](Structure.md) before using this prompt.

```text
# Worker pass: CapabilityCreate

Repository: {{REPOSITORY_NAME}}
Branch: main

Read AGENTS.md, Docs/Capabilities/CapabilityCreate/Rules.md and Structure.md,
Docs/Capabilities/README.md, Docs/Project/RepositoryMap.md (if present).

Owner inputs (use what the user already gave; no long questionnaire):
- What workflow to formalize (from this session or stated name)
- Optional Capability name hint (PascalCase)
- Whether disk folders are needed (yes/no/unsure)
- Target tier if known: Universal | Archetype | Commissioned | N/A

Goal:
Turn proven workflow work into a bounded Capability under
Docs/Capabilities/<CapabilityName>/ without polluting Owner/, website
content, or unrelated trees. Structure.md paths are suggestions only —
adapt after placement analysis.

Required work:

1. Confirm no duplicate Capability in registry or AgentCapabilityGuide.
2. Choose Tier per Rules.md; note ParentCapability if adapting from GEOTW.
3. Placement pass — document decisions (README or Rules Placement section):
   - Read repository map and existing Capabilities.
   - Apply placement matrix; reject anti-patterns in Structure.md section D.
4. Create Docs/Capabilities/<CapabilityName>/:
   - README.md (version 1, purpose, inputs, outputs, WhenToUse, changelog)
   - Prompt.md (one fenced text block for day-to-day operate workflow)
   - Rules.md (learned constraints, folder map, credentials never in repo)
   - Structure.md only if provisioned paths are plausible — mark paths as
     suggestions; include rationale per path
   - SetupPrompt.md only when Structure lists Setup-owned paths
5. Operate Prompt must: route missing structure to Setup offer (one sentence),
   not mkdir during unrelated tasks.
6. Update Docs/Capabilities/README.md (registry row, correct Tier and Status).
7. Update Docs/Capabilities/AgentCapabilityGuide.md intent row.
8. Update AGENTS.md Capability Discovery table if Status is Active.
9. Add Docs/Project/OpenQuestions.md rows for unsettled vendor, legal, or
   placement choices — do not block Capability shell on answers.
10. Do NOT mkdir Inbox/, Indexes/, Owner subfolders, or Content/ paths unless
    this pass includes an approved SetupPrompt for the NEW Capability only.

Do not:
- Copy commissioned-instance intake paths onto GEOTW without explicit owner ask.
- Store secrets or API keys in the repository.
- Embed changelog or instructions inside the new Capability fenced Prompt block.

After making changes, end with exactly one fenced text handoff:
Summary, Files Changed, Planning Files To Review, Questions Added Or Changed,
Next Recommended Task.

Do not include full git status unless conflict, dirty state, or user requested
commit/sync.
```

## Prompt history

- **2026-05-28 (v1):** Initial CapabilityCreate prompt; placement-first; Structure as suggestions.
