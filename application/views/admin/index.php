<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/26/2017
 * Time: 4:28 AM
 */

$this->load->view('admin/order_infor/head', $this->data);
$created = $this->input->get('created');
$created_to = $this->input->get('created_to');
?>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="<?php echo public_url('custom_admin.js'); ?>"></script>
    <link type=rel="stylesheet" href="<?php echo public_url('css/admin.css') ?>"/>
    <script>
        $('#select_all').change(function () {
            var checkboxes = $(this).find(':checkbox').not($(this));
            if ($(this).is(':checked')) {
                checkboxes.prop('checked', true);
            } else {
                checkboxes.prop('checked', false);
            }
        });
    </script>

</head>
<body>
<?php $this->load->view('admin/admin/message.php', $this->data) ?>

<div class="container">

    <table class="tbl-list" style="width: 1000px">
        <thead>
        <tr>
            <form method="get" action="<?php echo admin_url('order_infor') ?>" class="list_filter form">
        <tr>

            <th colspan="5">
                Danh sách giao dịch
            </th>
            <th>
                Tổng Số: <?php echo $total_rows ?>
            </th>
        </tr>
        <tr>
            <td colspan="6">
                <div class="form-inline" style="padding:6px;">
                    <div class="input-group" style="margin-right: 20px">
                        <span class="input-group-addon">Mã số</span>
                        <input id="id" type="text" class="form-control"
                               value="<?php echo $this->input->get('id') ?>" name="id" style="width: 60px">
                    </div>
                    <div class="input-group" style="margin-right: 20px">
                        <span class="input-group-addon">Thanh toán</span>
                        <select name="payment" class="form-control"> <!--value="<?php /*echo $this->input->get('payment') */?>" name="payment" style="width: 100px"-->
                            <option  value=<?php echo 'shipcod'?>>
                                shipcod
                            </option>
                            <option value=<?php echo 'Bảo Kim'?> >
                                Bảo Kim
                            </option>
                            <option value=<?php echo 'Ngân Lượng'?>>
                                Ngân Lượng
                            </option>
                           <!-- <option <?php /*echo('&nbsp') ? 'selected' : ''*/?>  >
                                &nbsp;
                            </option>-->
                        </select>
                    </div>
                    <div class="input-group" style="margin-right: 20px">
                        <span class="input-group-addon">Từ ngày</span>
                        <input id="msg" type="date" class="form-control"
                               value="<?php echo ($this->input->get('created')) ?>" name="created"
                               style="width: 150px">
                    </div>
                    <div class="input-group" style="margin-right: 20px">
                        <span class="input-group-addon">Đến ngày</span>
                        <input id="msg" type="date" class="form-control"
                               value="<?php echo ($this->input->get('created_to')) ?>" name="created_to"
                               style="width: 150px">
                    </div>
                    <div class="input-group" style="margin: 20px">
                        <span class="input-group-addon">Thành viên</span>
                        <input id="msg" type="text" class="form-control"
                               value="<?php echo $this->input->get('user_name') ?>" name="user"
                               style="width: 140px">
                    </div>
                    <div class="input-group" style="margin-right: 20px">
                        <span class="input-group-addon">Trạng thái</span>
                        <select class="form-control" name="status">
                            <option></option>
                            <option value="0">
                                Đang xử lý
                            </option>
                            <option value="1">
                                Đã giao hàng
                            </option>
                            <option value="2">
                                Đã hủy
                            </option>
                        </select>
                        <!--<input id="msg" type="text" class="form-control"
                               value="<?php /*echo $this->input->get('user_name') */ ?>" name="user" style="width: 100px">-->
                    </div>

                    <div class="input-group" style="margin-right: 20px">
                        <input type="submit" value="Lọc" class="btn btn-success"
                               style="margin-right: 20px;">
                        <input type="reset" value="Hủy"
                               onclick="window.location.href = '<?php echo admin_url('order_infor') ?>'; "
                               value="Reset"
                               class="btn btn-warning">
                    </div>
                </div>
            </td>
        </tr>
        </thead>
        <tbody>
        <tr>

        </tr>
        <tr>
            <td>
                Mã giao dịch
            </td>
            <td>
                Số tiền thanh toán
            </td>
            <td>
                Cổng thanh toán
            </td>
            <td>
                Trạng thái
            </td>
            <td>
                Ngày tạo
            </td>
            <td>
                Hoạt động
            </td>
        </tr>
        <ul class="pagination" style="margin-top:50px;margin-left: 400px">
            <li><?php echo $this->pagination->create_links() ?></li>
        </ul>

        <?php foreach ($list as $row): ?>
            <tr class="row_<?php echo $row->id ?>">
                <td>
                    <?php echo $row->id ?>
                </td>
                <td>
                    <?php
                    echo $row->amount
                    ?> đ
                </td>
                <td>
                    <?php echo $row->payment ?>
                </td>
                <td>
                    <?php
                    if ($row->status == 0) {
                        echo 'Đang xử lý';
                    } elseif ($row->status == 1) {
                        echo 'Đã giao hàng';
                    } else {
                        echo 'Đã hủy';
                    }
                    ?>
                </td>
                <td>
                    <?php echo get_date($row->created) ?>
                </td>
                <td>
                    <a title="Xem chi tiết giao dịch" class="tipS lightbox" target="_blank"
                       href="<?php echo admin_url('order_infor/view/' . $row->id) ?>">
                        <img src="<?php echo public_url('images/icon-skill.png'); ?>" width="20px" title="Sửa">

                    </a>
                    <a href="<?php echo admin_url('order_infor/delete/' . $row->id) ?>">
                        <img src="<?php echo public_url('images/icon-close.png'); ?>" width="20px" title="Xóa">
                    </a>
                </td>
            </tr>

        <?php endforeach; ?>
        </tbody>
        <tfoot class="auto_check_pages">
        </tfoot>
    </table>

</div>

</body>



