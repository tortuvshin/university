
<?php 
    if(count($teacher)) {
        $usertype = $this->session->userdata("usertype");
        if($usertype == "Admin") {
?>
    <div class="well">
        <div class="row">
            <div class="col-sm-6">
                <button class="btn-cs btn-sm-cs" onclick="javascript:printDiv('printablediv')"><span class="fa fa-print"></span> <?=$this->lang->line('print')?> </button>
                <?php
                 echo btn_add_pdf('tattendance/print_preview/'.$teacher->teacherID, $this->lang->line('pdf_preview')) 
                ?>
                <button class="btn-cs btn-sm-cs" data-toggle="modal" data-target="#mail"><span class="fa fa-envelope-o"></span> <?=$this->lang->line('mail')?></button>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
                    <li><a href="<?=base_url("tattendance/index")?>"><?=$this->lang->line('menu_tattendance')?></a></li>
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
                    <?=img(base_url('uploads/images/'.$teacher->photo))?>
                </a>

                <h1><?=$teacher->name?></h1>
                <p><?=$teacher->designation?></p>

            </div>
            <div class="panel-body profile-view-dis">
                <h1><?=$this->lang->line("personal_information")?></h1>
                <div class="row">
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("tattendance_dob")?> </span>: <?=date("d M Y", strtotime($teacher->dob))?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("tattendance_jod")?> </span>: <?=date("d M Y", strtotime($teacher->jod))?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("tattendance_sex")?> </span>: <?=$teacher->sex?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("tattendance_religion")?> </span>: <?=$teacher->religion?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("tattendance_email")?> </span>: <?=$teacher->email?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("tattendance_phone")?> </span>: <?=$teacher->phone?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("tattendance_address")?> </span>: <?=$teacher->address?></p>
                    </div>
                    <?php if($usertype == "Admin") { ?>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("tattendance_username")?> </span>: <?=$teacher->username?></p>
                    </div>
                    <?php } ?>
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
            var id = "<?=$teacher->teacherID;?>";
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
                    url: "<?=base_url('tattendance/send_mail')?>",
                    data: 'to='+ to + '&subject=' + subject + "&id=" + id+ "&message=" + message,
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
    if($usertype == "Teacher") {
?>
    <script language="javascript" type="text/javascript">
        var url = window.location.href;
        $("a[href$='"+url+"']").parent().addClass('active');
        $("a[href$='"+url+"']").parent().parent().css('display', 'block');
        $("#tattendance").parent().addClass('active');
    </script>

<?php } ?>
