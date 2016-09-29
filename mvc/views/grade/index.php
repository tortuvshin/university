
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-signal"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_grade')?></li>
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
                        <a href="<?php echo base_url('grade/add') ?>">
                            <i class="fa fa-plus"></i> 
                            <?=$this->lang->line('add_title')?>
                        </a>
                    </h5>
                <?php } ?>

                 <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th class="col-lg-1"><?=$this->lang->line('slno')?></th>
                                <th class="col-lg-2"><?=$this->lang->line('grade_name')?></th>
                                <th class="col-lg-2"><?=$this->lang->line('grade_point')?></th>
                                <th class="col-lg-2"><?=$this->lang->line('grade_gradefrom')?></th>
                                <th class="col-lg-2"><?=$this->lang->line('grade_gradeupto')?></th>
                                <th class="col-lg-1"><?=$this->lang->line('grade_note')?></th>
                                <th class="col-lg-2"><?=$this->lang->line('action')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($grades)) {$i = 1; foreach($grades as $grade) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('grade_name')?>">
                                        <?php echo $grade->grade; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('grade_point')?>">
                                        <?php echo $grade->point; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('grade_gradefrom')?>">
                                        <?php echo $grade->gradefrom; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('grade_gradeupto')?>">
                                        <?php echo $grade->gradeupto; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('grade_note')?>">
                                        <?php echo $grade->note; ?>
                                    </td>

                                    <td data-title="<?=$this->lang->line('action')?>">
                                        <?php echo btn_edit('grade/edit/'.$grade->gradeID, $this->lang->line('edit')) ?>
                                        <?php echo btn_delete('grade/delete/'.$grade->gradeID, $this->lang->line('delete')) ?>
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
