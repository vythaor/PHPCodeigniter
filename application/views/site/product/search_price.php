<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/24/2017
 * Time: 5:48 PM
 */
$price_from = $this->input->get('price_from');
$price_to = $this->input->get('price_to');
?>

<div id="product" style=" min-height: 100%">
    <h3>
        Kết quả tìm kiếm với giá từ "<?php echo number_format($price_from)?>đ" tới "<?php echo number_format($price_to)?>đ"
    </h3>
    <p style="text-align: left; margin-left: 40px">(<?php echo $total_rows?> sản phẩm)</p>
    <!--<div class="pagination" style="margin-top:50px;margin-left: 400px">
        <?php /*echo $this->pagination->create_links()*/?>
    </div>-->
    <?php foreach ($list as $row):?>
        <?php $name = convert_vi_to_en($row->name);
        $name = strtolower($name);
        ?>
        <a class="displayStyle" href="<?php echo base_url($name.'-p'.$row->id)?>"
           title="<?php echo $row->name?>">
            <div class="item">
                <?php if (isset($user_infor)): ?>
                    <?php $row->discount+=3?>
                <?php endif;?>
                <?php if($row->discount > 0):?>
                    <div id="sale">
                        -&nbsp;<?php echo $row->discount?>%
                        <img src="<?php echo public_url()?>images/sale-0.png" style="width: 40px; ">
                    </div>
                <?php endif;?>
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

                <?php if($row->discount > 0):?>
                    <?php $price_new = $row->price-($row->price*$row->discount/100)?>
                    <b style="color: red">
                        <?php echo number_format($price_new)?>&nbsp;đ</b>
                    <div style="text-decoration: line-through">
                        <?php echo number_format($row->price)?>&nbsp;đ
                    </div>
                <?php else:?>
                    <b><?php echo number_format($row->price)?> đ</b>
                <?php endif;?>
                <h5><b><?php echo $row->name?></b></h5>
                <p><img src="<?php echo public_url() ?>images/buy.png" style="width: 20px; margin-right: 5px"
                        title="Lượt mua">
                    <b><?php echo $row->count_buy ?></b> |
                    <img src="<?php echo public_url() ?>images/view.png" style="width: 40px" title="Lượt xem">
                    <b><?php echo $row->view ?></b>
                </p>
            </div>
        </a>
    <?php endforeach;?>
</div>



