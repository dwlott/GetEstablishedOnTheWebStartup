<?php
/**
 * Sync the GES one-page front page from Git Markdown (CLI only).
 *
 * Builds section Pages from Content/Website/Pages/FrontPage/*.md and wires
 * Genesis Featured Page (plus small Custom HTML title) widgets into the Altitude
 * front-page-N widget areas, per front-page-manifest.php.
 *
 * Dry run (default, no DB writes):
 *   G:\wamp64\bin\php\php8.3.14\php.exe ges-front-page-sync.php
 *
 * Pilot a subset and persist:
 *   ... ges-front-page-sync.php --sections=front-page-1,front-page-3 --write
 *
 * Full sync and persist:
 *   ... ges-front-page-sync.php --write
 *
 * Strategy: Plans/GESFrontPageContentStrategyPlan.md
 */

if ( php_sapi_name() !== 'cli' ) {
	exit( "CLI only.\n" );
}

require_once __DIR__ . '/ges-wp-content-lib.php';

$repo_root = dirname( __DIR__, 2 );
$page_dir  = $repo_root . '/Content/Website/Pages';

$cli     = GES_parse_cli_args( $argv );
$wp_root = $cli['wp-root'] ?: 'G:/wamp64/www/{siteKey}';
$write   = ! empty( $cli['write'] );

$section_filter = array();
foreach ( array_slice( $argv, 1 ) as $arg ) {
	if ( strpos( $arg, '--sections=' ) === 0 ) {
		$section_filter = array_filter( array_map( 'trim', explode( ',', substr( $arg, 11 ) ) ) );
	}
}

GES_log( 'Mode: ' . ( $write ? 'WRITE (persisting changes)' : 'DRY RUN (no DB writes)' ) );
GES_log( "Loading WordPress: $wp_root" );
GES_load_wordpress( $wp_root );

$manifest = require __DIR__ . '/front-page-manifest.php';
$sections = $manifest['sections'];

if ( $section_filter ) {
	$sections = array_intersect_key( $sections, array_flip( $section_filter ) );
	if ( ! $sections ) {
		throw new RuntimeException( 'No manifest sections matched --sections filter.' );
	}
}

/**
 * Featured Page widget instance defaults (mirrors Genesis_Featured_Page).
 *
 * @return array<string, mixed>
 */
function GES_fp_featured_page_defaults() {
	return array(
		'title'           => '',
		'page_id'         => 0,
		'show_image'      => 0,
		'image_alignment' => '',
		'image_size'      => '',
		'show_title'      => 0,
		'show_content'    => 1,
		'content_limit'   => '',
		'more_text'       => '',
	);
}

/**
 * Find or allocate a Featured Page widget instance for a given page ID.
 *
 * @param array<string, mixed> $instance Full instance to store (includes page_id).
 * @param bool                 $write    Persist when true.
 * @return string Widget ref, e.g. featured-page-3.
 */
function GES_fp_upsert_featured_page_widget( $instance, $write ) {
	$option_key = 'widget_featured-page';
	$widgets    = get_option( $option_key, array( '_multiwidget' => 1 ) );
	$page_id    = (int) $instance['page_id'];
	$target_id  = 0;

	foreach ( $widgets as $key => $val ) {
		if ( is_numeric( $key ) && is_array( $val ) && (int) ( $val['page_id'] ?? 0 ) === $page_id ) {
			$target_id = (int) $key;
			break;
		}
	}

	if ( ! $target_id ) {
		$max = 0;
		foreach ( $widgets as $key => $val ) {
			if ( is_numeric( $key ) ) {
				$max = max( $max, (int) $key );
			}
		}
		$target_id = $max + 1;
	}

	$widgets[ $target_id ]   = $instance;
	$widgets['_multiwidget'] = 1;
	if ( $write ) {
		update_option( $option_key, $widgets );
	}

	return 'featured-page-' . $target_id;
}

/**
 * Find or allocate a marked Custom HTML widget instance for a section title.
 *
 * @param string $section_id Front-page section id used as a stable marker.
 * @param string $title      Widget title.
 * @param string $html       Widget HTML body.
 * @param bool   $write      Persist when true.
 * @return string Widget ref, e.g. custom_html-9.
 */
function GES_fp_upsert_custom_html_widget( $section_id, $title, $html, $write ) {
	$option_key = 'widget_custom_html';
	$widgets    = get_option( $option_key, array( '_multiwidget' => 1 ) );
	$marker     = '<!-- ges-fp:' . $section_id . ' -->';
	$content    = $html . "\n" . $marker;
	$target_id  = 0;

	foreach ( $widgets as $key => $val ) {
		if ( is_numeric( $key ) && is_array( $val ) && isset( $val['content'] ) && strpos( $val['content'], $marker ) !== false ) {
			$target_id = (int) $key;
			break;
		}
	}

	if ( ! $target_id ) {
		$max = 0;
		foreach ( $widgets as $key => $val ) {
			if ( is_numeric( $key ) ) {
				$max = max( $max, (int) $key );
			}
		}
		$target_id = $max + 1;
	}

	$widgets[ $target_id ]   = array(
		'title'   => $title,
		'content' => $content,
	);
	$widgets['_multiwidget'] = 1;
	if ( $write ) {
		update_option( $option_key, $widgets );
	}

	return 'custom_html-' . $target_id;
}

