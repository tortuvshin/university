
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-member"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("tmember/index/$set")?>"><?=$this->lang->line('menu_member')?></a></li>
            <li class="active"><?=$this->lang->line('menu_edit')?> <?=$this->lang->line('menu_member')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">

                <form class="form-horizontal" role="form" method="post">
                    
                    <?php 
                        if(form_error('transportID')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="transportID" class="col-sm-2 control-label">
                            <?=$this->lang->line("tmember_route_name")?>
                        </label>
                        <div class="col-sm-6">
                            
                            <?php
                                $array = array();
                                $array[0] = $this->lang->line("classes_select_route_name");
                                foreach ($transports as $transport) {
                                    $array[$transport->transportID] = $transport->route;
                                }
                                echo form_dropdown("transportID", $array, set_value("transportID", $tmember->transportID), "id='transportID' class='form-control'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('transportID'); ?>
                        </span>
                    </div>

                    

                    <?php 
                        if(form_error('tbalance')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="tbalance" class="col-sm-2 control-label">
                            <?=$this->lang->line("tmember_tfee")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="tbalance" name="tbalance" value="<?=set_value('tbalance', $tmember->tbalance)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('tbalance'); ?>
                        </span>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("update_tmember")?>" >
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

$(document).ready(function() {
    

    $('#transportID').change(function() {
       var transportID = $(this).val();
        if(transportID == 0 || transportID == "" || transportID == null) {
            $('#tbalance').val("0.00");
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('tmember/transport_fare')?>",
                data: "id=" + transportID,
                dataType: "html",
                success: function(data) {
                   $('#tbalance').val(data)
                }
            });
        }
    });
});
</script>
