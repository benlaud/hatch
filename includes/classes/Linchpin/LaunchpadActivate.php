<?php

if (is_admin() && isset($_GET['activated']) && 'themes.php' == $GLOBALS['pagenow']) {
  wp_redirect(admin_url('themes.php?page=theme_activation_options'));
  exit;
}

class LaunchpadActivation {

	function __construct() {

		add_filter('option_page_capability_launchpad_activation_options', array( $this, 'activation_options_page_capability' ) );

		add_action('admin_init',   array( $this, 'theme_activation_options' ) );
		add_action('admin_init',   array( $this, 'theme_activation_action' ) );

		add_action('admin_menu',   array( $this, 'theme_activation_options_add_page' ), 50 );
		add_action('switch_theme', array( $this, 'deactivation_action' ) );
	}

	/**
	 * deactivation_action function.
	 *
	 * @access public
	 * @return void
	 */
	function deactivation_action() {
	  update_option('launchpad_theme_activation_options', launchpad_get_default_theme_activation_options());
	}

	/**
	 * theme_activation_options function.
	 *
	 * @access private
	 * @return void
	 */
	private function theme_activation_options() {
	    if (launchpad_get_theme_activation_options() === false) {
	    	add_option('launchpad_theme_activation_options', launchpad_get_default_theme_activation_options());
		}

	    register_setting(
	       'launchpad_activation_options',
	       'launchpad_theme_activation_options',
	       'launchpad_theme_activation_options_validate'
	    );
	}

	/**
	 * activation_options_page_capability function.
	 *
	 * @access private
	 * @param mixed $capability
	 * @return void
	 */
	private function activation_options_page_capability($capability) {
		return 'edit_theme_options';
	}

	/**
	 * theme_activation_options_add_page function.
	 *
	 * @author roots team, aware
	 * @todo Should add in a "settings" page as well. There may be setup options that
	 *       are not specific to "Appearance" so it may be a bit confusing
	 *
	 * @access private
	 * @return void
	 */
	private function theme_activation_options_add_page() {
	  $launchpad_activation_options = launchpad_get_theme_activation_options();
	  if (!$launchpad_activation_options['first_run']) {
	    $theme_page = add_theme_page(
	      __('Launchpad Setup', 'launchpad'),
	      __('Launchpad Setup', 'launchpad'),
	      'edit_theme_options',
	      'theme_activation_options',
	      'launchpad_theme_activation_options_render_page'
	    );

	    if ( $theme_page )
	        add_action( 'load-' . $theme_page, 'launchpad_add_help_tabs_to_theme_page' );

	  } else {
	    if (is_admin() && isset($_GET['page']) && $_GET['page'] === 'theme_activation_options') {
	      wp_redirect(admin_url('themes.php?page=theme_options'));
	      exit;
	    }
	  }

	}

	/**
	 * theme_activation_action function.
	 *
	 * @access public
	 * @return void
	 */
	function theme_activation_action(){
	  $launchpad_theme_activation_options = launchpad_get_theme_activation_options();

	  if ($launchpad_theme_activation_options['create_front_page']) {
	    $launchpad_theme_activation_options['create_front_page'] = false;

	    $default_pages = array('Home');
	    $existing_pages = get_pages();
	    $temp = array();

	    foreach ($existing_pages as $page) {
	      $temp[] = $page->post_title;
	    }

	    $pages_to_create = array_diff($default_pages, $temp);

	    foreach ($pages_to_create as $new_page_title) {
	      $add_default_pages = array(
	        'post_title' => $new_page_title,
	        'post_content' => 'This is your base homepage content',
	        'post_status' => 'publish',
	        'post_type' => 'page'
	      );

	      $result = wp_insert_post($add_default_pages);
	    }

	    $home = get_page_by_title('Home');
	    update_option('show_on_front', 'page');
	    update_option('page_on_front', $home->ID);

	    $home_menu_order = array(
	      'ID' => $home->ID,
	      'menu_order' => -1
	    );
	    wp_update_post($home_menu_order);
	  }

	  if ($launchpad_theme_activation_options['create_navigation_menus']) {
	    $launchpad_theme_activation_options['create_navigation_menus'] = false;

	    $launchpad_nav_theme_mod = false;

	    if (!has_nav_menu('primary_navigation')) {
	      $primary_nav_id = wp_create_nav_menu('Primary Navigation', array('slug' => 'primary_navigation'));
	      $launchpad_nav_theme_mod['primary_navigation'] = $primary_nav_id;
	    }

	    if (!has_nav_menu('utility_navigation')) {
	      $utility_nav_id = wp_create_nav_menu('Utility Navigation', array('slug' => 'utility_navigation'));
	      $launchpad_nav_theme_mod['utility_navigation'] = $utility_nav_id;
	    }

	    if ($launchpad_nav_theme_mod) {
	      set_theme_mod('nav_menu_locations', $launchpad_nav_theme_mod);
	    }
	  }

	  update_option('launchpad_theme_activation_options', $launchpad_theme_activation_options);
	}
}

$launchpad_activate = new LaunchpadActivation();

/**
 * @author aware
 * @todo 'client_can_override_link_color'  => false, // AW: give the ability for the user to add in a link color
 * @todo 'client_can_upload_header_img'    => false  // AW: give user the ability to add in a header image
 * @return type
 */

