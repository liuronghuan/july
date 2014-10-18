<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __('One', 'options_framework_theme'),
		'two' => __('Two', 'options_framework_theme'),
		'three' => __('Three', 'options_framework_theme'),
		'four' => __('Four', 'options_framework_theme'),
		'five' => __('Five', 'options_framework_theme')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_framework_theme'),
		'two' => __('Pancake', 'options_framework_theme'),
		'three' => __('Omelette', 'options_framework_theme'),
		'four' => __('Crepe', 'options_framework_theme'),
		'five' => __('Waffle', 'options_framework_theme')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __('基本设置', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('首页描述', 'options_framework_theme'),
		'desc' => __('请输入首页描述.', 'options_framework_theme'),
		'id' => 'home_description',
		'type' => 'text');		

	$options[] = array(
		'name' => __('首页关键字', 'options_framework_theme'),
		'desc' => __('请输入首页关键字，用逗号分开.', 'options_framework_theme'),
		'id' => 'home_keyword',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('上传Favicon', 'options_framework_theme'),
		'desc' => __('请上传您的Favicon图片，图片最佳尺寸16px*16px.', 'options_framework_theme'),
		'id' => 'favicon',
		'type' => 'upload');

		
		
	$options[] = array(
		'name' => __('顶部设置', 'options_framework_theme'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('上传Avatar', 'options_framework_theme'),
		'desc' => __('请上传您的Avatar图片，图片最佳尺寸128px*128px,PNG格式.', 'options_framework_theme'),
		'id' => 'avatar',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('QQ链接地址', 'options_framework_theme'),
		'desc' => __('请输入QQ链接地址.', 'options_framework_theme'),
		'id' => 'qq',
		'std' => 'http://wpa.qq.com/msgrd?v=3&uin=276181228&site=qq&menu=yes',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('新浪微博地址', 'options_framework_theme'),
		'desc' => __('请输入新浪微博链接地址.', 'options_framework_theme'),
		'id' => 'weibo',
		'std' => 'http://weibo.com/ronghuanweb',
		'type' => 'text');
		
    $options[] = array(
		'name' => __('邮件地址', 'options_framework_theme'),
		'desc' => __('请输入您的邮箱地址.', 'options_framework_theme'),
		'id' => 'email',
		'std' => '276181228@qq.com',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Wordpress地址', 'options_framework_theme'),
		'desc' => __('请输入您的Wordpress站点地址.', 'options_framework_theme'),
		'id' => 'wordpress',
		'std' => 'http://themeidea.com',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('介绍文字', 'options_framework_theme'),
		'desc' => __('请输入您的介绍文字.', 'options_framework_theme'),
		'id' => 'text',
		'std' => '爱生活、爱色彩、爱设计！',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('底部设置', 'options_framework_theme'),
		'type' => 'heading');
		
	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);
	
	$options[] = array(
		'name' => __('底部设置', 'options_framework_theme'),
		'desc' => sprintf( __( '请输入网站底部版权信息', 'options_framework_theme' ), '' ),
		'id' => 'footer',
		'type' => 'editor',
		'settings' => $wp_editor_settings );

	return $options;
}