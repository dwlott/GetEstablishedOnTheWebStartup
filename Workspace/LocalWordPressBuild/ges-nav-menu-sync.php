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

require_once __DIR__ . '/ges-build-contract.php';
$build_context = GES_build_enter($argv, 'ges-nav-menu-sync');

require_once __DIR__ . '/ges-wp-content-lib.php';

$cli     = GES_parse_cli_args( $argv );
$wp_root = $build_context['root'];

$section_anchors = in_array( '--section-anchors', $argv, true );

GES_log( "Loading WordPress: $wp_root" );
GES_load_wordpress( $wp_root );

GES_sync_primary_nav_menu( 'Primary Menu', $section_anchors );

GES_log( 'Nav menu sync complete.' );
GES_log( 'Verify: ' . home_url( '/' ) );
