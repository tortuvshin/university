
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-film"></i> <?=$this->lang->line('panel_title')?></h3>

        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <?php if(count($f)) { ?>
                <li><a href="<?=base_url("media/index")?>"><?=$this->lang->line('menu_media')?></a></li> 
                <li class="active"><?=substr(strtoupper($f->folder_name), 0,16 ).'..'?></li>
            <?php } else { ?>
                <li class="active"><?=$this->lang->line('menu_media')?></li> 
            <?php } ?>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <?php
                    $usertype = $this->session->userdata("usertype");
                    if($usertype) {
                ?>
                <div class="box-body">
                    <div class="col-xs-12">
                        <div class="row">                                                
                            <?php if ($usertype=="Admin"||$usertype=="Teacher"): ?>
                                <div class="col-lg-3 col-sm-12">
                                    <a class="btn btn-app bg-aqua" id="media-upload" data-toggle="modal" data-target="#file_upload">
                                    <i class="fa fa-plus fa-2x"></i>                        
                                    </a>
                                    <input id="upload_media" name="upload_media" type="file"/>
                                </div>                                                                       
                            <?php endif ?>
                            <?php if (count($files)): ?>
                                <?php foreach ($files as $file): ?>
                                    <div class="col-lg-3 col-sm-12">                                
                                        <a href="<?=base_url("uploads/media/$file->file_name");?>" download="<?=$file->file_name;?>" target="_blink" class="btn btn-app" id="media-folder">
                                        <?php  
                                        if(strlen($file->file_name_display) > 15) {
                                           echo substr($file->file_name_display, 0,15). ".."; 
                                        } else {
                                            echo $file->file_name_display;
                                        }
                                        ?>
                                        <i class="fa fa-file fa-2x"></i>
                                        </a>
                                        <?php if ($usertype=="Admin" || ($usertype==$file->usertype&&$userID==$file->userID)): ?>
                                        <?php echo delete_file(base_url("media/delete/$file->mediaID"), "close_folder") ?>
                                        <a id="<?=$file->mediaID?>" data-toggle="modal" data-target="#share_modal" class="share_file pull-right" ><i class="fa fa-globe fa-2x"></i></a>
                                        <?php endif ?>
                                        <b>Uploaded by <?=$file->usertype;?>: <?=$file->shared_by;?></b>
                                    </div>
                                <?php endforeach ?>
                            <?php endif ?>
                        </div>  
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>
<!-- share modal starts here -->
<form class="form-horizontal" role="form" method="post" action="<?=base_url('media/media_share')?>">
    <div class="modal fade" id="share_modal">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><?=$this->lang->line('share')?></h4>
            </div>
            <div class="modal-body">
                
                <!-- <span id="media_info"></span>   -->
                <input id="media_info" name="media_info" type="hidden" value="">  
                
                <?php 
                    if(form_error('share_with')) 
                        echo "<div class='form-group has-error' >";
                    else     
                        echo "<div class='form-group' >";
                ?>
                    <label for="share_with" class="col-sm-3 control-label">
                        <?=$this->lang->line("share_with")?>
                    </label>
                    <div class="col-sm-6">
                        <select name="share_with" id="share_with" class="form-control">
                            <option value=""><?=$this->lang->line("share_with")?></option>                        
                            <option value="public"><?=$this->lang->line("public")?></option>
                            <option value="class"><?=$this->lang->line("class")?></option>
                        </select>
                    </div>
                    <span class="col-sm-4 col-sm-offset-3 control-label" id="share_with_error">
                    </span>
                </div>

                <?php 
                    if(form_error('classesID')) 
                        echo "<div class='form-group has-error' id='di'>";
                    else     
                        echo "<div class='form-group' id='di'>";
                ?>
                    <label for="classesID" class="col-sm-3 control-label">
                        <?=$this->lang->line("select_class")?>
                    </label>
                    <div class="col-sm-6">
                        <select name="classesID" id="classesID" class="form-control">
                        </select>
                    </div>
                    <span class="col-sm-4 col-sm-offset-3 control-label" id="share_with_error">
                    </span>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" style="margin-bottom:0px;" data-dismiss="modal"><?=$this->lang->line('close')?></button>
                <input type="submit" id="share_files" class="btn btn-success" value="<?=$this->lang->line("share")?>" />
            </div>
        </div>
      </div>
    </div>
</form>
<!-- share end here -->
<!-- file modal starts here -->
<form action="" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="file_upload">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><?=$this->lang->line('upload_file')?></h4>
            </div>
            <div class="modal-body">
                <div class='form-group' >
                    <label for="photo" class="col-sm-3 control-label col-xs-8 col-md-2">
                        <?=$this->lang->line("file")?>
                    </label>
                    <div class="col-sm-4 col-xs-6 col-md-4">
                        <input class="form-control"  id="uploadFile" placeholder="Choose File" disabled />  
                    </div>

                    <div class="col-sm-3 col-xs-6 col-md-4">
                        <div class="fileUpload btn btn-success form-control">
                            <span class="fa fa-repeat"></span>
                            <span><?=$this->lang->line("upload")?></span>
                            <input id="uploadBtn" type="file" class="upload" name="file" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" style="margin-bottom:0px;" data-dismiss="modal"><?=$this->lang->line('close')?></button>
                <input type="submit" id="upload_file" name="upload_file" class="btn btn-success" value="<?=$this->lang->line("upload_file")?>" />
            </div>
        </div>
      </div>
    </div>
</form>
<!-- folder end here -->
<script type="text/javascript">
    $('#di').hide();
    $("#create_folder").click(function(){
            var folder_name = $('#folder_name').val();
            if(folder_name == "") {
                $("#folder_name_error").html("Please enter folder name").css("text-align", "left").css("color", 'red');
            } else {
                $("#folder_name_error").html("");
                $.ajax({
                    type: 'POST',
                    url: "<?=base_url('media/create_folder')?>",
                    data: 'folder_name='+ folder_name,
                    dataType: "html",
                    success: function(data) {
                        location.reload();
                        // alert(data);
                    }
                });
            }
        });
    document.getElementById("uploadBtn").onchange = function() {
        document.getElementById("uploadFile").value = this.value;
    };

    $('.share_file').click(function() {
       $('#media_info').val($(this).attr('id'));
    });

    $("#share_with").change(function() {
        var share_with = $(this).val();
        if (share_with=="class") {
            $('#di').show();
        } else {
            $('#di').hide();
        }
    });


    $("#share_with").change(function() {
        var share_with = $(this).val();
        if (share_with=="class") {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('media/classcall')?>",
                dataType: "html",
                success: function(data) {
                   $('#classesID').html(data);
                }
            });
        } else {
            $('#classesID').html("");            
        }
    });
</script>