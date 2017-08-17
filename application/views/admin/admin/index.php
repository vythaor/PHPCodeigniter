<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/10/2017
 * Time: 2:52 PM
 */
//danh sach admin
$this->load->view('admin/admin/head', $this->data);
?>

<div class="form-inline" style="margin-bottom: 5px">
    <a href="<?php echo admin_url('admin/add') ?>">
        <button type="button" class="btn btn-primary">Thêm mới</button>
    </a>
    <!--<a href="<?php /*echo admin_url('admin/index')*/ ?>">
                <button type="button" class="btn btn-info btn-sm">Danh sách</button>-->
</div>
<!--<head>
    <link href="<?php /*echo public_url('css/admin.css'); */ ?>" rel="stylesheet" type="text/css">
</head>-->
<div id="tab">
    <?php $this->load->view('admin/admin/message.php', $this->data) ?>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" style="text-align: center">
            <thead>
            <tr>
                <th colspan="3">
                    Danh sách quản trị viên
                </th>
                <th>
                    Tổng số: <?php echo $total ?>
                </th>
            </tr>
            <tr>
                <td>
                    Mã số
                </td>
                <td>
                    Họ tên
                </td>
                <td>
                    Tài khoản
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
                        <?php echo $row->username ?>
                    </td>
                    <td>
                        <a href="<?php echo admin_url('admin/edit/' . $row->id) ?>" style="color: black">
                            <!--<img src="<?php /*echo public_url('images/icon-skill.png'); */?>" width="20px" title="Sửa">-->
                            <i class="fa fa-pencil-square-o" aria-hidden="true" title="Sửa">Sửa</i>
                        </a>
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <a href="<?php echo admin_url('admin/delete/' . $row->id) ?>" style="color:black;"
                           onclick="return confirm('Bạn chắc chắn muốn xóa?')">
                            <!--<img src="<?php /*echo public_url('images/icon-close.png'); */?>" width="20px" title="Xóa">-->
                            <i class="fa fa-times" aria-hidden="true" title="Xóa">Xóa</i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
