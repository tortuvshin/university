
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-paymentsettings"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_paymentsettings')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <div class="col-sm-12">

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="<?php if($paypal == 1) echo 'active'; ?>"><a data-toggle="tab" href="#paypal" aria-expanded="true"><?=$this->lang->line('tab_paypal')?></a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="paypal" class="tab-pane <?php if($paypal == 1) echo 'active';?> ">
                            <br>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                                            <?php echo form_hidden('type', 'paypal'); ?> 
                                            
                                            <?php 
                                                if(form_error('paypal_api_username')) 
                                                    echo "<div class='form-group has-error' >";
                                                else     
                                                    echo "<div class='form-group' >";
                                            ?>
                                                <label for="paypal_api_username" class="col-sm-2 control-label">
                                                    <?=$this->lang->line("paypal_api_username")?>
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" id="paypal_api_username" name="paypal_api_username" value="<?=set_value('paypal_api_username', $set_key['paypal_api_username'])?>" >
                                                </div>
                                                <span class="col-sm-4 control-label">
                                                    <?php echo form_error('paypal_api_username'); ?>
                                                </span>
                                            </div>

                                            <?php 
                                                if(form_error('paypal_api_password')) 
                                                    echo "<div class='form-group has-error' >";
                                                else     
                                                    echo "<div class='form-group' >";
                                            ?>
                                                <label for="paypal_api_password" class="col-sm-2 control-label">
                                                    <?=$this->lang->line("paypal_api_password")?>
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" id="paypal_api_password" name="paypal_api_password" value="<?=set_value('paypal_api_password', $set_key['paypal_api_password'])?>" >
                                                </div>
                                                <span class="col-sm-4 control-label">
                                                    <?php echo form_error('paypal_api_password'); ?>
                                                </span>
                                            </div>

                                            <?php 
                                                if(form_error('paypal_api_signature')) 
                                                    echo "<div class='form-group has-error' >";
                                                else     
                                                    echo "<div class='form-group' >";
                                            ?>
                                                <label for="paypal_api_signature" class="col-sm-2 control-label">
                                                    <?=$this->lang->line("paypal_api_signature")?>
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" id="paypal_api_signature" name="paypal_api_signature" value="<?=set_value('paypal_api_signature', $set_key['paypal_api_signature'])?>" >
                                                </div>
                                                <span class="col-sm-4 control-label">
                                                    <?php echo form_error('paypal_api_signature'); ?>
                                                </span>
                                            </div>

                                            <?php 
                                                if(form_error('paypal_email')) 
                                                    echo "<div class='form-group has-error' >";
                                                else     
                                                    echo "<div class='form-group' >";
                                            ?>
                                                <label for="paypal_email" class="col-sm-2 control-label">
                                                    <?=$this->lang->line("paypal_email")?>
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="email" class="form-control" id="paypal_email" name="paypal_email" value="<?=set_value('paypal_email', $set_key['paypal_email'])?>" >
                                                </div>
                                                <span class="col-sm-4 control-label">
                                                    <?php echo form_error('paypal_email'); ?>
                                                </span>
                                            </div>

                                            <?php 
                                                if(form_error('paypal_demo')) 
                                                    echo "<div class='form-group has-error' >";
                                                else     
                                                    echo "<div class='form-group' >";
                                            ?>
                                                <label for="paypal_demo" class="col-sm-2 control-label">
                                                    <?=$this->lang->line("paypal_demo")?>
                                                </label>
                                                <div class="col-sm-5">
                                                    <!-- <input type="checkbox" class="form-control" id="paypal_demo" name="paypal_demo" value="<?=set_value('paypal_demo', $set_key['paypal_demo'])?>" > -->
                                                    <div class="onoffswitch">
                                                        <input type="checkbox" name="paypal_demo" class="onoffswitch-checkbox" id="myonoffswitch" <?=($set_key['paypal_demo']=="TRUE"?"checked":"")?>>
                                                        <label class="onoffswitch-label" for="myonoffswitch">
                                                            <span class="onoffswitch-inner"></span>
                                                            <span class="onoffswitch-switch"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <span class="col-sm-4 control-label">
                                                    <?php echo form_error('paypal_demo'); ?>
                                                </span>
                                            </div>


                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-8">
                                                    <input type="submit" class="btn btn-success" value="<?=$this->lang->line("save")?>" >
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- nav-tabs-custom -->
                </div>
   

            </div> <!-- col-sm-12 -->
            
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->