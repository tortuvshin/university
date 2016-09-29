
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-calendar"></i> <?=$this->lang->line('panel_title')?></h3>


        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_event')?></li>
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
                    <a href="<?php echo base_url('event/add') ?>">
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
                                <th class="col-sm-2"><?=$this->lang->line('event_title')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('event_fdate')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('event_tdate')?></th>
                                <th class="col-sm-3"><?=$this->lang->line('event_details')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($events)) {$i = 1; foreach($events as $event) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('event_title')?>">
                                        <?php
                                            if(strlen($event->title) > 25)
                                                echo strip_tags(substr($event->title, 0, 25)."...");
                                            else
                                                echo strip_tags(substr($event->title, 0, 25));
                                        ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('event_fdate')?>">
                                        <?php echo date("d M Y", strtotime($event->fdate))." (".date("h:i A", strtotime($event->ftime)).")"; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('event_tdate')?>">
                                        <?php echo date("d M Y", strtotime($event->tdate))." (".date("h:i A", strtotime($event->ttime)).")"; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('event_details')?>">
                                        <?php
                                            if(strlen($event->details) > 60)
                                                echo strip_tags(substr($event->details, 0, 60)."...");
                                            else
                                                echo strip_tags(substr($event->details, 0, 60));
                                        ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('action')?>">
                                        <?php echo btn_view('event/view/'.$event->eventID, $this->lang->line('view')); ?>
                                        <?php if($usertype == "Admin") { echo btn_edit('event/edit/'.$event->eventID, $this->lang->line('edit')); ?>
                                        <?php echo btn_delete('event/delete/'.$event->eventID, $this->lang->line('delete')); } ?>
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
