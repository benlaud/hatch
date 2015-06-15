<?php
/**
 * {%= title %}
 *
 * @author {%= author_name %}
 * @package {%= php_class_name %}
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
		$hatch  = new Hatch();
		
		add_filter( 'upload_mimes',			array( $this, 'upload_mimes' ) );
		add_filter( 'admin_footer_text', 	array( $this, 'admin_footer_text' ) );

		add_action( 'wp_enqueue_scripts', 	array( $this, 'wp_enqueue_scripts') );
		add_action( 'wp_enqueue_scripts', 	array( $this, 'wp_enqueue_styles') );
		add_action( 'init', 			  	array( $this, 'init' ) );
		add_action( 'widgets_init', 	  	array( $this, 'widgets_init' ) );
		add_action( 'after_setup_theme', 	array( $this, 'after_setup_theme' ) );
		add_action( 'customize_register',	array( $this, 'customize_register' ) );
		add_action( 'after_setup_theme',	array( $this, 'add_editor_styles' ) );
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
	 * Add in the theme author info, hatch info and be sure to keep love for WordPress
	 * admin_footer_text function.
	 *
	 * @access public
	 * @return void
	 */
	function admin_footer_text() {
		echo 'Powered by <a href="http://www.wordpress.org" target="_blank">WordPress</a> | Created by <a href="{%= author_url %}/?utm_source=hatch&utm_medium=hatch_footer&utm_campaign=hatch_notice" target="_blank">{%= author_name %}</a> and augmented by the <a href="http://github.com/linchpinagency/hatch/?utm_source=hatch&utm_medium=hatch_footer&utm_campaign=hatch_notice" target="_blank">Hatch</a>';
	}

	/**
	 * We have found that these are pretty much 3 areas that clients request
	 * for easier customizations.
	 *
	 * Registers our 3 base sidebars
	 * Home Widgets
	 * Page Widgets
	 * Footer Widgets
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
	 * @param array &$scripts
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

        wp_enqueue_script( 'modernizr',  get_stylesheet_directory_uri() . '/js/modernizr/modernizr' . $postfix . '.js', array(), {%= prefix_caps %}VERSION, false );
		wp_enqueue_script( 'foundation', get_stylesheet_directory_uri() . '/js/app' . $postfix . '.js', array('jquery'), {%= prefix_caps %}VERSION, true );
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
	
	/*
	 * customize_register function.
	 * 
	 * Allows header logo to be set-up from
	 * the customize panel under Appearance within the WordPress Admin
	 *
	 * Also allow for the .svg extension within logo uploading
	 *
	 * @param $wp_customize
	 * @return void
	 */

	/**
	 *
	 */
	
	function customize_register ( $wp_customize ) {

		$wp_customize->add_section (
			'{%= js_safe_name %}_logo', array(
				'title' 	=> __('Site Logo', '{%= js_safe_name %}'),
				'priority' 	=> 80,
			)
		);

		$wp_customize->add_setting (
			'{%= js_safe_name %}_theme_options[logo_upload]', array(
				'default'		=> '',
				'capability' 	=> 'edit_theme_options',
				'type'			=> 'option',
			)
		);

		$wp_customize->add_control (
			new WP_Customize_Image_Control( $wp_customize, 'logo_upload', array (
				'label'		=> __('Site Logo', '{%= js_safe_name %}'),
				'section' 	=> '{%= js_safe_name %}_logo',
				'settings' 	=> '{%= js_safe_name %}_theme_options[logo_upload]',
				'extensions'	=> array( 'jpg', 'jpeg', 'png', 'gif', 'svg' ),
			) )
		);
	}
	
	/**
	 * linchpin_upload_mimes function.
	 *
	 * @access public
	 * @param array $mimes (default: array())
	 * @return void
	 */
	function upload_mimes($mimes = array()) {
	    $mimes['svg'] = 'image/svg+xml';
	    return $mimes;
	}
	
	function {%= js_safe_name %}_add_editor_styles() {
		$admin_style = get_stylesheet_directory_uri() . '/css/editor.css';
		
	    add_editor_style( $admin_style );
	}
}