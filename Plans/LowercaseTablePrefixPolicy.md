<!--
IndexTitle: Lowercase Table Prefix Policy
IndexDescription: Policy for using an all-lowercase hardened WordPress table prefix so local WAMP and Linux production match.
IndexType: Plan
IndexStatus: Active
LastEdited: 2026-07-06
-->

# Lowercase Table Prefix Policy

Policy for choosing a WordPress **table prefix** that behaves the same on local
WAMP (Windows) and on Linux production hosting.

## Policy

- For new sites, use an **all-lowercase** hardened prefix (for example
  `abc1_`) instead of the default `wp_`.
- Keep the prefix identical, lowercase, end-to-end: `wp-config.php`, the local
  database tables, and the production database tables.

## Why

Windows MySQL is commonly configured with `lower_case_table_names = 1`, so table
names are stored lowercase and lookups are case-insensitive. Linux production
MySQL is typically **case-sensitive**, where `abc1_` and `Abc1_` are different
tables. A mixed-case prefix that "works" locally can create a mismatched second
set of tables when imported to a case-sensitive host.

Using an all-lowercase prefix everywhere removes per-deploy table-name casing
fixes.

## Verification checklist

- [ ] `$table_prefix` in `wp-config.php` is lowercase.
- [ ] Local `*_options` table uses the same lowercase prefix.
- [ ] Production tables (if any) use the same lowercase prefix.
- [ ] A local database dump imports to production with no renamed tables.

## Applying to an existing mixed-case install

Treat any prefix normalization as an **owner-approved pass** with a database
backup taken first. Do not change `wp-config`, host, or automation settings
without approval.

## Related

- [LocalWordPressSetupPlan.md](LocalWordPressSetupPlan.md)
- [../Automation/DatabaseBackups/Repair-LocalWordPressTablePrefix.ps1](../Automation/DatabaseBackups/Repair-LocalWordPressTablePrefix.ps1)
