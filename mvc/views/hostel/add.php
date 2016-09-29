
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-person193"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("hostel/index")?>"><?=$this->lang->line('menu_hostel')?></a></li>
            <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('menu_hostel')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">
                <form class="form-horizontal" role="form" method="post">
                    <?php 
                        if(form_error('name')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="name" class="col-sm-2 control-label">
                            <?=$this->lang->line("hostel_name")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="name" name="name" value="<?=set_value('name')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('name'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('htype')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="htype" class="col-sm-2 control-label">
                            <?=$this->lang->line("hostel_htype")?>
                        </label>
                        <div class="col-sm-6">
                            <?php
                                $array = array(
                                    0 => $this->lang->line('select_hostel_type'),
                                    $this->lang->line('hostel_boys') => $this->lang->line('hostel_boys'),
                                    $this->lang->line('hostel_girls') => $this->lang->line('hostel_girls'),
                                    $this->lang->line('hostel_combine') => $this->lang->line('hostel_combine')
                                );
                                echo form_dropdown("htype", $array, set_value("htype"), "id='htype' class='form-control'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('htype'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('address')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="address" class="col-sm-2 control-label">
                            <?=$this->lang->line("hostel_address")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="address" name="address" value="<?=set_value('address')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('address'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('note')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="note" class="col-sm-2 control-label">
                            <?=$this->lang->line("hostel_note")?>
                        </label>
                        <div class="col-sm-6">
                            <textarea class="form-control" style="resize:none;" id="note" name="note"><?=set_value('note')?></textarea>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('note'); ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("add_hostel")?>" >
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>