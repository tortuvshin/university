
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-holiday"></i> <?=$this->lang->line('panel_title')?></h3>


        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_holiday')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <?php
                    $usertype = $this->session->userdata("usertype");
                    if($usertype == "Admin") {
                ?>
                <h5 class="page-header">
                    <a href="<?php echo base_url('holiday/add') ?>">
                        <i class="fa fa-plus"></i>
                        <?=$this->lang->line('add_title')?>
                    </a>
                </h5>

                <?php } ?>

                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th class="col-sm-1"><?=$this->lang->line('slno')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('holiday_title')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('holiday_fdate')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('holiday_tdate')?></th>
                                <th class="col-sm-3"><?=$this->lang->line('holiday_details')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($holidays)) {$i = 1; foreach($holidays as $holiday) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('holiday_title')?>">
                                        <?php
                                            if(strlen($holiday->title) > 25)
                                                echo strip_tags(substr($holiday->title, 0, 25)."...");
                                            else
                                                echo strip_tags(substr($holiday->title, 0, 25));
                                        ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('holiday_fdate')?>">
                                        <?php echo date("d M Y", strtotime($holiday->fdate)); ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('holiday_tdate')?>">
                                        <?php echo date("d M Y", strtotime($holiday->tdate)); ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('holiday_details')?>">
                                        <?php
                                            if(strlen($holiday->details) > 60)
                                                echo strip_tags(substr($holiday->details, 0, 60)."...");
                                            else
                                                echo strip_tags(substr($holiday->details, 0, 60));
                                        ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('action')?>">
                                        <?php echo btn_view('holiday/view/'.$holiday->holidayID, $this->lang->line('view')); ?>
                                        <?php if($usertype == "Admin") { echo btn_edit('holiday/edit/'.$holiday->holidayID, $this->lang->line('edit')); ?>
                                        <?php echo btn_delete('holiday/delete/'.$holiday->holidayID, $this->lang->line('delete')); } ?>
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
