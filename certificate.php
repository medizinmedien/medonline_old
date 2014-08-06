<?php
/**
 * Template Name: Certificate
 * Description: Certificate
 *
 * @package Waipoua
 * @since Waipoua 1.0
 */

get_header(); ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

		<?php endwhile; // end of the loop. ?>

