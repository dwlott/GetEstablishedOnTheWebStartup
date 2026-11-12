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

For an ordinary page, add a slug and filename to the `pages` map in
`content-manifest.php`, such as `'about' => 'About.md'`. The filename is
relative to `Content/Website/Pages`. Use `ges-build.php --pages=about --plan`
and then `--write` with the same selection for an approved local apply.
`--pages` is also supported by `ges-content-setup.php`. The selected page
sync skips categories, archives, sample posts, navigation, and the category
register. It keeps the status of an existing page and publishes new pages on
the configured local site. The static plan lists the selection without
executing the content manifest. Apply validates the mapping before loading
WordPress. Full content sync also applies configured ordinary pages.

For the agent workflow, see [Use AI on local WordPress](../../Capabilities/WordPressWebsite/UseAIOnLocalWordPress.md).

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

## Content fidelity

Post/page upserts take ordinary unslashed strings and apply `wp_slash()` once
at the WordPress persistence boundary. This preserves Windows paths, regex
backslashes, quotes and embedded JSON on both creation and update. Callers
should not pre-slash rendered content.

A page-layout row may supply trusted `intro_pitch_html`. It renders once after
the intro lead/deck and before body content, inside `ges-page-intro-pitch`.
With a photo it shares the intro grid; without a photo the configured
`intro_paragraphs` still determine the paragraphs before the pitch. Existing
third-paragraph pitches remain supported and render once; when both are supplied,
the legacy paragraph and configured HTML are included in the same pitch region.
Authored pitch paragraphs can use `class="ges-page-pitch"` for the existing style.
The runner's test suite includes content insert/update and layout regressions.
