<?php
/**
 * Shared helpers for GES WordPress content automation CLI scripts.
 */

require_once __DIR__ . '/ges-site-links.php';

function GES_log( $msg ) {
	echo $msg . PHP_EOL;
}

function GES_strip_markdown_page( $path ) {
	$text = file_get_contents( $path );
	$text = preg_replace( '/^<!--.*?-->\s*/s', '', $text );
	foreach ( array( 'Link Intent', 'Open Decisions', 'Draft Status', 'Notes For Future Editing' ) as $section ) {
		$text = preg_replace( '/\n## ' . preg_quote( $section, '/' ) . '\b.*\z/s', '', $text );
	}
	return trim( preg_replace( "/\n{3,}/", "\n\n", $text ) );
}

function GES_markdown_page_slug_map() {
	return array(
		'StartHere.md'                    => 'start-here',
		'HowItWorks.md'                   => 'how-it-works',
		'Offers.md'                       => 'offers',
		'About.md'                        => 'about',
		'AIWorkflow.md'                   => 'ai-workflow',
		'GitHubWorkflow.md'               => 'github-workflow',
		'AgentPermissions.md'             => 'agent-permissions',
		'GoogleBusinessProfileBasics.md'  => 'google-business-profile-basics',
		'BingPlacesBasics.md'             => 'bing-places-basics',
		'FacebookBusinessPageBasics.md'   => 'facebook-business-page-basics',
		'NextdoorBusinessPageBasics.md'   => 'nextdoor-business-page-basics',
		'FoursquareBusinessListingBasics.md' => 'foursquare-business-listing-basics',
		'BetterBusinessBureauProfileBasics.md' => 'better-business-bureau-profile-basics',
		'YelpBasics.md'                   => 'yelp-basics',
		'AppleMapsBasics.md'              => 'apple-maps-basics',
		'YellowPagesBasics.md'            => 'yellow-pages-basics',
		'Method.md'                       => 'method',
		'Capabilities.md'                 => 'capabilities',
		'GetEstablished.md'               => 'getestablished',
		'{siteKey}.md'       => 'get-established-on-the-web',
		'Repositories.md'                 => 'repositories',
		'GetListed.md'                    => 'get-listed',
		'UseAI.md'                          => 'use-ai',
		'Home.md'                         => '',
	);
}

function GES_resolve_markdown_href( $href ) {
	$href = trim( $href );
	if ( $href === '' ) {
		return $href;
	}
	if ( stripos( $href, 'download:' ) === 0 ) {
		return GES_resolve_download_href( substr( $href, 9 ) );
	}
	if ( stripos( $href, 'capability:' ) === 0 ) {
		return GES_resolve_capability_post_href( substr( $href, 11 ) );
	}
	if ( preg_match( '#^https?://#i', $href ) || strpos( $href, '#' ) === 0 ) {
		return $href;
	}
	if ( preg_match( '#^/+#', $href ) ) {
		return $href;
	}
	$map = GES_markdown_page_slug_map();
	if ( isset( $map[ $href ] ) ) {
		$slug = $map[ $href ];
		if ( $slug === '' ) {
			return home_url( '/' );
		}
		return home_url( '/' . $slug . '/' );
	}
	if ( preg_match( '/\.md$/i', $href ) ) {
		$base = preg_replace( '/\.md$/i', '', basename( $href ) );
		$slug = strtolower( preg_replace( '/([a-z])([A-Z])/', '$1-$2', $base ) );
		$slug = str_replace( '_', '-', $slug );
		return home_url( '/' . $slug . '/' );
	}
	return $href;
}

function GES_heading_plain_text( $text ) {
	$text = trim( $text );
	if ( preg_match( '/^\[([^\]]+)\]\([^)]+\)$/', $text, $m ) ) {
		return $m[1];
	}
	$text = preg_replace( '/\[([^\]]+)\]\([^)]+\)/', '$1', $text );
	$text = preg_replace( '/`([^`]+)`/', '$1', $text );
	$text = preg_replace( '/\*\*(.+?)\*\*/', '$1', $text );
	$text = preg_replace( '/(?<!\*)\*(?!\*)(.+?)(?<!\*)\*(?!\*)/', '$1', $text );
	return trim( $text );
}

function GES_heading_anchor_id( $text ) {
	$id = strtolower( GES_heading_plain_text( $text ) );
	$id = preg_replace( '/[^a-z0-9\s-]/', '', $id );
	$id = preg_replace( '/[\s_]+/', '-', trim( $id ) );
	return trim( $id, '-' );
}

function GES_inline_md( $text ) {
	$text = preg_replace( '/`([^`]+)`/', '<code>$1</code>', $text );
	$text = preg_replace( '/\*\*(.+?)\*\*/', '<strong>$1</strong>', $text );
	$text = preg_replace( '/(?<!\*)\*(?!\*)(.+?)(?<!\*)\*(?!\*)/', '<em>$1</em>', $text );
	$text = preg_replace_callback(
		'/\[([^\]]+)\]\(([^)]+)\)/',
		function ( $m ) {
			$url = GES_resolve_markdown_href( $m[2] );
			if ( strpos( $url, '#' ) === 0 ) {
				return '<a href="' . esc_attr( $url ) . '">' . $m[1] . '</a>';
			}
			return '<a href="' . esc_url( $url ) . '">' . $m[1] . '</a>';
		},
		$text
	);
	$text = preg_replace_callback(
		'/^(.+?): <(https?:\/\/[^>]+)>$/',
		function ( $m ) {
			return '<a href="' . esc_url( $m[2] ) . '">' . $m[1] . '</a>';
		},
		$text
	);
	$text = preg_replace_callback(
		'/<(https?:\/\/[^>]+)>/',
		function ( $m ) {
			return '<a href="' . esc_url( $m[1] ) . '">' . esc_html( $m[1] ) . '</a>';
		},
		$text
	);
	return $text;
}

function GES_extract_markdown_title( $markdown ) {
	if ( preg_match( '/^# (.+)$/m', $markdown, $m ) ) {
		return trim( $m[1] );
	}
	return '';
}

function GES_strip_title_from_markdown( $markdown ) {
	return preg_replace( '/^# .+\n+/', '', $markdown, 1 );
}

