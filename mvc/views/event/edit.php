
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-calendar"></i> <?=$this->lang->line('panel_title')?></h3>


        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("event/index")?>"><?=$this->lang->line('menu_event')?></a></li>
            <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('menu_event')?></li>
        </ol>
    </div><!-- /.box-header -->
    <?php
      $date = date("m/d/Y", strtotime($event->fdate))." ".date("h:i A", strtotime($event->ftime))." - ".date("m/d/Y", strtotime($event->tdate))." ".date("h:i A", strtotime($event->ttime));
    ?>
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
                            <?=$this->lang->line("event_title")?>
                        </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="title" name="title" value="<?=set_value('title',$event->title)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('title'); ?>
                        </span>
                    </div>

                    <?php
                        if(form_error('date'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="date" class="col-sm-2 control-label">
                            <?=$this->lang->line("event_date")?>
                        </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="date" name="date" value="<?=set_value('date',$date)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('fdate'); ?>
                        </span>
                    </div>

                    <?php
                        if(isset($image))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="photo" class="col-sm-2 control-label col-xs-8 col-md-2">
                            <?=$this->lang->line("event_photo")?>
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
                        if(form_error('event_details'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="event_details" class="col-sm-2 control-label">
                            <?=$this->lang->line("event_details")?>
                        </label>
                        <div class="col-sm-7">
                            <textarea class="form-control" id="event_details" name="event_details" ><?=set_value('event_details',$event->details)?></textarea>
                        </div>
                        <span class="col-sm-3 control-label">
                            <?php echo form_error('event_details'); ?>
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
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript">
// $('#fdate').datepicker();
// $('#tdate').datepicker();
document.getElementById("uploadBtn").onchange = function() {
document.getElementById("uploadFile").value = this.value;
};
$('#event_details').jqte();

$('#date').daterangepicker({
  timePicker: true,
  timePickerIncrement: 5,
  locale: {
      format: 'MM/DD/YYYY h:mm A'
  }
});
</script>
