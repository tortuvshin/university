<?php
    $email = $this->session->userdata('email');
    $usertype=$this->session->userdata('usertype');
?>
<div class="box">
    <div class="box-body">
        <div class="row">
            <div class="col-md-3">
              <a href="<?=base_url('message/add')?>" class="btn btn-info btn-block margin-bottom"><?=$this->lang->line('add_title')?></a>
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=$this->lang->line('folder')?></h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked message">
                    <li><a href="<?=base_url('message/index')?>"><i class="fa fa-inbox"></i> <?=$this->lang->line('inbox')?> <span class="label label-info pull-right" id="inbox"></span></a></li>
                    <li class="active"><a href="<?=base_url('message/sent')?>"><i class="fa fa-envelope-o"></i> <?=$this->lang->line('sent')?><span class="label label-info pull-right" id="sent"></span></a></li>
                    <li><a href="<?=base_url('message/fav_message')?>"><i class="fa fa-envelope-o"></i> <?=$this->lang->line('favorite')?></a></li>
                    <li><a href="<?=base_url('message/trash')?>"><i class="fa fa-trash-o"></i> <?=$this->lang->line('trash')?></a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->

            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=$this->lang->line('compose_new')?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form role="form" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <div class="select2-wrapper">
                            <select class="form-control select2" name="to" >
                                <option></option>
                                <optgroup label="<?=$this->lang->line('admin_select_label')?>">

                                <?php foreach ($admin as $item): ?>
                                    <?php if($item->usertype == $usertype && $item->email==$email) { ?>
                                        <option value="<?php echo $item->usertype.','.$item->systemadminID.','.$item->email ?>" disabled><?php echo $item->username ?></option>
                                    <?php } else {?>
                                        <option value="<?php echo $item->usertype.','.$item->systemadminID.','.$item->email ?>"><?php echo $item->username ?></option>
                                    <?php } ?>
                                <?php endforeach ?>
                                </optgroup>
                                <optgroup label="<?=$this->lang->line('student_select_label')?>">
                                <?php foreach ($student as $item): ?>
                                    <?php if($item->usertype == $usertype && $item->email==$email) { ?>
                                        <option value="<?php echo $item->usertype.','.$item->studentID.','.$item->email ?>" disabled><?php echo $item->username ?></option>
                                    <?php } else {?>
                                        <option value="<?php echo $item->usertype.','.$item->studentID.','.$item->email ?>"><?php echo $item->username ?></option>
                                    <?php } ?>
                                <?php endforeach ?>
                                </optgroup>
                                <optgroup label="<?=$this->lang->line('parent_select_label')?>">
                                <?php foreach ($parent as $item): ?>
                                    <?php if($item->usertype == $usertype && $item->email==$email) { ?>
                                        <option value="<?php echo $item->usertype.','.$item->parentID.','.$item->email ?>" disabled><?php echo $item->username ?></option>
                                    <?php } else {?>
                                        <option value="<?php echo $item->usertype.','.$item->parentID.','.$item->email ?>"><?php echo $item->username ?></option>
                                    <?php } ?>
                                <?php endforeach ?>
                                </optgroup>
                                <optgroup label="<?=$this->lang->line('teacher_select_label')?>">
                                <?php foreach ($teacher as $item): ?>
                                     <?php if($item->usertype == $usertype && $item->email==$email) { ?>
                                        <option value="<?php echo $item->usertype.','.$item->teacherID.','.$item->email ?>" disabled><?php echo $item->username ?></option>
                                    <?php } else {?>
                                        <option value="<?php echo $item->usertype.','.$item->teacherID.','.$item->email ?>"><?php echo $item->username ?></option>
                                    <?php } ?>
                                <?php endforeach ?>
                                </optgroup>
                                <optgroup label="<?=$this->lang->line('librarian_select_label')?>">
                                <?php foreach ($librarian as $item): ?>
                                     <?php if($item->usertype == $usertype && $item->email==$email) { ?>
                                        <option value="<?php echo $item->usertype.','.$item->userID.','.$item->email ?>" disabled><?php echo $item->username ?></option>
                                    <?php } else {?>
                                        <option value="<?php echo $item->usertype.','.$item->userID.','.$item->email ?>"><?php echo $item->username ?></option>
                                    <?php } ?>
                                <?php endforeach ?>
                                </optgroup>
                                <optgroup label="<?=$this->lang->line('accountant_select_label')?>">
                                <?php foreach ($accountant as $item): ?>
                                     <?php if($item->usertype == $usertype && $item->email==$email) { ?>
                                        <option value="<?php echo $item->usertype.','.$item->userID.','.$item->email ?>" disabled><?php echo $item->username ?></option>
                                    <?php } else {?>
                                        <option value="<?php echo $item->usertype.','.$item->userID.','.$item->email ?>"><?php echo $item->username ?></option>
                                    <?php } ?>
                                <?php endforeach ?>
                                </optgroup>
                            </select>
                        </div>
                        <div class="has-error">
                            <?php if (form_error('to')): ?>
                                <p class="text-danger"> <?php echo form_error('to'); ?></p>
                            <?php endif ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <input class="form-control" name="subject" value="<?=set_value('subject')?>" placeholder="Subject:"/>
                        <div class="has-error">
                            <?php if (form_error('subject')): ?>
                                <p class="text-danger"> <?php echo form_error('subject'); ?></p>
                            <?php endif ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <textarea class="form-control" name="message" rows="10" placeholder="Message"><?=set_value('message')?></textarea>
                        <div class="has-error">
                            <?php if (form_error('message')): ?>
                                <p class="text-danger"> <?php echo form_error('message'); ?></p>
                            <?php endif ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="btn btn-info btn-file">
                          <i class="fa fa-paperclip"></i> <?=$this->lang->line('attachment')?>
                          <input type="file" id="attachment" name="attachment"/>
                        </div>
                        <div class="col-sm-3" style="padding-left:0;">
                            <input class="form-control"  id="uploadFile" placeholder="Choose File" disabled />
                        </div>
                        <div class="has-error">
                            <p class="text-danger"> <?php if(isset($attachment_error)) echo $attachment_error; ?></p>
                        </div>
                      </div>
                      <div class="pull-right">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> <?=$this->lang->line('send')?></button>
                      </div>
                      <a href="<?=base_url('message/index')?>" class="btn btn-danger"><i class="fa fa-times"></i> <?=$this->lang->line('discard')?></a>
                    </form>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
        </div>
    </div>
</div>
<script>
document.getElementById("attachment").onchange = function() {
    document.getElementById("uploadFile").value = this.value;
};
$( document ).ready(function () {
    $.ajax({
        type: 'POST',
        url: "<?=base_url('message/unreadCounter')?>",
        dataType: "json",
        success: function(data) {
            $( "#inbox" ).append(data.inbox);
            $( "#sent" ).append(data.send);
        }
    });
});
</script>