function GES_parse_markdown_blocks( $markdown ) {
	$lines  = preg_split( '/\r\n|\r|\n/', $markdown );
	$blocks = array();
	$i      = 0;
	$count  = count( $lines );

	while ( $i < $count ) {
		$trim = trim( $lines[ $i ] );
		if ( $trim === '' ) {
			++$i;
			continue;
		}

		if ( preg_match( '/^<.+/', $trim ) && ! preg_match( '/^<https?:\/\/[^>]+>$/', $trim ) ) {
			$html = $trim;
			++$i;
			while ( $i < $count ) {
				$next = trim( $lines[ $i ] );
				if ( $next === '' || strpos( $next, '<' ) !== 0 ) {
					break;
				}
				$html .= "\n" . $next;
				++$i;
			}
			$blocks[] = array(
				'type'    => 'html',
				'content' => $html,
			);
			continue;
		}

		if ( preg_match( '/^## (.+)$/', $trim, $m ) ) {
			$blocks[] = array(
				'type' => 'h2',
				'text' => $m[1],
			);
			++$i;
			continue;
		}

		if ( preg_match( '/^### (.+)$/', $trim, $m ) ) {
			$blocks[] = array(
				'type' => 'h3',
				'text' => $m[1],
			);
			++$i;
			continue;
		}

		if ( preg_match( '/^# (.+)$/', $trim, $m ) ) {
			$blocks[] = array(
				'type' => 'h1',
				'text' => $m[1],
			);
			++$i;
			continue;
		}

		if ( preg_match( '/^- (.+)$/', $trim, $m ) ) {
			$items = array( $m[1] );
			++$i;
			while ( $i < $count ) {
				$next = trim( $lines[ $i ] );
				if ( $next === '' ) {
					break;
				}
				if ( preg_match( '/^- (.+)$/', $next, $item ) ) {
					$items[] = $item[1];
					++$i;
				} elseif ( preg_match( '/^(#|##|###|\d+\. )/', $next ) ) {
					break;
				} else {
					$items[ count( $items ) - 1 ] .= ' ' . $next;
					++$i;
				}
			}
			$blocks[] = array(
				'type'  => 'ul',
				'items' => $items,
			);
			continue;
		}

		if ( preg_match( '/^(\d+)\. (.+)$/', $trim, $m ) ) {
			$items = array( $m[2] );
			++$i;
			while ( $i < $count ) {
				$next = trim( $lines[ $i ] );
				if ( $next === '' ) {
					break;
				}
				if ( preg_match( '/^(\d+)\. (.+)$/', $next, $item ) ) {
					$items[] = $item[2];
					++$i;
				} elseif ( preg_match( '/^(#|##|###|- )/', $next ) ) {
					break;
				} else {
					$items[ count( $items ) - 1 ] .= ' ' . $next;
					++$i;
				}
			}
			$blocks[] = array(
				'type'  => 'ol',
				'items' => $items,
			);
			continue;
		}

		if ( preg_match( '/^<https?:\/\/[^>]+>$/', $trim ) ) {
			$blocks[] = array(
				'type' => 'autolink',
				'url'  => trim( $trim, '<>' ),
			);
			++$i;
			continue;
		}

		$para_lines = array( $trim );
		++$i;
		while ( $i < $count ) {
			$next = trim( $lines[ $i ] );
			if ( $next === '' ) {
				break;
			}
			if ( preg_match( '/^(#|##|###|- |\d+\. |<)/', $next ) ) {
				break;
			}
			$para_lines[] = $next;
			++$i;
		}
		$blocks[] = array(
			'type' => 'paragraph',
			'text' => implode( ' ', $para_lines ),
		);
	}

	return $blocks;
}

function GES_render_blocks_to_html( $blocks, $options = array() ) {
	$html             = '';
	$lead_first_para  = ! empty( $options['lead_first_paragraph'] );
	$intro_para_index = isset( $options['intro_para_index_start'] )
		? (int) $options['intro_para_index_start']
		: 0;
	foreach ( $blocks as $block ) {
		switch ( $block['type'] ) {
			case 'html':
				$html .= $block['content'] . "\n";
				break;
			case 'h2':
				$html .= '<h2 id="' . esc_attr( GES_heading_anchor_id( $block['text'] ) ) . '">' . GES_inline_md( $block['text'] ) . "</h2>\n";
				break;
			case 'h3':
				$html .= '<h3 id="' . esc_attr( GES_heading_anchor_id( $block['text'] ) ) . '">' . GES_inline_md( $block['text'] ) . "</h3>\n";
				break;
			case 'h1':
				$html .= '<h1 class="ges-page-title">' . esc_html( $block['text'] ) . "</h1>\n";
				break;
			case 'ul':
				$html .= "<ul>\n";
				foreach ( $block['items'] as $item ) {
					$html .= '<li>' . GES_inline_md( $item ) . "</li>\n";
				}
				$html .= "</ul>\n";
				break;
			case 'ol':
				$html .= "<ol>\n";
				foreach ( $block['items'] as $item ) {
					$html .= '<li>' . GES_inline_md( $item ) . "</li>\n";
				}
				$html .= "</ol>\n";
				break;
			case 'autolink':
				$html .= '<p><a href="' . esc_url( $block['url'] ) . '">' . esc_html( $block['url'] ) . "</a></p>\n";
				break;
			case 'paragraph':
				if ( $lead_first_para ) {
					if ( 0 === $intro_para_index ) {
						$html .= '<p class="ges-page-lead">' . GES_inline_md( $block['text'] ) . "</p>\n";
					} elseif ( 1 === $intro_para_index ) {
						$html .= '<p class="ges-page-deck">' . GES_inline_md( $block['text'] ) . "</p>\n";
					} elseif ( 2 === $intro_para_index ) {
						$html .= '<p class="ges-page-pitch">' . GES_inline_md( $block['text'] ) . "</p>\n";
					} else {
						$html .= '<p>' . GES_inline_md( $block['text'] ) . "</p>\n";
					}
					++$intro_para_index;
				} else {
					$html .= '<p>' . GES_inline_md( $block['text'] ) . "</p>\n";
				}
				break;
		}
	}
	return GES_apply_link_new_tab_attrs( trim( $html ) );
}

function GES_md_to_html( $markdown ) {
	return GES_apply_link_new_tab_attrs(
		GES_resolve_raw_html_hrefs(
			GES_render_blocks_to_html( GES_parse_markdown_blocks( $markdown ) )
		)
	);
}

function GES_page_assets_dir() {
	return dirname( __DIR__, 2 ) . '/Content/Website/Assets/PageImages';
}

function GES_post_images_dir() {
	return dirname( __DIR__, 2 ) . '/Content/Website/Assets/PostImages';
}

/**
 * Filenames of the randomized 600x600 post-image pool.
 *
 * @return string[] Image filenames (jpg/jpeg/png), or empty when the pool is absent.
 */
function GES_post_image_pool() {
	$dir = GES_post_images_dir();
	if ( ! is_dir( $dir ) ) {
		return array();
	}
	$files = glob( $dir . '/*.{jpg,jpeg,png,JPG,JPEG,PNG}', GLOB_BRACE );
	if ( ! $files ) {
		return array();
	}
	return array_map( 'basename', $files );
}

