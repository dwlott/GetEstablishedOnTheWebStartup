<?php
/**
 * GES site link behavior — external links open in a new tab.
 */

if ( ! function_exists( 'GES_link_new_tab_attrs_html' ) ) {
	function GES_link_new_tab_attrs_html() {
		return ' target="_blank" rel="noopener noreferrer"';
	}
}

if ( ! function_exists( 'GES_is_external_href' ) ) {
	/**
	 * True when a link leaves the current site (http/https off-site).
	 *
	 * @param string $href Anchor href.
	 * @return bool
	 */
	function GES_is_external_href( $href ) {
		$href = trim( html_entity_decode( $href, ENT_QUOTES ) );
		if ( $href === '' || strpos( $href, '#' ) === 0 ) {
			return false;
		}
		if ( preg_match( '#^(mailto:|tel:|javascript:)#i', $href ) ) {
			return false;
		}
		if ( ! preg_match( '#^https?://#i', $href ) && strpos( $href, '//' ) !== 0 ) {
			return false;
		}

		$site_host = wp_parse_url( home_url(), PHP_URL_HOST );
		$link_host = wp_parse_url( $href, PHP_URL_HOST );
		if ( ! $site_host || ! $link_host ) {
			return false;
		}

		return strtolower( $link_host ) !== strtolower( $site_host );
	}
}

if ( ! function_exists( 'GES_apply_link_new_tab_attrs' ) ) {
	/**
	 * External links: target="_blank". Internal links: same tab (strip stale targets).
	 *
	 * @param string $html HTML fragment.
	 * @return string
	 */
	function GES_apply_link_new_tab_attrs( $html ) {
		if ( ! is_string( $html ) || $html === '' ) {
			return $html;
		}

		return preg_replace_callback(
			'/<a(\s[^>]*)>/i',
			function ( $matches ) {
				if ( ! preg_match( '/\bhref=(["\'])([^"\']*)\1/i', $matches[1], $href_match ) ) {
					return $matches[0];
				}

				$attrs = $matches[1];
				$href  = $href_match[2];

				if ( GES_is_external_href( $href ) ) {
					if ( preg_match( '/\btarget\s*=/i', $attrs ) ) {
						return $matches[0];
					}
					return '<a' . $attrs . GES_link_new_tab_attrs_html() . '>';
				}

				$attrs = preg_replace( '/\s*target=(["\'])[^"\']*\1/i', '', $attrs );
				$attrs = preg_replace( '/\s*rel=(["\'])noopener noreferrer\1/i', '', $attrs );
				return '<a' . $attrs . '>';
			},
			$html
		);
	}
}
