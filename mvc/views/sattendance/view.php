
<?php
    $month = array(
      "01" => "jan",
      "02" => "feb",
      "03" => "mar",
      "04" => "apr",
      "05" => "may",
      "06" => "jun",
      "07" => "jul",
      "08" => "aug",
      "09" => "sep",
      "10" => "oct",
      "11" => "nov",
      "12" => "dec"

    );
    function attendance($a,$lang) {
      $i=1;
      foreach ($a as $key => $val) {
        $day = "a".$i;
        if($key == $day){
            echo "<td class='att-bg-color' data-title='".$lang->line('attendance_'.$i)."' >".$val."</td>";
          $i++;
        }
      }
    }

    if(count($student)) {
        $usertype = $this->session->userdata("usertype");
        if($usertype == "Admin" || $usertype == "Teacher") {
?>
    <div class="well">
        <div class="row">
            <div class="col-sm-6">
                <button class="btn-cs btn-sm-cs" onclick="javascript:printDiv('printablediv')"><span class="fa fa-print"></span> <?=$this->lang->line('print')?> </button>
                <?php
                 echo btn_add_pdf('sattendance/print_preview/'.$student->studentID."/".$set, $this->lang->line('pdf_preview'))
                ?>
                <button class="btn-cs btn-sm-cs" data-toggle="modal" data-target="#mail"><span class="fa fa-envelope-o"></span> <?=$this->lang->line('mail')?></button>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
                    <li><a href="<?=base_url("sattendance/index/$set")?>"><?=$this->lang->line('menu_sattendance')?></a></li>
                    <li class="active"><?=$this->lang->line('view')?></li>
                </ol>
            </div>
        </div>
    </div>
    <?php } ?>

    <div id="printablediv">
        <section class="panel">
            <div class="profile-view-head">
                <a href="#">
                    <?=img(base_url('uploads/images/'.$student->photo))?>
                </a>

                <h1><?=$student->name?></h1>
                <p><?=$this->lang->line("attendance_classes")." ".$classes->classes?></p>

            </div>
            <div class="panel-body profile-view-dis">
                <h1><?=$this->lang->line("personal_information")?></h1>
                <div class="row">
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("attendance_roll")?> </span>: <?=$student->roll?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("menu_section")?> </span>: <?php if(count($section)) { echo $section->section;} else { echo $student->section;}?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("attendance_dob")?> </span>: <?=date("d M Y", strtotime($student->dob))?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("attendance_sex")?> </span>: <?=$student->sex?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("attendance_religion")?> </span>: <?=$student->religion?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("attendance_email")?> </span>: <?=$student->email?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("attendance_phone")?> </span>: <?=$student->phone?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("attendance_address")?> </span>: <?=$student->address?></p>
                    </div>
                    <?php if($usertype == "Admin") { ?>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("attendance_username")?> </span>: <?=$student->username?></p>
                    </div>
                    <?php } ?>
                </div>

                <?php
                  $year = date("Y");
                  if($this->data['setting']->attendance == "subject") {
                    if(count($subjects)){
                      foreach ($subjects as $subject) {
                        echo "<h1>".$subject->subject." ".$this->lang->line("attendance_information")."</h1>";
                ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="hide-table">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <?php
                                            for($i=1; $i<=31; $i++){
                                               echo  "<th>".$this->lang->line('attendance_'.$i)."</th>";
                                            }
                                        ?>
                                    </tr>
                                </thead>
                      <?php
                              if(count($attendances)) {

                                  foreach ($attendances as $key => $attendance) {
                                      if($attendance->subjectID == $subject->subjectID) {
                                        $monthyear_ex = explode('-', $attendance->monthyear);
                                        if($monthyear_ex[1] == $year ) {
                                          echo "<tr>";
                                              echo "<th>".$this->lang->line('attendance_'.$month[$monthyear_ex[0]])."</th>";
                                              attendance($attendance,$this->lang);
                                          echo "</tr>";
                                        }
                                      }
                                  }
                              }
                              ?>
                              </table>
                          </div>
                      </div>
                  </div>
                  <?php
                      }
                    }

                  } else {

                ?>
                <h1><?=$this->lang->line("attendance_information")?></h1>

                <div class="row">
                    <div class="col-sm-12">
                        <div id="hide-table">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <?php
                                            for($i=1; $i<=31; $i++){
                                               echo  "<th>".$this->lang->line('attendance_'.$i)."</th>";
                                            }
                                        ?>
                                    </tr>
                                </thead>
                                <?php

                                    if(count($attendances)) {

                                        foreach ($attendances as $key => $attendance) {
                                            $monthyear_ex = explode('-', $attendance->monthyear);
                                            if($monthyear_ex[0] === '01' && $monthyear_ex[1] == $year ) {
                                ?>
                                    <tr>
                                        <th><?=$this->lang->line('attendance_jan')?></th>
                                        <?php attendance($attendance,$this->lang); ?>
                                    </tr>
                                <?php } elseif($monthyear_ex[0] === '02' && $monthyear_ex[1] == $year) { ?>
                                    <tr>
                                        <th><?=$this->lang->line('attendance_feb')?></th>
                                        <?php attendance($attendance,$this->lang); ?>
                                    </tr>
                                <?php } elseif($monthyear_ex[0] === '03' && $monthyear_ex[1] == $year) { ?>
                                    <tr>
                                        <th><?=$this->lang->line('attendance_mar')?></th>
                                        <?php attendance($attendance,$this->lang); ?>
                                    </tr>
                                <?php } elseif($monthyear_ex[0] === '04' && $monthyear_ex[1] == $year) { ?>
                                    <tr>
                                        <th><?=$this->lang->line('attendance_apr')?></th>
                                        <?php attendance($attendance,$this->lang); ?>
                                    </tr>
                                <?php } elseif($monthyear_ex[0] === '05' && $monthyear_ex[1] == $year) { ?>
                                    <tr>
                                        <th><?=$this->lang->line('attendance_may')?></th>
                                        <?php attendance($attendance,$this->lang); ?>
                                    </tr>
                                <?php } elseif($monthyear_ex[0] === '06' && $monthyear_ex[1] == $year) { ?>
                                    <tr>
                                        <th><?=$this->lang->line('attendance_june')?></th>
                                        <?php attendance($attendance,$this->lang); ?>
                                    </tr>
                                <?php } elseif($monthyear_ex[0] === '07' && $monthyear_ex[1] == $year) { ?>
                                    <tr>
                                        <th><?=$this->lang->line('attendance_jul')?></th>
                                        <?php attendance($attendance,$this->lang); ?>
                                    </tr>
                                <?php } elseif($monthyear_ex[0] === '08' && $monthyear_ex[1] == $year) { ?>
                                    <tr>
                                        <th><?=$this->lang->line('attendance_aug')?></th>
                                        <?php attendance($attendance,$this->lang); ?>
                                    </tr>
                                <?php } elseif($monthyear_ex[0] === '09' && $monthyear_ex[1] == $year) { ?>
                                    <tr>
                                        <th><?=$this->lang->line('attendance_sep')?></th>
                                        <?php attendance($attendance,$this->lang); ?>
                                    </tr>
                                <?php } elseif($monthyear_ex[0] === '10' && $monthyear_ex[1] == $year) { ?>
                                    <tr>
                                        <th><?=$this->lang->line('attendance_oct')?></th>
                                        <?php attendance($attendance,$this->lang); ?>
                                    </tr>
                                <?php } elseif($monthyear_ex[0] === '11' && $monthyear_ex[1] == $year) { ?>
                                    <tr>
                                        <th><?=$this->lang->line('attendance_nov')?></th>
                                        <?php attendance($attendance,$this->lang); ?>
                                    </tr>
                                <?php } elseif($monthyear_ex[0] === '12' && $monthyear_ex[1] == $year) { ?>
                                    <tr>
                                        <th><?=$this->lang->line('attendance_dec')?></th>
                                        <?php attendance($attendance,$this->lang); ?>
                                    </tr>
                                <?php
                                            }
                                        }

                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
          <?php } ?>
            </div>
        </section>
    </div>
<!-- email modal starts here -->
<form class="form-horizontal" role="form" action="<?=base_url('teacher/send_mail');?>" method="post">
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

    <?php if($usertype == "Admin" || $usertype == "Teacher") { ?>
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
                    url: "<?=base_url('sattendance/send_mail')?>",
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
<?php } ?>

<?php
    $usertype = $this->session->userdata('usertype');
    if($usertype == "Student" || $usertype == "Parent") {
?>

    <script language="javascript" type="text/javascript">
        $('#sattendance').addClass('active');
    </script>

<?php } ?>
