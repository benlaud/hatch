<?php
/**
 * Footer Template
 *
 * All stuff that should typically be in the footer.
 *
 * @since {%= base_version %}
 *
 * @package {%= class_name %}
 * @subpackage Templates
 */

?>
				</section>

				<?php do_action( 'hatch_footer_before' ); ?>

				<footer class="row">

					<?php do_action( 'hatch_footer_inner_before' ); ?>

					<?php dynamic_sidebar( 'footer-widgets' ); ?>

					<?php do_action( 'hatch_footer_inner_after' ); ?>

				</footer>

				<?php do_action( 'hatch_footer_after' ); ?>

				<a class="exit-off-canvas"></a>

				<?php do_action( 'hatch_layout_end' ); ?>

			</div>
		</div>

		<?php wp_footer(); ?>

		<?php
		/**
		 * Additional Footer Scripts is attached to this action
		 * If this action is removed from your Additional Footer Scripts
		 * area within the Theme Settings will no longer print to the
		 * front end of your theme
		 */
		do_action( 'hatch_body_before_close' ); ?>
	</body>
</html>
