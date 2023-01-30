<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Color;
use Inc2734\WP_Customizer_Framework\Style;

$get_container_margin_var = function( $container_margin ) {
	if ( preg_match( '|^\d+(\.\d+)?$|', $container_margin ) ) {
		return $container_margin . 'rem';
	} elseif ( 's' === $container_margin ) {
		return 'var(--_s-1)';
	} elseif ( 'm' === $container_margin ) {
		return 'var(--_s1)';
	} elseif ( 'l' === $container_margin ) {
		return 'var(--_s2)';
	}
};

$get_margin_scale_var = function( $margin_scale ) {
	if ( preg_match( '|^\d+(\.\d+)?$|', $margin_scale ) ) {
		return $margin_scale;
	} elseif ( 'l' === $margin_scale ) {
		return 1.5;
	}
};

$root_variables_app   = array();
$root_variables_theme = array();

// Colors set in theme.json are output to body, so colors are not reflected even if specified with :root.
$body_variables_app   = array();
$body_variables_theme = array();

$root_variables_app_media_min_md = array();

$container_margin_sm = $get_container_margin_var( get_theme_mod( 'sm-container-margin' ) );
if ( $container_margin_sm ) {
	$root_variables_app[] = '--_container-margin: ' . $container_margin_sm;
}
$container_margin = $get_container_margin_var( get_theme_mod( 'lg-container-margin' ) );
if ( $container_margin ) {
	$root_variables_app_media_min_md[] = '--_container-margin: ' . $container_margin;
}

$container_max_width = get_theme_mod( 'container-max-width' );
if ( $container_max_width ) {
	$root_variables_app[] = '--_container-max-width: ' . $container_max_width . 'px';
}

$margin_scale = $get_margin_scale_var( get_theme_mod( 'margin-scale' ) );
if ( $margin_scale ) {
	$root_variables_app[] = '--_margin-scale: ' . $margin_scale;
}

$space_unitless = get_theme_mod( 'space' );
$space          = $get_container_margin_var( $space_unitless );
if ( $space ) {
	$root_variables_app[] = '--_space: ' . $space;
	$root_variables_app[] = '--_space-unitless: ' . $space_unitless;
}

// @deprecated
$accent_color = get_theme_mod( 'accent-color' );
if ( $accent_color ) {
	$root_variables_app[] = '--accent-color: ' . $accent_color;
	$root_variables_app[] = '--wp--preset--color--accent-color: var(--accent-color)';
	$root_variables_app[] = '--dark-accent-color: ' . Color::dark( $accent_color );
	$root_variables_app[] = '--light-accent-color: ' . Color::light( $accent_color );
	$root_variables_app[] = '--lighter-accent-color: ' . Color::lighter( $accent_color );
	$root_variables_app[] = '--lightest-accent-color: ' . Color::lightest( $accent_color );
}

// @deprecated
$sub_accent_color = get_theme_mod( 'sub-accent-color' );
if ( $accent_color ) {
	$root_variables_app[] = '--sub-accent-color: ' . $sub_accent_color;
	$root_variables_app[] = '--wp--preset--color--sub-accent-color: var(--sub-accent-color)';
	$root_variables_app[] = '--dark-sub-accent-color: ' . Color::dark( $sub_accent_color );
	$root_variables_app[] = '--light-sub-accent-color: ' . Color::light( $sub_accent_color );
	$root_variables_app[] = '--lighter-sub-accent-color: ' . Color::lighter( $sub_accent_color );
	$root_variables_app[] = '--lightest-sub-accent-color: ' . Color::lightest( $sub_accent_color );
}

$header_text_color = get_theme_mod( 'header-text-color' );
if ( $header_text_color ) {
	$root_variables_app[] = '--header-text-color: ' . $header_text_color;
	$root_variables_app[] = '--overlay-header-text-color: ' . $header_text_color;
	$root_variables_app[] = '--drop-nav-text-color: ' . $header_text_color;
}

$base_line_height = get_theme_mod( 'base-line-height' );
if ( $base_line_height ) {
	$root_variables_app[] = '--_half-leading: ' . ( $base_line_height - 1 ) / 2;
}

