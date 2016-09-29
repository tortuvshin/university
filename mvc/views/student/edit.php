
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-student"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("student/index/$set")?>"><?=$this->lang->line('menu_student')?></a></li>
            <li class="active"><?=$this->lang->line('menu_edit')?> <?=$this->lang->line('panel_title')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">

                <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                   
                    <?php 
                        if(form_error('name')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="name_id" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_name")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="name_id" name="name" value="<?=set_value('name', $student->name)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('name'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('guargianID')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="guargianID" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_guargian")?>
                        </label>
                        <div class="col-sm-6">
                            <div class="select2-wrapper">
                                <?php
                                    $array = array('' => '');
                                    foreach ($parents as $parent) {
                                        $array[$parent->parentID] = $parent->name." (" . $parent->email ." )";
                                    }
                                    echo form_dropdown("guargianID", $array, set_value("guargianID", $student->parentID), "id='guargianID' class='form-control guargianID'");
                                ?>
                            </div>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('guargianID'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('dob')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="dob" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_dob")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="dob" name="dob" value="<?=set_value('dob', date("d-m-Y", strtotime($student->dob)))?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('dob'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('sex')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="sex" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_sex")?>
                        </label>
                        <div class="col-sm-6">
                            <?php 
                                echo form_dropdown("sex", array($this->lang->line('student_sex_male') => $this->lang->line('student_sex_male'), $this->lang->line('student_sex_female') => $this->lang->line('student_sex_female')), set_value("sex", $student->sex), "id='sex' class='form-control'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('sex'); ?>
                        </span>

                    </div>

                   
                    <?php 
                        if(form_error('religion')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="religion" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_religion")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="religion" name="religion" value="<?=set_value('religion', $student->religion)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('religion'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('email')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="email" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_email")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="email" name="email" value="<?=set_value('email', $student->email)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('email'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('phone')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="phone" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_phone")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="phone" name="phone" value="<?=set_value('phone', $student->phone)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('phone'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('address')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="address" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_address")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="address" name="address" value="<?=set_value('address', $student->address)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('address'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('classesID')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="classesID" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_classes")?>
                        </label>
                        <div class="col-sm-6">
                           <?php
                                $array = array(0 => $this->lang->line("student_select_class"));
                                foreach ($classes as $classa) {
                                    $array[$classa->classesID] = $classa->classes;
                                }
                                echo form_dropdown("classesID", $array, set_value("classesID", $student->classesID), "id='classesID' class='form-control'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('classesID'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('sectionID')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="sectionID" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_section")?>
                        </label>
                        <div class="col-sm-6">
                           <?php
                                $array = array(0 => $this->lang->line("student_select_section"));
                                foreach ($sections as $section) {
                                    $array[$section->sectionID] = $section->section;
                                }
                                echo form_dropdown("sectionID", $array, set_value("sectionID", $student->sectionID), "id='sectionID' class='form-control'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('sectionID'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('roll')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="roll" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_roll")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="roll" name="roll" value="<?=set_value('roll', $student->roll)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('roll'); ?>
                        </span>
                    </div>

                    <?php 
                        if(isset($image)) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="photo" class="col-sm-2 control-label col-xs-8 col-md-2">
                            <?=$this->lang->line("student_photo")?>
                        </label>
                        <div class="col-sm-4 col-xs-6 col-md-4">
                            <input class="form-control"  id="uploadFile" placeholder="Choose File" disabled />  
                        </div>

                        <div class="col-sm-2 col-xs-6 col-md-2">
                            <div class="fileUpload btn btn-success form-control">
                                <span class="fa fa-repeat"></span>
                                <span><?=$this->lang->line("upload")?></span>
                                <input id="uploadBtn" type="file" class="upload" name="image" />
                            </div>
                        </div>
                         <span class="col-sm-4 control-label col-xs-6 col-md-4">
                           
                            <?php if(isset($image)) echo $image; ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("update_student")?>" >
                        </div>
                    </div>

                </form>

            </div> <!-- col-sm-8 -->
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->

<script type="text/javascript">
document.getElementById("uploadBtn").onchange = function() {
    document.getElementById("uploadFile").value = this.value;
};
$('#dob').datepicker({ startView: 2 });

$('#classesID').change(function(event) {
    var classesID = $(this).val();
    if(classesID === '0') {
        $('#classesID').val(0);
    } else {
        $.ajax({
            type: 'POST',
            url: "<?=base_url('student/sectioncall')?>",
            data: "id=" + classesID,
            dataType: "html",
            success: function(data) {
               $('#sectionID').html(data);
            }
        });
    }
});


</script>