/**
 * Pick a random pool image filename (optionally seeded for repeatable shuffles).
 *
 * @param string|null $seed Optional seed (e.g. post slug) for deterministic choice.
 * @return string|null Filename, or null when the pool is empty.
 */
function GES_pick_random_post_image( $seed = null ) {
	$pool = GES_post_image_pool();
	if ( ! $pool ) {
		return null;
	}
	if ( null !== $seed ) {
		$index = abs( crc32( (string) $seed ) ) % count( $pool );
		return $pool[ $index ];
	}
	return $pool[ array_rand( $pool ) ];
}

/**
 * Sideload (or reuse) a pool image as an attachment, deduped by filename.
 *
 * @param string $filename Pool image filename.
 * @param string $alt_text Alt text for the attachment.
 * @return int Attachment ID.
 */
function GES_post_image_attachment( $filename, $alt_text = '' ) {
	$path = GES_post_images_dir() . '/' . $filename;
	return GES_ensure_attachment_from_path( $path, 'GES_post_image_file', $filename, $alt_text );
}

/**
 * Inline intro figure HTML for a post, using the registered ges-page-intro size.
 *
 * @param int $attachment_id Image attachment ID.
 * @return string Figure HTML.
 */
function GES_post_intro_figure_html( $attachment_id ) {
	$img = GES_attachment_img_html( (int) $attachment_id, 'ges-page-intro', 'ges-post-figure-image' );
	return '<figure class="ges-post-figure">' . $img . '</figure>' . "\n";
}

function GES_brand_assets_dir() {
	return dirname( __DIR__, 2 ) . '/Content/Website/Assets/Brand';
}

function GES_downloads_dir() {
	return dirname( __DIR__, 2 ) . '/Content/Website/Assets/Downloads';
}

function GES_downloads_manifest() {
	static $manifest = null;
	if ( null === $manifest ) {
		$path = GES_downloads_dir() . '/downloads-manifest.php';
		if ( ! is_readable( $path ) ) {
			throw new RuntimeException( "Missing downloads manifest: $path" );
		}
		$manifest = require $path;
	}
	return $manifest;
}

function GES_download_register() {
	$register = get_option( 'GES_download_register', array() );
	return is_array( $register ) ? $register : array();
}

function GES_resolve_download_href( $filename ) {
	$filename = trim( $filename );
	if ( $filename === '' ) {
		return '#';
	}
	$register = GES_download_register();
	if ( ! empty( $register[ $filename ]['url'] ) ) {
		return $register[ $filename ]['url'];
	}
	return '#';
}

function GES_ensure_download_attachment( $filename, $force = false ) {
	$path = GES_downloads_dir() . '/' . $filename;
	if ( $force ) {
		$existing = get_posts(
			array(
				'post_type'      => 'attachment',
				'posts_per_page' => -1,
				'post_status'    => 'inherit',
				'meta_key'       => 'GES_download_file',
				'meta_value'     => $filename,
				'fields'         => 'ids',
			)
		);
		foreach ( $existing as $attachment_id ) {
			wp_delete_attachment( (int) $attachment_id, true );
			GES_log( "Removed prior download attachment for $filename (ID $attachment_id)" );
		}
	}
	return GES_ensure_attachment_from_path( $path, 'GES_download_file', $filename );
}

function GES_resolve_capability_post_href( $post_slug ) {
	$post_slug = trim( $post_slug );
	if ( $post_slug === '' ) {
		return '#';
	}

	if ( function_exists( 'get_page_by_path' ) ) {
		$post = get_page_by_path( $post_slug, OBJECT, 'post' );
		if ( $post ) {
			$url = get_permalink( $post );
			if ( $url ) {
				return $url;
			}
		}
	}

	return home_url( '/' . $post_slug . '/' );
}

function GES_brand_manifest() {
	static $manifest = null;
	if ( null === $manifest ) {
		$path = GES_brand_assets_dir() . '/brand-manifest.php';
		if ( ! is_readable( $path ) ) {
			throw new RuntimeException( "Missing brand manifest: $path" );
		}
		$manifest = require $path;
	}
	return $manifest;
}

function GES_ensure_attachment_from_path( $source_path, $meta_key, $meta_value, $alt_text = '' ) {
	if ( ! is_readable( $source_path ) ) {
		throw new RuntimeException( "Missing file: $source_path" );
	}

	$existing = get_posts(
		array(
			'post_type'      => 'attachment',
			'posts_per_page' => 1,
			'post_status'    => 'inherit',
			'meta_key'       => $meta_key,
			'meta_value'     => $meta_value,
			'fields'         => 'ids',
		)
	);
	if ( $existing ) {
		return (int) $existing[0];
	}

	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$filename = basename( $source_path );
	$tmp      = wp_tempnam( $filename );
	if ( ! copy( $source_path, $tmp ) ) {
		throw new RuntimeException( "Could not copy file to temp: $source_path" );
	}

	$file_array = array(
		'name'     => $filename,
		'tmp_name' => $tmp,
	);
	$attachment_id = media_handle_sideload( $file_array, 0 );
	if ( is_wp_error( $attachment_id ) ) {
		@unlink( $tmp );
		throw new RuntimeException( $attachment_id->get_error_message() );
	}

	update_post_meta( $attachment_id, $meta_key, $meta_value );
	if ( $alt_text !== '' ) {
		update_post_meta( $attachment_id, '_wp_attachment_image_alt', $alt_text );
	}

	return (int) $attachment_id;
}

function GES_ensure_brand_attachment( $filename, $alt_text = '', $force = false ) {
	$path = GES_brand_assets_dir() . '/' . $filename;
	if ( $force ) {
		$existing = get_posts(
			array(
				'post_type'      => 'attachment',
				'posts_per_page' => -1,
				'post_status'    => 'inherit',
				'meta_key'       => 'GES_brand_file',
				'meta_value'     => $filename,
				'fields'         => 'ids',
			)
		);
		foreach ( $existing as $attachment_id ) {
			wp_delete_attachment( (int) $attachment_id, true );
			GES_log( "Removed prior brand attachment for $filename (ID $attachment_id)" );
		}
	}
	return GES_ensure_attachment_from_path( $path, 'GES_brand_file', $filename, $alt_text );
}

function GES_regenerate_attachment_metadata( $attachment_id ) {
	require_once ABSPATH . 'wp-admin/includes/image.php';
	$file = get_attached_file( $attachment_id );
	if ( ! $file || ! is_readable( $file ) ) {
		return;
	}
	$metadata = wp_generate_attachment_metadata( $attachment_id, $file );
	wp_update_attachment_metadata( $attachment_id, $metadata );
}

