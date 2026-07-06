<!--
IndexTitle: Intended Repository Tree
IndexDescription: Growth map for Get Established consumer repos — core now, Capability paths when used.
IndexType: Capability
CapabilityName: RepositoryScaffold
CapabilityVersion: 1
IndexStatus: Active
LastEdited: 2026-06-06
-->

# Intended Repository Tree

Offer this map when the owner asks how the repository will grow. Markers:

- **[CORE]** — present in a fresh starter download (or repaired by SetupPrompt)
- **[CAPABILITY: Name]** — created only when that Capability Setup runs
- **[WHEN NEEDED]** — owner adds when real content exists

```text
<RepositoryRoot>/
├── AGENTS.md                              [CORE]
├── README.md                              [CORE]
│
├── Capabilities/                          [CORE]
│   ├── GettingStarted/                    [CORE]
│   ├── RepositoryScaffold/                [CORE]
│   ├── GitHubWorkflow/                    [CORE]
│   ├── ChatToMarkdown/                    [CORE]
│   ├── ContentReview/                     [CORE]
│   ├── LocalAgentToolSetup/               [CORE]
│   ├── SituationalAwareness/              [CORE]
│   ├── AssistedAgenticWorkflow/           [CORE]
│   ├── EmailIntake/                       [CAPABILITY: EmailIntake] commissioned import
│   ├── ScanIntake/                        [CAPABILITY: ScanIntake]
│   └── Indexing/                          [CAPABILITY: Indexing]
│
├── Standards/                             [CORE]
├── Plans/                                 [CORE] consumer setup subset
├── Ideas/                                 [CORE] README + light register
│
├── Content/
│   └── Website/Pages/                     [CORE] starter draft pages
│   └── OnePageBusinessWebsite/            [CAPABILITY: OnePageWebsite] when owner starts one-page draft
│
├── Workspace/                             [CORE] boot files only at download
│   ├── README.md                          [CORE]
│   ├── OwnerGoals.md                      [CORE]
│   ├── OwnerPreferences.md                [CORE]
│   ├── ValuableReferences.md              [CORE] candidate + approved external URLs
│   ├── Notes/                             [WHEN NEEDED]
│   ├── OpenQuestions/                     [WHEN NEEDED]
│   ├── Drafts/                            [WHEN NEEDED]
│   ├── Assets/                            [WHEN NEEDED]
│   └── …                                  [WHEN NEEDED] see Workspace/README.md
│
├── Inbox/                                 [CAPABILITY: EmailIntake / ScanIntake]
│   └── Emails/Incoming/                   [CAPABILITY: EmailIntake Setup]
│
├── Indexes/                               [CAPABILITY: Indexing Setup]
│   ├── ChatMarkdownIndex.md
│   └── InboxFileIndex.md                  [CAPABILITY: EmailIntake operate]
│
└── .git/                                  [WHEN NEEDED] after GitHubWorkflow Setup
```

## How To Present This To The Owner

1. Show **CORE** only as "what you have now."
2. Point to **CAPABILITY** rows as "appears when you run Setup for …"
3. Point to **WHEN NEEDED** as "add when you have real files — one folder + README."
4. Recommend **one** next Setup — not bulk mkdir.

## Consumer Starter Trim

The **StarterRepositoryPackage** pass removes empty **WHEN NEEDED** and
**CAPABILITY** folders from the download ZIP so the tree above is a **map**,
not pre-created empties.

## Related

- [Rules.md](Rules.md)
- [SetupPrompt.md](SetupPrompt.md)
- [../StarterRepositoryPackage/ScaffoldPolicy.md](../StarterRepositoryPackage/ScaffoldPolicy.md)
