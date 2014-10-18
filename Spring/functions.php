<?php
include_once('include/seobox.php');
	
	if (!function_exists('optionsframework_init')){
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri().'/inc/');
	require_once dirname(__FILE__).'/inc/options-framework.php';
}

//links
add_filter( 'pre_option_link_manager_enabled', '__return_true' );
    //菜单支持
	add_theme_support( 'menus' );
	if ( function_exists( 'register_nav_menus' ) ) {
	  	register_nav_menus(
      array(
        'first-menu' => __( '菜单' ),
      )
   );
}
function Themeidea_nav_fallback(){
    echo '<ul class="menu"><li>'.__( '请在 “后台 - 外观 -菜单” 设置导航菜单').'</li></ul>';
}
//kuangao
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );
 
function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}
//移除顶部多余信息
function wpbeginner_remove_version() { 
return ; 
} add_filter('the_generator', 'wpbeginner_remove_version');//wordpress的版本号
remove_action('wp_head', 'feed_links', 2);// 包含文章和评论的feed 
remove_action('wp_head', 'index_rel_link');//当前文章的索引 
remove_action('wp_head', 'feed_links_extra', 3);// 额外的feed,例如category, tag页 
remove_action('wp_head', 'start_post_rel_link', 10, 0);// 开始篇 
remove_action('wp_head', 'parent_post_rel_link', 10, 0);// 父篇 
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // 上、下篇. 
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );//rel=pre
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );//rel=shortlink 
remove_action('wp_head', 'rel_canonical' ); 
remove_action('wp_head', 'wlwmanifest_link'); // 外部编辑器
remove_action( 'wp_head','rsd_link');//ML-RPC
/**
 * 移除菜单的多余CSS选择器
 */
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
	return is_array($var) ? array_intersect($var, array('current-menu-item','current-post-ancestor','current-menu-ancestor','current-menu-parent')) : '';
}
    //缩略图设置
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(560, 360, true); 
function catch_first_image() {global $post, $posts;$first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];
    if(empty($first_img)){
        $random = mt_rand(1, 10);
        echo get_bloginfo ( 'stylesheet_directory' );
        echo '/images/random/'.$random.'.jpg';
        }
  return $first_img;
}
/**
 * WordPress 添加面包屑导航 
 * http://www.wpdaxue.com/wordpress-add-a-breadcrumb.html
 */
function cmp_breadcrumbs() {
    $delimiter = '»'; // 分隔符
    $before = '<span class="current">'; // 在当前链接前插入
    $after = '</span>'; // 在当前链接后插入
    if ( !is_home() && !is_front_page() || is_paged() ) {
        echo '<div id="crumbs"><i class="fa fa-map-marker"></i>'.__( '当前位置:' , 'cmp' );
        global $post;
        $homeLink = home_url();
        echo ' <a itemprop="breadcrumb" href="' . $homeLink . '"><i class="fa fa-home"></i>' . __( '首页' , 'cmp' ) . '</a> ' . $delimiter . ' ';
        if ( is_category() ) { // 分类 存档
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0){
                $cat_code = get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' ');
                echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
            }
            echo $before . '' . single_cat_title('', false) . '' . $after;
        } elseif ( is_day() ) { // 天 存档
            echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo '<a itemprop="breadcrumb"  href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('d') . $after;
        } elseif ( is_month() ) { // 月 存档
            echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('F') . $after;
        } elseif ( is_year() ) { // 年 存档
            echo $before . get_the_time('Y') . $after;
        } elseif ( is_single() && !is_attachment() ) { // 文章
            if ( get_post_type() != 'post' ) { // 自定义文章类型
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a itemprop="breadcrumb" href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
                echo $before . get_the_title() . $after;
            } else { // 文章 post
                $cat = get_the_category(); $cat = $cat[0];
                $cat_code = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
                echo $before . get_the_title() . $after;
            }
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;
        } elseif ( is_attachment() ) { // 附件
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            echo '<a itemprop="breadcrumb" href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        } elseif ( is_page() && !$post->post_parent ) { // 页面
            echo $before . get_the_title() . $after;
        } elseif ( is_page() && $post->post_parent ) { // 父级页面
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a itemprop="breadcrumb" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        } elseif ( is_search() ) { // 搜索结果
            echo $before ;
            printf( __( 'Search Results for: %s', 'cmp' ),  get_search_query() );
            echo  $after;
        } elseif ( is_tag() ) { //标签 存档
            echo $before ;
            printf( __( 'Tag Archives: %s', 'cmp' ), single_tag_title( '', false ) );
            echo  $after;
        } elseif ( is_author() ) { // 作者存档
            global $author;
            $userdata = get_userdata($author);
            echo $before ;
            printf( __( 'Author Archives: %s', 'cmp' ),  $userdata->display_name );
            echo  $after;
        } elseif ( is_404() ) { // 404 页面
            echo $before;
            _e( 'Not Found', 'cmp' );
            echo  $after;
        }
        if ( get_query_var('paged') ) { // 分页
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
                echo sprintf( __( '( Page %s )', 'cmp' ), get_query_var('paged') );
        }
        echo '</div>';
    }
}


 //postviews   
