<?php
/**
 * User: aware
 * Date: 10/7/14
 * Time: 4:29 PM
 */
?>
<div id="main-menu" class="top-bar-container" data-parent="<?php echo $post->post_type ?>">
    <nav class="top-bar" data-topbar="">
        <ul class="title-area">
            <li class="name">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/linchpin-icon-white.svg'; ?>"
                         alt="Linchpin"/><img class="small" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/linchpin-logo-black.svg'; ?>"
                                                               alt="<?php echo bloginfo('description'); ?>"/>
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