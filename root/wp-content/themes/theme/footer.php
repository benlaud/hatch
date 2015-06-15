<?php
/**
 * Footer Template
 *
 * All stuff that should typically be in the footer.
 *
 * @since 1.0
 *
 * @package {%= class_name %}
 * @subpackage Templates
 */

?>

</section>
<footer class="row">
	<?php do_action( 'hatch_before_footer' ); ?>
	<?php dynamic_sidebar( 'footer-widgets' ); ?>
	<?php do_action( 'hatch_after_footer' ); ?>
</footer>
<a class="exit-off-canvas"></a>
	<?php do_action( 'hatch_layout_end' ); ?>
	</div>
</div>
<?php wp_footer(); ?>
<?php do_action( 'hatch_before_closing_body' ); ?>
</body>
</html>
