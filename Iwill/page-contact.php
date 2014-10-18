<?php
/*
Template Name: Contact
*/
?>
<?php get_header(); ?>
<div class="article contacter">
    <div class="bg"></div>
    <div class="mid">
        <h2 title="设计理论"></h2>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="postitle"><h2><?php the_title(); ?></h2></div>
                <p class="notice">Time:2014-05-07 16:04:18<em></em>www.duyibo.com<em></em>View:5400</p>
                <div class="postcontent"><?php the_content();?></div>
            <?php endwhile; endif;?>
            <?php comments_template( '', true ); ?>
    </div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>