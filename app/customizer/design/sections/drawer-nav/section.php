<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'drawer-nav',
	array(
		'title'    => __( 'Drawer navigation', 'snow-monkey' ),
		'priority' => 125,
	)
);
