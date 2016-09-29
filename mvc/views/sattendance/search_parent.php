
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-sattendance"></i> <?=$this->lang->line('panel_title2')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_attendance')?></li>
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
                                <label for="studentID" class="col-sm-2 col-sm-offset-2 control-label">
                                    <?=$this->lang->line("attendance_student")?>
                                </label>
                                <div class="col-sm-6">
                                    <?php
                                        $array = array("0" => $this->lang->line("attendance_select_student"));
                                        if($allstudents) {
                                            foreach ($allstudents as $allstudent) {
                                                $array[$allstudent->studentID] = $allstudent->name;
                                            }
                                        }
                                        echo form_dropdown("studentID", $array, set_value("studentID"), "id='studentID' class='form-control'");
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div> <!-- col-sm-12 -->
            
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->
<script type="text/javascript">
    $('#studentID').change(function() {
        var studentID = $(this).val();
        if(studentID == 0) {
            $('#hide').hide();
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('sattendance/pstudent_list')?>",
                data: "id=" + studentID,
                dataType: "html",
                success: function(data) {
                    window.location.href = data;
                }
            });
        }
    });
</script>

<?php
    $usertype = $this->session->userdata('usertype');
    if($usertype == "Student" || $usertype == "Parent") {
?>
    <script language="javascript" type="text/javascript">
        var url = window.location.href;
        $("a[href$='"+url+"']").parent().addClass('active');
    </script>

<?php } ?>