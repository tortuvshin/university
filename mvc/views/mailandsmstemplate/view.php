<?php 
$usertype = $this->session->userdata("usertype");
if($usertype == "Admin") {
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-template"></i> <?=$this->lang->line('panel_title')?></h3>

        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("mailandsmstemplate/index")?>"><?=$this->lang->line('menu_mailandsmstemplate')?></a></li>
            <li class="active"><?=$this->lang->line('menu_view')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div id="printablediv" class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <?php echo $mailandsmstemplate->template; ?><br><br>
            </div>
        </div>
    </div>
</div>
<?php } ?>