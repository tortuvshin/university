
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-clipboard"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_report')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <form style="" action="<?=base_url('report/teacher_report');?>" class="form-horizontal" role="form" method="post">  
                    <div class="<?php if(form_error('teacherID')) {echo 'form-group has-error';} else {echo 'form-group';} ?>" >
                        <label for="teacherID" class="col-sm-2 control-label">
                            <?=$this->lang->line("report_teacher")?>
                        </label>

                        <div class="col-sm-2 rep-mar">
                           <?php
                                $array = array("0" => $this->lang->line("report_select_teacher"));
                                foreach ($teachers as $teacher) {
                                    $array[$teacher->teacherID] = $teacher->name;
                                }
                                echo form_dropdown("teacherID", $array, set_value("teacherID"), "id='teacherID' class='form-control'");
                            ?>
                        </div>
                        
                        <div class="col-sm-1 rep-mar">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("report_submit")?>" >
                        </div>
                    </div>
                </form>

                <form style="" action="<?=base_url('report/index');?>" class="form-horizontal" role="form" method="post">  
                    <div class="form-group">
                        <label for="classesID" class="col-sm-2 control-label">
                            <?=$this->lang->line("report_student")?>
                        </label>
                        <div class="<?php if(form_error('classesID')) {echo 'col-sm-2 rep-mar has-error';} else {echo 'col-sm-2 rep-mar';} ?>" >
                           <?php
                                $array = array("0" => $this->lang->line("report_select_class"));
                                foreach ($classes as $classa) {
                                    $array[$classa->classesID] = $classa->classes;
                                }
                                echo form_dropdown("classesID", $array, set_value("classesID"), "id='classesID' class='form-control'");
                            ?>
                        </div>
                        
                        <div class="col-sm-2 rep-mar">
                            <select id="sectionID" name="sectionID" class="form-control">
                                <option value="0"><?php echo $this->lang->line("report_select_section"); ?></option>
                            </select>
                        </div>

                        <div class="col-sm-1 rep-mar">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("report_submit")?>" >
                        </div>
                    </div>
                </form>

                <form style="" action="<?=base_url('report/routine');?>" class="form-horizontal" role="form" method="post">  
                    <div class="form-group" >
                        <label for="classesID_routine" class="col-sm-2 control-label">
                            <?=$this->lang->line("report_routine")?>
                        </label>
                        <div class="<?php if(form_error('classesID_routine')) {echo 'col-sm-2 rep-mar has-error';} else {echo 'col-sm-2 rep-mar';} ?>" >
                           <?php
                                $array = array("0" => $this->lang->line("report_select_class"));
                                foreach ($classes as $classa) {
                                    $array[$classa->classesID] = $classa->classes;
                                }
                                echo form_dropdown("classesID_routine", $array, set_value("classesID_routine"), "id='classesID_routine' class='form-control'");
                            ?>
                        </div>

                        <div class="<?php if(form_error('sectionID_routine')) {echo 'col-sm-2 rep-mar has-error';} else {echo 'col-sm-2 rep-mar';} ?>">
                            <select id="sectionID_routine" name="sectionID_routine" class="form-control">
                                <option value="0"><?php echo $this->lang->line("report_select_section"); ?></option>
                            </select>
                        </div>

                        <div class="col-sm-1 rep-mar">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("report_submit")?>" >
                        </div>
                    </div>
                </form>

                <form style="" action="<?=base_url('report/balance_report');?>" class="form-horizontal" role="form" method="post">  
                    <div class="form-group" >
                        <label for="classesID_balance" class="col-sm-2 control-label">
                            <?=$this->lang->line("report_balance")?>
                        </label>
                        <div class="<?php if(form_error('classesID_balance')) {echo 'col-sm-2 rep-mar has-error';} else {echo 'col-sm-2 rep-mar';} ?>" >
                           <?php
                                $array = array("0" => $this->lang->line("report_select_class"));
                                foreach ($classes as $classa) {
                                    $array[$classa->classesID] = $classa->classes;
                                }
                                echo form_dropdown("classesID_balance", $array, set_value("classesID_balance"), "id='classesID_balance' class='form-control'");
                            ?>
                        </div>

                        <div class="<?php if(form_error('sectionID_balance')) {echo 'col-sm-2 rep-mar has-error';} else {echo 'col-sm-2 rep-mar';} ?>">
                            <select id="sectionID_balance" name="sectionID_balance" class="form-control">
                                <option value="0"><?php echo $this->lang->line("report_select_section"); ?></option>
                            </select>
                        </div>

                        <div class="col-sm-1 rep-mar">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("report_submit")?>" >
                        </div>
                    </div>
                </form>

                <form style="" action="<?=base_url('report/mark_report');?>" class="form-horizontal" role="form" method="post">  
                    <div class="form-group" >
                        <label for="examID" class="col-sm-2 control-label">
                            <?=$this->lang->line("report_mark")?>
                        </label>
                        <div class="<?php if(form_error('examID')) {echo 'col-sm-2 rep-mar has-error';} else {echo 'col-sm-2 rep-mar';} ?>">
                            <?php
                                $array = array("" => $this->lang->line("mark_select_exam"));
                                foreach ($exams as $exam) {
                                    $array[$exam->examID] = $exam->exam;
                                }
                                echo form_dropdown("examID", $array, set_value("examID", $set_exam), "id='examID' class='form-control'");
                            ?>
                        </div>
                        <div class="<?php if(form_error('classesID_mark')) {echo 'col-sm-2 rep-mar has-error';} else {echo 'col-sm-2 rep-mar';} ?>">
                           <?php
                                $array = array("" => $this->lang->line("report_select_class"));
                                foreach ($classes as $classa) {
                                    $array[$classa->classesID] = $classa->classes;
                                }
                                echo form_dropdown("classesID_mark", $array, set_value("classesID_mark"), "id='classesID_mark' class='form-control'");
                            ?>
                        </div>
                        <div class="col-sm-2 rep-mar">
                           <select id="subjectID" name="subjectID" class="form-control">
                                <option value="0"><?php echo $this->lang->line("mark_select_subject"); ?></option>
                            </select>                       
                        </div>
                        <div class="col-sm-1 rep-mar">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("report_submit")?>" >
                        </div>
                    </div>
                </form>
            </div>            
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->

