<?php
/**
 * Plugin Name:       Codeally Block Editor Restrictions
 * Plugin URI:        https://github.com/oldrup/cdly-block-restrictions
 * Description:       Enforces editorial restrictions on the Block Editor (disables Block Directory, Remote Patterns, Openverse, unapproved blocks, and embed variations).
 * Version:           1.1.1
 * Requires at least: 6.5
 * Requires PHP:      8.2
 * Author:            Codeally
 * Author URI:        https://codeally.dk
 * License:           GPL-2.0-or-later
 * Text Domain:       cdly-block-restrictions
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Prevent direct execution.
}

/**
 * 1. Disable Inserter > Block Directory (plugin installer inside editor).
 */
add_filter( 'block_directory_enabled', '__return_false' );

/**
 * 2. Disable Inserter > Remote Patterns (patterns fetched from WordPress.org).
 */
add_filter( 'should_load_remote_block_patterns', '__return_false' );

/**
 * 3. Disable Inserter > Media Openverse search integration.
 */
add_filter( 'block_editor_settings_all', 'cdly_disable_openverse_media', 10, 1 );
function cdly_disable_openverse_media( array $settings ): array {
	$settings['enableOpenverseMediaCategory'] = false;
	$settings['enableOpenverseMediaTab']      = false;
	return $settings;
}

/**
 * 4. Whitelist allowed blocks when editing standard 'post' post types.
 *
 * @param array|bool               $allowed_block_types Array of block type slugs, or boolean.
 * @param \WP_Block_Editor_Context $block_editor_context The current block editor context.
 * @return array|bool
 */
add_filter( 'allowed_block_types_all', 'cdly_allowed_block_types_for_posts', 10, 2 );
function cdly_allowed_block_types_for_posts( array|bool $allowed_block_types, \WP_Block_Editor_Context $block_editor_context ): array|bool {

	// Apply restrictions only when editing standard 'post' post types in the post editor context.
	if (
		isset( $block_editor_context->name, $block_editor_context->post ) &&
		'core/edit-post' === $block_editor_context->name &&
		'post' === $block_editor_context->post->post_type
	) {
		return array(
			'core/accordion',
			'core/accordion-item',
			'core/accordion-header',
			'core/accordion-panel',
			'core/audio',
			'core/block',
			'core/button',
			'core/buttons',
			'core/code',
			'core/column',
			'core/columns',
			'core/cover',
			'core/details',
			'core/embed',
			'core/gallery',
			'core/group',
			'core/heading',
			'core/image',
			'core/icon',
			'core/list',
			'core/list-item',
			'core/media-text',
			'core/paragraph',
			'core/preformatted',
			'core/pullquote',
			'core/quote',
			'core/separator',
			'core/table',
			'core/tabs',
			'core/tab-list',
			'core/tab-panels',
			'core/tab-panel',
			'core/video',
			'core/missing',
			'cdly/pdf-link',
			'include-mastodon-feed/gutenberg-block',
			'outermost/icon-block',
			'simpletoc/toc',
		);
	}

	// Retain full block library for Site Editor, pages, or custom post types.
	return true;
}

/**
 * 5. Enqueue JavaScript and CSS for Block Editor UI restrictions.
 */
add_action( 'enqueue_block_editor_assets', 'cdly_enqueue_block_editor_restrictions' );
function cdly_enqueue_block_editor_restrictions(): void {
	$plugin_path = plugin_dir_path( __FILE__ );
	$plugin_url  = plugin_dir_url( __FILE__ );

	// Enqueue CSS UI decluttering stylesheet.
	$css_file = $plugin_path . 'assets/css/restrict-blocks.css';
	if ( file_exists( $css_file ) ) {
		wp_enqueue_style(
			'cdly-restrict-blocks-style',
			$plugin_url . 'assets/css/restrict-blocks.css',
			array(),
			(string) filemtime( $css_file )
		);
	}

	// Enqueue JS variation unregistration script.
	$js_file = $plugin_path . 'assets/js/restrict-blocks.js';
	if ( file_exists( $js_file ) ) {
		wp_enqueue_script(
			'cdly-restrict-blocks-script',
			$plugin_url . 'assets/js/restrict-blocks.js',
			array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ),
			(string) filemtime( $js_file ),
			true
		);
	}
}