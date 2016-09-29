
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-eattendance"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_eattendance')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <?php 
                    $usertype = $this->session->userdata("usertype");
                    if($usertype == "Admin" || $usertype == "Teacher") {
                ?>
                    <h5 class="page-header">
                        <a href="<?php echo base_url('eattendance/add') ?>">
                            <i class="fa fa-plus"></i> 
                            <?=$this->lang->line('add_title')?>
                        </a>
                    </h5>
                <?php } ?>

                <div class="col-sm-6 col-sm-offset-3 list-group">
                    <div class="list-group-item list-group-item-warning">
                        <form class="form-horizontal" role="form" method="post">

                            <?php 
                                if(form_error('examID')) 
                                    echo "<div class='form-group has-error' >";
                                else     
                                    echo "<div class='form-group' >";
                            ?>
                                <label for="examID" class="col-sm-2 col-sm-offset-2 control-label">
                                    <?=$this->lang->line('eattendance_exam')?>
                                </label>
                                <div class="col-sm-6">
                                    <?php
                                        $array = array("0" => $this->lang->line("eattendance_select_exam"));
                                        foreach ($exams as $exam) {
                                            $array[$exam->examID] = $exam->exam;
                                        }
                                        echo form_dropdown("examID", $array, set_value("examID"), "id='examID' class='form-control'");
                                    ?>
                                </div>
                            </div>

                            <?php 
                                if(form_error('classesID')) 
                                    echo "<div class='form-group has-error' >";
                                else     
                                    echo "<div class='form-group' >";
                            ?>
                                <label for="classesID" class="col-sm-2 col-sm-offset-2 control-label">
                                    <?=$this->lang->line('eattendance_classes')?>
                                </label>
                                <div class="col-sm-6">
                                    <?php
                                        $array = array("0" => $this->lang->line("eattendance_select_classes"));
                                        foreach ($classes as $classa) {
                                            $array[$classa->classesID] = $classa->classes;
                                        }
                                        echo form_dropdown("classesID", $array, set_value("classesID"), "id='classesID' class='form-control'");
                                    ?>
                                </div>
                            </div>

                            <?php 
                                if(form_error('subjectID')) 
                                    echo "<div class='form-group has-error' >";
                                else     
                                    echo "<div class='form-group' >";
                            ?>
                                <label for="subjectID" class="col-sm-2 col-sm-offset-2 control-label">
                                    <?=$this->lang->line("eattendance_subject")?>
                                </label>
                                <div class="col-sm-6">
                                    <?php
                                    $array = array('0' => $this->lang->line("eattendance_select_subject"));
                                    if($subjects != "empty") {
                                        foreach ($subjects as $subject) {
                                            $array[$subject->subjectID] = $subject->subject;
                                        }
                                    }

                                    $sID = 0;
                                    if($subjectID == 0) {
                                        $sID = 0;
                                    } else {
                                        $sID = $subjectID;
                                    }
                                    
                                    echo form_dropdown("subjectID", $array, set_value("subjectID", $sID), "id='subjectID' class='form-control'");
                                    ?>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <input type="submit" class="btn btn-success" style="margin-bottom:0px" value="<?=$this->lang->line("view_attendance")?>" >
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <?php if(count($students) > 0 ) { ?>

                    <div class="col-sm-12">

                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true"><?=$this->lang->line("eattendance_all_students")?></a></li>
                                <?php foreach ($sections as $key => $section) {
                                    echo '<li class=""><a data-toggle="tab" href="#'. $section->sectionID .'" aria-expanded="false">'. $this->lang->line("student_section")." ".$section->section. " ( ". $section->category." )".'</a></li>';
                                } ?>
                            </ul>



                            <div class="tab-content">
                                <div id="all" class="tab-pane active">
                                    <div id="hide-table">
                                        <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                                            <thead>
                                                <tr>
                                                    <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                                    <th class="col-sm-2"><?=$this->lang->line('eattendance_photo')?></th>
                                                    <th class="col-sm-2"><?=$this->lang->line('eattendance_name')?></th>
                                                    <th class="col-sm-2"><?=$this->lang->line('eattendance_roll')?></th>
                                                    <th class="col-sm-2"><?=$this->lang->line('eattendance_phone')?></th>
                                                    <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(count($students)) {$i = 1; foreach($students as $student) { ?>
                                                    <tr>
                                                        <td data-title="<?=$this->lang->line('slno')?>">
                                                            <?php echo $i; ?>
                                                        </td>

                                                        <td data-title="<?=$this->lang->line('eattendance_photo')?>">
                                                            <?php $array = array(
                                                                    "src" => base_url('uploads/images/'.$student->photo),
                                                                    'width' => '35px',
                                                                    'height' => '35px',
                                                                    'class' => 'img-rounded'

                                                                );
                                                                echo img($array); 
                                                            ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('eattendance_name')?>">
                                                            <?php echo $student->name; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('eattendance_roll')?>">
                                                            <?php echo $student->roll; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('eattendance_phone')?>">
                                                            <?php echo $student->phone; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('action')?>">
                                                            <?php
                                                                foreach ($eattendances as $eattendance) {
                                                                    if($eattendance->studentID == $student->studentID && $examID == $eattendance->examID && $classesID == $eattendance->classesID && $subjectID == $eattendance->subjectID) {

                                                                        if($eattendance->eattendance == "Present") {
                                                                            echo "<button class='btn btn-success btn-xs'>" . $eattendance->eattendance . "</button>";
                                                                        } elseif($eattendance->eattendance == "") {
                                                                            echo "<button class='btn btn-danger btn-xs'>" . "Absent" . "</button>";
                                                                        } else {
                                                                            echo "<button class='btn btn-danger btn-xs'>" . $eattendance->eattendance . "</button>";
                                                                        }
                                                                        break;
                                                                    }
                                                                }
                                                            ?>
                                                        </td>
                                                   </tr>
                                                <?php $i++; }} ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <?php foreach ($sections as $key => $section) { ?>
                                        <div id="<?=$section->sectionID?>" class="tab-pane">
                                            <div id="hide-table">
                                                <table class="table table-striped table-bordered table-hover dataTable no-footer">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                                            <th class="col-sm-2"><?=$this->lang->line('eattendance_photo')?></th>
                                                            <th class="col-sm-2"><?=$this->lang->line('eattendance_name')?></th>
                                                            <th class="col-sm-2"><?=$this->lang->line('eattendance_roll')?></th>
                                                            <th class="col-sm-2"><?=$this->lang->line('eattendance_phone')?></th>
                                                            <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if(count($allsection[$section->section])) { $i = 1; foreach($allsection[$section->section] as $student) { ?>
                                                            <tr>
                                                                <td data-title="<?=$this->lang->line('slno')?>">
                                                                    <?php echo $i; ?>
                                                                </td>

                                                                <td data-title="<?=$this->lang->line('eattendance_photo')?>">
                                                                    <?php $array = array(
                                                                            "src" => base_url('uploads/images/'.$student->photo),
                                                                            'width' => '35px',
                                                                            'height' => '35px',
                                                                            'class' => 'img-rounded'

                                                                        );
                                                                        echo img($array); 
                                                                    ?>
                                                                </td>
                                                                <td data-title="<?=$this->lang->line('eattendance_name')?>">
                                                                    <?php echo $student->name; ?>
                                                                </td>
                                                                <td data-title="<?=$this->lang->line('eattendance_roll')?>">
                                                                    <?php echo $student->roll; ?>
                                                                </td>
                                                                <td data-title="<?=$this->lang->line('eattendance_phone')?>">
                                                                    <?php echo $student->phone; ?>
                                                                </td>
                                                                <td data-title="<?=$this->lang->line('action')?>">
                                                                    <?php
                                                                        foreach ($eattendances as $eattendance) {
                                                                            if($eattendance->studentID == $student->studentID && $examID == $eattendance->examID && $classesID == $eattendance->classesID && $subjectID == $eattendance->subjectID) {

                                                                                if($eattendance->eattendance == "Present") {
                                                                                    echo "<button class='btn btn-success btn-xs'>" . $eattendance->eattendance . "</button>";
                                                                                } elseif($eattendance->eattendance == "") {
                                                                                    echo "<button class='btn btn-danger btn-xs'>" . "Absent" . "</button>";
                                                                                } else {
                                                                                    echo "<button class='btn btn-danger btn-xs'>" . $eattendance->eattendance . "</button>";
                                                                                }
                                                                                break;
                                                                            }
                                                                        }
                                                                    ?>
                                                                </td>
                                                           </tr>
                                                        <?php $i++; }} ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                <?php } ?>
                            </div>

                        </div> <!-- nav-tabs-custom -->
                    </div> <!-- col-sm-12 for tab -->

                <?php } else { ?>
                    <div class="col-sm-12">

                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true"><?=$this->lang->line("eattendance_all_students")?></a></li>
                            </ul>


                            <div class="tab-content">
                                <div id="all" class="tab-pane active">
                                    <div id="hide-table">
                                        <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                                            <thead>
                                                <tr>
                                                    <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                                    <th class="col-sm-2"><?=$this->lang->line('eattendance_photo')?></th>
                                                    <th class="col-sm-2"><?=$this->lang->line('eattendance_name')?></th>
                                                    <th class="col-sm-2"><?=$this->lang->line('eattendance_roll')?></th>
                                                    <th class="col-sm-2"><?=$this->lang->line('eattendance_phone')?></th>
                                                    <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(count($students)) {$i = 1; foreach($students as $student) { ?>
                                                    <tr>
                                                        <td data-title="<?=$this->lang->line('slno')?>">
                                                            <?php echo $i; ?>
                                                        </td>

                                                        <td data-title="<?=$this->lang->line('eattendance_photo')?>">
                                                            <?php $array = array(
                                                                    "src" => base_url('uploads/images/'.$student->photo),
                                                                    'width' => '35px',
                                                                    'height' => '35px',
                                                                    'class' => 'img-rounded'

                                                                );
                                                                echo img($array); 
                                                            ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('eattendance_name')?>">
                                                            <?php echo $student->name; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('eattendance_roll')?>">
                                                            <?php echo $student->roll; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('eattendance_phone')?>">
                                                            <?php echo $student->phone; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('action')?>">
                                                            <?php
                                                                foreach ($eattendances as $eattendance) {
                                                                    if($eattendance->studentID == $student->studentID && $examID == $eattendance->examID && $classesID == $eattendance->classesID && $subjectID == $eattendance->subjectID) {

                                                                        if($eattendance->eattendance == "Present") {
                                                                            echo "<button class='btn btn-success btn-xs'>" . $eattendance->eattendance . "</button>";
                                                                        } elseif($eattendance->eattendance == "") {
                                                                            echo "<button class='btn btn-danger btn-xs'>" . "Absent" . "</button>";
                                                                        } else {
                                                                            echo "<button class='btn btn-danger btn-xs'>" . $eattendance->eattendance . "</button>";
                                                                        }
                                                                        break;
                                                                    }
                                                                }
                                                            ?>
                                                        </td>
                                                   </tr>
                                                <?php $i++; }} ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div> <!-- nav-tabs-custom -->
                    </div>
                <?php } ?>

                
                    
            </div> <!-- col-sm-12 -->
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->

<script type="text/javascript">
$('#classesID').change(function(event) {
    var classesID = $(this).val();
    if(classesID === '0') {
        $('#subjectID').val(0);
    } else {
        $.ajax({
            type: 'POST',
            url: "<?=base_url('eattendance/subjectcall')?>",
            data: "id=" + classesID,
            dataType: "html",
            success: function(data) {
               $('#subjectID').html(data);
            }
        });
    }
});

</script>