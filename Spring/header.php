<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="utf-8">
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
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.5">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>?ver=2013" media="all" />
<?php global $redux_demo; ?>
<?php if ( is_home() ) { ?><?php } else { ?><?php wp_head(); ?><?php } ?>
</head>
<body>
<?php if ( is_home() ) { ?>
    <div id="loader">
        <img src="<?php bloginfo('template_directory');?>/images/loadingss.gif" width="130" height="72" alt="加载中..." />
    </div>
<?php } ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/font/font-awesome.css" media="all" />
<script src="<?php bloginfo('template_directory');?>/JS/jquery.js" type="text/javascript"></script>
<?php if ( wp_is_mobile() ): ?>
    <style type="text/css" media="screen">
        #cont {position: fixed;width: 100%;height: 100%;background:#f0eeee;background-attachment: fixed;}
    </style>
<?php else :?>
    <script src="<?php bloginfo('template_directory');?>/JS/backstretch.js" type="text/javascript"></script>
    <style type="text/css" media="screen">
        #cont {position: fixed;width: 100%;height: 100%;background: url('<?php bloginfo('template_directory');?>/images/overlay2.png') repeat;background-attachment: fixed;}
    </style>
<?php endif; ?>
<script src="<?php bloginfo('template_directory');?>/JS/responsiveslides.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory');?>/JS/jquery.nicescroll.min.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory');?>/JS/Mossight.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory');?>/JS/script.js" type="text/javascript"></script>
<script type="text/javascript"> 
    jQuery(document).ready(function($) {
        $(function() {
            $("a.et_smilies").click(function() {
                $('#smilies-container').toggle(function() {
                    $(document).click(function(event) {
                        if (!($(event.target).is('#smilies-container') || $(event.target).parents('#smilies-container').length || $(event.target).is('a.et_smilies'))) {
                            $('#smilies-container').hide(500);
                        }
                    });
                });
            });
        });
        $(function() {// comment editor
        function addEditor(a, b, c) {
            if (document.selection) {
                a.focus();
                sel = document.selection.createRange();
                c ? sel.text = b + sel.text + c: sel.text = b;
                a.focus()
            } else if (a.selectionStart || a.selectionStart == '0') {
                var d = a.selectionStart;
                var e = a.selectionEnd;
                var f = e;
                c ? a.value = a.value.substring(0, d) + b + a.value.substring(d, e) + c + a.value.substring(e, a.value.length) : a.value = a.value.substring(0, d) + b + a.value.substring(e, a.value.length);
                c ? f += b.length + c.length: f += b.length - e + d;
                if (d == e && c) f -= c.length;
                a.focus();
                a.selectionStart = f;
                a.selectionEnd = f
            } else {
                a.value += b + c;
                a.focus()
            }
        }
        var g = document.getElementById('comment') || 0;
        var h = {
            strong: function() {
                addEditor(g, '<strong>', '</strong>')
            },
            em: function() {
                addEditor(g, '<em>', '</em>')
            },
            del: function() {
                addEditor(g, '<del>', '</del>')
            },
            underline: function() {
                addEditor(g, '<u>', '</u>')
            },
            ahref: function() {
                var a = prompt('请输入链接地址', 'http://');
                var b = prompt('请输入链接描述','');
                if (a) {
                    addEditor(g, '<a target="_blank" href=”' + a + '" rel="external”>' + b + '</a>','')
                }
            },
            empty: function(){
                g.value="";g.focus()
            },
            fontColor: function() {
                var a = prompt("\u8f93\u5165\u989c\u8272css\u503c", "#000000");
                a && addEditor(g, "<font color=#" + a.match(/[^#]{3,6}/gi)[0] + ">", "</font>")
            },
        };
        window['SIMPALED'] = {};
        window['SIMPALED']['Editor'] = h
    });
    });
</script>
<div id="cont"></div>
<?php if ( wp_is_mobile() ): ?><?php else :?>
<script>
    $.backstretch([
        <?php if ($redux_demo['bgs1']['url']) : ?>
            "<?php echo $redux_demo['bgs1']['url']?>",
        <?php else :?>
            "http://bcs.duapp.com/themeidea/1.jpg",
        <?php endif; ?>
        <?php if ($redux_demo['bgs2']['url']) : ?>
            "<?php echo $redux_demo['bgs2']['url']?>",
        <?php else :?>
            "http://bcs.duapp.com/themeidea/2.jpg",
        <?php endif; ?>
        <?php if ($redux_demo['bgs3']['url']) : ?>
            "<?php echo $redux_demo['bgs3']['url']?>",
        <?php else :?><?php endif; ?>
        <?php if ($redux_demo['bgs4']['url']) : ?>
            "<?php echo $redux_demo['bgs4']['url']?>",
        <?php else :?><?php endif; ?>
        <?php if ($redux_demo['bgs5']['url']) : ?>
            "<?php echo $redux_demo['bgs5']['url']?>",
        <?php else :?><?php endif; ?>
        <?php if ($redux_demo['bgs6']['url']) : ?>
            "<?php echo $redux_demo['bgs6']['url']?>",
        <?php else :?><?php endif; ?>
      ], {
        fade: 1000,
        duration: 5000
    });
</script>
<?php endif; ?>
<div class="containers">
	<div id="topbar">
    	<div class="center">
        	<div class="left">          
            	<div class="nav">
                    <?php if ( wp_is_mobile() ): ?>
                        <?php if (of_get_option("logo")) : ?>
                            <li id="logo"><a id="simple-menu" href="#sidr"><img src="<?php echo of_get_option('logo'); ?>" alt="<?php echo bloginfo('description'); ?>" /></a></li>
                        <?php else :?>
                            <li id="logo"><a id="simple-menu" href="#sidr"><img src="<?php bloginfo('template_directory');?>/images/logo.png" alt="<?php echo bloginfo('description'); ?>" /></a></li>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if ($redux_demo['logo']['url']) : ?>
                            <li id="logo"><img src="<?php echo $redux_demo['logo']['url']?>" alt="<?php echo bloginfo('description'); ?>" /></li>
                        <?php else :?>
                            <li id="logo"><img src="<?php bloginfo('template_directory');?>/images/logo.png" alt="<?php echo bloginfo('description'); ?>" /></li>
                        <?php endif; ?>
                        <?php wp_nav_menu( array( 'theme_location' => 'first-menu','container'=>'ul','fallback_cb'=>'Themeidea_nav_fallback','depth' => 2 )); ?>
                    <?php endif; ?>
            	</div>
        	</div>
        	<div class="right">
            用户中心
        	</div>
    	</div>
	</div>

    <?php get_search_form(); ?>
    <div id="neirong" class="center">