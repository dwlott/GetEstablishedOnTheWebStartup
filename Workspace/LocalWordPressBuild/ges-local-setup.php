<?php
/** Legacy initializer: preview only. Use the manifest-driven runner for writes. */
if (PHP_SAPI !== 'cli') { exit(1); }
require_once __DIR__ . '/ges-build-contract.php';
GES_build_enter($argv, 'ges-local-setup');
fwrite(STDERR, "Legacy local setup is retired: adapt manifests and use ges-build.php --write after backup and approval.\n");
exit(1);
