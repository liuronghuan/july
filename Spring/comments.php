<div id="comments">
    <!-- 这是必须的…… -->
    <?php if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) : ?>
        <?php die('貌似你做了些不该做的……Big brother is watching you！'); ?>
    <?php endif; ?>

    <!-- 如果需要密码-->
    <?php if(!empty($post->post_password)) : ?>
        <?php if($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
        <?php endif; ?>
    <?php endif; ?>
    
    <?php $i++; ?>
    <?php //trackbacks
    if (function_exists('wp_list_comments')) {
        $trackbacks = $comments_by_type['pings'];
    } else {
        $trackbacks = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->comments WHERE comment_post_ID = %d AND comment_approved = '1' AND (comment_type = 'pingback' OR comment_type = 'trackback') ORDER BY comment_date", $post->ID));
    } ?>

    <?php if($comments) : ?><!-- 如果有评论 -->
        <?php if ( function_exists('wp_list_comments') ) : ?>
            <div class="commentshow">
                <div id="loading-comments"><span class="nimei"><img src="<?php bloginfo('template_url');?>/images/loading.gif" width="16" height="16" /></span>Loading ....</div>
                <ul class="commentlist"><?php wp_list_comments('type=comment&callback=lopercomment&max_depth=10000'); ?></ul>
                <div class="commentnav"><?php paginate_comments_links('prev_text=前一页&next_text=后一页');?></div>
            </div>
        <?php else : ?><?php endif; ?>
        <?php if ( ! empty($comments_by_type['pings']) ) : ?>
            <ul class="pinglist"><?php wp_list_comments('type=pings&callback=devepings'); ?></ul>
        <?php else : ?>
            <ul class="pinglist"><li>本篇文章没有Trackback</li></ul>
        <?php endif; ?>
    <?php else : ?><?php endif; ?>


    <?php if(comments_open()) : ?>
        <div id="respond">

            <?php if(get_option('comment_registration') && !$user_ID) : ?><!--如果必须登录-->
                <div class="getcmtauthor">You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</div><?php else : ?>
                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" name="comm_frm">
            <span class="mossedit">
            <?php wp_smilies();?>
            <?php if ( is_user_logged_in() ) : ?><!--如果已经登录登录-->
                <div class="writerinfodiv">登录用户<a style="color:#0af" href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>， <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" >&nbsp;&nbsp;注销？</a></div>
                                <div class="getcmtauthor"></div>
                <div id="respond-content" class="wp-logined">
            <?php else : ?>
            
            <?php if ( $comment_author != "" ) : ?>
                <div class="writerinfodiv"><?php printf(__('你好，%s，欢迎回来！'), $comment_author) ?></div>
            <?php else : ?>
                <div class="writerinfodiv"><?php printf(__('你目前的身份是游客，请输入昵称和电邮！'), $comment_author) ?></div>
            <?php endif; ?>
            </span><!--end edit--><div class="clear"></div>
                <div class="getcmtauthor"></div>
                <div id="respond-content">
                <div id="author_info" class="left">
                    <div class="getauthor"><label for="author" >昵称(*)</label><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1" /></div>
                    <div class="getauthor"><label for="email" >邮箱(*)</label><input type="email" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" /></div>  
                    <div class="getauthor"><label for="url" >网址</label><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3" /></div>
                </div>
                
            <?php endif; ?>
                <div id="text-area" class="right"><span></span><textarea name="comment" id="comment" rows="10" tabindex="4" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea></div>
                </div>
                <div class="clear"></div>
                <div class="submitdiv">
                    <div class="SubmitComment right"><input name="submit" type="submit" id="submit" tabindex="5" value="" /><?php comment_id_fields(); ?></div>
                    <div id="cancel_comment_reply"><?php cancel_comment_reply_link('取消回复') ?></div>
                </div>
                <div class="clear"></div>
                <?php do_action('comment_form', $post->ID); ?>
                
            </form>
        </div><!--#respond-->
    <?php endif; ?><?php else : ?><?php endif; ?>
</div>