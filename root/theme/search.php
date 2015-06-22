<?php
/**
 * Search Results Template
 *
 * @since {%= base_version %}
 *
 * @package {%= class_name %}
 * @subpackage Search
 */

?>
<?php get_header(); ?>

	<div class="row">
	<div class="small-12 large-8 columns" role="main">

		<h2><?php esc_html_e( 'Search Results for', '{%= text_domain %}' ); ?>
			"<?php esc_html_e( get_search_query() ); ?>"</h2>

		<?php
		/** This action is documented in includes/Linchpin/hatch-hooks.php */
		do_action( 'hatch_content_before' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php
			/** This action is documented in includes/Linchpin/hatch-hooks.php */
			do_action( 'hatch_loop_before' ); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>

			<?php
			/** This action is documented in includes/Linchpin/hatch-hooks.php */
			do_action( 'hatch_loop_after' ); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		<?php
		/** This action is documented in includes/Linchpin/hatch-hooks.php */
		do_action( 'hatch_content_after' ); ?>

		<?php get_template_part( 'includes/partials/pagination' ); ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer();
