<?php
/**
 * The themes Header file.
 *
 * Displays all of the <head> section and everything up till </header>
 *
 * @package Waipoua
 * @since Waipoua 1.0
 */
?><!DOCTYPE html>
<!--[if lte IE 8]>
<html class="ie" <?php language_attributes(); ?>>
<![endif]-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );
	
	// Add the blog name.
	bloginfo( 'name' );
	
	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'waipoua' ), max( $paged, $page ) );
?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/style.css" /> 
<?php if(!preg_match('/(?i)msie [1-8]/',$_SERVER['HTTP_USER_AGENT'])) { ?>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/off_page_nav.css" />
<?php   																	    
	$options = waipoua_get_theme_options(); 													     
	$link_color = $options['link_color'];   													     
	?>      																	     
	<style type="text/css"> 															     
		#site-nav-open, 																     
		#site-nav-close {       															     
			background-color: <?php echo $link_color; ?>;   											     
		}       																	    
	</style>
<?php } else {?>
 <style type="text/css">
        #site-nav-open,
        #site-nav-close { 
                display: none;
        }    
</style>
<?php } ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php 
	$options = get_option('waipoua_theme_options');
	if( $options['custom_favicon'] != '' ) : ?>
<link rel="shortcut icon" type="image/ico" href="<?php echo $options['custom_favicon']; ?>" />
<?php endif  ?>
<?php 
	$options = get_option('waipoua_theme_options');
	if( $options['custom_apple_icon'] != '' ) : ?>
<link rel="apple-touch-icon" href="<?php echo $options['custom_apple_icon']; ?>" />
<?php endif  ?>
  
<script src="<?php  echo get_stylesheet_directory_uri(); ?>/js/modernizr.js"></script>

<?php
	wp_enqueue_script('jquery');
	if ( is_singular() && get_option( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' );
	wp_head();
?>
	<link rel="apple-touch-icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/touch-icon-iphone.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('stylesheet_directory'); ?>/images/touch-icon-ipad.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('stylesheet_directory'); ?>/images/touch-icon-iphone4.png" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
</head>

<body <?php body_class(); ?>>

 <!-- (wrappers for off-canvas navigation) -->
	<?php if(!preg_match('/(?i)msie [1-8]/',$_SERVER['HTTP_USER_AGENT'])): ?>
        <div id="outer-wrap">
        <div id="inner-wrap">
	<?php endif; ?>

        <nav id="nav" role="navigation">
                <div id="site-nav-wrap" class="clearfix">
                        <div id="site-nav-container">
							<a href="<?php echo home_url( '/' ); ?>" id="home-btn"><?php _e('Home', 'waipoua') ?></a>
							<a href="#nav-mobile" id="mobile-menu-btn"><?php _e('Menu', 'waipoua') ?></a>
							<nav id="site-nav">
								<?php 
									if (has_nav_menu( 'primary-signup' ) && !is_user_logged_in()) :
										wp_nav_menu( array( 'theme_location' => 'primary-signup' ) );
									else :
										wp_nav_menu( array( 'theme_location' => 'primary' ) );
									endif;
								?>
								<?php get_search_form(); ?>
							</nav><!-- end #site-nav -->
                        </div><!-- end #site-nav-container -->
                </div><!-- end #site-nav-wrap -->
                <div id="site-nav-close"></div>
        </nav>

        <div id="wrap" class="clearfix">

                        <a href="#nav" id="site-nav-open">
                                <?php _e('Menu', 'waipoua') ?>
                        </a>
		<?php 

        if (function_exists('jnewsticker_display')) {
		  add_option( 'header-ticker-id', '0', '', 'yes' );

		  $hide_dfp_ticker = get_post_meta( $post->ID, 'hide-dfp-ticker', true );
		  $header_ticker_id = get_post_meta( $post->ID, 'header-ticker-id', true );
		  if ($header_ticker_id == '') {
			$header_ticker_id = 0;
		  }

		  if ($hide_dfp_ticker == '' and is_user_logged_in()) {
			jnewsticker_display( $header_ticker_id ); 
		  }
		}
		?>
		<div id="wrap2">

		<header id="header">
			<div id="branding">
				<div id="site-title">
					<?php $options = get_option('waipoua_theme_options');
						if( $options['custom_logo'] != '' ) : ?>
						<a href="<?php echo home_url( '/' ); ?>" class="logo"><img src="<?php echo $options['custom_logo']; ?>" alt="<?php bloginfo('name'); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
					<?php else: ?>
						<h1><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
						<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
					<?php endif  ?>
				</div><!-- end #site-title -->

				<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
					<div class="header-widget-area">
						<?php dynamic_sidebar( 'sidebar-2' ); ?>
					</div><!-- end .header-widget-area -->
				<?php endif; ?>
			</div><!-- end #branding -->
		</header><!-- end #header -->
		<?php
			global $ics_error_message;
			if ($ics_error_message) {
				?><div id="error-message"><?php echo $ics_error_message;?></div><?php 
			}
		
