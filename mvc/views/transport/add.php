
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-sbus"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("transport/index")?>"><?=$this->lang->line('menu_transport')?></a></li>
            <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('menu_transport')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">
                <form class="form-horizontal" role="form" method="post">

                    <?php 
                        if(form_error('route')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="route" class="col-sm-2 control-label">
                            <?=$this->lang->line("transport_route")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="route" name="route" value="<?=set_value('route')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('route'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('vehicle')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="vehicle" class="col-sm-2 control-label">
                            <?=$this->lang->line("transport_vehicle")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="vehicle" name="vehicle" value="<?=set_value('vehicle')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('vehicle'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('fare')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="fare" class="col-sm-2 control-label">
                            <?=$this->lang->line("transport_fare")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="fare" name="fare" value="<?=set_value('fare')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('fare'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('note')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="note" class="col-sm-2 control-label">
                            <?=$this->lang->line("transport_note")?>
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
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("add_transport")?>" >
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>