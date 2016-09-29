
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-feetype"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_feetype')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <h5 class="page-header">
                    <a href="<?php echo base_url('feetype/add') ?>">
                        <i class="fa fa-plus"></i> 
                        <?=$this->lang->line('add_title')?>
                    </a>
                </h5>
                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('feetype_name')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('feetype_note')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($feetypes)) {$i = 1; foreach($feetypes as $feetype) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('feetype_name')?>">
                                        <?php echo $feetype->feetype; ?>
                                    </td>
                  
                                    <td data-title="<?=$this->lang->line('feetype_note')?>">
                                        <?php echo $feetype->note; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('action')?>">
                                        <?php echo btn_edit('feetype/edit/'.$feetype->feetypeID, $this->lang->line('edit')) ?>
                                        <?php echo btn_delete('feetype/delete/'.$feetype->feetypeID, $this->lang->line('delete')) ?>
                                    </td>
                                </tr>
                            <?php $i++; }} ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>