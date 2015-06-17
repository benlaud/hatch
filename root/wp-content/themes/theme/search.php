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

		<?php do_action( 'hatch_before_content' ); ?>

		<h2><?php esc_html_e( 'Search Results for', '{%= text_domain %}' ); ?> "<?php esc_html_e( get_search_query() ); ?>"</h2>

        <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'content', get_post_format() ); ?>
            <?php endwhile; ?>

        <?php else : ?>

            <?php get_template_part( 'content', 'none' ); ?>

        <?php endif;?>

        <?php do_action( 'hatch_before_pagination' ); ?>

        <?php get_template_part( 'includes/partials/pagination' ); ?>

        <?php do_action( 'hatch_after_content' ); ?>

	</div>

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
