<?php
/**
 * The default template for displaying content. Used within single and index/archive/search.
 *
 * @package hatch
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php hatch_entry_meta(); ?>
	</header>
	<div class="entry-content">
		<?php the_content(__('Continue reading...', 'hatch')); ?>
	</div>
	<footer>
		<?php $tag = get_the_tags(); if (!$tag) { } else { ?><p><?php the_tags(); ?></p><?php } ?>
	</footer>
	<ul class="button-group utility right">
		<?php edit_post_link( __('Edit Content', 'hatch') , '<li class="tiny button">', '</li>'); ?>
	</ul>
	<hr />
</article>
