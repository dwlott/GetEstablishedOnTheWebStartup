<?php
/**
 * GES Altitude Pro customizations — enqueue overlay, disable Google Fonts, page layout.
 *
 * Copied to: wp-content/themes/altitude-pro/ges-custom/ges-customizations.php
 */

require_once get_stylesheet_directory() . '/ges-custom/ges-site-links.php';

add_filter(
	'the_content',
	function ( $content ) {
		return GES_apply_link_new_tab_attrs( $content );
	},
	99
);

add_filter(
	'widget_text',
	function ( $content ) {
		return GES_apply_link_new_tab_attrs( $content );
	},
	99
);

add_filter(
	'widget_text_content',
	function ( $content ) {
		return GES_apply_link_new_tab_attrs( $content );
	},
	99
);

add_filter(
	'nav_menu_link_attributes',
	function ( $atts, $item ) {
		$url = isset( $item->url ) ? (string) $item->url : '';
		if ( GES_is_external_href( $url ) ) {
			$atts['target'] = '_blank';
			$atts['rel']    = 'noopener noreferrer';
		} else {
			unset( $atts['target'], $atts['rel'] );
		}
		return $atts;
	},
	10,
	2
);

add_action(
	'wp_enqueue_scripts',
	function () {
		$css_path = get_stylesheet_directory() . '/ges-custom/ges-altitude-custom.css';
		if ( ! is_readable( $css_path ) ) {
			return;
		}
		wp_enqueue_style(
			'ges-altitude-custom',
			get_stylesheet_directory_uri() . '/ges-custom/ges-altitude-custom.css',
			array( genesis_get_theme_handle() ),
			(string) filemtime( $css_path )
		);
	},
	20
);

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_dequeue_style( genesis_get_theme_handle() . '-fonts' );
		wp_deregister_style( genesis_get_theme_handle() . '-fonts' );
	},
	100
);

add_action(
	'after_setup_theme',
	function () {
		add_image_size( 'ges-page-banner', 1920, 640, true );
		add_image_size( 'ges-page-intro', 600, 600, true );
	},
	20
);

add_filter(
	'genesis_title_hidden',
	function ( $hidden ) {
		if ( is_page() && ! is_front_page() ) {
			return true;
		}
		return $hidden;
	}
);

add_filter(
	'genesis_custom_loop_args',
	function ( $args ) {
		if ( ! empty( $args['post__in'] ) && is_string( $args['post__in'] ) ) {
			$args['post__in'] = array_map( 'intval', explode( ',', $args['post__in'] ) );
		}
		if ( isset( $args['posts_per_page'] ) ) {
			$args['posts_per_page'] = (int) $args['posts_per_page'];
		}
		return $args;
	},
	10,
	1
);

add_filter(
	'genesis_site_layout',
	function ( $layout ) {
		if ( is_page() && ! is_front_page() ) {
			// Offer-hub pages keep the full-width marketing shell; every other
			// inner page (plain pages and content hubs) gets the menu sidebar.
			if ( GES_page_uses_marketing_layout() ) {
				return 'full-width-content';
			}
			return 'content-sidebar';
		}
		if ( is_single() && 'post' === get_post_type() ) {
			return 'content-sidebar';
		}
		if ( is_category() ) {
			return 'content-sidebar';
		}
		return $layout;
	}
);

add_filter(
	'body_class',
	function ( $classes ) {
		if ( is_page() && GES_page_has_query_args() ) {
			if ( GES_page_uses_marketing_layout() ) {
				$classes[] = 'ges-offer-hub';
			} else {
				$classes[] = 'ges-content-hub';
			}
		}
		// Plain inner pages (no query-args loop, not an offer hub) also show the
		// sidebar — rendered as the expanded primary-menu tree.
		if ( is_page() && ! is_front_page() && ! GES_page_has_query_args() && ! GES_page_uses_marketing_layout() ) {
			$classes[] = 'ges-content-hub';
			$classes[] = 'ges-page-sidebar';
		}
		if ( is_single() && 'post' === get_post_type() ) {
			$classes[] = 'ges-content-hub';
			if ( get_post_meta( get_queried_object_id(), 'GES_capability_name', true ) ) {
				$classes[] = 'ges-capability-post';
			}
		}
		if ( is_category() ) {
			$classes[] = 'ges-content-hub';
			if ( GES_is_capability_category() ) {
				$classes[] = 'ges-capability-archive';
			}
		}
		return $classes;
	}
);

// Capability category "group" pages list clean excerpts, not full posts.
add_filter(
	'genesis_pre_get_option_content_archive',
	function ( $pre ) {
		if ( GES_is_capability_category() ) {
			return 'excerpts';
		}
		return $pre;
	}
);

