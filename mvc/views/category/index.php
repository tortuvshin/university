
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-leaf"></i> <?=$this->lang->line('panel_title')?></h3>

        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_category')?></li>
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
                    <a href="<?php echo base_url('category/add') ?>">
                        <i class="fa fa-plus"></i> 
                        <?=$this->lang->line('add_title')?>
                    </a>
                </h5>

                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('category_hname')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('category_class_type')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('category_hbalance')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('category_note')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($categorys)) {$i = 1; foreach($categorys as $category) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('category_hname')?>">
                                        <?php echo $category->name; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('category_class_type')?>">
                                        <?php echo $category->class_type; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('category_hbalance')?>">
                                        <?php echo $category->hbalance; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('category_note')?>">
                                        <?php echo $category->note; ?>
                                    </td>

                                    <td data-title="<?=$this->lang->line('action')?>">
                                        <?php echo btn_edit('category/edit/'.$category->categoryID, $this->lang->line('edit')) ?>
                                        <?php echo btn_delete('category/delete/'.$category->categoryID, $this->lang->line('delete')) ?>
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
                               <th><?=$this->lang->line('slno')?></th>
                                <th><?=$this->lang->line('category_hname')?></th>
                                <th><?=$this->lang->line('category_class_type')?></th>
                                <th><?=$this->lang->line('category_hbalance')?></th>
                                <th><?=$this->lang->line('category_note')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($categorys)) {$i = 1; foreach($categorys as $category) { ?>
                                <tr>
                                   <td class="col-lg-1" data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td class="col-lg-4" data-title="<?=$this->lang->line('category_hname')?>">
                                        <?php echo $category->name; ?>
                                    </td>
                                    <td class="col-lg-2" data-title="<?=$this->lang->line('category_class_type')?>">
                                        <?php echo $category->class_type; ?>
                                    </td>
                                    <td class="col-lg-2" data-title="<?=$this->lang->line('category_hbalance')?>">
                                        <?php echo $category->hbalance; ?>
                                    </td>
                                    <td class="col-lg-3" data-title="<?=$this->lang->line('category_note')?>">
                                        <?php echo $category->note; ?>
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

