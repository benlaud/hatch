<?php
/**
 * Foundation Cleanup
 *
 * Help cleanup markup on image elements. Make sure images don't autop, cleanup some recent comment styling
 *
 * @since 1.0
 *
 * @package Hatch
 * @subpackage Foundation
 */

class FoundationCleanup {

	function __construct() {
		add_action('after_setup_theme', array( $this, 'start_cleanup' ) );
	}

	/**
	 * start_cleanup function.
	 *
	 * @access public
	 * @return void
	 */
	function start_cleanup() {

	    add_action( 'wp_head', 				array( $this, 'remove_recent_comments_style' ), 1 ); 	    		// clean up comment styles in the head

	    add_filter( 'gallery_style', 		array( $this, 'gallery_style' ) ); 									// clean up gallery output in wp
	    add_filter( 'wp_head', 				array( $this, 'remove_wp_widget_recent_comments_style' ) , 1 );	    // remove injected css for recent comments widget
	    add_filter( 'get_image_tag_class',  array( $this, 'image_tag_class' ), 0, 4);    						// additional post related cleaning
	    add_filter( 'get_image_tag',		array( $this, 'image_editor' ), 0, 4);
	    add_filter( 'the_content', 			array( $this, 'img_unautop' ), 30 );
	    add_filter( 'edit_comment_link',	array( $this, 'edit_comment_link' ) );
	}

	/**
	 * edit_comment_link function.
	 *
	 * @access public
	 * @param mixed $link
	 * @return void
	 */
	function edit_comment_link( $link ) {

		$link = str_replace( 'class="comment-edit-link"', 'class="comment-edit-link button tiny error"', $link );

		return $link;
	}

	/**
	 * remove_wp_widget_recent_comments_style function.
	 * remove injected CSS for recent comments widget
	 *
	 * @access public
	 * @return void
	 */
	function remove_wp_widget_recent_comments_style() {
	   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
		   remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	   }
	}

	/**
	 * img_unautop function.
	 * Wrap images with figure tag
	 * What the hell does PEE stand for? -aware
	 *
	 * @access public
	 * @param mixed $pee
	 * @return string
	 */
	function img_unautop( $input_p_tag ) {
	    return preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '<figure>$1</figure>', $input_p_tag );
	}

	/**
	 * image_editor function.
	 * Remove width and height in editor, for a better responsive world.
	 *
	 * @access public
	 * @param mixed $html
	 * @param mixed $id
	 * @param mixed $alt
	 * @param mixed $title
	 * @return mixed
	 */
	function image_editor( $html, $id, $alt, $title ) {
	    return preg_replace(array(
	            '/\s+width="\d+"/i',
	            '/\s+height="\d+"/i',
	            '/alt=""/i'
	        ),
	        array(
	            '',
	            '',
	            '',
	            'alt="' . $title . '"'
	        ),
	        $html);
	}

	/**
	 * remove_recent_comments_style function.
	 * remove injected CSS from recent comments widget
	 *
	 * @access public
	 * @return void
	 */
	function remove_recent_comments_style() {
		global $wp_widget_factory;

		if( isset ( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
			remove_action( 'wp_head', array(
				$wp_widget_factory->widgets[ 'WP_Widget_Recent_Comments' ],
				'recent_comments_style'
			) );
		}
	}

	/**
	 * gallery_style function.
	 * remove injected CSS from gallery
	 *
	 * @param mixed $css
	 * @return string
	 */
	function gallery_style( $css ) {
		return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css );
	}

	/**
	 * image_tag_class function.
	 * Clean the output of attributes of images in editor
	 *
	 * @param mixed $class
	 * @param mixed $id
	 * @param mixed $align
	 * @param mixed $size
	 * @return string
	 */
	function image_tag_class( $class, $id, $align, $size ) {
	    $align = 'align' . esc_attr( $align );
	    return $align;
	}
}