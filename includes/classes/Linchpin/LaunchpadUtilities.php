<?php

/**
 * LaunchpadUtilities class.
 */
class LaunchpadUtilities {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {
		add_action( 'edit_category', array( $this, 'launchpad_category_transient_flusher' ) );
		add_action( 'save_post',     array( $this, 'launchpad_category_transient_flusher' ) );
	}

	/**
	 * launchpad_categorized_blog function.
	 * Returns true if a blog has more than 1 category.
	 *
	 * @access public
	 * @return bool
	 */
	static function launchpad_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'launchpad_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,

				// We only need to know if there is more than one category.
				'number'     => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'launchpad_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so test_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so test_categorized_blog should return false.
			return false;
		}
	}

	/**
	 * launchpad_category_transient_flusher function.
	 * Flush out the transients used in test_categorized_blog.
	 *
	 * @access public
	 * @return void
	 */
	function launchpad_category_transient_flusher() {
		delete_transient( 'launchpad_categories' ); // Like, beat it. Dig?
	}

	/**
	 * breadcrumbs function.
	 * Loosely based on http://cazue.com/articles/wordpress-creating-breadcrumbs-without-a-plugin-2013
	 *
	 * @access public
	 * @static
	 * @return void
	 */
	static function breadcrumbs() {
	    global $post; ?>

	    <ul class="breadcrumbs">
	    <?php if ( !is_home() ) { ?>

	        <li><a href="<?php echo get_option('home'); ?>"><?php _e('Home', 'launchpad'); ?></a></li>

			<?php if ( is_category() || is_single() ) : ?>

				<?php if ( $categories = get_the_category() ) : ?>
		    		<li><a href="<?php echo get_term_link( current( $categories ), 'category' ); ?>"><?php echo current( $categories )->name; ?></a></li>
		    	<?php endif; ?>

				<?php if ( is_single() ) : ?>
	    			<li><?php the_title(); ?></li>
	    		<?php endif; ?>

	        <?php elseif ( is_page() ) : ?>

	        	<?php if( $post->post_parent ) :
	                $anc = get_post_ancestors( $post->ID );
	                $title = get_the_title();
	                foreach ( $anc as $ancestor ) : ?>

	                    <li><a href="<?php echo get_permalink($ancestor); ?>" title="<?php echo get_the_title($ancestor); ?>"><?php echo get_the_title($ancestor); ?></a></li>

	                <?php endforeach; ?>

	                <li class="current"><?php echo $title; ?></li>

	            <?php else : ?>

	                <li class="current"><?php echo get_the_title(); ?></li>

	            <?php endif; ?>
	        <?php endif; ?>
	    <?php
	    } elseif ( is_tag() ) {
	    	single_tag_title();
	    } elseif ( is_day() ) { ?>
	    	<li>Archive for <?php the_time('F jS, Y'); ?></li>
	    <?php } elseif ( is_month() ) { ?>
	    	<li>Archive for <?php the_time('F, Y'); ?></li>
	    <?php } elseif ( is_year() ) { ?>
	    	<li>Archive for <?php the_time('Y'); ?></li>
	    <?php } elseif ( is_author() ) { ?>
	    	<li>Author Archive</li>
	    <?php } elseif ( isset($_GET['paged'] ) && !empty( $_GET['paged'] ) ) { ?>
	    	<li>Blog Archives</li>
	    <?php } elseif ( is_search() ) { ?>
	    	<li>Search Results</li>
	    <?php } ?>
	    </ul>
	    <?php
	}
}

/**
 * Launchpad_breadcrumbs function.
 *
 * @access public
 * @return void
 */
function Launchpad_breadcrumbs() {
	LaunchpadUtilities::breadcrumbs();
}

/**
 * launchpad_categorized_blog function.
 *
 * @access public
 * @return void
 */
function launchpad_categorized_blog() {
	LaunchpadUtilities::launchpad_categorized_blog();
}