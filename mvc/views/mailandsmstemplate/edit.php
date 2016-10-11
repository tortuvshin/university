
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-template"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("mailandsmstemplate/index")?>"><?=$this->lang->line('menu_mailandsmstemplate')?></a></li>
            <li class="active"><?=$this->lang->line('menu_edit')?> <?=$this->lang->line('menu_mailandsmstemplate')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <?php if($email == 1) { ?>
                    <form class="form-horizontal" role="form" method="post">
                        <?php 
                            if(form_error('email_name')) 
                                echo "<div class='form-group has-error' >";
                            else     
                                echo "<div class='form-group' >";
                        ?>
                            <label for="email_name" class="col-sm-1 control-label">
                                <?=$this->lang->line("mailandsmstemplate_name")?>
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="email_name" name="email_name" value="<?=set_value('email_name', $mailandsmstemplate->name)?>" >
                            </div>
                            <span class="col-sm-4 control-label">
                                <?php echo form_error('email_name'); ?>
                            </span>
                        </div>

                        <?php 
                            if(form_error('email_user')) 
                                echo "<div class='form-group has-error' >";
                            else     
                                echo "<div class='form-group' >";
                        ?>
                            <label for="email_user" class="col-sm-1 control-label">
                                <?=$this->lang->line("mailandsmstemplate_user")?>
                            </label>
                            <div class="col-sm-4">
                                <?php
                                    $array = array(
                                        'select' => $this->lang->line('mailandsmstemplate_select_user'),
                                        'student' => $this->lang->line('mailandsmstemplate_student'),
                                        'parents' => $this->lang->line('mailandsmstemplate_parents'),
                                        'teacher' => $this->lang->line('mailandsmstemplate_teacher'),
                                        'librarian' => $this->lang->line('mailandsmstemplate_librarian'),
                                        'accountant' => $this->lang->line('mailandsmstemplate_accountant')
                                    );
                                    echo form_dropdown("email_user", $array, set_value("email_user", $mailandsmstemplate->user), "id='email_user' class='form-control'");
                                ?>
                            </div>
                            <span class="col-sm-4 control-label">
                                <?php echo form_error('email_user'); ?>
                            </span>
                        </div>

                        <?php 
                            if(form_error('email_tags')) 
                                echo "<div class='form-group has-error' >";
                            else     
                                echo "<div class='form-group' >";
                        ?>
                            <label for="email_tags" class="col-sm-1 control-label">
                                <?=$this->lang->line("mailandsmstemplate_tags")?>
                            </label>
                            <div class="col-sm-8" >
                                <div class="col-sm-12 border" id="email_tags">
                                    <div id="email_student">
                                        <?php
                                            if(count($students)) {
                                                foreach ($students as $key => $student) {
                                                    echo '<input class="btn bg-black btn-xs email_alltag" type="button" value="'.$student->tagname.'"> ';
                                                }
                                            }
                                        ?>
                                    </div>

                                    <div id="email_parents">
                                        <?php
                                            if(count($parents)) {
                                                foreach ($parents as $key => $parents) {
                                                    echo '<input class="btn bg-black btn-xs email_alltag" type="button" value="'.$parents->tagname.'"> ';
                                                }
                                            }
                                        ?>
                                    </div>

                                    <div id="email_teacher">
                                        <?php
                                            if(count($teachers)) {
                                                foreach ($teachers as $key => $teacher) {
                                                    echo '<input class="btn bg-black btn-xs email_alltag" type="button" value="'.$teacher->tagname.'"> ';
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div id="email_librarian">
                                        <?php
                                            if(count($librarians)) {
                                                foreach ($librarians as $key => $librarian) {
                                                    echo '<input class="btn bg-black btn-xs email_alltag" type="button" value="'.$librarian->tagname.'"> ';
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div id="email_accountant">
                                        <?php
                                            if(count($accountants)) {
                                                foreach ($accountants as $key => $accountant) {
                                                    echo '<input class="btn bg-black btn-xs email_alltag" type="button" value="'.$accountant->tagname.'"> ';
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <span class="col-sm-3 control-label">
                                <?php echo form_error('email_tags'); ?>
                            </span>
                        </div>

                        <?php 
                            if(form_error('email_template')) 
                                echo "<div class='form-group has-error' >";
                            else     
                                echo "<div class='form-group' >";
                        ?>
                            <label for="email_template" class="col-sm-1 control-label">
                                <?=$this->lang->line("mailandsmstemplate_template")?>
                            </label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="email_template" name="email_template" ><?=set_value('email_template', $mailandsmstemplate->template)?></textarea>
                            </div>
                            <span class="col-sm-3 control-label">
                                <?php echo form_error('email_template'); ?>
                            </span>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-1 col-sm-8">
                                <input type="submit" class="btn btn-success" value="<?=$this->lang->line("update_template")?>" >
                            </div>
                        </div>

                    </form>
                <?php } elseif($sms == 1) { ?>
                    <form class="form-horizontal" role="form" method="post">
                        <?php 
                            if(form_error('sms_name')) 
                                echo "<div class='form-group has-error' >";
                            else     
                                echo "<div class='form-group' >";
                        ?>
                            <label for="sms_name" class="col-sm-1 control-label">
                                <?=$this->lang->line("mailandsmstemplate_name")?>
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="sms_name" name="sms_name" value="<?=set_value('sms_name', $mailandsmstemplate->name)?>" >
                            </div>
                            <span class="col-sm-4 control-label">
                                <?php echo form_error('sms_name'); ?>
                            </span>
                        </div>

                        <?php 
                            if(form_error('sms_user')) 
                                echo "<div class='form-group has-error' >";
                            else     
                                echo "<div class='form-group' >";
                        ?>
                            <label for="sms_user" class="col-sm-1 control-label">
                                <?=$this->lang->line("mailandsmstemplate_user")?>
                            </label>
                            <div class="col-sm-4">
                                <?php
                                    $array = array(
                                        'select' => $this->lang->line('mailandsmstemplate_select_user'),
                                        'student' => $this->lang->line('mailandsmstemplate_student'),
                                        'parents' => $this->lang->line('mailandsmstemplate_parents'),
                                        'teacher' => $this->lang->line('mailandsmstemplate_teacher'),
                                        'librarian' => $this->lang->line('mailandsmstemplate_librarian'),
                                        'accountant' => $this->lang->line('mailandsmstemplate_accountant')
                                    );
                                    echo form_dropdown("sms_user", $array, set_value("sms_user", $mailandsmstemplate->user), "id='sms_user' class='form-control'");
                                ?>
                            </div>
                            <span class="col-sm-4 control-label">
                                <?php echo form_error('sms_user'); ?>
                            </span>
                        </div>

                        <?php 
                            if(form_error('sms_tags')) 
                                echo "<div class='form-group has-error' >";
                            else     
                                echo "<div class='form-group' >";
                        ?>
                            <label for="sms_tags" class="col-sm-1 control-label">
                                <?=$this->lang->line("mailandsmstemplate_tags")?>
                            </label>
                            <div class="col-sm-8" >
                                <div class="col-sm-12 border" id="sms_tags">
                                    <div id="sms_student">
                                        <?php
                                            if(count($students)) {
                                                foreach ($students as $key => $student) {
                                                    echo '<input class="btn bg-black btn-xs sms_alltag" type="button" value="'.$student->tagname.'"> ';
                                                }
                                            }
                                        ?>
                                    </div>

                                    <div id="sms_parents">
                                        <?php
                                            if(count($parents)) {
                                                foreach ($parents as $key => $parents) {
                                                    echo '<input class="btn bg-black btn-xs sms_alltag" type="button" value="'.$parents->tagname.'"> ';
                                                }
                                            }
                                        ?>
                                    </div>

                                    <div id="sms_teacher">
                                        <?php
                                            if(count($teachers)) {
                                                foreach ($teachers as $key => $teacher) {
                                                    echo '<input class="btn bg-black btn-xs sms_alltag" type="button" value="'.$teacher->tagname.'"> ';
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div id="sms_librarian">
                                        <?php
                                            if(count($librarians)) {
                                                foreach ($librarians as $key => $librarian) {
                                                    echo '<input class="btn bg-black btn-xs sms_alltag" type="button" value="'.$librarian->tagname.'"> ';
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div id="sms_accountant">
                                        <?php
                                            if(count($accountants)) {
                                                foreach ($accountants as $key => $accountant) {
                                                    echo '<input class="btn bg-black btn-xs sms_alltag" type="button" value="'.$accountant->tagname.'"> ';
                                                }
                                            }
                                        ?>
                                    </div>
                                
                                    <!-- <input type="button" class="alltag" name="" value="aaaa"> -->
                                </div>
                            </div>
                            <span class="col-sm-3 control-label">
                                <?php echo form_error('sms_tags'); ?>
                            </span>
                        </div>

                        <?php 
                            if(form_error('sms_template')) 
                                echo "<div class='form-group has-error' >";
                            else     
                                echo "<div class='form-group' >";
                        ?>
                            <label for="sms_template" class="col-sm-1 control-label">
                                <?=$this->lang->line("mailandsmstemplate_template")?>
                            </label>
                            <div class="col-sm-8">
                                <textarea class="form-control" style="resize: vertical;" id="sms_template" name="sms_template" ><?=set_value('sms_template', $mailandsmstemplate->template)?></textarea>
                            </div>
                            <span class="col-sm-3 control-label">
                                <?php echo form_error('sms_template'); ?>
                            </span>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-1 col-sm-8">
                                <input type="submit" class="btn btn-success" value="<?=$this->lang->line("update_template")?>" >
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/editor/jquery-te-1.4.0.min.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function() {

    var email_setuser = "<?=$email_user?>";
    if(email_setuser !='select') {
        if(email_setuser == "student") {
            $("#email_student").show();
            $("#email_parents").hide();
            $("#email_teacher").hide();
            $("#email_librarian").hide();
            $("#email_accountant").hide();
        } else if(email_setuser == "parents") {
            $("#email_student").hide();
            $("#email_parents").show();
            $("#email_teacher").hide();
            $("#email_librarian").hide();
            $("#email_accountant").hide();
        } else if(email_setuser == "teacher") {
            $("#email_student").hide();
            $("#email_parents").hide();
            $("#email_teacher").show();
            $("#email_librarian").hide();
            $("#email_accountant").hide();
        } else if(email_setuser == "librarian") {
            $("#email_student").hide();
            $("#email_parents").hide();
            $("#email_teacher").hide();
            $("#email_librarian").show();
            $("#email_accountant").hide();
        } else if(email_setuser == "accountant") {
            $("#email_student").hide();
            $("#email_parents").hide();
            $("#email_teacher").hide();
            $("#email_librarian").hide();
            $("#email_accountant").show();
        }        
    } else {
        $("#email_student").hide();
        $("#email_parents").hide();
        $("#email_teacher").hide();
        $("#email_librarian").hide();
        $("#email_accountant").hide();
    }

    var sms_setuser = "<?=$sms_user?>";
    if(sms_setuser !='select') {
        if(sms_setuser == "student") {
            $("#sms_student").show();
            $("#sms_parents").hide();
            $("#sms_teacher").hide();
            $("#sms_librarian").hide();
            $("#sms_accountant").hide();
        } else if(sms_setuser == "parents") {
            $("#sms_student").hide();
            $("#sms_parents").show();
            $("#sms_teacher").hide();
            $("#sms_librarian").hide();
            $("#sms_accountant").hide();
        } else if(sms_setuser == "teacher") {
            $("#sms_student").hide();
            $("#sms_parents").hide();
            $("#sms_teacher").show();
            $("#sms_librarian").hide();
            $("#sms_accountant").hide();
        } else if(sms_setuser == "librarian") {
            $("#sms_student").hide();
            $("#sms_parents").hide();
            $("#sms_teacher").hide();
            $("#sms_librarian").show();
            $("#sms_accountant").hide();
        } else if(sms_setuser == "accountant") {
            $("#sms_student").hide();
            $("#sms_parents").hide();
            $("#sms_teacher").hide();
            $("#sms_librarian").hide();
            $("#sms_accountant").show();
        }        
    } else {
        $("#sms_student").hide();
        $("#sms_parents").hide();
        $("#sms_teacher").hide();
        $("#sms_librarian").hide();
        $("#sms_accountant").hide();
    }


    $('#email_user').change(function() {
        var email_user = $(this).val();
        if(email_user !='select') {
            if(email_user == "student") {
                $("#email_student").show();
                $("#email_parents").hide();
                $("#email_teacher").hide();
                $("#email_librarian").hide();
                $("#email_accountant").hide();
            } else if(email_user == "parents") {
                $("#email_student").hide();
                $("#email_parents").show();
                $("#email_teacher").hide();
                $("#email_librarian").hide();
                $("#email_accountant").hide();
            } else if(email_user == "teacher") {
                $("#email_student").hide();
                $("#email_parents").hide();
                $("#email_teacher").show();
                $("#email_librarian").hide();
                $("#email_accountant").hide();
            } else if(email_user == "librarian") {
                $("#email_student").hide();
                $("#email_parents").hide();
                $("#email_teacher").hide();
                $("#email_librarian").show();
                $("#email_accountant").hide();
            } else if(email_user == "accountant") {
                $("#email_student").hide();
                $("#email_parents").hide();
                $("#email_teacher").hide();
                $("#email_librarian").hide();
                $("#email_accountant").show();
            }        
        } else {
            $("#email_student").hide();
            $("#email_parents").hide();
            $("#email_teacher").hide();
            $("#email_librarian").hide();
            $("#email_accountant").hide();
        }
    });

    $('#sms_user').change(function() {
        var sms_user = $(this).val();
        if(sms_user !='select') {
            if(sms_user == "student") {
                $("#sms_student").show();
                $("#sms_parents").hide();
                $("#sms_teacher").hide();
                $("#sms_librarian").hide();
                $("#sms_accountant").hide();
            } else if(sms_user == "parents") {
                $("#sms_student").hide();
                $("#sms_parents").show();
                $("#sms_teacher").hide();
                $("#sms_librarian").hide();
                $("#sms_accountant").hide();
            } else if(sms_user == "teacher") {
                $("#sms_student").hide();
                $("#sms_parents").hide();
                $("#sms_teacher").show();
                $("#sms_librarian").hide();
                $("#sms_accountant").hide();
            } else if(sms_user == "librarian") {
                $("#sms_student").hide();
                $("#sms_parents").hide();
                $("#sms_teacher").hide();
                $("#sms_librarian").show();
                $("#sms_accountant").hide();
            } else if(sms_user == "accountant") {
                $("#sms_student").hide();
                $("#sms_parents").hide();
                $("#sms_teacher").hide();
                $("#sms_librarian").hide();
                $("#sms_accountant").show();
            }        
        } else {
            $("#sms_student").hide();
            $("#sms_parents").hide();
            $("#sms_teacher").hide();
            $("#sms_librarian").hide();
            $("#sms_accountant").hide();
        }
    });

    $('.email_alltag').click(function() {
        var value = $(this).val();
        $(".jqte_editor").append(value);
    });

    $('.sms_alltag').click(function() {
        var value = $(this).val();
        $template = $('#sms_template').val();
        $('#sms_template').val($template+value);
    });

$('#email_template').jqte();
});

</script>

