<?php
/**
 * The default template for displaying content
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
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'waipoua' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	</header><!--end .entry-header -->

	<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>		
		<div class="entry-summary"><?php if ( function_exists( 'get_the_image' ) ) { get_the_image(array( 'width' => 100, 'height' => 100, 'thumbnail_id_save' => false, 'image_class' => 'wp-post-image','default_image' => 'http://medonline.at/wp-content/uploads/medONLINE_128.png' )); } ?>
			<?php the_excerpt(); ?>
		</div><!-- end .entry-summary -->

	<?php else : ?>
			
	<div class="entry-content clearfix"><?php if ( function_exists( 'get_the_image' ) ) { get_the_image(array( 'width' => 150, 'height' => 150, 'thumbnail_id_save' => true, 'image_class' => 'wp-post-image', 'default_image' => 'http://medonline.at/wp-content/uploads/medONLINE_128.png' )); } ?>
		<?php the_excerpt( __( 'Read more &rarr;', 'waipoua' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'waipoua' ), 'after' => '</div>' ) ); ?>
	</div><!-- end .entry-content -->

	<?php endif; ?>
	<!-- end .entry-meta -->
</article><!-- end post -<?php the_ID(); ?> -->
