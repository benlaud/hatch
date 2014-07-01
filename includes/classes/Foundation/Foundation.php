<?php

class Foundation {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {
		add_filter( 'wp_list_pages',      array( $this, 'wp_list_pages' ), 10, 2 );
		add_filter( 'nav_menu_css_class', array( $this, 'add_active_nav_class' ), 10, 2 );

		add_action( 'wp_default_scripts', array( $this, 'wp_enqueue_jquery_in_footer' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_kitchen_sink_scripts' ) );
	}

	/**
	 * wp_list_pages function.
	 *
	 * Use the active class of ZURB Foundation on wp_list_pages output.
	 *
	 * From required+ Foundation http://themes.required.ch
	 *
	 * @access public
	 * @param mixed $input
	 * @return void
	 */
	function wp_list_pages( $input ) {

		$pattern = '/current_page_item/';
	    $replace = 'current_page_item active';

	    $output = preg_replace( $pattern, $replace, $input );

	    return $output;
	}

	/**
	 * print_jquery_in_footer function.
	 *
	 * @access public
	 * @param mixed &$scripts
	 * @return void
	 */
	function wp_enqueue_jquery_in_footer( &$scripts) {
		if ( ! is_admin() )
			$scripts->add_data( 'jquery', 'group', 1 );
	}

	/**
	 * enqueue_kitchen_sink_scripts function.
	 *
	 * @access public
	 * @return void
	 */
	function enqueue_kitchen_sink_scripts() {
		if ( is_page_template('kitchen-sink.php') ) {
	    	wp_enqueue_script( 'kitchen-sink', get_template_directory_uri() . '/js/kitchen-sink.js', array('jquery'), '1.0.0', true );
		}
	}

	/**
	 * add_active_nav_class function.
	 * Add Foundation 'active' class for the current menu item
	 *
	 * @access public
	 * @param mixed $classes
	 * @param mixed $item
	 * @return void
	 */
	function add_active_nav_class( $classes, $item ) {
	    if ( $item->current == 1 || $item->current_item_ancestor == true ) {
	        $classes[] = 'active';
	    }
	    return $classes;
	}
}