<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/25/2017
 * Time: 4:26 AM
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/24/2017
 * Time: 6:42 PM
 */
?>

<div id="register">
    <h3>Đăng nhập</h3>
    <div class="container" style="width: 509px">
        <form method="post" action="<?php echo site_url('user/login')?>">
            <h4><?php echo form_error('login')?></h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="email" type="text" class="form-control" name="email" placeholder="Email">
            </div>

            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input id="password" type="password" class="form-control" name="password" placeholder="Mật khẩu">
            </div>
            <!--<div name="name_error" class="">
                <?php /*echo form_error('password')*/?>
            </div>-->
            <br>
            <button type="submit" class="btn btn-success">Đăng nhập</button><span>&nbsp;</span>
        </form>
        <br>

    </div>

</div>

