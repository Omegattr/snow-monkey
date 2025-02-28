<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

if ( ! is_customize_preview() ) {
	return;
}

$taxonomies = Helper::get_taxonomies();
if ( class_exists( '\woocommerce' ) ) {
	unset( $taxonomies['product_cat'] );
	unset( $taxonomies['product_tag'] );
}

if ( ! $taxonomies ) {
	return;
}

$terms = Helper::get_terms(
	array(
		'taxonomy'   => $taxonomies,
		'hide_empty' => false,
	)
);

foreach ( $terms as $_term ) {
	$taxonomy          = $_term->taxonomy;
	$taxonomy_object   = get_taxonomy( $taxonomy );
	$custom_post_types = ! empty( $taxonomy_object->object_type ) ? $taxonomy_object->object_type : array();

	Framework::control(
		'image',
		$_term->taxonomy . '-' . $_term->term_id . '-header-image',
		array(
			'label'       => __( 'Featured Image', 'snow-monkey' ),
			'description' => sprintf(
				// translators: %1$s: Custom post type label */
				__( 'This setting takes priority over featured image setting of %1$s archive page settings', 'snow-monkey' ),
				get_post_type_object( $custom_post_types[0] )->label
			),
			'priority'    => 100,
		)
	);
}

$panel = Framework::get_panel( 'design' );

foreach ( $taxonomies as $taxonomy ) {
	$terms = Helper::get_terms(
		array(
			'taxonomy'   => $taxonomy,
			'hide_empty' => false,
		)
	);

	foreach ( $terms as $_term ) {
		$section = Framework::get_section( 'design-' . $_term->taxonomy . '-' . $_term->term_id );
		$control = Framework::get_control( $_term->taxonomy . '-' . $_term->term_id . '-header-image' );
		$control->join( $section )->join( $panel );
	}
}
