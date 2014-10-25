<?php

/**
 * FoundationUtilities class.
 */
class FoundationUtilities {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {
		include_once('Foundation_Walker_Nav_Menu.php');
	}

	/**
	 * paginate_links function.
	 *
	 * TODO: Should probably convert the options to an array to add more flexiblity to the formatting @aware
	 *
	 *
	 * @access public
	 * @param string $prev_text (default: '&laquo')
	 * @param string $next (default: '&raquo')
	 * @return void
	 */

	static function paginate_links($prev_text = '&laquo;' , $next_text = '&raquo;' ) {

    	global $wp_query;

		$big = 999999999; // need an unlikely integer
		$pagination = '';
		$current = max( 1, get_query_var('paged') );

		$pages = paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => $current,
            'total' => $wp_query->max_num_pages,
            'prev_next' => false,
            'type'  => 'array',
            'prev_next'  => true,
			'prev_text'    => __( $prev_text ),
			'next_text'    => __( $next_text ),
        ) );

        if( is_array( $pages ) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');

            $pagination 	.= '<ul class="pagination">';

            $start_page = ( 1 === $current )? 1 : 0; // need to offset if using prev_text / next_text
            $page_count  = $start_page;

            foreach ( $pages as $page ) {
            	$pagination .=  "<li" . ( ($page_count == $paged)? ' class="current"' : '' ) . ">$page</li>";
            	$page_count++;
            }

			$pagination 	.=  '</ul>';
        }

		return $pagination;
	}

    /**
     * function menu_fallback
     * @return string
     */
	function menu_fallback() {

		$html = '<div class="alert-box secondary">';

			// Translators 1: Link to Menus,
			// 			   2: Link to Customize

	  		$html .= sprintf( __( 'Please assign a menu to the primary menu location under %1$s or %2$s the design.', 'hatch' ),

	  		sprintf(  __( '<a href="%s">Menus</a>', 'hatch' ),
	  			get_admin_url( get_current_blog_id(), 'nav-menus.php' )
	  		),
	  		sprintf(  __( '<a href="%s">Customize</a>', 'hatch' ),
	  			get_admin_url( get_current_blog_id(), 'customize.php' )
	  		)
	  	);
	  	$html .= '</div>';

	  	return $html;
  	}
}

/**
 *	Some backwards compatibility
 */

/**
 * FoundationPress_menu_fallback function.
 * A fallback when no navigation is selected by default.
 *
 * @access public
 * @return void
 */
function hatch_menu_fallback() {
	global $foundation_utilities;

	echo $foundation_utilities->menu_fallback();
}

/**
 * hatch_pagination function.
 *
 * @access public
 * @param mixed $prev_text
 * @param mixed $next_text
 * @return void
 */
function hatch_pagination($prev_text, $next_text) {
	echo FoundationUtilities::paginate_links($prev_text, $next_text);
}

/**
 * hatch_entry_meta function.
 *
 * @access public
 * @return void
 */
function hatch_entry_meta() {
    echo '<time class="updated" datetime="'. get_the_time('c') .'" pubdate>'. sprintf(__('Posted on %s at %s.', 'hatch'), get_the_time('l, F jS, Y'), get_the_time()) .'</time>';
    echo '<p class="byline author">'. __('Written by', 'hatch') .' <a href="'. get_author_posts_url(get_the_author_meta('ID')) .'" rel="author" class="fn">'. get_the_author() .'</a></p>';
}

/**
 * Left top bar
 * http://codex.wordpress.org/Function_Reference/wp_nav_menu
 */
function hatch_top_bar_l() {
    wp_nav_menu(array(
        'container' => false,                           // remove nav container
        'container_class' => '',                        // class of container
        'menu' => '',                                   // menu name
        'menu_class' => 'top-bar-menu left',            // adding custom nav class
        'theme_location' => 'top-bar-l',                // where it's located in the theme
        'before' => '',                                 // before each link <a>
        'after' => '',                                  // after each link </a>
        'link_before' => '',                            // before each link text
        'link_after' => '',                             // after each link text
        'depth' => 5,                                   // limit the depth of the nav
        'fallback_cb' => false,                         // fallback function (see below)
        'walker' => new Foundation_Walker_Nav_Menu()
    ));
}

/**
 * Right top bar
 * http://codex.wordpress.org/Function_Reference/wp_nav_menu
 */
function hatch_top_bar_r() {
    wp_nav_menu(array(
        'container' => false,                           // remove nav container
        'container_class' => '',                        // class of container
        'menu' => '',                                   // menu name
        'menu_class' => 'top-bar-menu right',            // adding custom nav class
        'theme_location' => 'top-bar',                // where it's located in the theme
        'before' => '',                                 // before each link <a>
        'after' => '',                                  // after each link </a>
        'link_before' => '',                            // before each link text
        'link_after' => '',                             // after each link text
        'depth' => 5,                                   // limit the depth of the nav
        'fallback_cb' => false,                         // fallback function (see below)
        'walker' => new Foundation_Walker_Nav_Menu()
    ));
}

/**
 * Footer
 */
function hatch_footer() {
    wp_nav_menu(array(
        'container' => false,                           // remove nav container
        'container_class' => '',                        // class of container
        'menu' => '',                                   // menu name
        'menu_class' => 'inline-list footer-menu',           // adding custom nav class
        'theme_location' => 'footer',                // where it's located in the theme
        'before' => '',                                 // before each link <a>
        'after' => '',                                  // after each link </a>
        'link_before' => '',                            // before each link text
        'link_after' => '',                             // after each link text
        'depth' => 5,                                   // limit the depth of the nav
        'fallback_cb' => false,                         // fallback function (see below)
    ));
}

/**
 * Mobile off-canvas
 */
function hatch_mobile_off_canvas() {
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
}