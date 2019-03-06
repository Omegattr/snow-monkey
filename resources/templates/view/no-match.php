<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<div class="c-entry">
	<div class="c-entry__body">
		<div class="c-entry__content p-entry-content">
			<p>
				<?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'snow-monkey' ); ?>
			</p>

			<?php get_template_part( 'template-parts/common/search-form', 'no-match' ); ?>
		</div>
	</div>
</div>
