<!--
IndexTitle: Site Deploy Profiles
IndexDescription: Per-site WordPress database deploy data for Bluehost (template + project profiles).
IndexType: Reference
IndexStatus: Active
LastEdited: 2026-07-24
-->

# Site Deploy Profiles

**Data** for the WordPress database deploy workflow. Method notes:
[Plans/WordPressMigrationCapabilityPlan.md](../../Plans/WordPressMigrationCapabilityPlan.md).
SQL prep scripts: [Automation/BluehostDatabasePrep/](../../Automation/BluehostDatabasePrep/).

## Start here

1. Copy [`_TEMPLATE.md`](_TEMPLATE.md) to `{SiteKey}.md`.
2. Fill fields from `site-manifest.json` and Bluehost cPanel (DB name, prefix).
3. Run Bluehost prep only when the owner approves SQL export (not go-live by itself).

## Sensitivity

- Table prefixes and database names are **not secrets**, but keep the repo
  **private** if you record them.
- **Never** add DB passwords, `wp-config.php`, or `.sql` dumps to Git.

## Profile fields

See `_TEMPLATE.md`. Important: **Full-DB push safe?** is **no** once production
has unique live data — back up production before any re-push.

## Read-only guardrail

Mark any site you must not deploy over as **read-only** in its profile. Do not
deploy over it unless the owner explicitly lifts that guardrail.
