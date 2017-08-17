<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/19/2017
 * Time: 1:20 AM
 */
?>
<!--<div style="margin-top: 100px"></div>-->
<head>
    <!--<link rel="stylesheet" type="text/css" href="<?php /*echo public_url() */?>jqzoom/jquery.jqzoom.css">-->
   <!-- <script type="text/javascript" src="<?php /*echo public_url() */?>jqzoom/jquery-1.6.js"></script>-->
    <script type="text/javascript" src="<?php echo public_url() ?>raty-master/lib/jquery.raty.js"></script>
    <script type="text/javascript" src="<?php echo public_url() ?>raty-master/lib/jquery.raty.css"></script>
    <!--<script type="text/javascript">
        $(document).ready(function () {
            $('.jqzoom').jqzoom({
                zoomType: 'standard', // zoom type
                lens: true,
                preloadImages: false,
                alwaysOn: false
            });
        });
    </script>-->
    <!--<script type="text/javascript">
        $(document).ready(function () {
            /* more complex call*/
            var options = {
                zoomType: 'standard',
                lens:true,
                preloadImages: true,
                alwaysOn:false,
                zoomWidth: 100,
                zoomHeight: 150,
                xOffset:90,
                yOffset:30,
                position:'left'
                //...MORE OPTIONS
            };

            $('.MYCLASS').jqzoom(options);
        });
    </script>-->
    <!-- zoom image -->
    <!--<script src="<?php /*echo public_url() */?>jqzoom_ev/js/jquery.jqzoom-core.js" type="text/javascript"></script>
    <link rel="stylesheet" href="<?php /*echo public_url() */?>jqzoom_ev/css/jquery.jqzoom.css" type="text/css">
    <script type="text/javascript">
        $(document).ready(function () {
            $('.jqzoom').jqzoom({
                zoomType: 'standard'
            });
        });
    </script>-->
    <!-- end zoom image -->
    <!-- Raty -->
    <script type="text/javascript">
        $(document).ready(function () {
            //raty
            $('.raty_detailt').raty({
                score: function () {
                    return $(this).attr('data-score');
                },
                <?php if (isset($user_infor)): ?>
                click: function (score, evt) {
                    var rate_count = $('.rate_count');
                    var rate_count_total = rate_count.text();
                    $.ajax({
                        url: '<?php echo site_url('product/raty')?>',
                        type: 'POST',
                        data: {'id': '<?php echo $product->id?>', 'score': score},
                        dataType: 'json',
                        success: function (data) {
                            if (data.complete) {
                                var total = parseInt(rate_count_total) + 1;
                                rate_count.html(parseInt(total));
                            }
                            alert(data.msg);
                        }
                    });
                }
                <?php else: ?>
                    click: function () {
                        alert("Bạn hãy đăng nhập để đánh giá sản phẩm.");
                    }
                <?php endif;?>
            });
        });
    </script>
    <!--End Raty -->

</head>
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9&appId=1892866767628070";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<div id="title">
    <a href="<?php echo base_url('product/category/' . $category->parent_id) ?>">
        <img src="<?php echo public_url() ?>images/carrot_logo.png" width="40px">
    </a>
    <span class="glyphicon glyphicon-arrow-right"></span>
    <a href="<?php echo base_url('product/category/' . $category->id) ?>"
       style="text-decoration: none;color: black;font-family: SVN-Monday, sans-serif; font-size: 30px">
        <?php echo $category->name ?>
    </a>
    <hr>
