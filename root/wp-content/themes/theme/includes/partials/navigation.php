<?php
/**
 * User: aware
 * Date: 10/7/14
 * Time: 4:29 PM
 */

	$options = get_option('{%= js_safe_name %}_theme_options');

	if ( isset( $options['logo_upload'] ) )
		$logo = true;
?>

<nav class="tab-bar show-for-small-only">
	<section class="right-small">
		<a class="right-off-canvas-toggle menu-icon" ><span></span></a>
	</section>

	<section class="middle tab-bar-section">
	    <a href="<?php echo home_url(); ?>">
	    	<?php if ( $logo ): ?>
	    		<img src="<?php echo $options['logo_upload']; ?>" alt="<?php bloginfo( 'name' ); ?>" />
	    	<?php else: ?>
	    		<?php bloginfo( 'name' ); ?>
	    	<?php endif; ?>
	    </a>
	</section>
</nav>

<aside class="right-off-canvas-menu">
	<?php //hatch_mobile_off_canvas(); ?>
	<?php
	    wp_nav_menu(array(
	        'container' => false,                           // remove nav container
	        'container_class' => '',                        // class of container
	        'menu' => '',                                   // menu name
	        'menu_class' => 'off-canvas-list',              // adding custom nav class
	        'theme_location' => 'mobile-off-canvas',        // where it's located in the theme
	        'before' => '',                                 // before each link <a>
	        'after' => '',                                  // after each link </a>
	        'link_before' => '',                            // before each link text
	        'link_after' => '',                             // after each link text
	        'depth' => 5,                                   // limit the depth of the nav
	        'fallback_cb' => false,                         // fallback function (see below)
	        'walker' => new Foundation_Walker_Nav_Menu()
	    ));
	?>
</aside>

<div id="main-menu" class="top-bar-container" data-parent="<?php echo $post->post_type ?>">
    <nav class="top-bar" data-topbar="">
        <ul class="title-area">
            <li class="name">
                <a href="<?php echo home_url(); ?>">
                	<?php if ( $logo ): ?>
                		<img src="<?php echo $options['logo_upload']; ?>" alt="<?php bloginfo( 'name' ); ?>" />
                	<?php else: ?>
                		<?php bloginfo( 'name' ); ?>
                	<?php endif; ?>
                </a>
            </li>
        </ul>

        <section class="top-bar-section show-for-medium-up">
            <?php
            wp_nav_menu(array(
                'container' => false,                           // remove nav container
                'container_class' => '',                        // class of container
                'menu' => '',                                   // menu name
                'menu_class' => 'top-bar-menu right',           // adding custom nav class
                'theme_location' => 'top-bar',                  // where it's located in the theme
                'before' => '',                                 // before each link <a>
                'after' => '',                                  // after each link </a>
                'link_before' => '',                            // before each link text
                'link_after' => '',                             // after each link text
                'depth' => 5,                                   // limit the depth of the nav
                'fallback_cb' => false,                         // fallback function (see below)
                'walker' => new Foundation_Walker_Nav_Menu()
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