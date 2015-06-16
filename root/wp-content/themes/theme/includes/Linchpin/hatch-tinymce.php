<?php
/**
 * Modifications to the TinyMCE editor.
 *
 * @package Hatch
 * @since 1.0
 */

/**
 * Class Hatch_TinyMCE
 */
class Hatch_TinyMCE {

	/**
	 * __construct function.
	 *
	 * @access public
	 */
	function __construct() {
		add_action( 'admin_init', array( $this, 'admin_init' ) );
	}

	/**
	 *
	 * Add custom css to our admin editor
	 * admin_init function.
	 *
	 * @access public
	 */
	function admin_init() {
		add_editor_style( 'css/admin-editor.css' );
	}
}

$hatch_tinymce = new Hatch_TinyMCE();
