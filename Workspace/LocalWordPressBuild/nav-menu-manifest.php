<?php
/**
 * GES primary navigation menu tree (fluid — edit here to regroup).
 *
 * Consumed by GES_sync_primary_nav_menu() via ges-nav-menu-sync.php.
 * The whole menu is rebuilt from this tree on each sync.
 *
 * Item types:
 *   home     - links to home_url('/')
 *   page     - links to a published Page by 'slug' (skipped if the page is missing)
 *   custom   - links to a literal 'url'
 *   dropdown - a non-navigating parent (url defaults to '#') with 'children'
 *   anchor   - links to home_url('/') . 'anchor' (front-page section scroll)
 *
 * Any item may carry 'children' to become a submenu. The optional Explore
 * section-anchor dropdown is appended at runtime with --section-anchors.
 */

return array(
	'menu_name' => 'Primary Menu',
	'items'     => array(
		array(
			'title' => 'Home',
			'type'  => 'home',
		),
		array(
			'title'    => 'Get Listed',
			'type'     => 'page',
			'slug'     => 'get-listed',
			'children' => array(
				array(
					'title' => 'Get on Google',
					'type'  => 'page',
					'slug'  => 'google-business-profile-basics',
				),
				array(
					'title' => 'Get on Bing',
					'type'  => 'page',
					'slug'  => 'bing-places-basics',
				),
				array(
					'title' => 'Get on Facebook',
					'type'  => 'page',
					'slug'  => 'facebook-business-page-basics',
				),
				array(
					'title' => 'Get on Nextdoor',
					'type'  => 'page',
					'slug'  => 'nextdoor-business-page-basics',
				),
				array(
					'title' => 'Get on Foursquare',
					'type'  => 'page',
					'slug'  => 'foursquare-business-listing-basics',
				),
				array(
					'title' => 'Get on BBB',
					'type'  => 'page',
					'slug'  => 'better-business-bureau-profile-basics',
				),
				array(
					'title' => 'Get on Yelp',
					'type'  => 'page',
					'slug'  => 'yelp-basics',
				),
				array(
					'title' => 'Get on Apple Maps',
					'type'  => 'page',
					'slug'  => 'apple-maps-basics',
				),
				array(
					'title' => 'Get on Yellow Pages',
					'type'  => 'page',
					'slug'  => 'yellow-pages-basics',
				),
			),
		),
		array(
			'title'    => 'Use AI',
			'type'     => 'page',
			'slug'     => 'use-ai',
			'children' => array(
				array(
					'title' => 'Repositories',
					'type'  => 'page',
					'slug'  => 'repositories',
				),
				array(
					'title' => 'GetEstablished',
					'type'  => 'page',
					'slug'  => 'getestablished',
				),
				array(
					'title' => 'Get Established On The Web',
					'type'  => 'page',
					'slug'  => 'get-established-on-the-web',
				),
			),
		),
		array(
			'title' => 'About',
			'type'  => 'page',
			'slug'  => 'about',
		),
	),
);
