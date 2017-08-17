<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/25/2017
 * Time: 2:14 PM
 */
?>
<?php $this->load->view('site/user/message.php', $this->data) ?>
<div div class="container" style="margin-top: 100px; width: 60%">
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading"><h3>Thông tin tài khoản</h3></div>
            <div class="panel-body">
                Họ tên: <?php echo $user->name ?>
                <br>
                Email: <?php echo $user->email?>
                <br>
                Số điện thoại: <?php echo $user->phone ?>
                <br>
                Địa chỉ: <?php echo $user->address ?>&nbsp;<?php echo $user->province?>
            </div>
        </div>
        </div>
    <button type="button" class="btn btn-info">
        <a href="<?php echo site_url('user/edit')?>" style="color: white; text-decoration: none">Sửa</a>
    </button>
</div>
