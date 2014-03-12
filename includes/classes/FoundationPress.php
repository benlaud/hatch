<?php

/**
 *	FoundationPress Setup
 */
class FoundationPress {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {

		$foundation = new Foundation();

		add_action( 'init', 			  array( $this, 'init' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts') );
		add_action( 'after_setup_theme',  array( $this, 'after_setup_theme' ) );

		// load jquery in the footer
		add_action( 'wp_default_scripts', array( $this, 'print_jquery_in_footer') );
	}

	/**
	 * init function.
	 *
	 * @access public
	 * @return void
	 */
	function init() {
		register_nav_menus( array(
		    'top-bar-right' => 'Top Bar Right', // registers the menu in the WordPress admin menu editor
		    'footer' => 'Footer',
		    'mobile-off-canvas' => 'Mobile (Off Canvas)'
		));
	}


	/**
	 * print_jquery_in_footer function.
	 * Enqueue jquery within our footer instead of being in our header.
	 *
	 * @access public
	 * @param mixed &$scripts
	 * @return void
	 */
	function print_jquery_in_footer( &$scripts) {
		if ( ! is_admin() )
			$scripts->add_data( 'jquery', 'group', 1 );
	}

	/**
	 * after_setup_theme function.
	 *
	 * @access public
	 * @return void
	 */
	function after_setup_theme() {
	    add_theme_support( 'menus' );
	    add_theme_support( 'post-thumbnails' );
	    add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'custom-background' );
	}

	/**
	 * wp_enqueue_scripts function.
	 *
	 * @access public
	 * @return void
	 */
	function wp_enqueue_scripts() {
		wp_enqueue_script( 'modernizr',  get_template_directory_uri() . '/js/modernizr/modernizr.min.js', array(), '1.0.0', false );
		wp_enqueue_script( 'foundation', get_template_directory_uri() . '/js/app.js', array('jquery'), '1.0.0', true );
	}
}