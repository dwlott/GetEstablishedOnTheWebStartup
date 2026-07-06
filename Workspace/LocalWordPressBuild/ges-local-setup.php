<?php
/**
 * One-time local GES WordPress setup (CLI only).
 *
 * Copy to site root to run, then remove after success:
 *   G:\wamp64\bin\php\php8.3.14\php.exe ges-local-setup.php
 *
 * Source of truth for widget HTML: Workspace/LocalWordPressBuild/Widgets/
 * Page content: Content/Website/Pages/ with strip-map rules in script.
 */

if ( php_sapi_name() !== 'cli' ) {
	exit( "CLI only.\n" );
}

$wp_root = __DIR__;
require_once $wp_root . '/wp-load.php';

$repo_root = 'C:/Repositories/{siteKey}';
$widget_dir = $repo_root . '/Workspace/LocalWordPressBuild/Widgets';
$page_dir   = $repo_root . '/Content/Website/Pages';

function GES_log( $msg ) {
	echo $msg . PHP_EOL;
}

function GES_read_widget( $dir, $file ) {
	$path = $dir . '/' . $file;
	if ( ! is_readable( $path ) ) {
		throw new RuntimeException( "Missing widget file: $path" );
	}
	return trim( file_get_contents( $path ) );
}

function GES_strip_markdown_page( $path ) {
	$text = file_get_contents( $path );
	$text = preg_replace( '/^<!--.*?-->\s*/s', '', $text );
	foreach ( array( 'Link Intent', 'Open Decisions', 'Draft Status', 'Notes For Future Editing' ) as $section ) {
		$text = preg_replace( '/\n## ' . preg_quote( $section, '/' ) . '\b.*\z/s', '', $text );
	}
	$remove_lines = array(
		'This page introduces the promise, the Get Established Workspace, guided setup, and the first action — before any website build.',
		'This page gives beginners the first practical steps and points to discovery and setup resources.',
		'This page explains the method from first planning through future publishing — without rushing into hosting setup.',
		'This page describes guided setup and supporting future offer ideas without locking pricing or packaging.',
		'This page explains the mission, repository proof, website tracks, and credibility approach.',
		'This page shows how agents use the repository, prompts, and planning files to help safely.',
		'This page explains repository history, reviewable changes, and milestone syncs for beginners.',
		'This page explains permission prompts, sandbox boundaries, and safer approval habits in plain language.',
		'This page should later link to a beginner-friendly GitHub guide once the repository has a fuller pull, edit, review, commit, and milestone sync workflow. Do not add tool-specific setup steps until the project is ready for them.',
		'This page can later include example prompts and before-after task examples from repository history. Do not invent examples; use real repository milestones when they exist.',
		'This page is a public-facing draft. It should stay short and plain, with detailed command examples and recovery steps kept in the setup documentation.',
		'This page can remain mission-first for now. A more specific personal origin story remains a human decision for a later pass.',
	);
	foreach ( $remove_lines as $line ) {
		$text = str_replace( $line, '', $text );
	}
	return trim( preg_replace( "/\n{3,}/", "\n\n", $text ) );
}

function GES_md_to_html( $markdown ) {
	$lines   = preg_split( '/\r\n|\r|\n/', $markdown );
	$html    = '';
	$in_list = false;
	$in_ol   = false;

	$close_list = function () use ( &$html, &$in_list, &$in_ol ) {
		if ( $in_list ) {
			$html   .= "</ul>\n";
			$in_list = false;
		}
		if ( $in_ol ) {
			$html .= "</ol>\n";
			$in_ol = false;
		}
	};

	foreach ( $lines as $line ) {
		$trim = trim( $line );
		if ( $trim === '' ) {
			$close_list();
			continue;
		}
		if ( preg_match( '/^# (.+)$/', $trim, $m ) ) {
			$close_list();
			$html .= '<h2>' . esc_html( $m[1] ) . "</h2>\n";
			continue;
		}
		if ( preg_match( '/^## (.+)$/', $trim, $m ) ) {
			$close_list();
			$html .= '<h2>' . esc_html( $m[1] ) . "</h2>\n";
			continue;
		}
		if ( preg_match( '/^### (.+)$/', $trim, $m ) ) {
			$close_list();
			$html .= '<h3>' . esc_html( $m[1] ) . "</h3>\n";
			continue;
		}
		if ( preg_match( '/^(\d+)\. (.+)$/', $trim, $m ) ) {
			if ( ! $in_ol ) {
				$close_list();
				$html  .= "<ol>\n";
				$in_ol = true;
			}
			$html .= '<li>' . GES_inline_md( $m[2] ) . "</li>\n";
			continue;
		}
		if ( preg_match( '/^- (.+)$/', $trim, $m ) ) {
			if ( ! $in_list ) {
				$close_list();
				$html    .= "<ul>\n";
				$in_list = true;
			}
			$html .= '<li>' . GES_inline_md( $m[1] ) . "</li>\n";
			continue;
		}
		$close_list();
		$html .= '<p>' . GES_inline_md( $trim ) . "</p>\n";
	}
	$close_list();
	return trim( $html );
}

