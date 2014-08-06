<?php
/**
 * The main template file.
 *
 * @package Waipoua
 * @since Waipoua 1.0
 */

get_header(); ?>
<div id="content-wrap"><?php if (function_exists('wooslider')) echo do_shortcode('[wooslider tag="featured" slider_type="posts" slideshow_speed="5.1" smoothheight="true" control_nav="true" direction_nav="false"  overlay="full" link_title="true" size="large" display_excerpt="false" layout="text-right"]'); ?>
	<div id="content">
		<?php /* Start the Loop */ ?>
		<?php global $query_string;
			query_posts( $query_string . '&ignore_sticky_posts=1' ); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; // end of the loop. ?>
		<?php wp_reset_query(); // reset the query ?>

		<?php /* Display navigation to next/previous pages when applicable, also check if WP pagenavi plugin is activated */ ?>
		<?php if(function_exists('wp_pagenavi')) : wp_pagenavi(); else: ?>
			<?php waipoua_content_nav( 'nav-below' ); ?>	
		<?php endif; ?>

	</div><!-- end #content -->

		<?php $options = get_option('waipoua_theme_options');
			if( $options['theme_layout'] == 'content-featured-sidebar' ) : ?>

				<?php get_template_part( 'featured'); ?>

		<?php endif  ?>

</div><!-- end #content-wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
