
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-holiday"></i> <?=$this->lang->line('panel_title')?></h3>


        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("holiday/index")?>"><?=$this->lang->line('menu_holiday')?></a></li>
            <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('menu_holiday')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                    <?php
                        if(form_error('title'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="title" class="col-sm-2 control-label">
                            <?=$this->lang->line("holiday_title")?>
                        </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="title" name="title" value="<?=set_value('title',$holiday->title)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('title'); ?>
                        </span>
                    </div>

                    <?php
                        if(form_error('fdate'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="fdate" class="col-sm-2 control-label">
                            <?=$this->lang->line("holiday_fdate")?>
                        </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="fdate" name="fdate" value="<?=set_value('fdate',date("d-m-Y", strtotime($holiday->fdate)))?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('fdate'); ?>
                        </span>
                    </div>

                    <?php
                        if(form_error('tdate'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="tdate" class="col-sm-2 control-label">
                            <?=$this->lang->line("holiday_tdate")?>
                        </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="tdate" name="tdate" value="<?=set_value('tdate',date("d-m-Y", strtotime($holiday->tdate)))?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('tdate'); ?>
                        </span>
                    </div>

                    <?php
                        if(isset($image))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="photo" class="col-sm-2 control-label col-xs-8 col-md-2">
                            <?=$this->lang->line("holiday_photo")?>
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

                    <?php
                        if(form_error('holiday_details'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="holiday_details" class="col-sm-2 control-label">
                            <?=$this->lang->line("holiday_details")?>
                        </label>
                        <div class="col-sm-7">
                            <textarea class="form-control" id="holiday_details" name="holiday_details" ><?=set_value('holiday_details',$holiday->details)?></textarea>
                        </div>
                        <span class="col-sm-3 control-label">
                            <?php echo form_error('holiday_details'); ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("update_class")?>" >
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/editor/jquery-te-1.4.0.min.js'); ?>"></script>
<script type="text/javascript">
$('#fdate').datepicker();
$('#tdate').datepicker();
document.getElementById("uploadBtn").onchange = function() {
document.getElementById("uploadFile").value = this.value;
};
$('#holiday_details').jqte();
</script>
