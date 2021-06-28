<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Style;

if ( ! Helper::is_ie() ) {
	return;
}

$styles = [];

$accent_color = get_theme_mod( 'accent-color' );
if ( $accent_color ) {
	$styles[] = [
		'selectors'  => [ '.smb-step__item__link' ],
		'properties' => [ 'color: ' . $accent_color ],
	];

	Style::attach(
		Helper::get_main_style_handle() . '-snow-monkey-blocks',
		$styles
	);
}

Style::extend( 'entry-content', [ '.smb-step__item__summary' ] );
