<div class="cmsnews">
    <?php $display_categories = array(1,15); foreach ($display_categories as $category) { ?>
        <div class="cms_category">
            <?php query_posts("showposts=4&cat=$category")?>
                <div class="cms_title">
                    <h2 class="left"><i class="fa fa-align-justify"></i><a href="<?php echo get_category_link($category);?>"><?php single_cat_title(); ?></a></h2>
                    <div class="more right"><a href="<?php echo get_category_link($category);?>"><i class="fa fa-paperclip"></i>更多>></a></div>
                    <div class="clear"></div>
                </div>
                <ul class="cms_news">
                    <?php while (have_posts()) : the_post(); ?>
                        <li class="pic_news">
                            <div class="thumbnail">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><img src="<?php echo catch_first_image() ?>" alt="<?php the_title(); ?>"></a>
                                <div class="meta">
                                    <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                                </div>
                            </div>
                            <div class="postmeta">
                                <span class="postauthor"><?php the_author() ?></span>
                                <span class="postinfoviews"><?php get_post_views($post -> ID); ?></span>
                                <span class="defaulttag"><?php comments_popup_link('0', '1', '%'); ?>评论</span>    
                            </div>
                        </li>
                    <?php endwhile; ?>
                    <?php query_posts( array('showposts' => 16,'cat' => $category,'offset' => 4));?>
                    <?php while (have_posts()) : the_post(); ?>
                        <li class="text_news"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><i class="fa fa-angle-double-right"></i><?php echo mb_strimwidth(get_the_title(), 0, 40, '…'); ?></a> </li>
                    <?php endwhile; ?>
                    <div class="clear"></div>
                </ul>
                <div class="clear"></div>
        </div>
    <?php } wp_reset_query();?>
</div>
<div class="clear"></div>