add_action(
	'genesis_before_entry',
	function () {
		if ( ! is_singular( 'post' ) ) {
			return;
		}
		if ( ! get_post_meta( get_queried_object_id(), 'GES_capability_name', true ) ) {
			return;
		}
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
		// Altitude relocates post info to priority 5; Genesis default is 12.
		remove_action( 'genesis_entry_header', 'genesis_post_info', 5 );
		remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
		remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
		remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
		remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
	},
	1
);

/**
 * True when the current page has a Genesis query_args loop (content hub).
 *
 * @param int $post_id Optional page ID.
 * @return bool
 */
function GES_page_has_query_args( $post_id = 0 ) {
	if ( ! $post_id ) {
		$post_id = get_queried_object_id();
	}
	if ( ! $post_id || 'page' !== get_post_type( $post_id ) ) {
		return false;
	}
	$query_args = get_post_meta( $post_id, 'query_args', true );
	return ! empty( $query_args );
}

/**
 * Offer hub pages that use the marketing intro shell (full width, no sidebar).
 *
 * @param int $post_id Optional page ID.
 * @return bool
 */
function GES_page_uses_marketing_layout( $post_id = 0 ) {
	if ( ! $post_id ) {
		$post_id = get_queried_object_id();
	}
	if ( ! $post_id || 'page' !== get_post_type( $post_id ) ) {
		return false;
	}
	return (bool) get_post_meta( $post_id, 'GES_marketing_layout', true );
}

/**
 * True on a Capability category archive (the "group" pages under ge-capabilities).
 *
 * @return bool
 */
function GES_is_capability_category() {
	if ( ! is_category() ) {
		return false;
	}
	$term = get_queried_object();
	if ( ! $term || empty( $term->term_id ) ) {
		return false;
	}
	if ( in_array( $term->slug, array( 'ge-capabilities', 'ge-universal', 'ge-web' ), true ) ) {
		return true;
	}
	foreach ( get_ancestors( (int) $term->term_id, 'category' ) as $ancestor_id ) {
		$ancestor = get_term( $ancestor_id, 'category' );
		if ( $ancestor && ! is_wp_error( $ancestor ) && 'ge-capabilities' === $ancestor->slug ) {
			return true;
		}
	}
	return false;
}

/**
 * Map a category slug to its hub archive page URL when one exists.
 *
 * @param string $slug Category slug.
 * @return string|null Page URL or null when no mapped archive page exists.
 */
function GES_category_archive_page_url( $slug ) {
	static $map = null;
	if ( null === $map ) {
		$map    = array();
		$path   = dirname( __DIR__, 2 ) . '/Workspace/LocalWordPressBuild/content-manifest.php';
		$config = is_readable( $path ) ? require $path : array();
		foreach ( (array) ( $config['archive_pages'] ?? array() ) as $page ) {
			if ( empty( $page['category_slug'] ) || empty( $page['slug'] ) ) {
				continue;
			}
			$map[ $page['category_slug'] ] = home_url( '/' . $page['slug'] . '/' );
		}
	}
	return $map[ $slug ] ?? null;
}

/**
 * Build nested hub sidebar tree for all top-level categories.
 *
 * @return string HTML ul.cat-list tree markup.
 */
function GES_render_hub_topic_tree_html() {
	$roots = get_terms(
		array(
			'taxonomy'   => 'category',
			'parent'     => 0,
			'hide_empty' => false,
			'orderby'    => 'name',
			'order'      => 'ASC',
		)
	);
	if ( is_wp_error( $roots ) || empty( $roots ) ) {
		return '';
	}

	$html = '<ul class="cat-list">';
	foreach ( $roots as $root_term ) {
		$html .= GES_render_capability_tree_term_node( $root_term );
	}
	$html .= '</ul>';
	return $html;
}

/**
 * Build nested hub sidebar tree from one category root (legacy helper).
 *
 * @param string $hub_slug Root category slug (default ge-capabilities).
 * @return string HTML ul.cat-list tree markup.
 */
function GES_render_capability_tree_html( $hub_slug = 'ge-capabilities' ) {
	$hub_term = get_term_by( 'slug', $hub_slug, 'category' );
	if ( ! $hub_term || is_wp_error( $hub_term ) ) {
		return '';
	}

	return '<ul class="cat-list">' . GES_render_capability_tree_term_node( $hub_term ) . '</ul>';
}

/**
 * @param WP_Term $term Category term node.
 * @return string HTML li subtree.
 */
