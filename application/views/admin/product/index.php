<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/15/2017
 * Time: 4:15 PM
 */
$this->load->view('admin/product/head', $this->data);
?>
<a href="<?php echo admin_url('product/add') ?>">
    <button type="button" class="btn btn-primary">Thêm mới</button>
</a>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="<?php echo public_url('custom_admin.js'); ?>"></script>
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

<?php $this->load->view('admin/product/message.php', $this->data) ?>
<form method="get" action="<?php echo admin_url('product') ?>" class="list_filter form">
    <ul class="pagination" style="margin-left: 390px">
        <li><?php echo $this->pagination->create_links() ?></li>
    </ul>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" style="text-align: center">
            <thead>
            <tr>
               <!-- <th>
                    <div>
                        <input type="checkbox" id="select_all"/>
                    </div>
                </th>-->
                <th colspan="4">
                    Danh sách sản phẩm
                </th>
                <th>
                    Tổng Số: <?php echo $total_rows ?>
                </th>
            </tr>
            <tr>
                <td colspan="6">
                    <div class="form-inline" style="padding:10px;">
                        <div class="input-group" style="margin-right: 20px">
                            <span class="input-group-addon">Mã số</span>
                            <input id="msg" type="text" class="form-control"
                                   value="<?php echo $this->input->get('id') ?>" name="id" style="width: 100px">
                        </div>
                        <div class="input-group" style="margin-right: 20px">
                            <span class="input-group-addon">Tên sản phẩm</span>
                            <input id="msg" type="text" class="form-control"
                                   value="<?php echo $this->input->get('name') ?>" name="name">
                        </div>
                        <div class="input-group" style="margin-right: 30px">
                            <span class="input-group-addon">Thể loại</span>
                            <form method="get" action="<?php echo admin_url('product') ?>">
                                <select name="category" id="sel1" class="form-control" style="width: 150px">
                                    <option value=""></option>
                                    <!-- kiem tra danh muc co danh muc con hay khong -->
                                    <?php foreach ($category as $row): ?>
                                        <?php if (count($row->sub) > 1): ?>
                                            <optgroup label="<?php echo $row->name ?>">
                                                <?php foreach ($row->sub as $sub): ?>
                                                    <option value="<?php echo $sub->id ?>"
                                                        <?php echo ($this->input->get('category') == $sub->id) ? 'selected' : '' ?>>
                                                        <?php echo $sub->name ?> </option>
                                                <?php endforeach; ?>
                                            </optgroup>
                                        <?php else: ?>
                                            <option value="<?php echo $row->id ?>"
                                                <?php echo ($this->input->get('category') == $row->id) ? 'selected' : '' ?>>
                                                <?php echo $row->name ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>

                                <input type="submit" value="Lọc" class="btn btn-success"
                                       style="margin-right: 20px; margin-left: 20px">
                                <input type="reset" value="Hủy"
                                       onclick="window.location.href = '<?php echo admin_url('product') ?>'; "
                                       value="Reset"
                                       class="btn btn-warning">
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            </thead>
            <tbody>
            <tr>

            </tr>
            <tr>
                <!--<td>
                </td>-->
                <td>
                    Mã số
                </td>
                <td>
                    Tên sản phẩm
                </td>
                <td>
                    Giá
                </td>
                <td>
                    Ngày tạo
                </td>
                <td>
                    Hoạt động
                </td>
            </tr>

            <?php foreach ($list as $row): ?>
                <tr class="row_<?php echo $row->id ?>">
                    <!--<td>
                        <input type="checkbox" value="<?php /*echo $row->id */?>" name="id[]">
                    </td>-->
                    <td>
                        <?php echo $row->id ?>
                    </td>
                    <td>
                        <div class="image_thumb">
                            <img src="<?php echo base_url('upload/product/' . $row->image_link) ?>" height="50">
                            <div class="clear"></div>
                        </div>

                        <a href="" class="tipS" title="" target="_blank" style="color: black">
                            <b><?php echo $row->name ?></b>
                        </a>

                        <div class="f11">
                            Đã bán: <?php echo $row->count_buy ?> |
                            Xem: <?php echo $row->view ?>                    </div>
                    </td>
                    <td>
                        <?php if ($row->discount > 0): ?>
                            <?php $price_new = $row->price - ($row->price * $row->discount / 100) ?>
                            <b style="color: red"><?php echo number_format($price_new) ?></b>
                            <p style="text-decoration: line-through">
                                <?php echo number_format($row->price) ?>
                            </p>
                        <?php else: ?>
                            <b><?php echo number_format($row->price) ?></b>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo get_date($row->created) ?>
                    </td>
                    <td>
                        <a href="<?php echo admin_url('product/edit/' . $row->id) ?>" style="color: black; margin-right: 10px">
                            <!--<img src="<?php /*echo public_url('images/icon-skill.png'); */?>" width="20px" title="Sửa">-->
                            <i class="fa fa-pencil-square-o" aria-hidden="true" title="Sửa">Sửa</i>
                        </a>
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <a href="<?php echo admin_url('product/delete/' . $row->id) ?>"
                           onclick="return confirm('Bạn chắc chắn muốn xóa?')" style="color: black">
                            <!--<img src="<?php /*echo public_url('images/icon-close.png'); */?>" width="20px" title="Xóa">-->
                            <i class="fa fa-times" aria-hidden="true" title="Xóa">Xóa</i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

            </tbody>
            <!--<tfoot class="auto_check_pages">
    <tr>
        <td colspan="6">
            <div class="list_action itemActions">
                <a url="<?php /*echo admin_url('product/delete_all') */ ?>" id="submit" href="#submit">
                    <button type="button" class="btn btn-danger">Xóa hết</button>
                </a>
            </div>


        </td>
    </tr>-->
        </table>
    </div>
</form>


