<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/11/2017
 * Time: 10:57 PM
 */
//header cho trang quan tri hien thi danh sach thanh vien
?>
<head>
    <script src="<?php echo public_url(); ?>jquery-2.0.0.js" type="text/javascript"></script>
    <!--<script src="<?php /*echo public_url(); */?>jquery.inputmask.js" type="text/javascript"></script>
    <script src="<?php /*echo public_url(); */?>inputmask.extensions.js" type="text/javascript"></script>
    <script src="<?php /*echo public_url(); */?>inputmask.numeric.extensions.js" type="text/javascript"></script>
    <script src="<?php /*echo public_url(); */?>inputmask.phone.extensions.js" type="text/javascript"></script>-->
    <script src="<?php echo public_url()?>inputmaskmin.js" type="text/javascript"></script>
    <script>
   /* jQuery(function($){
        $("#date").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
        $("#phone").mask("(999) 999-9999");
        $("#tin").mask("99-9999999");
        $("#ssn").mask("999-99-9999");
        $("#formatnumber").mask("999.999.999.999");
        alert('ahihi');
    });*/
   /*$(document).ready(function ($) {
       $('#formatnumber').mask("999,999,999,999");
   });*/
</script>
</head>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Danh sách sản phẩm<small>
                Quản lý sản phẩm
            </small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>
                <a href="<?php echo admin_url('home')?>">Trang chủ
                </a>
            </li>
            <li class="active">
                <i class="fa fa-bar-chart-o"></i>
                <a href="<?php echo admin_url('product')?>">
                    Sản phẩm
                </a>
            </li>
        </ol>

    </div>
</div>

