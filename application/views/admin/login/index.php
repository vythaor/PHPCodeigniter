<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 3/24/2017
 * Time: 7:37 PM
 */

?>
<!DOCTYPE html>
<html>
<head>
    <link href="<?php echo public_url('css/login.css'); ?>" rel="stylesheet" type="text/css">
    <script src="<?php echo public_url('jquery-3.2.1.min.js') ?>"></script>
    <script src="<?php echo public_url('bootstrap-3.3.7-dist/js/bootstrap.min.js') ?>"></script>
    <link type="text/css" rel="stylesheet"
          href="<?php echo public_url('bootstrap-3.3.7-dist/css/bootstrap.min.css') ?>"/>
    <title>Administrator</title>
    <link rel="icon" href="<?php echo public_url() ?>images/carrot_logo.png">
</head>
<body style="margin-left: 450px">
<!--<div id="splogo">
    <a href="#">
        <img src="<?php /*echo public_url('images\logocr.png"') */?>"
             id="logo" style="margin-top: 20px">
    </a>
</div>-->
<div class="panel panel-default" style="margin-top: 100px; width: 500px; text-align: center">
    <div class="panel-heading"><h4>Đăng Nhập Trang Quản Trị</h4></div>
    <div class="panel-body">
        <form method="post">
            <div class="input-txt" style="margin-left: 80px">
                <div class="input-group" style="width: 300px">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="email" type="text" class="form-control" name="username" placeholder="Tên đăng nhập">
                </div>

                <br><br>
                <div class="input-group" style="width: 300px">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Mật khẩu">
                </div>
            </div>
            <!--<p style="margin-left:-120px">
                <input type="checkbox" id="checkKeepLogin" style="margin-left: 100px"/>Duy trì đăng nhập
            </p>-->
            <p>
                <?php echo form_error('login'); ?>
            </p>
            <br>
            <p>
                <button type="submit" class="btn btn-success" name="submit">Đăng nhập</button>
                <span>&nbsp;</span>
            </p>
        </form>
    </div>
    <div id="footer">
        <div>
            <i class="fa fa-envelope"></i>
            <p><a href="mailto:vythao219@gmail.com">vythao219@gmail.com</a></p>
        </div>
        <p class="footer-company-name">Carrot Shop &copy; Tháng 5 - 2017</p>
    </div>
</div>
</body>
</html>
