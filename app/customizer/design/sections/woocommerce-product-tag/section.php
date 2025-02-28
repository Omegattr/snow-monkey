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

$terms = Helper::get_terms(
	array(
		'taxonomy'   => 'product_tag',
		'hide_empty' => false,
	)
);

foreach ( $terms as $_term ) {
	Framework::section(
		'design-' . $_term->taxonomy . '-' . $_term->term_id,
		array(
			'title'           => sprintf(
				/* translators: 1: Tag name */
				__( '[ %1$s ] WooCommerce products tag settings', 'snow-monkey' ),
				$_term->name
			),
			'priority'        => 131,
			'active_callback' => function() use ( $_term ) {
				if ( ! class_exists( '\woocommerce' ) ) {
					return false;
				}
				return is_product_tag( $_term->name );
			},
		)
	);
}
