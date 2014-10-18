<?php global $redux_demo; ?>
<div class="sliders">
    <ul class="rslides" id="slider">
        <?php if ($redux_demo['slide1']['url']) : ?>
            <li><img src="<?php echo $redux_demo['slide1']['url']?>" alt=""></li>
        <?php else :?>
            <li><img src="<?php bloginfo('template_directory');?>/images/sliders/1.jpg" alt=""></li>
        <?php endif; ?>
        <?php if ($redux_demo['slide2']['url']) : ?>
            <li><img src="<?php echo $redux_demo['slide2']['url']?>" alt=""></li>
        <?php else :?>
            <li><img src="<?php bloginfo('template_directory');?>/images/sliders/2.jpg" alt=""></li>
        <?php endif; ?>
        <?php if ($redux_demo['slide3']['url']) : ?>
            <li><img src="<?php echo $redux_demo['slide3']['url']?>" alt=""></li>
        <?php else :?>
            <li><img src="<?php bloginfo('template_directory');?>/images/sliders/3.jpg" alt=""></li>
        <?php endif; ?>
        <?php if ($redux_demo['slide4']['url']) : ?>
            <li><img src="<?php echo $redux_demo['slide4']['url']?>" alt=""></li>
        <?php else :?><?php endif; ?>
        <?php if ($redux_demo['slide5']['url']) : ?>
            <li><img src="<?php echo $redux_demo['slide5']['url']?>" alt=""></li>
        <?php else :?><?php endif; ?>
        <?php if ($redux_demo['slide6']['url']) : ?>
            <li><img src="<?php echo $redux_demo['slide6']['url']?>" alt=""></li>
        <?php else :?><?php endif; ?>
    </ul>
</div>