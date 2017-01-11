
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-flask"></i> <?=$this->lang->line('panel_title')?></h3>
       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("mark/index")?>"><?=$this->lang->line('menu_mark')?></a></li>
            <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('menu_mark')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-6 col-sm-offset-3 list-group">
                    <div class="list-group-item list-group-item-warning">
                        <form class="form-horizontal" method="post" >
                            <?php 
                                if(form_error('examID')) 
                                    echo "<div class='form-group has-error' >";
                                else     
                                    echo "<div class='form-group' >";
                            ?>
                                <label for="examID" class="col-sm-2 col-sm-offset-2 control-label">
                                    <?=$this->lang->line('mark_exam')?>
                                </label>
                                <div class="col-sm-6">
                                    <?php
                                        $array = array("0" => $this->lang->line("mark_select_exam"));
                                        foreach ($exams as $exam) {
                                            $array[$exam->examID] = $exam->exam;
                                        }
                                        echo form_dropdown("examID", $array, set_value("examID", $set_exam), "id='examID' class='form-control'");
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
                                    <?=$this->lang->line('mark_classes')?>
                                </label>
                                <div class="col-sm-6">
                                    <?php
                                        $array = array("0" => $this->lang->line("mark_select_classes"));
                                        foreach ($classes as $classa) {
                                            $array[$classa->classesID] = $classa->classes;
                                        }
                                        echo form_dropdown("classesID", $array, set_value("classesID", $set_classes), "id='classesID' class='form-control'");
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
                                    <?=$this->lang->line('mark_subject')?>
                                </label>
                                <div class="col-sm-6">
                                    <?php
                                        $array = array("0" => $this->lang->line("mark_select_subject"));
                                        if($subjects != 0) {
                                            foreach ($subjects as $subject) {
                                                $array[$subject->subjectID] = $subject->subject;
                                            }
                                        }
                                        echo form_dropdown("subjectID", $array, set_value("subjectID", $set_subject), "id='subjectID' class='form-control'");
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <input type="submit" class="btn btn-success" style="margin-bottom:0px" value="<?=$this->lang->line("add_mark")?>" >
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
                                <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('mark_photo')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('mark_name')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('mark_roll')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('mark_phone')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('action')?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($students)) {$i = 1; foreach($students as $student) { foreach ($marks as $mark) { if($student->studentID == $mark->studentID) {   ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('mark_photo')?>">
                                        <?php $array = array(
                                                "src" => base_url('uploads/images/'.$student->photo),
                                                'width' => '35px',
                                                'height' => '35px',
                                                'class' => 'img-rounded'

                                            );
                                            echo img($array); 
                                        ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('mark_name')?>">
                                        <?php echo $student->name; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('mark_roll')?>">
                                        <?php echo $student->roll; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('mark_phone')?>">
                                        <?php echo $student->phone; ?>
                                    </td>
                                    <td data-title='Action'>
                                        <input class="form-control mark" type="number" name="<?=$student->studentID?>" id="<?=$student->studentID?>" value="<?=set_value($student->studentID, $mark->mark)?>" />
                                    </td>
                                </tr>
                            <?php $i++;  }}}} ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-sm-2 col-sm-offset-5">
                    <input type="button" class="btn btn-success" id="add_mark" name="add_mark" value="<?=$this->lang->line("add_sub_mark")?>" />
                </div>

                <script type="text/javascript">
                    $("#add_mark").click(function() {
                        var inputs = "";
                        var inputs_value = "";
                        $('.mark').each(function(index, value) {
                            inputs_value = $(this).val(); 
                            if(inputs_value == '' || inputs_value == null) {
                                inputs += $(this).attr("id") +":"+'0'+"$";
                            } else {
                                inputs += $(this).attr("id") +":"+inputs_value+"$";
                            }

                        });

                        $.ajax({
                            type: 'POST',
                            url: "<?=base_url('mark/mark_send')?>",
                            data: {"examID" : "<?=$set_exam?>", "classesID" : "<?=$set_classes?>", "subjectID" : "<?=$set_subject?>", "inputs" : inputs},
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
                    });
                </script>
                <?php } ?>

            </div>
        </div>
    </div>
</div>

 <script type="text/javascript">

$("#classesID").change(function() {
var id = $(this).val();
if(parseInt(id)) {
    if(id === '0') {
        $('#subjectID').val(0);
    } else {
        $.ajax({
            type: 'POST',
            url: "<?=base_url('mark/subjectcall')?>",
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