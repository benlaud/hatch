<?php
/**
 * HatchMenu class.
 *
 * @package Hatch
 *
 */
class HatchMenu {
	/**
	* __construct function.
	*
	* @access public
	* @return void
	*/
	function __construct() {
	  add_action( 'wp_before_admin_bar_render', array( $this, 'add_links' ) );
	  add_action( 'admin_enqueue_scripts', 		array( $this, 'menu_enqueue_scripts' ) );
	  add_action( 'wp_enqueue_scripts', 		array( $this, 'menu_enqueue_scripts' ) );
	}

	/**
	 * admin_enqueue_scripts function.
	 * Anyone who can edit posts should see the staging, production flag.
	 *
	 * @access public
	 * @return void
	 */
	function menu_enqueue_scripts() {
		if( current_user_can('edit_posts') ) {
	    	wp_enqueue_style('hatch-menu', get_stylesheet_directory_uri() . '/css/admin.css' );
	    }
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