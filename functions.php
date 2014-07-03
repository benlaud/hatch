<?php

/**
 *
 * Include all of our needed Classes and scripts
 * Originally based on the work done by Ole Fredrik Lie (http://olefredrik.com)
 * Forked by Linchpin
 *
 * We've added in a ton of functionality we utilize on a daily basis.
 * It's not necessarily ment to have a TON of options and controls.
 * Just a clean base for our build outs.
 *
 */

// Launchpad Classes

include_once( 'includes/classes/Linchpin/LaunchpadOptions.php' );
include_once( 'includes/classes/Linchpin/LaunchpadCustomerHeader.php' );
include_once( 'includes/classes/Linchpin/LaunchpadActivate.php' );
include_once( 'includes/classes/Linchpin/CustomPostTypes.php' );

// Foundation Classes

include_once( 'includes/classes/Foundation/Foundation_Walker_Nav_Menu.php' );
include_once( 'includes/classes/Foundation/Foundation_Clearing.php' );
include_once( 'includes/classes/Foundation/Foundation_Utilities.php' );
include_once( 'includes/classes/Foundation/Foundation.php' );

// Theme Class

include_once( 'includes/classes/Theme.php' );

/**
 *	Instantiate our classes.
 */

$theme	= new Theme();
$cpt 	= new CustomPostTypes();
