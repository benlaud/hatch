<?php
/**
 * HatchCustomHeader
 *
 *
 * @package Hatch
 * @since 1.0
 */
class HatchCustomHeader {

	function __construct() {
		add_action( 'after_setup_theme', array( $this, 'custom_header_setup' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ), 999 );
		add_action( 'customize_register', array( $this, 'customize_register' ) );
	}

	/**
	 * customize_register function.
	 *
	 * @access public
	 * @param mixed $wp_customize
	 */
	function customize_register( $wp_customize ) {

		$wp_customize->add_setting( 'header_bg_color', array(
			'default' => '#074e68',
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_color_control',
			array(
				'label' => __( 'Header BG Color', 'hatch' ),
				'section' => 'colors',
				'settings' => 'header_bg_color',
			) ) );
	}

	/**
	 * wp_enqueue_scripts function.
	 *
	 * @access public
	 */
	function wp_enqueue_scripts() {

		$hero = '#homepage-hero {';
		$hero .= 'background-image:url(' . get_custom_header()->url . ');';
		$hero .= 'background-color:' . get_theme_mod( 'header_bg_color' ) . ';';
		$hero .= 'padding: 1.25rem 0;';
		$hero .= 'margin: -2rem 0 2rem;';
		$hero .= 'position: relative;';
		$hero .= 'text-align: left;';
		$hero .= 'height: auto;';
		$hero .= '}';

		$hero .= '#homepage-hero h1 a, #homepage-hero h4 {color:#' . get_header_textcolor() . '}';

		wp_add_inline_style( 'app-css', $hero );
	}

	/**
	 * custom_header_setup function.
	 *
	 * @access public
	 * @return void
	 */
	function custom_header_setup() {

		define( 'HEADER_TEXTCOLOR', 'FFF' );    // The default header text color
		define( 'HEADER_IMAGE', '' );            // By leaving empty, we allow for random image rotation.

		// The height and width of your custom header.
		// Add a filter to hatch_header_image_width and hatch_header_image_height to change these values.
		define( 'HEADER_IMAGE_WIDTH', apply_filters( 'hatch_header_image_width', 1000 ) );
		define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'hatch_header_image_height', 250 ) );

		// Turn on random header image rotation by default.

		$header_args = array(
			'width' => HEADER_IMAGE_WIDTH,
			'height' => HEADER_IMAGE_HEIGHT,
			'flex-height' => true,
			'flex-width' => true,
			'default-image' => 'http://foundation.zurb.com/assets/img/marquee-stars.svg',
			'uploads' => true,
			'admin-head-callback' => array( $this, 'launchpad_header_style' ),
			'admin-preview-callback' => array( $this, 'launchpad_admin_header_style' ),
		);

		add_theme_support( 'custom-header' );
	}
}

if ( !function_exists( 'hatch_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog
	 *
	 * @since _s 1.0
	 */
	function hatch_header_style() {

		// If no custom options for text are set, let's bail
		// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
		if ( HEADER_TEXTCOLOR == get_header_textcolor() )
			return;
		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
			<?php
				// Has the text been hidden?
				if ( 'blank' == get_header_textcolor() ) :
		?>
			.site-title,
			.site-description {
				position: absolute !important;
				clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
				clip: rect(1px, 1px, 1px, 1px);
			}

			<?php
					// If the user has set a custom color for the text use that
					else :
		?>
			.site-title a,
			.site-description {
				color: # <?php echo get_header_textcolor() ?> !important;
			}

			<?php endif; ?>
		</style>
	<?php
	}
endif; // launchpad_header_style

if ( !function_exists( 'hatch_admin_header_style' ) ) :
	/**
	 * Styles the header image displayed on the Appearance > Header admin panel.
	 *
	 * Referenced via add_custom_image_header() in hatch_setup().
	 *
	 * @derived _s 1.0
	 */
	function hatch_admin_header_style() {
		?>
		<style type="text/css">
			.appearance_page_custom-header #headimg {
				border: none;
			}

			#headimg h1,
			#desc {
			}

			#headimg h1 {
			}

			#headimg h1 a {
			}

			#desc {
			}

			#headimg img {
			}
		</style>
	<?php
	}
endif; // hatch_admin_header_style

if ( !function_exists( 'hatch_admin_header_image' ) ) :
	/**
	 * Custom header image markup displayed on the Appearance > Header admin panel.
	 *
	 * Referenced via add_custom_image_header() in launchpad_setup().
	 *
	 * @since hatch 1.0
	 * @derived from _s
	 */
	function hatch_admin_header_image() {
		?>
		<div id="headimg">
			<?php
			if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
				$style = ' style="display:none;"';
			else
				$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
			?>
			<h1><a id="name" <?php echo $style; ?> onclick="return false;"
				   href="<?php esc_attr_e( esc_url( home_url( '/' ) ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>

			<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
			<?php $header_image = get_header_image();
			if ( !empty( $header_image ) ) : ?>
				<img src="<?php esc_attr_e( esc_url( $header_image ) ); ?>" alt=""/>
			<?php endif; ?>
		</div>
	<?php
	}
endif; // hatch_admin_header_image