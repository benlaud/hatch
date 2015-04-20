<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php wp_title( '|', true, 'right' ); ?></title>

    <link rel="icon" href="<?php echo get_stylesheet_directory_uri() ; ?>/assets/icons/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_stylesheet_directory_uri() ; ?>/assets/icons/apple-touch-icon-144x144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_stylesheet_directory_uri() ; ?>/assets/icons/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_stylesheet_directory_uri() ; ?>/assets/icons/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri() ; ?>/assets/icons/apple-touch-icon-precomposed.png">

    <?php wp_head(); ?>

    <!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="css/ie8.css" />
	<![endif]-->
  </head>
  <body <?php body_class(); ?>>
  <?php do_action('hatch_after_body'); ?>

  <div class="off-canvas-wrap" data-offcanvas>
  <div class="inner-wrap">

  <?php do_action('hatch_layout_start'); ?>

  <?php get_template_part('includes/partials/navigation'); ?>

<section class="container" role="document">
  <?php do_action('hatch_after_header'); ?>