<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/18/2017
 * Time: 11:49 PM
 */
?>

<!--<head>
    <link rel="stylesheet/less" type="text/css" href="<?php /*echo public_url()*/ ?>master.css">
</head>-->
<div id="title">
    <a href="<?php echo base_url('product/category/' . $category->parent_id) ?>">
        <img src="<?php echo public_url() ?>images/carrot_logo.png" width="40px"
             title="Trở lại danh mục">
    </a>
    <span class="glyphicon glyphicon-arrow-right">
<a href="<?php echo base_url('product/category/' . $category->id) ?>"
   style="text-decoration: none;color: black;font-family: SVN-Monday, sans-serif; font-size: 30px">
    <?php echo $category->name ?>
</a>
</span>
    <p style="text-align: left; margin-left: 40px">(<?php echo $total_rows ?> sản phẩm)</p>
</div>
<div id="product">
    <hr>
    <?php foreach ($list as $row): ?>
        <?php $name = convert_vi_to_en($row->name);
        $name = strtolower($name);
        ?>
        <a class="displayStyle" href="<?php echo base_url($name.'-p'.$row->id) ?>"
           title="<?php echo $row->name ?>">
            <div class="item">
                <?php if (isset($user_infor)): ?>
                    <?php $row->discount+=3?>
                <?php endif;?>
                <?php if ($row->discount > 0): ?>
                    <div id="sale">
                        -&nbsp;<?php echo $row->discount ?>%
                        <img src="<?php echo public_url() ?>images/sale-0.png" style="width: 40px; ">
                    </div>
                <?php endif; ?>
                <div class="img__wrap">
                    <img src="<?php echo base_url('upload/product/' . $row->image_link) ?>" class="image">
                    <div class="overlay">
                        <div class="text">
                            <?php if ($row->description != ""): ?>
                                <?php echo $row->description ?>
                            <?php else: ?>
                                <?php echo $row->name ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php if ($row->discount > 0): ?>
                    <?php $price_new = $row->price - ($row->price * $row->discount / 100) ?>
                    <b style="color: red">
                        <?php echo number_format($price_new) ?>&nbsp;đ</b>
                    <div style="text-decoration: line-through">
                        <?php echo number_format($row->price) ?>&nbsp;đ
                    </div>
                <?php else: ?>
                    <b><?php echo number_format($row->price) ?>&nbsp;đ</b>
                <?php endif; ?>
                <h5><b><?php echo $row->name ?></b></h5>
                <p><img src="<?php echo public_url() ?>images/buy.png" style="width: 20px; margin-right: 5px"
                        title="Lượt mua">
                    <b><?php echo $row->count_buy ?></b> |
                    <img src="<?php echo public_url() ?>images/view.png" style="width: 40px" title="Lượt xem">
                    <b><?php echo $row->view ?></b>
                </p>
            </div>
        </a>
    <?php endforeach; ?>
</div>
<ul class="pagination" style="margin-top:50px;margin-left: 400px">
    <li><?php echo $this->pagination->create_links() ?></li>
</ul>
