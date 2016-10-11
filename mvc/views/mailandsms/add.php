
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-mailandsms"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_smssettings')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="<?php if($email == 1) echo 'active'; ?>"><a data-toggle="tab" href="#email" aria-expanded="true"><?=$this->lang->line('mailandsms_email')?></a></li>
                        <li class="<?php if($sms == 1) echo 'active'; ?>"><a data-toggle="tab" href="#sms" aria-expanded="true"><?=$this->lang->line('mailandsms_sms')?></a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="email" class="tab-pane <?php if($email == 1) echo 'active';?> ">
                            <br>
                            <div class="row">
                                <div class="col-sm-12">


                                    <form class="form-horizontal" role="form" method="post">
                                        <?php echo form_hidden('type', 'email'); ?> 

                                        <?php 
                                            if(form_error('email_user')) 
                                                echo "<div class='form-group has-error' >";
                                            else     
                                                echo "<div class='form-group' >";
                                        ?>
                                            <label for="email_user" class="col-sm-1 control-label">
                                                <?=$this->lang->line("mailandsms_users")?>
                                            </label>
                                            <div class="col-sm-4">
                                                <?php
                                                    $array = array(
                                                        'select' => $this->lang->line('mailandsms_select_user'),
                                                        'student' => $this->lang->line('mailandsms_students'),
                                                        'parents' => $this->lang->line('mailandsms_parents'),
                                                        'teacher' => $this->lang->line('mailandsms_teachers'),
                                                        'librarian' => $this->lang->line('mailandsms_librarians'),
                                                        'accountant' => $this->lang->line('mailandsms_accountants')
                                                    );
                                                    echo form_dropdown("email_user", $array, set_value("email_user"), "id='email_user' class='form-control'");
                                                ?>
                                            </div>
                                            <span class="col-sm-4 control-label">
                                                <?php echo form_error('email_user'); ?>
                                            </span>
                                        </div>

                                        <?php 
                                            if(form_error('email_template')) 
                                                echo "<div class='form-group has-error' >";
                                            else     
                                                echo "<div class='form-group' >";
                                        ?>
                                            <label for="email_template" class="col-sm-1 control-label">
                                                <?=$this->lang->line("mailandsms_template")?>
                                            </label>
                                            <div class="col-sm-4" >
                                                
                                                <?php
                                                    $array = array(
                                                        'select' => $this->lang->line('mailandsms_select_template'),
                                                    );

                                                    if($email_user != "select") {
                                                        foreach ($email_templates as $etemplate) {
                                                            $array[$etemplate->mailandsmstemplateID] = $etemplate->name;
                                                        }
                                                    }

                                                    $euID = "";
                                                    if($email_templateID == 'select') {
                                                        $euID = 'select';
                                                    } else {
                                                        $euID = $email_templateID;
                                                    }
                                                    echo form_dropdown("email_template", $array, set_value("email_template", $euID), "id='email_template' class='form-control'");
                                                ?>
                                            </div>
                                            <span class="col-sm-3 control-label">
                                                <?php echo form_error('email_template'); ?>
                                            </span>
                                        </div>

                                        <?php 
                                            if(form_error('email_subject')) 
                                                echo "<div class='form-group has-error' id='subject_section' >";
                                            else     
                                                echo "<div class='form-group' id='subject_section' >";
                                        ?>
                                            <label for="email_subject" class="col-sm-1 control-label">
                                                <?=$this->lang->line("mailandsms_subject")?>
                                            </label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="email_subject" name="email_subject" value="<?=set_value('email_subject')?>" >
                                            </div>
                                            <span class="col-sm-4 control-label">
                                                <?php echo form_error('email_subject'); ?>
                                            </span>
                                        </div>

                                        <?php 
                                            if(form_error('email_message')) 
                                                echo "<div class='form-group has-error' >";
                                            else     
                                                echo "<div class='form-group' >";
                                        ?>
                                            <label for="email_message" class="col-sm-1 control-label">
                                                <?=$this->lang->line("mailandsms_message")?>
                                            </label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" id="email_message" name="email_message" ><?=set_value('email_message')?></textarea>
                                            </div>
                                            <span class="col-sm-3 control-label">
                                                <?php echo form_error('email_message'); ?>
                                            </span>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-1 col-sm-8">
                                                <input type="submit" class="btn btn-success" value="<?=$this->lang->line("send")?>" >
                                            </div>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>



                        <div id="sms" class="tab-pane <?php if($sms == 1) echo 'active'; ?>">
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <form class="form-horizontal" role="form" method="post">
                                        <?php echo form_hidden('type', 'sms'); ?> 
                                        <?php 
                                            if(form_error('sms_user')) 
                                                echo "<div class='form-group has-error' >";
                                            else     
                                                echo "<div class='form-group' >";
                                        ?>
                                            <label for="sms_user" class="col-sm-1 control-label">
                                                <?=$this->lang->line("mailandsms_users")?>
                                            </label>
                                            <div class="col-sm-4">
                                                <?php
                                                    $array = array(
                                                        'select' => $this->lang->line('mailandsms_select_user'),
                                                        'student' => $this->lang->line('mailandsms_students'),
                                                        'parents' => $this->lang->line('mailandsms_parents'),
                                                        'teacher' => $this->lang->line('mailandsms_teachers'),
                                                        'librarian' => $this->lang->line('mailandsms_librarians'),
                                                        'accountant' => $this->lang->line('mailandsms_accountants')
                                                    );
                                                    echo form_dropdown("sms_user", $array, set_value("sms_user"), "id='sms_user' class='form-control'");
                                                ?>
                                            </div>
                                            <span class="col-sm-4 control-label">
                                                <?php echo form_error('sms_user'); ?>
                                            </span>
                                        </div>

                                        <?php 
                                            if(form_error('sms_template')) 
                                                echo "<div class='form-group has-error' >";
                                            else     
                                                echo "<div class='form-group' >";
                                        ?>
                                            <label for="sms_template" class="col-sm-1 control-label">
                                                <?=$this->lang->line("mailandsms_template")?>
                                            </label>
                                            <div class="col-sm-4" >
                                                
                                                <?php
                                                    $array = array(
                                                        'select' => $this->lang->line('mailandsms_select_template'),
                                                    );

                                                    if($sms_user != "select") {
                                                        foreach ($sms_templates as $stemplate) {
                                                            $array[$stemplate->mailandsmstemplateID] = $stemplate->name;
                                                        }
                                                    }

                                                    $smID = "";
                                                    if($sms_templateID == 'select') {
                                                        $smID = 'select';
                                                    } else {
                                                        $smID = $sms_templateID;
                                                    }

                                                    echo form_dropdown("sms_template", $array, set_value("sms_template", $smID), "id='sms_template' class='form-control'");
                                                ?>
                                                
                                            </div>
                                            <span class="col-sm-3 control-label">
                                                <?php echo form_error('sms_template'); ?>
                                            </span>
                                        </div>

                                        <?php 
                                            if(form_error('sms_getway')) 
                                                echo "<div class='form-group has-error' >";
                                            else     
                                                echo "<div class='form-group' >";
                                        ?>
                                            <label for="sms_getway" class="col-sm-1 control-label">
                                                <?=$this->lang->line("mailandsms_getway")?>
                                            </label>
                                            <div class="col-sm-4" >
                                                
                                                <?php
                                                    $array = array(
                                                        'select' => $this->lang->line('mailandsms_select_send_by'),
                                                        'clickatell' => $this->lang->line('mailandsms_clickatell'),
                                                        'twilio' => $this->lang->line('mailandsms_twilio'),
                                                        'bulk' => $this->lang->line('mailandsms_bulk'),
                                                    );
                                                    echo form_dropdown("sms_getway", $array, set_value("sms_getway"), "id='sms_getway' class='form-control'");
                                                ?>
                                                
                                            </div>
                                            <span class="col-sm-3 control-label">
                                                <?php echo form_error('sms_getway'); ?>
                                            </span>
                                        </div>

                                        <?php 
                                            if(form_error('sms_message')) 
                                                echo "<div class='form-group has-error' >";
                                            else     
                                                echo "<div class='form-group' >";
                                        ?>
                                            <label for="sms_message" class="col-sm-1 control-label">
                                                <?=$this->lang->line("mailandsms_message")?>
                                            </label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" style="resize:vertical" id="sms_message" name="sms_message" ><?=set_value('sms_message')?></textarea>
                                            </div>
                                            <span class="col-sm-3 control-label">
                                                <?php echo form_error('sms_message'); ?>
                                            </span>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-1 col-sm-8">
                                                <input type="submit" class="btn btn-success" value="<?=$this->lang->line("send")?>" >
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div> <!-- nav-tabs-custom -->


            </div>
        </div>
    </div>

