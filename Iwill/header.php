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
   $description1 = get_field('description');;
   $description2 = str_replace("\n","",mb_strimwidth(strip_tags($post->post_content), 0, 200, "…", 'utf-8'));

   // 填写自定义字段description时显示自定义字段的内容，否则使用文章内容前200字作为描述
   $description = $description1 ? $description1 : $description2;

   // 填写自定义字段keywords时显示自定义字段的内容，否则使用文章tags作为关键词
   $keywords = get_field('keyword');;
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
<link rel="shortcut icon" href="<?php echo of_get_option("favicon"); ?>" type="img/x-icon" />
<?php endif; ?>
<link href="http://cdn.bootcss.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="http://cdn.bootcss.com/normalize/3.0.1/normalize.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>?ver=2013" media="all" />
<script type="text/javascript" src="http://cdn.iwilling.org/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="http://cdn.iwilling.org/js/jquery.smart3d.js"></script>
<script type="text/javascript" src="http://cdn.iwilling.org/js/jquery.isotope.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/script.js" type="text/javascript"></script>
<?php wp_head(); ?>
</head>
<body>
<div class="navbar_header">
    <div id="topbar">
        <div class="midlag">
            <ul class="right">
		        <li><a href="#" title="#">MarvelStud...</a></li>
		        <li class="borderLi">|</li>
		        <li><a href="#" title="#">我的网站</a></li>
                <li class="borderLi">|</li>
                <li><a href="#" title="#">登录</a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="midlag">
        <div class="logo left">
            <a href="/" title="返回首页"><img src="<?php bloginfo('template_url'); ?>/img/logo.png"></a>
        </div>
        <?php wp_nav_menu( array( 'theme_location' => 'menu','container'=>'ul' )); ?>
    </div>
    
</div>