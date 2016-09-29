
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-wrench"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_smssettings')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <div class="col-sm-12">

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="<?php if($clickatell == 1) echo 'active'; ?>"><a data-toggle="tab" href="#clickatell" aria-expanded="true">Clickatell</a></li>
                            <li class="<?php if($twilio == 1) echo 'active'; ?>"><a data-toggle="tab" href="#twilio" aria-expanded="true">Twilio</a></li>
                            <li class="<?php if($bulk == 1) echo 'active'; ?>"><a data-toggle="tab" href="#bulk" aria-expanded="true">Bulk</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="clickatell" class="tab-pane <?php if($clickatell == 1) echo 'active';?> ">
                                <br>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                                            <?php echo form_hidden('type', 'clickatell'); ?> 
                                            <?php 
                                                if(form_error('clickatell_username')) 
                                                    echo "<div class='form-group has-error' >";
                                                else     
                                                    echo "<div class='form-group' >";
                                            ?>
                                                <label for="clickatell_username" class="col-sm-2 control-label">
                                                    <?=$this->lang->line("smssettings_username")?>
                                                </label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="clickatell_username" name="clickatell_username" value="<?=set_value('clickatell_username', $set_clickatell['clickatell_username'])?>" >
                                                </div>
                                                <span class="col-sm-4 control-label">
                                                    <?php echo form_error('clickatell_username'); ?>
                                                </span>
                                            </div>

                                            <?php 
                                                if(form_error('clickatell_password')) 
                                                    echo "<div class='form-group has-error' >";
                                                else     
                                                    echo "<div class='form-group' >";
                                            ?>
                                                <label for="clickatell_password" class="col-sm-2 control-label">
                                                    <?=$this->lang->line("smssettings_password")?>
                                                </label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="clickatell_password" name="clickatell_password" value="<?=set_value('clickatell_password', $set_clickatell['clickatell_password'])?>" >
                                                </div>
                                                <span class="col-sm-4 control-label">
                                                    <?php echo form_error('clickatell_password'); ?>
                                                </span>
                                            </div>

                                            <?php 
                                                if(form_error('clickatell_api_key')) 
                                                    echo "<div class='form-group has-error' >";
                                                else     
                                                    echo "<div class='form-group' >";
                                            ?>
                                                <label for="clickatell_api_key" class="col-sm-2 control-label">
                                                    <?=$this->lang->line("smssettings_api_key")?>
                                                </label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="clickatell_api_key" name="clickatell_api_key" value="<?=set_value('clickatell_api_key', $set_clickatell['clickatell_api_key'])?>" >
                                                </div>
                                                <span class="col-sm-4 control-label">
                                                    <?php echo form_error('clickatell_api_key'); ?>
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



                            <div id="twilio" class="tab-pane <?php if($twilio == 1) echo 'active'; ?>">
                                <br>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                                            <?php echo form_hidden('type', 'twilio'); ?> 
                                            <?php 
                                                if(form_error('twilio_accountSID')) 
                                                    echo "<div class='form-group has-error' >";
                                                else     
                                                    echo "<div class='form-group' >";
                                            ?>
                                                <label for="twilio_accountSID" class="col-sm-2 control-label">
                                                    <?=$this->lang->line("smssettings_accountSID")?>
                                                </label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="twilio_accountSID" name="twilio_accountSID" value="<?=set_value('twilio_accountSID', $set_twilio['twilio_accountSID'])?>" >
                                                </div>
                                                <span class="col-sm-4 control-label">
                                                    <?php echo form_error('twilio_accountSID'); ?>
                                                </span>
                                            </div>

                                            <?php 
                                                if(form_error('twilio_authtoken')) 
                                                    echo "<div class='form-group has-error' >";
                                                else     
                                                    echo "<div class='form-group' >";
                                            ?>
                                                <label for="twilio_authtoken" class="col-sm-2 control-label">
                                                    <?=$this->lang->line("smssettings_authtoken")?>
                                                </label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="twilio_authtoken" name="twilio_authtoken" value="<?=set_value('twilio_authtoken', $set_twilio['twilio_authtoken'])?>" >
                                                </div>
                                                <span class="col-sm-4 control-label">
                                                    <?php echo form_error('twilio_authtoken'); ?>
                                                </span>
                                            </div>

                                            <?php 
                                                if(form_error('twilio_fromnumber')) 
                                                    echo "<div class='form-group has-error' >";
                                                else     
                                                    echo "<div class='form-group' >";
                                            ?>
                                                <label for="twilio_fromnumber" class="col-sm-2 control-label">
                                                    <?=$this->lang->line("smssettings_fromnumber")?>
                                                </label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="twilio_fromnumber" name="twilio_fromnumber" value="<?=set_value('twilio_fromnumber', $set_twilio['twilio_fromnumber'])?>" >
                                                </div>
                                                <span class="col-sm-4 control-label">
                                                    <?php echo form_error('twilio_fromnumber'); ?>
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

                            <div id="bulk" class="tab-pane <?php if($bulk == 1) echo 'active';?> ">
                                <br>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                                            <?php echo form_hidden('type', 'bulk'); ?> 
                                            <?php 
                                                if(form_error('bulk_username')) 
                                                    echo "<div class='form-group has-error' >";
                                                else     
                                                    echo "<div class='form-group' >";
                                            ?>
                                                <label for="bulk_username" class="col-sm-2 control-label">
                                                    <?=$this->lang->line("smssettings_username")?>
                                                </label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="bulk_username" name="bulk_username" value="<?=set_value('bulk_username', $set_bulk['bulk_username'])?>" >
                                                </div>
                                                <span class="col-sm-4 control-label">
                                                    <?php echo form_error('bulk_username'); ?>
                                                </span>
                                            </div>

                                            <?php 
                                                if(form_error('bulk_password')) 
                                                    echo "<div class='form-group has-error' >";
                                                else     
                                                    echo "<div class='form-group' >";
                                            ?>
                                                <label for="bulk_password" class="col-sm-2 control-label">
                                                    <?=$this->lang->line("smssettings_password")?>
                                                </label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="bulk_password" name="bulk_password" value="<?=set_value('bulk_password', $set_bulk['bulk_password'])?>" >
                                                </div>
                                                <span class="col-sm-4 control-label">
                                                    <?php echo form_error('bulk_password'); ?>
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