
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-clipboard"></i> <?=$this->lang->line('panel_title')?></h3>


        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><a href="<?=base_url("bulkimport/index")?>"><?=$this->lang->line('menu_import')?></a></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <form action="<?=base_url('bulkimport/teacher_bulkimport');?>" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="photo" class="col-sm-2 control-label col-xs-8 col-md-2">
                            <?=$this->lang->line("bulkimport_teacher")?>
                        </label>
                        <div class="col-sm-3 col-xs-4 col-md-3">
                            <input class="form-control"  id="uploadFile" placeholder="Choose File" disabled />
                        </div>

                        <div class="col-sm-2 col-xs-6 col-md-2">
                            <div class="fileUpload btn btn-success form-control">
                                <span class="fa fa-repeat"></span>
                                <span><?=$this->lang->line("upload")?></span>
                                <input id="uploadBtn" type="file" class="upload" name="csvFile" data-show-upload="false"
                                       data-show-preview="false" required="required"/>
                            </div>
                        </div>

                        <div class="col-md-1 rep-mar">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("bulkimport_submit")?>" >
                        </div>
                        <div class="col-md-1 rep-mar">
                            <a class="btn btn-info" href="<?=base_url('assets/csv/sample_teacher.csv')?>"><i class="fa fa-download"></i> <?=$this->lang->line("bulkimport_sample")?></a>
                        </div>
                    </div>
                </form>
                <form enctype="multipart/form-data" style="" action="<?=base_url('bulkimport/parent_bulkimport');?>" class="form-horizontal" role="form" method="post">
                    <div class="form-group">
                        <label for="photo" class="col-sm-2 control-label col-xs-8 col-md-2">
                            <?=$this->lang->line("bulkimport_parent")?>
                        </label>
                        <div class="col-sm-3 col-xs-4 col-md-3">
                            <input class="form-control parent" id="uploadFile" placeholder="Choose File" disabled />
                        </div>

                        <div class="col-sm-2 col-xs-6 col-md-2">
                            <div class="fileUpload btn btn-success form-control">
                                <span class="fa fa-repeat"></span>
                                <span><?=$this->lang->line("upload")?></span>
                                <input id="uploadBtn" type="file" class="upload parentUpload" name="csvParent" />
                            </div>
                        </div>

                        <div class="col-md-1 rep-mar">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("bulkimport_submit")?>" >
                        </div>

                        <div class="col-md-1 rep-mar">
                            <a class="btn btn-info" href="<?=base_url('assets/csv/sample_parent.csv')?>"><i class="fa fa-download"></i> <?=$this->lang->line("bulkimport_sample")?></a>
                        </div>
                    </div>
                </form>

                <form enctype="multipart/form-data" style="" action="<?=base_url('bulkimport/user_bulkimport');?>" class="form-horizontal" role="form" method="post">
                    <div class="form-group">
                        <label for="csvUser" class="col-sm-2 control-label col-xs-8 col-md-2">
                            <?=$this->lang->line("bulkimport_user")?>
                        </label>
                        <div class="col-sm-3 col-xs-4 col-md-3">
                            <input class="form-control user" id="uploadFile" placeholder="Choose File" disabled />
                        </div>

                        <div class="col-sm-2 col-xs-6 col-md-2">
                            <div class="fileUpload btn btn-success form-control">
                                <span class="fa fa-repeat"></span>
                                <span><?=$this->lang->line("upload")?></span>
                                <input id="uploadBtn" type="file" class="upload userUpload" name="csvUser" />
                            </div>
                        </div>

                        <div class="col-md-1 rep-mar">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("bulkimport_submit")?>" >
                        </div>

                        <div class="col-md-1 rep-mar">
                            <a class="btn btn-info" href="<?=base_url('assets/csv/sample_user.csv')?>"><i class="fa fa-download"></i> <?=$this->lang->line("bulkimport_sample")?></a>
                        </div>
                    </div>
                </form>

                <form enctype="multipart/form-data" style="" action="<?=base_url('bulkimport/book_bulkimport');?>" class="form-horizontal" role="form" method="post">
                    <div class="form-group">
                        <label for="csvBook" class="col-sm-2 control-label col-xs-8 col-md-2">
                            <?=$this->lang->line("bulkimport_book")?>
                        </label>
                        <div class="col-sm-3 col-xs-4 col-md-3">
                            <input class="form-control bookImport" id="uploadFile" placeholder="Choose File" disabled />
                        </div>

                        <div class="col-sm-2 col-xs-6 col-md-2">
                            <div class="fileUpload btn btn-success form-control">
                                <span class="fa fa-repeat"></span>
                                <span><?=$this->lang->line("upload")?></span>
                                <input id="uploadBtn" type="file" class="upload bookUpload" name="csvBook" />
                            </div>
                        </div>

                        <div class="col-md-1 rep-mar">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("bulkimport_submit")?>" >
                        </div>

                        <div class="col-md-1 rep-mar">
                            <a class="btn btn-info" href="<?=base_url('assets/csv/sample_book.csv')?>"><i class="fa fa-download"></i> <?=$this->lang->line("bulkimport_sample")?></a>
                        </div>
                    </div>
                </form>
                <form action="<?=base_url('bulkimport/student_bulkimport');?>" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="photo" class="col-sm-2 control-label col-xs-8 col-md-2">
                            <?=$this->lang->line("bulkimport_student")?>
                        </label>
                        <div class="col-sm-3 col-xs-4 col-md-3">
                            <input class="form-control student"  id="uploadFile" placeholder="Choose File" disabled />
                        </div>

                        <div class="col-sm-2 col-xs-6 col-md-2">
                            <div class="fileUpload btn btn-success form-control">
                                <span class="fa fa-repeat"></span>
                                <span><?=$this->lang->line("upload")?></span>
                                <input id="uploadBtn" type="file" class="upload studentUpload" name="csvStudent" data-show-upload="false"
                                       data-show-preview="false" required="required"/>
                            </div>
                        </div>

                        <div class="col-md-1 rep-mar">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("bulkimport_submit")?>" >
                        </div>
                        <div class="col-md-1 rep-mar">
                            <a class="btn btn-info" href="<?=base_url('assets/csv/sample_student.csv')?>"><i class="fa fa-download"></i> <?=$this->lang->line("bulkimport_sample")?></a>
                        </div>
                    </div>
                </form>

            </div>
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->
<script type="text/javascript">
    document.getElementById("uploadBtn").onchange = function() {
    document.getElementById("uploadFile").value = this.value;
};
$('.parentUpload').on('change', function() {
  $('.parent').val($(this).val());
});
$('.userUpload').on('change', function() {
  $('.user').val($(this).val());
});
$('.bookUpload').on('change', function() {
  $('.bookImport').val($(this).val());
});
$('.studentUpload').on('change', function() {
  $('.student').val($(this).val());
});
</script>
