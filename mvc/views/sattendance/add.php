<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-sattendance"></i> <?=$this->lang->line('panel_title')?></h3>


        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("sattendance/index")?>"><?=$this->lang->line('menu_sattendance')?></a></li>
            <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('menu_sattendance')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-6 col-sm-offset-3 list-group">
                    <div class="list-group-item list-group-item-warning">
                        <form class="form-horizontal" role="form" method="post">
                            <?php
                                if(form_error('classesID'))
                                    echo "<div class='form-group has-error' >";
                                else
                                    echo "<div class='form-group' >";
                            ?>
                                <label for="classesID" class="col-sm-2 col-sm-offset-2 control-label">
                                    <?=$this->lang->line('attendance_classes')?>
                                </label>
                                <div class="col-sm-6">
                                    <?php
                                        $array = array("0" => $this->lang->line("attendance_select_classes"));
                                        foreach ($classes as $classa) {
                                            $array[$classa->classesID] = $classa->classes;
                                        }
                                        echo form_dropdown("classesID", $array, set_value("classesID", $set), "id='classesID' class='form-control'");
                                    ?>
                                </div>
                            </div>

                            <?php
                              $sID = 0;
                              if($setting->attendance=="subject"){
                                if(form_error('subjectID'))
                                    echo "<div class='form-group has-error' >";
                                else
                                    echo "<div class='form-group' >";
                            ?>
                                    <label for="subjectID" class="col-sm-2 col-sm-offset-2 control-label">
                                        <?=$this->lang->line('attendance_subject')?>
                                    </label>
                                    <div class="col-sm-6">
                                        <?php
                                        $array = array('0' => $this->lang->line("attendance_select_subject"));
                                        if($subjects != "empty") {
                                            foreach ($subjects as $subject) {
                                                $array[$subject->subjectID] = $subject->subject;
                                            }
                                        }

                                        if($subjectID != 0) {
                                            $sID = $subjectID;
                                        }

                                        echo form_dropdown("subjectID", $array, set_value("subjectID", $sID), "id='subjectID' class='form-control'");
                                        ?>
                                    </div>
                                    <span class="col-sm-4 control-label">
                                        <?php echo form_error('subjectID'); ?>
                                    </span>
                                </div>
                            <?php
                              }
                            ?>

                            <?php
                                if(form_error('date'))
                                    echo "<div class='form-group has-error' >";
                                else
                                    echo "<div class='form-group' >";
                            ?>
                                <label for="date" class="col-sm-2 col-sm-offset-2 control-label">
                                    <?=$this->lang->line('attendance_date')?>
                                </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="date" id="date" value="<?=set_value("date", $date)?>" >
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <input type="submit" class="btn btn-success" style="margin-bottom:0px" value="<?=$this->lang->line("add_attendance")?>" >
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                    <div id="hide-table">
                        <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                                <tr>
                                    <th class="col-sm-1"><?=$this->lang->line('slno')?></th>
                                    <th class="col-sm-2"><?=$this->lang->line('attendance_photo')?></th>
                                    <th class="col-sm-2"><?=$this->lang->line('attendance_name')?></th>
                                    <th class="col-sm-2"><?=$this->lang->line('attendance_section')?></th>
                                    <th class="col-sm-2"><?=$this->lang->line('attendance_roll')?></th>
                                    <th class="col-sm-2"><?=$this->lang->line('attendance_phone')?></th>
                                    <th class="col-sm-1"><?=btn_attendance('', '', 'all_attendance', $this->lang->line('add_all_attendance')).$this->lang->line('action')?></th>
                                </tr>
                            </thead>
                            <tbody id="list">
                                <?php if(count($students)) {$i = 1; foreach($students as $student) { ?>
                                    <tr>
                                        <td data-title="<?=$this->lang->line('slno')?>">
                                            <?php echo $i; ?>
                                        </td>
                                        <td data-title="<?=$this->lang->line('attendance_photo')?>">
                                            <?php $array = array(
                                                    "src" => base_url('uploads/images/'.$student->photo),
                                                    'width' => '35px',
                                                    'height' => '35px',
                                                    'class' => 'img-rounded'

                                                );
                                                echo img($array);
                                            ?>
                                        </td>
                                        <td data-title="<?=$this->lang->line('attendance_name')?>">
                                            <?php echo $student->name; ?>
                                        </td>
                                        <td data-title="<?=$this->lang->line('attendance_section')?>">
                                            <?php echo $student->ssection; ?>
                                        </td>
                                        <td data-title="<?=$this->lang->line('attendance_roll')?>">
                                            <?php echo $student->roll; ?>
                                        </td>
                                        <td data-title="<?=$this->lang->line('attendance_phone')?>">
                                            <?php echo $student->phone; ?>
                                        </td>
                                        <td data-title="<?=$this->lang->line('action')?>">
                                            <?php
                                                $aday = "a".abs($day);

                                                foreach ($attendances as $attendance) {
                                                    if($setting->attendance=="subject") {
                                                        if($monthyear == $attendance->monthyear && $attendance->studentID == $student->studentID && $attendance->classesID == $student->classesID && $attendance->subjectID == $sID) {
                                                            $method = '';
                                                            if($attendance->$aday == "P") {$method = "checked";}
                                                            echo  btn_attendance($attendance->attendanceID, $method, 'attendance btn btn-warning', $this->lang->line('add_title'));
                                                            break;
                                                        }
                                                    } else {

                                                            if ($monthyear == $attendance->monthyear && $attendance->studentID == $student->studentID && $attendance->classesID == $student->classesID) {
                                                                $method = '';
                                                                if($attendance->$aday == "P") {$method = "checked";}
                                                                echo  btn_attendance($attendance->attendanceID, $method, 'attendance btn btn-warning', $this->lang->line('add_title'));
                                                                break;
                                                            }
                                                    }
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                <?php $i++; }} ?>

                            </tbody>
                        </table>
                    </div>

                    <script type="text/javascript">
                        $('.attendance').click(function() {
                            var id = $(this).attr("id");
                            var day = "<?=$day?>";
                            if(parseInt(id) && parseInt(day)) {
                                $.ajax({
                                    type: 'POST',
                                    url: "<?=base_url('sattendance/singl_add')?>",
                                    data: {"id" : id, "day" : day},
                                    dataType: "html",
                                    success: function(data) {
                                        toastr["success"](data)
                                        toastr.options = {
                                          "closeButton": true,
                                          "debug": false,
                                          "newestOnTop": false,
                                          "progressBar": false,
                                          "positionClass": "toast-top-right",
                                          "preventDuplicates": false,
                                          "onclick": null,
                                          "showDuration": "500",
                                          "hideDuration": "500",
                                          "timeOut": "5000",
                                          "extendedTimeOut": "1000",
                                          "showEasing": "swing",
                                          "hideEasing": "linear",
                                          "showMethod": "fadeIn",
                                          "hideMethod": "fadeOut"
                                        }

                                    }
                                });
                            }
                        });

                        $('.all_attendance').click(function() {
                            var day = "<?=$day?>";
                            var classes = "<?=$set?>"
                            var monthyear = "<?=$monthyear?>"
                            var subjectID = "<?=$sID?>"
                            var status = "";

                            if($(".all_attendance").prop('checked')) {
                                status = "checked";
                                $('.attendance').prop("checked", true);
                            } else {
                                status = "unchecked";
                                $('.attendance').prop("checked", false);
                            }

                            if(parseInt(classes) && parseInt(day)) {
                                $.ajax({
                                    type: 'POST',
                                    url: "<?=base_url('sattendance/all_add')?>",
                                    data: {"day" : day, "classes" : classes, "subject" : subjectID , "monthyear" : monthyear , "status" : status },
                                    dataType: "html",
                                    success: function(data) {
                                        toastr["success"](data)
                                        toastr.options = {
                                          "closeButton": true,
                                          "debug": false,
                                          "newestOnTop": false,
                                          "progressBar": false,
                                          "positionClass": "toast-top-right",
                                          "preventDuplicates": false,
                                          "onclick": null,
                                          "showDuration": "500",
                                          "hideDuration": "500",
                                          "timeOut": "5000",
                                          "extendedTimeOut": "1000",
                                          "showEasing": "swing",
                                          "hideEasing": "linear",
                                          "showMethod": "fadeIn",
                                          "hideMethod": "fadeOut"
                                        }

                                    }
                                });
                            }
                        });
                    </script>


            </div> <!-- col-sm-12 -->
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->
<script type="text/javascript">
    $("#date").datepicker();
    $("#classesID").change(function() {
    var id = $(this).val();
    if(parseInt(id)) {
        if(id === '0') {
            $('#subjectID').val(0);
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('sattendance/subjectall')?>",
                data: {"id" : id},
                dataType: "html",
                success: function(data) {
                   $('#subjectID').html(data);
                }
            });
        }
    }
    });
</script>
