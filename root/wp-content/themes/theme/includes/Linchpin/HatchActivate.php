<?php

if (is_admin() && isset($_GET['activated']) && 'themes.php' == $GLOBALS['pagenow']) {
  wp_redirect(admin_url('themes.php?page=theme_activation_options'));
  exit;
}

class HatchActivate {

	function __construct() {

		add_filter('option_page_capability_hatch_activation_options', array( $this, 'activation_options_page_capability' ) );
	}

	/**
	 * activation_options_page_capability function.
	 *
	 * @access private
	 * @param mixed $capability
	 * @return void
	 */
	function activation_options_page_capability($capability) {
		return 'edit_theme_options';
	}
}

/**
 * hatch_add_help_tabs_to_theme_page function.
 *
 * @access public
 * @return void
 */
function hatch_add_help_tabs_to_theme_page() {
    $screen = get_current_screen();
    $screen->add_help_tab( array(
        'id'      => 'hatch-activation-help', // This should be unique for the screen.
        'title'   => 'Prepare for Launch',
        'content' => '<p>Within this page are the basic setup options for the Launchpad.</p>',
        // Use 'callback' instead of 'content' for a function callback that renders the tab content.
    ) );
}