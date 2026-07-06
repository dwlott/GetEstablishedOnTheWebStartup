<?php
/**
 * Rebuild GES primary navigation with grouped submenus (CLI only).
 *
 * Usage:
 *   G:\wamp64\bin\php\php8.3.14\php.exe ges-nav-menu-sync.php
 *
 * Add the homepage section-anchor "Explore" dropdown:
 *   ... ges-nav-menu-sync.php --section-anchors
 */

if ( php_sapi_name() !== 'cli' ) {
	exit( "CLI only.\n" );
}

require_once __DIR__ . '/ges-wp-content-lib.php';

$cli     = GES_parse_cli_args( $argv );
$wp_root = $cli['wp-root'] ?: 'G:/wamp64/www/{siteKey}';

$section_anchors = in_array( '--section-anchors', $argv, true );

GES_log( "Loading WordPress: $wp_root" );
GES_load_wordpress( $wp_root );

GES_sync_primary_nav_menu( 'Primary Menu', $section_anchors );

GES_log( 'Nav menu sync complete.' );
GES_log( 'Verify: ' . home_url( '/' ) );
