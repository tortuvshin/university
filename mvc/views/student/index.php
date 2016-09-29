
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-student"></i> <?=$this->lang->line('panel_title')?></h3>


        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_student')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <?php
                    $usertype = $this->session->userdata("usertype");
                    if($usertype == "Admin" || $usertype == "Super Admin") {
                ?>
                    <h5 class="page-header">
                        <a href="<?php echo base_url('student/add') ?>">
                            <i class="fa fa-plus"></i>
                            <?=$this->lang->line('add_title')?>
                        </a>
                    </h5>
                <?php } ?>



                <div class="col-sm-6 col-sm-offset-3 list-group">
                    <div class="list-group-item list-group-item-warning">
                        <form style="" class="form-horizontal" role="form" method="post">
                            <div class="form-group">
                                <label for="classesID" class="col-sm-2 col-sm-offset-2 control-label">
                                    <?=$this->lang->line("student_classes")?>
                                </label>
                                <div class="col-sm-6">
                                    <?php
                                        $array = array("0" => $this->lang->line("student_select_class"));
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
                                <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true"><?=$this->lang->line("student_all_students")?></a></li>
                                <?php foreach ($sections as $key => $section) {
                                    echo '<li class=""><a data-toggle="tab" href="#'.$section->classesID.$section->sectionID .'" aria-expanded="false">'. $this->lang->line("student_section")." ".$section->section. " ( ". $section->category." )".'</a></li>';
                                } ?>
                            </ul>



                            <div class="tab-content">
                                <div id="all" class="tab-pane active">
                                    <div id="hide-table">
                                        <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                                            <thead>
                                                <tr>
                                                    <th class="col-sm-1"><?=$this->lang->line('slno')?></th>
                                                    <th class="col-sm-2"><?=$this->lang->line('student_photo')?></th>
                                                    <th class="col-sm-2"><?=$this->lang->line('student_name')?></th>
                                                    <th class="col-sm-2"><?=$this->lang->line('student_roll')?></th>
                                                    <th class="col-sm-2"><?=$this->lang->line('student_phone')?></th>
                                                    <th class="col-sm-1"><?=$this->lang->line('student_status')?></th>
                                                    <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(count($students)) {$i = 1; foreach($students as $student) { ?>
                                                    <tr>
                                                        <td data-title="<?=$this->lang->line('slno')?>">
                                                            <?php echo $i; ?>
                                                        </td>

                                                        <td data-title="<?=$this->lang->line('student_photo')?>">
                                                            <?php $array = array(
                                                                    "src" => base_url('uploads/images/'.$student->photo),
                                                                    'width' => '35px',
                                                                    'height' => '35px',
                                                                    'class' => 'img-rounded'

                                                                );
                                                                echo img($array);
                                                            ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('student_name')?>">
                                                            <?php echo $student->name; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('student_roll')?>">
                                                            <?php echo $student->roll; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('student_phone')?>">
                                                            <?php echo $student->phone; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('teacher_status')?>">
                                                            <div class="onoffswitch-small" id="<?=$student->studentID?>">
                                                                <input type="checkbox" id="myonoffswitch<?=$student->studentID?>" class="onoffswitch-small-checkbox" name="paypal_demo" <?php if($student->studentactive === '1') echo "checked='checked'"; ?>>
                                                                <label for="myonoffswitch<?=$student->studentID?>" class="onoffswitch-small-label">
                                                                    <span class="onoffswitch-small-inner"></span>
                                                                    <span class="onoffswitch-small-switch"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('action')?>">
                                                            <?php
                                                                if($usertype == "Admin" || $usertype == "Super Admin") {
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

                                <?php foreach ($sections as $key => $section) { ?>
                                        <div id="<?=$section->classesID.$section->sectionID?>" class="tab-pane">
                                            <div id="hide-table">
                                                <table class="table table-striped table-bordered table-hover dataTable no-footer">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                                            <th class="col-sm-2"><?=$this->lang->line('student_photo')?></th>
                                                            <th class="col-sm-2"><?=$this->lang->line('student_name')?></th>
                                                            <th class="col-sm-2"><?=$this->lang->line('student_roll')?></th>
                                                            <th class="col-sm-2"><?=$this->lang->line('student_phone')?></th>
                                                            <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if(count($allsection[$section->sectionID])) { $i = 1; foreach($allsection[$section->sectionID] as $student) { if($section->sectionID === $student->sectionID) { ?>
                                                            <tr>
                                                                <td data-title="<?=$this->lang->line('slno')?>">
                                                                    <?php echo $i; ?>
                                                                </td>

                                                                <td data-title="<?=$this->lang->line('student_photo')?>">
                                                                    <?php $array = array(
                                                                            "src" => base_url('uploads/images/'.$student->photo),
                                                                            'width' => '35px',
                                                                            'height' => '35px',
                                                                            'class' => 'img-rounded'

                                                                        );
                                                                        echo img($array);
                                                                    ?>
                                                                </td>
                                                                <td data-title="<?=$this->lang->line('student_name')?>">
                                                                    <?php echo $student->name; ?>
                                                                </td>
                                                                <td data-title="<?=$this->lang->line('student_roll')?>">
                                                                    <?php echo $student->roll; ?>
                                                                </td>
                                                                <td data-title="<?=$this->lang->line('student_phone')?>">
                                                                    <?php echo $student->phone; ?>
                                                                </td>
                                                                <td data-title="<?=$this->lang->line('action')?>">
                                                                    <?php
                                                                        if($usertype == "Admin" || $usertype == "Super Admin") {
                                                                            echo btn_view('student/view/'.$student->studentID."/".$set, $this->lang->line('view'));
                                                                            echo btn_edit('student/edit/'.$student->studentID."/".$set, $this->lang->line('edit'));
                                                                            echo btn_delete('student/delete/'.$student->studentID."/".$set, $this->lang->line('delete'));
                                                                        } elseif ($usertype == "Teacher") {
                                                                            echo btn_view('student/view/'.$student->studentID."/".$set, $this->lang->line('view'));
                                                                        }

                                                                    ?>
                                                                </td>
                                                           </tr>
                                                        <?php $i++; }}} ?>
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
                                <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true"><?=$this->lang->line("student_all_students")?></a></li>
                            </ul>


                            <div class="tab-content">
                                <div id="all" class="tab-pane active">
                                    <div id="hide-table">
                                        <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                                            <thead>
                                                <tr>
                                                    <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                                    <th class="col-sm-2"><?=$this->lang->line('student_photo')?></th>
                                                    <th class="col-sm-2"><?=$this->lang->line('student_name')?></th>
                                                    <th class="col-sm-2"><?=$this->lang->line('student_roll')?></th>
                                                    <th class="col-sm-2"><?=$this->lang->line('student_phone')?></th>
                                                    <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(count($students)) {$i = 1; foreach($students as $student) { ?>
                                                    <tr>
                                                        <td data-title="<?=$this->lang->line('slno')?>">
                                                            <?php echo $i; ?>
                                                        </td>

                                                        <td data-title="<?=$this->lang->line('student_photo')?>">
                                                            <?php $array = array(
                                                                    "src" => base_url('uploads/images/'.$student->photo),
                                                                    'width' => '35px',
                                                                    'height' => '35px',
                                                                    'class' => 'img-rounded'

                                                                );
                                                                echo img($array);
                                                            ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('student_name')?>">
                                                            <?php echo $student->name; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('student_roll')?>">
                                                            <?php echo $student->roll; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('student_phone')?>">
                                                            <?php echo $student->phone; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('action')?>">
                                                            <?php
                                                                if($usertype == "Admin" || $usertype == "Super Admin") {
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

            </div> <!-- col-sm-12 -->

        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->

<script type="text/javascript">
    $('#classesID').change(function() {
        var classesID = $(this).val();
        if(classesID == 0) {
            $('#hide-table').hide();
            $('.nav-tabs-custom').hide();
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('student/student_list')?>",
                data: "id=" + classesID,
                dataType: "html",
                success: function(data) {
                    window.location.href = data;
                }
            });
        }
    });


    var status = '';
    var id = 0;
    $('.onoffswitch-small-checkbox').click(function() {
        if($(this).prop('checked')) {
            status = 'chacked';
            id = $(this).parent().attr("id");
        } else {
            status = 'unchacked';
            id = $(this).parent().attr("id");
        }

        if((status != '' || status != null) && (id !='')) {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('student/active')?>",
                data: "id=" + id + "&status=" + status,
                dataType: "html",
                success: function(data) {
                    if(data == 'Success') {
                        toastr["success"]("Success")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "500",
                            "hideDuration": "500",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    } else {
                        toastr["error"]("Error")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "500",
                            "hideDuration": "500",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                }
            });
        }
    });
</script>