function GES_apply_site_icon( $attachment_id ) {
	$attachment_id = (int) $attachment_id;
	GES_regenerate_attachment_metadata( $attachment_id );
	update_option( 'site_icon', $attachment_id );
	GES_log( "Set site_icon option => attachment $attachment_id" );
}

function GES_apply_header_image( $attachment_id, $width = 720, $height = 152 ) {
	$attachment_id = (int) $attachment_id;
	$url           = wp_get_attachment_url( $attachment_id );
	if ( ! $url ) {
		throw new RuntimeException( "No URL for header attachment $attachment_id" );
	}

	set_theme_mod(
		'header_image',
		$url
	);
	set_theme_mod(
		'header_image_data',
		array(
			'attachment_id' => $attachment_id,
			'url'             => $url,
			'thumbnail_url'   => $url,
			'width'           => (int) $width,
			'height'          => (int) $height,
		)
	);
	set_theme_mod( 'header_textcolor', 'blank' );
	update_post_meta( $attachment_id, '_wp_attachment_is_custom_header', get_option( 'stylesheet' ) );

	GES_log( "Set header_image theme_mod => attachment $attachment_id ($url)" );
}

function GES_brand_color_manifest() {
	return array(
		'altitude_link_color'   => '#6CC24A',
		'altitude_accent_color' => '#6CC24A',
	);
}

function GES_apply_brand_theme_colors() {
	$colors = GES_brand_color_manifest();
	foreach ( $colors as $mod => $hex ) {
		set_theme_mod( $mod, $hex );
		GES_log( "Set theme_mod $mod => $hex" );
	}
}

function GES_repository_offer_manifest() {
	static $manifest = null;
	if ( null === $manifest ) {
		$path = __DIR__ . '/repository-offer-manifest.php';
		if ( ! is_readable( $path ) ) {
			throw new RuntimeException( "Missing repository offer manifest: $path" );
		}
		$manifest = require $path;
	}
	return $manifest;
}

function GES_capability_catalog_manifest() {
	static $manifest = null;
	if ( null === $manifest ) {
		$path = __DIR__ . '/capability-catalog-manifest.php';
		if ( ! is_readable( $path ) ) {
			throw new RuntimeException( "Missing capability catalog manifest: $path" );
		}
		$manifest = require $path;
	}
	return $manifest;
}

function GES_capability_name_to_post_slug_map() {
	static $map = null;
	if ( null === $map ) {
		$map = array();
		foreach ( GES_capability_catalog_manifest()['capabilities'] as $entry ) {
			$map[ $entry['capability_name'] ] = $entry['post_slug'];
		}
	}
	return $map;
}

function GES_resolve_offer_capability_names( $offer_key ) {
	$manifest = GES_repository_offer_manifest();
	if ( empty( $manifest['offers'][ $offer_key ] ) ) {
		throw new RuntimeException( "Unknown offer key: $offer_key" );
	}
	$offer = $manifest['offers'][ $offer_key ];
	$names = array();
	if ( ! empty( $offer['always_include_core'] ) && ! empty( $manifest['core_capabilities'] ) ) {
		$names = array_merge( $names, $manifest['core_capabilities'] );
	}
	if ( ! empty( $offer['includes'] ) ) {
		$names = array_merge( $names, $offer['includes'] );
	}
	return array_values( array_unique( $names ) );
}

function GES_resolve_capability_post_ids( $capability_names ) {
	$slug_map = GES_capability_name_to_post_slug_map();
	$ids      = array();
	foreach ( $capability_names as $name ) {
		if ( empty( $slug_map[ $name ] ) ) {
			throw new RuntimeException( "Capability not in catalog manifest: $name" );
		}
		$post = GES_get_post_by_slug( $slug_map[ $name ], 'post' );
		if ( ! $post ) {
			throw new RuntimeException(
				"Capability post missing: $name ({$slug_map[$name]}). Run ges-capability-catalog-sync.php first."
			);
		}
		$ids[] = (int) $post->ID;
	}
	return $ids;
}

function GES_build_post_in_query_args( $post_ids ) {
	$post_ids = array_values( array_unique( array_map( 'intval', (array) $post_ids ) ) );
	if ( ! $post_ids ) {
		throw new RuntimeException( 'Cannot build post__in query_args with zero post IDs.' );
	}
	return 'post__in=' . implode( ',', $post_ids ) . '&orderby=post__in&posts_per_page=' . count( $post_ids );
}

function GES_sync_repository_offer_hubs( $repo_root ) {
	$page_dir = $repo_root . '/Content/Website/Pages';
	$manifest = GES_repository_offer_manifest();

	foreach ( $manifest['offers'] as $offer_key => $offer ) {
		if ( empty( $offer['active'] ) ) {
			GES_log( "Skip inactive offer: $offer_key" );
			continue;
		}

		$slug = $offer['page_slug'];
		$md   = $page_dir . '/' . $offer['markdown_file'];
		if ( ! is_readable( $md ) ) {
			throw new RuntimeException( "Missing offer page markdown: $md" );
		}

		$cap_names  = GES_resolve_offer_capability_names( $offer_key );
		$post_ids   = GES_resolve_capability_post_ids( $cap_names );
		$query_args = GES_build_post_in_query_args( $post_ids );
		$html       = GES_build_page_html( $slug, $md );
		$title      = $offer['page_title'];

		GES_log( "Offer hub: $offer_key => /$slug/ (" . count( $post_ids ) . ' capability posts)' );
		GES_log( "  query_args=$query_args" );

		$page_id = GES_upsert_archive_page(
			$slug,
			$title,
			$html,
			$query_args,
			'page_blog.php'
		);
		GES_set_page_hide_title( $page_id );
		if ( ! empty( $offer['marketing_layout'] ) ) {
			update_post_meta( $page_id, 'GES_marketing_layout', '1' );
		} else {
			delete_post_meta( $page_id, 'GES_marketing_layout' );
		}
		GES_log( "  Page ID $page_id — " . home_url( "/$slug/" ) );
	}
}

function GES_page_layout_manifest() {
	static $manifest = null;
	if ( null === $manifest ) {
		$path = __DIR__ . '/page-layout-manifest.php';
		if ( ! is_readable( $path ) ) {
			return array();
		}
		$manifest = require $path;
	}
	return $manifest;
}

function GES_set_page_hide_title( $page_id ) {
	update_post_meta( (int) $page_id, '_genesis_hide_title', '1' );
}

