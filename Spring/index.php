<?php get_header(); ?>
<div class="line">
<a class="home" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('description'); ?>"><i class="fa fa-home"></i></a><i class="fa fa-angle-double-right"></i><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('description'); ?>">Home</a></div>

	<?php include_once('include/slider.php');?>


<?php
	// if(!empty($redux_demo['cms']) && $redux_demo['cms'] == 1) {
        include_once('include/cms.php');
    //}else{
        //include_once('include/blog.php');
    //}
?>
<?php get_footer(); ?>

<?php /*
	if(!empty($redux_demo['cms']) && $redux_demo['cms'] == 1) {
        include_once('include/cms.php');
    }else{
        include_once('include/blog.php');
    }
    */
?>
