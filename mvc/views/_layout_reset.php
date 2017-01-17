<?php echo doctype("html5"); ?>
<html class="white-bg-login" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>Нууц үг шинэчлэх</title>
    <link rel="SHORTCUT ICON" href="<?=base_url("uploads/images/$siteinfos->photo")?>" />
    <!-- bootstrap 3.0.2 -->
    <link href="<?php echo base_url('assets/bootstrap/bootstrap.min.css'); ?>" rel="stylesheet"  type="text/css">
    <!-- font Awesome -->
    <link href="<?php echo base_url('assets/fonts/font-awesome.css'); ?>" rel="stylesheet"  type="text/css">
    <!-- Style -->
    <link href="<?php echo base_url('assets/inisys/style.css'); ?>" rel="stylesheet"  type="text/css">
</head>


<?php
    if(count($siteinfos->photoback)) {
        $photobackvar = base_url('uploads/images/'.$siteinfos->photoback);
    }
?>

<style type="text/css">
    .white-bg-login {
        background-image: url(<?php echo $photobackvar ?>);
        background-repeat: no-repeat; 
        background-size: cover;   
    }
</style>

<body class="white-bg-login">

    <div class="login-header">
        <div class="login-control">
        <?php
            if(count($siteinfos->photo)) {
                echo "<img class='login-logo' width='50' height='50' src=".base_url('uploads/images/'.$siteinfos->photo)." />";
            }
        ?>
        <h4 style="float:left;"><?php echo $siteinfos->sname; ?></h4>    
        </div>
        
    </div>

    <?php $this->load->view($subview); ?>

<script type="text/javascript" src="<?php echo base_url('assets/inisys/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/bootstrap.min.js'); ?>"></script>
</body>
<footer class="login-footer">
    <span>
        <a href="https://www.citi.edu.mn" target="_blank"><?php echo $siteinfos->sname; ?> © 2017 он</a>
        <a href="https://www.facebook.com/citiuniversity" target="_blank">
            <i class="fa fa-facebook-official" aria-hidden="true"></i>
        </a>
        <a href="https://twitter.com/CitiUniversity" target="_blank">
            <i class="fa fa-twitter" aria-hidden="true"></i>
        </a>
        <a href="https://www.instagram.com/citiuniversity" target="_blank">
            <i class="fa fa-instagram" aria-hidden="true"></i>
        </a>
        <a href="https://www.youtube.com/channel/UCROeKzkani6QRJYmmVsa92g" target="_blank">
            <i class="fa fa-youtube-play" aria-hidden="true"></i>
        </a>
    </span>
</footer>
</html>