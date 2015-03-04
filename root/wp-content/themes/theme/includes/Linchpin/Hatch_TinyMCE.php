<?php

/**
 * Hatch modifcations to the TinyMCE editor.
 */
class Hatch_TinyMCE {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {
		add_action( 'admin_init', array( $this, 'admin_init' ) );
	}

	/**
	 * admin_init function.
	 *
	 * @access public
	 * @return void
	 */
	function admin_init() {
		add_editor_style( 'css/admin-editor.css' );
	}
}
$hatch_tinymce = new Hatch_TinyMCE();