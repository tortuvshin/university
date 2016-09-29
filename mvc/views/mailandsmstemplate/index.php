
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-template"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_mailandsmstemplate')?></li>
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
                    <a href="<?php echo base_url('mailandsmstemplate/add') ?>">
                        <i class="fa fa-plus"></i> 
                        <?=$this->lang->line('add_title')?>
                    </a>
                </h5>

                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('mailandsmstemplate_name')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('mailandsmstemplate_type')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('mailandsmstemplate_user')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('mailandsmstemplate_template')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($mailandsmstemplates)) {$i = 1; foreach($mailandsmstemplates as $mailandsmstemplate) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('mailandsmstemplate_name')?>">
                                        <?php 
                                            if(strlen($mailandsmstemplate->name) > 25)
                                                echo substr($mailandsmstemplate->name, 0, 25)."...";
                                            else 
                                                echo substr($mailandsmstemplate->name, 0, 25);
                                        ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('mailandsmstemplate_type')?>">
                                        <?php echo ucfirst($mailandsmstemplate->type); ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('mailandsmstemplate_user')?>">
                                        <?php
                                            echo ucfirst($mailandsmstemplate->user);
                                        ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('mailandsmstemplate_template')?>">
                                        <?php 
                                            if(strlen($mailandsmstemplate->template) > 25)
                                                echo substr($mailandsmstemplate->template, 0, 25)."...";
                                            else 
                                                echo substr($mailandsmstemplate->template, 0, 25);
                                        ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('action')?>">
                                        <?php echo btn_view('mailandsmstemplate/view/'.$mailandsmstemplate->mailandsmstemplateID, $this->lang->line('view')) ?>
                                        <?php echo btn_edit('mailandsmstemplate/edit/'.$mailandsmstemplate->mailandsmstemplateID, $this->lang->line('edit')) ?>
                                        <?php echo btn_delete('mailandsmstemplate/delete/'.$mailandsmstemplate->mailandsmstemplateID, $this->lang->line('delete')) ?>
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