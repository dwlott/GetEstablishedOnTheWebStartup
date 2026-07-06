<?php
/**
 * Apply GES content manifest: categories, archive pages, sample posts (CLI only).
 *
 * Usage:
 *   G:\wamp64\bin\php\php8.3.14\php.exe ges-content-setup.php
 *   G:\wamp64\bin\php\php8.3.14\php.exe ges-content-setup.php --wp-root=G:/wamp64/www/{siteKey}
 *
 * Config: content-manifest.php (slug-based; IDs resolved at runtime).
 * Updates: Examples/ges-category-id-register.md after successful run.
 */

if ( php_sapi_name() !== 'cli' ) {
	exit( "CLI only.\n" );
}

$repo_root = dirname( __DIR__, 2 );
require_once __DIR__ . '/ges-wp-content-lib.php';

$cli         = GES_parse_cli_args( $argv );
$wp_root     = $cli['wp-root'] ?: 'G:/wamp64/www/{siteKey}';
$manifest    = require __DIR__ . '/content-manifest.php';
$page_dir    = $repo_root . '/Content/Website/Pages';
$register_md = $repo_root . '/Workspace/Reference/WordPressGenesisOperatingGuide/Examples/ges-category-id-register.md';

GES_log( "Loading WordPress: $wp_root" );
GES_load_wordpress( $wp_root );

$purpose_by_slug = array();
foreach ( $manifest['categories'] as $cat ) {
	GES_log( "Category: {$cat['slug']}" );
	$parent_slug = isset( $cat['parent_slug'] ) ? $cat['parent_slug'] : '';
	$term        = GES_upsert_term( $cat['slug'], $cat['name'], $cat['description'], $parent_slug );
	GES_log( "  ID {$term->term_id} — {$term->name}" );
	$purpose_by_slug[ $cat['slug'] ] = $cat['purpose'];
}

$register_rows = array();
$nav_pages     = array();

foreach ( $manifest['archive_pages'] as $page_def ) {
	$cat_id      = GES_get_term_id_by_slug( $page_def['category_slug'] );
	$query_args  = GES_build_query_args( $page_def['query_args'], $cat_id );

	// Hub pages can build a rich intro (image + lead/deck + body) from Git
	// Markdown via GES_build_page_html; others use the inline intro_html.
	if ( ! empty( $page_def['build_from_markdown'] ) ) {
		$md_path    = $page_dir . '/' . $page_def['build_from_markdown'];
		$intro_html = GES_build_page_html( $page_def['slug'], $md_path );
	} else {
		$intro_html = $page_def['intro_html'];
	}

	GES_log( "Archive page: {$page_def['slug']} query_args=$query_args" );
	$page_id     = GES_upsert_archive_page(
		$page_def['slug'],
		$page_def['title'],
		$intro_html,
		$query_args,
		$page_def['page_template'] ?? 'page_blog.php'
	);
	if ( ! empty( $page_def['build_from_markdown'] ) ) {
		GES_set_page_hide_title( $page_id );
	}
	GES_log( "  Page ID $page_id — /{$page_def['slug']}/" );
	if ( ! empty( $page_def['add_to_nav'] ) ) {
		$nav_title             = $page_def['nav_title'] ?? $page_def['title'];
		$nav_pages[ $nav_title ] = $page_id;
	}
	$register_rows[] = array(
		'category_slug' => $page_def['category_slug'],
		'purpose'       => $purpose_by_slug[ $page_def['category_slug'] ] ?? '',
		'category_id'   => $cat_id,
		'archive_slug'  => $page_def['slug'],
		'query_args'    => $query_args,
		'status'        => 'Created',
	);
}

foreach ( $manifest['sample_posts'] as $post_def ) {
	GES_log( "Post: {$post_def['slug']}" );
	$post_id = GES_upsert_post_with_category(
		$post_def['slug'],
		$post_def['title'],
		$post_def['content'],
		$post_def['category_slug']
	);
	GES_log( "  Post ID $post_id" );
}

if ( ! empty( $nav_pages ) && ! empty( $manifest['nav_menu_name'] ) ) {
	GES_log( 'Adding archive pages to nav: ' . $manifest['nav_menu_name'] );
	GES_add_pages_to_nav_menu( $manifest['nav_menu_name'], $nav_pages );
}

$site_url = home_url( '/' );
file_put_contents( $register_md, GES_render_register_md( $register_rows, $site_url ) );
GES_log( "Wrote register: $register_md" );

GES_log( 'Content setup complete.' );
GES_log( 'Verify: ' . home_url( '/showcase/' ) );
