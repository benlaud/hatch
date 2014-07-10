<?php
/**
 * LaunchpadMenu class.
 */
class LaunchpadMenu {
  /**
   * __construct function.
   *
   * @access public
   * @return void
   */
  function __construct() {
      add_action( 'wp_before_admin_bar_render', array( $this, 'add_links' ) );
	  add_action( 'admin_enqueue_scripts', 		array( $this, 'admin_enqueue_scripts' ) );
  }

	/**
	 * admin_enqueue_scripts function.
	 *
	 * @access public
	 * @return void
	 */
	function admin_enqueue_scripts() {
	    wp_enqueue_style('launchpad-menu', get_template_directory_uri() . '/css/admin.css' );
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
		'title'  => $title,
		'href'   => '#',
		'meta'	 => $meta
	);

	$wp_admin_bar->add_menu( $args );
  }
}