<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/15/2017
 * Time: 3:13 AM
 */
$this->load->view('admin/admin/head', $this->data);
?>
<div class="form-inline">
    <a href="<?php echo admin_url('admin/add') ?>">
        <button type="button" class="btn btn-primary">Thêm mới</button>
    </a>
    <a href="<?php echo admin_url('admin/index') ?>">
        <button type="button" class="btn btn-info">Danh sách</button>
    </a>
</div>
<!-- Form -->
<div class="panel-heading">
    <h4>Sửa thông tin thành viên quản trị</h4>
</div>
<form class="form-horizontal" id="form" action="" method="post" enctype="multipart/form-data">
    <div class="col-lg-6">
        <div class="form_group" style="height: 80px">
            <label class="control-label col-sm-2" for="param_name">Tên:<span class="req">*</span></label>
            <div class="col-sm-10">
                <input name="name" class="form-control" _autocheck="true" type="text"
                       value="<?php echo $info->name ?>" style="width: 250px"/>
                <span name="name_autocheck" class="autocheck"></span>
                <div name="name_error" class="clear error">
                    <?php echo form_error('name') ?>
                </div>
            </div>
            <div class="clear"></div>
        </div>

        <div class="form_group" style="height: 80px">
            <label class="control-label col-sm-2" for="param_name">Tài khoản:<span class="req">*</span></label>
            <div class="col-sm-10">
                <input name="username" class="form-control" _autocheck="true" type="text"
                       value="<?php echo $info->username ?>" style="width: 250px"/>
                <span name="name_autocheck" class="autocheck"></span>
                <div name="name_error" class="clear error">
                    <?php echo form_error('username') ?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="form_group" style="height: 50px">
            <label class="control-label col-sm-2" for="param_name">Quyền:<span
                        class="req">*</span></label>
            <div class="col-sm-10">
                <?php foreach ($config_permission as $controller => $actions): ?>
                    <div class="form-inline">
                        <b><?php echo $controller ?>:</b>&nbsp;
                        <?php foreach ($actions as $action): ?>
                            <?php
                            $permision_act = array();
                            if (isset($info->permission->{$controller})) {
                                $permision_act = $info->permission->{$controller};
                            }
                            ?>
                            <input type="checkbox" class="form-control"
                                   name="permission[<?php echo $controller ?>][]" value="<?php echo $action ?>"
                                   title="pemission"
                                <?php echo (in_array($action, $permision_act)) ? 'checked' : '' ?>
                            >
                            &nbsp;
                            <?php echo $action ?>
                            &nbsp;&nbsp;
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6">

        <div class="form_group" style="height: 80px">
            <label class="control-label col-sm-2" for="param_name">Mật khẩu:<span class="req">*</span></label>
            <div class="col-sm-10">
                <input name="password" class="form-control" _autocheck="true" type="password" style="width: 250px"/>
                <p>Chỉ nhập giá trị nếu cập nhật mật khẩu</p>
                <span name="name_autocheck" class="autocheck"></span>
                <div name="name_error" class="clear error">
                    <?php echo form_error('password') ?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="form_group" style="height: 80px">
            <label class="control-label col-sm-2" for="param_name">Nhập lại mật khẩu:<span
                        class="req">*</span></label>
            <div class="col-sm-10">
                <input name="repass" class="form-control" _autocheck="true"
                       type="password" style="width: 250px"/>
                <span name="name_autocheck" class="autocheck"></span>
                <div name="name_error" class="clear error">
                    <?php echo form_error('repass') ?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>

    <div class="form-group" style="margin-top: 30px;margin-left: 130px">
        <div class="col-sm-10">
            <input type="submit" value="Cập nhật" class="btn btn-success" style="margin-right: 60px"/>
            <a href="<?php echo admin_url('admin/index') ?>">
                <input type="reset" value="Hủy bỏ" class="btn btn-danger"/>
            </a>
        </div>
    </div>
</form>

