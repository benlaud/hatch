<?php

$linchpin_classes_dir = get_template_directory() . '/includes/classes/Linchpin/';

include_once( $linchpin_classes_dir . 'LaunchpadOptions.php' );
include_once( $linchpin_classes_dir . 'LaunchpadCustomHeader.php' );
include_once( $linchpin_classes_dir . 'LaunchpadActivate.php' );
include_once( $linchpin_classes_dir . 'LaunchpadUtilities.php' );
include_once( $linchpin_classes_dir . 'CustomPostTypes.php' );

class Launchpad {
	function __construct() {
		$launchpad_activate 	   = new LaunchpadActivate();
		$launchpad_custom_header   = new LaunchpadCustomHeader();
		$launchpad_option_controls = new LaunchpadOptions();
		$launchpad_utilities	   = new LaunchpadUtilities();
	}
}