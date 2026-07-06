<?php
/**
 * Declarative GES post categories, archive pages, and sample posts.
 * Uses slugs only — numeric category IDs are resolved at runtime.
 */

return array(
	'categories' => array(
		array(
			'slug'        => 'get-established-showcase',
			'name'        => 'Get Established Showcase',
			'description' => 'Repository and method proof posts for the Get Established showcase.',
			'purpose'     => 'Get Established repository / method showcase',
		),
		array(
			'slug'        => 'movercalcs',
			'name'        => 'MoverCalcs',
			'description' => 'MoverCalcs web funnel case study posts.',
			'purpose'     => 'MoverCalcs web funnel case study',
		),
		array(
			'slug'        => 'updates',
			'name'        => 'Updates',
			'description' => 'Platform, AI workflow, and site progress notes.',
			'purpose'     => 'Platform and workflow updates',
		),
		array(
			'slug'        => 'tutorials',
			'name'        => 'Tutorials',
			'description' => 'How-to posts; video embeds when ARVE phase starts.',
			'purpose'     => 'Tutorials and demos',
		),
		array(
			'slug'        => 'get-established-method',
			'name'        => 'Get Established Method',
			'description' => 'Method lane — Capability catalog and related posts.',
			'purpose'     => 'Get Established method catalog',
			'parent_slug' => '',
		),
		array(
			'slug'        => 'ge-capabilities',
			'name'        => 'Capabilities',
			'description' => 'Public Capability reference posts synced from Git.',
			'purpose'     => 'Capability catalog hub loop',
			'parent_slug' => 'get-established-method',
		),
		array(
			'slug'        => 'ge-universal',
			'name'        => 'Universal Capabilities',
			'description' => 'Capabilities every strong repository can adopt.',
			'purpose'     => 'Universal-tier Capability posts',
			'parent_slug' => 'ge-capabilities',
		),
		array(
			'slug'        => 'ge-web',
			'name'        => 'Web Capabilities',
			'description' => 'Web-presence and Get Established On The Web modules.',
			'purpose'     => 'Archetype web Capability posts',
			'parent_slug' => 'ge-capabilities',
		),
	),
	'archive_pages' => array(
		array(
			'slug'           => 'showcase',
			'title'          => 'Showcase',
			'category_slug'  => 'get-established-showcase',
			'query_args'     => 'showposts=10&cat={cat_id}',
			'page_template'  => 'page_blog.php',
			'add_to_nav'     => false,
			'nav_title'      => 'Showcase',
			'intro_html'     => '<h2>Get Established Showcase</h2><p>Posts that show the Get Established repository and method in action — starter outcomes, guided setup milestones, and proof from real work.</p>',
		),
		array(
			'slug'           => 'movercalcs',
			'title'          => 'MoverCalcs',
			'category_slug'  => 'movercalcs',
			'query_args'     => 'showposts=10&cat={cat_id}',
			'page_template'  => 'page_blog.php',
			'add_to_nav'     => false,
			'nav_title'      => 'MoverCalcs',
			'intro_html'     => '<h2>MoverCalcs</h2><p>Case study posts about the MoverCalcs web funnel built while developing the GetEstablished platform.</p>',
		),
		array(
			'slug'           => 'updates',
			'title'          => 'Updates',
			'category_slug'  => 'updates',
			'query_args'     => 'cat={cat_id}',
			'page_template'  => 'page_blog.php',
			'add_to_nav'     => false,
			'nav_title'      => 'Updates',
			'intro_html'     => '<h2>Updates</h2><p>Progress notes on the website, AI-assisted workflows, and platform development.</p>',
		),
		array(
			'slug'           => 'tutorials',
			'title'          => 'Tutorials',
			'category_slug'  => 'tutorials',
			'query_args'     => 'cat={cat_id}',
			'page_template'  => 'page_blog.php',
			'add_to_nav'     => false,
			'nav_title'      => 'Tutorials',
			'intro_html'     => '<h2>Tutorials</h2><p>How-to posts and demos. Video embeds will use ARVE in a later phase.</p>',
		),
		array(
			'slug'                => 'capabilities',
			'title'               => 'Capabilities',
			'category_slug'       => 'ge-capabilities',
			'query_args'          => 'showposts=20&cat={cat_id}',
			'page_template'       => 'page_blog.php',
			'add_to_nav'          => false,
			'nav_title'           => 'Capabilities',
			// Build the hub intro (image + lead/deck + body) from Git Markdown via
			// GES_build_page_html (page-layout-manifest 'capabilities' entry).
			'build_from_markdown' => 'Capabilities.md',
			'intro_html'          => '<h2>Capability Catalog</h2><p>Reference summaries for <strong>GetEstablished Capabilities</strong> — reusable workflow modules in the repository pattern. Agent Rules stay in Git; these posts explain what each module helps with and when to use it.</p><p>Use the sidebar <strong>Browse by Topic</strong> tree to filter by Universal or Web modules. Start with <a href="/method/">The Get Established Method</a>.</p>',
		),
	),
	'sample_posts' => array(
		array(
			'slug'          => 'showcase-welcome-post',
			'title'         => 'Welcome to the Get Established Showcase',
			'category_slug' => 'get-established-showcase',
			'content'       => '<p>This sample post proves the Genesis <code>query_args</code> archive workflow on local GES. Replace with real showcase content from repository milestones.</p>',
		),
		array(
			'slug'          => 'movercalcs-overview-post',
			'title'         => 'MoverCalcs Funnel Overview',
			'category_slug' => 'movercalcs',
			'content'       => '<p>Sample case study post for the MoverCalcs category. Describe the funnel pages and what was learned building on the GetEstablished method.</p>',
		),
		array(
			'slug'          => 'site-progress-update',
			'title'         => 'Local WordPress Build Progress',
			'category_slug' => 'updates',
			'content'       => '<p>Sample update post. Local Genesis + Altitude staging is live; category-driven archive pages are configured via automation scripts.</p>',
		),
		array(
			'slug'          => 'genesis-query-args-tutorial',
			'title'         => 'Genesis query_args Archive Pages',
			'category_slug' => 'tutorials',
			'content'       => '<p>Sample tutorial post. See the WordPress Genesis Operating Guide for the full category ID and <code>query_args</code> workflow.</p>',
		),
	),
	'nav_menu_name' => 'Primary Menu',
);
