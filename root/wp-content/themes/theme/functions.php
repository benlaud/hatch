<?php

/**
 *
 * Include all of our needed Classes and scripts
 * Originally based on the work done by Ole Fredrik Lie (http://olefredrik.com)
 *
 * Forked by Linchpin
 *
 * Also uses some sweet grunt init scaffolding from 10up.
 *
 * We've added in a ton of functionality we utilize on a daily basis.
 * It's not necessarily meant to have a TON of options and controls.
 * Just a clean base for Linchpin build outs.
 *
 */

// Useful global constants
define( '{%= prefix_caps %}VERSION', '0.1.0' );
define( 'SCRIPT_DEBUG', true ); // enable script debug by default

include_once('includes/Linchpin/Launchpad.php');    // Launchpad Classes
include_once('includes/Foundation/Foundation.php'); // Foundation Classes
include_once('includes/{%= php_class_name %}.php');      // Theme Class

/**
 *	Instantiate our classes.
 */

$theme	= new {%= php_class_name %}();