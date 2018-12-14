<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;

/**
 * Enqueue main style
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		$relative_path = '/assets/css/style.min.css';
		$src  = get_theme_file_uri( $relative_path );
		$path = get_theme_file_path( $relative_path );

		if ( ! file_exists( $path ) ) {
			return;
		}

		$dependencies = [];
		$maybe_dependencies = [
			'wp-block-library',
			'wp-share-buttons',
			'wp-like-me-box',
			'wp-oembed-blog-card',
			'wp-pure-css-gallery',
			'wp-awesome-widgets',
		];
		foreach ( $maybe_dependencies as $dependency ) {
			if ( ! wp_style_is( $dependency, 'enqueued' ) && ! wp_style_is( $dependency, 'registered' ) ) {
				continue;
			}
			$dependencies[] = $dependency;
		}

		wp_enqueue_style(
			Helper\get_main_style_handle(),
			$src,
			$dependencies,
			filemtime( $path )
		);
	},
	11
);

/**
 * Enqueue main script
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		$relative_path = '/assets/js/app.min.js';
		$src  = get_theme_file_uri( $relative_path );
		$path = get_theme_file_path( $relative_path );

		if ( ! file_exists( $path ) ) {
			return;
		}

		$dependencies = [];
		$maybe_dependencies = [
			'jquery',
			'wp-awesome-widgets',
		];
		foreach ( $maybe_dependencies as $dependency ) {
			if ( ! wp_script_is( $dependency, 'enqueued' ) && ! wp_script_is( $dependency, 'registered' ) ) {
				continue;
			}
			$dependencies[] = $dependency;
		}

		wp_enqueue_script(
			Helper\get_main_script_handle(),
			$src,
			$dependencies,
			filemtime( $path ),
			true
		);
	}
);

/**
 * Enqueue script for header position
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		$header_position_only_mobile = get_theme_mod( 'header-position-only-mobile' );
		$header_position_only_mobile = ( $header_position_only_mobile ) ? 'true' : 'false';
		$data = 'var snow_monkey_header_position_only_mobile = ' . $header_position_only_mobile;
		wp_add_inline_script( Helper\get_main_script_handle(), $data, 'before' );
	}
);

/**
 * Enqueue script for global navigation
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_localize_script(
			Helper\get_main_script_handle(),
			'snow_monkey',
			[
				'home_url' => home_url(),
			]
		);
	}
);

/**
 * Enqueue FontAwesome
 *
 * @return void
 */
foreach ( [ 'wp_enqueue_scripts', 'admin_enqueue_scripts' ] as $action_hook ) {
	add_action(
		$action_hook,
		function() {
			$relative_path = '/assets/packages/fontawesome-free/js/all.min.js';
			wp_enqueue_script(
				'fontawesome5',
				get_theme_file_uri( $relative_path ),
				[],
				filemtime( get_theme_file_path( $relative_path ) ),
				true
			);
		}
	);
}

/**
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
);

/**
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_enqueue_script(
			'jquery.easing',
			'https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js',
			[ 'jquery' ],
			1.3,
			true
		);
	}
);

/**
 * Enqueue script for customize preview
 *
 * @return void
 */
add_action(
	'customize_preview_init',
	function() {
		$relative_path = '/assets/js/customize-preview.js';
		$src  = get_theme_file_uri( $relative_path );
		$path = get_theme_file_path( $relative_path );

		if ( ! file_exists( $path ) ) {
			return;
		}

		wp_enqueue_script(
			Helper\get_main_script_handle() . '-customize-preview',
			$src,
			[ 'jquery', 'customize-preview', Helper\get_main_script_handle() ],
			filemtime( $path ),
			true
		);
	}
);
