
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-teacher"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_teacher')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <?php 
                    $usertype = $this->session->userdata("usertype");
                    if($usertype == "Admin"){
                ?>
                <h5 class="page-header"><a href="<?php echo base_url('teacher/add') ?>"><i class="fa fa-plus"></i> 
                    <?=$this->lang->line('add_title')?></a>
                </h5>

                <?php } ?>

                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('teacher_photo')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('teacher_name')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('teacher_email')?></th>
                                <?php if($usertype == "Admin"){ ?>
                                <th class="col-sm-2"><?=$this->lang->line('teacher_status')?></th>
                                <?php } ?>
                                <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($teachers)) {$i = 1; foreach($teachers as $teacher) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('teacher_photo')?>">
                                        <?php $array = array(
                                                "src" => base_url('uploads/images/'.$teacher->photo),
                                                'width' => '35px',
                                                'height' => '35px',
                                                'class' => 'img-rounded'

                                            );
                                            echo img($array); 
                                        ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('teacher_name')?>">
                                        <?php echo $teacher->name; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('teacher_email')?>">
                                        <?php echo $teacher->email; ?>
                                    </td>
                                    <?php if($usertype == "Admin"){ ?>
                                    <td data-title="<?=$this->lang->line('teacher_status')?>">
                                      <div class="onoffswitch-small" id="<?=$teacher->teacherID?>">
                                          <input type="checkbox" id="myonoffswitch<?=$teacher->teacherID?>" class="onoffswitch-small-checkbox" name="paypal_demo" <?php if($teacher->teacheractive === '1') echo "checked='checked'"; ?>>
                                          <label for="myonoffswitch<?=$teacher->teacherID?>" class="onoffswitch-small-label">
                                              <span class="onoffswitch-small-inner"></span>
                                              <span class="onoffswitch-small-switch"></span>
                                          </label>
                                      </div>           
                                    </td>
                                    <?php } ?>
                                    <td data-title="<?=$this->lang->line('action')?>">
                                        <?php 
                                            echo btn_view('teacher/view/'.$teacher->teacherID, $this->lang->line('view')); 
                                            if($usertype == "Admin") { 
                                                echo btn_edit('teacher/edit/'.$teacher->teacherID, $this->lang->line('edit')); 
                                                echo btn_delete('teacher/delete/'.$teacher->teacherID, $this->lang->line('delete')); 
                                            } 
                                        ?>
                                    </td>
                                </tr>
                            <?php $i++; }} ?>
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
              url: "<?=base_url('teacher/active')?>",
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
