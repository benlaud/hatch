<?php

	// Display navigation to next/previous pages when applicable

?>
<?php if ( function_exists('FoundationPress_pagination') ) {
	FoundationPress_pagination('&laquo;', '&raquo;');
} else if ( is_paged() ) { ?>
	<nav id="post-nav">
		<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'FoundationPress' ) ); ?></div>
		<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'FoundationPress' ) ); ?></div>
	</nav>
<?php }