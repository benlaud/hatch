<?php
/**
 * Sidebar Template
 *
 * Based sidebar template
 *
 * @since 1.0
 * @package {%= class_name %}
 * @subpackage Sidebars
 */

?>
<aside id="sidebar" class="small-12 large-4 columns">
	<?php do_action( 'hatch_before_sidebar' ); ?>
	<?php dynamic_sidebar( 'page-widgets' ); ?>
	<?php do_action( 'hatch_after_sidebar' ); ?>
</aside>