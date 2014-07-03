<?php

// header.php
function launchpad_head() { do_action('launchpad_head'); }

function launchpad_html_tag() { do_action('launchpad_html_tag'); }

function launchpad_head_scripts() { do_action('launchpad_additional_header_scripts'); }

function launchpad_stylesheets() { do_action('launchpad_stylesheets'); }
function launchpad_wrap_before() { do_action('launchpad_wrap_before'); }
function launchpad_header_before() { do_action('launchpad_header_before'); }
function launchpad_header_inside() { do_action('launchpad_header_inside'); }
function launchpad_header_after() { do_action('launchpad_header_after'); }

// 404.php, archive.php, front-page.php, index.php, loop-page.php, loop-search.php, loop-single.php, loop.php
// page-custom.php, page-full.php, page-sitemap.php, page-subpages.php, page.php, search.php, single.php
function launchpad_content_before() { do_action('launchpad_content_before'); }
function launchpad_content_after() { do_action('launchpad_content_after'); }
function launchpad_main_before() { do_action('launchpad_main_before'); }
function launchpad_main_after() { do_action('launchpad_main_after'); }
function launchpad_post_before() { do_action('launchpad_post_before'); }
function launchpad_post_after() { do_action('launchpad_post_after'); }
function launchpad_post_inside_before() { do_action('launchpad_post_inside_before'); }
function launchpad_post_inside_after() { do_action('launchpad_post_inside_after'); }
function launchpad_loop_before() { do_action('launchpad_loop_before'); }
function launchpad_loop_after() { do_action('launchpad_loop_after'); }
function launchpad_sidebar_before() { do_action('launchpad_sidebar_before'); }
function launchpad_sidebar_inside_before() { do_action('launchpad_sidebar_inside_before'); }
function launchpad_sidebar_inside_after() { do_action('launchpad_sidebar_inside_after'); }
function launchpad_sidebar_after() { do_action('launchpad_sidebar_after'); }

// footer.php
function launchpad_footer_before() { do_action('launchpad_footer_before'); }
function launchpad_footer_inside() { do_action('launchpad_footer_inside'); }
function launchpad_footer_after() { do_action('launchpad_footer_after'); }
function launchpad_footer() { do_action('launchpad_footer'); }

?>