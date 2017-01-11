
<?php
    if(count($student)) {
        $usertype = $this->session->userdata("usertype");
        if($usertype == "Admin" || $usertype == "Teacher") {
?>
    <div class="well">
        <div class="row">
            <div class="col-sm-6">
                <button class="btn-cs btn-sm-cs" onclick="javascript:printDiv('printablediv')"><span class="fa fa-print"></span> <?=$this->lang->line('print')?> </button>
                <?php
                 echo btn_add_pdf('mark/print_preview/'.$student->studentID."/".$set, $this->lang->line('pdf_preview'))
                ?>
                <button class="btn-cs btn-sm-cs" data-toggle="modal" data-target="#mail"><span class="fa fa-envelope-o"></span> <?=$this->lang->line('mail')?></button>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
                    <li><a href="<?=base_url("mark/index/$set")?>"><?=$this->lang->line('menu_mark')?></a></li>
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
                <p><?=$this->lang->line("student_classes")." ".$classes->classes?></p>

            </div>
            <div class="panel-body profile-view-dis">
                <h1><?=$this->lang->line("personal_information")?></h1>
                <div class="row">
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("mark_roll")?> </span>: <?=$student->roll?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("menu_section")?> </span>: <?php if(count($section)) { echo $section->section;} else { echo $student->section;}?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("mark_dob")?> </span>: <?=date("d M Y", strtotime($student->dob))?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("mark_sex")?> </span>: <?=$student->sex?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("mark_religion")?> </span>: <?=$student->religion?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("mark_email")?> </span>: <?=$student->email?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("mark_phone")?> </span>: <?=$student->phone?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("mark_address")?> </span>: <?=$student->address?></p>
                    </div>
                    <?php if($usertype == "Admin") { ?>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("mark_username")?> </span>: <?=$student->username?></p>
                    </div>
                    <?php } ?>
                </div>

                <h1><?=$this->lang->line("mark_information")?></h1>

                <div class="row">
                    <?php if($marks && $exams) { ?>
                        <div class="col-lg-12">
                            <div id="hide-table">
                                <?php

                                    $map1 = function($r) { return intval($r->examID);};
                                    $marks_examsID = array_map($map1, $marks);
                                    $max_semester = max($marks_examsID);

                                    $map2 = function($r) { return intval($r->examID);};
                                    $examsID = array_map($map2, $exams);

                                    $map3 = function($r) { return array("mark" => intval($r->mark), "semester"=>$r->examID);};
                                    $all_marks = array_map($map3, $marks);

                                    $map4 = function($r) { return array("gradefrom" => $r->gradefrom, "gradeupto" => $r->gradeupto);};
                                    $grades_check = array_map($map4, $grades);

                                    foreach ($exams as $exam) {
                                        echo "<table class=\"table table-striped table-bordered\">";
                                            if($exam->examID <= $max_semester) {

                                                $check = array_search($exam->examID, $marks_examsID);

                                                if($check>=0) {
                                                    $f = 0;
                                                    foreach ($grades_check as $key => $range) {
                                                        foreach ($all_marks as $value) {
                                                            if($value['semester'] == $exam->examID ) {
                                                                if($value['mark']>=$range['gradefrom'] && $value['mark']<=$range['gradeupto'])
                                                                {
                                                                    $f=1;
                                                                }
                                                            }
                                                        }
                                                        if($f==1)
                                                        {
                                                            break;
                                                        }
                                                    }

                                                    echo "<caption>";
                                                        echo "<h3>". $exam->exam."</h3>";
                                                    echo "</caption>";

                                                    echo "<thead>";
                                                        echo "<tr>";
                                                            echo "<th>";
                                                                echo $this->lang->line("mark_subject");
                                                            echo "</th>";
                                                            echo "<th>";
                                                                echo $this->lang->line("mark_mark");
                                                            echo "</th>";
                                                            if(count($grades) && $f == 1) {
                                                                echo "<th>";
                                                                    echo $this->lang->line("mark_point");
                                                                echo "</th>";
                                                                echo "<th>";
                                                                    echo $this->lang->line("mark_grade");
                                                                echo "</th>";
                                                                echo "<th>";
                                                                    echo $this->lang->line("mark_highest_mark");
                                                                echo "</th>";
                                                            }
                                                        echo "</tr>";
                                                    echo "</thead>";
                                                }
                                            }

                                            echo "<tbody>";


                                        foreach ($marks as $mark) {
                                            if($exam->examID == $mark->examID) {
                                                echo "<tr>";
                                                    echo "<td data-title='".$this->lang->line('mark_subject')."'>";
                                                        echo $mark->subject;
                                                    echo "</td>";
                                                    echo "<td data-title='".$this->lang->line('mark_mark')."'>";
                                                        echo $mark->mark;
                                                    echo "</td>";
                                                    if(count($grades)) {
                                                        foreach ($grades as $grade) {
                                                            if($grade->gradefrom <= $mark->mark && $grade->gradeupto >= $mark->mark) {
                                                                echo "<td data-title='".$this->lang->line('mark_point')."'>";
                                                                    echo $grade->point;
                                                                echo "</td>";
                                                                echo "<td data-title='".$this->lang->line('mark_grade')."'>";
                                                                    echo $grade->grade;
                                                                echo "</td>";
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    echo "<td data-title='".$this->lang->line('mark_highest_mark')."'>";
                                                        echo $mark->highestmark;
                                                    echo "</td>";
                                                echo "</tr>";
                                            }
                                        }
                                            echo "</tbody>";
                                        echo "</table>";
                                    }
                                ?>

                            </div>
                        </div>
                    <?php } ?>
                </div>


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
                    url: "<?=base_url('mark/send_mail')?>",
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
    if($usertype == "Parent" || $usertype == "Student") {
?>
    <script language="javascript" type="text/javascript">
        var url = window.location.href;
        $("a[href$='"+url+"']").parent().addClass('active');
    </script>

<?php } ?>
