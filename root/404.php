<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package launchpad
 */

get_header(); ?>

<div id="primary" class="content-area">
	<div class="row">
		<main id="main" class="site-main small-12 large-8 columns" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'launchpad' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'launchpad' ); ?></p>

					<?php get_search_form(); ?>

					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

					<?php if ( launchpad_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
					<div class="widget widget_categories">
						<h2 class="widget-title"><?php _e( 'Most Used Categories', 'launchpad' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div><!-- .widget -->
					<?php endif; ?>

					<div class="entry-content">
						<div class="error">
							<p class="bottom"><?php _e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'FoundationPress'); ?></p>
						</div>
						<p><?php _e('Please try the following:', 'FoundationPress'); ?></p>
						<ul>
							<li><?php _e('Check your spelling', 'FoundationPress'); ?></li>
							<li><?php printf(__('Return to the <a href="%s">home page</a>', 'FoundationPress'), home_url()); ?></li>
							<li><?php _e('Click the <a href="javascript:history.back()">Back</a> button', 'FoundationPress'); ?></li>
						</ul>
					</div>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<?php get_footer(); ?>
