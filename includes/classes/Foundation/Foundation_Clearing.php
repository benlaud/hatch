<?php

class Foundation_Clearing {

	function __construct() {
		add_action( 'after_setup_theme', array($this, 'setup_gallery_shortcode') );

//		apply_filters( 'wp_get_attachment_link',  array($this, 'add_link_class') );
	}

	function add_link_class( $markup, $id, $size, $permalink ) {
	    global $post;
	    if ( ! $permalink )
	        $markup = str_replace( '<a href', '<a class="th" href', $markup );

	    return $markup;
	}

	public function setup_gallery_shortcode() {
		remove_shortcode('gallery', array( $this, 'gallery_shortcode' ) ); 		          //First remove the standard wordpress gallery shortcode action
		add_shortcode(   'gallery', array( $this, 'foundation_gallery_shortcode' ) );     //Add our foundation clearing gallery shortcode action here
	}

	/**
	* Gallery Shortcodes
	*
	* Called by add_shortcode( 'gallery' )
	* Heavily derived from the zurb-foundation-5-clearing-gallery plugin from the WordPress repo
	*
	* Replaced Wordpress default gallery action with Zurb Foundation Clearing Feature.
	* This is essentially a copy of the wordpress gallery function with some adjustments to
	* add in the foundation clearing feature.
	*
	* You can add a gallery just as you normally would including setting up the number of columns.
	* The function supports up to 6 columns for any gallery, it will fall back to 4 column grid for
	* invalid values.
	*
	* MOBILE: Note that the foundation mobile classes have already been added for each gallery size.
	*			That said you can use the filters below to alter any foundation classes applied to the
	*			block grid.
	*
	* FILTERS:
	*			foundation_gallery_large_class 		->	Foundation large class for grid block
	*			foundation_gallery_small_class 		->	Foundation small class for grid block
	*			foundation_gallery_image_caption 	->	Filter caption for each image in gallery
	*			foundation_gallery_li_class 		->	Filter class applied to each <li> item in block grid
	*			foundation_gallery_output 			->	Filter overall html output for gallery
	*
	*/
	public function foundation_gallery_shortcode($attr) {

		$post = get_post();

		static $instance = 0;
		$instance++;

		if ( ! empty( $attr['ids'] ) ) {
			// 'ids' is explicitly ordered, unless you specify otherwise.
			if ( empty( $attr['orderby'] ) )
				$attr['orderby'] = 'post__in';
			$attr['include'] = $attr['ids'];
		}

		// Allow plugins/themes to override the default gallery template.
		$output = apply_filters('post_gallery', '', $attr);
		if ( $output != '' )
			return $output;

		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( !$attr['orderby'] )
				unset( $attr['orderby'] );
		}

		$gallery_defaults = array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post ? $post->ID : 0,
			'itemtag'    => 'dl',
			'icontag'    => 'dt',
			'captiontag' => 'dd',
			'columns'    => 4,
			'size'       => 'thumbnail',
			'include'    => '',
			'exclude'    => ''
		);

		//Filter gallery deafults
		$gallery_defaults = apply_filters( 'foundation_gallery_shortcode_args', $gallery_defaults );

		extract(shortcode_atts($gallery_defaults, $attr, 'gallery'));

		$id = intval($id);
		if ( 'RAND' == $order )
			$orderby = 'none';

		if ( !empty($include) ) {
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( !empty($exclude) ) {
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		} else {
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}

		if ( empty($attachments) )
			return '';

		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
				$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
			return $output;
		}

		$itemtag = tag_escape($itemtag);
		$captiontag = tag_escape($captiontag);
		$icontag = tag_escape($icontag);
		$valid_tags = wp_kses_allowed_html( 'post' );
		if ( ! isset( $valid_tags[ $itemtag ] ) )
			$itemtag = 'dl';
		if ( ! isset( $valid_tags[ $captiontag ] ) )
			$captiontag = 'dd';
		if ( ! isset( $valid_tags[ $icontag ] ) )
			$icontag = 'dt';

		$columns = intval($columns);

		//Set bloch grid class based on columns
		switch( $columns ) {
			case 1:
				$block_class = apply_filters( 'foundation_gallery_large_class', 'large-block-grid-1', $columns ) . ' ' . apply_filters( 'foundation_gallery_small_class', 'small-block-grid-3', $columns );
				break;
			case 2:
				$block_class = apply_filters( 'foundation_gallery_large_class', 'large-block-grid-2', $columns ) . ' ' . apply_filters( 'foundation_gallery_small_class', 'small-block-grid-3', $columns );
				break;
			case 3:
				$block_class = apply_filters( 'foundation_gallery_large_class', 'large-block-grid-3', $columns ) . ' ' . apply_filters( 'foundation_gallery_small_class', 'small-block-grid-3', $columns );
				break;
			case 4:
				$block_class = apply_filters( 'foundation_gallery_large_class', 'large-block-grid-4', $columns ) . ' ' . apply_filters( 'foundation_gallery_small_class', 'small-block-grid-3', $columns );
				break;
			case 5:
				$block_class = apply_filters( 'foundation_gallery_large_class', 'large-block-grid-5', $columns ) . ' ' . apply_filters( 'foundation_gallery_small_class', 'small-block-grid-3', $columns );
				break;
			case 6:
				$block_class = apply_filters( 'foundation_gallery_large_class', 'large-block-grid-6', $columns ) . ' ' . apply_filters( 'foundation_gallery_small_class', 'small-block-grid-3', $columns );
				break;
			default:
				$block_class = apply_filters( 'foundation_gallery_large_class', 'large-block-grid-4', 'default' ) . ' ' . apply_filters( 'foundation_gallery_small_class', 'small-block-grid-3', 'default' );
				break;
		}

		$gallery_container = "<div class='row'><div class='large-12 columns'><ul class='clearing-thumbs gallery galleryid-{$id} {$block_class}' data-clearing>";

		$output = apply_filters( 'gallery_style', $gallery_container );

		$i = 0;
		foreach ( $attachments as $id => $attachment ) {
			if ( ! empty( $attr['link'] ) && 'file' === $attr['link'] )
				$image_output = wp_get_attachment_link( $id, $size, false, false );
			elseif ( ! empty( $attr['link'] ) && 'none' === $attr['link'] )
				$image_output = wp_get_attachment_image( $id, $size, false );
			else
				$image_output = wp_get_attachment_link( $id, $size, true, false );

			$image_output = wp_get_attachment_link( $id, $size, false, false );

			$image_meta  = wp_get_attachment_metadata( $id );

			//Cache image caption
			$caption_text = NULL;
			if ( trim($attachment->post_excerpt) ) {
				$caption_text = wptexturize($attachment->post_excerpt);
				$caption_text = apply_filters( 'foundation_gallery_image_caption', $caption_text, $attachment );
			}

			//Add caption to img tag
			$image_output = str_replace('<img', "<img data-caption='{$caption_text}'", $image_output);

			ob_start();
			?>
			<li class="<?php echo apply_filters( 'foundation_gallery_li_class', $columns, $attachment ); ?>">
				<?php echo $image_output; ?>
			</li>
			<?php
			$output.= ob_get_contents();
			ob_end_clean();

		}

		$output .= "</ul></div></div>";

		return apply_filters( 'foundation_gallery_output',$output, $columns, $attachment );
	}
}