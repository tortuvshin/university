

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-member"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("lmember/index/$set")?>"><?=$this->lang->line('menu_member')?></a></li>
            <li class="active"><?=$this->lang->line('menu_edit')?> <?=$this->lang->line('menu_member')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">

                <form class="form-horizontal" role="form" method="post">

                    <?php 
                        if(form_error('lID')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="lID" class="col-sm-2 control-label">
                            <?=$this->lang->line("lmember_lID")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="lID" name="lID" value="<?=set_value('lID', $lmember->lID)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('lID'); ?>
                        </span>
                    </div>


                    <?php 
                        if(form_error('lbalance')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="lbalance" class="col-sm-2 control-label">
                            <?=$this->lang->line("lmember_lfee")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="lbalance" name="lbalance" value="<?=set_value('lbalance', $lmember->lbalance)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('lbalance'); ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("update_lmember")?>" >
                        </div>
                    </div>
                </form>

            </div> <!-- col-sm-12 -->
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->
