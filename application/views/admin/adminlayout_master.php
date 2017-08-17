<!DOCTYPE html>
<html>
<head>
    <script src="<?php echo public_url('jquery-3.2.1.min.js') ?>"></script>
    <script src="<?php echo public_url('bootstrap-3.3.7-dist/js/bootstrap.min.js') ?>"></script>
    <link type="text/css" rel="stylesheet"
          href="<?php echo public_url('bootstrap-3.3.7-dist/css/bootstrap.min.css') ?>"/>
    <!--<link href="<?php /*echo public_url('css/admin.css'); */ ?>" rel="stylesheet" type="text/css">-->
    <!-- Custom CSS -->
    <link href="<?php echo public_url(); ?>admin/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo public_url(); ?>admin/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo public_url(); ?>admin/font-awesome/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <link rel="icon" href="<?php echo public_url() ?>images/carrot_logo.png">
    <title>Administrator</title>
</head>
<body>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo admin_url('home')?>"><span style="font-family: font: normal 36px 'Cookie', cursive;">Carrot Shop</span> - Trang quản trị</a>
            <a class="navbar-brand" href="<?php echo site_url('home')?>" target="_blank" style="color: white;"><i class="fa fa-external-link"></i></a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <!--<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b
                            class="caret"></b></a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b
                            class="caret"></b></a>
            </li>-->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user">
                    </i>
                    Xin chào<b><?php if (isset($user_infor)): ?>
                            <?php echo $user_infor->name ?>!
                        <?php endif; ?></b><b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <!-- <li>
                         <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                     </li>
                     <li>
                         <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                     </li>
                     <li>
                         <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                     </li>
                     <li class="divider"></li>-->
                    <li>
                        <a href="<?php echo admin_url('home/logout') ?>"><i class="fa fa-fw fa-power-off"></i>
                            Đăng xuất </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="<?php echo admin_url('home') ?>"><i class="fa fa-fw fa-dashboard"></i> Trang chủ Admin</a>
                </li>
                <li>
                    <a href="<?php echo admin_url('order_infor') ?>"><i class="fa fa-fw fa-bar-chart-o"></i>
                        Quản lý giao dịch </a>
                </li>
                <li>
                        <a>
                            <i class="fa fa-fw fa-desktop">&nbsp;</i> Sản phẩm</a>
                        <ul id="">
                        <li>
                            <a href="<?php echo admin_url('category') ?>">Danh mục
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo admin_url('product') ?>">Sản phẩm</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:" data-toggle="collapse" data-target="#demo"><i
                                class="fa fa-fw fa-arrows-v"></i> Tài khoản<i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="demo" class="collapse">
                        <li>
                            <a href="<?php echo admin_url('admin') ?>">
                                Ban quản trị</a>
                        </li>
                        <li>
                            <a href="<?php echo admin_url('user') ?>">
                                Thành viên
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo admin_url('home') ?>"><i class="fa fa-fw fa-file"></i> Hỗ trợ</a>
                </li>
                <li>
                    <a href="<?php echo admin_url('home') ?>"><i class="fa fa-fw fa-dashboard"></i>Liên hệ</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
    <!--<div id="left">
    <div id="welcome">
        <?php /*$admin_infor->name*/ ?>
    </div>
    <img src="<?php /*echo public_url('images/sidebarSep.png'); */ ?>">
    <div id="menu">
        <div class="nav-menu">
            <br>
            <a href="<?php /*echo admin_url() */ ?>">
                <img src="<?php /*echo public_url('images/home.png'); */ ?>">&nbsp; BẢNG ĐIỀU KHIỂN
            </a>
        </div>
        <div class="nav-menu">
            <br>
            <img src="<?php /*echo public_url('images/orr.png'); */ ?>">&nbsp;
            QUẢN LÝ BÁN HÀNG
        </div>
        <ul>
            <li>
                <a href="<?php /*echo admin_url('order_infor') */ ?>">Giao dịch</a>
            </li>
            <li>
                <a href="<?php /*echo admin_url('order_detail') */ ?>">Đơn hàng sản phẩm</a>
            </li>
        </ul>
        <div class="nav-menu">
            <Br>
            <img src="<?php /*echo public_url('images/files.png'); */ ?>" width="14px">&nbsp;
            SẢN PHẨM
        </div>
        <ul class="nav-sub">
            <li>
                <a href="<?php /*echo admin_url('product') */ ?>">Sản phẩm</a></li>
            <li>
                <a href="<?php /*echo admin_url('category') */ ?>">Danh mục
                </a>
            </li>
            <li>Phản hồi</li>
        </ul>
        <div class="nav-menu">
            <br>
            <a href="<?php /*echo admin_url('admin') */ ?>">
                <img src="<?php /*echo public_url('images/user.png'); */ ?>" width="14px">&nbsp;
                TÀI KHOẢN
            </a>
        </div>
        <ul>
            <a href="<?php /*echo admin_url('admin') */ ?>">
                <li>Ban quản trị</li>
            </a>
            <li>Nhóm quản trị</li>
            <a href="<?php /*echo admin_url('user') */ ?>">
                <li>Thành viên</li>
            </a>
        </ul>
        <div class="nav-menu">
            <br>
            <img src="<?php /*echo public_url('images/frames.png'); */ ?>" width="14px">&nbsp;
            HỖ TRỢ VÀ LIÊN HỆ
        </div>
        <ul>
            <li>Hỗ trợ</li>
            <li>Liên hệ</li>
        </ul>
    </div>
</div>
<div id="top">
    <span>Xin chào: <b>admin<?php /*$admin_infor->name*/ ?>!</b></span>
    <span class="home">
                    <a href="" target="_blank">
                            <img style="margin-top:7px; width: 20px"
                                 src="<?php /*echo public_url('images/icon-home.ico') */ ?>"/>
                            Trang chủ
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="<?php /*echo admin_url('home/logout') */ ?>">
                        <span class="glyphicon glyphicon-log-out"></span>&nbsp;Đăng xuất
                        </a>
                    </span>

</div>-->

    <div id="page-wrapper">
        <div class="container-fluid">
            <?php $this->load->view($temp, $this->data);
            ?>
        </div>
    </div>
    <hr>
    <div class="footer" style="margin: auto;text-align: center">
        <i class="fa fa-envelope"></i>
        <p><a href="mailto:vythao219@gmail.com">vythao219@gmail.com</a>
            <br>Carrot Shop &copy; Tháng 5 - 2017
        </p>
    </div>
</div>

<!-- Morris Charts JavaScript -->
<script src="<?php echo public_url(); ?>admin/js/plugins/morris/raphael.min.js"></script>
<script src="<?php echo public_url(); ?>admin/js/plugins/morris/morris.min.js"></script>
<script src="<?php echo public_url(); ?>admin/js/plugins/morris/morris-data.js"></script>
</body>
</html>