function GES_ensure_attachment_from_file( $filename, $alt_text = '' ) {
	$path = GES_page_assets_dir() . '/' . $filename;
	if ( ! is_readable( $path ) ) {
		throw new RuntimeException( "Missing page image: $path" );
	}

	$existing = get_posts(
		array(
			'post_type'      => 'attachment',
			'posts_per_page' => 1,
			'post_status'    => 'inherit',
			'meta_key'       => 'GES_source_file',
			'meta_value'     => $filename,
			'fields'         => 'ids',
		)
	);
	if ( $existing ) {
		return (int) $existing[0];
	}

	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$tmp = wp_tempnam( $filename );
	if ( ! copy( $path, $tmp ) ) {
		throw new RuntimeException( "Could not copy image to temp: $path" );
	}

	$file_array = array(
		'name'     => basename( $path ),
		'tmp_name' => $tmp,
	);
	$attachment_id = media_handle_sideload( $file_array, 0 );
	if ( is_wp_error( $attachment_id ) ) {
		@unlink( $tmp );
		throw new RuntimeException( $attachment_id->get_error_message() );
	}

	update_post_meta( $attachment_id, 'GES_source_file', $filename );
	if ( $alt_text !== '' ) {
		update_post_meta( $attachment_id, '_wp_attachment_image_alt', $alt_text );
	}

	return (int) $attachment_id;
}

function GES_attachment_img_html( $attachment_id, $size, $class ) {
	return wp_get_attachment_image(
		$attachment_id,
		$size,
		false,
		array(
			'class'   => $class,
			'loading' => 'lazy',
		)
	);
}

function GES_split_blocks_for_intro( $blocks, $intro_paragraphs, $has_intro_image ) {
	$intro_blocks = array();
	$body_blocks  = array();
	$para_seen    = 0;
	$in_intro     = $has_intro_image && $intro_paragraphs > 0;

	foreach ( $blocks as $block ) {
		if ( $in_intro && 'paragraph' === $block['type'] && $para_seen < $intro_paragraphs ) {
			$intro_blocks[] = $block;
			++$para_seen;
			if ( $para_seen >= $intro_paragraphs ) {
				$in_intro = false;
			}
			continue;
		}
		$in_intro     = false;
		$body_blocks[] = $block;
	}

	return array( $intro_blocks, $body_blocks );
}

function GES_build_page_html( $slug, $markdown_path ) {
	$manifest = GES_page_layout_manifest();
	$layout   = isset( $manifest[ $slug ] ) ? $manifest[ $slug ] : array();

	$md    = GES_strip_markdown_page( $markdown_path );
	$title = GES_extract_markdown_title( $md );
	if ( $title === '' ) {
		$title = ucwords( str_replace( '-', ' ', $slug ) );
	}

	$body_md = GES_strip_title_from_markdown( $md );
	$blocks  = GES_parse_markdown_blocks( $body_md );

	$intro_paragraphs = isset( $layout['intro_paragraphs'] ) ? (int) $layout['intro_paragraphs'] : 0;
	$has_intro_image  = ! empty( $layout['intro'] );
	list( $intro_blocks, $body_blocks ) = GES_split_blocks_for_intro(
		$blocks,
		$intro_paragraphs,
		$has_intro_image
	);

	$html  = '<h1 class="ges-page-title">' . esc_html( $title ) . "</h1>\n";

	if ( ! empty( $layout['banner'] ) ) {
		$banner_id = GES_ensure_attachment_from_file( $layout['banner'], $title );
		$html     .= '<div class="ges-page-hero">';
		$html     .= GES_attachment_img_html( $banner_id, 'ges-page-banner', 'ges-page-banner' );
		$html     .= "</div>\n";
	}

	if ( $has_intro_image && $intro_blocks ) {
		$intro_id            = GES_ensure_attachment_from_file( $layout['intro'], $title );
		$intro_column_blocks = $intro_blocks;
		$intro_pitch_blocks  = array();
		if ( $intro_paragraphs >= 3 && count( $intro_blocks ) >= 3 ) {
			$intro_pitch_blocks  = array( $intro_blocks[2] );
			$intro_column_blocks = array_slice( $intro_blocks, 0, 2 );
		}

		$html .= '<div class="ges-page-intro">';
		$html .= '<div class="one-third first">';
		$html .= GES_attachment_img_html( $intro_id, 'ges-page-intro', 'ges-page-intro-image' );
		$html .= '</div>';
		$html .= '<div class="two-thirds">';
		$html .= GES_render_blocks_to_html(
			$intro_column_blocks,
			array( 'lead_first_paragraph' => true )
		);
		$html .= '</div>';
		if ( $intro_pitch_blocks ) {
			$html .= '<div class="ges-page-intro-pitch">';
			$html .= GES_render_blocks_to_html(
				$intro_pitch_blocks,
				array(
					'lead_first_paragraph'   => true,
					'intro_para_index_start' => 2,
				)
			);
			$html .= '</div>';
		}
		$html .= '<hr class="clearfix">' . "\n";
		$html .= "</div>\n";
	} elseif ( $intro_blocks ) {
		$html .= GES_render_blocks_to_html( $intro_blocks ) . "\n";
	}

	$html .= GES_render_blocks_to_html( $body_blocks );

	if ( ! empty( $layout['loop_heading'] ) ) {
		$html .= '<div class="ges-hub-loop-heading">';
		$html .= '<h2>' . esc_html( $layout['loop_heading'] ) . '</h2>';
		$html .= '<p class="ges-hub-loop-deck">Browse the sidebar to filter by Universal or Web modules.</p>';
		$html .= "</div>\n";
	}

	$html = GES_resolve_raw_html_hrefs( $html );
	return GES_apply_link_new_tab_attrs( trim( $html ) );
}

/**
 * Resolve download:/capability: prefixes inside raw HTML href="" attributes.
 *
 * Markdown link syntax is handled in GES_inline_md(), but front-page sections
 * and other pages use raw HTML anchors (e.g. styled .button links). This lets
 * those raw anchors use the same href="download:File.zip" / href="capability:slug"
 * shorthand and resolve to real, environment-correct URLs.
 *
 * @param string $html HTML fragment.
 * @return string
 */
function GES_resolve_raw_html_hrefs( $html ) {
	if ( ! is_string( $html ) || $html === '' ) {
		return $html;
	}
	return preg_replace_callback(
		'/href=(["\'])((?:download|capability):[^"\']+)\1/i',
		function ( $m ) {
			$url = GES_resolve_markdown_href( $m[2] );
			return 'href=' . $m[1] . esc_url( $url ) . $m[1];
		},
		$html
	);
}

