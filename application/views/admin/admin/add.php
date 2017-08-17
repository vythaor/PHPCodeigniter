<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/12/2017
 * Time: 9:48 PM
 */
$this->load->view('admin/admin/head', $this->data);
?>
<script type="text/javascript" xmlns="http://www.w3.org/1999/html">
    (function ($) {
        $(document).ready(function () {
            var main = $('#form');
            main.contentTabs();
        });
    })(jQuery);
</script>
<!-- Form -->
<div class="form-inline">
    <a href="<?php echo admin_url('admin/index') ?>">
        <button type="button" class="btn btn-info">Danh sách</button>
    </a>
    <!--<a href="<?php /*echo admin_url('admin/index')*/ ?>">
                <button type="button" class="btn btn-info btn-sm">Danh sách</button>-->
</div>
<div class="panel-heading">
    <h4>Thêm mới thành viên quản trị</h4>
</div>
<form class="form-horizontal" id="form" action="" method="post"
      enctype="multipart/form-data">
    <div class="col-lg-6">
        <div class="form_group" style="height: 80px">
            <label class="control-label col-sm-2" for="param_name">Tên:<span class="req">*</span></label>
            <div class="col-sm-10">
                <input name="name" class="form-control" _autocheck="true" type="text"
                       value="<?php echo set_value('name') ?>" style="width: 250px"/>
                <span name="name_autocheck" class="autocheck"></span>
                <div name="name_error" class="clear error">
                    <?php echo form_error('name') ?>
                </div>
            </div>
        </div>

        <div class="form_group" style="height: 80px">
            <label class="control-label col-sm-2" for="param_name">Tài khoản:<span class="req">*</span></label>
            <div class="col-sm-10">
                <input name="username" class="form-control" _autocheck="true" type="text"
                       value="<?php echo set_value('username') ?>" style="width: 250px"/>
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
                            <input type="checkbox" class="form-control"
                                   name="permission[<?php echo $controller ?>][]"
                                   value="<?php echo $action ?>" title="pemission">
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
                <input name="password" class="form-control" _autocheck="true" type="password"
                       value="<?php echo set_value('password') ?>" style="width: 250px"/>
                <span name="name_autocheck" class="autocheck"></span>
                <div name="name_error" class="clear error">
                    <?php echo form_error('password') ?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="form_group" style="height: 50px">
            <label class="control-label col-sm-2" for="param_name">Nhập lại mật khẩu:<span
                        class="req">*</span></label>
            <div class="col-sm-10">
                <input name="repass" class="form-control" _autocheck="true" type="password"
                       value="<?php echo set_value('repass') ?>" style="width: 250px"/>
                <span name="name_autocheck" class="autocheck"></span>
                <div name="name_error" class="clear error">
                    <?php echo form_error('repass') ?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="row">
        <div class="form-group" style="margin-top: 40px;margin-left: 110px">
            <div class="col-sm-10">
                <input type="submit" value="Thêm mới" class="btn btn-success" style="margin-right: 60px"/>
                <input type="reset" value="Hủy bỏ" class="btn btn-danger"/>
            </div>
        </div>
    </div>
</form>
