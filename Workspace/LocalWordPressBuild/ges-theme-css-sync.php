<?php
/**
 * Sync GES Altitude custom CSS overlay to local WAMP theme (CLI only).
 *
 * Usage:
 *   G:\wamp64\bin\php\php8.3.14\php.exe ges-theme-css-sync.php
 */

if ( php_sapi_name() !== 'cli' ) {
	exit( "CLI only.\n" );
}

$repo_build = __DIR__;
$wp_root    = 'G:/wamp64/www/{siteKey}';
$theme_dir  = $wp_root . '/wp-content/themes/altitude-pro';
$custom_dir = $theme_dir . '/ges-custom';
$functions  = $theme_dir . '/functions.php';

require_once $repo_build . '/ges-wp-content-lib.php';

$files = array(
	'ges-altitude-custom.css' => $repo_build . '/ges-altitude-custom.css',
	'ges-customizations.php'  => $repo_build . '/ges-customizations.php',
	'ges-site-links.php'        => $repo_build . '/ges-site-links.php',
);

if ( ! is_dir( $custom_dir ) ) {
	mkdir( $custom_dir, 0755, true );
	GES_log( "Created: $custom_dir" );
}

foreach ( $files as $name => $source ) {
	if ( ! is_readable( $source ) ) {
		throw new RuntimeException( "Missing source file: $source" );
	}
	$dest = $custom_dir . '/' . $name;
	copy( $source, $dest );
	GES_log( "Copied: $name" );
}

$require_line = "require_once get_stylesheet_directory() . '/ges-custom/ges-customizations.php';";
$functions_text = file_get_contents( $functions );

if ( false === strpos( $functions_text, $require_line ) ) {
	$functions_text = rtrim( $functions_text ) . "\n\n// GES custom CSS overlay.\n" . $require_line . "\n";
	file_put_contents( $functions, $functions_text );
	GES_log( 'Patched functions.php with ges-custom require.' );
} else {
	GES_log( 'functions.php already requires ges-customizations.php.' );
}

// Comment out Google Fonts enqueue block (strongshield pattern).
$old_enqueue = "\twp_enqueue_style( // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion -- see https://core.trac.wordpress.org/ticket/49742\n\t\tgenesis_get_theme_handle() . '-fonts',\n\t\t\$appearance['fonts-url'],\n\t\t[],\n\t\tnull\n\t);";

if ( false !== strpos( $functions_text, $old_enqueue ) && false === strpos( $functions_text, '// GES: Google Fonts disabled' ) ) {
	$new_enqueue = "\t// GES: Google Fonts disabled — system fonts in ges-altitude-custom.css\n\t/* wp_enqueue_style( // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion -- see https://core.trac.wordpress.org/ticket/49742\n\t\tgenesis_get_theme_handle() . '-fonts',\n\t\t\$appearance['fonts-url'],\n\t\t[],\n\t\tnull\n\t); */";
	$functions_text = str_replace( $old_enqueue, $new_enqueue, $functions_text );
	file_put_contents( $functions, $functions_text );
	GES_log( 'Commented Google Fonts enqueue in functions.php.' );
} elseif ( false !== strpos( file_get_contents( $functions ), 'GES: Google Fonts disabled' ) ) {
	GES_log( 'Google Fonts enqueue already commented.' );
}

GES_log( 'Theme CSS sync complete.' );
GES_log( 'Verify: http://localhost/{siteKey}/start-here/' );
