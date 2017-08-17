<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/15/2017
 * Time: 4:56 AM
 */
//danh sach mat hang
$this->load->view('admin/category/head', $this->data);
?>

<head>
    <script href="<?php echo public_url('custom_admin.js'); ?>" type="text/javascript"></script>
</head>
<a href="<?php echo admin_url('category/add') ?>" style="margin-bottom: 5px">
    <button type="button" class="btn btn-primary">Thêm mới</button>
</a>
<div id="tab">
    <?php $this->load->view('admin/category/message.php', $this->data) ?>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" style="text-align: center">
            <thead>
            <tr>
                <th colspan="2">
                    Danh sách danh mục sản phẩm
                </th>
                <th>
                    Tổng số: <?php echo count($list) ?>
                </th>
            </tr>
            <tr>
                <td>
                    Mã số
                </td>
                <td>
                    Tên danh mục
                </td>
                <td>
                    Hoạt động
                </td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($list as $row): ?>
                <tr>
                    <td>
                        <?php echo $row->id ?>
                    </td>
                    <td>
                        <?php echo $row->name ?>
                    </td>
                    <!--<td>
                    <?php /*echo $row->sort*/ ?>
                </td>-->
                    <td>
                        <a href="<?php echo admin_url('category/edit/' . $row->id) ?>" style="color: black; margin-right: 10px">
                            <!--<img src="<?php /*echo public_url('images/icon-skill.png'); */?>" width="20px" title="Sửa">-->
                            <i class="fa fa-pencil-square-o" aria-hidden="true" title="Sửa">Sửa</i>
                        </a>
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <a href="<?php echo admin_url('category/delete/' . $row->id) ?>" style="color: black"
                           onclick="return confirm('Bạn chắc chắn muốn xóa?')">
                            <!--<img src="<?php /*echo public_url('images/icon-close.png'); */?>" width="20px" title="Xóa">-->
                            <i class="fa fa-times" aria-hidden="true" title="Xóa">Xóa</i>

                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <!-- <tr>
                 <th colspan="8">
                     <input type="button" style="margin-left: -700px">
                 </th>
             </tr>-->
            </tbody>
        </table>
    </div>
</div>
