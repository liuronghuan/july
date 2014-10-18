<?php get_header(); ?>
<?php if(function_exists('cmp_breadcrumbs')) cmp_breadcrumbs();?>
<div class="cmsnews">
	<div class="news left">
	<div class="wrapper">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="posts">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<div class="post_content"><?php the_content();?></div>
				<div class="postmeta">
					<span class="postauthor"><?php the_author() ?></span>
					<span class="postinfoviews"><?php get_post_views($post -> ID); ?></span>
					<span class="defaulttag"><?php if ( get_the_tags() ) { the_tags('', ', ', ' '); } else{ echo "客官！这篇文章没有填写关键词哦！";  } ?></span>	 
				</div>
				<?php include('include/related.php'); ?>
				<div class="clear"></div>
			</div>
			<?php if ($comments || comments_open()) : ?>
				<div class="comment_title">
					<div class="left"><div class="comments_number left">目前有<?php comments_number('0条回应', '1条回应', '%条回应' );?></div><div class="report left">发表评论</div></div>
					<div class="commentsorping right">
						<div class="commentpart right">Comment</div>
						<div class="pingpart right">Trackback</div>
					</div>
					<div class="clear"></div>
				</div>
				<?php comments_template( '', true ); ?>
			<?php endif; ?>
		<?php endwhile; endif;?>
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