
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-payment"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_balance')?></li>
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

                <div class="col-sm-6 col-sm-offset-3 list-group">
                    <div class="list-group-item list-group-item-warning">
                        <form style="" class="form-horizontal" role="form" method="post">  
                            <div class="form-group">              
                                <label for="classesID" class="col-sm-2 col-sm-offset-2 control-label">
                                    <?=$this->lang->line("balance_classesID")?>
                                </label>
                                <div class="col-sm-6">

                                    <?php
                                        $array = array("0" => $this->lang->line("balance_select_classes"));
                                        foreach ($classes as $classa) {
                                            $array[$classa->classesID] = $classa->classes;
                                        }
                                        echo form_dropdown("classesID", $array, set_value("classesID", $set), "id='classesID' class='form-control'");
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                    <?php if(count($students) > 0 ) { ?>

                        <div class="col-sm-12">

                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true"><?=$this->lang->line("balance_all_students")?></a></li>
                                    <?php foreach ($sections as $key => $section) {
                                        echo '<li class=""><a data-toggle="tab" href="#'. $section->sectionID .'" aria-expanded="false">'. $this->lang->line("balance_section")." ".$section->section. " ( ". $section->category." )".'</a></li>';
                                    } ?>
                                </ul>



                                <div class="tab-content">
                                    <div id="all" class="tab-pane active">
                                        <div id="hide-table">
                                            <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                                                <thead>
                                                    <tr>
                                                        <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                                        <th class="col-sm-2"><?=$this->lang->line('balance_photo')?></th>
                                                        <th class="col-sm-2"><?=$this->lang->line('balance_name')?></th>
                                                        <th class="col-sm-2"><?=$this->lang->line('balance_roll')?></th>
                                                        <th class="col-sm-2"><?=$this->lang->line('balance_phone')?></th>
                                                        <th class="col-sm-2"><?=$this->lang->line('balance_totalbalance')?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(count($students)) {$i = 1; foreach($students as $student) { ?>
                                                        <tr>
                                                            <td data-title="<?=$this->lang->line('slno')?>">
                                                                <?php echo $i; ?>
                                                            </td>

                                                            <td data-title="<?=$this->lang->line('balance_photo')?>">
                                                                <?php $array = array(
                                                                        "src" => base_url('uploads/images/'.$student->photo),
                                                                        'width' => '35px',
                                                                        'height' => '35px',
                                                                        'class' => 'img-rounded'

                                                                    );
                                                                    echo img($array); 
                                                                ?>
                                                            </td>
                                                            <td data-title="<?=$this->lang->line('balance_name')?>">
                                                                <?php echo $student->name; ?>
                                                            </td>
                                                            <td data-title="<?=$this->lang->line('balance_roll')?>">
                                                                <?php echo $student->roll; ?>
                                                            </td>
                                                            <td data-title="<?=$this->lang->line('balance_phone')?>">
                                                                <?php echo $student->phone; ?>
                                                            </td>
                                                            <td data-title="<?=$this->lang->line('balance_totalbalance')?>">
                                                                <?php 
                                                                    $totalsbalance = ($student->totalamount - $student->paidamount); 
                                                                    
                                                                    if($student->totalamount > $student->paidamount) {
                                                                        echo "- ". number_format(abs($totalsbalance), 2, '.', ',');
                                                                    } else {
                                                                        echo "+ ". number_format(abs($totalsbalance), 2, '.', ',');
                                                                    }
                                                                ?>
                                                            </td>
                                                       </tr>
                                                    <?php $i++; }} ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                    <?php foreach ($sections as $key => $section) { ?>
                                            <div id="<?=$section->sectionID?>" class="tab-pane">
                                                <div id="hide-table">
                                                    <table class="table table-striped table-bordered table-hover dataTable no-footer">
                                                        <thead>
                                                            <tr>
                                                                <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                                                <th class="col-sm-2"><?=$this->lang->line('balance_photo')?></th>
                                                                <th class="col-sm-2"><?=$this->lang->line('balance_name')?></th>
                                                                <th class="col-sm-2"><?=$this->lang->line('balance_roll')?></th>
                                                                <th class="col-sm-2"><?=$this->lang->line('balance_phone')?></th>
                                                                <th class="col-sm-2"><?=$this->lang->line('balance_totalbalance')?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if(count($allsection[$section->section])) { $i = 1; foreach($allsection[$section->section] as $student) { ?>
                                                                <tr>
                                                                    <td data-title="<?=$this->lang->line('slno')?>">
                                                                        <?php echo $i; ?>
                                                                    </td>

                                                                    <td data-title="<?=$this->lang->line('balance_photo')?>">
                                                                        <?php $array = array(
                                                                                "src" => base_url('uploads/images/'.$student->photo),
                                                                                'width' => '35px',
                                                                                'height' => '35px',
                                                                                'class' => 'img-rounded'

                                                                            );
                                                                            echo img($array); 
                                                                        ?>
                                                                    </td>
                                                                    <td data-title="<?=$this->lang->line('balance_name')?>">
                                                                        <?php echo $student->name; ?>
                                                                    </td>
                                                                    <td data-title="<?=$this->lang->line('balance_roll')?>">
                                                                        <?php echo $student->roll; ?>
                                                                    </td>
                                                                    <td data-title="<?=$this->lang->line('balance_phone')?>">
                                                                        <?php echo $student->phone; ?>
                                                                    </td>
                                                                    <td data-title="<?=$this->lang->line('balance_totalbalance')?>">
                                                                        <?php 
                                                                            $totalsbalance = ($student->totalamount - $student->paidamount); 
                                                                            
                                                                            if($student->totalamount > $student->paidamount) {
                                                                                echo "- ". number_format(abs($totalsbalance), 2, '.', ',');
                                                                            } else {
                                                                                echo "+ ". number_format(abs($totalsbalance), 2, '.', ',');
                                                                            }
                                                                        ?>
                                                                    </td>
                                                               </tr>
                                                            <?php $i++; }} ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                    <?php } ?>
                                </div>

                            </div> <!-- nav-tabs-custom -->
                        </div> <!-- col-sm-12 for tab -->

                    <?php } else { ?>
                        <div class="col-sm-12">

                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true"><?=$this->lang->line("balance_all_students")?></a></li>
                                </ul>


                                <div class="tab-content">
                                    <div id="all" class="tab-pane active">
                                        <div id="hide-table">
                                            <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                                                <thead>
                                                    <tr>
                                                        <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                                        <th class="col-sm-2"><?=$this->lang->line('balance_photo')?></th>
                                                        <th class="col-sm-2"><?=$this->lang->line('balance_name')?></th>
                                                        <th class="col-sm-2"><?=$this->lang->line('balance_roll')?></th>
                                                        <th class="col-sm-2"><?=$this->lang->line('balance_phone')?></th>
                                                        <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(count($students)) {$i = 1; foreach($students as $student) { ?>
                                                        <tr>
                                                            <td data-title="<?=$this->lang->line('slno')?>">
                                                                <?php echo $i; ?>
                                                            </td>

                                                            <td data-title="<?=$this->lang->line('balance_photo')?>">
                                                                <?php $array = array(
                                                                        "src" => base_url('uploads/images/'.$student->photo),
                                                                        'width' => '35px',
                                                                        'height' => '35px',
                                                                        'class' => 'img-rounded'

                                                                    );
                                                                    echo img($array); 
                                                                ?>
                                                            </td>
                                                            <td data-title="<?=$this->lang->line('balance_name')?>">
                                                                <?php echo $student->name; ?>
                                                            </td>
                                                            <td data-title="<?=$this->lang->line('balance_roll')?>">
                                                                <?php echo $student->roll; ?>
                                                            </td>
                                                            <td data-title="<?=$this->lang->line('balance_phone')?>">
                                                                <?php echo $student->phone; ?>
                                                            </td>
                                                            <td data-title="<?=$this->lang->line('action')?>">
                                                                <?php 
                                                                    if($usertype == "Admin") {
                                                                        echo btn_view('student/view/'.$student->studentID."/".$set, $this->lang->line('view'));
                                                                        echo btn_edit('student/edit/'.$student->studentID."/".$set, $this->lang->line('edit'));
                                                                        echo btn_delete('student/delete/'.$student->studentID."/".$set, $this->lang->line('delete'));
                                                                    } elseif ($usertype == "Teacher") {
                                                                        echo btn_view('student/view/'.$student->studentID."/".$set, $this->lang->line('view'));
                                                                    }

                                                                ?>
                                                            </td>
                                                       </tr>
                                                    <?php $i++; }} ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div> <!-- nav-tabs-custom -->
                        </div>
                    <?php } ?>

                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#classesID').change(function() {
        var classesID = $(this).val();
        if(classesID == 0) {
            $('#hide-table').hide();
            $('.nav-tabs-custom').hide();
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('balance/balance_list')?>",
                data: "id=" + classesID,
                dataType: "html",
                success: function(data) {
                    window.location.href = data;
                }
            });
        }
    });
</script>
