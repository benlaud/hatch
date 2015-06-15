<?php
/**
 * Navigation
 *
 * This template handles our main navigation markup
 *
 * @since 1.0
 *
 * @package {%= class_name %}
 * @subpackage Partials
 */

?>
<?php
$options = get_option( '{%= js_safe_name %}_theme_options' );

if ( isset( $options['logo_upload'] ) ) {
	$logo = true;
}
?>
<nav class="tab-bar show-for-small-only">
	<section class="right-small">
		<a class="right-off-canvas-toggle menu-icon" ><span></span></a>
	</section>

	<section class="middle tab-bar-section">
	    <a href="<?php esc_attr_e( home_url() ); ?>">
	    	<?php if ( ! empty( $logo ) ) : ?>
	    		<img src="<?php esc_attr_e( $options['logo_upload'] ); ?>" alt="<?php esc_attr_e( bloginfo( 'name' ) ); ?>" />
	    	<?php else : ?>
	    		<?php bloginfo( 'name' ); ?>
	    	<?php endif; ?>
	    </a>
	</section>
</nav>

<aside class="right-off-canvas-menu">
	<?php
	    wp_nav_menu( array(
	        'container' => false,
	        'container_class' => '',
	        'menu' => '',
	        'menu_class' => 'off-canvas-list',
	        'theme_location' => 'mobile-off-canvas',
	        'before' => '',
	        'after' => '',
	        'link_before' => '',
	        'link_after' => '',
	        'depth' => 5,
	        'fallback_cb' => false,
	        'walker' => new Foundation_Walker_Nav_Menu(), // Use Custom Foundation Walker.
	    ) );
	?>
</aside>

<div id="main-menu" class="top-bar-container" data-parent="<?php esc_attr_e( $post->post_type ); ?>">
    <nav class="top-bar" data-topbar="">
        <ul class="title-area">
            <li class="name">
                <a href="<?php esc_attr_e( home_url() ); ?>">
                	<?php if ( ! empty( $logo ) ) : ?>
                		<img src="<?php esc_attr_e( $options['logo_upload'] ); ?>" alt="<?php esc_attr_e( get_bloginfo( 'name' ) ); ?>" />
                	<?php else : ?>
                		<?php bloginfo( 'name' ); ?>
                	<?php endif; ?>
                </a>
            </li>
        </ul>

        <section class="top-bar-section show-for-medium-up">
            <?php
            wp_nav_menu( array(
                'container' => false,
                'container_class' => '',
                'menu' => '',
                'menu_class' => 'top-bar-menu right',
                'theme_location' => 'top-bar',
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'depth' => 5,
                'fallback_cb' => false,
                'walker' => new Foundation_Walker_Nav_Menu(),
            ));
            ?>
        </section>

        <section class="mobile-navigation show-for-small-down">
            <?php
            wp_nav_menu(array(
                'container' => false,
                'container_class' => '',
                'menu' => '',
                'menu_class' => 'footer-menu',
                'theme_location' => 'footer',
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'depth' => 5,
                'fallback_cb' => false,
                'walker' => new Foundation_Walker_Nav_Menu()
            ));
            ?>
        </section>
    </nav>
</div>