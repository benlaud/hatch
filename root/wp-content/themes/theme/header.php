<?php
/**
 * Header Template
 *
 * @since 1.0
 *
 * @package {%= class_name %}
 * @subpackage Templates
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="shortcut icon" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/favicon.ico" type="image/x-icon">
	<!-- For non-Retina (@1× display) iPhone, iPod Touch, and Android 2.1+ devices: -->
	<link rel="apple-touch-icon-precomposed" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/apple-touch-icon-precomposed.png"><!-- 57×57px -->
	<!-- For the iPad mini and the first- and second-generation iPad (@1× display) on iOS ≤ 6: -->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/apple-touch-icon-72x72-precomposed.png">
	<!-- For the iPad mini and the first- and second-generation iPad (@1× display) on iOS ≥ 7: -->
	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/apple-touch-icon-76x76-precomposed.png">
	<!-- For iPhone with @2× display running iOS ≤ 6: -->
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/apple-touch-icon-114x114-precomposed.png">
	<!-- For iPhone with @2× display running iOS ≥ 7: -->
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/apple-touch-icon-120x120-precomposed.png">
	<!-- For iPad with @2× display running iOS ≤ 6: -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/apple-touch-icon-144x144-precomposed.png">
	<!-- For iPad with @2× display running iOS ≥ 7: -->
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/apple-touch-icon-152x152-precomposed.png">
	<!-- For iPhone 6 Plus with @3× display: -->
	<link rel="apple-touch-icon-precomposed" sizes="180x180" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/apple-touch-icon-180x180-precomposed.png">
	<!-- For Chrome for Android: -->
	<link rel="icon" sizes="192x192" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/touch-icon-192x192.png">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php do_action( 'hatch_after_body_tag' ); ?>

<div class="off-canvas-wrap" data-offcanvas>
	<div class="inner-wrap">

		<?php do_action( 'hatch_layout_start' ); ?>

		<?php get_template_part( 'includes/partials/navigation' ); ?>
		<section class="container" role="document">
			<?php do_action( 'hatch_after_header' ); ?>
