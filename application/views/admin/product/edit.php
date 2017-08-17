<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/17/2017
 * Time: 4:17 AM
 */
$this->load->view('admin/product/head', $this->data);
?>
<a href="<?php echo admin_url('product/index') ?>">
    <button type="button" class="btn btn-info">Danh sách</button>
</a>
<a href="<?php echo admin_url('product/add') ?>">
    <button type="button" class="btn btn-primary">Thêm mới</button>
</a>
<div class="panel-heading">
    <h4>Sửa thông tin sản phẩm</h4>
</div>
<form class="form-horizontal" id="form" action="" method="post"
      enctype="multipart/form-data">
    <div class="form-group" style="height: 80px">
        <label class="control-label col-sm-2" for="param_name">Tên sản phẩm:<span class="req">*</span></label>
        <div class="col-sm-10">
            <input name="name" class="form-control" _autocheck="true" type="text"
                   value="<?php echo $product->name ?>" style="width: 450px"/>
            <div name="name_error" class="clear error">
                <?php echo form_error('name') ?>
            </div>
        </div>
    </div>
    <div class="form-group" style="height: 80px">
        <label class="control-label col-sm-2" for="param_name">Thể loại:<span class="req"></span></label>
        <div class="col-sm-10">
            <select name="category" style="width: 250px" id="sel1" class="form-control">
                <option value=""></option>
                <!-- kiem tra danh muc co danh muc con hay khong -->
                <?php foreach ($category as $row): ?>
                    <?php if (count($row->sub) > 1): ?>
                        <optgroup label="<?php echo $row->name ?>">
                            <?php foreach ($row->sub as $sub): ?>
                                <option value="<?php echo $sub->id ?>" <?php if ($sub->id == $product->category_id) echo 'selected'; ?>> <?php echo $sub->name ?> </option>
                            <?php endforeach; ?>
                        </optgroup>
                    <?php else: ?>
                        <option value="<?php echo $row->id ?>" <?php if ($row->id == $product->catalog_id) echo 'selected'; ?>><?php echo $row->name ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
            <div class="clear error" name="parent_id_error"><?php echo form_error('category') ?></div>
        </div>
    </div>
    <div class="form-group" style="height: 80px">
        <label class="control-label col-sm-2" for="param_name">Giá (VND):<span class="req"></span></label>
        <div class="col-sm-10">
            <input name="price" class="form-control" type="text"
                   value="<?php echo $product->price ?>" style="width: 250px"/>
            <span name="name_autocheck" class="autocheck"></span>
            <div name="name_error" class="clear error">
                <?php echo form_error('price') ?>
            </div>
        </div>
    </div>
    <div class="form-group" style="height: 80px">
        <label class="control-label col-sm-2" for="param_name">Giảm giá (%):<span class="req"></span></label>
        <div class="col-sm-10">
            <input name="discount" class="form-control" _autocheck="true" type="text"
                   value="<?php echo $product->discount ?>" style="width: 250px"/>
            <span name="name_autocheck" class="autocheck"></span>
            <div name="name_error" class="clear error">
                <?php echo form_error('discount') ?>
            </div>
        </div>
    </div>
    <?php $image_list = json_decode($product->image_list); ?>
    <div class="form_group" style="height: 110px">
        <label class="control-label col-sm-2" for="param_name">Hình ảnh:<span class="req"></span></label>
        <input type="file" name="image" id="image" size="25">
        <img src="<?php echo base_url('upload/product/' . $product->image_link) ?>" style="width:100px;height:70px">
        <div name="name_error" class="clear error">
            <?php echo form_error('image') ?>
        </div>
    </div>
    <div class="form_group" style="height: 110px">
        <label class="control-label col-sm-2" for="param_name">Ảnh kèm theo:<span class="req"></span></label>
        <input type="file" multiple="" name="image_list[]" id="image_list" size="25">
        <?php if (is_array($image_list)): ?>
            <?php foreach ($image_list as $img): ?>
                <img src="<?php echo base_url('upload/product/' . $img) ?>" style="width:100px;height:70px;margin:5px">
            <?php endforeach; ?>
        <?php endif; ?>
        <div name="name_error" class="clear error">
            <?php echo form_error('image') ?>
        </div>
    </div>
    <div class="form_group" style="height: 80px">
        <label class="control-label col-sm-2" for="param_name">Mô tả:<span class="req"></span></label>
        <div class="col-sm-10">
                    <textarea name="description" class="form-control" _autocheck="true"
                              value="<?php echo $product->description ?>" style="width: 350px; height: 100px">
                        <?php echo $product->description ?>
                    </textarea>
            <span name="name_autocheck" class="autocheck"></span>
            <div name="name_error" class="clear error">
                <?php echo form_error('description') ?>
            </div>
        </div>
    </div>
    <div class="form-group" style="margin-top: 50px;margin-left: 170px">
        <div class="col-sm-10">
            <input type="submit" value="Cập nhật" class="btn btn-success" style="margin-right: 60px"/>
            <a href="<?php echo admin_url('product/index') ?>">
                <input type="reset" value="Hủy bỏ" class="btn btn-danger"/>
            </a>
        </div>
    </div>
</form>
