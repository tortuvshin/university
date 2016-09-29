
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-issue"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_issue')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <?php
                    $usertype = $this->session->userdata("usertype");
                    if($usertype == "Admin" || $usertype == "Librarian") {
                ?>

                <h5 class="page-header">
                    <a href="<?php echo base_url('issue/add') ?>">
                        <i class="fa fa-plus"></i> 
                        <?=$this->lang->line('add_title')?>
                    </a>
                </h5>

                <div class="col-lg-6 col-lg-offset-3 list-group">
                    <div class="list-group-item list-group-item-warning">
                        <form style="" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">  
                              <div class='form-group' >
                                <label for="lid" class="col-sm-3 control-label">
                                    <?=$this->lang->line("issue_lid")?>
                                </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="lid" name="lid" value="<?=set_value('lid')?>" >
                                </div>
                                <div class="col-sm-3">
                                    <input type="submit" class="btn btn-success iss-mar" value="<?=$this->lang->line('issue_search')?>" >
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <?php } ?>

                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th class="col-lg-2"><?=$this->lang->line('slno')?></th>
                                <th class="col-lg-2"><?=$this->lang->line('issue_book')?></th>
                                <th class="col-lg-2"><?=$this->lang->line('issue_serial_no')?></th>
                                <th class="col-lg-2"><?=$this->lang->line('issue_due_date')?></th>
                                <th class="col-lg-2"><?=$this->lang->line('issue_fine')?></th>
                                <th class="col-lg-2"><?=$this->lang->line('action')?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(count($issues)) {$i = 1; foreach($issues as $issue) {

                                    if($issue->return_date == "" || empty($issue->return_date)) {
                            ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('issue_book')?>">
                                        <?php echo $issue->book; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('issue_serial_no')?>">
                                        <?php echo $issue->serial_no; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('issue_due_date')?>">
                                        <?php echo $issue->due_date; ?>
                                    </td>
                                    <?php if($usertype == "Admin" || $usertype == "Librarian") { ?>
                                    <td data-title="<?=$this->lang->line('issue_fine')?>">
                                        <?php
                                            $date = date("Y-m-d");
                                            if(strtotime($date) > strtotime($issue->due_date)) {
                                                echo $issue->fine;
                                            }
                                        ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('action')?>">
                                        <?php
                                            echo btn_view('issue/view/'.$issue->issueID, $this->lang->line('view'));
                                            echo " ". btn_edit('issue/edit/'.$issue->issueID."/".$issue->lID, $this->lang->line('edit'));
                                            echo " ". btn_return('issue/returnbook/'.$issue->issueID."/".$issue->lID, $this->lang->line('return'));
                                        ?>
                                    </td>
                                    <?php } else { ?>
                                    <td data-title="<?=$this->lang->line('issue_fine')?>">
                                        <?php
                                            $date = date("Y-m-d");
                                            if(strtotime($date) > strtotime($issue->due_date)) {
                                                echo $issue->fine;
                                            } 
                                        ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('action')?>">
                                        <?php
                                            echo btn_view('issue/view/'.$issue->issueID, $this->lang->line('view'));
                                        ?>
                                    </td>
                                    <?php } ?>
                                    
                                </tr>
                            <?php $i++; }}} ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>