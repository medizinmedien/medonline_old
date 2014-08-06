<?php
/**
 * Template Name: Startseite neu
 * Description: die neue Startseite (1. September 2013)
 * Author: Sebastian Schmid sebastian.schmid@100und1.com
 */


function hue_styles() {
	wp_enqueue_style( 'style-name', get_stylesheet_directory_uri() . '/hue-startseite-neu.css' );
}

add_action( 'wp_enqueue_scripts', 'hue_styles' );

add_action('wp_head', 'hue_template_style', 100);
function hue_template_style() {
	// $imgdir = get_stylesheet_directory_uri().'/images/startseite-neu/';
?>
<script>
/*
 * jQuery Tools v1.2.7 - The missing UI library for the Web
 * tabs/tabs.js
 */
(function(a){a.tools=a.tools||{version:"v1.2.7"},a.tools.tabs={conf:{tabs:"a",current:"current",onBeforeClick:null,onClick:null,effect:"default",initialEffect:!1,initialIndex:0,event:"click",rotate:!1,slideUpSpeed:400,slideDownSpeed:400,history:!1},addEffect:function(a,c){b[a]=c}};var b={"default":function(a,b){this.getPanes().hide().eq(a).show(),b.call()},fade:function(a,b){var c=this.getConf(),d=c.fadeOutSpeed,e=this.getPanes();d?e.fadeOut(d):e.hide(),e.eq(a).fadeIn(c.fadeInSpeed,b)},slide:function(a,b){var c=this.getConf();this.getPanes().slideUp(c.slideUpSpeed),this.getPanes().eq(a).slideDown(c.slideDownSpeed,b)},ajax:function(a,b){this.getPanes().eq(0).load(this.getTabs().eq(a).attr("href"),b)}},c,d;a.tools.tabs.addEffect("horizontal",function(b,e){if(!c){var f=this.getPanes().eq(b),g=this.getCurrentPane();d||(d=this.getPanes().eq(0).width()),c=!0,f.show(),g.animate({width:0},{step:function(a){f.css("width",d-a)},complete:function(){a(this).hide(),e.call(),c=!1}}),g.length||(e.call(),c=!1)}});function e(c,d,e){var f=this,g=c.add(this),h=c.find(e.tabs),i=d.jquery?d:c.children(d),j;h.length||(h=c.children()),i.length||(i=c.parent().find(d)),i.length||(i=a(d)),a.extend(this,{click:function(d,i){var k=h.eq(d),l=!c.data("tabs");typeof d=="string"&&d.replace("#","")&&(k=h.filter("[href*=\""+d.replace("#","")+"\"]"),d=Math.max(h.index(k),0));if(e.rotate){var m=h.length-1;if(d<0)return f.click(m,i);if(d>m)return f.click(0,i)}if(!k.length){if(j>=0)return f;d=e.initialIndex,k=h.eq(d)}if(d===j)return f;i=i||a.Event(),i.type="onBeforeClick",g.trigger(i,[d]);if(!i.isDefaultPrevented()){var n=l?e.initialEffect&&e.effect||"default":e.effect;b[n].call(f,d,function(){j=d,i.type="onClick",g.trigger(i,[d])}),h.removeClass(e.current),k.addClass(e.current);return f}},getConf:function(){return e},getTabs:function(){return h},getPanes:function(){return i},getCurrentPane:function(){return i.eq(j)},getCurrentTab:function(){return h.eq(j)},getIndex:function(){return j},next:function(){return f.click(j+1)},prev:function(){return f.click(j-1)},destroy:function(){h.off(e.event).removeClass(e.current),i.find("a[href^=\"#\"]").off("click.T");return f}}),a.each("onBeforeClick,onClick".split(","),function(b,c){a.isFunction(e[c])&&a(f).on(c,e[c]),f[c]=function(b){b&&a(f).on(c,b);return f}}),e.history&&a.fn.history&&(a.tools.history.init(h),e.event="history"),h.each(function(b){a(this).on(e.event,function(a){f.click(b,a);return a.preventDefault()})}),i.find("a[href^=\"#\"]").on("click.T",function(b){f.click(a(this).attr("href"),b)}),location.hash&&e.tabs=="a"&&c.find("[href=\""+location.hash+"\"]").length?f.click(location.hash):(e.initialIndex===0||e.initialIndex>0)&&f.click(e.initialIndex)}a.fn.tabs=function(b,c){var d=this.data("tabs");d&&(d.destroy(),this.removeData("tabs")),a.isFunction(c)&&(c={onBeforeClick:c}),c=a.extend({},a.tools.tabs.conf,c),this.each(function(){d=new e(a(this),b,c),a(this).data("tabs",d)});return c.api?d:this}})(jQuery);

jQuery(function($) {
	// change wall posts to articles for pagination and border
	// jQuery(".wall_post_div").each(function() { jQuery(this).wrap("article") } );

	// $("html,body").animate({
	// 	scrollTop:0
	// }, 1000);

	$(".tab-container").tabs(".tab-content > .article-container");

	if ($(".hue-start-tabbox .tab-container").css("display") == "block" ) {
		$(".tab-container").data('tabs').click(3); // select highlights
		$(".tab-container .tab:first").remove(); // remove generic news

	}
	// make whole box clickable
	// $('article').css("cursor", "pointer");
	// $('body').on('click', 'article', function(e) {
	// 	window.location.href = $('a:first-child', this).attr("href");
	// 	return false;
	// });
	tabapis = {};
	$(".tab-content > .article-container").each(function(k, v) {
		var container = $(this);
		// set unique id
		container.attr('id', 'article-container-'+container.index());
		articles = container.find("article");
		container.prepend("<div class='pagination'></div>");
		// container.append("<div class='pagination'></div>");
		page = 0;
		for(var i = 0; i < articles.length; i+=5) {
			page++;
			container.find(".pagination").append("<a href='#'>" +page+ "</a>");
			articles.slice(i, i+5).wrapAll("<div class='page'></div>");
		}
		
		var api = container.find(".pagination").tabs('#'+container.attr('id')+' > .page', { } );
		// debugger;
		tabapis[container.attr('id')] = api.data('tabs');
		console.log(container.attr('id'));
		if ( page > 1) {
			container.find(".pagination").prepend("<a class='prev' href='#'>&lt;</a>").find('.prev').click(function() {
				tabapis[$(this).parents(".article-container").attr('id')].prev();
				return false;
			});
			container.find(".pagination").append("<a class='next' href='#'>&gt;</a>").find('.next').click(function() {
				tabapis[$(this).parents(".article-container").attr('id')].next();
				return false;
			});
		} else {
			container.find(".pagination").hide();
		}

	});


});
</script>


<?php
} // end of function hue_template_style()