function GES_inline_md( $text ) {
	$text = preg_replace( '/`([^`]+)`/', '<code>$1</code>', $text );
	$text = preg_replace( '/\*\*(.+?)\*\*/', '<strong>$1</strong>', $text );
	$text = preg_replace( '/(?<!\*)\*(?!\*)(.+?)(?<!\*)\*(?!\*)/', '<em>$1</em>', $text );
	return $text;
}

function GES_add_custom_html_widget( $content, $title = '' ) {
	$widgets = get_option( 'widget_custom_html', array( '_multiwidget' => 1 ) );
	$max     = 0;
	foreach ( $widgets as $key => $val ) {
		if ( is_numeric( $key ) ) {
			$max = max( $max, (int) $key );
		}
	}
	$id              = $max + 1;
	$widgets[ $id ]  = array(
		'title'   => $title,
		'content' => $content,
	);
	update_option( 'widget_custom_html', $widgets );
	return 'custom_html-' . $id;
}

function GES_upsert_page( $slug, $title, $html ) {
	$existing = get_page_by_path( $slug, OBJECT, 'page' );
	$args     = array(
		'post_title'   => $title,
		'post_name'    => $slug,
		'post_content' => $html,
		'post_status'  => 'publish',
		'post_type'    => 'page',
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

GES_log( 'Activating Altitude Pro theme...' );
switch_theme( 'altitude-pro' );

update_option( 'blogname', 'Get Established On The Web' );
update_option( 'blogdescription', 'A prepared foundation for using AI to build your online presence.' );
update_option( 'permalink_structure', '/%postname%/' );
update_option( 'show_on_front', 'posts' );
update_option( 'page_on_front', 0 );
update_option( 'page_for_posts', 0 );
flush_rewrite_rules();

$genesis = get_option( 'genesis-settings', array() );
$genesis['blog_cat_num'] = 0;
update_option( 'genesis-settings', $genesis );

GES_apply_brand_theme_colors();

GES_log( 'Creating P1/P2 pages...' );
$pages = array(
	'start-here'         => array( 'Start Here', 'StartHere.md' ),
	'how-it-works'       => array( 'How It Works', 'HowItWorks.md' ),
	'offers'             => array( 'Offers', 'Offers.md' ),
	'about'              => array( 'About', 'About.md' ),
	'ai-workflow'        => array( 'AI Workflow', 'AIWorkflow.md' ),
	'github-workflow'    => array( 'GitHub Workflow', 'GitHubWorkflow.md' ),
	'agent-permissions'  => array( 'Agent Permissions', 'AgentPermissions.md' ),
);
$page_ids = array();
foreach ( $pages as $slug => $meta ) {
	list( $title, $file ) = $meta;
	$md                   = GES_strip_markdown_page( $page_dir . '/' . $file );
	$md                   = preg_replace( '/^# .+\n+/', '', $md, 1 );
	$html                 = GES_md_to_html( $md );
	$page_ids[ $slug ]    = GES_upsert_page( $slug, $title, $html );
	GES_log( "  Page: $title ($slug) => ID {$page_ids[$slug]}" );
}

GES_log( 'Configuring front-page widgets...' );
$sidebars = array(
	'wp_inactive_widgets' => array(),
	'array_version'       => 3,
	'front-page-1'        => array( GES_add_custom_html_widget( GES_read_widget( $widget_dir, 'front-page-1.html' ) ) ),
	'front-page-2'        => array( GES_add_custom_html_widget( GES_read_widget( $widget_dir, 'front-page-2.html' ) ) ),
	'front-page-3'        => array(
		GES_add_custom_html_widget( GES_read_widget( $widget_dir, 'front-page-3-col1.html' ) ),
		GES_add_custom_html_widget( GES_read_widget( $widget_dir, 'front-page-3-col2.html' ) ),
		GES_add_custom_html_widget( GES_read_widget( $widget_dir, 'front-page-3-col3.html' ) ),
	),
	'front-page-4'        => array(
		GES_add_custom_html_widget( GES_read_widget( $widget_dir, 'front-page-4-intro.html' ) ),
		GES_add_custom_html_widget( GES_read_widget( $widget_dir, 'front-page-4-col1.html' ) ),
		GES_add_custom_html_widget( GES_read_widget( $widget_dir, 'front-page-4-col2.html' ) ),
		GES_add_custom_html_widget( GES_read_widget( $widget_dir, 'front-page-4-col3.html' ) ),
	),
	'front-page-5'        => array( GES_add_custom_html_widget( GES_read_widget( $widget_dir, 'front-page-5.html' ) ) ),
	'front-page-6'        => array( GES_add_custom_html_widget( GES_read_widget( $widget_dir, 'front-page-6.html' ) ) ),
	'front-page-7'        => array( GES_add_custom_html_widget( GES_read_widget( $widget_dir, 'front-page-7.html' ) ) ),
	'sidebar'             => array(),
	'sidebar-alt'         => array(),
	'header-right'        => array(),
	'footer-1'            => array( GES_add_custom_html_widget( GES_read_widget( $widget_dir, 'footer-1.html' ) ) ),
	'after-entry'         => array(),
);
update_option( 'sidebars_widgets', $sidebars );

GES_log( 'Creating primary navigation menu...' );
GES_sync_primary_nav_menu( 'Primary Menu' );

GES_log( 'Setup complete.' );
GES_log( 'Visit: ' . home_url( '/' ) );
