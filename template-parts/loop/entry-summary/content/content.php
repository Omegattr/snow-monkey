<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 */

use Framework\Helper;

$_post_type     = get_post_type();
$entries_layout = get_theme_mod( $_post_type . '-entries-layout' );

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_entries_layout' => $entries_layout,
		'_excerpt_length' => null,
	]
);

/**
 * Callback for excerpt_length
 *
 * @global array $args The template part args.
 * @param int $number The maximum number of words. Default 55.
 * @return int
 */
$entry_summary_content_excerpt_length = function( $number = null ) use ( $args ) {
	if ( null !== $args['_excerpt_length'] ) {
		return $args['_excerpt_length'];
	}

	if ( is_null( $number ) ) {
		// phpcs:disable WordPress.WP.I18n.MissingArgDomain
		$number = _x( '55', 'excerpt_length' );
		// phpcs:enable
	}

	if ( 'rich-media' === $args['_entries_layout'] ) {
		$num_words            = 25;
		$excerpt_length_ratio = 55 / $number;
		return $num_words / $excerpt_length_ratio;
	}

	return $number;
};

add_filter( 'excerpt_length', $entry_summary_content_excerpt_length, 100 );
ob_start();
the_excerpt();
$content = wp_strip_all_tags( ob_get_clean() );
remove_filter( 'excerpt_length', $entry_summary_content_excerpt_length, 100 );

if ( ! $content ) {
	return;
}
?>

<div class="c-entry-summary__content">
	<?php echo esc_html( $content ); ?>
</div>
