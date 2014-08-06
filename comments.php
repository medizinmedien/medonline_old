<?php
/**
 * The template for displaying Comments.
 *
 * @package Waipoua
 * @since Waipoua 1.0
 */
?>

	<div id="comments">
		<?php if ( post_password_required() ) : ?>
		<div class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'waipoua' ); ?></div>
	</div><!-- end #comments -->
	
	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h3 id="comments-title">
			<?php
				printf( _n( '1 comment', '%1$s comments', get_comments_number(), 'waipoua' ),
					number_format_i18n( get_comments_number() ) );
			?>
			<span><a href="#reply-title"><?php _e( '&raquo; Write a comment', 'waipoua' ); ?></a></span>
		</h3>

		<ol class="commentlist">
				<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use waipoua_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define waipoua_comment() and that will be used instead.
				 */
				wp_list_comments( array( 'callback' => 'waipoua_comment' ) );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr;  Older Comments', 'waipoua' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments  &rarr;', 'waipoua' ) ); ?></div>
		</nav><!-- end #comment-nav -->
		<?php endif; // check for comment navigation ?>

	<?php endif; ?>

	<?php comment_form (
		array(
			'comment_notes_after' =>__( '<p class="comment-note">Required fields are marked <span class="required">*</span>.</p>', 'waipoua'),
			'comment_field'  => '<p class="comment-form-comment"><label for="comment">' . _x( 'Message <span class="required">*</span>', 'noun', 'waipoua' ) . 			'</label><br/><textarea id="comment" name="comment" rows="8"></textarea></p>',
			'label_submit'	=> __( 'Send Comment', 'waipoua' ))
		); 
	?>

	</div><!-- end #comments -->