function launchpad_get_default_theme_activation_options() {
  $default_theme_activation_options = array(
    'first_run'                       => false,
    'create_front_page'               => false,
    'create_navigation_menus'         => false
  );

  return apply_filters('launchpad_default_theme_activation_options', $default_theme_activation_options);
}

/**
 * launchpad_get_theme_activation_options function.
 *
 * @access public
 * @return void
 */
function launchpad_get_theme_activation_options() {
  return get_option('launchpad_theme_activation_options', launchpad_get_default_theme_activation_options());
}

/**
 * launchpad_theme_activation_options_render_page function.
 *
 * @access public
 * @return void
 */
function launchpad_theme_activation_options_render_page() { ?>

  <div class="wrap">
    <?php screen_icon(); ?>
    <h2><?php printf(__('%s Theme Activation', 'launchpad'), get_current_theme()); ?></h2>
    <?php settings_errors(); ?>

    <form method="post" action="options.php">

      <?php
        settings_fields('launchpad_activation_options');
        $launchpad_activation_options = launchpad_get_theme_activation_options();
        $launchpad_default_activation_options = launchpad_get_default_theme_activation_options();
      ?>

      <input type="hidden" value="1" name="launchpad_theme_activation_options[first_run]" />

      <table class="form-table">

        <tr valign="top"><th scope="row"><?php _e('Create static front page?', 'launchpad'); ?></th>
          <td>
            <label class="screen-reader-text"><span><?php _e('Create static front page?', 'launchpad'); ?></span></label>
              <select name="launchpad_theme_activation_options[create_front_page]" id="create_front_page">
                <option selected="selected" value="yes"><?php echo _e('Yes', 'launchpad'); ?></option>
                <option value="no"><?php echo _e('No', 'launchpad'); ?></option>
              </select>
              <p class="description"><?php printf(__('Create a page called Home and set it to be the static front page', 'launchpad')); ?></p>
          </td>
        </tr>

        <tr valign="top"><th scope="row"><?php _e('Create navigation menus?', 'launchpad'); ?></th>
          <td>
            <label class="screen-reader-text"><span><?php _e('Create navigation menus?', 'launchpad'); ?></span></label>
              <select name="launchpad_theme_activation_options[create_navigation_menus]" id="create_navigation_menus">
                <option selected="selected" value="yes"><?php echo _e('Yes', 'launchpad'); ?></option>
                <option value="no"><?php echo _e('No', 'launchpad'); ?></option>
              </select>
              <p class="description"><?php printf(__('Create the Primary and Utility Navigation menus and set their locations', 'launchpad')); ?></p>
          </td>
        </tr>
      </table>

      <?php submit_button(); ?>
    </form>
  </div>

<?php }

/**
 * launchpad_theme_activation_options_validate function.
 *
 * @access public
 * @param mixed $input
 * @return void
 */
function launchpad_theme_activation_options_validate($input) {
  $output = $defaults = launchpad_get_default_theme_activation_options();

  if (isset($input['first_run'])) {
    if ($input['first_run'] === '1') {
      $input['first_run'] = true;
    }
    $output['first_run'] = $input['first_run'];
  }

  if (isset($input['create_front_page'])) {
    if ($input['create_front_page'] === 'yes') {
      $input['create_front_page'] = true;
    }
    if ($input['create_front_page'] === 'no') {
      $input['create_front_page'] = false;
    }
    $output['create_front_page'] = $input['create_front_page'];
  }

  if (isset($input['create_navigation_menus'])) {
    if ($input['create_navigation_menus'] === 'yes') {
      $input['create_navigation_menus'] = true;
    }
    if ($input['create_navigation_menus'] === 'no') {
      $input['create_navigation_menus'] = false;
    }
    $output['create_navigation_menus'] = $input['create_navigation_menus'];
  }

  return apply_filters('launchpad_theme_activation_options_validate', $output, $input, $defaults);
}

/**
 * launchpad_add_help_tabs_to_theme_page function.
 *
 * @access public
 * @return void
 */
function launchpad_add_help_tabs_to_theme_page() {
    $screen = get_current_screen();
    $screen->add_help_tab( array(
        'id'      => 'launchpad-activation-help', // This should be unique for the screen.
        'title'   => 'Prepare for Launch',
        'content' => '<p>Within this page are the basic setup options for the Launchpad.</p>',
        // Use 'callback' instead of 'content' for a function callback that renders the tab content.
    ) );
}

/**
 * This isn't implemented quite yet. Mainly waiting on WP 3.4 to have official
 * usage of WP pointer. I may hack this in place. But it isn't really needed just yet
 * @author aware
 */

function get_content_in_wp_pointer() {
    $pointer_content = '<h3>' . __( 'Launchpad Setup', 'launchpad' ) . '</h3>';
    $pointer_content .= '<p>' . __( "Now that the Launchpad has been installed, we need to set it up.<strong>Don't worry it's easy</strong>" , 'launchpad' ) . '</p>';
?>
    <script>
    //<![CDATA[
    jQuery( function($) {

      $( "#launchpad-wrap" ).tabs();

    });
    //]]>
    </script>
    <?php
}