/**
 * Delete Custom HTML widget instances that are no longer referenced anywhere.
 *
 * @param string[] $candidate_refs Refs previously in a rebuilt section.
 * @param array    $sidebars       Current sidebars_widgets map after rebuild.
 * @param bool     $write          Persist when true.
 * @return string[] Refs removed.
 */
function GES_fp_cleanup_orphan_custom_html( $candidate_refs, $sidebars, $write ) {
	$still_used = array();
	foreach ( $sidebars as $key => $refs ) {
		if ( is_array( $refs ) ) {
			foreach ( $refs as $ref ) {
				$still_used[ $ref ] = true;
			}
		}
	}

	$widgets = get_option( 'widget_custom_html', array( '_multiwidget' => 1 ) );
	$removed = array();
	foreach ( $candidate_refs as $ref ) {
		if ( ! preg_match( '/^custom_html-(\d+)$/', $ref, $m ) ) {
			continue;
		}
		if ( isset( $still_used[ $ref ] ) ) {
			continue;
		}
		$id = (int) $m[1];
		if ( isset( $widgets[ $id ] ) ) {
			unset( $widgets[ $id ] );
			$removed[] = $ref;
		}
	}
	if ( $removed && $write ) {
		update_option( 'widget_custom_html', $widgets );
	}
	return $removed;
}

$sidebars = get_option( 'sidebars_widgets', array() );
if ( ! is_array( $sidebars ) ) {
	$sidebars = array();
}

$previous_custom_html = array();

foreach ( $sections as $section_id => $section ) {
	GES_log( "\nSection $section_id — " . ( $section['narrative'] ?? '' ) );

	$prev_refs = isset( $sidebars[ $section_id ] ) && is_array( $sidebars[ $section_id ] )
		? $sidebars[ $section_id ]
		: array();
	foreach ( $prev_refs as $ref ) {
		if ( strpos( (string) $ref, 'custom_html-' ) === 0 ) {
			$previous_custom_html[] = $ref;
		}
	}

	$new_refs = array();

	foreach ( $section['widgets'] as $widget ) {
		if ( 'featured_page' === $widget['type'] ) {
			$md_path = $page_dir . '/' . $widget['markdown'];
			if ( ! is_readable( $md_path ) ) {
				throw new RuntimeException( "Missing front-page markdown: $md_path" );
			}
			$html = GES_page_from_markdown( $md_path );
			if ( $write ) {
				$page_id = GES_upsert_post_content( $widget['page_slug'], $widget['page_title'], $html, 'page' );
				GES_set_page_hide_title( $page_id );
			} else {
				$existing = GES_get_post_by_slug( $widget['page_slug'], 'page' );
				$page_id  = $existing ? (int) $existing->ID : 0;
			}

			$instance            = array_merge(
				GES_fp_featured_page_defaults(),
				isset( $widget['instance'] ) ? $widget['instance'] : array()
			);
			$instance['page_id'] = $page_id;

			$ref        = GES_fp_upsert_featured_page_widget( $instance, $write );
			$new_refs[] = $ref;
			GES_log( "  Featured Page: {$widget['page_slug']} (page ID $page_id) => $ref" );
		} elseif ( 'custom_html' === $widget['type'] ) {
			$ref        = GES_fp_upsert_custom_html_widget(
				$section_id,
				isset( $widget['title'] ) ? $widget['title'] : '',
				$widget['html'],
				$write
			);
			$new_refs[] = $ref;
			GES_log( "  Custom HTML title => $ref" );
		} else {
			throw new RuntimeException( "Unknown widget type: {$widget['type']}" );
		}
	}

	$sidebars[ $section_id ] = $new_refs;
}

if ( $write ) {
	update_option( 'sidebars_widgets', $sidebars );
	GES_log( "\nUpdated sidebars_widgets for " . count( $sections ) . ' section(s).' );
} else {
	GES_log( "\nDry run complete — re-run with --write to persist." );
}

$removed = GES_fp_cleanup_orphan_custom_html(
	array_values( array_unique( $previous_custom_html ) ),
	$sidebars,
	$write
);
if ( $removed ) {
	GES_log( 'Removed orphaned Custom HTML widgets: ' . implode( ', ', $removed ) );
}

GES_log( "\nFront page sync complete." );
GES_log( 'Verify: ' . home_url( '/' ) );
