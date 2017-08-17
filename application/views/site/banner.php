<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 3/24/2017
 * Time: 3:54 PM
 */
?>
<script type="text/javascript" src="<?php echo public_url() ?>coin-slider.min.js"></script>
<link rel="stylesheet" href="<?php echo public_url() ?>coin-slider-styles.css" type="text/css"/>

 <div id="coin-slider">
        <a href="<?php echo base_url()?>product/category/9">
            <img src="<?php echo public_url()?>images/banner0.png" class="img-slide">
            <span>Phụ kiện dễ thương</span>
        </a>
        <a href="<?php echo base_url()?>product/category/8">
            <img src="<?php echo public_url()?>images/banner.png" class="img-slide">
            <span>Thời trang 4teen</span>
        </a>
        <a href="<?php echo public_url()?>images/banner2.jpg">
            <img src="<?php echo public_url()?>images/slide1.png" class="img-slide">
            <span>Đẹp cùng Carrot</span>
        </a>
        <a href="<?php echo public_url()?>images/banner3.jpg">
            <img src="<?php echo public_url()?>images/slide5.jpg" class="img-slide">
            <span>"I dont do fashion. I am fashion"</span>
        </a>
        <a href="<?php echo public_url()?>images/banner4.gif">
            <img src="<?php echo public_url()?>images/slide6.jpg" class="img-slide">
            <span>Khuyến mãi hấp dẫn</span>
        </a>
        <a href="<?php echo public_url()?>images/banner5.gif">
            <img src="<?php echo public_url()?>images/slide7.jpg" class="img-slide">
            <span>Quà tặng mỗi ngày</span>
        </a>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#coin-slider').coinslider();
        });
    </script>
