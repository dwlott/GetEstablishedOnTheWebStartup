<!--
IndexTitle: Site Deploy Profiles
IndexDescription: Per-site WordPress database deploy data (host, DB name, table prefix, URLs) for the owner's Bluehost portfolio.
IndexType: Reference
IndexStatus: Active
LastEdited: 2026-06-25
-->

# Site Deploy Profiles

**Data** for the WordPress database deploy workflow. The reusable **method** lives
in [../Reference/WordPressGenesisOperatingGuide/Pages/17-PhpMyAdminDatabaseExportAndEdit.md](../Reference/WordPressGenesisOperatingGuide/Pages/17-PhpMyAdminDatabaseExportAndEdit.md)
(Update production from local). One method, one profile per site.

> Scope note: this is the owner's **multi-site portfolio**. It is captured here for
> convenience but is cross-site/method-level material that should likely **promote
> to the method host** (`C:\Repositories\GetEstablished`) so every site repo
> receives the method and each repo keeps only its own profile. Confirm with owner.

## Sensitivity

- These are **table prefixes and database names**, not secrets — but they are
  security-hardening details. Keep this repository **private**.
- **Never** add DB passwords, `wp-config.php`, or `.sql` dumps to Git. Store dumps
  in a local backup folder outside the repo.

## Portfolio inventory (production)

All sites share one Bluehost cPanel account: **`mindfxa6_`** at
`wp1.bluehost.com:2083`. Each WordPress install uses a hardened table prefix.

| Site | Production DB | Table prefix | Platform | Notes |
| --- | --- | --- | --- | --- |
| getestablishedontheweb.com | `mindfxa6_getestablished` | `xCN_` | WordPress (Genesis) | This repo's site |
| us1movers.com | `mindfxa6_us1movers` | **TBD** | WordPress | First deploy target — see [US1Movers.md](US1Movers.md) |
| movercalcs.com | `mindfxa6_movercalcs` | `Lr4_` | WordPress | See [MoverCalcs.md](MoverCalcs.md) |
| litestaffing.com | `mindfxa6_litestaffing` | `63b_` | WordPress | Duplicator plugin present |
| metatoolexcel.com | `mindfxa6_metatoolexcel` | `mFk_` | WordPress | CE4WP contacts plugin present |
| scv-kirby-smith.org | `mindfxa6_scvkirbysmith` | `wp_` | WordPress (Genesis) | Standard prefix; current **read-only reference** exemplar |
| *(nonxenon)* | `mindfxa6_nonxenon` | `vLV_` | WordPress | Discovered in cPanel; confirm domain/role |

Local (WAMP) database name, prefix, and URL for each site are recorded in that
site's profile (mostly **TBD** until captured).

## Profile fields (template)

Each `<Site>.md` profile should carry:

| Field | Notes |
| --- | --- |
| Live URL | e.g. `https://us1movers.com` |
| cPanel host | `wp1.bluehost.com:2083` |
| Production DB | `mindfxa6_<site>` |
| Production prefix | hardened, per site |
| Local URL | e.g. `http://localhost/us1movers` |
| Local WAMP root | `C:\wamp\www\...` or `G:\wamp64\www\...` |
| Local DB / prefix | local values |
| SSH / WP-CLI available? | yes/no per account |
| Default deploy mode | `full` \| `standard-partial` \| `custom` — see [Deploy modes](../Reference/WordPressGenesisOperatingGuide/Pages/17-PhpMyAdminDatabaseExportAndEdit.md#deploy-modes-draft) |
| Full-DB push safe? | yes if no live-generated data |
| Extra exclude tables | plugin/live-data tables beyond the default tricky list on page 17 |
| Backup folder (outside Git) | local path |
| Last deploy | date + mode used |

## Read-only guardrail

`scv-kirby-smith.org` is the **read-only reference** exemplar per the WordPress
guide. Do not deploy over it unless the owner explicitly lifts that guardrail in
its profile.

## Profiles

- [US1Movers.md](US1Movers.md)
- [MoverCalcs.md](MoverCalcs.md)
