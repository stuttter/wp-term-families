<?php

/**
 * Term Family Functions
 *
 * @since 0.1.0
 *
 * @package TermFamily/Includes/Functions
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Filter the family taxonomies array, and ensure that taxonomies without
 * families do not get the UI
 *
 * @since 0.1.0
 *
 * @param array $args
 */
function wp_filter_taxonomy_families( $args = array() ) {
	$args['has_family'] = true;

	return $args;
}
add_filter( 'wp_term_family_get_taxonomies', 'wp_filter_taxonomy_families' );

/**
 * Set a family for a taxonomy
 *
 * @since 0.1.0
 *
 * @param string $taxonomy
 */
function wp_set_taxonomy_family( $taxonomy = '', $family = '' ) {

	// Bail if taxonomy does not exist
	if ( ! taxonomy_exists( $taxonomy ) ) {
		return;
	}

	// Set the taxonomy family
	$GLOBALS['wp_taxonomies'][ $taxonomy ]->has_family = true;
	$GLOBALS['wp_taxonomies'][ $taxonomy ]->family     = $family;
}

/**
 * Return all of the registered term families
 *
 * @since 0.1.0
 *
 * @return array
 */
function wp_get_term_families( $taxonomy = null ) {

	// Default return value (ugh)
	$retval = array( (object) array(
		'term_id' => 0,
		'name'    => esc_html__( 'None', 'wp-term-families' )
	) );

	// Get the taxonomy
	$tax = get_taxonomy( $taxonomy );

	// Bail if taxonomy has no family
	if ( empty( $tax->family ) ) {
		return $retval;
	}

	// Return terms
	if ( taxonomy_exists( $tax->family ) ) {

		// Get family terms
		$family_terms = get_terms( $tax->family, array(
			'hide_empty' => false,
			'get'        => 'all'
		) );

		// Set return value
		if ( ! empty( $family_terms ) ) {

			// Set return value
			$retval = $family_terms;

			// Add "None" value
			array_unshift( $retval, (object) array(
				'term_id' => 0,
				'name'    => esc_html__( 'None', 'wp-term-families' )
			) );
		}
	}

	return $retval;
}
