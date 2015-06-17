<?php
/**
 * Template Name: Left Sidebar
 *
 * Default template utilized for single posts
 *
 * @since {%= base_version %}
 *
 * @package {%= class_name %}
 * @subpackage Templates
 */

?>
<?php get_header(); ?>

<div class="row">
    <div class="small-12 large-8 large-push-4 columns" role="main">

        <?php do_action( 'hatch_before_content' ); ?>

        <?php while ( have_posts() ) : the_post(); ?>
            <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                <header>
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>
                <?php do_action( 'hatch_page_before_entry_content' ); ?>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
                <footer>
                    <?php wp_link_pages( array( 'before' => '<nav id="page-nav"><p>' . __( 'Pages:', '{%= text_domain %}' ), 'after' => '</p></nav>' ) ); ?>
                    <p><?php the_tags(); ?></p>
                </footer>
                <?php do_action( 'hatch_page_before_comments' ); ?>
                <?php comments_template(); ?>
                <?php do_action( 'hatch_page_after_comments' ); ?>
            </article>
        <?php endwhile;?>

        <?php do_action( 'hatch_after_content' ); ?>

    </div>
    <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