function GES_page_from_markdown( $path ) {
	$md = GES_strip_markdown_page( $path );
	$md = preg_replace( '/^# .+\n+/', '', $md, 1 );
	return GES_md_to_html( $md );
}

function GES_update_custom_html_widget_in_sidebar( $sidebar_id, $html ) {
	$sidebars = get_option( 'sidebars_widgets', array() );
	if ( empty( $sidebars[ $sidebar_id ][0] ) ) {
		throw new RuntimeException( "No widget in sidebar: $sidebar_id" );
	}
	$widget_ref = $sidebars[ $sidebar_id ][0];
	if ( ! preg_match( '/^custom_html-(\d+)$/', $widget_ref, $m ) ) {
		throw new RuntimeException( "Expected custom_html widget in $sidebar_id, got $widget_ref" );
	}
	$id      = (int) $m[1];
	$widgets = get_option( 'widget_custom_html', array() );
	if ( empty( $widgets[ $id ] ) ) {
		throw new RuntimeException( "Missing widget_custom_html instance $id" );
	}
	$widgets[ $id ]['content'] = $html;
	update_option( 'widget_custom_html', $widgets );
}

function GES_parse_cli_args( $argv ) {
	$args = array(
		'wp-root' => '',
		'write'   => false,
		'force'   => false,
	);
	foreach ( array_slice( $argv, 1 ) as $arg ) {
		if ( strpos( $arg, '--wp-root=' ) === 0 ) {
			$args['wp-root'] = rtrim( substr( $arg, 10 ), '/\\' );
		} elseif ( $arg === '--write' ) {
			$args['write'] = true;
		} elseif ( $arg === '--force' ) {
			$args['force'] = true;
		}
	}
	return $args;
}

function GES_load_wordpress( $wp_root ) {
	if ( ! is_readable( $wp_root . '/wp-load.php' ) ) {
		throw new RuntimeException( "WordPress not found at: $wp_root" );
	}
	require_once $wp_root . '/wp-load.php';
}

function GES_upsert_term( $slug, $name, $description = '', $parent_slug = '' ) {
	$parent_id = 0;
	if ( $parent_slug !== '' ) {
		$parent_id = GES_get_term_id_by_slug( $parent_slug );
	}
	$existing = get_term_by( 'slug', $slug, 'category' );
	$args     = array(
		'name'        => $name,
		'slug'        => $slug,
		'description' => $description,
		'parent'      => $parent_id,
	);
	if ( $existing ) {
		$result = wp_update_term( (int) $existing->term_id, 'category', $args );
	} else {
		$result = wp_insert_term( $name, 'category', $args );
	}
	if ( is_wp_error( $result ) ) {
		throw new RuntimeException( $result->get_error_message() );
	}
	$term_id = is_array( $result ) ? (int) $result['term_id'] : (int) $existing->term_id;
	$term    = get_term( $term_id, 'category' );
	if ( ! $term || is_wp_error( $term ) ) {
		throw new RuntimeException( "Failed to load category: $slug" );
	}
	return $term;
}

function GES_get_term_id_by_slug( $slug ) {
	$term = get_term_by( 'slug', $slug, 'category' );
	if ( ! $term ) {
		throw new RuntimeException( "Category not found: $slug" );
	}
	return (int) $term->term_id;
}

function GES_build_query_args( $template, $cat_id ) {
	return str_replace( '{cat_id}', (string) (int) $cat_id, $template );
}

function GES_get_post_by_slug( $slug, $post_type = 'post' ) {
	$post = get_page_by_path( $slug, OBJECT, $post_type );
	return $post ? $post : null;
}

function GES_upsert_post_content( $slug, $title, $html, $post_type = 'page', $post_status = 'publish' ) {
	$existing = GES_get_post_by_slug( $slug, $post_type );
	$args     = array(
		'post_title'   => $title,
		'post_name'    => $slug,
		'post_content' => $html,
		'post_status'  => $post_status,
		'post_type'    => $post_type,
	);
	if ( $existing ) {
		$args['ID'] = $existing->ID;
		$id         = wp_update_post( $args, true );
	} else {
		$id = wp_insert_post( $args, true );
	}
	if ( is_wp_error( $id ) ) {
		throw new RuntimeException( $id->get_error_message() );
	}
	return (int) $id;
}

function GES_upsert_archive_page( $slug, $title, $intro_html, $query_args, $page_template = 'page_blog.php' ) {
	$page_id = GES_upsert_post_content( $slug, $title, $intro_html, 'page' );
	update_post_meta( $page_id, 'query_args', $query_args );
	if ( $page_template ) {
		update_post_meta( $page_id, '_wp_page_template', $page_template );
	}
	return $page_id;
}

function GES_upsert_post_with_category( $slug, $title, $html, $category_slug ) {
	return GES_upsert_post_with_categories( $slug, $title, $html, array( $category_slug ) );
}

function GES_upsert_post_with_categories( $slug, $title, $html, $category_slugs ) {
	$post_id = GES_upsert_post_content( $slug, $title, $html, 'post' );
	$cat_ids = array();
	foreach ( (array) $category_slugs as $category_slug ) {
		$cat_ids[] = GES_get_term_id_by_slug( $category_slug );
	}
	wp_set_post_categories( $post_id, array_values( array_unique( $cat_ids ) ) );
	return $post_id;
}

function GES_parse_capability_frontmatter( $markdown ) {
	$fields = array();
	if ( preg_match( '/^<!--\s*(.*?)\s*-->/s', $markdown, $m ) ) {
		if ( preg_match( '/CapabilityName:\s*(.+)$/m', $m[1], $cap ) ) {
			$fields['capability_name'] = trim( $cap[1] );
		}
		if ( preg_match( '/IndexDescription:\s*(.+)$/m', $m[1], $desc ) ) {
			$fields['index_description'] = trim( $desc[1] );
		}
		if ( preg_match( '/LastEdited:\s*(.+)$/m', $m[1], $led ) ) {
			$fields['last_edited'] = trim( $led[1] );
		}
		if ( preg_match( '/HostLastEdited:\s*(.+)$/m', $m[1], $hled ) ) {
			$fields['host_last_edited'] = trim( $hled[1] );
		}
	}
	return $fields;
}

function GES_capability_markdown_to_html( $path ) {
	$md = GES_strip_markdown_page( $path );
	return GES_md_to_html( $md );
}

