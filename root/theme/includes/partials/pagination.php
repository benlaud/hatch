<?php
/**
 * Pagination Partial
 *
 * Display navigation to next/previous pages when applicable.
 *
 * @since {%= base_version %}
 *
 * @package {%= class_name %}
 * @subpackage Partials
 */

?>

<?php do_action( 'hatch_pagination_before' ); ?>

<?php if ( function_exists( 'hatch_pagination' ) ) :
	hatch_pagination( '&laquo;', '&raquo;' );
elseif ( is_paged() ) : ?>
	<nav id="post-nav">
		<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', '{%= text_domain %}' ) ); ?></div>
		<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', '{%= text_domain %}' ) ); ?></div>
	</nav>
<?php endif; ?>

<?php do_action( 'hatch_pagination_after' );
