<?php
/**
 * Hatch Base Class
 *
 * Where is all starts. Includes all of our Classes
 *
 * @package Hatch
 * @since 1.0
 */

include( 'HatchOptions.php' );
include( 'HatchCustomHeader.php' );
include( 'HatchActivate.php' );
include( 'HatchUtilities.php' );
include( 'HatchMenu.php' );
include( 'Hatch_TinyMCE.php' );

/**
 * Class Hatch
 */
class Hatch {
	function __construct() {
		$hatch_activate = new HatchActivate();
		$hatch_custom_header = new HatchCustomHeader();
		$hatch_option_controls = new HatchOptions();
		$hatch_utilities = new HatchUtilities();
		$hatch_menu = new HatchMenu();
	}
}