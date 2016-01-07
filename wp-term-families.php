<?php

/**
 * Plugin Name: WP Term Families
 * Plugin URI:  https://wordpress.org/plugins/wp-term-families/
 * Description: Families for taxonomy terms
 * Author:      John James Jacoby
 * Version:     0.2.0
 * Author URI:  https://profiles.wordpress.org/johnjamesjacoby/
 * License:     GPL v2 or later
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Instantiate the main WordPress Term Family class
 *
 * @since 0.1.0
 */
function _wp_term_families() {

	// Bail if no term meta
	if ( ! function_exists( 'add_term_meta' ) ) {
		return;
	}

	// Setup the main file
	$plugin_path = plugin_dir_path( __FILE__ );

	// Include the main class
	require_once $plugin_path . '/includes/functions.php';
	require_once $plugin_path . '/includes/class-wp-term-meta-ui.php';
	require_once $plugin_path . '/includes/class-wp-term-family.php';
}
add_action( 'plugins_loaded', '_wp_term_families' );

/**
 * Initialize the main WordPress Term Family class
 *
 * @since 0.1.0
 */
function _wp_term_families_init() {

	// Allow term families to be registered
	do_action( 'wp_register_term_families' );

	// Activate term family
	new WP_Term_Family( __FILE__ );
}
add_action( 'init', '_wp_term_families_init', 75 );
