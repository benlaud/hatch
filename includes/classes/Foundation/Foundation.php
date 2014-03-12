<?php

class Foundation {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {
		add_filter( 'wp_list_pages', array( $this, 'wp_list_pages' ), 10, 2 );
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
}