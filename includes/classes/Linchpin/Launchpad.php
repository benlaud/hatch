<?php

$linchpin_classes_dir = get_template_directory() . '/includes/classes/Linchpin/';

include_once( $linchpin_classes_dir . 'LaunchpadOptions.php' );
include_once( $linchpin_classes_dir . 'LaunchpadCustomHeader.php' );
include_once( $linchpin_classes_dir . 'LaunchpadActivate.php' );
include_once( $linchpin_classes_dir . 'CustomPostTypes.php' );

class Launchpad {
	function __construct() {
		$launchpad_activate 	   = new LaunchpadActivate();
		$launchpad_custom_header   = new LaunchpadCustomHeader();
		$launchpad_option_controls = new LaunchpadOptions();
	}
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function launchpad_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'launchpad_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'launchpad_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so test_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so test_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in test_categorized_blog.
 */
function launchpad_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'launchpad_categories' );
}
add_action( 'edit_category', 'launchpad_category_transient_flusher' );
add_action( 'save_post',     'launchpad_category_transient_flusher' );
