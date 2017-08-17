<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/24/2017
 * Time: 6:42 PM
 */
?>
<div id="register">
    <h3>Đăng ký thành viên</h3>
    <p style="text-align: center">
    <br>Đăng ký thành viên để được nhận nhiều ưu đãi hấp dẫn
    </p>
    <p style="text-align: center">Bạn đã có tài khoản?
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
            <a href="<?php echo site_url('user/login') ?>" title="Đăng nhập" style="color: white; text-decoration: none">Đăng nhập</a>
        </button>
    <div class="container" style="width: 509px">


        <form method="post" action="<?php echo site_url('user/register')?>">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="email" type="text" class="form-control" name="email" placeholder="Email" value="<?php echo set_value('email')?>">
            </div>
            <div name="name_error" class="">
                <?php echo form_error('email')?>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input id="password" type="password" class="form-control" name="password" placeholder="Mật khẩu">
            </div>
            <div name="name_error" class="">
                <?php echo form_error('password')?>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input id="repassword" type="password" class="form-control" name="repassword" placeholder="Nhập lại mật khẩu">
            </div>
            <div name="name_error" class="">
                <?php echo form_error('repassword')?>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                <input id="name" type="text" class="form-control" name="username" placeholder="Họ tên" value="<?php echo set_value('name')?>">
            </div>
            <div name="name_error" class="">
                <?php echo form_error('username')?>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                <input id="phone" type="text" class="form-control" name="phone" placeholder="Số điện thoại" value="<?php echo set_value('phone')?>">
            </div>
            <div name="name_error" class="">
                <?php echo form_error('phone')?>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                <input id="address" type="text" class="form-control" name="province" placeholder="Tỉnh/thành" value="<?php echo set_value('address')?>">
            </div>
            <div>

            </div>
            <div name="name_error" class="">
                <?php echo form_error('address')?>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                <input id="address" type="text" class="form-control" name="address" placeholder="Số nhà, đường, phường/xã, Quận/huyện  " value="<?php echo set_value('address')?>">
            </div>
            <div>

            </div>
            <div name="name_error" class="">
                <?php echo form_error('address')?>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Đăng ký</button><span>&nbsp;</span>
            <button type="reset" class="btn btn-danger">Hủy</button>
        </form>
        <br>

    </div>
</div>
