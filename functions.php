<?php

/**
 * Frank: Disable backend Google font "Open Sans" - requested by Thomas on 04/06/2014
 */
function google_fonts_load_disable( $styles ) {
	$styles->add( 'open-sans', '' ); // Backend font
}
add_action( 'wp_default_styles', 'google_fonts_load_disable', 5 );


/**
 * Display Posts Shortcode, Featured Posts
 * Only display featured posts using [display_posts is_featured="1"]. Assumes
 * you've already set up a checkbox in metabox with key of 'be_featured'.
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/code/featured-posts-display-posts-shortcode/
 *
 * Added by Frank on 03/14/04 - requested by Simon for testings
 */
function be_display_posts_featured( $args, $atts ) {
	if( isset( $atts['is_featured'] ) )
		$args['meta_query'] = array(
			array(
				'key'   => 'be_featured',
				'value' => 1
			)
		);
	return $args;
}
add_filter( 'display_posts_shortcode_args', 'be_display_posts_featured', 10, 2 );


// When needed:
// add_filter('widget_text', 'do_shortcode');


/**
 * Add Column Classes to Display Posts Shortcodes
 * @author Bill Erickson
 * @link http://www.billerickson.net/code/add-column-classes-to-display-posts-shortcode
 *
 * Added by Frank on 03/13/04 - requested by Simon for testings
 */
function be_display_post_class( $classes, $post, $listing, $atts ) {
	if( !isset( $atts['columns'] ) )
		return $classes;
	$columns = array( '', '', 'one-half', 'one-third', 'one-fourth', 'one-fifth', 'one-sixth' );
	$classes[] = $columns[$atts['columns']];
	if( 0 == $listing->current_post || 0 == $listing->current_post % $atts['columns'] )
		$classes[] = 'first';
	return $classes;
}
add_filter( 'display_posts_shortcode_post_class', 'be_display_post_class', 10, 4 );


function improved_trim_excerpt($text) {
        global $post;
        if ( '' == $text ) {
                $text = get_the_content('');
                $text = apply_filters('the_content', $text);
                $text = str_replace('\]\]\>', ']]&gt;', $text);
                $text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
                $text = strip_tags($text, '<p>,<span>,<a>,<em>,<br>,<strong>,<blockquote>');
		/*add <img> above if needed for*/
                $excerpt_length = 45; // Old value: 60 - Requested by Simon on 03/14/2014; changed by Frank.
                $words = explode(' ', $text, $excerpt_length + 1);
                if (count($words)> $excerpt_length) {
                    array_pop($words);
                    array_push($words, '<a class="more" href="'. get_permalink($post->ID) . '">' . '/ Weiterlesen&nbsp;&rarr;' . '</a>');
                    $text = implode(' ', $words);
                }
        } else {
        	// Frank: Shorten even manual excerpts to a max-length of 45 words.
        	// Requested by Simon on 03/14/2014.
        	$excerpt_length = 45;
        	$words = explode( ' ', $text, $excerpt_length + 1 );
        	if( count( $words ) == $excerpt_length + 1 && strpos( $words[ $excerpt_length ], ' ' ) !== false ) {
        		array_pop( $words );
        		$words[ $excerpt_length - 1 ] = trim( $words[ $excerpt_length - 1 ], '.,' ) . ' &hellip; ';
        		$text = implode( ' ', $words );
        	}
        }
        return medonline_correct_html( $text ); // Frank: avoid messed up excerpts.
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'improved_trim_excerpt');

/**
 * Helper func to return correctly closed HTML tags.
 * 
 * By Frank on 17th of April, 2014.
 * Requirement: PHP >= 5.3.6
 *
 * (More accurate solution, but much more expensive:
 *  http://www.pjgalbraith.com/2011/11/truncating-text-html-with-php/)
 */
function medonline_correct_html( $maybe_wrong_html ) {

	// German Umlauts issue.
	$maybe_wrong_html = '<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /></head>' . $maybe_wrong_html;

	$html = new DOMDocument();
	$html->loadHTML( $maybe_wrong_html );
	$html = $html->saveHTML();
	$html = preg_split( '/<body>(.*)<\/body>/s', $html, -1, PREG_SPLIT_DELIM_CAPTURE );
	$html = $html[1];
	return $html;
}


function ajx_sharpen_resized_files( $resized_file ) {

    $image = wp_load_image( $resized_file );
    if ( !is_resource( $image ) )
        return new WP_Error( 'error_loading_image', $image, $file );

    $size = @getimagesize( $resized_file );
    if ( !$size )
        return new WP_Error('invalid_image', __('Could not read image size'), $file);
    list($orig_w, $orig_h, $orig_type) = $size;

    switch ( $orig_type ) {
        case IMAGETYPE_JPEG:
            $matrix = array(
                array(-1, -1, -1),
                array(-1, 16, -1),
                array(-1, -1, -1),
            );

            $divisor = array_sum(array_map('array_sum', $matrix));
            $offset = 0;
            imageconvolution($image, $matrix, $divisor, $offset);
            imagejpeg($image, $resized_file,apply_filters( 'jpeg_quality', 90, 'edit_image' ));
            break;
        case IMAGETYPE_PNG:
            return $resized_file;
        case IMAGETYPE_GIF:
            return $resized_file;
    }

    return $resized_file;
}

add_filter('image_make_intermediate_size', 'ajx_sharpen_resized_files',900);
add_filter('widget_text', 'do_shortcode');

// added by rob to fix IE8 issues
add_action('wp_enqueue_scripts', 'medonline_ie8_css');
function medonline_ie8_css() {
	wp_register_style('ie8', get_stylesheet_directory_uri().'/ie.css', array(), time(), 'all');
	wp_enqueue_style('ie8');
}



/* Sebastian, 25.06.2013
/* Task: show different Menus on wp-signup.php

/* #1 add class to body when on wp-signup.php page
/* for use in css / js
**************************************************/

add_action('signup_header','hue_signup_extras');

function hue_signup_extras() {
    // this is a function which is only started in the header, if you're on wp-signup.php
    add_filter('body_class','hue_body_class_signup');
}

function hue_body_class_signup($classes) {
    $classes[] = 'signup';
    return $classes;
}

/* #2 function to detect login page
/* for use in php
**************************************************/

function is_signup_page() {
    return in_array($GLOBALS['pagenow'], array('wp-signup.php'));
}

/* #3 register the alternate Menus
**************************************************/

register_nav_menu( "primary-signup", "Alternative Haupt-Navigation, nur auf wp-signup.php" );
register_nav_menu( "footer-signup", "Alternative Footer-Navigation, nur auf wp-signup.php" );

/* Task: show different Menus on wp-signup.php END */

/* add_filter( ‘auth_cookie_expiration’, 'keep_me_logged_in_for_1_year'); */

/* function keep_me_logged_in_for_1_year( $expirein ) { */
/*   return 31556926; // 1 year in seconds */
/* } */


/* for MMA #364 */
/* add_filter( 'comments_template', 'my_comments_template', 999 ); */

/* function my_comments_template( $template ) { */

/*   if ( !is_user_logged_in() ) */
/* 	$template = locate_template( array( 'comments-error.php' ) ); */

/*   return $template; */
/* } */

add_filter( 'comments_template', 'my_comments_template', 999 );

function my_comments_template( $template ) {

	if ( !is_user_logged_in() && 1 === get_current_blog_id() )
		$template = locate_template( array( 'comments-error.php' ) );

	return $template;
}