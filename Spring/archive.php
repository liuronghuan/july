<?php get_header(); ?>
<div class="line">
<a class="home" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('description'); ?>"><i class="fa fa-home"></i></a><i class="fa fa-angle-double-right"></i><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('description'); ?>">Home</a></div>

<div class="cmsnews">
	<div class="news left">
	<div class="wrapper">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="posts">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<div class="post_content"><?php the_content(__('阅读全文'));?></div>
				<div class="postmeta">
					<span class="postauthor"><?php the_author() ?></span>
					<span class="postinfoviews"><?php get_post_views($post -> ID); ?></span>
					<span class="defaulttag"><?php if ( get_the_tags() ) { the_tags('', ', ', ' '); } else{ echo "客官！这篇文章没有填写关键词哦！";  } ?></span>	 
				</div>
			</div>
		<?php endwhile; endif;?>
		<div id="postnavigation"><?php par_pagenavi(6); ?></div><div class="clear"></div>
	</div>
	</div>
	<div class="sidebar right">
		<ul>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('侧边栏') ) : ?><?php endif; ?>
		</ul>
	</div>
	<div class="clear"></div>
</div>
<?php get_footer(); ?>