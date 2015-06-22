<?php
/**
 * Hatch Base Class
 *
 * Where is all starts. Includes all of our Classes
 *
 * @package Hatch
 * @since 1.0
 */

include( 'hatch-options.php' );
include( 'hatch-customheader.php' );
include( 'hatch-activate.php' );
include( 'hatch-utilities.php' );
include( 'hatch-menu.php' );
include( 'hatch-tinymce.php' );

/**
 * Class Hatch
 */
class Hatch {

	/**
	 * Construct
	 */
	function __construct() {
		$hatch_activate = new HatchActivate();
		$hatch_custom_header = new HatchCustomHeader();
		$hatch_option_controls = new HatchOptions();
		$hatch_utilities = new HatchUtilities();
		$hatch_menu = new HatchMenu();
	}
}
