<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'textarea',
	'mwt-google-matched-content',
	array(
		'label'             => __( 'Google Adsense Matched Content', 'snow-monkey' ),
		'description'       => __( 'When pasting the code of the matched content, related posts are replaced with advertisements.', 'snow-monkey' ) . __( 'Paste only the ins tag.', 'snow-monkey' ),
		'type'              => 'option',
		'priority'          => 130,
		'sanitize_callback' => function( $value ) {
			$value = preg_replace( '@<script>[^<]*<\/script>@s', '', $value );
			$value = strip_tags( $value, '<ins>' );
			return $value;
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'advertisement' );
$control = Framework::get_control( 'mwt-google-matched-content' );
$control->join( $section );
