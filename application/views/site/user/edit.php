<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/26/2017
 * Time: 1:18 AM
 */
?>
<?php $this->load->view('site/user/message.php', $this->data) ?>
<div id="register">
    <h3>Sửa thông tin thành viên</h3>
    <div class="container" style="width: 509px">
        <form method="post" action="<?php echo site_url('user/edit')?>">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="email" type="text" class="form-control" name="email" placeholder="<?php echo $user->email?>" disabled="yes">
            </div>
            <div name="name_error" class="">
                <?php echo form_error('email')?>
            </div>
            <br>
            <p>Chỉ nhập khi muốn đổi mật khẩu</p>
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
                <input id="name" type="text" class="form-control" name="username" placeholder="Họ tên" value="<?php echo $user->name?>">
            </div>
            <div name="name_error" class="">
                <?php echo form_error('username')?>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                <input id="phone" type="text" class="form-control" name="phone" placeholder="Số điện thoại" value="<?php echo $user->phone?>">
            </div>
            <div name="name_error" class="">
                <?php echo form_error('phone')?>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                <input id="address" type="text" class="form-control" name="province" placeholder="Tỉnh/thành" value="<?php echo $user->province?>">
            </div>
            <div name="name_error" class="">
                <?php echo form_error('province')?>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                <input id="address" type="text" class="form-control" name="address" placeholder="Địa chỉ" value="<?php echo $user->address?>">
            </div>
            <div name="name_error" class="">
                <?php echo form_error('address')?>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Cập nhật</button><span>&nbsp;</span>
            <button type="reset" class="btn btn-danger">
                <a href="<?php echo site_url('user')?>" style="text-decoration: none; color: white">Hủy</a>
            </button>
        </form>
        <br>

    </div>
</div>

