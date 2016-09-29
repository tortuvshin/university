


<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-lock"></i> <?=$this->lang->line('change_password')?></h3>

        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('change_password')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">

                <form class="form-horizontal" role="form" method="post">

                        <?php 
                            if(form_error('old_password')) 
                                echo "<div class='form-group has-error' >";
                            else     
                                echo "<div class='form-group' >";
                        ?>
                            <label for="old_password" class="col-sm-2 control-label">
                                <?=$this->lang->line("old_password")?>
                            </label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="old_password" name="old_password" >
                            </div>
                            <span class="col-sm-4 control-label">
                                <?php echo form_error('old_password'); ?>
                            </span>
                        </div>

                        <?php 
                            if(form_error('new_password')) 
                                echo "<div class='form-group has-error' >";
                            else     
                                echo "<div class='form-group' >";
                        ?>
                            <label for="new_password" class="col-sm-2 control-label">
                                <?=$this->lang->line("new_password")?>
                            </label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="new_password" name="new_password">
                            </div>
                            <span class="col-sm-4 control-label">
                                <?php echo form_error('new_password'); ?>
                            </span>
                        </div>

                        <?php 
                            if(form_error('re_password')) 
                                echo "<div class='form-group has-error' >";
                            else     
                                echo "<div class='form-group' >";
                        ?>
                            <label for="re_password" class="col-sm-2 control-label">
                                <?=$this->lang->line("re_password")?>
                            </label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="re_password" name="re_password">
                            </div>
                            <span class="col-sm-4 control-label">
                                <?php echo form_error('re_password'); ?>
                            </span>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
                                <input type="submit" class="btn btn-success" value="<?=$this->lang->line("change_password")?>" >
                            </div>
                        </div>

                    </form>
            </div> <!-- col-sm-8 -->
            
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->
