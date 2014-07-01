<?php

/**
 * Foundation_Utilities class.
 */
class Foundation_Utilities {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {

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
	function paginate_links($prev_text = '&laquo', $next = '&raquo' ) {

    	global $wp_query;

		$big = 999999999; // need an unlikely integer
		$pagination = '';

		$pages = paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
            'prev_next' => false,
            'type'  => 'array',
            'prev_next'  => TRUE,
			'prev_text'    => __( $prev_text ),
			'next_text'    => __( $next_text ),
        ) );

        if( is_array( $pages ) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');

            $pagination 	.= '<ul class="pagination">';

            foreach ( $pages as $page ) {
            	$pagination .=  "<li>$page</li>";
            }

			$pagination 	.=  '</ul>';
        }

		return $pagination;
	}

	/**
	 * menu_fallback function.
	 *
	 * @access public
	 * @return void
	 */
	function menu_fallback() {

		$html = '<div class="alert-box secondary">';

			// Translators 1: Link to Menus,
			// 			   2: Link to Customize

	  		$html .= sprintf( __( 'Please assign a menu to the primary menu location under %1$s or %2$s the design.', 'FoundationPress' ),

	  		sprintf(  __( '<a href="%s">Menus</a>', 'FoundationPress' ),
	  			get_admin_url( get_current_blog_id(), 'nav-menus.php' )
	  		),
	  		sprintf(  __( '<a href="%s">Customize</a>', 'FoundationPress' ),
	  			get_admin_url( get_current_blog_id(), 'customize.php' )
	  		)
	  	);
	  	$html .= '</div>';

	  	return $html;
  	}
}

$foundation_utilities = new Foundation_Utilities();

/**
 *	Some backwards compatability
 */

/**
 * FoundationPress_menu_fallback function.
 * A fallback when no navigation is selected by default.
 *
 * @access public
 * @return void
 */
function FoundationPress_menu_fallback() {
	echo $foundation_utilities->menu_fallback();
}

/**
 * FoundationPress_pagination function.
 *
 * @access public
 * @param mixed $prev_text
 * @param mixed $next_text
 * @return void
 */
function FoundationPress_pagination($prev_text, $next_text) {
	echo $foundation_utilities->paginate_links($prev_text, $next_text);
}

/**
 * FoundationPress_entry_meta function.
 *
 * @access public
 * @return void
 */
function FoundationPress_entry_meta() {
    echo '<time class="updated" datetime="'. get_the_time('c') .'" pubdate>'. sprintf(__('Posted on %s at %s.', 'FoundationPress'), get_the_time('l, F jS, Y'), get_the_time()) .'</time>';
    echo '<p class="byline author">'. __('Written by', 'FoundationPress') .' <a href="'. get_author_posts_url(get_the_author_meta('ID')) .'" rel="author" class="fn">'. get_the_author() .'</a></p>';
}
