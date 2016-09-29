
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-calendar"></i> <?=$this->lang->line('panel_title')?></h3>


        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("leave/index")?>"><?=$this->lang->line('menu_leave')?></a></li>
            <li class="active"><?=$this->lang->line('menu_edit')?> <?=$this->lang->line('menu_leave')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <form class="form-horizontal" role="form" method="post">
                  <?php
                      if(form_error('to'))
                          echo "<div class='form-group has-error' >";
                      else
                          echo "<div class='form-group' >";
                  ?>
                      <label for="to" class="col-sm-2 control-label">
                          <?=$this->lang->line('to')?>
                      </label>
                      <div class="col-sm-6">
                          <?php
                              if($usertype == "Student" || $usertype == "Parent") {
                                $array = array("0" => $this->lang->line("leave_select_teacher"));
                              } else {
                                $array = array("0" => $this->lang->line("leave_select_admin"));
                              }
                              foreach ($users as $user) {
                                  $array[$user->username] = $user->name;
                              }
                              echo form_dropdown("to", $array, set_value("to",$leave->tousername), "id='to' class='form-control'");
                          ?>
                      </div>
                  </div>

                  <?php
                      if(form_error('fdate'))
                          echo "<div class='form-group has-error' >";
                      else
                          echo "<div class='form-group' >";
                  ?>
                      <label for="date" class="col-sm-2 control-label">
                          <?=$this->lang->line("leave_fdate")?>
                      </label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control" id="fdate" name="fdate" value="<?=set_value('fdate', date("d-m-Y", strtotime($leave->fdate)))?>" >
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
                      <label for="date" class="col-sm-2 control-label">
                          <?=$this->lang->line("leave_tdate")?>
                      </label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control" id="tdate" name="tdate" value="<?=set_value('tdate', date("d-m-Y", strtotime($leave->tdate)))?>" >
                      </div>
                      <span class="col-sm-4 control-label">
                          <?php echo form_error('tdate'); ?>
                      </span>
                  </div>

                  <?php
                      if(form_error('title'))
                          echo "<div class='form-group has-error' >";
                      else
                          echo "<div class='form-group' >";
                  ?>
                      <label for="title" class="col-sm-2 control-label">
                          <?=$this->lang->line("leave_title")?>
                      </label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" id="title" name="title" value="<?=set_value('title',$leave->title)?>" >
                      </div>
                      <span class="col-sm-4 control-label">
                          <?php echo form_error('title'); ?>
                      </span>
                  </div>

                  <?php
                      if(form_error('details'))
                          echo "<div class='form-group has-error' >";
                      else
                          echo "<div class='form-group' >";
                  ?>
                      <label for="leave" class="col-sm-2 control-label">
                          <?=$this->lang->line("leave_details")?>
                      </label>
                      <div class="col-sm-8">
                          <textarea class="form-control" id="leave" name="details" ><?=set_value('details',$leave->details)?></textarea>
                      </div>
                      <span class="col-sm-3 control-label">
                          <?php echo form_error('details'); ?>
                      </span>
                  </div>

                  <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-8">
                          <input type="submit" class="btn btn-success" value="<?=$this->lang->line("leave_update")?>" >
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
$('#leave').jqte();
</script>
