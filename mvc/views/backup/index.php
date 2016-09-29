
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-clipboard"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><a href="<?=base_url("backup/index")?>"><?=$this->lang->line('menu_backup')?></a></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <form action="<?=base_url('backup/index');?>" class="form-horizontal" role="form" method="post">  
                    <label for="photo" class="col-sm-2 control-label col-xs-8 col-md-2">
                        <?=$this->lang->line("backup_title")?>
                    </label>
                    <div class="form-group">
                        <div class="col-md-1 rep-mar">
                            <input type="hidden" value="0" name="hidden">
                            <!-- <input type="submit" class="btn btn-info" value="Download Backup"> -->
                            <button type="submit" class="btn btn-primary">
                              <i class="fa fa-download"></i> <?=$this->lang->line("backup_submit")?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>            
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->