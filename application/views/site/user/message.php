<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/15/2017
 * Time: 2:23 AM
 */?>
    <style>
    .row{
        position: fixed;
        margin-top: 300px;
        z-index: 1;
        width: 500px;
        height: 50px;
        margin-left: 30px;
    }
</style>
<?php if(isset($message) && $message):?>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-info-circle"></i>
                <strong>
                    <?php echo $message?>
                </strong>
            </div>
        </div>
    </div>
<?php endif;?>