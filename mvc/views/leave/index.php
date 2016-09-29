
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-calendar"></i> <?=$this->lang->line('panel_title1')?></h3>


        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_leave')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <?php
                    $usertype = $this->session->userdata("usertype");
                    if($usertype != "Admin") {
                ?>
                <h5 class="page-header">
                    <a href="<?php echo base_url('leave/add') ?>">
                        <i class="fa fa-plus"></i>
                        <?=$this->lang->line('leave_add_leave')?>
                    </a>
                </h5>

                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th class="col-sm-1"><?=$this->lang->line('slno')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('to')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('leave_submitdate')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('leave_title')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('leave_status')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if(count($leaves)) {$i = 1; foreach($leaves as $leave) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('to')?>">
                                        <?php echo $leave->name; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('leave_submitdate')?>">
                                        <?php echo date("d M Y", strtotime($leave->create_date)); ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('leave_title')?>">
                                        <?php
                                            if(strlen($leave->title) > 25)
                                                echo strip_tags(substr($leave->title, 0, 25)."...");
                                            else
                                                echo strip_tags(substr($leave->title, 0, 25));
                                        ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('leave_status')?>">
                                        <?php
                                            if($leave->status=="2")
                                                echo '<button class="btn btn-danger btn-xs">'.$this->lang->line('leave_status_not').'</button>';
                                            elseif($leave->status=="1")
                                                echo '<button class="btn btn-success btn-xs">'.$this->lang->line('leave_status_approve').'</button>';
                                            else
                                                echo '<button class="btn btn-warning btn-xs">'.$this->lang->line('leave_status_pending').'</button>';
                                        ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('action')?>">
                                        <?php echo btn_view('leave/view/'.$leave->leaveID, $this->lang->line('view')) ?>
                                        <?php if($leave->status=="0" || $leave->status=="2") echo btn_edit('leave/edit/'.$leave->leaveID, $this->lang->line('edit')) ?>
                                        <?php echo btn_delete('leave/delete/'.$leave->leaveID, $this->lang->line('delete')) ?>
                                    </td>
                                </tr>
                            <?php $i++; }} ?>
                        </tbody>
                    </table>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>
