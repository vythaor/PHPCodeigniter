<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 3/24/2017
 * Time: 2:02 AM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carrot Shop</title>
    <script src="<?php echo public_url()?>jquery-3.2.1.min.js"></script>
    <script src="<?php echo public_url()?>bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <!--<script type="text/javascript" src="<?php /*echo public_url('jquery-2.0.0.js'); */?>"></script>-->
    <link rel="stylesheet" href="<?php echo public_url() ?>bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link href="<?php echo public_url('css/master.css') ?>" rel="stylesheet" type="text/css">
    <link rel="icon" href="<?php echo public_url() ?>images/carrot_logo.png">
    <meta property="og:url" content="http://iosia.net"/>
    <meta property="fb:app_id" content="116352575695631"/>
    <meta property="fb:admins" content="100006358381221"/>
    <meta name="description" content="Online shop"/>
</head>
<body>
<?php $this->load->view('site/header', $this->data)?>
<?php $this->load->view('site/menu', $this->data);?>
<?php $this->load->view($temp, $this->data) ?>
<div id="footer">
    <?php $this->load->view('site/Home/footer')?>
</div>
</body>
</html>