<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package Waipoua
 * @since Waipoua 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<aside class="entry-details">
		<ul class="clearfix">
			<li class="entry-date"><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a></li>
			<li class="entry-comments"><?php comments_popup_link( __( '0 comments', 'waipoua' ), __( '1 comment', 'waipoua' ), __( '% comments', 'waipoua' ), 'comments-link', __( 'comments off', 'waipoua' ) ); ?></li>
			<li class="entry-edit"><?php edit_post_link(__( 'Edit Post &rarr;', 'waipoua') ); ?></li>
		</ul>
	</aside><!--end .entry-details -->
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!--end .entry-header -->

	<div class="entry-content clearfix">
		<!--<?php if ( has_post_thumbnail() ): ?>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
		<?php endif; ?> -->
		<?php the_content(); ?>	
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'waipoua' ), 'after' => '</div>' ) ); ?>
	</div><!-- end .entry-content -->
<footer class="entry-meta">
<ul><?php $tags_list = get_the_tag_list( '', ', ' ); 
		if ( $tags_list ): ?>	
			<li class="entry-tags"><span><?php _e('Tagged:', 'waipoua') ?></span> <?php the_tags( '', ', ', '' ); ?></li>
			<?php endif; ?>
			</ul>
<?php if ( get_post_format() ) : // Show author bio only for standard post format posts ?>	
		<?php else: ?>
			<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
				<div class="author-info">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'waipoua_author_bio_avatar_size', 80 ) ); ?>
					<div class="author-description">
						<h3><?php printf( __( 'Posted by %s', 'waipoua' ), "<a href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='author'>" . get_the_author() . "</a>" ); ?></h3>
						<p><?php the_author_meta( 'description' ); ?></p>
					</div><!-- end .author-description -->			
				</div><!-- end .author-info -->
			<?php endif; ?>
		<?php endif; ?>
	</footer>
<!-- end .entry-meta -->
</article><!-- end .post-<?php the_ID(); ?> -->
