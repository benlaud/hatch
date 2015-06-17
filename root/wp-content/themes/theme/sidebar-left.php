<?php
/**
 * Left Sidebar Template
 *
 * Template used when the sidebar is shown on the left
 *
 * @since {%= base_version %}
 *
 * @package {%= class_name %}
 * @subpackage Sidebars
 */

?>
<aside id="sidebar" class="small-12 large-4 columns large-pull-8">
	<?php do_action( 'hatch_before_sidebar' ); ?>
	<?php dynamic_sidebar( 'sidebar-widgets' ); ?>
	<?php do_action( 'hatch_after_sidebar' ); ?>
</aside>
