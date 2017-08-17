<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/24/2017
 * Time: 2:39 AM
 */
?>
<link rel="stylesheet" href="<?php echo public_url() ?>autocomplete/css/smoothness/jquery-ui-1.8.16.custom.css"
      type="text/css">
<script src="<?php echo public_url() ?>autocomplete/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
<div id="infor">

</div>
<div class="container-fluid">
<div class="row" id="bg-light-blue">
    <div class="col-md-7">
        <div id="top">
            <a href="<?php echo base_url() ?>">
                <img src="<?php echo public_url() ?>images/logocr.png" alt="this is logo"
                     style="width: 260px; float: left; margin-left: 70px; margin-top: 13px">
            </a>
            <!--<input type="text" id="searchbox" placeholder="Tìm kiếm sản phẩm...">-->
            <form class="form-horizontal" id="searchbox" action="<?php echo site_url('product/search') ?>" method="get">
                <div class="input-group">
                    <!--<input type="text" class="form-control" id="text-search" placeholder="Tìm kiếm"
                   name="key_search" value="<?php /*echo isset($key) ? $key : '' */ ?>">-->
                    <input type="text" class="form-control" name="name" placeholder="Tìm kiếm"
                           value="<?php echo isset($key) ? $key : '' ?>">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-2">
        <div id="cart">
            <a href="<?php echo base_url('cart') ?>">
                <img src="<?php echo public_url() ?>images/icart.png" style="height: 40px">
                Giỏ hàng:
                <?php echo $total_items ?>
            </a>
        </div>
    </div>
    <div class="col-md-3">
        <div id="user" class="dropdown">
            <?php if (isset($user_infor)): ?>
                <a href="<?php echo site_url('user') ?>"
                   title="Hello">
                    <img src="<?php echo public_url() ?>images/user-gender.png" style="width: 26px">
                    Chào <b><?php echo $user_infor->name ?>!</b>
                </a>
                <a href="<?php echo site_url('user/logout') ?>"
                   title="Tham gia để nhận ưu đãi">
                    <span class="glyphicon glyphicon-log-out" style="margin-left: 10px"></span>&nbsp;Đăng xuất
                </a>
            <?php else: ?>
                <button type="button" class="btn btn-info">
                    <a href="<?php echo site_url('dang-ky') ?>" title="Đăng ký">Đăng ký</a>
                </button>
                <!--<span class="caret"></span>-->
                <button type="button" class="btn btn-info">
                    <a href="<?php echo site_url('dang-nhap') ?>" title="Đăng nhập">Đăng nhập</a>
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>

