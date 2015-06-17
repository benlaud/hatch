<?php
/**
 * 404 Template
 *
 * Basic template when a 404 happens.
 *
 * @since 1.0
 *
 * @package {%= class_name %}
 * @subpackage Templates
 */

?>

<?php get_header(); ?>

<div id="primary" class="content-area">
	<div class="row">
		<main id="main" class="site-main small-12 large-8 columns" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page cannot be found.', '{%= text_domain %}' ); ?></h1>
				</header>

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', '{%= text_domain %}' ); ?></p>

					<?php get_search_form(); ?>

					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

					<?php if ( hatch_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
						<div class="widget widget_categories">
							<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', '{%= text_domain %}' ); ?></h2>
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
						</div>
					<?php endif; ?>

					<div class="entry-content">
						<div class="error">
							<p class="bottom"><?php esc_html_e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', '{%= text_domain %}' ); ?></p>
						</div>
						<p><?php esc_html_e( 'Please try the following:', '{%= text_domain %}' ); ?></p>
						<ul>
							<li><?php esc_html_e( 'Check your spelling', '{%= text_domain %}' ); ?></li>
							<li><?php printf( wp_kses( __( 'Return to the <a href="%s">home page</a>', '{%= text_domain %}' ), array( 'a' => array( 'href' ) ) ), home_url() ); ?></li>
							<li><?php echo wp_kses( 'Click the <a href="javascript:history.back()">Back</a> button', '{%= text_domain %}' ); ?></li>
						</ul>
					</div>
				</div>
			</section>
		</main>
	</div>
</div>
<?php get_footer(); ?>
