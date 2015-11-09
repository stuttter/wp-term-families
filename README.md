# WP Term Families

Families for categories, tags, and other taxonomy terms.

WP Term Families allows users to assign a "Family" to any category, tag, or taxonomy term using a dropdown of terms from another taxonomy.

# Installation

* Download and install using the built in WordPress plugin installer.
* Activate in the "Plugins" area of your admin by clicking the "Activate" link.
* No further setup or configuration is necessary.

# FAQ

### Does this plugin depend on any others?

Yes. Please install the WP Term Meta plugin.

### Does this create new database tables?

No. There are no new database tables with this plugin.

### Does this modify existing database tables?

No. All of WordPress's core database tables remain untouched.

### How do I use it?

Connect taxonomies together like so:

```
/**
 * Use 'post_tag' taxonomy as a family for categories
 */
function your_plugin_thing() {
	wp_set_taxonomy_family( 'category', 'post_tag' );
}
add_action( 'wp_register_term_families', 'your_plugin_thing' );
```

Then query for terms by their `family` with a `meta_query` like:

```
$terms = get_terms( 'category', array(
	'depth'      => 1,
	'number'     => 100,
	'parent'     => 0,
	'hide_empty' => false,

	// Query by family
	'meta_query' => array( array(
		'key'   => 'family',
		'value' => 2 // term ID 2 in 'post_tag' taxonomy
	) )
) );
```

### Where can I get support?

The WordPress support forums: https://wordpress.org/support/plugin/wp-term-families/

### Can I contribute?

Yes, please! The number of users needing more robust taxonomy terms is growing fast. Having an easy-to-use UI and powerful set of functions is critical to managing complex WordPress installations. If this is your thing, please help us out!
