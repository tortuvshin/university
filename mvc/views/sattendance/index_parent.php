

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-sattendance"></i> <?=$this->lang->line('panel_title2')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_attendance')?></li>
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
                                    <?=$this->lang->line("attendance_student")?>
                                </label>
                                <div class="col-sm-6">
                                    <?php
                                        $array = array("0" => $this->lang->line("attendance_select_student"));
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


                <?php if(count($student)) { ?>
                    <div class="col-sm-12">
                    <section class="panel" id="hide">
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
                            </div>

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
                                                $year = date("Y");
                                                if($attendances) { 
                                                    foreach ($attendances as $key => $attendance) {
                                                        $monthyear_ex = explode('-', $attendance->monthyear);
                                                        if($monthyear_ex[0] === '01' && $monthyear_ex[1] == $year ) {
                                            ?>
                                                <tr>
                                                    <th><?=$this->lang->line('attendance_jan')?></th>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
                                                </tr>
                                            <?php } elseif($monthyear_ex[0] === '02' && $monthyear_ex[1] == $year) { ?>
                                                <tr>
                                                    <th><?=$this->lang->line('attendance_feb')?></th>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
                                                </tr>
                                            <?php } elseif($monthyear_ex[0] === '03' && $monthyear_ex[1] == $year) { ?>
                                                <tr>
                                                    <th><?=$this->lang->line('attendance_mar')?></th>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
                                                </tr>
                                            <?php } elseif($monthyear_ex[0] === '04' && $monthyear_ex[1] == $year) { ?>
                                                <tr>
                                                    <th><?=$this->lang->line('attendance_apr')?></th>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
                                                </tr>
                                            <?php } elseif($monthyear_ex[0] === '05' && $monthyear_ex[1] == $year) { ?>
                                                <tr>
                                                    <th><?=$this->lang->line('attendance_may')?></th>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
                                                </tr>
                                            <?php } elseif($monthyear_ex[0] === '06' && $monthyear_ex[1] == $year) { ?>
                                                <tr>
                                                    <th><?=$this->lang->line('attendance_june')?></th>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
                                                </tr>
                                            <?php } elseif($monthyear_ex[0] === '07' && $monthyear_ex[1] == $year) { ?>
                                                <tr>
                                                    <th><?=$this->lang->line('attendance_jul')?></th>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
                                                </tr>
                                            <?php } elseif($monthyear_ex[0] === '08' && $monthyear_ex[1] == $year) { ?>
                                                <tr>
                                                    <th><?=$this->lang->line('attendance_aug')?></th>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
                                                </tr>
                                            <?php } elseif($monthyear_ex[0] === '09' && $monthyear_ex[1] == $year) { ?>
                                                <tr>
                                                    <th><?=$this->lang->line('attendance_sep')?></th>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
                                                </tr>
                                            <?php } elseif($monthyear_ex[0] === '10' && $monthyear_ex[1] == $year) { ?>
                                                <tr>
                                                    <th><?=$this->lang->line('attendance_oct')?></th>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
                                                </tr>
                                            <?php } elseif($monthyear_ex[0] === '11' && $monthyear_ex[1] == $year) { ?>
                                                <tr>
                                                    <th><?=$this->lang->line('attendance_nov')?></th>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
                                                </tr>
                                            <?php } elseif($monthyear_ex[0] === '12' && $monthyear_ex[1] == $year) { ?>
                                                <tr>
                                                    <th><?=$this->lang->line('attendance_dec')?></th>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                                                    <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
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

                        </div>
                    </section>
                    </div>
                <?php } ?>

                <?php
                    $usertype = $this->session->userdata('usertype');
                    if($usertype == "Parent") {
                ?>
                    <script language="javascript" type="text/javascript">
                        var url = window.location.href;
                        $("a[href$='"+url+"']").parent().addClass('active');
                    </script>

                <?php } ?>


            </div> <!-- col-sm-12 -->
            
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->
<script type="text/javascript">
    $('#studentID').change(function() {
        var studentID = $(this).val();
        if(studentID == 0) {
            $('#hide').hide();
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('sattendance/pstudent_list')?>",
                data: "id=" + studentID,
                dataType: "html",
                success: function(data) {
                    window.location.href = data;
                }
            });
        }
    });
</script>

<?php
    $usertype = $this->session->userdata('usertype');
    if($usertype == "Student" || $usertype == "Parent") {
?>
    <script language="javascript" type="text/javascript">
        $('#sattendance').addClass('active');
    </script>

<?php } ?>
