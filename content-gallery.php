<?php
/**
 * The template for displaying posts in the Gallery Post Format
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

	<div class="entry-content">
		<?php the_content( __( 'Read more &rarr;', 'waipoua' ) ); ?>
	</div><!-- end entry-content -->

	<footer class="entry-meta">
		<ul>
			<?php // Include Share-Btns
				$options = get_option('waipoua_theme_options');
				if( $options['share-posts'] ) : ?>
				<?php get_template_part( 'share'); ?>
			<?php endif; ?>
		</ul>
	</footer><!-- end .entry-meta -->

</article><!-- end post -<?php the_ID(); ?> -->
