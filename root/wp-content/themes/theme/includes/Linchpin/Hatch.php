<?php

global $linchpin_classes_dir;

$linchpin_classes_dir = get_template_directory() . '/includes/Linchpin/';

include_once( $linchpin_classes_dir . 'HatchOptions.php' );
include_once( $linchpin_classes_dir . 'HatchCustomHeader.php' );
include_once( $linchpin_classes_dir . 'HatchActivate.php' );
include_once( $linchpin_classes_dir . 'HatchUtilities.php' );
include_once( $linchpin_classes_dir . 'HatchMenu.php' );

class Hatch {
	function __construct()
	{
		$hatch_activate = new HatchActivate();
		$hatch_custom_header = new HatchCustomHeader();
		$hatch_option_controls = new HatchOptions();
		$hatch_utilities = new HatchUtilities();
		$hatch_menu = new HatchMenu();
	}
}