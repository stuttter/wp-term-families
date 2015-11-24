<?php

/**
 * Term Family Class
 *
 * @since 0.1.0
 *
 * @package TermFamily/Includes/Class
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'WP_Term_Family' ) ) :
/**
 * Main WP Term Family class
 *
 * @since 0.1.0
 */
final class WP_Term_Family extends WP_Term_Meta_UI {

	/**
	 * @var string Plugin version
	 */
	public $version = '0.1.1';

	/**
	 * @var string Database version
	 */
	public $db_version = 201511230003;

	/**
	 * @var string Database version
	 */
	public $db_version_key = 'wpdb_term_family_version';

	/**
	 * @var string Metadata key
	 */
	public $meta_key = 'family';

	/**
	 * Hook into queries, admin screens, and more!
	 *
	 * @since 0.1.0
	 */
	public function __construct( $file = '' ) {

		// Setup the labels
		$this->labels = array(
			'singular'    => esc_html__( 'Family',   'wp-term-families' ),
			'plural'      => esc_html__( 'Families', 'wp-term-families' ),
			'description' => esc_html__( 'The family is used to group terms together using another taxonomy.', 'wp-term-families' )
		);

		// Call the parent and pass the file
		parent::__construct( $file );
	}

	/** Assets ****************************************************************/

	/**
	 * Enqueue quick-edit JS
	 *
	 * @since 0.1.0
	 */
	public function enqueue_scripts() {

		// Quick-edit support
		wp_enqueue_script( 'wp-term-families', $this->url . 'assets/js/term-families.js', array( 'jquery' ), $this->db_version, true );

		// Styles
		wp_enqueue_style( 'wp-term-families', $this->url . 'assets/css/term-families.css', array(), $this->db_version );
	}

	/**
	 * Add help tabs for `family` column
	 *
	 * @since 0.1.0
	 */
	public function help_tabs() {
		get_current_screen()->add_help_tab(array(
			'id'      => 'wp_term_families_help_tab',
			'title'   => __( 'Term Family', 'wp-term-family' ),
			'content' => '<p>' . __( 'Set term family to group terms by another taxonomy.', 'wp-term-family' ) . '</p>',
		) );
	}

	/**
	 * Return family options for use in a dropdown
	 *
	 * @since 0.1.0
	 */
	protected function get_term_family_options( $term = '' ) {

		// Start an output buffer
		ob_start();

		// Get the meta value
		$value = isset( $term->term_id )
			?  $this->get_meta( $term->term_id )
			: '';

		$taxonomy = isset( $term->taxonomy )
			? $term->taxonomy
			: $GLOBALS['taxnow'];

		// Get term taxonomy families
		$options = wp_get_term_families( $taxonomy );

		// Loop through families and make them into option tags
		foreach ( $options as $option ) : ?>

			<option value="<?php echo esc_attr( $option->term_id ); ?>" <?php selected( $option->term_id, $value ); ?>>
				<?php echo esc_html( $option->name ); ?>
			</option>

		<?php endforeach;

		// Return the output buffer
		return ob_get_clean();
	}

	/** Markup ****************************************************************/

	/**
	 * Output the "term-family" form field when adding a new term
	 *
	 * @since 0.1.0
	 */
	public function form_field( $term = '' ) {
		?>

		<select name="term-family" id="term-family">
			<?php echo $this->get_term_family_options( $term ); ?>
		</select>

		<?php
	}

	/**
	 * Output the "term-family" quick-edit field
	 *
	 * @since 0.1.0
	 */
	public function quick_edit_form_field() {
		?>

		<select name="term-family">
			<?php echo $this->get_term_family_options(); ?>
		</select>

		<?php
	}

	/**
	 * Return the formatted output for the colomn row
	 *
	 * @since 0.1.0
	 *
	 * @param string $meta
	 */
	protected function format_output( $meta = '' ) {

		// Get current taxonomy
		$taxonomy = isset( $_REQUEST['taxonomy'] )
			? $_REQUEST['taxonomy']
			: $GLOBALS['taxnow'];

		$tax = get_taxonomy( $taxonomy );

		// Bail if no taxonomy family
		if ( empty( $tax->family ) ) {
			return $this->no_value;
		}

		// Look for family
		if ( ! empty( $meta ) ) {
			$family = get_term( $meta, $tax->family );
		}

		// Value?
		$retval = isset( $family )
			? $family->name
			: $this->no_value;

		// ID?
		$id = isset( $family )
			? $family->term_id
			: 0;

		// Return
		return '<span class="term-family" data-family="' . esc_html( $id ) . '">' . esc_html( $retval ) . '</span>';
	}
}
endif;
