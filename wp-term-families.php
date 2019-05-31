<?php

/**
 * Plugin Name: WP Term Families
 * Plugin URI:  https://wordpress.org/plugins/wp-term-families/
 * Author:      John James Jacoby
 * Author URI:  https://profiles.wordpress.org/johnjamesjacoby/
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Description: Families for taxonomy terms
 * Version:     2.0.0
 * Text Domain: wp-term-families
 * Domain Path: /assets/lang/
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Instantiate the main WordPress Term Family class
 *
 * @since 0.1.0
 */
function _wp_term_families() {

	// Setup the main file
	$plugin_path = plugin_dir_path( __FILE__ );

	// Classes
	require_once $plugin_path . '/includes/class-wp-term-meta-ui.php';
	require_once $plugin_path . '/includes/class-wp-term-family.php';

	// Functions
	require_once $plugin_path . '/includes/functions.php';
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
