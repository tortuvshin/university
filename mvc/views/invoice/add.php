
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-invoice"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("invoice/index")?>"><?=$this->lang->line('menu_invoice')?></a></li>
            <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('menu_invoice')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">
                <form class="form-horizontal" role="form" method="post">

                    <?php 
                        if(form_error('classesID')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="classesID" class="col-sm-2 control-label">
                            <?=$this->lang->line("invoice_classesID")?>
                        </label>
                        <div class="col-sm-6">

                            <?php
                                $array = array('0' => $this->lang->line("invoice_select_classes"));
                                foreach ($classes as $classa) {
                                    $array[$classa->classesID] = $classa->classes;
                                }
                                echo form_dropdown("classesID", $array, set_value("classesID"), "id='classesID' class='form-control'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('classesID'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('studentID')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="studentID" class="col-sm-2 control-label">
                            <?=$this->lang->line("invoice_studentID")?>
                        </label>
                        <div class="col-sm-6">

                            <?php

                                $array = $array = array('0' => $this->lang->line("invoice_select_student"));
                                if($students != "empty") {
                                    foreach ($students as $student) {
                                        $array[$student->studentID] = $student->name;
                                    }
                                }

                                $stID = 0;
                                if($studentID == 0) {
                                    $stID = 0;
                                } else {
                                    $stID = $studentID;
                                }

                                echo form_dropdown("studentID", $array, set_value("studentID", $stID), "id='studentID' class='form-control'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('studentID'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('feetype'))
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="feetype" class="col-sm-2 control-label">
                            <?=$this->lang->line("invoice_feetype")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="feetype" name="feetype" value="<?=set_value('feetype')?>" >
                            <div class="book"><ul  class="result"></ul></div>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('feetype'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('amount')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="amount" class="col-sm-2 control-label">
                            <?=$this->lang->line("invoice_amount")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="amount" name="amount" value="<?=set_value('amount')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('amount'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('date')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="date" class="col-sm-2 control-label">
                            <?=$this->lang->line("invoice_date")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="date" name="date" value="<?=set_value('date')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('date'); ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("add_invoice")?>" >
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$('#classesID').change(function(event) {
    var classesID = $(this).val();
    if(classesID === '0') {
        $('#studentID').val(0);
    } else {
        $.ajax({
            type: 'POST',
            url: "<?=base_url('invoice/call_all_student')?>",
            data: "id=" + classesID,
            dataType: "html",
            success: function(data) {
               $('#studentID').html(data);
            }
        });
    }
});


$('#feetype').keyup(function() {
    var feetype = $(this).val();
    $.ajax({
        type: 'POST',
        url: "<?=base_url('invoice/feetypecall')?>",
        data: "feetype=" + feetype,
        dataType: "html",
        success: function(data) {
            if(data != "") {
                var width = $("#feetype").width();
                $(".book").css('width', width+25 + "px").show();
                $(".result").html(data);

                $('.result li').click(function(){
                    var result_value = $(this).text();
                    $('#feetype').val(result_value);
                    $('.result').html(' ');
                    $('.book').hide();
                });
            } else {
                $(".book").hide();
            }
           
        }
    });
});

$('#date').datepicker();
</script>