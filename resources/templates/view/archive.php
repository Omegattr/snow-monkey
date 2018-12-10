<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Snow_Monkey\app\Helper;
?>
<div class="c-entry">
	<header class="c-entry__header">
		<h1 class="c-entry__title"><?php echo esc_html( Helper::get_page_title_from_breadcrumbs() ); ?></h1>
	</header>

	<div class="c-entry__body">
		<div class="c-entry__content p-entry-content">
			<div class="p-archive">
				<ul class="c-entries c-entries--<?php echo esc_attr( get_theme_mod( 'archive-layout' ) ); ?>">
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<li class="c-entries__item">
							<?php Helper::get_template_part( 'template-parts/loop/entry-summary', get_post_type() ); ?>
						</li>
					<?php endwhile; ?>
				</ul>
			</div>
		</div>

		<?php Helper::get_template_part( 'template-parts/archive/pagination' ); ?>
	</div>
</div>