</div><!-- /.box -->
<script type="text/javascript" src="<?php echo base_url('assets/editor/jquery-te-1.4.0.min.js'); ?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#email_message').jqte();

        $("#email_user").change(function() {
            var user = $(this).val();
                $.ajax({
                type: 'POST',
                url: "<?=base_url('mailandsms/alltemplate')?>",
                data: "user=" + user + "&type=" + "email",
                dataType: "html",
                success: function(data) {
                   $('#email_template').html(data);
                }
            });
        });

        $('#email_template').change(function() {
            var templateID = $(this).val();
                $.ajax({
                type: 'POST',
                url: "<?=base_url('mailandsms/alltemplatedesign')?>",
                data: "templateID=" + templateID,
                dataType: "html",
                success: function(data) {
                   $('.jqte_editor').html(data);
                }
            });

        })

        $("#sms_user").change(function() {
            var user = $(this).val();
                $.ajax({
                type: 'POST',
                url: "<?=base_url('mailandsms/alltemplate')?>",
                data: "user=" + user + "&type=" + "sms",
                dataType: "html",
                success: function(data) {
                   $('#sms_template').html(data);
                }
            });
        });

        $('#sms_template').change(function() {
            var templateID = $(this).val();
                $.ajax({
                type: 'POST',
                url: "<?=base_url('mailandsms/alltemplatedesign')?>",
                data: "templateID=" + templateID,
                dataType: "html",
                success: function(data) {
                   $('#sms_message').html(data);
                }
            });

        })

        
    });
</script>