function GES_add_pages_to_nav_menu( $menu_name, $page_ids_by_title ) {
	$menu = wp_get_nav_menu_object( $menu_name );
	if ( ! $menu ) {
		throw new RuntimeException( "Nav menu not found: $menu_name" );
	}
	$menu_id        = (int) $menu->term_id;
	$existing_items = wp_get_nav_menu_items( $menu_id );
	$existing_pages = array();
	if ( $existing_items ) {
		foreach ( $existing_items as $item ) {
			if ( 'post_type' === $item->type && 'page' === $item->object ) {
				$existing_pages[ (int) $item->object_id ] = true;
			}
		}
	}
	foreach ( $page_ids_by_title as $title => $page_id ) {
		if ( isset( $existing_pages[ $page_id ] ) ) {
			continue;
		}
		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'     => $title,
				'menu-item-object'    => 'page',
				'menu-item-object-id' => $page_id,
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
			)
		);
	}
}

/**
 * Homepage section anchors for the one-page front page.
 *
 * Targets the Altitude front-page-N section ids. Used by the optional "Explore"
 * dropdown so visitors can jump (smooth scroll via the theme localScroll) to a
 * homepage section. Order matches the narrative flow in
 * Plans/GESFrontPageContentStrategyPlan.md.
 *
 * @return array<string, string> Label => section anchor (e.g. #front-page-3).
 */
function GES_front_page_section_anchors() {
	return array(
		'Three Pillars'    => '#front-page-3',
		'The Bedrock'      => '#front-page-4',
		'Repository Proof' => '#front-page-5',
		'First Steps'      => '#front-page-6',
		'Get Established'   => '#front-page-7',
	);
}

/**
 * Load the fluid nav-menu tree manifest (edit nav-menu-manifest.php to regroup).
 *
 * @return array<string, mixed>
 */
function GES_nav_menu_manifest() {
	static $manifest = null;
	if ( null === $manifest ) {
		$path = __DIR__ . '/nav-menu-manifest.php';
		if ( ! is_readable( $path ) ) {
			throw new RuntimeException( "Missing nav menu manifest: $path" );
		}
		$manifest = require $path;
	}
	return $manifest;
}

/**
 * Add one manifest menu item (recursing into 'children' as a submenu).
 *
 * @param int                  $menu_id   Menu term id.
 * @param array<string, mixed> $item      Manifest item (see nav-menu-manifest.php).
 * @param int                  $parent_id Parent menu item id (0 for top level).
 * @return int Created menu item id (0 when skipped).
 */
function GES_add_nav_item( $menu_id, $item, $parent_id = 0 ) {
	$type  = $item['type'] ?? 'page';
	$title = $item['title'] ?? '';
	$args  = array(
		'menu-item-title'     => $title,
		'menu-item-status'    => 'publish',
		'menu-item-parent-id' => $parent_id,
	);

	switch ( $type ) {
		case 'home':
			$args['menu-item-url']  = home_url( '/' );
			$args['menu-item-type'] = 'custom';
			break;
		case 'anchor':
			$args['menu-item-url']  = home_url( '/' ) . ( $item['anchor'] ?? '' );
			$args['menu-item-type'] = 'custom';
			break;
		case 'custom':
		case 'dropdown':
			$args['menu-item-url']  = $item['url'] ?? '#';
			$args['menu-item-type'] = 'custom';
			break;
		case 'page':
		default:
			$page = get_page_by_path( $item['slug'] ?? '' );
			if ( ! $page ) {
				GES_log( "Skip menu item (page missing): $title ({$item['slug']})" );
				return 0;
			}
			$args['menu-item-object']    = 'page';
			$args['menu-item-object-id'] = (int) $page->ID;
			$args['menu-item-type']      = 'post_type';
			break;
	}

	$item_id = wp_update_nav_menu_item( $menu_id, 0, $args );
	if ( is_wp_error( $item_id ) ) {
		throw new RuntimeException( $item_id->get_error_message() );
	}
	$item_id = (int) $item_id;

	if ( ! empty( $item['children'] ) ) {
		foreach ( $item['children'] as $child ) {
			GES_add_nav_item( $menu_id, $child, $item_id );
		}
	}
	return $item_id;
}

/**
 * Rebuild the primary nav from nav-menu-manifest.php (fluid, data-driven).
 *
 * @param string $menu_name               Menu name override (defaults to manifest).
 * @param bool   $include_section_anchors  Append an "Explore" dropdown of homepage
 *                                         section anchors when true.
 */
function GES_sync_primary_nav_menu( $menu_name = '', $include_section_anchors = false ) {
	$manifest  = GES_nav_menu_manifest();
	$menu_name = '' !== $menu_name ? $menu_name : ( $manifest['menu_name'] ?? 'Primary Menu' );

	$menu    = wp_get_nav_menu_object( $menu_name );
	$menu_id = $menu ? (int) $menu->term_id : (int) wp_create_nav_menu( $menu_name );

	$existing_items = wp_get_nav_menu_items( $menu_id );
	if ( $existing_items ) {
		foreach ( $existing_items as $item ) {
			wp_delete_post( $item->ID, true );
		}
	}

	$items = $manifest['items'] ?? array();

	if ( $include_section_anchors ) {
		$children = array();
		foreach ( GES_front_page_section_anchors() as $title => $anchor ) {
			$children[] = array(
				'title'  => $title,
				'type'   => 'anchor',
				'anchor' => $anchor,
			);
		}
		$items[] = array(
			'title'    => 'Explore',
			'type'     => 'dropdown',
			'url'      => home_url( '/' ),
			'children' => $children,
		);
	}

	foreach ( $items as $item ) {
		GES_add_nav_item( $menu_id, $item, 0 );
	}

	$locations            = get_theme_mod( 'nav_menu_locations', array() );
	$locations['primary'] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );

	GES_log( "Primary nav menu synced: $menu_name (ID $menu_id, " . count( $items ) . ' top-level items)' );
}

function GES_export_categories( $taxonomy = 'category' ) {
	$terms = get_terms(
		array(
			'taxonomy'   => $taxonomy,
			'hide_empty' => false,
			'orderby'    => 'count',
			'order'      => 'DESC',
		)
	);
	if ( is_wp_error( $terms ) ) {
		throw new RuntimeException( $terms->get_error_message() );
	}
	return $terms;
}

function GES_export_query_args_pages() {
	global $wpdb;
	return $wpdb->get_results(
		"SELECT p.ID, p.post_name, p.post_title,
		MAX(CASE WHEN pm.meta_key='query_args' THEN pm.meta_value END) AS query_args,
		MAX(CASE WHEN pm.meta_key='_wp_page_template' THEN pm.meta_value END) AS page_template
		FROM {$wpdb->posts} p
		INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
		WHERE p.post_type='page' AND p.post_status='publish'
		AND pm.meta_key IN ('query_args','_wp_page_template')
		GROUP BY p.ID
		HAVING query_args IS NOT NULL AND query_args != ''
		ORDER BY p.post_title ASC"
	);
}

