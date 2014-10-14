<?php
/**
 * {%= title %}
 *
 * @author {%= author_name %}
 * @package     Linchpin
 *
 */
class {%= php_class_name %} {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {

		$foundation = new Foundation();
		$launchpad  = new Launchpad();

		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts') );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_styles') );
		add_action( 'init', 			  array( $this, 'init' ) );
		add_action( 'widgets_init', 	  array( $this, 'widgets_init' ) );
		add_action( 'after_setup_theme',  array( $this, 'after_setup_theme' ) );
	}

	/**
	 * init function.
	 *
	 * @access public
	 * @return void
	 */
	function init() {
		register_nav_menus( array(
		    'top-bar' 			=> 'Top Bar', // registers the menu in the WordPress admin menu editor
		    'footer' 			=> 'Footer',
		    'mobile-off-canvas' => 'Mobile (Off Canvas)'
		));
	}

	/**
	 * widgets_init function.
	 *
	 * @access public
	 * @return void
	 */
	function widgets_init() {
		register_sidebar( array(
			'name'          => 'Home Widgets',
			'id'            => 'home-widgets',
			'description'   => 'Widgets that are displayed on the home page.',
			'class'         => 'home-widgets',
			'before_widget' => '<div id="%1$s" class="widget small-4 columns %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => 'Page Widgets',
			'id'            => 'page-widgets',
			'description'   => 'Widgets that are displayed on interior pages.',
			'class'         => 'page-widgets',
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widgettitle">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => 'Footer Widgets',
			'id'            => 'footer-widgets',
			'description'   => 'Widgets that are displayed in the footer.',
			'class'         => 'footer-widgets',
			'before_widget' => '<div id="%1$s" class="right %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widgettitle">',
			'after_title'   => '</h5>',
		) );
	}

	/**
	 * print_jquery_in_footer function.
	 * Removes the jquery library from the header and prints it in the footer
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
	}

	/**
	 * wp_enqueue_scripts function.
	 *
	 * @access public
	 * @return void
	 */
	function wp_enqueue_scripts() {
        $postfix = ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) ? '' : '.min';

        wp_enqueue_script( 'modernizr',  get_template_directory_uri()   . '/js/modernizr/modernizr' . $postfix . '.js', array(), {%= prefix_caps %}VERSION, false );
		wp_enqueue_script( 'foundation', get_template_directory_uri()   . '/js/app' . $postfix . '.js', array('jquery'), {%= prefix_caps %}VERSION, true );
		wp_enqueue_script( '{%= js_safe_name %}', 	 get_stylesheet_directory_uri() . '/js/{%= js_safe_name %}' . $postfix . '.js', array( 'jquery' ), {%= prefix_caps %}VERSION, true );
	}

	/**
	 * wp_enqueue_styles function.
	 *
	 * @access public
	 * @return void
	 */
	function wp_enqueue_styles() {
		wp_enqueue_style( 'app-css', get_stylesheet_directory_uri() . '/css/{%= js_safe_name %}.css' );
	}
}