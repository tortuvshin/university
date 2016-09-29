<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-puzzle-piece"></i> <?=$this->lang->line('panel_title')?></h3>

        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_mark')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <div class="col-sm-6 col-sm-offset-3 list-group">
                    <div class="list-group-item list-group-item-warning">
                        <form style="" class="form-horizontal" role="form" method="post">  
                            <div class="form-group">              
                                <label for="studentID" class="col-sm-2 col-sm-offset-2 control-label">
                                    <?=$this->lang->line("mark_student")?>
                                </label>
                                <div class="col-sm-6">
                                    <?php
                                        $array = array("0" => $this->lang->line("mark_select_student"));
                                        if($allstudents) {
                                            foreach ($allstudents as $allstudent) {
                                                $array[$allstudent->studentID] = $allstudent->name;
                                            }
                                        }
                                        echo form_dropdown("studentID", $array, set_value("studentID", $set), "id='studentID' class='form-control'");
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-sm-12">
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



            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#studentID').change(function() {
        var studentID = $(this).val();
        if(studentID == 0) {
            $('#hide-table').hide();
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('mark/student_list')?>",
                data: "id=" + studentID,
                dataType: "html",
                success: function(data) {
                    window.location.href = data;
                }
            });
        }
    });
</script>
