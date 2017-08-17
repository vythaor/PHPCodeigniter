<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 5/11/2017
 * Time: 2:31 AM
 */?>
<div class="panel panel-default" style="width:50%; margin-left:340px; margin-top: 100px; padding-left: 50px;padding-bottom: 50px">
    <form action="<?php echo base_url('cart/update') ?>" method="post">
        <h3>Tình trạng đơn hàng</h3><p style="text-align: center">(có <?php echo $total_items ?> sản phẩm)</p>
        <?php $total_amount = 0; ?>
        <?php foreach ($carts as $row): ?>
            <?php $total_amount += $row['subtotal']; ?>
            <div>
                Sản phẩm: <?php echo $row['name']; ?>d
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
            <hr style="height: 5px">
        <?php endforeach; ?>
        <h4>Tổng cộng: <b style="color: red"><?php echo number_format($total_amount); ?>đ</b></h4>
        <div>
            <!--<button type="submit" class="btn btn-success" value="Cập nhật">Cập nhật</button>-->
            <div class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar"
                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
                    40%
                </div>
            </div>
        </div>
    </form>
</div>

