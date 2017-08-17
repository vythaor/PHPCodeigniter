<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 5/1/2017
 * Time: 3:48 AM
 */
$this->load->helper('language');
$this->load->view('admin/order_infor/head', $this->data);
?>
<script type="text/javascript">
    (function ($) {
        $(document).ready(function () {

        });
    })(jQuery);
</script>
<!--<style>
    .list_product_info {
        width: 480px;
        float: left;
    }

    .list_product_info li {
        width: 230px;
        float: left;
    }

    .action {
        float: right;
        padding-top: 15px;
    }
</style>-->

    <div class="panel-heading">
        <h4>Chi tiết giao dịch</h4>
    </div>
    <form action="<?php echo admin_url('order_infor/active')?>" method="get">
    <div class="panel-body" style="height: 400px">
        <table style="color: black; font-size: 12px;">
            <tr>
                <td colspan="2"><b> Thông tin thanh toán</b></td>
                <td colspan="2"><b>Thông tin khách hàng </b></td>
            </tr>
            <tr>
                <td>Mã giao dịch:</td>
                <td><?php echo $infor->id; ?></td>
                <td>Họ tên:</td>
                <td><?php echo $infor->user_name; ?></td>
            </tr>
            <tr>
                <td>Ngày tạo:</td>
                <td><?php echo mdate('%d-%m-%Y', $infor->created) ?>
                </td>
                <td>Email:</td>
                <td><?php echo $infor->user_email; ?></td>
            </tr>
            <tr>
                <td>Số tiền:</td>
                <td><?php echo $infor->amount; ?></td>
                <td>Điện thoại:</td>
                <td><?php echo $infor->user_phone; ?></td>
            </tr>
            <tr>
                <td>Hình thức:</td>
                <td>
                    <?php echo $infor->payment; ?>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="4"><b>Thông tin đơn hàng:</b></td>
            </tr>
            <?php foreach ($orders as $row): ?>
                <tr>
                    <td rowspan="3">
                        <a target='_blank' href='<?php echo $row->product->_url_view; ?>'
                           title='<?php echo $row->product->name; ?>' style="">
                            <img class="left dInline mr10" style="width:100px; max-height:100px;"
                                 src='<?php echo $row->product->image; ?>' alt='<?php echo $row->product->name; ?>'>
                        </a>
                    </td>
                    <td>
                        <a target='_blank' href='<?php echo $row->product->_url_view; ?>' style="color: blue"
                           title='<?php echo $row->product->name; ?>'>
                            <?php echo $row->product->name; ?>
                        </a>
                    </td>
                    <td>
                        <span>Trạng thái:</span>
                        <?php echo $row->_status; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Giá:
                        <?php echo $row->_price; ?>
                    </td>
                    <td>
                        <span>Tổng tiền:</span> <font
                                class="red f15"><?php echo $row->_amount; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Số lượng:<?php echo $row->quantity; ?>
                    </td>
                    <!--<td>
                    <div class='action'>
                        <?php /*if ($row->_can_active): */?>
                            <a href="<?php /*echo $row->_url_active; */?>" class="button blueB mr5">
                                <span><?php /*echo lang('active'); */?></span>
                            </a>
                        <?php /*endif; */?>

                        <?php /*if ($row->_can_cancel): */?>
                            <a href="<?php /*echo $row->_url_cancel; */?>" class="button redB mr5"><span>
						<?php /*echo lang('cancel'); */?></span></a>
                        <?php /*endif; */?>
                    </div>
                    </td>-->
                    <td>
                        <!--<input type="submit" value="Kích hoạt" class="btn btn-success"
                               style="margin-right: 20px;">
                        <input type="reset" value="Hủy"
                               onclick="window.location.href = '<?php /*echo admin_url('order_infor') */?>'; "
                               value="Hủy"
                               class="btn btn-warning">-->
                        <div class='action'>
                            <?php if ($row->_can_active): ?>
                                <a href="<?php echo $row->_url_active; ?>" class="">
                                    <button type="button" class="btn btn-success">Kích hoạt</button>
                                </a>
                            <?php endif; ?>

                            <?php if ($row->_can_cancel): ?>
                                <a href="<?php echo $row->_url_cancel; ?>"  class="button redB mr5"><span>
						<?php echo lang('cancel'); ?></span>
                                </a>
                            <?php endif;?>

                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    </form>

