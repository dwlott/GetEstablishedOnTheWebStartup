<?php
/** Shared CLI contract. Preview never loads WordPress or executes PHP manifests. */
function GES_build_steps() {
    return array('ges-theme-css-sync', 'ges-content-setup', 'ges-front-page-sync', 'ges-nav-menu-sync');
}
function GES_build_options($argv, $step = null) {
    $options = array('write' => false, 'plan' => false);
    $seen = array();
    foreach (array_slice($argv, 1) as $arg) {
        if (!preg_match('/^--([a-z-]+)(?:=(.*))?$/D', $arg, $m)) {
            throw new RuntimeException('Expected named CLI options.');
        }
        $name = $m[1];
        $flags = array('write', 'plan', 'force', 'section-anchors');
        $values = array('manifest', 'wp-root', 'only', 'sections');
        if (!in_array($name, array_merge($flags, $values), true)) {
            throw new RuntimeException('Unknown option: --' . $name);
        }
        if (isset($seen[$name])) { throw new RuntimeException('Duplicate option: --' . $name); }
        $seen[$name] = true;
        if (in_array($name, $flags, true)) {
            if (isset($m[2])) { throw new RuntimeException('Flag takes no value: --' . $name); }
            $options[$name] = true;
        } else {
            if (!isset($m[2]) || $m[2] === '') { throw new RuntimeException('Missing value: --' . $name); }
            $options[$name] = $m[2];
        }
    }
    if ($options['write'] && $options['plan']) { throw new RuntimeException('Choose --plan or --write.'); }
    if ($step !== null && isset($options['only'])) { throw new RuntimeException('--only belongs to ges-build.php.'); }
    if ($step !== null && isset($options['sections']) && $step !== 'ges-front-page-sync') { throw new RuntimeException('--sections requires front-page sync.'); }
    if ($step !== null && isset($options['section-anchors']) && $step !== 'ges-nav-menu-sync') { throw new RuntimeException('--section-anchors requires nav sync.'); }
    return $options;
}
function GES_build_absolute($path) {
    return is_string($path) && preg_match('~^(?:[A-Za-z]:[/\\\\]|/[^/])~', $path);
}
function GES_build_path($path) {
    if (!GES_build_absolute($path) || preg_match('/[{}<>\x00-\x1f]/', $path)) {
        throw new RuntimeException('Use an absolute path without placeholders.');
    }
    $real = realpath($path);
    if ($real === false) { throw new RuntimeException('Configured path does not exist.'); }
    return str_replace('\\', '/', $real);
}
function GES_build_equal_path($a, $b) {
    return PHP_OS_FAMILY === 'Windows' ? strcasecmp($a, $b) === 0 : $a === $b;
}
function GES_build_context($options) {
    $manifest = GES_build_path($options['manifest'] ?? (__DIR__ . '/site-manifest.json'));
    $config = json_decode(file_get_contents($manifest), true, 512, JSON_THROW_ON_ERROR);
    if (!is_array($config)) { throw new RuntimeException('Site manifest must be an object.'); }
    foreach (array('siteKey', 'localUrl', 'tablePrefix', 'theme') as $key) {
        if (!isset($config[$key]) || !is_string($config[$key]) || $config[$key] === '' || preg_match('/[{}<>]/', $config[$key])) {
            throw new RuntimeException('Missing or unresolved manifest field: ' . $key);
        }
    }
    if (!preg_match('/^[a-z0-9][a-z0-9-]*$/D', $config['siteKey']) || in_array($config['siteKey'], array('yoursite', 'sitekey'), true)) {
        throw new RuntimeException('Set siteKey to the adopted local site folder name.');
    }
    if (!preg_match('/^[A-Za-z0-9_-]+$/D', $config['theme']) || !preg_match('/^[a-z][a-z0-9_]*_$/D', $config['tablePrefix'])) {
        throw new RuntimeException('Invalid theme or tablePrefix.');
    }
    $url = parse_url($config['localUrl']);
    if (!$url || !in_array($url['scheme'] ?? '', array('http', 'https'), true) || !in_array(strtolower($url['host'] ?? ''), array('localhost', '127.0.0.1', '[::1]'), true) || isset($url['user']) || isset($url['pass']) || isset($url['query']) || isset($url['fragment'])) {
        throw new RuntimeException('localUrl must use a loopback host, with optional port and path.');
    }
    $mapped = null;
    if (!empty($config['wampWwwRoot'])) {
        $mapped = GES_build_path(rtrim($config['wampWwwRoot'], '/\\') . '/' . $config['siteKey']);
    }
    if (isset($options['wp-root'])) {
        $root = GES_build_path($options['wp-root']);
        if ($mapped !== null && !GES_build_equal_path($root, $mapped)) { throw new RuntimeException('--wp-root conflicts with wampWwwRoot/siteKey.'); }
    } elseif ($mapped !== null) {
        $root = $mapped;
    } else { throw new RuntimeException('Set wampWwwRoot or pass an explicit --wp-root. No site is auto-discovered.'); }
    if (basename($root) !== $config['siteKey']) { throw new RuntimeException('WordPress folder must match siteKey.'); }
    foreach (array('wp-load.php', 'wp-config.php') as $file) {
        if (!is_readable($root . '/' . $file)) { throw new RuntimeException('Missing WordPress prerequisite: ' . $file); }
    }
    // Read configuration as text only: never execute wp-config.php during preview.
    $wp_config = file_get_contents($root . '/wp-config.php');
    if (!preg_match('/\$table_prefix\s*=\s*([\'\"])([a-zA-Z0-9_]+)\1\s*;/', $wp_config, $match) || $match[2] !== $config['tablePrefix']) {
        throw new RuntimeException('wp-config.php must contain a literal table prefix matching site-manifest.json.');
    }
    return array('options' => $options, 'manifest' => $manifest, 'config' => $config, 'root' => $root);
}
function GES_build_preflight($context, $step) {
    $requirements = array(
        'ges-theme-css-sync' => array('ges-wp-content-lib.php', 'ges-altitude-custom.css', 'ges-customizations.php', 'ges-site-links.php'),
        'ges-content-setup' => array('ges-wp-content-lib.php', 'content-manifest.php', 'page-layout-manifest.php'),
        'ges-front-page-sync' => array('ges-wp-content-lib.php', 'front-page-manifest.php', 'page-layout-manifest.php'),
        'ges-nav-menu-sync' => array('ges-wp-content-lib.php', 'nav-menu-manifest.php'),
        'ges-local-setup' => array('ges-wp-content-lib.php'),
    );
    if (!isset($requirements[$step])) { throw new RuntimeException('Unknown build step.'); }
    $files = array_merge(array($step . '.php'), $requirements[$step]);
    foreach ($files as $file) {
        if (!is_readable(__DIR__ . '/' . $file)) { throw new RuntimeException('Missing step prerequisite: ' . $file); }
    }
    if ($step === 'ges-theme-css-sync') {
        $theme = GES_build_path($context['root'] . '/wp-content/themes/' . $context['config']['theme']);
        if (strpos($theme . '/', $context['root'] . '/') !== 0 || !is_readable($theme . '/functions.php')) {
            throw new RuntimeException('Theme must be inside the selected WordPress root and contain functions.php.');
        }
        $functions = GES_build_path($theme . '/functions.php');
        if (strpos($functions, $theme . '/') !== 0) { throw new RuntimeException('functions.php escapes the selected theme.'); }
        // Reject an existing customization-directory link that escapes the selected theme.
        if (file_exists($theme . '/ges-custom') || is_link($theme . '/ges-custom')) {
            $custom = GES_build_path($theme . '/ges-custom');
            if (strpos($custom . '/', $theme . '/') !== 0) { throw new RuntimeException('ges-custom escapes the selected theme.'); }
        }
    }
    return $files;
}
function GES_build_describe($context, $step, $files) {
    echo ($context['options']['write'] ? 'APPLY' : 'PLAN') . ': ' . $step . PHP_EOL;
    echo '  Site: ' . $context['config']['siteKey'] . PHP_EOL;
    echo '  WordPress: ' . $context['root'] . PHP_EOL;
    echo '  Preview URL: ' . $context['config']['localUrl'] . PHP_EOL;
    echo '  Inputs: ' . implode(', ', $files) . PHP_EOL;
    $actions = array(
        'ges-theme-css-sync' => 'copy overlay files and patch functions.php in theme ' . $context['config']['theme'],
        'ges-content-setup' => 'upsert manifest categories/pages/posts/navigation and write the category register',
        'ges-front-page-sync' => 'upsert front-page manifest pages and widget options',
        'ges-nav-menu-sync' => 'rebuild manifest navigation and menu location',
        'ges-local-setup' => 'legacy initializer retired; configure manifests and use ges-build.php instead',
    );
    echo '  Actions: ' . $actions[$step] . PHP_EOL;
    if (!$context['options']['write']) { echo "  Static preview only; WordPress and PHP manifests were not loaded. No database diff was calculated.\n"; }
}
function GES_build_enter($argv, $step) {
    $context = GES_build_context(GES_build_options($argv, $step));
    GES_build_describe($context, $step, GES_build_preflight($context, $step));
    if (!$context['options']['write']) { exit(0); }
    $GLOBALS['ges_build_context'] = $context;
    return $context;
}
