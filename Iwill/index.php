<?php get_header(); ?>
<div class="homeslide">
    <ul id="smartdemo">
        <li><img src="<?php bloginfo('template_url'); ?>/img/SmartSlider/03.png" /></li>
        <li><img src="<?php bloginfo('template_url'); ?>/img/SmartSlider/02.png" /></li>
        <li><img src="<?php bloginfo('template_url'); ?>/img/SmartSlider/01.png" /></li>
    </ul>
</div>

<div class="midlag">
    <div class="clear"></div>
    <ul class="intro">
        <li class="onethi left">
            <div class="introtxt">
                <img src="<?php bloginfo('template_url'); ?>/img/icon/1.png" alt="">
                <h3>简洁的代码</h3>
                <p>极简的代码，避免臃肿，不断提升Wordpress网站运行速度</p>
            </div>
        </li>
        <li class="onethi left">
            <div class="introtxt">
                <img src="<?php bloginfo('template_url'); ?>/img/icon/2.png" alt="">
                <h3>Html5支持</h3>
                <p>Html5语义化代码，提高用户体验，增强用户视觉感受</p>
            </div>
        </li>
        <li class="onethi left">
            <div class="introtxt">
                <img src="<?php bloginfo('template_url'); ?>/img/icon/3.png" alt="">
                <h3>CSS3支持</h3>
                <p>网站元素细节更加丰富，界面更加唯美，用户体验更强</p>
            </div>
        </li>
        <li class="onethi left">
            <div class="introtxt">
                <img src="<?php bloginfo('template_url'); ?>/img/icon/4.png" alt="">
                <h3>专注于Wordpress</h3>
                <p>专业专注于Wordpress数载，网站实战开发经验丰富</p>
            </div>
        </li>
        <li class="onethi left">
            <div class="introtxt">
                <img src="<?php bloginfo('template_url'); ?>/img/icon/5.png" alt="">
                <h3>完善文档</h3>
                <p>完尽的主题、插件帮助文档，让您轻松上手，毫无后顾之忧</p>
            </div>
        </li>
        <li class="onethi left">
            <div class="introtxt">
                <img src="<?php bloginfo('template_url'); ?>/img/icon/6.png" alt="">
                <h3>用户好评</h3>
                <p>多家企业用户服务愉快，好评如潮，选择我们您的明智之选</p>
            </div>
        </li>
        <div class="clear"></div>
    </ul>
</div>
    
<div class="work">
    <div class="midlag">

  <div id="options" class="clearfix">
      <ul id="filters" class="option-set clearfix" data-option-key="filter">
        <li><a href="#filter" data-option-value="*" class="selected">全部作品</a></li>
        <li><a href="#filter" data-option-value=".theme">精品主题</a></li>
        <li><a href="#filter" data-option-value=".complany">企业主题</a></li>
        <li><a href="#filter" data-option-value=".blog">博客主题</a></li>
        <li><a href="#filter" data-option-value=".plugin">精品插件</a></li>
      </ul>
  </div> <!-- #options -->
    
<div id="container">
    <?php $display_categories = array(9); 
		foreach ($display_categories as $category) { ?>
    <?php query_posts("showposts=8&cat=$category")?>
    <?php while (have_posts()) : the_post(); ?>
    <div class="element left <?php echo get_field('work');?>">

    
    <div class="case_body">
		<div class="case_w" href="<?php the_permalink() ?>">
			<img src="<?php echo catch_first_image() ?>"alt="Image processing" width="262" height="148">
			<div class="fire"></div>
			<a href="<?php the_permalink(); ?> title="<?php the_title(); ?>" rel="bookmark"" class="y"></a>	
		</div>
	</div>

    </div>
    <?php endwhile; ?>
    <?php } wp_reset_query();?>

    <div class="clear"></div>
	</div> <!-- #container -->
  </section> <!-- #content -->
  
    <div class="clear"></div>
    </div>
</div>

<div class="contact">
    <div class="midlag">
        <div class="center">
            <h4>联系我们</h4>
            <p>您好，欢迎光临Iwill Wordpress主题平台，如果您在使用Wordpress过程中有任何不明事宜，请在第一时间联系我们，我们会竭尽全力帮助您解决您的难题！欢迎您购买本站付费主题以及插件，增强您的网站用户体验，增强网站功能</p>
        </div>
        
    <ul class="intro">
        <li class="onefor left">
            <div class="introtxt">
                <i class="fa fa-phone"></i>
                <h3>问题咨询？</h3>
                <p>Tel：13915443864</p>
            </div>
        </li>
        <li class="onefor left">
            <div class="introtxt">
                <i class="fa fa-edit"></i>
                <h3>邮件联系</h3>
                <p>276181228@qq.com</p>
            </div>
        </li>
        <li class="onefor left">
            <div class="introtxt">
                <i class="fa fa-qq"></i>
                <h3>即时通讯</h3>
                <p>QQ276181228</p>
            </div>
        </li>
        <li class="onefor left">
            <div class="introtxt">
                <i class="fa fa-weibo"></i>
                <h3>微博关注</h3>
                <p>收听我们的最新资讯</p>
            </div>
        </li>
        <div class="clear"></div>
    </ul>
    
    </div>
</div>
<?php get_footer(); ?>