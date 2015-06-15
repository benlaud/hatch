<?php
/**
 * Template Name: Full Width
 *
 * Default template utilized for single posts
 *
 * @since 1.0
 *
 * @package {%= class_name %}
 * @subpackage Templates
 */

?>

<?php get_header(); ?>

<div class="row">
	<div class="small-12 large-12 columns" role="main">

	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
			<footer>
				<?php wp_link_pages( array( 'before' => '<nav id="page-nav"><p>' . __( 'Pages:', '{%= text_domain %}' ), 'after' => '</p></nav>' ) ); ?>
				<p><?php the_tags(); ?></p>
			</footer>
			<?php do_action( 'hatch_post_before_comments' ); ?>
			<?php comments_template(); ?>
			<?php do_action( 'hatch_post_after_comments' ); ?>
		</article>
	<?php endwhile; ?>
	</div>
</div>

<?php get_footer(); ?>
