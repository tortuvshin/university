
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-flask"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_mark')?></li>
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
                    <h5 class="page-header">
                        <a href="<?php echo base_url('mark/add') ?>">
                            <i class="fa fa-plus"></i> 
                            <?=$this->lang->line('add_title')?>
                        </a>
                    </h5>
                <?php } ?>

                <div class="col-sm-6 col-sm-offset-3 list-group">
                    <div class="list-group-item list-group-item-warning">
                        <form style="" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">  
                            <?php 
                                if(form_error('name')) 
                                    echo "<div class='form-group has-error' >";
                                else     
                                    echo "<div class='form-group' >";
                            ?>
                                <label for="name_id" class="col-sm-2 col-sm-offset-2 control-label">
                                    <?=$this->lang->line("mark_classes")?>
                                </label>
                                <div class="col-sm-6">
                                    <?php
                                        $array = array("0" => $this->lang->line("mark_select_classes"));
                                        foreach ($classes as $classa) {
                                            $array[$classa->classesID] = $classa->classes;
                                        }
                                        echo form_dropdown("classesID", $array, set_value("classesID", $set), "id='classesID' class='form-control'");
                                    ?>
                                </div>
                            </div>

                        </form>
                    </div>
                </div> <!-- col-sm-6 --> 

                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('mark_photo')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('mark_name')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('mark_roll')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('mark_phone')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($student)) {$i = 1; foreach($student as $student) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('mark_photo')?>">
                                        <?php $array = array(
                                                "src" => base_url('uploads/images/'.$student->photo),
                                                'width' => '35px',
                                                'height' => '35px',
                                                'class' => 'img-rounded'

                                            );
                                            echo img($array); 
                                        ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('mark_name')?>">
                                        <?php echo $student->name; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('mark_roll')?>">
                                        <?php echo $student->roll; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('mark_phone')?>">
                                        <?php echo $student->phone; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('action')?>">
                                        <?php 
                                            if($usertype == "Admin" || $usertype == "Teacher") {
                                                echo btn_view('mark/view/'.$student->studentID."/".$set, $this->lang->line('view'));
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
    </div>
</div>

<script type="text/javascript">
    $('#classesID').change(function() {
        var classesID = $(this).val();
        if(classesID == 0) {
            $('#hide-table').hide();
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('mark/mark_list')?>",
                data: "id=" + classesID,
                dataType: "html",
                success: function(data) {
                    window.location.href = data;
                }
            });
        }
    });
</script>