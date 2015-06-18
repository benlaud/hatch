<?php
/**
 * Default Page Template
 *
 * Default template utilized for pages
 *
 * @since {%= base_version %}
 *
 * @package {%= class_name %}
 * @subpackage Templates
 */

?>

<?php get_header(); ?>

	<div class="row">

		<div class="small-12 large-8 columns" role="main">

			<?php do_action( 'hatch_content_before' ); ?>

			<?php if ( have_posts() ) : ?>

				<?php do_action( 'hatch_loop_before' ); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

				<?php endwhile; ?>

				<?php do_action( 'hatch_loop_after' ); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

			<?php do_action( 'hatch_content_after' ); ?>

			<?php

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif; ?>

		</div>

		<?php get_sidebar(); ?>

	</div>
<?php get_footer();
