
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-person193"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_hostel')?></li>
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
                    <a href="<?php echo base_url('hostel/add') ?>">
                        <i class="fa fa-plus"></i> 
                        <?=$this->lang->line('add_title')?>
                    </a>
                </h5>

                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">                    
                        <thead>
                            <tr>
                                <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('hostel_name')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('hostel_htype')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('hostel_address')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('hostel_note')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($hostels)) {$i = 1; foreach($hostels as $hostel) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('hostel_name')?>">
                                        <?php echo $hostel->name; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('hostel_htype')?>">
                                        <?php echo $hostel->htype; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('hostel_address')?>">
                                        <?php echo $hostel->address; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('hostel_note')?>">
                                        <?php echo $hostel->note; ?>
                                    </td>

                                    <td data-title="<?=$this->lang->line('action')?>">
                                        <?php echo btn_edit('hostel/edit/'.$hostel->hostelID, $this->lang->line('edit')) ?>
                                        <?php echo btn_delete('hostel/delete/'.$hostel->hostelID, $this->lang->line('delete')) ?>
                                    </td>
                                </tr>
                            <?php $i++; }} ?>
                        </tbody>
                    </table>
                </div>
                <?php } else { ?>

                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('hostel_name')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('hostel_htype')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('hostel_address')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('hostel_note')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($hostels)) {$i = 1; foreach($hostels as $hostel) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('hostel_name')?>">
                                        <?php echo $hostel->name; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('hostel_htype')?>">
                                        <?php echo $hostel->htype; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('hostel_address')?>">
                                        <?php echo $hostel->address; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('hostel_note')?>">
                                        <?php echo $hostel->note; ?>
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