<?php
/**
 * GES one-shot sync orchestrator (CLI only).
 *
 * Runs the local WordPress sync scripts in dependency order, each in its own
 * PHP subprocess so one failure does not abort the rest. Prints a summary.
 *
 * Usage:
 *   php ges-build.php
 *   php ges-build.php --only=ges-theme-css-sync,ges-content-setup,ges-nav-menu-sync
 *
 * Starter package: use --only with scripts that exist on disk. Full step list
 * below includes GEOTW product steps not shipped in GetEstablishedOnTheWebStartup.
 */

if ( php_sapi_name() !== 'cli' ) {
	exit( "CLI only.\n" );
}

$skip_messaging = in_array( '--skip-messaging', $argv, true );
$only           = array();
foreach ( $argv as $arg ) {
	if ( strpos( $arg, '--only=' ) === 0 ) {
		$only = array_filter( array_map( 'trim', explode( ',', substr( $arg, 7 ) ) ) );
	}
}

// Ordered: CSS first, then content scaffolding, catalog (random post images),
// offer hubs (need catalog posts), front-page backgrounds, interior pages last.
$steps = array(
	array( 'ges-theme-css-sync.php', array() ),
	array( 'ges-content-setup.php', array() ),
	array( 'ges-capability-catalog-sync.php', array() ),
	array( 'ges-offer-hub-sync.php', array() ),
	array( 'ges-front-page-backgrounds-sync.php', array( '--write' ) ),
	array( 'ges-downloads-sync.php', array() ),
	array( 'ges-messaging-sync.php', array() ),
	// Nav last: every linked page must exist before the menu is rebuilt.
	array( 'ges-nav-menu-sync.php', array() ),
);

$php     = PHP_BINARY;
$dir     = __DIR__;
$results = array();

foreach ( $steps as $step ) {
	list( $script, $args ) = $step;
	$base = basename( $script, '.php' );

	if ( $only && ! in_array( $base, $only, true ) ) {
		continue;
	}
	if ( $skip_messaging && 'ges-messaging-sync' === $base ) {
		$results[ $script ] = 'skipped';
		continue;
	}

	$cmd = escapeshellarg( $php ) . ' ' . escapeshellarg( $dir . '/' . $script );
	foreach ( $args as $a ) {
		$cmd .= ' ' . escapeshellarg( $a );
	}

	echo "\n========================================\n";
	echo "RUN: $script " . implode( ' ', $args ) . "\n";
	echo "========================================\n";

	$exit = 0;
	passthru( $cmd, $exit );
	$results[ $script ] = ( 0 === $exit ) ? 'ok' : "FAILED (exit $exit)";
}

echo "\n========================================\n";
echo "SYNC-ALL SUMMARY\n";
echo "========================================\n";
foreach ( $results as $script => $status ) {
	echo str_pad( $status, 22 ) . $script . "\n";
}
echo "\nVerify: http://localhost/{siteKey}/\n";
