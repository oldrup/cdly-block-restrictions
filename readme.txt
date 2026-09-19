=== Codeally Block Editor Restrictions ===
Contributors: oldrup
Tags: gutenberg, block-editor, restrict-blocks, allowed-blocks, editor-curation
Requires at least: 6.5
Tested up to: 7.1
Requires PHP: 8.2
Stable tag: 1.1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Enforces strict, opinionated editorial restrictions on the Block Editor for post content creators.

== Description ==

Codeally Block Editor Restrictions is a zero-configuration, opinionated editorial curation plugin designed to declutter the Block Editor and enforce consistency when writing blog posts.

It restricts post authors to a strictly vetted whitelist of core and custom blocks while turning off external network calls, remote directory popups, unused embed providers, and distracting inspector UI panels.

= Features =

* **Strict Block Whitelist:** Restricts allowed blocks exclusively when editing standard 'post' post types.
* **Disables Block Directory:** Prevents users from searching for or installing external block plugins from the inserter.
* **Disables Remote Patterns:** Stops WordPress.org remote block patterns from loading in the pattern inserter.
* **Disables Openverse:** Removes the Openverse media search category and tab from the editor media library.
* **Prunes Embed Variations:** Unregisters obscure embed providers, keeping only YouTube, Vimeo, Spotify, Pocket Casts, and VideoPress.
* **Declutters Inspector UI:** Hides block card descriptions, control help text, and advanced custom CSS panels in the sidebar.
* **Preserves Site Editor:** Full block availability remains untouched in the Site Editor, for pages, and for custom post types.

== Installation ==

1. Upload the `cdly-block-restrictions` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the **Plugins** menu in WordPress.
3. No configuration needed—restrictions apply automatically when editing posts.

== Frequently Asked Questions ==

= Does this plugin have a settings page? =
No. This plugin is intentionally opinionated with zero options or database overhead.

= What if I need filters to customize the allowed blocks? =
If your project requires customizable filters or a different curation strategy, check out [MRW Simplified Editor](https://wordpress.org/plugins/mrw-web-design-simple-tinymce/).

== Credits ==

Inspired by and built upon techniques shared in:
* [15 ways to curate the WordPress editing experience](https://developer.wordpress.org/news/2024/07/15-ways-to-curate-the-wordpress-editing-experience/) by Nick Diego.
* [MRW Simplified Editor](https://wordpress.org/plugins/mrw-web-design-simple-tinymce/) by Mark Root-Wiley (MRW Web Design).

== Changelog ==

= 1.1.0 =
* Added CSS stylesheet to declutter the Block Inspector panel (hides block descriptions, help text, and custom CSS input).

= 1.0.0 =
* Initial release.