function GES_render_capability_tree_term_node( $term ) {
	$page_url = GES_category_archive_page_url( $term->slug );
	if ( $page_url ) {
		$term_link = $page_url;
	} else {
		$term_link = get_term_link( $term );
		if ( is_wp_error( $term_link ) ) {
			$term_link = '#';
		}
	}

	$label = esc_html( $term->name );
	if ( $term->count ) {
		$label .= ' (' . number_format_i18n( $term->count ) . ')';
	}

	$html  = '<li class="cat-item cat-item-' . (int) $term->term_id . '">';
	$html .= '<a href="' . esc_url( $term_link ) . '">' . $label . '</a>';

	$child_terms = get_terms(
		array(
			'taxonomy'   => 'category',
			'parent'     => (int) $term->term_id,
			'hide_empty' => false,
			'orderby'    => 'name',
			'order'      => 'ASC',
		)
	);

	$child_html = '';
	if ( ! is_wp_error( $child_terms ) && ! empty( $child_terms ) ) {
		foreach ( $child_terms as $child_term ) {
			$child_html .= GES_render_capability_tree_term_node( $child_term );
		}
	} else {
		$posts = get_posts(
			array(
				'post_type'              => 'post',
				'post_status'            => 'publish',
				'posts_per_page'         => -1,
				'orderby'                => 'title',
				'order'                  => 'ASC',
				'ignore_sticky_posts'    => true,
				'category__in'           => array( (int) $term->term_id ),
				'update_post_term_cache' => false,
			)
		);
		foreach ( $posts as $post ) {
			$child_html .= '<li class="ges-cap-item ges-cap-post-' . (int) $post->ID . '">';
			$child_html .= '<a href="' . esc_url( get_permalink( $post ) ) . '">';
			$child_html .= esc_html( get_the_title( $post ) );
			$child_html .= '</a></li>';
		}
	}

	if ( $child_html !== '' ) {
		$html .= '<ul class="children">' . $child_html . '</ul>';
	}

	$html .= '</li>';
	return $html;
}

/**
 * Build the primary navigation menu as a nested tree for the page sidebar.
 *
 * @param string $menu_name Registered nav menu name.
 * @return string HTML ul.cat-list tree markup (empty string when unavailable).
 */
function GES_render_primary_menu_tree_html( $menu_name = 'Primary Menu' ) {
	$menu = wp_get_nav_menu_object( $menu_name );
	if ( ! $menu || is_wp_error( $menu ) ) {
		return '';
	}

	$items = wp_get_nav_menu_items(
		$menu->term_id,
		array( 'update_post_term_cache' => false )
	);
	if ( empty( $items ) || is_wp_error( $items ) ) {
		return '';
	}

	$by_parent = array();
	foreach ( $items as $item ) {
		$by_parent[ (int) $item->menu_item_parent ][] = $item;
	}

	$current_id = (int) get_queried_object_id();

	$build = function ( $parent_id ) use ( &$build, $by_parent, $current_id ) {
		if ( empty( $by_parent[ $parent_id ] ) ) {
			return '';
		}
		$list_class = 0 === $parent_id ? 'cat-list' : 'children';
		$html       = '<ul class="' . $list_class . '">';
		foreach ( $by_parent[ $parent_id ] as $item ) {
			$url         = ! empty( $item->url ) ? $item->url : '#';
			$item_class  = 'cat-item cat-item-' . (int) $item->ID;
			$object_id   = (int) $item->object_id;
			if ( $object_id && $object_id === $current_id ) {
				$item_class .= ' current-cat';
			}
			$html .= '<li class="' . esc_attr( $item_class ) . '">';
			$html .= '<a href="' . esc_url( $url ) . '">' . esc_html( $item->title ) . '</a>';
			$html .= $build( (int) $item->ID );
			$html .= '</li>';
		}
		$html .= '</ul>';
		return $html;
	};

	return $build( 0 );
}

/**
 * Page sidebar widget — primary menu rendered as an expanded tree.
 */
