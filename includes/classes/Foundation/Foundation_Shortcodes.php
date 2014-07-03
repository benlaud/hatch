<?php

class FoundationShortcodes {

	function __construct() {
		add_shortcode('wp_caption', array( $this, 'fixed_img_caption_shortcode' ) );
		add_shortcode('caption', 	array( $this, 'fixed_img_caption_shortcode' ) );
	}

	/**
	 * fixed_img_caption_shortcode function.
	 * Remove default inline style of wp-caption
	 *
	 * @access public
	 * @param mixed $attr
	 * @param mixed $content (default: null)
	 * @return void
	 */
	function fixed_img_caption_shortcode($attr, $content = null) {
	    if ( ! isset( $attr['caption'] ) ) {
	        if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
	            $content = $matches[1];
	            $attr['caption'] = trim( $matches[2] );
	        }
	    }
	    $output = apply_filters('img_caption_shortcode', '', $attr, $content);
	    if ( $output != '' )
	        return $output;
	    extract(shortcode_atts(array(
	        'id'    => '',
	        'align' => 'alignnone',
	        'width' => '',
	        'caption' => ''
	    ), $attr));
	    if ( 1 > (int) $width || empty($caption) )
	        return $content;
	    if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
	    return '<figure>'
	    . do_shortcode( $content ) . '<figcaption>' . $caption . '</figcaption></figure>';
	}
}