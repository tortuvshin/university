
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-promotion"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("promotion/index")?>"><?=$this->lang->line('menu_promotion')?></a></li>
            <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('menu_promotion')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">


                <div class="col-sm-6 col-sm-offset-3 list-group">
                    <div class="list-group-item list-group-item-warning">
                        <form style="" class="form-horizontal" role="form" method="post">  
                            <div class="form-group">              
                                <label for="classesID" class="col-sm-2 col-sm-offset-2 control-label">
                                    <?=$this->lang->line("promotion_classes")?>
                                </label>
                                <div class="col-sm-6">
                                    <?php
                                        $array = array("0" => $this->lang->line("promotion_select_class"));
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

                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('promotion_photo')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('promotion_name')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('promotion_roll')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('promotion_section')?></th>
                                <th class="col-sm-1"><?=$this->lang->line('promotion_result')?></th>
                                <th class="col-sm-2"><?php if(in_array(2, $student_result)) { echo '<input type="checkbox" class="promotion btn btn-warning" disabled> '.$this->lang->line('action');  } else { echo btn_attendance('', '', 'all_promotion', $this->lang->line('add_all_promotion')).$this->lang->line('action'); }?></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if(count($students)) {$i = 1; foreach($students as $student) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>

                                    <td data-title="<?=$this->lang->line('promotion_photo')?>">
                                        <?php $array = array(
                                                "src" => base_url('uploads/images/'.$student->photo),
                                                'width' => '35px',
                                                'height' => '35px',
                                                'class' => 'img-rounded'

                                            );
                                            echo img($array); 
                                        ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('promotion_name')?>">
                                        <?php echo $student->name; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('promotion_roll')?>">
                                        <?php echo $student->roll; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('promotion_section')?>">
                                        <?php echo $student->section; ?>
                                    </td>


                                    <td data-title="<?=$this->lang->line('promotion_result')?>">
                                        <?php
                                            // dump($student_result[$student->studentID]);
                                            if($student_result[$student->studentID] == 1) {
                                                echo "<button class='btn btn-success btn-xs'>" . $this->lang->line('promotion_pass'). "</button>";
                                            } elseif($student_result[$student->studentID] == 0) {
                                                echo "<button class='btn btn-danger btn-xs'>" . $this->lang->line('promotion_fail'). "</button>";
                                            } else {
                                                echo "<button class='btn btn-info btn-xs'>" . $this->lang->line('promotion_modarate'). "</button>";
                                            }
                                        ?>
                                    </td>
                                    


                                    <td data-title="<?=$this->lang->line('action')?>">
                                        <?php 
                                            if($student_result[$student->studentID] == 1 || $student_result[$student->studentID] == 0) {
                                                echo  btn_promotion($student->studentID, 'promotion btn btn-warning', $this->lang->line('add_title'));
                                            } 
                                            else {
                                                echo '<input type="checkbox" class="promotion btn btn-warning" disabled>';
                                            }
                                            // echo  btn_promotion($student->studentID, 'promotion btn btn-warning', $this->lang->line('add_title'));
                                        ?>
                                    </td>
                               </tr>
                            <?php $i++; }} ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-sm-3 col-sm-offset-9 list-group">
                <input type="button" class="col-sm-12 btn btn-success" id="save" value="<?=$this->lang->line('add_promotion')?>" >
                </div>

                <div id="dialog"></div>



            </div> <!-- col-sm-12 -->
            
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->

<script type="text/javascript">
    $('#classesID').change(function() {
        var classesID = $(this).val();
        if(classesID == 0) {
            $('#hide-table').hide();
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('promotion/promotion_list')?>",
                data: "id=" + classesID,
                dataType: "html",
                success: function(data) {
                    window.location.href = data;
                }
            });
        }
    });

    $('.all_promotion').click(function() {

        if($(".all_promotion").prop('checked')) {
            status = "checked";
            $('.promotion').prop("checked", true);
        } else {
            status = "unchecked";
            $('.promotion').prop("checked", false);
        }
    });

    $('#save').click(function() {
        if ($('.promotion').filter(':checked').length == 0) {
            toastr["error"]("<?=$this->lang->line('promotion_select_student')?>")
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
            var result = [];
            var status = "";
            var classesID = <?=$set?>;
            $('.promotion').each(function(index) {            
                status = (this.checked ? $(this).attr('id') : 0);
                result.push(status);  
            });

            $redirect = (window.location.href);
            $.ajax({
                type: 'POST',
                url: "<?=base_url('promotion/promotion_to_next_class')?>",
                data: "studentIDs=" + result + "&classesID=" +classesID ,
                dataType: "html",
                success: function(data) {
                   window.location.replace($redirect);
                }
            });

        }

    });

</script>