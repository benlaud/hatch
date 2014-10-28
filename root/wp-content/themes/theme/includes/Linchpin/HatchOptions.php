<?php

/**
 * This is the main controller for the Hatch theme options
 * Some items are derived from other "blank" themes including
 * Blank, _s, and Roots etc.
 */

class HatchOptions {

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
		if ( false === hatch_get_theme_options() ) {
			add_option('hatch_theme_options', self::get_default_theme_options());
		}

		register_setting('hatch_options', 'hatch_theme_options', array( &$this, 'theme_options_validate' ) );
	}


	function validate_required_settings() {
		global $hatch_options;
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
            'additional_footer_scripts'		=> '',
            'additional_header_scripts'		=> '',

            // Version 2.0 Additional Defaults

            'typekit_async'				 	=> FALSE,
        );

        return apply_filters('hatch_default_theme_options', $default_theme_options);
	}

	/**
	* Add in our options pages. This includes a specific display for activation as well
	* as our regular theme options.
	* @author aware
	*/

	function theme_options_add_page() {

		$hatch_options = hatch_get_theme_options();
		$hatch_activation_options = hatch_get_theme_activation_options();

		if ($hatch_activation_options['first_run']) {

			$theme_page = add_theme_page(
				__('Additional Options', 'hatch'),
				__('Additional Options', 'hatch'),
				'edit_theme_options',
				'theme_options',
				array( &$this, 'theme_options_render_page' )
			);
		}

		add_action( 'admin_footer-' . $theme_page, array( &$this, 'admin_footer' ) );
		add_action( 'admin_head-' . $theme_page, array( &$this, 'admin_head' ) );
	}

	/**
	 * Render our theme options page. Trying to match as many of the common structures
	 * and styles within the wordpress admin. The more we stay inline with the admin
	 * the more likely we are to not confuse the client.
	 *
	 * @author aware
	 * @return string HTML output of our options page.
	 */

	function theme_options_render_page() {
	    global $hatch_options, $linchpin_classes_dir; ?>

	    <div class="wrap">
	        <?php screen_icon(); ?>
	        <div id="hatch-wrap">

                <?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'display_options'; ?>

                <h2 class="nav-tab-wrapper">
                    <a href="?page=theme_options&tab=script_options" class="nav-tab <?php echo $active_tab == 'script_options' ? 'nav-tab-active' : ''; ?>"><?php printf(__('Additional Scripts', 'hatch'), get_current_theme()); ?></a>
                </h2>

              <?php settings_errors(); ?>

              <form method="post" action="options.php">

              <?php settings_fields('hatch_options');
              $hatch_options = hatch_get_theme_options();
              $hatch_default_options = self::get_default_theme_options();

              if( $active_tab == 'display_options' ) {
                  require_once locate_template( $linchpin_classes_dir . 'hatch-options/theme-options.php');

		      } elseif ( $active_tab == 'script_options' ) {
                  require_once locate_template( $linchpin_classes_dir . 'hatch-options/integration-options.php');

		      } elseif ( $active_tab == 'script_options' ) {
                  require_once locate_template( $linchpin_classes_dir . 'hatch-options/extra-options.php');
              } ?>
                  <input type="hidden" value="1" name="hatch_theme_options[first_run]" />
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
    				'jquery-cookie' 		=> array('/js/jquery.cookie/jquery.cookie.js', array('jquery') ),
    				'codemirror'			=> array('/includes/codemirror/lib/codemirror.js'),
    				'codemirror-xml'		=> array('/includes/codemirror/mode/xml/xml.js'),
    				'codemirror-css'		=> array('/includes/codemirror/mode/css/css.js'),
    				'codemirror-js'			=> array('/includes/codemirror/mode/javascript/javascript.js'),
    				'codemirror-htmlmixed'	=> array('/includes/codemirror/mode/htmlmixed/htmlmixed.js'),
    				'admin-controls'		=> array('/js/admin.js', array('jquery', 'jquery-ui-core', 'jquery-ui-tabs') ),
    		   );

		    $styles = array (
    			'codemirror_css' 		 => array('/includes/codemirror/lib/codemirror.css'),
    			'launchpad_wp_admin_css' => array('/css/admin.css'),
    		  );
		 }

		wp_enqueue_script( array('jquery', 'editor', 'jquery-ui-core', 'jquery-ui-tabs') );

		if( !empty($scripts) ) {
		    foreach($scripts as $key => $script) {
                if( !empty( $script[0] ) && !empty( $script[1] ) ) {
                    wp_register_script($key, get_stylesheet_directory_uri() . $script[0], $script[1]);
                    wp_enqueue_script($key);
                }
		    }
		}

		if( !empty($styles) ) {
		    foreach($styles as $key => $style) {
                if( !empty( $style[0] ) ) {
                    wp_register_style($key, get_stylesheet_directory_uri() . $style[0]);
                    wp_enqueue_style($key);
                }
		    }
		}

	    if( is_admin() ) {

	    	$wp_sidebars = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets

	    	$sidebars = array();

	    	foreach($wp_sidebars as $key => $sidebar) {
	    		$sidebars['sidebar_layout_' . $key] = get_option( 'hatch_sidebar_layout_' . $key, '');
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
	    var hatch = {
	        ajaxurl : "<?php echo admin_url( 'admin-ajax.php' ); ?>",
	        nonce : "<?php echo wp_create_nonce( 'hatch-nonce' ) ?>"
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

			// Version 1.1 Options

			'hatch_tracking'			=> '',
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

		return apply_filters('hatch_theme_options_validate', $output, $input, $defaults);
	}

}

/**
 * hatch_get_theme_options function.
 *
 * @author aware
 * @access public
 * @return array of theme options
 */
function hatch_get_theme_options() {
    return get_option('hatch_theme_options', HatchOptions::get_default_theme_options() );
}