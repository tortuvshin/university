
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-systemadmin"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_systemadmin')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <?php 
                    $usertype = $this->session->userdata("usertype");
                    if($usertype == "Admin") {
                ?>
                    <h5 class="page-header">
                        <a href="<?php echo base_url('systemadmin/add') ?>">
                            <i class="fa fa-plus"></i> 
                            <?=$this->lang->line('add_title')?>
                        </a>
                    </h5>
                <?php } ?>

                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th class="col-lg-1"><?=$this->lang->line('slno')?></th>
                                <th class="col-lg-2"><?=$this->lang->line('systemadmin_photo')?></th>
                                <th class="col-lg-2"><?=$this->lang->line('systemadmin_name')?></th>
                                <th class="col-lg-2"><?=$this->lang->line('systemadmin_email')?></th>
                                <th class="col-lg-2"><?=$this->lang->line('systemadmin_type')?></th>
                                <th class="col-lg-1"><?=$this->lang->line('systemadmin_status')?></th>
                                <th class="col-lg-2"><?=$this->lang->line('action')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($systemadmins)) {$i = 1; foreach($systemadmins as $systemadmin) { if($systemadmin->systemadminID != 1 && $this->session->userdata('loginuserID') != $systemadmin->systemadminID) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('systemadmin_photo')?>">
                                        <?php $array = array(
                                                "src" => base_url('uploads/images/'.$systemadmin->photo),
                                                'width' => '35px',
                                                'height' => '35px',
                                                'class' => 'img-rounded'

                                            );
                                            echo img($array); 
                                        ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('systemadmin_name')?>">
                                        <?php echo $systemadmin->name; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('systemadmin_email')?>">
                                        <?php echo $systemadmin->email; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('systemadmin_type')?>">
                                        <?=$this->lang->line(str_replace(' ', '',$systemadmin->usertype))?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('systemadmin_status')?>">
                                      <div class="onoffswitch-small" id="<?=$systemadmin->systemadminID?>">
                                          <input type="checkbox" id="myonoffswitch<?=$systemadmin->systemadminID?>" class="onoffswitch-small-checkbox" name="paypal_demo" <?php if($systemadmin->systemadminactive === '1') echo "checked='checked'"; ?>>
                                          <label for="myonoffswitch<?=$systemadmin->systemadminID?>" class="onoffswitch-small-label">
                                              <span class="onoffswitch-small-inner"></span>
                                              <span class="onoffswitch-small-switch"></span>
                                          </label>
                                      </div>           
                                    </td>
                                    <td data-title="<?=$this->lang->line('action')?>">
                                        <?php echo btn_view('systemadmin/view/'.$systemadmin->systemadminID, $this->lang->line('view')) ?>
                                        <?php echo btn_edit('systemadmin/edit/'.$systemadmin->systemadminID, $this->lang->line('edit')) ?>
                                        <?php echo btn_delete('systemadmin/delete/'.$systemadmin->systemadminID, $this->lang->line('delete')) ?>
                                    </td>
                                </tr>
                            <?php $i++; }}} ?>
                        </tbody>
                    </table>
                </div>


            </div> <!-- col-sm-12 -->
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->

<script>
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
              url: "<?=base_url('systemadmin/active')?>",
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
