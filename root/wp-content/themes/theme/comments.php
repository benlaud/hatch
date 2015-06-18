<?php
/**
 * Base template for all comments
 *
 * @todo This file could definitely use some cleanup -aware
 *
 * @since {%= base_version %}
 *
 * @package {%= class_name %}
 * @subpackage Comments
 */

?>

<?php do_action( 'hatch_comments_before' ); ?>

<?php

/**
 * Build out our comments
 *
 * @param mixed $comment Global comments argument.
 * @param array $args Comments args.
 * @param int   $depth How deep the thread should go.
 */
function hatch_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>">
			<header class="row comment-author">
				<div class="small-2 text-center columns">
					<?php echo get_avatar( $comment, $size = '56' ); ?>
				</div>
				<div class="small-10 columns">
					<div class="author-meta">
						<?php printf( esc_html( __( '<cite class="fn">%s</cite>', '{%= text_domain %}' ) ), get_comment_author_link() ) ?> on
						<time datetime="<?php comment_date( 'c' ); ?>"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf( esc_html( __( '%1$s', '{%= text_domain %}' ) ), get_comment_date(),  get_comment_time() ) ?></a></time>
						<?php edit_comment_link( __( '(Edit)', '{%= text_domain %}' ), '', '' ) ?>
					</div>

					<?php if ( $comment->comment_approved === 0 ) : ?>
		       			<div class="notice">
							<p class="bottom"><?php esc_html_e( 'Your comment is awaiting moderation.', '{%= text_domain %}' ) ?></p>
		          		</div>
					<?php endif; ?>

					<section class="comment">
						<?php comment_text() ?>
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
					</section>
				</div>
			</header>
			<?php if ( $comment->comment_approved === 0 ) : ?>
				<div class="notice">
					<p class="bottom"><?php esc_html_e( 'Your comment is awaiting moderation.', '{%= text_domain %}' ); ?></p>
				</div>
			<?php endif; ?>

			<section class="comment">
				<?php comment_text() ?>
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</section>

		</article>
	</li>
<?php } ?>

<?php
// Do not delete these lines.
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' === basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( esc_html__( 'Please do not load this page directly. Thanks!', '{%= text_domain %}' ) );
}

if ( post_password_required() ) { ?>
<section id="comments">
	<div class="notice">
		<p class="bottom"><?php esc_html_e( 'This post is password protected. Enter the password to view comments.', '{%= text_domain %}' ); ?></p>
	</div>
</section>
<?php
	return;
}
?>
<?php // Customize the respond form below. ?>
<?php if ( have_comments() ) : ?>
	<section id="comments">
		<h3><?php comments_number( __( 'No Responses to', '{%= text_domain %}' ), __( 'One Response to', '{%= text_domain %}' ), __( '% Responses to', '{%= text_domain %}' ) ); ?> &#8220;<?php the_title(); ?>&#8221;</h3>
		<ol class="commentlist">
			<?php wp_list_comments( 'type=comment&callback=Hatch_comments' ); ?>
		</ol>
		<footer>
			<nav id="comments-nav">
				<div class="comments-previous"><?php previous_comments_link( __( '&larr; Older comments', '{%= text_domain %}' ) ); ?></div>
				<div class="comments-next"><?php next_comments_link( __( 'Newer comments &rarr;', '{%= text_domain %}' ) ); ?></div>
			</nav>
		</footer>
	</section>
<?php endif; ?>
<?php if ( comments_open() ) : ?>
<section id="respond">
	<h3><?php comment_form_title( __( 'Leave a Reply', '{%= text_domain %}' ), __( 'Leave a Reply to %s', '{%= text_domain %}' ) ); ?></h3>
	<p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
	<?php if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) : ?>
	<p><?php printf( __( 'You must be <a href="%s">logged in</a> to post a comment.', '{%= text_domain %}' ), wp_login_url( get_permalink() ) ); ?></p>
	<?php else : ?>
	<form action="<?php echo get_option( 'siteurl' ); ?>/wp-comments-post.php" method="post" id="commentform">
		<?php if ( is_user_logged_in() ) :
			global $user_identity; ?>
			<p><?php printf( esc_html( __( 'Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', '{%= text_domain %}' ) ), get_option( 'siteurl' ), $user_identity ); ?> <a href="<?php esc_attr_e( wp_logout_url( get_permalink() ) ); ?>" title="<?php esc_attr_e( 'Log out of this account', '{%= text_domain %}' ); ?>"><?php esc_html_e( 'Log out &raquo;', '{%= text_domain %}' ); ?></a></p>
		<?php else : ?>
		<p>
			<label for="author"><?php esc_html_e( 'Name', '{%= text_domain %}' ); if ( $req ) : esc_html_e( ' (required)', '{%= text_domain %}' ); endif; ?></label>
			<input type="text" class="five" name="author" id="author" value="<?php esc_attr_e( $comment_author ); ?>" size="22" tabindex="1" <?php if ( $req ) : ?>aria-required="true"<?php endif; ?>>
		</p>
		<p>
			<label for="email"><?php esc_html_e( 'Email (will not be published)', '{%= text_domain %}' ); if ( $req ) : esc_html_e( ' (required)', '{%= text_domain %}' ); endif; ?></label>
			<input type="text" class="five" name="email" id="email" value="<?php esc_attr_e( $comment_author_email ); ?>" size="22" tabindex="2" <?php if ( $req ) : ?>aria-required="true"<?php endif; ?>>
		</p>
		<p>
			<label for="url"><?php esc_html_e( 'Website', '{%= text_domain %}' ); ?></label>
			<input type="text" class="five" name="url" id="url" value="<?php esc_attr_e( $comment_author_url ); ?>" size="22" tabindex="3">
		</p>
		<?php endif; ?>
		<p>
			<label for="comment"><?php esc_html_e( 'Comment', '{%= text_domain %}' ); ?></label>
			<textarea name="comment" id="comment" tabindex="4"></textarea>
		</p>
		<p id="allowed_tags" class="small"><strong>XHTML:</strong> <?php esc_html_e( 'You can use these tags:','{%= text_domain %}' ); ?> <code><?php echo allowed_tags(); ?></code></p>
		<p><input name="submit" class="button" type="submit" id="submit" tabindex="5" value="<?php esc_attr_e( 'Submit Comment', '{%= text_domain %}' ); ?>"></p>
		<?php comment_id_fields(); ?>
		<?php do_action( 'comment_form', get_the_ID() ); ?>
	</form>
	<?php endif; ?>
</section>
<?php endif; ?>

<?php do_action( 'hatch_comments_after' );
