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


    <?php /* Favicon mark-up (http://realfavicongenerator.net/) */ ?>
	<link rel="apple-touch-icon" sizes="57x57" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/android-chrome-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/manifest.json">
	<link rel="shortcut icon" href="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/favicon.ico">
	<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?>">
	<meta name="application-name" content="<?php bloginfo( 'name' ); ?>">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/mstile-144x144.png">
	<meta name="msapplication-config" content="<?php esc_attr_e( get_stylesheet_directory_uri() ); ?>/assets/icons/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">

    <?php wp_head(); ?>

    <!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="css/ie8.css" />
	<![endif]-->
</head>
<body <?php body_class(); ?>>

<?php do_action( 'hatch_after_body_tag' ); ?>

<div class="off-canvas-wrap" data-offcanvas>
	<div class="inner-wrap">

		<?php do_action( 'hatch_layout_start' ); ?>

		<?php get_template_part( 'includes/partials/navigation' ); ?>
		<section class="container" role="document">
			<?php do_action( 'hatch_after_header' ); ?>
