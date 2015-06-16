<?php
/**
 * Hero/Slideshow area
 *
 * @package Hatch
 * @since 1.0
 *
 * Template Part: Hero
 */

?>
<header id="homepage-hero" role="banner">
	<div class="row">
		<div class="small-12 medium-7 columns">
			<h1><a href="<?php esc_attr_e( get_bloginfo( 'url' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<h4 class="subheader"><?php bloginfo( 'description' ); ?></h4>
		</div>

		<div class="medium-6 columns end">
			<a class="download large button hide-for-small" href="https://github.com/linchpinagency/hatch">Download Hatch</a>
		</div>

		<div class="floatingyeti show-for-medium-up">
			<img data-cfsrc="http://foundation.zurb.com/assets/img/homepage/hero-image.svg" alt="Foundation Yeti" src="http://foundation.zurb.com/assets/img/homepage/hero-image.svg">
		</div>
	</div>
</header>
