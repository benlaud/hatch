<?php

/**
 *
 * Include all of our needed Classes and scripts
 * Originally based on the work done by Ole Fredrik Lie (http://olefredrik.com)
 * Forked by Linchpin
 *
 */

include_once( 'includes/classes/CustomPostTypes.php' );
include_once( 'includes/classes/Foundation/Foundation_Walker_Nav_Menu.php' );
include_once( 'includes/classes/Foundation/Foundation_Clearing.php' );
include_once( 'includes/classes/Foundation/Foundation_Utilities.php' );
include_once( 'includes/classes/Foundation/Foundation.php' );
include_once( 'includes/classes/Theme.php' );

/**
 *	Instantiate our classes.
 */

$theme	= new Theme();
$cpt 	= new CustomPostTypes();
