<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php wp_title( '|', true, 'right' ); ?></title>

    <link rel="icon" href="<?php echo get_stylesheet_directory_uri() ; ?>/img/icons/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_stylesheet_directory_uri() ; ?>/img/icons/apple-touch-icon-144x144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_stylesheet_directory_uri() ; ?>/img/icons/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_stylesheet_directory_uri() ; ?>/img/icons/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri() ; ?>/img/icons/apple-touch-icon-precomposed.png">

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

  <nav class="tab-bar show-for-small-only">
    <section class="right-small">
      <a class="right-off-canvas-toggle menu-icon" ><span></span></a>
    </section>
    
    <section class="middle tab-bar-section">
      <?php bloginfo( 'name' ); ?>
    </section>
  </nav>

  <aside class="right-off-canvas-menu">
  	<?php hatch_mobile_off_canvas(); ?>
  </aside>

  <?php get_template_part('includes/partials/navigation'); ?>

<section class="container" role="document">
  <?php do_action('hatch_after_header'); ?>