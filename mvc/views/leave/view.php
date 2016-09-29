<?php
$usertype = $this->session->userdata("usertype");
$username = $this->session->userdata("username");
?>
    <div class="well">
        <div class="row">
            <div class="col-sm-8">
                <button class="btn-cs btn-sm-cs" onclick="javascript:printDiv('printablediv')"><span class="fa fa-print"></span> <?=$this->lang->line('print')?> </button>
                <?php
                  echo btn_add_pdf('leave/print_preview/'.$leave->leaveID, $this->lang->line('pdf_preview'));
                ?>
                <?php
                  if($leave->status=="0" && $leave->fromusername == $username)
                    echo btn_sm_edit('leave/edit/'.$leave->leaveID, $this->lang->line('edit'));
                ?>
                <button class="btn-cs btn-sm-cs" data-toggle="modal" data-target="#mail"><span class="fa fa-envelope-o"></span> <?=$this->lang->line('mail')?></button>
                <?php
                  if($option==1) {
                    echo btn_sm_accept_and_denied_leave('leave/accept/'.$leave->leaveID, $this->lang->line('accept'),'check');
                    echo btn_sm_accept_and_denied_leave('leave/denied/'.$leave->leaveID, $this->lang->line('denied'),'close');
                  }
                ?>
            </div>


            <div class="col-sm-4">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
                    <?php if($option==1) {?>
                      <li class="active"><a href="<?=base_url("leave/submitleaveapp")?>"><?=$this->lang->line('panel_title2')?></a></li>
                    <?php } else { ?>
                    <li><a href="<?=base_url("leave/index")?>"><?=$this->lang->line('menu_leave')?></a></li>
                    <li class="active"><?=$this->lang->line('menu_view')?></li>
                    <?php } ?>

                </ol>
            </div>

        </div>

    </div>

<section class="panel">
    <div class="panel-body bio-graph-info">
        <div id="printablediv" class="box-body">
            <div class="row">
                <div class="col-sm-12">
                  <?php
                      if($leave->status=="2")
                          $status='<button class="btn btn-danger btn-xs">'.$this->lang->line('leave_status_not').'</button>';
                      elseif($leave->status=="1")
                          $status='<button class="btn btn-success btn-xs">'.$this->lang->line('leave_status_approve').'</button>';
                      else
                          $status='<button class="btn btn-warning btn-xs">'.$this->lang->line('leave_status_pending').'</button>';
                  ?>
                    <?php echo "<b>".$leave->title."</b> ".$status; ?><br><br>
                    <?php echo $leave->details; ?><br><br>
                    <?php echo "<b>".$this->lang->line('leave_date')." : ".date("d M Y (D)", strtotime($leave->fdate))." ".$this->lang->line('to')." ".date("d M Y (D)", strtotime($leave->tdate))."</b>"; ?><br>
                    <?php echo $this->lang->line('leave_submit')." ".date("d M Y", strtotime($leave->create_date))." "; ?>
                    <?php
                      if($option==1) {
                        echo $this->lang->line('by')." ";
                      } else {
                        echo $this->lang->line('to')." ";
                      }
                    ?>
                    <?php
                      if(isset($leave->s_name) && isset($admin_view)) {
                          echo $leave->s_name;
                      } elseif (isset($leave->s_name)) {
                          echo $leave->s_name." (".$this->lang->line('student').")";
                      } elseif (isset($leave->p_name)) {
                          echo $leave->p_name." (".$this->lang->line('parent').")";
                      } elseif (isset($leave->t_name)) {
                          echo $leave->t_name." (".$this->lang->line('teacher').")";
                      } elseif (isset($leave->u_name)) {
                          echo $leave->u_name." (".$leave->u_type.")";
                      }

                    ?>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- email modal starts here -->
<form class="form-horizontal" role="form" action="<?=base_url('leave/send_mail');?>" method="post">
    <div class="modal fade" id="mail">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title"><?=$this->lang->line('mail')?></h4>
            </div>
            <div class="modal-body">

                <?php
                    if(form_error('to'))
                        echo "<div class='form-group has-error' >";
                    else
                        echo "<div class='form-group' >";
                ?>
                    <label for="to" class="col-sm-2 control-label">
                        <?=$this->lang->line("to")?>
                    </label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" id="to" name="to" value="<?=set_value('to')?>" >
                    </div>
                    <span class="col-sm-4 control-label" id="to_error">
                    </span>
                </div>

                <?php
                    if(form_error('subject'))
                        echo "<div class='form-group has-error' >";
                    else
                        echo "<div class='form-group' >";
                ?>
                    <label for="subject" class="col-sm-2 control-label">
                        <?=$this->lang->line("subject")?>
                    </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="subject" name="subject" value="<?=set_value('subject')?>" >
                    </div>
                    <span class="col-sm-4 control-label" id="subject_error">
                    </span>

                </div>

                <?php
                    if(form_error('message'))
                        echo "<div class='form-group has-error' >";
                    else
                        echo "<div class='form-group' >";
                ?>
                    <label for="message" class="col-sm-2 control-label">
                        <?=$this->lang->line("message")?>
                    </label>
                    <div class="col-sm-6">
                        <textarea class="form-control" id="message" style="resize: vertical;" name="message" value="<?=set_value('message')?>" ></textarea>
                    </div>
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
<!-- email end here -->
<script language="javascript" type="text/javascript">
    function printDiv(divID) {
        //Get the HTML of div
        var divElements = document.getElementById(divID).innerHTML;
        //Get the HTML of whole page
        var oldPage = document.body.innerHTML;

        //Reset the page's HTML with div's HTML only
        document.body.innerHTML =
          "<html><head><title></title></head><body>" +
          divElements + "</body>";

        //Print Page
        window.print();

        //Restore orignal HTML
        document.body.innerHTML = oldPage;
    }
    function closeWindow() {
        location.reload();
    }

    function check_email(email) {
        var status = false;
        var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
        if (email.search(emailRegEx) == -1) {
            $("#to_error").html('');
            $("#to_error").html("<?=$this->lang->line('mail_valid')?>").css("text-align", "left").css("color", 'red');
        } else {
            status = true;
        }
        return status;
    }


    $("#send_pdf").click(function(){
        var to = $('#to').val();
        var subject = $('#subject').val();
        var message = $('#message').val();
        var id = "<?=$leave->leaveID;?>";
        var error = 0;

        if(to == "" || to == null) {
            error++;
            $("#to_error").html("");
            $("#to_error").html("<?=$this->lang->line('mail_to')?>").css("text-align", "left").css("color", 'red');
        } else {
            if(check_email(to) == false) {
                error++
            }
        }

        if(subject == "" || subject == null) {
            error++;
            $("#subject_error").html("");
            $("#subject_error").html("<?=$this->lang->line('mail_subject')?>").css("text-align", "left").css("color", 'red');
        } else {
            $("#subject_error").html("");
        }

        if(error == 0) {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('leave/send_mail')?>",
                data: 'to='+ to + '&subject=' + subject + "&id=" + id+ "&message=" + message,
                dataType: "html",
                success: function(data) {
                    location.reload();
                }
            });
        }
    });
</script>
