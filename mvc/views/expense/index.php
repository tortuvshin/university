
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-expense"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_expense')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <?php 
                    $usertype = $this->session->userdata("usertype");
                    if($usertype == "Admin" || $usertype == "Accountant") {
                ?>
                    <h5 class="page-header">
                        <a href="<?php echo base_url('expense/add') ?>">
                            <i class="fa fa-plus"></i> 
                            <?=$this->lang->line('add_title')?>
                        </a>
                    </h5>

                    <div id="hide-table">
                        <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                                <tr>
                                    <th class="col-sm-1"><?=$this->lang->line('slno')?></th>
                                    <th class="col-sm-2"><?=$this->lang->line('expense_expense')?></th>
                                    <th class="col-sm-2"><?=$this->lang->line('expense_date')?></th>
                                    <th class="col-sm-2"><?=$this->lang->line('expense_uname')?></th>
                                    <th class="col-sm-1"><?=$this->lang->line('expense_amount')?></th>
                                    <th class="col-sm-2"><?=$this->lang->line('expense_note')?></th>
                                    <?php if($usertype == "Admin") { ?>
                                    <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total_expense = 0; if(count($expenses)) {$i = 1; foreach($expenses as $expense) { ?>
                                    <tr>
                                        <td data-title="<?=$this->lang->line('slno')?>">
                                            <?php echo $i; ?>
                                        </td>
                                        <td data-title="<?=$this->lang->line('expense_expense')?>">
                                            <?php echo $expense->expense; ?>
                                        </td>
                                        <td data-title="<?=$this->lang->line('expense_date')?>">
                                            <?php echo date("d M Y", strtotime($expense->date)); ?>
                                        </td>
                                        
                                        <td data-title="<?=$this->lang->line('expense_uname')?>">
                                            <?php echo $expense->uname; ?>
                                        </td>

                                        <?php if($usertype == "Admin") { ?>
                                        <td data-title="<?=$this->lang->line('expense_amount')?>">
                                            <?php echo $expense->amount; ?>
                                        </td>
                                        <?php } else { ?>
                                        <td data-title="<?=$this->lang->line('expense_amount')?>">
                                            <?php echo $expense->amount; ?>
                                        </td>
                                        <?php } ?>

                                        <?php if($usertype == "Admin") { ?>
                                        <td data-title="<?=$this->lang->line('expense_note')?>">
                                            <?php echo $expense->note; ?>
                                        </td>
                                        <?php } else { ?>
                                        <td data-title="<?=$this->lang->line('expense_note')?>">
                                            <?php echo $expense->note; ?>
                                        </td>
                                        <?php } ?>

                                        <?php if($usertype == "Admin") { ?>
                                        <td data-title="<?=$this->lang->line('action')?>">
                                            <?php echo btn_edit('expense/edit/'.$expense->expenseID, $this->lang->line('edit')) ?>
                                            <?php echo btn_delete('expense/delete/'.$expense->expenseID, $this->lang->line('delete')) ?>
                                        </td>
                                        <?php } ?>

                                        
                                    </tr>
                                <?php $i++; $total_expense+=$expense->amount; }} ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-4 col-sm-offset-8 total-marg">
                        <div class="well well-sm">
                            <table style="width:100%; margin:0px;">
                                <tr>
                                    <td width="50%">
                                        <?php
                                            echo $this->lang->line('expense_total')." : ";
                                        ?>
                                    </td>
                                    <td style="width:50%;padding-left:10px">
                                        <?php
                                            echo $total_expense. " TK"; 
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>


                <?php } ?>
            </div>
        </div>
    </div>
</div>