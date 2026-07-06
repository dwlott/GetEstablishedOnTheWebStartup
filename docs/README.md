# GitHub Pages static mirror (unpublished)

This folder is **generated output** from `Workspace/LocalWordPressBuild/geotw-github-pages-export.php`.

| Item | Status |
| --- | --- |
| Static HTML built in repo | Yes — safe to commit for review |
| GitHub Pages enabled | **No** — owner must approve in repo Settings → Pages |
| Canonical public site | [getestablishedontheweb.com](https://getestablishedontheweb.com) (WordPress) |
| Canonical source | `Content/Website/Pages/*.md` |

## Regenerate

```powershell
G:\wamp64\bin\php\php8.3.14\php.exe Workspace\LocalWordPressBuild\geotw-github-pages-export.php --write
```

## Local preview

Open `docs/index.html` in a browser, or serve this folder with any static file server.

## Publish (later — owner approval)

1. Confirm public vs private repo policy ([Plans/GitHubPagesHarmonyPlan.md](../Plans/GitHubPagesHarmonyPlan.md)).
2. Enable **Settings → Pages → Deploy from branch → `/docs`**.
3. Link from WordPress: “View static mirror on GitHub.”

Do **not** enable Pages until the owner approves a publish pass.
