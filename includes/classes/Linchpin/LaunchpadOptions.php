<?php

/**
 * This is the main controller for the Launchpad theme options
 * Some items are derived from other "blank" themes including
 * Blank, Stackers and Roots etc.
 */

class LaunchpadOptions {

	function __construct() {
		add_action('admin_init', 			array( $this, 'init' ) );
		add_action('admin_menu', 			array( $this, 'theme_options_add_page' ) );
		add_action('admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action('admin_notices',			array( $this, 'validate_required_settings' ) );
	}

	/**
	 * init function.
	 * Initialize and get our default theme options
	 *
	 * @author aware
	 * @access public
	 * @return void
	 */

	function init() {
		if ( false === launchpad_get_theme_options() ) {
			add_option('launchpad_theme_options', self::get_default_theme_options());
		}

		register_setting('launchpad_options', 'launchpad_theme_options', array( &$this, 'theme_options_validate' ) );
	}


	function validate_required_settings() {
		global $launchpad_options;
	}

	/**
	 * get_default_theme_options function.
	 * Define our default theme options.
	 *
	 * @author aware
	 * @access public
	 * @static
	 * @return void
	 */

	static function get_default_theme_options() {
	  $default_theme_options = array(
			'clean_menu'					=> TRUE, // This cleans up the menu on the left
			'typekit_id'      				=> '',
			'additional_footer_scripts'		=> '',

			// Version 2.0 Additional Defaults

			'typekit_async'				 	=> FALSE,
			'launchpad_tracking'			=> TRUE // Make sure launchpad tracking is on by default
	  );

	  return apply_filters('launchpad_default_theme_options', $default_theme_options);
	}

	/**
	* Add in our options pages. This includes a specific display for activation as well
	* as our regular theme options.
	* @author aware
	*/

	function theme_options_add_page() {

		$launchpad_options = launchpad_get_theme_options();
		$launchpad_activation_options = launchpad_get_theme_activation_options();

		if ($launchpad_activation_options['first_run']) {

			$theme_page = add_theme_page(
				__('Launchpad Options', 'launchpad'),
				__('Launchpad Options', 'launchpad'),
				'edit_theme_options',
				'theme_options',
				array( &$this, 'theme_options_render_page' )
			);
		}

		add_action( 'admin_footer-' . $theme_page, array( &$this, 'admin_footer' ) );
		add_action( 'admin_head-' . $theme_page, array( &$this, 'admin_head' ) );

	}

	/**
	 * Render our our theme options page. Trying to match as many of the common structures
	 * and styles within the wordpress admin. The more we stay inline with the admin
	 * the more likely we are to not confuse the client.
	 *
	 * @author aware
	 * @return string HTML output of our options page.
	 */

	function theme_options_render_page() {
	  global $launchpad_options;

	  ?>
	  <div class="wrap">
	    <form method="post" action="options.php">
	      <?php screen_icon(); ?>
	      <div id="launchpad-wrap">
	        <ul class="nav-tab-wrapper">
	          <li><a href="#theme-options" class="nav-tab"><?php printf(__('%s Options', 'launchpad'), get_current_theme()); ?></a></li>
	          <li><a href="#extra-options" class="nav-tab"><?php _e('Setup', 'launchpad'); ?></a></li>
	        </ul>
	        <?php settings_errors(); ?>
	        <p class="top-notice"><?php _e('Customize the client/blog setup with these settings. ','launchpad'); ?></p>
	        <?php
	        settings_fields('launchpad_options');
	        $launchpad_options = launchpad_get_theme_options();
	        $launchpad_default_options = self::get_default_theme_options();
	        ?>
	        <?php require_once locate_template('/inc/admin/launchpad-options/theme-options.php'); ?>
	        <?php require_once locate_template('/inc/admin/launchpad-options/client-details.php'); ?>
	        <?php require_once locate_template('/inc/admin/launchpad-options/integration-options.php'); ?>
	        <?php require_once locate_template('/inc/admin/launchpad-options/extra-options.php'); ?>

	        <input type="hidden" value="1" name="launchpad_theme_options[first_run]" />

	        <?php submit_button(); ?>
	    </form>
	  </div>
	  <?php
	}

	/**
	 * Enqueue all of our scripts and styles needed for our theme admin. These scripts will
	 * be used in conjunction with the custom code utilized within core.js
	 * @author aware
	 * @param type $hook_suffix
	 * @todo We should add in wp-pointer settings to guide users through the setup process
	 */
	function admin_enqueue_scripts($hook) {

		$scripts = array();
		$styles = array();

		if('widgets.php' == $hook) {
		    $scripts = array(
				'admin-controls' => array('/js/admin.js'),
		   );
		} else if ( 'appearance_page_theme_options' == $hook ) {

		    // Enque our Scripts

		    $scripts = array(
    				'jquery-cookie' 		=> array('/js/jquery.cookie.js', array('jquery') ),
    				'codemirror'			=> array('/inc/admin/codemirror/lib/codemirror.js'),
    				'codemirror-xml'		=> array('/inc/admin/codemirror/mode/xml/xml.js'),
    				'codemirror-css'		=> array('/inc/admin/codemirror/mode/css/css.js'),
    				'codemirror-js'			=> array('/inc/admin/codemirror/mode/javascript/javascript.js'),
    				'codemirror-htmlmixed'	=> array('/inc/admin/codemirror/mode/htmlmixed/htmlmixed.js'),
    				'admin-controls'		=> array('/js/admin.js', array('jquery', 'jquery-ui-core', 'jquery-ui-tabs') ),
    		   );

		    // Enqueue our Styles

		    wp_enqueue_style('thickbox');

		    $styles = array (
    			'codemirror_css' 		 => array('/inc/admin/codemirror/lib/codemirror.css'),
    			'launchpad_wp_admin_css' => array('/css/admin.css'),
    		  );
		 }

		wp_enqueue_script( array('jquery', 'editor', 'thickbox', 'media-upload', 'jquery-ui-core', 'jquery-ui-tabs') );

		if( !empty($scripts) ) {
		    foreach($scripts as $key => $script) {
		    	wp_register_script($key, get_template_directory_uri() . $script[0], $script[1] );
		    	wp_enqueue_script( $key );
		    }
		}

		if( !empty($styles) ) {
		    foreach($styles as $key => $style) {
				wp_register_style( $key, get_template_directory_uri() . $style[0] );
				wp_enqueue_style( $key );
		    }
		}

	    if( is_admin() ) {

	    	$wp_sidebars = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets

	    	$sidebars = array();

	    	foreach($wp_sidebars as $key => $sidebar) {
	    		$sidebars['sidebar_layout_' . $key] = get_option( 'launchpad_sidebar_layout_' . $key, '');
	    	}

	    	$sidebar_options = array(
	    		'sidebars' => $sidebars,
	    		'save_layout_nonce'	=> wp_create_nonce('save_layout'),
	    	);


		    wp_localize_script( 'admin-controls', 'sidebars', $sidebar_options );
	    }

	} // END Admin Scripts

	/**
	 * Embed our javascript and styles needed for our theme
	 * options page. This includes custom styling for our tabbed navigation
	 *
	 * @author aware
	 */
	function admin_head() {
		global $launchpad_options;
	?>
	  <script type="text/javascript">
	    //<![CDATA[
	    var launchpad = {
	        ajaxurl : "<?php echo admin_url( 'admin-ajax.php' ); ?>",
	        nonce : "<?php echo wp_create_nonce( 'launchpad-nonce' ) ?>"
	    };
	    //]]>
	  </script>
	<?php
	}

	/**
	 * admin_footer function.
	 *
	 * @author aware
	 * @access public
	 * @return void
	 */
	function admin_footer() {
	?>
	    <script>
	      //<![CDATA[
	      var footer_editor = CodeMirror.fromTextArea(document.getElementById("additional_footer_scripts"), {
	        lineNumbers: true,
	        matchBrackets: true,
	        mode: "text/html",
	        tabMode: "indent"
	      });

	      var head_editor = CodeMirror.fromTextArea(document.getElementById("additional_header_scripts"), {
	        lineNumbers: true,
	        matchBrackets: true,
	        mode: "text/html",
	        tabMode: "indent"
	      });
	      //]]>
	    </script>
	<?php
	}

	/**
	 * validate_theme_option function.
	 *
	 * @access public
	 * @param array $input (default: array())
	 * @param string $key (default: '')
	 * @param string $required (default: '')
	 * @return void
	 */
	function validate_theme_option($input = array(), $key = '', $required = '') {

		if( isset($required) && '' !== $required ) {
			if ( 'google_analytics_id' === $key && isset( $input[$key] ) ) {
				if (preg_match('/^ua-\d{4,9}-\d{1,4}$/i', $input[$key] ) ) {
				  $output[$key] = $input[$key];
				} else {
					return NULL;
				}
			} else {
				if ( isset($input[$key]) ) {

					// do some extra checks for backwards compatibilty with yes/no answers

					if ( 'yes' === $input[$key] || 'true' === $input[$key] ) {
						$input[$key] = TRUE;
					} elseif( 'no' === $input[$key] || 'false' === $input[$key] ) {
						$input[$key] = FALSE;
					}
				} else {
					return NULL;
				}
			}
		} else {
			if ( isset( $input[$key] ) && '' !== $key ) {

				// do some extra checks for backwards compatibilty with yes/no answers

				if ( 'yes' === $input[$key] || 'true' === $input[$key] ) {
					$input[$key] = TRUE;
				} elseif( 'no' === $input[$key] || 'false' === $input[$key] ) {
					$input[$key] = FALSE;
				}
			} else {
				return;
			}
		}

		return $input[$key];
	}

	/**
	 * launchpad_theme_options_validate function.
	 *
	 * @access public
	 * @param mixed $input
	 * @return void
	 */

	/**
	 * theme_options_validate function.
	 *
	 * @access public
	 * @param mixed $input
	 * @return void
	 */
	function theme_options_validate($input) {

		$options = array(
			'typekit_id'					=> '',
			'additional_footer_scripts'		=> '', // More Scripts
			'additional_header_scripts'		=> '',
			'terms_conditions'				=> '',
			'footer_info'					=> '',

			// Version 1.0 Options

			'typekit_async'					=> '',	// Asyncronously Load TypeKit

			// Version 1.1 Options

			'launchpad_tracking'			=> '',
		);

		$output = $defaults = self::get_default_theme_options();

		// Loop through each option and validate

		$invalid = array();

		foreach($options as $key=>$option) {

			$theme_option = self::validate_theme_option($input, $key, $option);

			if( NULL !== $theme_option ) {
				$output[$key] = $theme_option;
			} else {
				$invalid[$key] = $option;
			}
		}

		return apply_filters('launchpad_theme_options_validate', $output, $input, $defaults);
	}

}

/**
 * launchpad_get_theme_options function.
 *
 * @author aware
 * @access public
 * @return array of theme options
 */
function launchpad_get_theme_options() {
  return get_option('launchpad_theme_options', LaunchpadOptions::get_default_theme_options() );
}