<script type="text/javascript">

var classesID = $("#classesID").val();

$('#classesID').change(function(event) {
    var classesID = $(this).val();
    $.ajax({
        type: 'POST',
        url: "<?=base_url('report/call_section')?>",
        data: "classesID=" + classesID,
        dataType: "html",
        success: function(data) {
           $('#sectionID').html(data);
        }
    });
});

$('#classesID_routine').change(function(event) {
    var classesID = $(this).val();
    $.ajax({
        type: 'POST',
        url: "<?=base_url('report/call_section')?>",
        data: "classesID=" + classesID,
        dataType: "html",
        success: function(data) {
           $('#sectionID_routine').html(data);
        }
    });
});

$('#classesID_balance').change(function(event) {
    var classesID = $(this).val();
    $.ajax({
        type: 'POST',
        url: "<?=base_url('report/call_section')?>",
        data: "classesID=" + classesID,
        dataType: "html",
        success: function(data) {
           $('#sectionID_balance').html(data);
        }
    });
});


var classesID = $('#classesID_routine').val();
if(classesID != 0) {
    $.ajax({
        type: 'POST',
        url: "<?=base_url('report/call_section')?>",
        data: "classesID=" + classesID,
        dataType: "html",
        success: function(data) {
           $('#sectionID_routine').html(data);
        }
    });
}

var for_student_classesID = $('#classesID').val();
if(for_student_classesID != 0) {
    $.ajax({
        type: 'POST',
        url: "<?=base_url('report/call_section')?>",
        data: "classesID=" + for_student_classesID,
        dataType: "html",
        success: function(data) {
           $('#sectionID').html(data);
        }
    });
}

var for_mark_classesID = $('#classesID_mark').val();
if(for_mark_classesID != 0) {
    $.ajax({
        type: 'POST',
        url: "<?=base_url('report/subjectcall')?>",
        data: "id=" + for_mark_classesID,
        dataType: "html",
        success: function(data) {
           $('#subjectID').html(data);
        }
    });
}

var for_balance_classesID = $('#classesID_balance').val();
if(for_balance_classesID !=0) {
    $.ajax({
        type: 'POST',
        url: "<?=base_url('report/call_section')?>",
        data: "classesID=" + for_balance_classesID,
        dataType: "html",
        success: function(data) {
           $('#sectionID_balance').html(data);
        }
    });
}


$("#classesID_mark").change(function() {
var id = $(this).val();
if(parseInt(id)) {
    if(id === '0') {
        $('#subjectID').val(0);
    } else {
        $.ajax({
            type: 'POST',
            url: "<?=base_url('report/subjectcall')?>",
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