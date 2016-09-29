<?php echo doctype("html5"); ?>
<html class="white-bg-login" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>Sign in</title>

    <!-- bootstrap 3.0.2 -->
    <link href="<?php echo base_url('assets/bootstrap/bootstrap.min.css'); ?>" rel="stylesheet"  type="text/css">
    <!-- font Awesome -->
    <link href="<?php echo base_url('assets/fonts/font-awesome.css'); ?>" rel="stylesheet"  type="text/css">
    <!-- Style -->
    <link href="<?php echo base_url('assets/inilabs/style.css'); ?>" rel="stylesheet"  type="text/css">
    <!-- iNilabs css -->
    <link href="<?php echo base_url('assets/inilabs/inilabs.css'); ?>" rel="stylesheet"  type="text/css">
    <link href="<?php echo base_url('assets/inilabs/responsive.css'); ?>" rel="stylesheet"  type="text/css">
</head>

<body class="white-bg-login">
    <div class="col-md-4 col-md-offset-4 marg" style="margin-top:30px;">
        <?php
            if(count($siteinfos->photo)) {
                echo "<center><img width='50' height='50' src=".base_url('uploads/images/'.$siteinfos->photo)." /></center>";
            }
        ?>
        <center><h4><?php echo $siteinfos->sname; ?></h4></center>
    </div>

    <?php $this->load->view($subview); ?>
<script type="text/javascript" src="<?php echo base_url('assets/inilabs/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/bootstrap.min.js'); ?>"></script>
</body>
</html>