function GES_get_plugin_versions( $plugins_dir ) {
	$rows = array();
	if ( ! is_dir( $plugins_dir ) ) {
		return $rows;
	}
	foreach ( glob( $plugins_dir . '/*', GLOB_ONLYDIR ) as $dir ) {
		$slug    = basename( $dir );
		$version = '';
		foreach ( glob( $dir . '/*.php' ) as $file ) {
			$head = file_get_contents( $file, false, null, 0, 8192 );
			if ( preg_match( '/^\s*\*\s*Version:\s*(.+)$/mi', $head, $m ) ) {
				$version = trim( $m[1] );
				break;
			}
		}
		$rows[] = array(
			'slug'    => $slug,
			'version' => $version ?: '—',
		);
	}
	usort(
		$rows,
		function ( $a, $b ) {
			return strcasecmp( $a['slug'], $b['slug'] );
		}
	);
	return $rows;
}

function GES_render_kirby_category_map_md( $wp_root, $live_url = 'https://www.scv-kirby-smith.org/' ) {
	$categories = GES_export_categories( 'category' );
	$pages      = GES_export_query_args_pages();
	$plugins    = GES_get_plugin_versions( $wp_root . '/wp-content/plugins' );
	$date       = gmdate( 'Y-m-d' );

	$md  = "<!--\n";
	$md .= "IndexTitle: Kirby-Smith Category Map\n";
	$md .= "IndexDescription: Read-only inventory of post categories and query_args archive pages on kirby-smith reference site.\n";
	$md .= "IndexType: Reference\n";
	$md .= "IndexStatus: Active\n";
	$md .= "LastEdited: $date\n";
	$md .= "SourceSite: $wp_root\n";
	$md .= "LiveUrl: $live_url\n";
	$md .= "-->\n\n";
	$md .= "# Kirby-Smith Category Map\n\n";
	$md .= "Read-only reference from local WAMP **kirby-smith** ($date). Do not edit\n";
	$md .= "kirby-smith when using this map for GES planning.\n\n";
	$md .= "## Post Categories (with post counts)\n\n";
	$md .= "| ID | Slug | Name | Posts |\n";
	$md .= "| ---: | --- | --- | ---: |\n";
	foreach ( $categories as $term ) {
		$md .= sprintf(
			"| %d | %s | %s | %d |\n",
			(int) $term->term_id,
			$term->slug,
			str_replace( '|', '\\|', $term->name ),
			(int) $term->count
		);
	}
	$md .= "\nCategories with zero posts may still have archive pages configured.\n\n";
	$md .= "## Archive Pages Using query_args\n\n";
	$md .= "Genesis reads the page custom field **`query_args`** and runs a post loop below the\n";
	$md .= "page intro. Most kirby-smith archive pages use template **Custom Blog**\n";
	$md .= "(`page_blog.php`).\n\n";
	$md .= "| Page ID | Slug | Title | Template | query_args |\n";
	$md .= "| ---: | --- | --- | --- | --- |\n";
	foreach ( $pages as $page ) {
		$template = $page->page_template ?: '(default)';
		if ( $template === 'default' ) {
			$template = '(default)';
		}
		$md .= sprintf(
			"| %d | %s | %s | %s | `%s` |\n",
			(int) $page->ID,
			$page->post_name,
			str_replace( '|', '\\|', $page->post_title ),
			$template,
			$page->query_args
		);
	}
	$md .= "\n**Pattern:** intro HTML in page body + `showposts=5&cat={category_id}` is the most\n";
	$md .= "common recipe. Some pages omit `cat` to show recent posts from all categories.\n\n";
	$md .= "**Note:** Verify category IDs in admin with Reveal IDs before copying a recipe to a new site.\n\n";
	$md .= "## Installed Plugins (reference site)\n\n";
	$md .= "| Plugin folder | Version |\n";
	$md .= "| --- | --- |\n";
	foreach ( $plugins as $plugin ) {
		$md .= sprintf( "| %s | %s |\n", $plugin['slug'], $plugin['version'] );
	}
	$md .= "\nTheme stack: Genesis + Altitude Pro (local kirby-smith paths).\n\n";
	$md .= "## Related\n\n";
	$md .= "- [query-args-recipes.md](query-args-recipes.md)\n";
	$md .= "- [../Pages/01-GenesisQueryArgsAndArchivePages.md](../Pages/01-GenesisQueryArgsAndArchivePages.md)\n";
	return $md;
}

function GES_render_register_md( $rows, $site_url ) {
	$date = gmdate( 'Y-m-d' );
	$md   = "<!--\n";
	$md  .= "IndexTitle: GES Category ID Register\n";
	$md  .= "IndexDescription: Living register of {siteKey} post categories, IDs, and archive pages.\n";
	$md  .= "IndexType: Reference\n";
	$md  .= "IndexStatus: Active\n";
	$md  .= "LastEdited: $date\n";
	$md  .= "-->\n\n";
	$md  .= "# GES Category ID Register\n\n";
	$md  .= "Filled by `ges-content-setup.php` on local GES. Do not hard-code IDs in repo\n";
	$md  .= "Markdown before they exist on the target site.\n\n";
	$md  .= "Local GES: $site_url\n\n";
	$md  .= "## Categories and archive pages\n\n";
	$md  .= "| Category slug | Purpose | Category ID | Archive page slug | query_args | Status |\n";
	$md  .= "| --- | --- | ---: | --- | --- | --- |\n";
	foreach ( $rows as $row ) {
		$md .= sprintf(
			"| %s | %s | %d | %s | `%s` | %s |\n",
			$row['category_slug'],
			$row['purpose'],
			(int) $row['category_id'],
			$row['archive_slug'],
			$row['query_args'],
			$row['status']
		);
	}
	$md .= "\n## Workflow when creating each row\n\n";
	$md .= "1. Posts → Categories → Add New; note **ID** with Reveal IDs.\n";
	$md .= "2. Create archive **Page** with intro copy.\n";
	$md .= "3. Custom Fields → Name `query_args`, Value from [query-args-recipes.md](query-args-recipes.md).\n";
	$md .= "4. Optional: Template **Custom Blog** (`page_blog.php`).\n";
	$md .= "5. Re-run [ges-content-setup.php](../../LocalWordPressBuild/ges-content-setup.php) or update this table manually.\n\n";
	$md .= "## Related\n\n";
	$md .= "- [../Pages/05-GESContentArchitecture.md](../Pages/05-GESContentArchitecture.md)\n";
	$md .= "- [../Pages/08-WordPressContentAutomation.md](../Pages/08-WordPressContentAutomation.md)\n";
	return $md;
}
