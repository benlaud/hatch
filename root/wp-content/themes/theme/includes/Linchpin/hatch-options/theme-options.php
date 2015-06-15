<?php global $hatch_options ?>
<div id="theme-options">
	<h3><?php _e( 'Theme Options', 'hatch' ); ?></h3>
	<table class="form-table">
		<tbody>
		<tr valign="top">
			<th scope="row"><?php _e( 'Additional Footer Information', 'hatch' ); ?></th>
			<td>
				<div>
					<label class="screen-reader-text" for="footer_info"><span><?php _e( 'Additional Footer Information', 'hatch' ); ?></span></label>

					<?php $footer_info = '';

					if ( !empty( $hatch_options[ 'footer_info' ] ) ) {
						$footer_info = $hatch_options[ 'footer_info' ];
					}

					wp_editor( html_entity_decode( $footer_info ), 'footerinfo', array( 'textarea_name' => "hatch_theme_options[footer_info]", "textarea_rows" => 8 ) ); ?>

					<p class="description"><?php printf( __( 'Free area to place additional information in your footer such as address information or extra phone numbers', 'hatch' ) ); ?></p>
				</div>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e( 'Terms & Conditions', 'hatch' ); ?></th>
			<td>
				<div>
					<label class="screen-reader-text" for="footer_info"><span><?php _e( 'Terms & Conditions', '{%= text_domain %}' ); ?></span></label>

					<?php $terms = '';

					if ( !empty( $hatch_options[ 'terms_conditions' ] ) ) {
						$terms = $hatch_options[ 'terms_conditions' ];
					}

					wp_editor( html_entity_decode( $terms ), 'termsconditions', array( 'textarea_name' => "hatch_theme_options[terms_conditions]", "textarea_rows" => 4, "teeny" => true ) ); ?>

					<p class="description"><?php printf( __( 'This is an area for simple copyright or other terms. Your &copy; Year and Company name will automatically be added to your site unless you input your own terms above', 'hatch' ) ); ?></p>
				</div>
			</td>
		</tr>
		</tbody>
	</table>
</div>