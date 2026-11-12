<?php
/** Local starter runner. Default is a static, read-only plan. --write applies. */
if (PHP_SAPI !== 'cli') { exit(1); }
require_once __DIR__ . '/ges-build-contract.php';
try {
    $options = GES_build_options($argv);
    $context = GES_build_context($options);
    $selected = array('ges-theme-css-sync', 'ges-content-setup', 'ges-nav-menu-sync');
    if (isset($options['pages'])) {
        $selected = array('ges-content-setup');
    }
    if (isset($options['only'])) {
        $selected = explode(',', $options['only']);
        if (count(array_unique($selected)) !== count($selected)) { throw new RuntimeException('Duplicate step selection.'); }
        foreach ($selected as $step) {
            if (!in_array($step, GES_build_steps(), true)) { throw new RuntimeException('Unknown or empty step selection: ' . $step); }
        }
        // Keep dependency order even when --only is supplied in another order.
        $selected = array_values(array_intersect(GES_build_steps(), $selected));
    }
    if (isset($options['pages']) && $selected !== array('ges-content-setup')) {
        throw new RuntimeException('--pages is a content-only build.');
    }
    if (isset($options['sections']) && !in_array('ges-front-page-sync', $selected, true)) { throw new RuntimeException('--sections requires a selected front-page step.'); }
    if (isset($options['section-anchors']) && !in_array('ges-nav-menu-sync', $selected, true)) { throw new RuntimeException('--section-anchors requires a selected nav step.'); }
    // All prerequisites must pass before the first child can write.
    foreach ($selected as $step) { GES_build_describe($context, $step, GES_build_preflight($context, $step)); }
    if (!$options['write']) { exit(0); }
    foreach ($selected as $step) {
        $args = array(PHP_BINARY, __DIR__ . '/' . $step . '.php', '--manifest=' . $context['manifest'], '--wp-root=' . $context['root'], '--write');
        if (isset($options['pages'])) { $args[] = '--pages=' . $options['pages']; }
        if (isset($options['force'])) { $args[] = '--force'; }
        if (isset($options['sections']) && $step === 'ges-front-page-sync') { $args[] = '--sections=' . $options['sections']; }
        if (isset($options['section-anchors']) && $step === 'ges-nav-menu-sync') { $args[] = '--section-anchors'; }
        // Array-form proc_open avoids cmd.exe quoting and shell interpretation on Windows.
        $process = proc_open($args, array(0 => STDIN, 1 => STDOUT, 2 => STDERR), $pipes, __DIR__, null, array('bypass_shell' => true));
        if (!is_resource($process)) { throw new RuntimeException('Could not start child: ' . $step); }
        $status = proc_close($process);
        if ($status !== 0) { fwrite(STDERR, "FAILED: $step (exit $status); remaining steps stopped.\n"); exit($status > 0 && $status <= 255 ? $status : 1); }
    }
    echo "Build complete.\n";
} catch (Throwable $error) {
    fwrite(STDERR, 'Build rejected: ' . $error->getMessage() . PHP_EOL);
    exit(1);
}
