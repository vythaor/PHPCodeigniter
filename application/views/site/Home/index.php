<?php $this->load->view('site/Home/message.php', $this->data) ?>
<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao * Date: 3/24/2017
 * Time: 1:52 AM
 */
$this->load->view('site/banner.php', $this->data);

?>
<div style="margin: 25px auto; margin-left: 30%">
    <?php $this->load->view('site/product/search_price_box') ?>
</div>
<div id="gohome">
    <a href="#" title="Về đầu trang">
        <img src="<?php echo public_url() ?>images/carrot_gohome.png"
             style="width: 70px"></a>
</div>
<div id="product">
    <h3 class="title" style="text-align: center;
    font-size: 32px;">Sản phẩm mới</h3>
    <hr>
    <?php foreach ($product_newest as $row): ?>
        <?php $name = convert_vi_to_en($row->name);
        $name = strtolower($name);
        ?>
        <a class="displayStyle" href="<?php echo base_url($name . '-p' . $row->id) ?>"
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
                <?php endif ?>
                <div class="img__wrap">
                    <img src="<?php echo base_url('upload/product/' . $row->image_link) ?>" class="image">
                    <div class="overlay">
                        <div class="text">
                            <?php if ($row->description != ""): ?>
                                <!-- <p class="img__description">--><?php echo $row->description ?>
                                <!--</p>-->
                            <?php else: ?>
                                <!--<p class="img__description">-->
                                <?php echo $row->name ?>
                                <!-- </p>-->
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
<div id="product">
    <div class="title" style="text-align: center; position: relative;
    font-size: 32px;">Bán chạy</div>
    <hr>
    <?php foreach ($product_buy as $row): ?>
        <?php $name = convert_vi_to_en($row->name);
        $name = strtolower($name);
        ?>
        <a class="displayStyle" href="<?php echo base_url($name . '-p' . $row->id) ?>"
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
                        <?php echo number_format($price_new) ?>&nbsp;đ
                    </b>

                    <div style="text-decoration: line-through">
                                <span>
                                    <?php echo number_format($row->price) ?>&nbsp;đ
                                </span>
                    </div>
                <?php else: ?>
                    <span><b><?php echo number_format($row->price) ?>&nbsp;đ</b>
                                </span>
                <?php endif; ?>
                <h5><b><?php echo $row->name ?></b></h5>
                <p><img src="<?php echo public_url() ?>images/buy.png" style="width: 20px; margin-right: 5px"
                        title="Lượt mua">
                    <b><?php echo $row->count_buy ?></b> |
                    <img src="<?php echo public_url() ?>images/view.png" style="width: 40px" title="Lượt xem">
                    <b><?php echo $row->view ?></b></p>


            </div>
        </a>
    <?php endforeach; ?>
</div>

<div id="product">
    <hr>
    <h3 class="title" style="text-align: center;
    font-size: 32px;">
        <span>Giảm giá hấp dẫn</span></h3>
    <hr>
    <?php foreach ($product_sale as $row): ?>
        <?php $name = convert_vi_to_en($row->name);
        $name = strtolower($name);
        ?>
        <a class="displayStyle" href="<?php echo base_url($name . '-p' . $row->id) ?>"
           title="<?php echo $row->name ?>">
            <div class="item">
                <?php if (isset($user_infor)): ?>
                    <?php $row->discount+=3?>
                <?php endif;?>
                <div id="sale">
                    -&nbsp;<?php echo $row->discount ?>%
                    <img src="<?php echo public_url() ?>images/sale-0.png" style="width: 40px; ">
                </div>
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
                        <?php echo number_format($price_new) ?>&nbsp;đ
                    </b>

                    <div style="text-decoration: line-through">
                                <span>
                                    <?php echo number_format($row->price) ?>&nbsp;đ
                                </span>
                    </div>
                <?php else: ?>
                    <span><b><?php echo number_format($row->price) ?>&nbsp;đ</b>
                                </span>
                <?php endif; ?>
                <h5><b><?php echo $row->name ?></b></h5>
                <p><img src="<?php echo public_url() ?>images/buy.png" style="width: 20px; margin-right: 5px"
                        title="Lượt mua">
                    <b><?php echo $row->count_buy ?></b> |
                    <img src="<?php echo public_url() ?>images/view.png" style="width: 40px" title="Lượt xem">
                    <b><?php echo $row->view ?></b></p>

            </div>
        </a>
    <?php endforeach; ?>
</div>



