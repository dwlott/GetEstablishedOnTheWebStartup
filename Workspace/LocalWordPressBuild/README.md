# Local WordPress Build Contract

Maintained source: this Startup repository. Product GEOTW scripts are a separate
pipeline and are not regenerated into this runner by renaming prefixes.

Configure `site-manifest.json`: adopted `siteKey` (also the local folder name),
loopback `localUrl` including port/path, literal `tablePrefix`, and active child
`theme`. Set an absolute `wampWwwRoot`, or leave it blank and supply an absolute
`--wp-root`. If both are supplied they must resolve to the same site. No environment
variables, owner preferences, deploy profile, or automatic site discovery override
this contract. Specialized save/mirror manifests remain separate.

The manifest must match the literal prefix in `wp-config.php`. During apply,
content/nav/front-page commands also check the loaded home URL and active theme
before calling their update helpers. Dynamic PHP prefix expressions and custom
non-loopback virtual-host names are deliberately rejected; configure an explicit
loopback mapping for this pipeline. The CLI uses the PHP executable that launched
it, so select the PHP binary explicitly when needed.

From this directory, preview the default CSS → content → navigation sequence:

```powershell
php ges-build.php --plan
```

The same command without flags also previews. Preview validates input presence
and configuration, lists target, inputs and intended actions, and exits without
loading WordPress or executing PHP manifests. It is a static plan, not a database
diff or proof of rendered correctness.

After owner approval and a recoverable database/theme backup:

```powershell
php ges-build.php --write
```

`--only=ges-theme-css-sync,ges-content-setup,ges-nav-menu-sync` selects a subset;
dependency order is retained. Unknown/empty/duplicate steps or options fail.
All selected file prerequisites are checked before the first child starts.
Children receive the same absolute manifest/root and explicit write flag.
The runner stops at the first failed child and returns its failure status; it
cannot roll back successful earlier steps. Review backups before retrying.

Each operational child also supports direct `--plan`/`--write`, `--manifest=...`
and `--wp-root=...`; omitting `--write` is always static preview. Explicit write
is permission to execute the trusted PHP source manifests. Review those manifests
before apply. Never point this pipeline at production.

Optional front-page sync requires an owner-configured `front-page-manifest.php`
returning a nonempty `sections` array with section/widget entries understood by
`ges-front-page-sync.php`, plus the referenced Markdown. It is not in the default
sequence. Select it with `--only=ges-front-page-sync` (or the complete ordered list).
`--sections=front-page-1` limits that step; `--section-anchors` applies only to nav.
Missing front-page configuration fails before other selected children execute.
The legacy `ges-local-setup.php` previews only and rejects apply: its product
widget/page initializer is replaced by the adopted manifest workflow.

CSS overlay sync uses the configured child theme and skips identical file copies.
Content/nav writes retain their existing WordPress behavior; full database-level
idempotence and browser acceptance require a separately scoped disposable site.

Run isolated tests with an explicit PHP path:

```powershell
python Automation/LocalWordPress/test_build_runner.py --php C:/path/to/php.exe
```

Run that command from repository root. Tests use temporary copied sources,
bootstrap tripwires, controlled child processes, and real CSS filesystem writes.
They do not connect to an installed WordPress/database or a network service.
Packaging must retain this README, the shared contract, guarded child scripts,
and the test file as a matched set, then rerun tests against the copied source.
