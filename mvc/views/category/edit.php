
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-leaf"></i> <?=$this->lang->line('panel_title')?></h3>

        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("category/index")?>"><?=$this->lang->line('menu_category')?></a></li>
            <li class="active"><?=$this->lang->line('menu_edit')?> <?=$this->lang->line('menu_category')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">
                <form class="form-horizontal" role="form" method="post">

                    <?php 
                        if(form_error('hname')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="hname" class="col-sm-2 control-label">
                            <?=$this->lang->line("category_hname")?>
                        </label>
                        <div class="col-sm-6">
                            <?php
                                $array = array();
                                $array[0] = $this->lang->line("category_select_hostel");
                                foreach ($hostels as $hostel) {
                                    $array[$hostel->hostelID] = $hostel->name;
                                }
                                echo form_dropdown("hname", $array, set_value("hname", $category->hostelID), "id='hname' class='form-control'");
                            ?>
                        
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('hname'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('class_type')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="class_type" class="col-sm-2 control-label">
                            <?=$this->lang->line("category_class_type")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="class_type" name="class_type" value="<?=set_value('class_type', $category->class_type)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('class_type'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('hbalance')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="hbalance" class="col-sm-2 control-label">
                            <?=$this->lang->line("category_hbalance")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="hbalance" name="hbalance" value="<?=set_value('hbalance', $category->hbalance)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('hbalance'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('note')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="note" class="col-sm-2 control-label">
                            <?=$this->lang->line("category_note")?>
                        </label>
                        <div class="col-sm-6">
                            <textarea class="form-control" style="resize:none;" id="note" name="note"><?=set_value('note', $category->note)?></textarea>
                        </div>
                         <span class="col-sm-4 control-label">
                            <?php echo form_error('note'); ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("update_category")?>" >
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>