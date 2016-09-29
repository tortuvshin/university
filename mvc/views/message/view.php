
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
            <!-- reply error -->

            <!-- message box -->
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=$this->lang->line('read_message')?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="box-body chat">
                      <div class="mailbox-read-info">
                        <h3><?php if ($message->subject): ?>
                                <?php echo $message->subject; ?>
                            <?php endif ?>
                        </h3>
                        <h6>From: <?php echo $sender->email==$this->session->userdata('email') ? "me" : $sender->email; ?> <span class="mailbox-read-time pull-right"><?=date('Y M d @ H.i A', strtotime($message->create_date))?></span></h6>
                        <h6>To: <?php echo $message->email; ?> </h6>
                      </div><!-- /.mailbox-read-info -->
                      <hr>
                      <!-- <div class="chat"> -->
                        <div class="item">
                            <img src="<?=base_url("uploads/images/".$sender->photo);?>" alt="user image" class="online"/>
                            <p class="message">
                                <a href="#" class="name">
                                    <?php echo $sender->email; ?>
                                </a>
                                <?php echo $message->message; ?>
                            </p>
                        </div>
                      <!-- </div> -->
                      <hr>
                    </div><!-- /.box-body -->
                    <!-- reply msg -->
                    <div class="box-body chat" id="chat-box">
                        <!-- chat item -->
                        <?php foreach ($reply_msg as $reply): ?>
                            <div class="item">
                            <?php if ($reply->status == 1): ?>
                                <img src="<?=base_url("uploads/images/".$sender->photo);?>" alt="user image" class="online"/>
                                <p class="message">
                                <a href="#" class="name">
                                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> <?=date('Y M d @ H.i A', strtotime($reply->create_time))?></small>
                                    <?php echo $sender->email; ?>
                                </a>
                            <?php else: ?>
                                <img src="<?=base_url("uploads/images/".$reciver->photo);?>" alt="user image" class="online"/>
                                <p class="message">
                                <a href="#" class="name">
                                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> <?=date('Y M d @ H.i A', strtotime($reply->create_time))?></small>
                                    <?php echo $reciver->email; ?>
                                </a>
                            <?php endif ?>
                                <?php echo $reply->reply_msg; ?>
                            </p>
                            </div><!-- item -->
                            <hr>
                        <?php endforeach ?>
                    </div>
                    <!--chat -->
                    <!-- reply msg end -->
                    <?php if ($message->attach_file_name != ''): ?>
                    <div class="box-footer">
                      <ul class="mailbox-attachments clearfix">
                        <li>
                        <a href="<?=base_url('uploads/attach/'.$message->attach_file_name)?>" target="_blank">
                          <span class="mailbox-attachment-icon"><i class="fa fa-file fa-1x"></i></span>
                          <div class="mailbox-attachment-info">
                            <a href="<?=base_url('uploads/attach/'.$message->attach_file_name)?>" target="_blank" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                            <?php
                                $image = "";
                                if(strlen($message->attach) > 15) {
                                   $image = substr($message->attach, 0,15). "..";
                                } else {
                                    $image = $message->attach;
                                }
                                echo $image;
                            ?>
                            </a>
                            <span class="mailbox-attachment-size">
                              <!-- <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a> -->
                            </span>
                          </div>
                        </a>
                        </li>
                      </ul>
                    </div>
                    <?php endif ?>
                    <div class="box-footer" style="padding-left:0;">
                        <div class="btn-group">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#reply_msg"><i class="fa fa-reply"></i> <?=$this->lang->line('reply')?></button>
                        </div>
                    </div>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
        </div>
    </div>
</div>
<!-- reply mail modal -->
<form class="form-horizontal" role="form"  method="post">
    <div class="modal fade" id="reply_msg">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><?=$this->lang->line('reply')?></h4>
            </div>
            <div class="modal-body">


                <?php
                    if(form_error('reply'))
                        echo "<div class='form-group has-error' >";
                    else
                        echo "<div class='form-group' >";
                ?>
                    <label for="message" class="col-sm-2 control-label">
                        <?=$this->lang->line("reply")?>
                    </label>
                    <div class="col-sm-6">
                        <textarea class="form-control" id="reply" name="reply" value="<?=set_value('reply')?>" ></textarea>
                    </div>
                    <span class="col-sm-4 control-label" id="message_error">
                    </span>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" style="margin-bottom:0px;" data-dismiss="modal"><?=$this->lang->line('close')?></button>
                <input type="button" id="send_pdf" class="btn btn-success" value="<?=$this->lang->line("send")?>" />
            </div>
        </div>
      </div>
    </div>
</form>

<script type="text/javascript">
    $("#send_pdf").click(function(){

        var message = $('#reply').val();
        var id = "<?=$message->messageID;?>";

        if(message == "") {
        $("#message_error").html("Please enter reply").css("text-align", "left").css("color", 'red');

        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('message/reply_msg')?>",
                data: "id=" + id+ "&message=" + message,
                dataType: "html",
                success: function(data) {
                   window.location.href = data;
                   // alert(data);
                }
            });
        }
    });
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