$base_font = get_theme_mod( 'base-font' );
if ( 'noto-sans-jp' === $base_font ) {
	add_action( 'wp_enqueue_scripts', array( '\Inc2734\WP_Google_Fonts\Helper', 'enqueue_noto_sans_jp' ), 5 );
	add_action( 'enqueue_block_editor_assets', array( '\Inc2734\WP_Google_Fonts\Helper', 'enqueue_noto_sans_jp' ) );
} elseif ( 'noto-serif-jp' === $base_font ) {
	add_action( 'wp_enqueue_scripts', array( '\Inc2734\WP_Google_Fonts\Helper', 'enqueue_noto_serif_jp' ), 5 );
	add_action( 'enqueue_block_editor_assets', array( '\Inc2734\WP_Google_Fonts\Helper', 'enqueue_noto_serif_jp' ) );
} elseif ( 'm-plus-1p' === $base_font ) {
	add_action( 'wp_enqueue_scripts', array( '\Inc2734\WP_Google_Fonts\Helper', 'enqueue_m_plus_1p' ), 5 );
	add_action( 'enqueue_block_editor_assets', array( '\Inc2734\WP_Google_Fonts\Helper', 'enqueue_m_plus_1p' ) );
} elseif ( 'm-plus-rounded-1c' === $base_font ) {
	add_action( 'wp_enqueue_scripts', array( '\Inc2734\WP_Google_Fonts\Helper', 'enqueue_m_plus_rounded_1c' ), 5 );
	add_action( 'enqueue_block_editor_assets', array( '\Inc2734\WP_Google_Fonts\Helper', 'enqueue_m_plus_rounded_1c' ) );
} elseif ( 'biz-udpgothic' === $base_font ) {
	add_action( 'wp_enqueue_scripts', array( '\Inc2734\WP_Google_Fonts\Helper', 'enqueue_biz_udpgothic' ), 5 );
	add_action( 'enqueue_block_editor_assets', array( '\Inc2734\WP_Google_Fonts\Helper', 'enqueue_biz_udpgothic' ) );
} elseif ( 'biz-udpmincho' === $base_font ) {
	add_action( 'wp_enqueue_scripts', array( '\Inc2734\WP_Google_Fonts\Helper', 'enqueue_biz_udpmincho' ), 5 );
	add_action( 'enqueue_block_editor_assets', array( '\Inc2734\WP_Google_Fonts\Helper', 'enqueue_biz_udpmincho' ) );
}
$font_family          = Helper::get_font_family();
$root_variables_app[] = '--font-family: ' . $font_family; // @deprecated
$root_variables_app[] = '--_global--font-family: var(--font-family)';

$base_font_size       = get_theme_mod( 'base-font-size' );
$root_variables_app[] = '--_global--font-size-px: ' . $base_font_size . 'px';

$styles_core = array();

if ( $root_variables_app ) {
	$styles_core[] = array(
		'selectors'  => array( ':root' ),
		'properties' => $root_variables_app,
	);
}

if ( $root_variables_app_media_min_md ) {
	$styles_core[] = array(
		'selectors'   => array( ':root' ),
		'properties'  => $root_variables_app_media_min_md,
		'media_query' => '@media (min-width: 640px)', // Optional
	);
}

$styles_core[] = array(
	'selectors'  => array( 'html' ),
	'properties' => array(
		'letter-spacing: ' . get_theme_mod( 'base-letter-spacing' ) . 'rem',
	),
);

Style::attach(
	Helper::get_main_style_handle() . '-app',
	$styles_core
);

$h2_style = get_theme_mod( 'h2-style' );
if ( $h2_style ) {
	if ( 'standard' === $h2_style ) {
		$body_variables_theme[] = '--entry-content-h2-border-left: 1px solid var(--wp--preset--color--sm-accent)';
		$root_variables_theme[] = '--entry-content-h2-background-color: #f7f7f7';
		$root_variables_theme[] = '--entry-content-h2-padding: calc(var(--_space) * 0.25) calc(var(--_space) * 0.25) calc(var(--_space) * 0.25) calc(var(--_space) * 0.5)';
	}
}

$h3_style = get_theme_mod( 'h3-style' );
if ( $h3_style ) {
	if ( 'standard' === $h3_style ) {
		$root_variables_theme[] = '--entry-content-h3-border-bottom: 1px solid #eee';
		$root_variables_theme[] = '--entry-content-h3-padding: 0 0 calc(var(--_space) * 0.25)';
	}
}

$widget_title_style = get_theme_mod( 'widget-title-style' );
if ( $widget_title_style ) {
	if ( 'standard' === $widget_title_style ) {
		$root_variables_theme[] = '--widget-title-display: flex';
		$root_variables_theme[] = '--widget-title-flex-direction: row';
		$root_variables_theme[] = '--widget-title-align-items: center';
		$root_variables_theme[] = '--widget-title-justify-content: center';
		$root_variables_theme[] = '--widget-title-pseudo-display: block';
		$root_variables_theme[] = '--widget-title-pseudo-content: ""';
		$root_variables_theme[] = '--widget-title-pseudo-height: 1px';
		$root_variables_theme[] = '--widget-title-pseudo-background-color: #111';
		$root_variables_theme[] = '--widget-title-pseudo-flex: 1 0 0%';
		$root_variables_theme[] = '--widget-title-pseudo-min-width: 20px';
		$root_variables_theme[] = '--widget-title-before-margin-right: .5em';
		$root_variables_theme[] = '--widget-title-after-margin-left: .5em';
	}
}

$styles_theme = array();

if ( $root_variables_theme ) {
	$styles_theme[] = array(
		'selectors'  => array( ':root' ),
		'properties' => $root_variables_theme,
	);
	$styles_theme[] = array(
		'selectors'  => array( 'body' ),
		'properties' => $body_variables_theme,
	);
}

Style::attach(
	Helper::get_main_style_handle() . '-theme',
	$styles_theme
);
