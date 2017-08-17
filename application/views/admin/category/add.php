<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/15/2017
 * Time: 3:04 PM
 */
$this->load->view('admin/category/head', $this->data);
?>
<a href="<?php echo admin_url('category/index') ?>">
    <button type="button" class="btn btn-info">Danh sách</button>
</a>
<div class="panel-heading">
    <h4>Thêm mới danh mục sản phẩm</h4>
</div>

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <div class="form-group" style="height: 80px">
        <label class="control-label col-sm-2" for="param_name">Tên danh mục:<span class="req">*</span></label>
        <div class="col-sm-10">
            <input name="name" id="name" class="form-control" _autocheck="true" type="text"
                   style="width: 250px"/>
            <span name="name_autocheck" class="autocheck"></span>
            <div name="name_error" class="clear error">
                <?php echo form_error('name') ?>
            </div>
        </div>
    </div>
    <div class="form-group" style="height: 80px">
        <label class="control-label col-sm-2" for="param_name">Danh mục cha:<span class="req">*</span></label>
        <div class="col-sm-10">
            <select name="parent_id" style="width: 250px" id="sel1" class="form-control" _autocheck="true">
                <option value="0">
                    Là danh mục cha
                </option>
                <?php foreach ($list as $row): ?>
                    <option value="<?php echo $row->id ?>">
                        <?php echo $row->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <span name="name_autocheck" class="autocheck"></span>
            <div name="name_error" class="clear error">
                <?php echo form_error('parent_id') ?>
            </div>
        </div>
    </div>


    <div class="form-group" style="margin-left: 170px">
        <div class="col-sm-10">
            <input type="submit" value="Thêm mới" class="btn btn-success" style="margin-right: 50px"/>
            <a href="<?php echo admin_url('category/index') ?>">
                <input type="reset" value="Hủy bỏ" class="btn btn-danger"/>
            </a>
        </div>
    </div>
</form>