get_header();
?>
<a id="site-nav-wrap"></a>
<!-- <div id="content-wrap"> this one causes roughly 2/3rds width-->
	<a class="logout" href="<?php echo wp_logout_url(); ?>" title="Abmelden">Abmelden</a>
	<div id="content" class="fullwidth">
		<div class="hue-start-linkbox-container">
			<div class="hue-start-linkbox-container">
				<?php $home = get_home_url(); ?>
				<div class="hue-start-linkbox">
					<a href="<?php echo $home; ?>/dfp-punkte/"><span>DFP-Fortbildung</span></a>
				</div>
				<div class="hue-start-linkbox">
					<a href="<?php echo $home; ?>/leitlinien/"><span>Leitlinien</span></a>
				</div>
				<div class="hue-start-linkbox">
					<a href="<?php echo $home; ?>/stellenanzeigen/"><span>Karriere</span></a>
				</div>
				<div class="hue-start-linkbox">
					<a href="<?php echo $home; ?>/oegim-flip/"><span>ÖGIM FLIP</span></a>
				</div>
				<div class="hue-start-linkbox">
					<a href="<?php echo $home; ?>/produktfortbildung/"><span>Produkt&shy;fortbildung</span></a>
				</div>
				<div class="hue-start-linkbox">
					<a href="<?php echo $home; ?>/fachbereich-uebersicht/"><span>Fachbereiche</span></a>
				</div>
				<div class="hue-start-linkbox">
					<a href="<?php echo $home; ?>/startseite-neu/"><span>smartDOC</span></a>
				</div>
				<div class="hue-start-linkbox">
					<a href="<?php echo $home; ?>/ami-info/"><span>AMI-Info</span></a>
				</div>
			</div>
		</div>



		<div class="hue-start-tabbox">
			<?php
				// $cats = array(
				// 	39, // Allgemein medizin
				// 	49, // Innere
				// 	65, // Psych
				// 	16, // Neuro
				// 	44, // Derma
				// 	68, // Uro
				// 	60, // Pneumo
				// 	45, // Gyn
				// 	352, // Onko
				// 	// Kolumnen: (Rubrik)
				// 	// Apamed ?
				// 	501, // Depesche
				// 	// FDW
				// 	213, // Recht
				// 	71 // Praxisführung
				// );
			?>
			<div class="tab-container">
				<div class="tab current">
					<p>Neu</p>
				</div>
				<div class="tab current">
					<p>Highlights</p>
				</div>
				<div class="tab current">
					<p>DFP-Kurse</p>
				</div>
				<div class="tab current">
					<p>Fall der Woche</p>
				</div>
				<div class="tab current">
					<p>Produktfortbildung</p>
				</div>
				<div class="tab current">
					<p>Kolumne: Stelzl & Promussas</p>
				</div>
				<div class="tab current">
					<p>Interviews</p>
				</div>
				<div class="tab current">
					<p>Recht &amp; Praxis</p>
				</div>
				<div class="tab current">
					<p>Kongresse</p>
				</div>
				<div class="tab current">
					<p>News</p>
				</div>
				<div class="tab current">
					<p>Aktivitäten</p>
				</div>
			</div>
			<?php
			$query_strings_common = "posts_per_page=25&ignore_sticky_posts=1&";
			
			// Query Parameters: http://codex.wordpress.org/Class_Reference/WP_Query#Category_Parameters
			$query_strings = array(
				// "cat=-39", // Alles ausser Allgemein-Medizin = Aktuell
				"tag_id=4", // Hightlights = tag:featured
				"cat=76,", // DFP-Artikel
				"cat=792", // Fall der Woche
				"cat=8", // eDetails = Produktfortbildungen				
				"tag_ID=624", // Kolumne = Stelzl und Promussas
				"tag_id=79", // Interviews = tag:interview nicht vergessen Video-interviews und Experteninterview taggen
				"cat=213,249,71", // Recht,Praxis-Marketing und Führung, müssen in Tags umgewandelt werden, Achtung Sidebar 
				"tag-ID=501", // Kongresse = Kongress Depesche
				"tag_ID=2191", // News = ? Kerstin
				"_STREAM_"
				// "cat=39", // Allg
				// "cat=49", // Innere
				// "cat=65", // Psy
				// "cat=16", // Neuro
				// "cat=44", // Derma
				// "cat=68", // Uro
				// "cat=60", // Pneumo
				// "cat=352"  // Onko
			); ?>
			<div class="tab-content">
				<div class="article-container">
					<?php // Allgemeine Kategorie = 1. Tab
						query_posts('posts_per_page=25&ignore_sticky_posts=1&cat=-39' ); // Alles ausser Allg. = Aktuell
						while ( have_posts() ) : the_post();
							get_template_part( 'huecontent', 'box' );
						endwhile;
					?>
				</div>

				<?php
					foreach ( $query_strings as $query_string ) :
						// content for each tab
				?>
					<div class="article-container">
						<?php
							if ( $query_string == "_STREAM_" ) {
								echo do_shortcode('[symposium-stream]');
							} else {
								query_posts($query_strings_common.$query_string );
								while ( have_posts() ) : the_post();
									if ( "tag_id=1349" == $query_string ) { // special handling für videos
										get_template_part( 'huecontent', 'boxvideo');
									} else {
										get_template_part( 'huecontent', 'box' );
									}
								endwhile;
							}
						?>
					</div>
				<?php endforeach; ?>
			</div>
			<?php wp_reset_query(); // reset the query ?>
		</div>
	</div><!-- end #content -->
<!-- </div> --><!-- end #content-wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
