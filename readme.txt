=== WP Term Family ===
Contributors: johnjamesjacoby, stuttter
Tags: taxonomy, term, meta, metadata, Family, privacy
Requires at least: 4.3
Tested up to: 4.4
Stable tag: 0.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Family for categories, tags, and other taxonomy terms

WP Term Family allows users to assign a Family to any category, tag, or taxonomy term using a dropdown, providing customized functionality for taxonomy terms.

= Dependencies =

This plugin requires [WP Term Meta](https://wordpress.org/plugins/wp-term-meta/ "Metadata, for taxonomy terms.")

= Also checkout =

* [WP Term Authors](https://wordpress.org/plugins/wp-term-authors/ "Authors for categories, tags, and other taxonomy terms.")
* [WP Term Order](https://wordpress.org/plugins/wp-term-order/ "Sort taxonomy terms, your way.")
* [WP Term Colors](https://wordpress.org/plugins/wp-term-colors/ "Pretty colors for categories, tags, and other taxonomy terms.")
* [WP Term Icons](https://wordpress.org/plugins/wp-term-icons/ "Pretty icons for categories, tags, and other taxonomy terms.")
* [WP User Groups](https://wordpress.org/plugins/wp-user-groups/ "Group users together with taxonomies & terms.")
* [WP Event Calendar](https://wordpress.org/plugins/wp-event-calendar/ "Flexible events, with a calendar view.")

== Screenshots ==

1. Category Family

== Installation ==

* Download and install using the built in WordPress plugin installer.
* Activate in the "Plugins" area of your admin by clicking the "Activate" link.
* No further setup or configuration is necessary.

== Frequently Asked Questions ==

= Does this plugin depend on any others? =

Yes. Please install the [WP Term Meta](https://wordpress.org/plugins/wp-term-meta/ "Metadata, for taxonomy terms.") plugin.

= Does this create new database tables? =

No. There are no new database tables with this plugin.

= Does this modify existing database tables? =

No. All of WordPress's core database tables remain untouched.

= How do I query for terms via their Family? =

With WordPress's `get_terms()` function, the same as usual, but with an additional `meta_query` argument according the `WP_Meta_Query` specification:
http://codex.wordpress.org/Class_Reference/WP_Meta_Query

`
$terms = get_terms( 'category', array(
	'depth'      => 1,
	'number'     => 100,
	'parent'     => 0,
	'hide_empty' => false,

	// Query by family using the "wp-term-meta" plugin!
	'meta_query' => array( array(
		'key'   => 'family',
		'value' => 'private'
	) )
) );
`

= Where can I get support? =

The WordPress support forums: https://wordpress.org/support/plugin/wp-term-family/

= Where can I find documentation? =

http://github.com/stuttter/wp-term-family/

== Changelog ==

= 0.2.0 =
* Update base class

= 0.1.1 =
* Fix quick-edit UI

= 0.1.0 =
* Initial release