class GES_Menu_Tree_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'ges-menu-tree',
			'GES Menu Tree',
			array(
				// Share the Capability tree classname so sidebar styling applies.
				'classname'   => 'widget_GES_capability_tree widget_GES_menu_tree',
				'description' => 'Primary menu shown as an expanded sidebar tree on pages.',
			)
		);
	}

	/**
	 * @param array<string, mixed> $args     Display arguments.
	 * @param array<string, mixed> $instance Widget instance.
	 */
	public function widget( $args, $instance ) {
		// Only on plain inner pages (the menu-sidebar context).
		if ( ! is_page() || is_front_page() || GES_page_has_query_args() || GES_page_uses_marketing_layout() ) {
			return;
		}

		$menu_name = ! empty( $instance['menu_name'] ) ? $instance['menu_name'] : 'Primary Menu';
		$tree      = GES_render_primary_menu_tree_html( $menu_name );

		if ( $tree === '' ) {
			return;
		}

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . esc_html( $instance['title'] ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		echo '<div class="ges-hub-topic-tree ges-menu-tree-list">' . $tree . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * @param array<string, mixed> $new_instance New settings.
	 * @param array<string, mixed> $old_instance Prior settings.
	 * @return array<string, mixed>
	 */
	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['title']     = sanitize_text_field( $new_instance['title'] ?? '' );
		$instance['menu_name'] = sanitize_text_field( $new_instance['menu_name'] ?? 'Primary Menu' );
		return $instance;
	}

	/**
	 * @param array<string, mixed> $instance Widget instance.
	 */
	public function form( $instance ) {
		$title     = $instance['title'] ?? '';
		$menu_name = $instance['menu_name'] ?? 'Primary Menu';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'genesis' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'menu_name' ) ); ?>"><?php esc_html_e( 'Menu name:', 'genesis' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'menu_name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'menu_name' ) ); ?>" type="text" value="<?php echo esc_attr( $menu_name ); ?>" />
		</p>
		<?php
	}
}

/**
 * Hub sidebar widget — category tiers plus individual capability posts.
 */
class GES_Capability_Tree_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'ges-capability-tree',
			'GES Capability Tree',
			array(
				'classname'   => 'widget_GES_capability_tree',
				'description' => 'Browse Capabilities, tiers, and posts in a sidebar tree.',
			)
		);
	}

	/**
	 * @param array<string, mixed> $args     Display arguments.
	 * @param array<string, mixed> $instance Widget instance.
	 */
	public function widget( $args, $instance ) {
		// Plain pages show the primary-menu tree instead of the Capability tree.
		if ( is_page() && ! GES_page_has_query_args() ) {
			return;
		}

		$hub_slug = ! empty( $instance['hub_slug'] ) ? $instance['hub_slug'] : 'ge-capabilities';
		$tree     = GES_render_capability_tree_html( $hub_slug );

		if ( $tree === '' ) {
			return;
		}

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . esc_html( $instance['title'] ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		echo '<div class="ges-hub-topic-tree ges-capability-tree">' . $tree . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * @param array<string, mixed> $instance Widget instance.
	 * @return array<string, mixed>
	 */
	public function update( $new_instance, $old_instance ) {
		$instance             = $old_instance;
		$instance['title']    = sanitize_text_field( $new_instance['title'] ?? '' );
		$instance['hub_slug'] = sanitize_title( $new_instance['hub_slug'] ?? 'ge-capabilities' );
		return $instance;
	}

	/**
	 * @param array<string, mixed> $instance Widget instance.
	 */
	public function form( $instance ) {
		$title    = $instance['title'] ?? 'Browse by Topic';
		$hub_slug = $instance['hub_slug'] ?? 'ge-capabilities';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><? esc_html_e( 'Title:', 'genesis' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'hub_slug' ) ); ?>"><? esc_html_e( 'Hub category slug:', 'genesis' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'hub_slug' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hub_slug' ) ); ?>" type="text" value="<?php echo esc_attr( $hub_slug ); ?>" />
		</p>
		<?php
	}
}

add_action(
	'widgets_init',
	function () {
		register_widget( 'GES_Capability_Tree_Widget' );
		register_widget( 'GES_Menu_Tree_Widget' );
	}
);

add_action(
	'wp_enqueue_scripts',
	function () {
		if ( ! wp_script_is( 'tree-script', 'enqueued' ) ) {
			return;
		}
		$js = <<<'JS'
(function ($) {
	$(function () {
		$('.ges-hub-topic-tree').each(function () {
			var $tree = $(this);
			if ($tree.hasClass('jstree') || $tree.find('> .jstree').length) {
				return;
			}
			$tree.jstree({
				core: {
					themes: {
						icons: false,
						dots: true
					}
				}
			}).on('ready.jstree', function () {
				$tree.jstree('open_all');
			});
		});
		$('body').on('click', '.ges-hub-topic-tree a', function () {
			window.location = $(this).attr('href');
		});
	});
}(jQuery));
JS;
		wp_add_inline_script( 'tree-script', $js, 'after' );
	},
	110
);

add_filter(
	'wp_resource_hints',
	function ( $urls, $relation_type ) {
		if ( 'preconnect' === $relation_type ) {
			foreach ( $urls as $index => $url ) {
				$href = is_array( $url ) ? ( $url['href'] ?? '' ) : $url;
				if ( false !== strpos( (string) $href, 'fonts.gstatic.com' ) ) {
					unset( $urls[ $index ] );
				}
			}
		}
		return $urls;
	},
	10,
	2
);
