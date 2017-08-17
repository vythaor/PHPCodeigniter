<html>
    <head>
        <script src="<?php echo public_url('jquery-3.2.1.min.js')?>"></script>
        <script src="<?php echo public_url('bootstrap-3.3.7-dist/js/bootstrap.min.js')?>"></script>
        <link type="text/css" rel="stylesheet" href="<?php echo public_url('bootstrap-3.3.7-dist/css/bootstrap.min.css')?>"/>
        <link href="<?php echo public_url('css/admin.css'); ?>" rel="stylesheet" type="text/css">
        <link rel="icon" href="<?php echo public_url() ?>images/carrot_logo.png">
        <title>Administrator</title>
    </head>
    <body>
        <div id="left">
            <div id="welcome">
                admin
            </div>
            <img src="<?php echo public_url('images/sidebarSep.png'); ?>">
            <div id="menu">
                <div class="nav-menu">
                    <br>
                    <a href="<?php echo admin_url() ?>">
                        <img src="<?php echo public_url('images/home.png'); ?>">&nbsp; BẢNG ĐIỀU KHIỂN
                    </a>
                </div>
                <div class="nav-menu">
                    <br>
                    <img src="<?php echo public_url('images/orr.png'); ?>">&nbsp;
                    QUẢN LÝ BÁN HÀNG
                </div>
                        <ul>
                            <li>
                                <a href="<?php echo admin_url('order_infor')?>">Giao dịch</a>
                            </li>
                            <li>
                                <a href="<?php echo admin_url('order_detail')?>">Đơn hàng sản phẩm</a>
                            </li>
                        </ul>
                <div class="nav-menu">
                    <Br>
                    <img src="<?php echo public_url('images/files.png'); ?>" width="14px">&nbsp;
                    SẢN PHẨM
                </div>
                    <ul class="nav-sub">
                            <li>
                                <a href="<?php echo admin_url('product')?>">Sản phẩm</a></li>
                            <li>
                                <a href="<?php echo admin_url('category')?>">Danh mục
                                </a>
                            </li>
                            <li>Phản hồi</li>
                        </ul>
                <div class="nav-menu">
                    <br>
                    <a href="<?php echo admin_url('admin') ?>">
                    <img src="<?php echo public_url('images/user.png'); ?>" width="14px">&nbsp;
                    TÀI KHOẢN
                    </a>
                </div>
                        <ul>
                            <a href="<?php echo admin_url('admin') ?>">
                                <li>Ban quản trị</li>
                            </a>
                            <li>Nhóm quản trị</li>
                            <a href="<?php echo admin_url('user') ?>">
                            <li>Thành viên</li>
                            </a>
                        </ul>
                <div class="nav-menu">
                    <br>
                    <img src="<?php echo public_url('images/frames.png'); ?>" width="14px">&nbsp;
                    HỖ TRỢ VÀ LIÊN HỆ
                </div>
                        <ul>
                            <li>Hỗ trợ</li>
                            <li>Liên hệ</li>
                        </ul>
            </div>
        </div>
        <div id="top">
                <span>Xin chào: <b>admin!</b></span>
                <span class="home">
                    <a href="" target="_blank">
                            <img style="margin-top:7px; width: 20px" src="<?php echo public_url('images/icon-home.ico')?>" />
                            Trang chủ
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="<?php echo admin_url('admin/logout')?>">
                        <span class="glyphicon glyphicon-log-out"></span>&nbsp;Đăng xuất
                        </a>
                    </span>

            </div>

            <div id="cont">

                <?php $this->load->view($temp, $this->data);
                ?>
            </div>
    </body>
</html>
