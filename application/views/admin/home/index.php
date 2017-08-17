<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 3/29/2017
 * Time: 2:14 AM
 */
$this->load->view('admin/home/head', $this->data);

?>
<script>
    $(document).ready(function() {
        $('#confirm-div').hide();
        <?php if($this->session->flashdata('message')){ ?>
        $('#confirm-div').html('<?php echo $this->session->flashdata('message'); ?>').show();
    });
    <?php } ?>
</script>
<div id="confirm-div">
       <!-- <div class="col-lg-12">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-info-circle"></i>
                <strong>
                </strong>
            </div>
        </div>-->
</div>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $total_rows?></div>
                        <div>Giao dịch</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo admin_url('order_infor')?>">
                <div class="panel-footer">
                    <span class="pull-left">Xem chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $total_user?></div>
                        <div>Thành viên</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo admin_url('user')?>">
                <div class="panel-footer">
                    <span class="pull-left">Xem chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $total_product?></div>
                        <div>Sản phẩm</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo admin_url('product')?>">
                <div class="panel-footer">
                    <span class="pull-left">Xem chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div>Tổng doanh thu</div>
                        <div><h4><?php echo $total_amount?>đ</h4></div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left"><br></span>
                    <span class="pull-right"><!--<i class="fa fa-arrow-circle-right"></i>--></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->
<!--
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Area Chart</h3>
            </div>
            <div class="panel-body">
                <div id="morris-area-chart"></div>
            </div>
        </div>
    </div>
</div>-->
<!-- /.row -->

<div class="row">
    <div class="col-lg-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive" style="text-align: center;">
                    <table class="table table-bordered table-hover table-striped" style="text-align: center">
                        <thead>
                        <tr>
                            <th>Mã #</th>
                            <th>Ngày đặt</th>
                            <th>Tổng</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($list as $row): ?>
                            <tr>
                                <td><?php echo $row->id?></td>
                                <td><?php echo get_date($row->created)?></td>
                                <td><?php echo $row->amount?>đ</td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <a href="<?php echo admin_url('order_infor')?>">Xem tất cả giao dịch<i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>