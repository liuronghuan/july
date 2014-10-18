<?php

//---------- 首页、文章页、页面加关键字和描述 start----------
$new_meta_boxes =
array(
    "keywords" => array(
        "name" => "keywords",
        "std" => "这里填默认的网页关键字",
        "title" => "关键字：",
        "desc" => "修改或者留空"),

    "description" => array(
        "name" => "description",
        "std" => "这里填默认的网页描述",
        "title" => "网页描述：",
        "desc" => "修改或者留空")
);
function new_meta_boxes() {
    global $post, $new_meta_boxes;

	echo '<table class="form-table">';
    foreach($new_meta_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'], true);

        if($meta_box_value == "")
            $meta_box_value = $meta_box['std'];

		echo '<tr valign="top">';
        echo '<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
		echo '<th scope="row"><label for="'.$meta_box['name'].'">'.$meta_box['title'].'</label></th>';
		echo '<td><input name="'.$meta_box['name'].'" type="text" id="'.$meta_box['name'].'" value="'.$meta_box_value.'" class="regular-text" />
		<span class="description">'.$meta_box['desc'].'</span></td>';

		echo '</tr>';
    }
	echo '</table>';
}
function create_meta_box() {
    global $theme_name;

    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', '自定义模块', 'new_meta_boxes', 'post', 'normal', 'high' );
		add_meta_box( 'new-meta-boxes', '自定义模块', 'new_meta_boxes', 'page', 'normal', 'high' );
    }
}
function save_postdata( $post_id ) {
    global $post, $new_meta_boxes;

    foreach($new_meta_boxes as $meta_box) {
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {
            return $post_id;
        }

        if ( 'page' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ))
                return $post_id;
        } 

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
        else {
            if ( !current_user_can( 'edit_post', $post_id ))
                return $post_id;
        }

        $data = $_POST[$meta_box['name']];

        if(get_post_meta($post_id, $meta_box['name']) == "")
            add_post_meta($post_id, $meta_box['name'], $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'], true))
            update_post_meta($post_id, $meta_box['name'], $data);
        elseif($data == "")
            delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));
    }
}
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');
//---------- 首页、文章页、页面加关键字和描述 end----------

?>