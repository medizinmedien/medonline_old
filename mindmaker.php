<?php
/**
 * Template Name: Mind Maker Splash Sebastian
 * Description: The Splash Screen for Mind Master
 *
 * @package Waipoua
 * @since Waipoua 1.0
 */

$imgpath = get_stylesheet_directory_uri()."/images/mindmaker/";

add_action('wp_head', 'mindmaker_css');

function mindmaker_css() {
	$imgpath = get_stylesheet_directory_uri()."/images/mindmaker/";
	?>
		<style>
			header, footer { display:none; }

			#content { top:-60px; }
			html, body { position:relative; }
			
			img, a { display:block; }
			img { width:100%; height:auto; }
			.mindmaker { position:absolute; }
			.whitebox { position:absolute; width:95%; left:2.5%; bottom:60px; }

			html, body, #outer-wrap, #inner-wrap, #wrap, #content { height:100%; }
			body { background: url(<?php echo $imgpath ?>bg-1.jpg) center center no-repeat; background-size: cover; }
			.mobile { display:none; }
			.mindmaker { top:100px; right:100px; }

			@media screen and (max-width:960px) {
				html, body, #outer-wrap, #wrap { height:auto; }
				body { background:none; }
				.mobile { display:block; }
				.desktop { display:none; }
				.mindmaker { max-width: 20%; bottom: 37%; left: 2%; top:auto; right:auto; }
				#content { height:100%; }
				#wrap { background: url(<?php echo $imgpath ?>bg-1.jpg) center center no-repeat; background-size: cover;
					position: absolute; left:33.3333%; top:0; height:100%;
				}
			}
			@media screen and (max-width:600px) {
				.mindmaker { display:none; }
			}

			@media screen and (max-width:480px) {
				#wrap { left:42.9%; }
			}
			@media screen and (max-height:479px) {
				.mindmaker { display:none; }
			}
		</style>
	<?php
}

get_header(); ?>


	<div id="content" class="fullwidth">

<?php 
	Global $current_user;
	$token=get_user_meta($current_user->ID, '_paneltoken', true);
	$auth_url = "meinung.medonline.at/start.php?token=".$token;
?>
		<div class="mindmaker"><img src="<?php echo $imgpath ?>mindmaker.png" alt=""></div>
		<div class="whitebox desktop"><a href="http://<?php echo $auth_url; ?>"><img src="<?php echo $imgpath ?>whitebox.png" alt=""></a></div>
		<div class="whitebox mobile"><a href="http://<?php echo $auth_url; ?>"><img src="<?php echo $imgpath ?>whitebox-sm.png" alt=""></a></div>
	</div><!-- end #content .fullwidth -->

<?php get_footer(); ?>
