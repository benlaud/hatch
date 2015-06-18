<?php
/**
 * Editing
 *
 * Partial file used for all post/page editing controls on the frontend
 *
 * @since {%= base_version %}
 *
 * @package {%= class_name %}
 * @subpackage Partials
 * */

?>

<ul class="button-group utility right">
	<?php edit_post_link( __( 'Edit Content', '{%= text_domain %}' ) , '<li class="tiny button">', '</li>' ); ?>
</ul>
