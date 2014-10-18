<?php 
	
	if (!function_exists('optionsframework_init')){
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri().'/inc/');
	require_once dirname(__FILE__).'/inc/options-framework.php';
}
/*	
require_once(TEMPLATEPATH . '/theme-updates/theme-update-checker.php'); 
$wpdaxue_update_checker = new ThemeUpdateChecker(
	'July', //主题名字
	'http://liuronghuan.com/themes/July/info.json'  //info.json 的访问地址
);
*/	
	
			
// google
function remove_open_sans() {   
    wp_deregister_style( 'open-sans' );   
    wp_register_style( 'open-sans', false );   
    wp_enqueue_style('open-sans','');   
}   
add_action( 'init', 'remove_open_sans' );
	
			
					
									
	add_theme_support( 'menus' );
	if ( function_exists( 'register_nav_menus' ) ) {
	  	register_nav_menus(
      array(
        'menu' => __( '菜单' ),
      )
   );
}
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
	return is_array($var) ? array_intersect($var, array('current-menu-item','current-post-ancestor','current-menu-ancestor','current-menu-parent')) : '';
}


    //缩略图设置
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(150, 108, true); 
function catch_first_image() {global $post, $posts;$first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];
    if(empty($first_img)){
        $random = mt_rand(1, 10);
        echo get_bloginfo ( 'stylesheet_directory' );
        echo '/img/random/'.$random.'.jpg';
        }
  return $first_img;
}


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
//去除头部冗余代码
remove_action( 'wp_head',   'feed_links_extra', 3 ); 
remove_action( 'wp_head',   'rsd_link' ); 
remove_action( 'wp_head',   'wlwmanifest_link' ); 
remove_action( 'wp_head',   'index_rel_link' ); 
remove_action( 'wp_head',   'start_post_rel_link', 10, 0 ); 
remove_action( 'wp_head',   'wp_generator' ); 
//阻止站内PingBack
function dtheme_noself_ping( &$links ) {
  $home = get_option( 'home' );
  foreach ( $links as $l => $link )
  if ( 0 === strpos( $link, $home ) )
  unset($links[$l]);
}
add_action('pre_ping','dtheme_noself_ping'); 
//移除自动保存和修订版本
function dtheme_disable_autosave() {
  wp_deregister_script('autosave');
}
    add_action('wp_print_scripts','dtheme_disable_autosave' );
    remove_action('pre_post_update','wp_save_post_revision' );

?>