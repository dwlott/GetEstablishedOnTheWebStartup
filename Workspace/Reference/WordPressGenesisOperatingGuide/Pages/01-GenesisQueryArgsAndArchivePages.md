<!--
IndexTitle: Genesis query_args and Archive Pages
IndexDescription: How Genesis uses the query_args page custom field to display category post lists on archive pages.
IndexType: Reference
IndexStatus: Active
LastEdited: 2026-06-13
GenesisSource: G:/wamp64/www/kirby-smith/wp-content/themes/genesis/lib/structure/loops.php
-->

# Genesis query_args and Archive Pages

## Use For Capability

Core pattern for GEOTW **dynamic content**: group posts by category, display them on
a dedicated page with static intro copy above the list.

## How It Works

Genesis 3.x checks each **Page** for a custom field named **`query_args`**. When
present, Genesis runs a custom post loop instead of treating the page as static
content only.

Source (read-only reference — do not edit Genesis core):

```text
G:/wamp64/www/kirby-smith/wp-content/themes/genesis/lib/structure/loops.php
```

Logic summary:

1. User visits a Page.
2. Genesis reads `query_args` from page meta.
3. Genesis parses it as URL query parameters (same shape as `WP_Query` args).
4. `genesis_custom_loop()` renders matching posts **below** any content in the page editor.

The page editor still holds **intro** material: titles, banners, explanatory HTML
(see kirby-smith **Newsletters** page).

## Owner Workflow (step by step)

1. **Create a category** — Posts → Categories. Example: Sharpshooter (kirby-smith ID **50**).
2. **Publish posts** assigned to that category.
3. **Note the category ID** — use Reveal IDs in the Categories list (see [02-CategoryIDWorkflow.md](02-CategoryIDWorkflow.md)).
4. **Create a Page** — add intro HTML in the editor (banner, headings, links).
5. **Add custom field** — scroll to **Custom Fields** (enable via Screen Options if hidden):
   - **Name:** `query_args`
   - **Value:** e.g. `showposts=5&cat=50`
6. **Optional template** — assign **Custom Blog** (`page_blog.php` on Altitude Pro). Genesis 3 prefers the custom field; template is legacy label.
7. **Publish** and verify the post list appears under the intro.
8. **Link from nav** — add the page to Primary menu or NS Category Widget sidebar.

## kirby-smith Example

| Item | Value |
| --- | --- |
| Page | Newsletters (`/newsletters/`) |
| Category | Sharpshooter |
| Category ID | 50 |
| query_args | `showposts=5&cat=50` |
| Template | Custom Blog |
| Live site | https://www.scv-kirby-smith.org/ |

Full inventory: [Examples/kirby-smith-category-map.md](../Examples/kirby-smith-category-map.md).

## Recipe reference

Common `query_args` strings: [Examples/query-args-recipes.md](../Examples/query-args-recipes.md).

## Where not to use query_args

| Surface | Why |
| --- | --- |
| Altitude widget **front page** | front-page-1 … 7 widgets control the home layout |
| Core marketing **Pages** migrated from Markdown | Start Here, Offers, etc. are static page bodies |
| Posts | query_args applies to **Pages** only |

## GEOTW first archive pages (planned)

After categories exist, create pages documented in
[05-GEOTWContentArchitecture.md](05-GEOTWContentArchitecture.md) and register IDs in
[Examples/geotw-category-id-register.md](../Examples/geotw-category-id-register.md).

## Related

- [02-CategoryIDWorkflow.md](02-CategoryIDWorkflow.md)
- [05-GEOTWContentArchitecture.md](05-GEOTWContentArchitecture.md)
- Local WordPress build: [Workspace/LocalWordPressBuild.md](../../../LocalWordPressBuild.md)
