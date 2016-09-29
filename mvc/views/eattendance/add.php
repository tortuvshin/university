
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-eattendance"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("eattendance/index")?>"><?=$this->lang->line('menu_eattendance')?></a></li>
            <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('menu_eattendance')?></li>
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
                                    <input type="submit" class="btn btn-success" style="margin-bottom:0px" value="<?=$this->lang->line("add_attendance")?>" >
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <?php if(count($students)) { ?>
                    <div id="hide-table">
                        <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                                <tr>
                                    <th class="col-sm-1"><?=$this->lang->line('slno')?></th>
                                    <th class="col-sm-2"><?=$this->lang->line('eattendance_photo')?></th>
                                    <th class="col-sm-2"><?=$this->lang->line('eattendance_name')?></th>
                                    <th class="col-sm-2"><?=$this->lang->line('eattendance_section')?></th>
                                    <th class="col-sm-2"><?=$this->lang->line('eattendance_roll')?></th>
                                    <th class="col-sm-2"><?=$this->lang->line('eattendance_phone')?></th>
                                    <th class="col-sm-1"><?=btn_attendance('', '', 'all_attendance', $this->lang->line('add_all_attendance')).$this->lang->line('action')?></th>
                                </tr>
                            </thead>
                            <tbody id="list">
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
                                        <td data-title="<?=$this->lang->line('eattendance_section')?>">
                                            <?php echo $student->ssection; ?>
                                        </td>
                                        <td data-title="<?=$this->lang->line('eattendance_roll')?>">
                                            <?php echo $student->roll; ?>
                                        </td>
                                        <td data-title="<?=$this->lang->line('eattendance_phone')?>">
                                            <?php echo $student->phone; ?>
                                        </td>
                                        <td data-title="<?=$this->lang->line('action')?>">
                                            <?php 
                                                // $aday = "a".abs($day);

                                                foreach ($eattendances as $eattendance) {
                                                    if($eattendance->studentID == $student->studentID && $examID == $eattendance->examID && $classesID == $eattendance->classesID && $subjectID == $eattendance->subjectID) {
                                                        $method = '';
                                                        if($eattendance->eattendance == "Present") {$method = "checked";}
                                                        echo  btn_attendance($student->studentID, $method, 'attendance btn btn-warning', $this->lang->line('add_title'));
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

                    <script type="text/javascript">

                        $('.attendance').click(function() {

                            var examID = "<?=$examID?>";
                            var classesID = "<?=$classesID?>";
                            var subjectID = "<?=$subjectID?>";
                            var studentID = $(this).attr('id');
                            var status = "";

                            if($(this).prop('checked')) {
                                status = "checked";
                            } else {
                                status = "unchecked";
                            }

                            if(parseInt(examID) && parseInt(classesID) && parseInt(subjectID)) {
                                $.ajax({
                                    type: 'POST',
                                    url: "<?=base_url('eattendance/single_add')?>",
                                    data: {"examID" : examID, "classesID" : classesID, "subjectID" : subjectID, "studentID" : studentID , "status" : status },
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
                            var examID = "<?=$examID?>";
                            var classesID = "<?=$classesID?>";
                            var subjectID = "<?=$subjectID?>";
                            var status = "";

                            if($(".all_attendance").prop('checked')) {
                                status = "checked";
                                $('.attendance').prop("checked", true);
                            } else {
                                status = "unchecked";
                                $('.attendance').prop("checked", false);
                            }

                            if(parseInt(examID) && parseInt(classesID) && parseInt(subjectID)) {
                                $.ajax({
                                    type: 'POST',
                                    url: "<?=base_url('eattendance/all_add')?>",
                                    data: {"examID" : examID, "classesID" : classesID, "subjectID" : subjectID , "status" : status },
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