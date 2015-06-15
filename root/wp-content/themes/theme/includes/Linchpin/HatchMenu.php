<?php
/**
 * HatchMenu class.
 *
 * @package Hatch
 * @since 1.0
 */
class HatchMenu {
	/**
	 * __construct function.
	 *
	 * @access public
	 */
	function __construct() {
	  add_action( 'wp_before_admin_bar_render', array( $this, 'add_links' ) );
	}

	/**
	 * add_links function.
	 *
	 * @access public
	 * @return void
	 */
	function add_links() {
		global $wp_admin_bar;

		if( strpos(site_url(), 'staging') !== false ) {
			$title  =  __( 'Staging', 'launchpad' );
			$meta   = array(
				'class'    => 'staging',
			);
		} else {
			$title  =  __( 'Production', 'launchpad' );
			$meta   = array(
				'class'    => 'production',
			);
		}

		$args = array(
			'parent' => 'top-secondary',
			'id'     => 'staging_flag',
			'title'  => '',
			'href'   => '#',
			'meta'	 => $meta
		);

		$wp_admin_bar->add_menu( $args );
	}
}
