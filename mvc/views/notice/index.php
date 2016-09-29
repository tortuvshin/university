
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-calendar"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_notice')?></li>
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
                    <a href="<?php echo base_url('notice/add') ?>">
                        <i class="fa fa-plus"></i> 
                        <?=$this->lang->line('add_title')?>
                    </a>
                </h5>

                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('notice_title')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('notice_date')?></th>
                                <th class="col-sm-4"><?=$this->lang->line('notice_notice')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($notices)) {$i = 1; foreach($notices as $notice) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('notice_title')?>">
                                        <?php 
                                            if(strlen($notice->title) > 25)
                                                echo strip_tags(substr($notice->title, 0, 25)."...");
                                            else 
                                                echo strip_tags(substr($notice->title, 0, 25));
                                        ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('notice_date')?>">
                                        <?php echo date("d M Y", strtotime($notice->date)); ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('notice_notice')?>">
                                        <?php 
                                            if(strlen($notice->notice) > 60)
                                                echo strip_tags(substr($notice->notice, 0, 60)."...");
                                            else 
                                                echo strip_tags(substr($notice->notice, 0, 60));
                                        ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('action')?>">
                                        <?php echo btn_view('notice/view/'.$notice->noticeID, $this->lang->line('view')) ?>
                                        <?php echo btn_edit('notice/edit/'.$notice->noticeID, $this->lang->line('edit')) ?>
                                        <?php echo btn_delete('notice/delete/'.$notice->noticeID, $this->lang->line('delete')) ?>
                                    </td>
                                </tr>
                            <?php $i++; }} ?>
                        </tbody>
                    </table>
                </div>
                <?php } else {  ?>
                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('notice_title')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('notice_date')?></th>
                                <th class="col-sm-4"><?=$this->lang->line('notice_notice')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($notices)) {$i = 1; foreach($notices as $notice) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('notice_title')?>">
                                        <?php 
                                            if(strlen($notice->title) > 25)
                                                echo substr($notice->title, 0, 25)."...";
                                            else 
                                                echo substr($notice->title, 0, 25);
                                        ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('notice_date')?>">
                                        <?php echo date("d M Y", strtotime($notice->date)); ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('notice_notice')?>">
                                        <?php 
                                            if(strlen($notice->notice) > 60)
                                                echo substr($notice->notice, 0, 60)."...";
                                            else 
                                                echo substr($notice->notice, 0, 60);
                                        ?>
                                    </td>
                                    <td data-title='Action'>
                                        <?php echo btn_view('notice/view/'.$notice->noticeID, $this->lang->line('view')) ?>
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