</div>
<div class="viewitem">

    <table style="width: 100%">
        <tr>
            <td colspan="2" style="width: 40%">
                <h2>
                    <?php echo $product->name ?>
                </h2>
                <!-- <?php /*if ($product->discount > 0): */ ?>
                    Giảm giá <?php /*echo $product->discount */ ?> %
                --><?php /*endif; */ ?>
            </td>
        </tr>
        <tr>
            <td rowspan="2" style="width: 40%">
                <?php if (isset($user_infor)): ?>
                    <?php $product->discount+=3?>
                <?php endif;?>
                <?php if ($product->discount > 0): ?>
                    <div id="sale">
                        -&nbsp;<?php echo $product->discount ?>%
                        <img src="<?php echo public_url() ?>images/sale-0.png" style="width: 40px; ">
                    </div>
                <?php endif; ?>
                <a href="" class="" title="MYTITLE">
                    <img src="<?php echo base_url('upload/product/' . $product->image_link) ?>"
                         style="width: 270px; margin-right: 10px">
                </a>
                <br>
                    <br>
                    <span class="raty_detailt" style='margin:5px'
                          id="<?php echo $product->id ?>" data-score="<?php echo $product->raty?>"></span>
                    ( <b class="rate_count"><?php echo $product->rate_count ?></b> đánh giá )
                    <!-- <ul id="thumblist" >
                        <li>
                            <a class="zoomThumbActive" href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php /*echo base_url('upload/product/'.$product->image_link)*/ ?>',largeimage: '<?php /*echo base_url('upload/product/'.$product->image_link)*/ ?>'}">
                                <img src='<?php /*echo base_url('upload/product/'.$product->image_link)*/ ?>'>
                            </a>
                        </li>
                        <?php /*if(is_array($image_list)):*/ ?>
                            <?php /*foreach ($image_list as $img):*/ ?>
                                <li>
                                    <a  href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php /*echo base_url('upload/product/'.$img)*/ ?>',largeimage: '<?php /*echo base_url('upload/product/'.$img)*/ ?>'}">
                                        <img src='<?php /*echo base_url('upload/product/'.$img)*/ ?>'>
                                    </a>
                                </li>
                            <?php /*endforeach;*/ ?>
                        <?php /*endif;*/ ?>
                    </ul>-->
            </td>
            <td>
                <?php if ($product->description): ?>
                    Thông tin sản phẩm:<br> <i><?php echo $product->description ?></i>
                <?php endif ?>
                <br>
                <p>Lượt mua: <?php echo $product->count_buy ?>
                    <br>Lượt xem: <?php echo $product->view ?></p>

            </td>
        </tr>
        <tr>
            <td>
                <h3>
                    <?php if ($product->discount > 0): ?>
                        <?php $price_new = $product->price - ($product->price * $product->discount / 100) ?>
                        <p>Giá tại <span style="font-family: SVN-Monday,sans-serif">carrot</span>: <b
                                    style="color: red">
                                <?php echo number_format($price_new) ?>&nbsp&nbsp;đ
                            </b>
                        </p>
                        <p style="font-size: 14px">
                            Tiết kiệm <?php echo number_format(($product->price) - ($price_new)) ?>&nbsp;đ
                        </p>
                        <br>
                        Giá gốc:
                        <div style="text-decoration: line-through">
                            <?php echo number_format($product->price) ?>&nbsp;đ
                        </div>
                    <?php else: ?>
                        Giá: <b><?php echo number_format($product->price) ?></b>đ
                    <?php endif; ?>
                    </span></h3>
                <br>
                <a class="btn btn-success" href="<?php echo base_url('cart/add/' . $product->id) ?>"
                   style="margin-left: 5px">MUA NGAY</a>
            </td>
        </tr>
        <tr>
            <div class="fb-like" data-href="http://www.bootstrappage.com/" data-send="false" data-layout="button_count"
                 data-width="80" data-show-faces="true"></div>
            <td>
            </td>
        </tr>
        <tr>
            <td>
                <br>
            </td>
            <td>
                <br>
            </td>
        </tr>
        <?php if (is_array($image_list)): ?>
            <tr>
                <?php foreach ($image_list as $img): ?>
                    <td>
                        <img src="<?php echo base_url('upload/product/' . $img) ?>"
                             style="width: 210px; margin-top: 10px">
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endif; ?>
    </table>
    <!--<div class="fb-comments" data-href="" data-numposts="20" width="100%" data-colorscheme="light" data-version="v2.9"></div>-->
    <div class="fb-comments" data-href="" data-width="100%" data-numposts="5" data-version="v2.9"></div>
</div>

