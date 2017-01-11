<?php
    if(count($student)) {
        $usertype = $this->session->userdata("usertype");
        if($usertype == "Admin") {
?>
    <div class="well">
        <div class="row">
            <div class="col-sm-6">
                <button class="btn-cs btn-sm-cs" onclick="javascript:printDiv('printablediv')"><span class="fa fa-print"></span> <?=$this->lang->line('print')?> </button>
                <?php
                 echo btn_add_pdf('student/print_preview/'.$student->studentID."/".$set, $this->lang->line('pdf_preview'))
                ?>
                <button class="btn-cs btn-sm-cs" data-toggle="modal" data-target="#idCard"><span class="fa fa-floppy-o"></span> <?=$this->lang->line('idcard')?> </button>
                <?php echo btn_sm_edit('student/edit/'.$student->studentID."/".$set, $this->lang->line('edit'))
                ?>
                <button class="btn-cs btn-sm-cs" data-toggle="modal" data-target="#mail"><span class="fa fa-envelope-o"></span> <?=$this->lang->line('mail')?></button>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
                    <li><a href="<?=base_url("student/index/$set")?>"><?=$this->lang->line('menu_student')?></a></li>
                    <li class="active"><?=$this->lang->line('view')?></li>
                </ol>
            </div>
        </div>

    </div>

    <?php } ?>

    <?php } ?>


    <div id="printablediv">
        <section class="panel">

            <div class="profile-view-head">
                <a href="#">
                    <?=img(base_url('uploads/images/'.$student->photo))?>
                </a>

                <h1><?=$student->name?></h1>
                <p><?=$this->lang->line("student_classes")." ".$class->classes?></p>

            </div>
            <div class="panel-body profile-view-dis">
                <h1><?=$this->lang->line("personal_information")?></h1>
                <div class="row">
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("student_roll")?> </span>: <?=$student->roll?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("student_section")?> </span>: <?php if(count($section)) { echo $section->section;} else { echo $student->section;}?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("student_dob")?> </span>: <?=date("d M Y", strtotime($student->dob))?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("student_sex")?> </span>: <?=$student->sex?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("student_religion")?> </span>: <?=$student->religion?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("student_email")?> </span>: <?=$student->email?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("student_phone")?> </span>: <?=$student->phone?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("student_address")?> </span>: <?=$student->address?></p>
                    </div>
                    <?php if($usertype == "Admin") { ?>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("student_username")?> </span>: <?=$student->username?></p>
                    </div>
                    <?php } ?>
                </div>

                <h1><?=$this->lang->line("parents_information")?></h1>
                <?php   if(isset($parent)) { ?>

                <div class="row">
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("parent_guargian_name")?> </span>: <?=$parent->name?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("parent_father_name")?> </span>: <?=$parent->father_name?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("parent_mother_name")?> </span>: <?=$parent->mother_name?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("parent_father_profession")?> </span>: <?=$parent->father_profession?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("parent_mother_profession")?> </span>: <?=$parent->mother_profession?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("parent_email")?> </span>: <?=$parent->email?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("parent_phone")?> </span>: <?=$parent->phone?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("parent_address")?> </span>: <?=$parent->address?></p>
                    </div>
                    <?php if($usertype == "Admin") { ?>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("parent_username")?> </span>: <?=$parent->username?></p>
                    </div>
                    <?php } ?>
                </div>
                <?php
                    } else {
                        echo "<div class='col-sm-12'><div class='col-sm-12 alert alert-warning'><span class='fa fa-exclamation-triangle'></span> " .$this->lang->line("parent_error"). "</div></div>";
                    }
                ?>

            </div>
        </section>
    </div>

    <?php if($usertype == "Admin") { ?>
    <!-- Modal content start here -->
    <div class="modal fade" id="idCard">
      <div class="modal-dialog">
        <div class="modal-content">
            <div id="idCardPrint">
              <div class="modal-header">
                <?=$this->lang->line('idcard')?>
              </div>
              <div class="modal-body" >
                <table>
                    <tr>
                        <td>
                            <h4 style="margin:0;">
                            <?php
                                if($siteinfos->photo) {
                                    $array = array(
                                        "src" => base_url('uploads/images/'.$siteinfos->photo),
                                        'width' => '25px',
                                        'height' => '25px',
                                        "style" => "margin-bottom:10px;"
                                    );
                                    echo img($array);
                                }

                            ?>

                            </h4>
                        </td>
                        <td style="padding-left:5px;">
                            <h4><?=$siteinfos->sname;?></h4>
                        </td>
                    </tr>
                </table>

                <table class="idcard-Table">
                    <tr>
                        <td>
                            <h4>
                                <?php
                                    echo img(base_url('uploads/images/'.$student->photo));
                                ?>
                            </h4>
                        </td>
                        <td class="row-style">
                            <h3><?php  echo $student->name; ?></h3>
                            <h5><?php  echo $this->lang->line("student_classes")." : ".$class->classes; ?>
                            </h5>
                            <h5><?php  echo $this->lang->line("student_section")." : ".$section->section; ?>
                            </h5>
                            <h5>
                                <?php  echo $this->lang->line("student_roll")." : ".$student->roll; ?>
                            </h5>
                        </td>
                    </tr>
                </table>
              </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" style="margin-bottom:0px;" onclick="javascript:closeWindow()" data-dismiss="modal"><?=$this->lang->line('close')?></button>
            <button type="button" class="btn btn-success" onclick="javascript:printDiv('idCardPrint')"><?=$this->lang->line('print')?></button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal content End here -->

<!-- email modal starts here -->
<form class="form-horizontal" role="form" action="<?=base_url('student/send_mail');?>" method="post">
    <div class="modal fade" id="mail">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><?=$this->lang->line('mail')?></h4>
            </div>
            <div class="modal-body">

                <?php
                    if(form_error('to'))
                        echo "<div class='form-group has-error' >";
                    else
                        echo "<div class='form-group' >";
                ?>
                    <label for="to" class="col-sm-2 control-label">
                        <?=$this->lang->line("to")?>
                    </label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" id="to" name="to" value="<?=set_value('to')?>" >
                    </div>
                    <span class="col-sm-4 control-label" id="to_error">
                    </span>
                </div>

                <?php
                    if(form_error('subject'))
                        echo "<div class='form-group has-error' >";
                    else
                        echo "<div class='form-group' >";
                ?>
                    <label for="subject" class="col-sm-2 control-label">
                        <?=$this->lang->line("subject")?>
                    </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="subject" name="subject" value="<?=set_value('subject')?>" >
                    </div>
                    <span class="col-sm-4 control-label" id="subject_error">
                    </span>

                </div>

                <?php
                    if(form_error('message'))
                        echo "<div class='form-group has-error' >";
                    else
                        echo "<div class='form-group' >";
                ?>
                    <label for="message" class="col-sm-2 control-label">
                        <?=$this->lang->line("message")?>
                    </label>
                    <div class="col-sm-6">
                        <textarea class="form-control" id="message" style="resize: vertical;" name="message" value="<?=set_value('message')?>" ></textarea>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" style="margin-bottom:0px;" data-dismiss="modal"><?=$this->lang->line('close')?></button>
                <input type="button" id="send_pdf" class="btn btn-success" value="<?=$this->lang->line("send")?>" />
            </div>
        </div>
      </div>
    </div>
</form>
<!-- email end here -->

    <script language="javascript" type="text/javascript">
        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML =
              "<html><head><title></title></head><body>" +
              divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;
        }
        function closeWindow() {
            location.reload();
        }

        function check_email(email) {
            var status = false;
            var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
            if (email.search(emailRegEx) == -1) {
                $("#to_error").html('');
                $("#to_error").html("<?=$this->lang->line('mail_valid')?>").css("text-align", "left").css("color", 'red');
            } else {
                status = true;
            }
            return status;
        }


        $("#send_pdf").click(function(){
            var to = $('#to').val();
            var subject = $('#subject').val();
            var message = $('#message').val();
            var id = "<?=$student->studentID;?>";
            var set = "<?=$set;?>";
            var error = 0;

            if(to == "" || to == null) {
                error++;
                $("#to_error").html("");
                $("#to_error").html("<?=$this->lang->line('mail_to')?>").css("text-align", "left").css("color", 'red');
            } else {
                if(check_email(to) == false) {
                    error++
                }
            }

            if(subject == "" || subject == null) {
                error++;
                $("#subject_error").html("");
                $("#subject_error").html("<?=$this->lang->line('mail_subject')?>").css("text-align", "left").css("color", 'red');
            } else {
                $("#subject_error").html("");
            }

            if(error == 0) {
                $.ajax({
                    type: 'POST',
                    url: "<?=base_url('student/send_mail')?>",
                    data: 'to='+ to + '&subject=' + subject + "&id=" + id+ "&message=" + message+ "&set=" + set,
                    dataType: "html",
                    success: function(data) {
                        location.reload();
                    }
                });
            }
        });
    </script>
    <?php } ?>
