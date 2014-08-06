<?php
/* Template Name: Bright Dfp Punkte Tabelle
 * Description: neuer DFP Table (1. September 2013)
 * Author: Sebastian Schmid sebastian.schmid@100und1.com
*/

add_action('wp_head', 'hue_template_style');
function hue_template_style() {
?>
<style type="text/css">
	.page #content ul.tab-container { margin:0; background:#F6F6F6; }
	.tab-container li { display: inline-block; background: #b1b1b1; width: 49%; margin-left:2%; }
	.tab-container li:first-child { margin-left:0; }
	.tab-container li { display: inline-block; margin-bottom: 10px; }
	.tab-container li.current { margin-bottom:0; padding-bottom: 10px; }
	.tab-container li a { display:block; padding: 10px; text-align: center; color:white; }

	.bright-courselist { box-shadow:0 0; -webkit-box-shadow:0 0; -moz-box-shadow:0 0; -ms-filter:0; background: #b1b1b1; padding-bottom:20px; }
	.bright-courselist .dfp-table { background:#fff; margin:0 20px; }
	.bright-courselist .description { margin: 20px; color:white; }
	table thead { border:0; }
	table tr { border:0; }
	table tr.odd { background:#f5f5f5; }
	.bright-courselist td { border:0; }
	table tr th { border:0;}
	.bright-courselist th { padding:0.5em; font-size:1em; background: transparent; }
	.bright-courselist td { padding:0.5em; }
</style>
<script>
(function(a){a.tools=a.tools||{version:"v1.2.7"},a.tools.tabs={conf:{tabs:"a",current:"current",onBeforeClick:null,onClick:null,effect:"default",initialEffect:!1,initialIndex:0,event:"click",rotate:!1,slideUpSpeed:400,slideDownSpeed:400,history:!1},addEffect:function(a,c){b[a]=c}};var b={"default":function(a,b){this.getPanes().hide().eq(a).show(),b.call()},fade:function(a,b){var c=this.getConf(),d=c.fadeOutSpeed,e=this.getPanes();d?e.fadeOut(d):e.hide(),e.eq(a).fadeIn(c.fadeInSpeed,b)},slide:function(a,b){var c=this.getConf();this.getPanes().slideUp(c.slideUpSpeed),this.getPanes().eq(a).slideDown(c.slideDownSpeed,b)},ajax:function(a,b){this.getPanes().eq(0).load(this.getTabs().eq(a).attr("href"),b)}},c,d;a.tools.tabs.addEffect("horizontal",function(b,e){if(!c){var f=this.getPanes().eq(b),g=this.getCurrentPane();d||(d=this.getPanes().eq(0).width()),c=!0,f.show(),g.animate({width:0},{step:function(a){f.css("width",d-a)},complete:function(){a(this).hide(),e.call(),c=!1}}),g.length||(e.call(),c=!1)}});function e(c,d,e){var f=this,g=c.add(this),h=c.find(e.tabs),i=d.jquery?d:c.children(d),j;h.length||(h=c.children()),i.length||(i=c.parent().find(d)),i.length||(i=a(d)),a.extend(this,{click:function(d,i){var k=h.eq(d),l=!c.data("tabs");typeof d=="string"&&d.replace("#","")&&(k=h.filter("[href*=\""+d.replace("#","")+"\"]"),d=Math.max(h.index(k),0));if(e.rotate){var m=h.length-1;if(d<0)return f.click(m,i);if(d>m)return f.click(0,i)}if(!k.length){if(j>=0)return f;d=e.initialIndex,k=h.eq(d)}if(d===j)return f;i=i||a.Event(),i.type="onBeforeClick",g.trigger(i,[d]);if(!i.isDefaultPrevented()){var n=l?e.initialEffect&&e.effect||"default":e.effect;b[n].call(f,d,function(){j=d,i.type="onClick",g.trigger(i,[d])}),h.removeClass(e.current),k.addClass(e.current);return f}},getConf:function(){return e},getTabs:function(){return h},getPanes:function(){return i},getCurrentPane:function(){return i.eq(j)},getCurrentTab:function(){return h.eq(j)},getIndex:function(){return j},next:function(){return f.click(j+1)},prev:function(){return f.click(j-1)},destroy:function(){h.off(e.event).removeClass(e.current),i.find("a[href^=\"#\"]").off("click.T");return f}}),a.each("onBeforeClick,onClick".split(","),function(b,c){a.isFunction(e[c])&&a(f).on(c,e[c]),f[c]=function(b){b&&a(f).on(c,b);return f}}),e.history&&a.fn.history&&(a.tools.history.init(h),e.event="history"),h.each(function(b){a(this).on(e.event,function(a){f.click(b,a);return a.preventDefault()})}),i.find("a[href^=\"#\"]").on("click.T",function(b){f.click(a(this).attr("href"),b)}),location.hash&&e.tabs=="a"&&c.find("[href=\""+location.hash+"\"]").length?f.click(location.hash):(e.initialIndex===0||e.initialIndex>0)&&f.click(e.initialIndex)}a.fn.tabs=function(b,c){var d=this.data("tabs");d&&(d.destroy(),this.removeData("tabs")),a.isFunction(c)&&(c={onBeforeClick:c}),c=a.extend({},a.tools.tabs.conf,c),this.each(function(){d=new e(a(this),b,c),a(this).data("tabs",d)});return c.api?d:this}})(jQuery);

jQuery(function($) {
	$(".tab-container").tabs(".tab-content > .article-container");
	// make whole box clickable
	// $('article').css("cursor", "pointer");
	// $('body').on('click', 'article', function(e) {
	// 	window.location.href = $('a:first-child', this).attr("href");
	// 	return false;
	// });
});

Bright.addHook('after_load', function() {
	setTimeout( function() {
	// jQuery(document).ready(function($) {
		$ = jQuery;
		table = $(".bright-courselist table").attr("id", "tab1");
		
		header = $('<ul class="tab-container"><li><a href="#tab1">Nicht abgeschlossen</a></li><li><a href="#tab2">Abgeschlossen</a></li></ul>');
		// header = $('<ul class="tab-container"><li>Nicht abgeschlossen</li><li>Abgeschlossen </li></ul>');
		$(".bright-courselist").prepend(header);
		
		clone = $(".bright-courselist table").clone().attr("id", "tab2");
		$(".bright-courselist").append(clone);

		/* Abgeschlossene
		******************/
		$("td:nth-child(4)", table).filter(function(i) {
			return $(this).text() != "Nein";
		}).parent().remove(); // tr's

		$("td:nth-child(5)", table).remove();
		$("th:nth-child(5)", table).remove();
		$("td:nth-child(4)", table).remove();
		$("th:nth-child(4)", table).remove();

		/* Nicht Abgeschlossene
		************************/
		$("td:nth-child(4)", clone).filter(function(i) {
			return $(this).text() == "Nein";
		}).parent().remove(); // tr's
		$("td:nth-child(4)", clone).remove();
		$("th:nth-child(4)", clone).remove();

		if ( !clone.find("td").length ) { // keine Kurse abgeschlossen...
			// clone.find("th").remove();
			clone.find("thead tr").html("<th>Bis jetzt haben Sie keine Kurse abgeschlossen.</th>");
		}

		$(".tab-container").tabs(".dfp-table",
			{ tabs: 'li' });

		$("tr:odd").addClass("odd");
	}, 500);
});
</script>
<?php
}

function dequeue_unwanted_scripts() {
	wp_dequeue_script( 'jquery-data-tables' );
	wp_dequeue_script( 'jquery-data-tables-column-filter' );  
}
add_action('wp_enqueue_scripts', 'dequeue_unwanted_scripts', 100);


/* overwrite bright template */
// global $dfp_header;
global $bright_embedder_templates;
$dfp_header =<<<EOF
		<th class="kurs">Kurs</th>
		<th class="art">Art</th>
		<th class="fach">Fach</th>
		<th class="points_earned">Abgeschlossen</th>
		<th>Bestätigung</th>
		<th class="points_available">Punkte</th>
EOF;


$bright_embedder_templates['medmed_dfp_table'] = <<<EOF
<div class="description">
<p>
DFP Punkte zur Verfügung: {{#total_dfp_points_available this}}{{/total_dfp_points_available}}<br>
DFP Punkte erworben: {{#total_dfp_points_earned this}}{{/total_dfp_points_earned}}
</p>
</div>
<table class="dfp-table">
<colgroup>
			 <col span="1" style="width: 50%;">
			 <col span="1" style="width: 20%;">
			 <col span="1" style="width: 10%;">
			 <col span="1" style="width: 10%;">
			 <col span="1" style="width: 10%;">
		</colgroup>	   
	<thead>
	{$dfp_header}
	</thead>
{{#sort courses sortBy="title"}}
{{#if custom.dfp_points_available}}
	<tr>
		<td>
{{#if custom.course_url}}
<a href="{{custom.course_url}}">{{title}}</a>
{{else}}
{{title}}
{{/if}}<span style="display: none">{{sc_course_id}}</span>
		</td>
		<td>{{custom.Art}}</td>
		<td>{{custom.Fach}}</td>
		<td>{{#course_completed_text this}}{{/course_completed_text}}</td>
		<td>{{#mm_certificate_link this}}{{/mm_certificate_link}}</td>
		<td>{{custom.dfp_points_available}}</td>
	</tr>
{{/if}}
{{/sort}}
	<tfoot>
	{$dfp_header}
	</tfoot>
	</tr>
</table>
EOF;


get_header(); ?>
	<div id="content">
		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'page' ); ?>
			<?php comments_template( '', true ); ?>
		<?php endwhile; // end of the loop. ?>

	</div><!-- end #content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>