function get_post_views ($post_id) {   
  
    $count_key = 'views';   
    $count = get_post_meta($post_id, $count_key, true);   
  
    if ($count == '') {   
        delete_post_meta($post_id, $count_key);   
        add_post_meta($post_id, $count_key, '0');   
        $count = '0';   
    }   
  
    echo number_format_i18n($count);   
  
}   
  
function set_post_views () {   
  
    global $post;   
  
    $post_id = $post -> ID;   
    $count_key = 'views';   
    $count = get_post_meta($post_id, $count_key, true);   
  
    if (is_single() || is_page()) {   
  
        if ($count == '') {   
            delete_post_meta($post_id, $count_key);   
            add_post_meta($post_id, $count_key, '0');   
        } else {   
            update_post_meta($post_id, $count_key, $count + 1);   
        }   
  
    }   
  
}   
add_action('get_header', 'set_post_views');  

if ( function_exists('register_sidebar') ){
    register_sidebar(array(
        'name'=>'侧边栏',
        'before_widget' => '<div class="slidediv sidebarp clearfix">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}


//控制侧边栏标签云
function my_tag_cloud_filter($args = array()) {
$args['smallest'] = 14; //最小字号
$args['largest'] = 14; //最大字号/.
$args['unit'] ='px'; //字体单位 px，pt，em
$args['number'] =20;//调用数量
$args['orderby']='count';//按何值排序
$args['order']='DESC';//排序方式
return $args;}
add_filter('widget_tag_cloud_args', 'my_tag_cloud_filter', 10);

function par_pagenavi($range = 6){
    global $paged, $wp_query;
    if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
    if($max_page > 1){if(!$paged){$paged = 1;}
    if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'>首页</a>";}
    if($paged>1) echo '<a href="' . get_pagenum_link($paged-1) .'" class="prev">上一页</a>';
    if($max_page > $range){
        if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<a href='" . get_pagenum_link($i) ."'";
        if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    elseif($paged >= ($max_page - ceil(($range/2)))){
        for($i = $max_page - $range; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
        if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
        for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";}}}
    else{for($i = 1; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    if($paged<$max_page) echo '<a href="' . get_pagenum_link($paged+1) .'" class="next">下一页</a>';
    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'>尾页</a>";}}
}


 /////////////////////////// Commentlist ////////////////////////
function lopercomment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
    global $commentcount;
    if(!$commentcount) { 
        $page = get_query_var('cpage')-1;
        $cpp=get_option('comments_per_page');
        $commentcount = $cpp * $page;
    }
?>
<li id="comment-<?php comment_ID() ?>" <?php comment_class('commenttips',$comment_id,$comment_post_ID); ?> >
    <div class="comment-body">
    
            <div class="commenttext">
    
                <div class="gravatar">
                    <?php echo get_avatar( get_comment_author_email(), '48'); ?>
                </div><!-- comment-author -->

                <div class="comment-text">
                    <div class="comment-meta">
                        <span class="commentid"><?php comment_author_link();?></span>
                        <span class="commenttime">回复于：<?php comment_date('Y.m.j') ?> <?php comment_time('H:i'); ?></span>
                        <span class="editpost"> <?php edit_comment_link(' [编辑]'); ?></span>
                        <span class="reply"><?php comment_reply_link(array_merge( $args, array('reply_text' => '回复','depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>               
                    </div><!--comment-meta-->
                    <div class="commentp">
                        <?php if ($comment->comment_approved == '0') : ?>
                        <em>
                            <span class="moderation"><?php _e('Your comment is awaiting moderation.') ?></span>
                        </em> <br />
                        <?php endif; ?>
                        <?php comment_text() ?>
                    </div>
                </div>


            </div><!-- commenttext -->
        <div class="clearline"></div>
    </div><!-- [div-comment] -->
    
  <?php
}
        ////////嵌套ping
        function loperpings($comment, $args, $depth) {
               $GLOBALS['comment'] = $comment;
        ?>
            <li id="comment-<?php comment_ID(); ?>">
                <div class="pingdiv">
                    <?php comment_author_link(); ?>
                </div>
        <?php }
///////////////////// Commentlist结束////////////////////////
///////////////////// Comment////////////////////////
    function wp_smilies() {global $wpsmiliestrans;if ( !get_option('use_smilies') or (empty($wpsmiliestrans))) return;$smilies = array_unique($wpsmiliestrans);$link='';foreach ($smilies as $key => $smile) {$file = get_bloginfo('template_directory').'/images/smilies/'.$smile;$value = " ".$key." ";$img = "<img src=\"{$file}\" alt=\"{$smile}\" />";$imglink = htmlspecialchars($img);$link .= "<span><a href=\"#comment\" onclick=\"document.getElementById('comment').focus();document.getElementById('comment').value += '{$value}';return false;\">{$img}</a></span>";} echo '<div class="editor_tools clearfix"><span><a href="javascript:SIMPALED.Editor.empty();" title="清空内容" class="et_empty">清空内容</a></span><span><a href="javascript:SIMPALED.Editor.strong()" title="粗体" class="et_strong">粗体</a></span><span><a href="javascript:SIMPALED.Editor.em()" title="斜体" class="et_em">斜体</a></span><span><a href="javascript:SIMPALED.Editor.underline()" title="下划线" class="et_underline">下划线</a></span><span><a href="javascript:SIMPALED.Editor.del()" title="删除线" class="et_del">删除线</a></span><span><a href="javascript:SIMPALED.Editor.ahref()" title="链接" class="et_ahref">链接</a></span><span><a href="javascript:SIMPALED.Editor.fontColor();" title="字体颜色" class="et_color">字体颜色</a></span><span><a href="javascript:SIMPALED.Editor.smilies()" title="表情" class="et_smilies">表情</a></span><div id="smilies-container"><div class="wp_smilies">'.$link.'</div></div></div>';}
if (is_user_logged_in()) {add_filter('comment_form_logged_in_after', 'wp_smilies');} else { add_filter( 'comment_form_after_fields', 'wp_smilies');}
add_filter('smilies_src','light_smilies_src',1,10);function light_smilies_src ($img_src, $img, $siteurl){return get_bloginfo('template_directory').'/images/smilies/'.$img;}

    function CheckEmailAndName(){
        global $wpdb;
        $comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
        $comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
        if(!$comment_author || !$comment_author_email){
            return;
        }
        $result_set = $wpdb->get_results("SELECT display_name, user_email FROM $wpdb->users WHERE display_name = '" . $comment_author . "' OR user_email = '" . $comment_author_email . "'");
        if ($result_set) {
            if ($result_set[0]->display_name == $comment_author){
                err(__('警告: 您不能用这个昵称，因为这是博主的昵称！'));
            }else{
                err(__('警告: 您不能使用该邮箱，因为这是博主的邮箱！'));
            }
            fail($errorMessage);
        }
    }
    add_action('pre_comment_on_post', 'CheckEmailAndName');

    function comment_mail_notify($comment_id) {
        $comment = get_comment($comment_id);
        $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
        $spam_confirmed = $comment->comment_approved;
        if (($parent_id != '') && ($spam_confirmed != 'spam')) {
            $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
            $to = trim(get_comment($parent_id)->comment_author_email);
            $subject = '你在 [' . get_option("blogname") . '] 的留言有了新回复';
            $message = '
            <div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px; border-radius:5px;">
            <p><strong>' . trim(get_comment($parent_id)->comment_author) . ', 你好!</strong></p>
            <p><strong>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言为:</strong><br />'
            . trim(get_comment($parent_id)->comment_content) . '</p>
            <p><strong>' . trim($comment->comment_author) . ' 给你的回复是:</strong><br />'
            . trim($comment->comment_content) . '<br /></p>
            <p>你可以点击此链接 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看完整内容</a></p><br />
            <p>欢迎再次来访<a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
            <p>(此邮件为系统自动发送，请勿直接回复.)</p>
            </div>';
            $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
            $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
            wp_mail( $to, $subject, $message, $headers );
        }
    }
    add_action('comment_post', 'comment_mail_notify');
///////////////////// Comment////////////////////////

///////////////////// 后台////////////////////////

///////////////////// 后台////////////////////////
///////////////////// search////////////////////////
add_action('template_redirect', 'redirect_single_post');
function redirect_single_post() {
    if (is_search()) {
        global $wp_query;
        if ($wp_query->post_count == 1 && $wp_query->max_num_pages == 1) {
            wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
            exit;
        }
    }
}
///////////////////// copy///////////////////////

?>
