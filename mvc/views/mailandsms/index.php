
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-mailandsms"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_mailandsms')?></li>
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
                        <a href="<?php echo base_url('mailandsms/add') ?>">
                            <i class="fa fa-plus"></i> 
                            <?=$this->lang->line('add_title')?>
                        </a>
                    </h5>
                <?php } ?>

                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th class="col-lg-2"><?=$this->lang->line('slno')?></th>
                                <th class="col-lg-2"><?=$this->lang->line('mailandsms_users')?></th>
                                <th class="col-lg-2"><?=$this->lang->line('mailandsms_type')?></th>
                                <th class="col-lg-2"><?=$this->lang->line('mailandsms_dateandtime')?></th>
                                <th class="col-lg-3"><?=$this->lang->line('mailandsms_message')?></th>
                                <th class="col-lg-3"><?=$this->lang->line('action')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($mailandsmss)) {$i = 1; foreach($mailandsmss as $mailandsms) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('mailandsms_users')?>">
                                        <?php echo $mailandsms->users; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('mailandsms_type')?>">
                                        <?php echo $mailandsms->type; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('mailandsms_dateandtime')?>">
                                        <?php echo date("d M Y h:i:s a", strtotime($mailandsms->create_date));?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('mailandsms_message')?>">
                                        <?php echo substr($mailandsms->message, 0,40). ".."; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('action')?>">
                                        <?php echo btn_view('mailandsms/view/'.$mailandsms->mailandsmsID, $this->lang->line('view')) ?>
                                    </td>
                                </tr>
                            <?php $i++; }} ?>
                        </tbody>
                    </table>
                </div>
   

            </div> <!-- col-sm-12 -->
            
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->
