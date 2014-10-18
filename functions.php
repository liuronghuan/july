<?php 
	
	if (!function_exists('optionsframework_init')){
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri().'/inc/');
	require_once dirname(__FILE__).'/inc/options-framework.php';
}
	
require_once(TEMPLATEPATH . '/theme-updates/theme-update-checker.php'); 
$wpdaxue_update_checker = new ThemeUpdateChecker(
	'July', //主题名字
	'http://liuronghuan.com/themes/July/info.json'  //info.json 的访问地址
);
			
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


function par_pagenavi($range = 0){
	global $paged, $wp_query;
	if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
	if($max_page > 1){if(!$paged){$paged = 1;}
	if($paged>1) echo '<a class="pre" href="' . get_pagenum_link($paged-1) .'" class="prev"><i class="fa fa-arrow-left"></i></a>';
	if($paged<$max_page) echo '<a class="next" href="' . get_pagenum_link($paged+1) .'" class="next"><i class="fa fa-arrow-right"></i></a>';}
}



$new_meta_boxes =
array(
  "description" => array(
    "name" => "_description",
    "std" => "这里填默认的网页描述",
    "title" => "网页描述:"),

  "keywords" => array(
    "name" => "_keywords",
    "std" => "这里填默认的网页关键字",
    "title" => "关键字:")
);

function new_meta_boxes() {
  global $post, $new_meta_boxes;

  foreach($new_meta_boxes as $meta_box) {
    $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

    if($meta_box_value == "")
      $meta_box_value = $meta_box['std'];

    // 自定义字段标题
    echo'<h4>'.$meta_box['title'].'</h4>';

    // 自定义字段输入框
    echo '<textarea cols="60" rows="3" name="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';
  }
   
  echo '<input type="hidden" name="ludou_metaboxes_nonce" id="ludou_metaboxes_nonce" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
}

function create_meta_box() {
  global $theme_name;

  if ( function_exists('add_meta_box') ) {
    add_meta_box( 'new-meta-boxes', '网站SEO优化', 'new_meta_boxes', 'post', 'normal', 'high' );
  }
}

function save_postdata( $post_id ) {
  global $new_meta_boxes;
   
  if ( !wp_verify_nonce( $_POST['ludou_metaboxes_nonce'], plugin_basename(__FILE__) ))
    return;
   
  if ( !current_user_can( 'edit_posts', $post_id ))
    return;
               
  foreach($new_meta_boxes as $meta_box) {
    $data = $_POST[$meta_box['name'].'_value'];

    if($data == "")
      delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
    else
      update_post_meta($post_id, $meta_box['name'].'_value', $data);
   }
}

add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');


?>