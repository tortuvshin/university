
<?php 
    if(count($user)) {
        $usertype = $this->session->userdata("usertype");
        if($usertype == "Admin") {
?>
    <div class="well">
        <div class="row">
            <div class="col-sm-6">
                <button class="btn-cs btn-sm-cs" onclick="javascript:printDiv('printablediv')"><span class="fa fa-print"></span> <?=$this->lang->line('print')?> </button>
                <?php
                 echo btn_add_pdf('user/print_preview/'.$user->userID."/", $this->lang->line('pdf_preview')) 
                ?>

                <button class="btn-cs btn-sm-cs" data-toggle="modal" data-target="#idCard"><span class="fa fa-floppy-o"></span> <?=$this->lang->line('idcard')?> </button>

                <?php echo btn_sm_edit('user/edit/'.$user->userID."/", $this->lang->line('edit')) 
                ?>
                <button class="btn-cs btn-sm-cs" data-toggle="modal" data-target="#mail"><span class="fa fa-envelope-o"></span> <?=$this->lang->line('mail')?></button>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
                    <li><a href="<?=base_url("user/index")?>"><?=$this->lang->line('menu_user')?></a></li>
                    <li class="active"><?=$this->lang->line('view')?></li>
                </ol>
            </div>
        </div>
    </div>
    <?php } ?>
    
    <div id="printablediv">
        <section class="panel">
            <div class="profile-view-head">
                <a href="#">
                    <?=img(base_url('uploads/images/'.$user->photo))?>
                </a>

                <h1><?=$user->name?></h1>
                <p><?=$this->lang->line($user->usertype)?></p>

            </div>
            <div class="panel-body profile-view-dis">
                <h1><?=$this->lang->line("personal_information")?></h1>
                <div class="row">
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("user_dob")?> </span>: <?=date("d M Y", strtotime($user->dob));?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("user_jod")?> </span>: <?=date("d M Y", strtotime($user->jod))?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("user_sex")?> </span>: <?=$user->sex?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("user_religion")?> </span>: <?=$user->religion?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("user_email")?> </span>: <?=$user->email?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("user_phone")?> </span>: <?=$user->phone?></p>
                    </div>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("user_address")?> </span>: <?=$user->address?></p>
                    </div>
                    <?php if($usertype == "Admin") { ?>
                    <div class="profile-view-tab">
                        <p><span><?=$this->lang->line("user_username")?> </span>: <?=$user->username?></p>
                    </div>
                    <?php } ?>
                </div>

            </div>
        </section>
    </div>


    <?php if($usertype == "Admin") { ?>

    <!-- Modal content start here -->
    <div class="modal fade" id="idCard">
      <div class="modal-dialog">
        <div class="modal-content">
            <div id="idCardPrint">
              <div class="modal-header">
                <?=$this->lang->line('idcard')?>
              </div>
              <div class="modal-body" > 
                    <table>
                        <tr>
                            <td>
                                <h4 style="margin:0;">
                                <?php 
                                    if($siteinfos->photo) {
                                        $array = array(
                                            "src" => base_url('uploads/images/'.$siteinfos->photo),
                                            'width' => '25px',
                                            'height' => '25px',
                                            "style" => "margin-bottom:10px;"
                                        );
                                        echo img($array);
                                    }
                                ?>
                                </h4>
                            </td>
                            <td style="padding-left:5px;">
                                <h4><?=$siteinfos->sname;?></h4>
                            </td>
                        </tr>
                    </table>

                <table class="idcard-Table">
                    <tr>
                        <td>
                            <h4>
                                <?php 
                                    echo img(base_url('uploads/images/'.$user->photo));
                                ?>
                            </h4> 
                        </td>
                        <td class="row-style">
                            <h3><?php  echo $user->name; ?></h3>
                            <h5><?php  echo $this->lang->line("user_email")." : ".$user->email; ?>
                            </h5>
                            <h5>
                                <?php  echo $this->lang->line("user_phone")." : ".$user->phone; ?>
                            </h5>
                        </td>
                    </tr>
                </table>    
              </div>
            </div>
          <div class="modal-footer">
            <button type="button" style="margin-bottom:0px;" class="btn btn-default" data-dismiss="modal" onclick="javascript:closeWindow()"><?=$this->lang->line('close')?></button>
            <button type="button" class="btn btn-success" onclick="javascript:printDiv('idCardPrint')"><?=$this->lang->line('print')?></button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal content End here -->

<!-- email modal starts here -->
<form class="form-horizontal" role="form" action="<?=base_url('teacher/send_mail');?>" method="post">
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
            var id = "<?=$user->userID?>";
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
                    url: "<?=base_url('user/send_mail')?>",
                    data: 'to='+ to + '&subject=' + subject + "&id=" + id+ "&message=" + message,
                    dataType: "html",
                    success: function(data) {
                        location.reload();
                    }
                });
            }
        });
    </script>

    <?php } ?>

<?php } ?>