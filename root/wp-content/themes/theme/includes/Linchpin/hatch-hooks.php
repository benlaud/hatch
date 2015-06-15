<?php
/**
 * Hatch Hooks
 *
 * Just a bunch of utility methods associated with our hooks
 *
 * @package Hatch
 * @since 1.0
 */

// header.php
function hatch_head() {
	do_action( 'hatch_head' );
}

function hatch_html_tag() {
	do_action( 'hatch_html_tag' );
}

function hatch_head_scripts() {
	do_action( 'hatch_additional_header_scripts' );
}

function hatch_stylesheets() {
	do_action( 'hatch_stylesheets' );
}
function hatch_wrap_before() {
	do_action( 'hatch_wrap_before' );
}

function hatch_header_before() {
	do_action( 'hatch_header_before' );
}
function hatch_header_inside() {
	do_action( 'hatch_header_inside' );
}

function hatch_header_after() {
	do_action( 'hatch_header_after' );
}

// 404.php, archive.php, front-page.php, index.php, loop-page.php, loop-search.php, loop-single.php, loop.php
// page-custom.php, page-full.php, page-sitemap.php, page-subpages.php, page.php, search.php, single.php
function hatch_content_before() { do_action( 'hatch_content_before' ); }
function hatch_content_after() { do_action( 'hatch_content_after' ); }
function hatch_main_before() { do_action( 'hatch_main_before' ); }
function hatch_main_after() { do_action( 'hatch_main_after' ); }
function hatch_post_before() { do_action( 'hatch_post_before' ); }
function hatch_post_after() { do_action( 'hatch_post_after' ); }
function hatch_post_inside_before() { do_action( 'hatch_post_inside_before' ); }
function hatch_post_inside_after() { do_action( 'hatch_post_inside_after' ); }
function hatch_loop_before() { do_action( 'hatch_loop_before' ); }
function hatch_loop_after() { do_action( 'hatch_loop_after' ); }
function hatch_sidebar_before() { do_action( 'hatch_sidebar_before' ); }
function hatch_sidebar_inside_before() { do_action( 'hatch_sidebar_inside_before' ); }
function hatch_sidebar_inside_after() { do_action( 'hatch_sidebar_inside_after' ); }
function hatch_sidebar_after() { do_action( 'hatch_sidebar_after' ); }

// footer.php
function hatch_footer_before() { do_action( 'hatch_footer_before' ); }
function hatch_footer_inside() { do_action( 'hatch_footer_inside' ); }
function hatch_footer_after() { do_action( 'hatch_footer_after' ); }
function hatch_footer() { do_action( 'hatch_footer' ); }
function hatch_footer_scripts() { do_action( 'hatch_additional_footer_scripts' ); }