<?php

global $linchpin_classes_dir;

$linchpin_classes_dir = get_template_directory() . '/includes/Linchpin/';

include_once( $linchpin_classes_dir . 'HatchOptions.php' );
include_once( $linchpin_classes_dir . 'HatchCustomHeader.php' );
include_once( $linchpin_classes_dir . 'HatchActivate.php' );
include_once( $linchpin_classes_dir . 'HatchUtilities.php' );
include_once( $linchpin_classes_dir . 'HatchMenu.php' );

class Hatch {
	function __construct() {
		$launchpad_activate 	   = new HatchActivate();
		$launchpad_custom_header   = new HatchCustomHeader();
		$launchpad_option_controls = new HatchOptions();
		$launchpad_utilities	   = new HatchUtilities();
		$launchpad_menu			   = new HatchMenu();
	}
}