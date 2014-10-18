<?php get_header(); ?>
<div class="article category">
    <div class="bg"></div>
    <div class="mid">
        <h2 title="设计理论"></h2>
        <ul>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <li>
                    <div class="left">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><img src="<?php echo catch_first_image() ?>" alt="<?php the_title(); ?>"></a>
                    </div>
                    <h3><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                    <p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200,"..."); ?></p>
                    <span class="notice">Time:2014-08-17 16:39:15<em></em>View:725</span>
                    <div class="clear"></div>
                </li>
            <?php endwhile; endif;?>
        </ul>
        <div id="postnavigation"><?php par_pagenavi(6); ?></div><div class="clear"></div>
    </div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>