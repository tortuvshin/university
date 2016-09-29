<?php echo doctype("html5"); ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Installer</title>
    <link href="<?php echo base_url('assets/bootstrap/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/inilabs/install.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/fonts/font-awesome.css'); ?>" rel="stylesheet">
</head>

<body class="bg-color">

    <div class="login-box">
        <div class="login">
            <!-- <div class="row"> -->
                <div class="col-sm-6 col-sm-offset-3 ins-marg">
                    <center><img width="100" height="100" src="<?=base_url('uploads/images/site.png')?>" /></center>
                    <center><h4><strong style="color:red">iNi</strong><strong>Labs</strong><strong> School </strong></h4></center>
                </div>
                <div class="col-sm-6 col-sm-offset-3 ins-marg">
                    <?php $this->load->view($subview); ?>
                </div>
            <!-- </div> -->
        </div>
    </div>
<script type="text/javascript" src="<?php echo base_url('assets/inilabs/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/inilabs/inilabs.js'); ?>"></script>

</body>
</html>

