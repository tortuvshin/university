
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-calendar"></i> <?=$this->lang->line('panel_title2')?></h3>


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
                    if($usertype == "Admin" || $usertype == "Teacher") {
                ?>
                    <div class="form-group">
                        <div class="col-sm-offset-2 pull-right">
                            <a href="<?=base_url('leave/all_accept')?>"><input class="btn btn-primary" type="submit" value="<?=$this->lang->line("leave_all_approve")?>"></a>
                            <a href="<?=base_url('leave/all_denied')?>"><input class="btn btn-default" type="submit" value="<?=$this->lang->line("leave_all_denied")?>"></a>
                        </div>
                    </div>
                <br/><br/>

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
                                        <?php
                                          if(isset($leave->s_name)) {
                                              echo "<a style='color:blue' title='View Profile Details' href=\"".base_url('student/view/'.$leave->s_id.'/'.$leave->s_class)."\">".$leave->s_name."</a> (".$this->lang->line('student').")";
                                          } elseif (isset($leave->p_name)) {
                                              echo $leave->p_name." (".$this->lang->line('parent').")";
                                          } elseif (isset($leave->t_name)) {
                                              echo "<a style='color:blue' title='View Profile Details' href=\"".base_url('teacher/view/'.$leave->t_id)."\">".$leave->t_name."</a> (".$this->lang->line('teacher').")";
                                          } elseif (isset($leave->u_name)) {
                                              echo "<a style='color:blue' title='View Profile Details' href=\"".base_url('user/view/'.$leave->u_id)."\">".$leave->u_name."</a> (".$leave->u_type.")";
                                          }

                                        ?>
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
                                        <?php echo btn_view('leave/submitview/'.$leave->leaveID, $this->lang->line('view')) ?>
                                        <?php if($leave->status=="0" && $usertype!="Admin" && $usertype!='Teacher') echo btn_edit('leave/edit/'.$leave->leaveID, $this->lang->line('edit')) ?>
                                        <?php if($usertype!="Admin" && $usertype!='Teacher') echo btn_delete('leave/delete/'.$leave->leaveID, $this->lang->line('delete')) ?>
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
