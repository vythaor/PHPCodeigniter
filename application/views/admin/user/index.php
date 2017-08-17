<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 5/4/2017
 * Time: 5:06 PM
 */
$this->load->view('admin/user/head', $this->data);
?>

<div id="tab">
    <?php $this->load->view('admin/user/message.php', $this->data) ?>
    <form method="get" action="<?php echo admin_url('user') ?>">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" style="text-align: center">
                <thead>
                <tr>

                    <th colspan="7">
                        Danh sách khách hàng
                    </th>
                    <th>
                        Tổng số: <?php echo count($list) ?>/<?php echo $total ?>
                    </th>
                </tr>
                <tr>
                    <td colspan="8">
                        <div class="form-inline" style="padding:10px;">
                            <div class="input-group" style="margin-right: 20px">
                                <span class="input-group-addon">Lọc theo địa chỉ</span>
                                <input id="msg" type="text" class="form-control"
                                       value="<?php echo $this->input->get('province') ?>" name="province"
                                       style="width: 200px">
                            </div>
                            <input type="submit" value="Lọc" class="btn btn-success"
                                   style="margin-right: 20px; margin-left: 20px">
                            <input type="reset" value="Hủy"
                                   onclick="window.location.href = '<?php echo admin_url('user') ?>'; " value="Reset"
                                   class="btn btn-warning">
                        </div>
                    </td>
                </tr>
                <tr>

                    <td>
                        Mã số
                    </td>
                    <td>
                        Họ tên
                    </td>
                    <td>
                        Email
                    </td>
                    <td>
                        Điện thoại
                    </td>
                    <td>
                        Địa chỉ
                    </td>
                    <td>Tỉnh/thành</td>
                    <td>
                        Ngày tham gia
                    </td>
                    <td>
                        Hoạt động
                    </td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($list as $row): ?>
                    <tr>
                        <!--<td>
                            <input type="checkbox">
                        </td>-->
                        <td>
                            <?php echo $row->id ?>
                        </td>
                        <td>
                            <?php echo $row->name ?>
                        </td>
                        <td>
                            <?php echo $row->email ?>
                        </td>
                        <td>
                            <?php echo $row->phone ?>
                        </td>
                        <td>
                            <?php echo $row->address ?>&nbsp;
                        </td>
                        <td>
                            <?php echo $row->province ?>
                        </td>
                        <td>
                            <?php echo get_date($row->created) ?>
                        </td>
                        <td>
                            <a href="<?php echo admin_url('user/delete/' . $row->id) ?>"
                               onclick="return confirm('Bạn chắc chắn muốn xóa?')" style="color: black">
                                <i class="fa fa-times" aria-hidden="true" title="Xóa"></i>
                                <!--<img src="<?php /*echo public_url('images/icon-close.png'); */?>" width="20px" title="Xóa">-->
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </form>
</div>