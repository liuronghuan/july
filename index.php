<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php if ( is_home() ) { ?><title><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?></title><?php } ?>
<?php if ( is_search() ) { ?><title>搜索结果 | <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_single() ) { ?><title><?php echo trim(wp_title('',0)); ?> | <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_page() ) { ?><title><?php echo trim(wp_title('',0)); ?> | <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_category() ) { ?><title><?php single_cat_title(); ?> | <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_month() ) { ?><title><?php the_time('F'); ?> | <?php bloginfo('name'); ?></title><?php } ?>
<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?><title><?php single_tag_title("", true); ?> | <?php bloginfo('name'); ?></title><?php } ?> <?php } ?>

<?php
$description = '';
$keywords = '';

if (is_home() || is_page()) {
   // 后台设置你的主页description
   $description = of_get_option("home_description");

   // 后台你的主页keywords
   $keywords = of_get_option("home_keyword");
}
elseif (is_single()) {
   $description1 = get_post_meta($post->ID, "description", true);
   $description2 = str_replace("\n","",mb_strimwidth(strip_tags($post->post_content), 0, 200, "…", 'utf-8'));

   // 填写自定义字段description时显示自定义字段的内容，否则使用文章内容前200字作为描述
   $description = $description1 ? $description1 : $description2;

   // 填写自定义字段keywords时显示自定义字段的内容，否则使用文章tags作为关键词
   $keywords = get_post_meta($post->ID, "keywords", true);
   if($keywords == '') {
      $tags = wp_get_post_tags($post->ID);    
      foreach ($tags as $tag ) {        
         $keywords = $keywords . $tag->name . ", ";    
      }
      $keywords = rtrim($keywords, ', ');
   }
}
elseif (is_category()) {
   // 分类的description可以到后台 - 文章 -分类目录，修改分类的描述
   $description = category_description();
   $keywords = single_cat_title('', false);
}
elseif (is_tag()){
   // 标签的description可以到后台 - 文章 - 标签，修改标签的描述
   $description = tag_description();
   $keywords = single_tag_title('', false);
}
$description = trim(strip_tags($description));
$keywords = trim(strip_tags($keywords));
?>
<meta name="description" content="<?php echo $description; ?>" />
<meta name="keywords" content="<?php echo $keywords; ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0 - All Posts" href="<?php bloginfo( 'rss2_url' ); ?>" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0 - All Comments" href="<?php bloginfo('comments_rss2_url'); ?>" />
<?php if(of_get_option("favicon")) : ?>
<link rel="shortcut icon" href="<?php echo of_get_option("favicon"); ?>" type="image/x-icon" />
<?php endif; ?>
<link href="http://cdn.bootcss.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="http://cdn.bootcss.com/normalize/3.0.1/normalize.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>?ver=2013" media="all" />
<?php wp_head(); ?>
</head>
<body>

<header id="header" >
    <nav id="nav">
        <?php wp_nav_menu( array( 'theme_location' => 'menu','container'=>'ul' )); ?>
    </nav>
</header>

<div id="description">
  <div id="description_content" class="container">
    <div class="inner">
      <div class="user">
        <div class="tdbox"><a class="avatar" href="javascript:;">
        <?php if(of_get_option("avatar")) : ?>
            <img src="<?php echo of_get_option("avatar") ?>" alt="">
        <?php  else : ?>
            <img src="<?php bloginfo('template_url'); ?>/img/avatar.png" alt="">
        <?php endif; ?>
        </div>
        <div class="pro-links">
          <a href="<?php echo of_get_option("qq") ?>" class="QQ" title="QQ" target="_blank"><i class="fa fa-qq"></i></a>
          <a href="<?php echo of_get_option("weibo") ?>" class="Weibo" title="Weibo" target="_blank"><i class="fa fa-weibo"></i></a>
          <a href="mailto:<?php echo of_get_option("email") ?>" class="mail" title="Mail" target="_blank"><i class="fa fa-envelope-o"></i></a>
          <a href="<?php echo of_get_option("wordpress") ?>" class="Wordpress" title="Wordpress" target="_blank"><i class="fa fa-wordpress"></i></a>
          <h4><?php echo of_get_option("text") ?></h4>
        </div>
      </div>
    </div>
  </div>
</div>

    
        



<div class="container test" id="posts">
    <div class="inner">
        		
    
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="post">
        <h2 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

        <div class="post_body">
            <?php if(is_single() || is_page()) : ?>
                <div class="p_part"><?php the_content();?></div>
            <?php  else : ?>
                <div class="p_part"><p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 300,"..."); ?></p></div>
            <?php endif; ?>
        </div>

        <?php if(is_home()) : ?>
            <div class="post_footer">
                <div class="read_more">
                    <a href="<?php the_permalink() ?>">>阅读全文</a>
                </div>
                <div class="clear"></div>
            </div>
        <?php endif; ?>

        <?php if(is_single() || is_page()) : ?>
            <?php comments_template( '', true ); ?>
        <?php endif; ?>

	    <div class="info">
		    <span class="date"><i class="fa fa-clock-o"></i><?php the_time('Y.m.j'); ?></span>
		    <span class="author"><i class="fa fa-user"></i><?php the_author() ?></span>  
	    </div>
    </div>
    <?php endwhile; endif;?>





    <div class="pager">
        <?php if(is_single() || is_page()) : ?>
        <?php  else : ?>
            <?php par_pagenavi(0); ?>
        <?php endif; ?>
    </div>

</div>
</div>

<div id="footer">
    <div class="powered_by">
        <?php echo of_get_option("footer") ?>Created By <a href="http://liuronghuan.com" title="Wordpress主题"> Ronghuan.Liu</a>
    </div>
</div>


<div id="goTop">
    <a href="#top"><i class="fa fa-arrow-circle-o-up fa-3x"></i></a>
</div>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url'); ?>/fancybox/fancybox.css" />
<script type="text/javascript" src="<?php bloginfo('template_url');?>/fancybox/mousewheel.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/fancybox/fancyboxmin.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/fancybox/easing.js"></script>
<script>
  $(document).ready(function() { 
    $(".menu a,.title a,.pro-links a,.powered_by a").hover(function(){ 
        if(!$(this).is(":animated")){
        $(this).animate({opacity:".6" },210).animate({opacity:"1"},180);
        }
    });
    
  $('.title a').click(function(e){
     e.preventDefault();
    var htm='正在打开',i=9,
      t=$(this).html(htm).unbind('click');
    (function ct(){
      i<0?(i=9,t.html(htm),ct()):(t[0].innerHTML+='.',i--,setTimeout(ct,200));
    })();
    window.location=this.href;//opera fixed
  });
    
    }); 
  
  
  $(document).ready(function() {           
    $('#goTop').scrollShow();
  });
  $("a[href='#top']").click(function(){
    $("html, body").animate({scrollTop: 0}, "slow");
    return false;
  })
  jQuery.fn.scrollShow=function(a){a=jQuery.extend({min:100,fadeSpeed:500,ieOffset:0},a);return this.each(function(){var b=jQuery(this);jQuery(window).scroll(function(){jQuery.support.hrefNormalized||b.css({position:"absolute",top:jQuery(window).scrollTop()+jQuery(window).height()-a.ieOffset});jQuery(window).scrollTop()>=a.min?b.fadeIn(a.fadeSpeed):b.fadeOut(a.fadeSpeed)})})};
</script>
<?php wp_footer();?>
</body>
</html>