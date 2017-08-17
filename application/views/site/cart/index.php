<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/19/2017
 * Time: 2:19 AM
 */
?>
<div class="panel panel-default" style="width:50%; margin-left:340px; padding-left: 50px;padding-bottom: 50px">
    <form action="<?php echo base_url('cart/update') ?>" method="post">
        <h3 style="text-align: center">Thông tin giỏ hàng </h3><p style="text-align: center">(có <?php echo $total_items ?> sản phẩm)</p>
        <?php $total_amount = 0; ?>
        <?php foreach ($carts as $row): ?>
            <?php $total_amount += $row['subtotal']; ?>
            <div>
                Sản phẩm: <?php echo $row['name']; ?>
            </div>
            <div>
                Giá: <?php echo number_format($row['price']); ?>đ
            </div>
            <div>
                Số lượng <input type="number" name="qty_<?php echo $row['id'] ?>" value="<?php echo $row['qty']; ?>" min="1"
                onchange="this.form.submit()"/>
            </div>
                Tổng cộng: <b style="color: red"> <?php echo number_format($row['subtotal']); ?>đ</b>
                <br>
                <button class="btn btn-danger">
            <a href="<?php echo base_url('cart/del/' . $row['id']) ?>" style="text-decoration: none; color: white">Xóa</a>
                </button>
            <hr style="height: 5px">
        <?php endforeach; ?>
                <?php if(isset($total_items) > 1):?>
                    <button class="btn btn-danger">
                    <a href="<?php echo base_url('cart/del')?>" style="text-decoration: none; color: white">
                     Xóa toàn bộ
                    </a>
                    </button>
                <?php endif;?>
                <h4>Tổng cộng: <b style="color: red"><?php echo number_format($total_amount); ?>đ</b></h4>
        <div>
            <!--<button type="submit" class="btn btn-success" value="Cập nhật">Cập nhật</button>-->
            <button type="button" class="btn btn-warning">
                <a href="<?php echo site_url('order/checkout') ?>" style="text-decoration: none; color: white">
                    Đặt hàng
                </a>
            </button>
        </div>
    </form>
</div>

