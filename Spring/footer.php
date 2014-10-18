<?php global $redux_demo; ?>
	<?php if ($redux_demo['links']) : ?>
	<div id="links">
		<ul class="link_content">
			<?php wp_list_bookmarks('title_li=&categorize=0'); ?>
			<div class="clear"></div>
		</ul>
	</div>
	<?php else :?>
	<?php endif; ?>
	</div>
	<div class="jiange"></div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){ 
    $("#loader").fadeOut("1000");
})
</script>
<?php if ( wp_is_mobile() ): ?>
<script src="<?php bloginfo('template_directory');?>/JS/jquery.sidr.min.js" type="text/javascript"></script>
<style type="text/css" media="screen">
.sidr {display:none;position:absolute;position:fixed;top:0;height:100%;z-index:999999;width:200px;overflow-x:none;overflow-y:auto;font-size:14px;background:#f0eeee;}
.sidr.left {left:-200px;right:auto}
.sidr ul {padding-top:12px;}
.sidr ul li {border-bottom: 1px dotted #e3e3e3;padding: 6px 0 5px 10px;overflow: hidden;list-style: none;font-size: 16px}
</style>
<div id="sidr">
  <?php wp_nav_menu( array( 'theme_location' => 'first-menu','container'=>'ul','fallback_cb'=>'Themeidea_nav_fallback','depth' => 2 )); ?>
</div>
<script>
$(document).ready(function() {
  $('#simple-menu').sidr();
});
</script>
<?php else :?>
	<?php wp_footer();?>
<?php endif ;?>
<p class="link-back2top" style="display: block;"><a href="#">Back to top</a></p>
<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url'); ?>/fancybox/fancybox.css" />
<script type="text/javascript" src="<?php bloginfo('template_url');?>/fancybox/mousewheel.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/fancybox/fancyboxmin.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/fancybox/easing.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
<div class="tongji"><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_4236629'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/stat.php%3Fid%3D4236629' type='text/javascript'%3E%3C/script%3E"));</script></div>
</body>
</html>