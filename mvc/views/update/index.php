
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-refresh"></i> <?=$this->lang->line('panel_title')?></h3>


        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_update')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">
                <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">

                    <?php
                        if(isset($image))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="photo" class="col-sm-2 control-label">
                            <?=$this->lang->line("update_file")?>
                        </label>
                        <div class="col-sm-4">
                            <input class="form-control"  id="uploadFile" placeholder="Choose File" disabled />
                        </div>

                        <div class="col-sm-2">
                            <div class="fileUpload btn btn-success form-control">
                                <span class="fa fa-repeat"></span>
                                <span><?=$this->lang->line("upload_setting")?></span>
                                <input id="uploadBtn" type="file" class="upload" name="file" />
                            </div>
                        </div>
                         <span class="col-sm-4 control-label" id="error">
                            <?php if(isset($image)) echo $image; ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input id="update" type="button" class="btn btn-success" value="<?=$this->lang->line("update_update")?>" >
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
document.getElementById("uploadBtn").onchange = function() {
    document.getElementById("uploadFile").value = this.value;
};

$('#update').click(function() {
    if($('#uploadBtn').val() == '') {
        $('#error').text('Select A File');
    } else {
        $('#error').text('');
        var formData = new FormData();
        formData.append('file', $('#uploadBtn')[0].files[0]);
        $.ajax({
            type: 'POST',
            url: "<?=base_url('update/upload')?>",
            dataType: "html",
            data:  formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(data) {
                if (data=="Yes") {
                    $.ajax({
                        type: 'POST',
                        url: "<?=base_url('update/index')?>",
                        data: 'data='+ data,
                        dataType: "html",
                        success: function(result) {
                            window.location.href = data;
                        }
                    });
                }
            }
        });
    }

});


</script>
