
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-member"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("hmember/index")?>"><?=$this->lang->line('menu_member')?></a></li>
            <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('menu_member')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">
                <form class="form-horizontal" role="form" method="post">

                    <?php 
                        if(form_error('hostelID')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="hostelID" class="col-sm-2 control-label">
                            <?=$this->lang->line("hmember_hname")?>
                        </label>
                        <div class="col-sm-6">
                            <?php
                                $array = array();
                                $array[0] = $this->lang->line("hmember_select_hostel_name");
                                foreach ($hostels as $hostel) {
                                    $array[$hostel->hostelID] = $hostel->name;
                                }
                                echo form_dropdown("hostelID", $array, set_value("hostelID"), "id='hostelID' class='form-control'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('hostelID'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('categoryID')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="categoryID" class="col-sm-2 control-label">
                            <?=$this->lang->line("hmember_class_type")?>
                        </label>
                        <div class="col-sm-6">
                            <?php
                                $array = array(0 => $this->lang->line("hmember_select_class_type"));
                                echo form_dropdown("categoryID", $array, set_value("categoryID"), "id='categoryID' class='form-control'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('categoryID'); ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("add_hmember")?>" >
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

$('#hostelID').click(function(event) {
    var hostelID = $(this).val();
    if(hostelID == 0 || hostelID == "" || hostelID == null) {
        $('#categoryID').val(0);
    } else {
        $.ajax({
            type: 'POST',
            url: "<?=base_url('hmember/categorycall')?>",
            data: "id=" + hostelID,
            dataType: "html",
            success: function(data) {
               $('#categoryID').html(data)
            }
        });
    }
});
</script>
