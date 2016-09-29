
<?php 
    if(count($invoice)) {
        $usertype = $this->session->userdata("usertype");
        if($usertype == "Admin" || $usertype == "Accountant" || $usertype == "Student" || $usertype == "Parent") {
?>
	<?php if($usertype == "Admin" || $usertype == "Accountant") { ?>
    <div class="well">
        <div class="row">

            <div class="col-sm-6">
                <button class="btn-cs btn-sm-cs" onclick="javascript:printDiv('printablediv')"><span class="fa fa-print"></span> <?=$this->lang->line('print')?> </button>
                <?php
                 echo btn_add_pdf('invoice/print_preview/'.$invoice->invoiceID, $this->lang->line('pdf_preview')) 
                ?>
                <?php
                    if($invoice->paidamount != $invoice->amount) {
                        echo btn_payment('invoice/payment/'.$invoice->invoiceID, $this->lang->line('payment')); 
                    }
                ?>
                <button class="btn-cs btn-sm-cs" data-toggle="modal" data-target="#mail"><span class="fa fa-envelope-o"></span> <?=$this->lang->line('mail')?></button>                
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
                    <li><a href="<?=base_url("invoice/index")?>"><?=$this->lang->line('menu_invoice')?></a></li>
                    <li class="active"><?=$this->lang->line('view')?></li>
                </ol>
            </div>
        </div>
    </div>
    <?php } elseif($usertype == "Student" || $usertype == "Parent") { ?>
        <?php if($invoice->paidamount != $invoice->amount) { ?>
        <div class="well">
            <div class="row">
                <div class="col-sm-6">
                    <?=btn_payment('invoice/payment/'.$invoice->invoiceID, $this->lang->line('payment')); ?>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
                        <li><a href="<?=base_url("invoice/index")?>"><?=$this->lang->line('menu_invoice')?></a></li>
                        <li class="active"><?=$this->lang->line('view')?></li>
                    </ol>
                </div>
            </div>
        </div>
        <?php } ?>
    <?php } ?>

<div id="printablediv">
	<section class="content invoice" >
		<!-- title row -->
		<div class="row">
		    <div class="col-xs-12">
		        <h2 class="page-header">
		            <?php
	                    if($siteinfos->photo) {
		                    $array = array(
		                        "src" => base_url('uploads/images/'.$siteinfos->photo),
		                        'width' => '25px',
		                        'height' => '25px',
		                        'class' => 'img-circle'
		                    );
		                    echo img($array);
		                } 
	                ?>
	                <?php  echo $siteinfos->sname; ?>
		            <small class="pull-right"><?=$this->lang->line('invoice_create_date').' : '.date('d M Y')?></small>
		        </h2>
		    </div><!-- /.col -->
		</div>
		<!-- info row -->
		<div class="row invoice-info">
		    <div class="col-sm-4 invoice-col">
		   
				<?php  echo $this->lang->line("invoice_from"); ?>
				<address>
					<strong><?=$siteinfos->sname?></strong><br>
					<?=$siteinfos->address?><br>
					<?=$this->lang->line("invoice_phone"). " : ". $siteinfos->phone?><br>
					<?=$this->lang->line("invoice_email"). " : ". $siteinfos->email?><br>
				</address>
	            

		    </div><!-- /.col -->
		    <div class="col-sm-4 invoice-col">
		        <?php if(count($student) == "") { ?>
		        	<?=$this->lang->line("invoice_to")?>
		        	<address>
		        		<?=$this->lang->line("invoice_sremove")?>
		        	</address>
		        <?php } else { ?>
		        	<?=$this->lang->line("invoice_to")?>
		        	<address>
		        		<strong><?=$student->name?></strong><br>
		        		<?=$this->lang->line("invoice_roll"). " : ". $invoice->roll?><br>
		        		<?=$this->lang->line("invoice_classesID"). " : ". $invoice->classes?><br>
		        		<?=$this->lang->line("invoice_email"). " : ". $student->email?><br>
		        	</address>
		        <?php } ?>

		    </div><!-- /.col -->
		    <div class="col-sm-4 invoice-col">
		        <b><?=$this->lang->line("invoice_invoice").$invoice->invoiceID?></b><br>
		        <?php
                    if($invoice->paiddate) {
                        echo "<b>".$this->lang->line("invoice_pdate")." :  </b>". date("d M Y", strtotime($invoice->paiddate)).'<br/>';
                    }
                ?>
                <?php 
                    $status = $invoice->status;
                    $setstatus = '';
                    if($status == 0) {
                        $status = $this->lang->line('invoice_notpaid');
                    } elseif($status == 1) {
                        $status = $this->lang->line('invoice_partially_paid');
                    } elseif($status == 2) {
                        $status = $this->lang->line('invoice_fully_paid');
                    }

                    echo $this->lang->line('invoice_status'). " : ". "<button class='btn btn-success btn-xs'>".$status."</button>";
                ?>

		    </div><!-- /.col -->
		</div><!-- /.row -->

		<!-- Table row -->
        <br />
		<div class="row">
			<div class="col-xs-12" id="hide-table">
		        <table class="table table-striped">
		            <thead>
		                <tr>
		                    <th class="col-lg-1"><?=$this->lang->line('slno')?></th>
		                    <th class="col-lg-9"><?=$this->lang->line('invoice_feetype')?></th>
		                    <th class="col-lg-2"><?=$this->lang->line('invoice_total')?></th>
		                </tr>
		            </thead>
		            <tbody>
		                <tr>
		                    <td data-title="<?=$this->lang->line('slno')?>">
		                        <?php echo 1; ?>
		                    </td>
		                    <td data-title="<?=$this->lang->line('invoice_feetype')?>">
		                        <?php echo $invoice->feetype ?>
		                    </td>
		                    <td data-title="<?=$this->lang->line('invoice_subtotal')?>">
                                <?php echo $invoice->amount; ?>
		                    </td>
		                </tr>
		            </tbody>
		        </table>
		    </div>
		</div><!-- /.row -->

		<div class="row">
		    <!-- accepted payments column -->
		    <div class="col-sm-6">
		    </div><!-- /.col -->
		    <div class="col-xs-12 col-sm-6 col-lg-6 col-md-18">
		        <p class="lead"><?=$this->lang->line('invoice_amount')?></p>
		        <div class="table-responsive">
		            <table class="table">
		                <tr>
                            <th class="col-sm-8 col-xs-8"><?=$this->lang->line('invoice_subtotal')?></th>
                            <td class="col-sm-4 col-xs-4"><?=$invoice->amount?></td>
		                </tr>
		            </table>
                    <?php if(empty($invoice->paidamount) && $invoice->paidamount == 0) { ?>
                        <table class="table">
                            <tr>
                                <th class="col-sm-8 col-xs-8"><?=$this->lang->line('invoice_total')." (".$siteinfos->currency_code.")";?></th>
                                <td class="col-sm-4 col-xs-4"><?=$siteinfos->currency_symbol." ".$invoice->amount?></td>
                            </tr>
                        </table>
                    <?php } else { if($invoice->amount == $invoice->paidamount && $invoice->status == 2) { ?>
                        <table class="table">
                            <tr>
                                <th class="col-sm-8 col-xs-8"><?=$this->lang->line('invoice_total')." (".$siteinfos->currency_code.")";?></th>
                                <td class="col-sm-4 col-xs-4"><?=$siteinfos->currency_symbol." ".$invoice->amount?></td>
                            </tr>
                        </table>
                    <?php } elseif($invoice->amount > $invoice->paidamount && $invoice->status == 1) { ?>
                        <table class="table">
                            <tr>
                                <th class="col-sm-8 col-xs-8"><?=$this->lang->line('invoice_made');?></th>
                                <td class="col-sm-4 col-xs-4"><?=$invoice->paidamount?></td>
                            </tr>
                        </table>

                        <table class="table">
                            <tr>
                                <th class="col-sm-8 col-xs-8"><?=$this->lang->line('invoice_due')." (".$siteinfos->currency_code.")";?></th>
                                <?php $due = $invoice->amount-$invoice->paidamount; ?>
                                <td class="col-sm-4 col-xs-4"><?=$siteinfos->currency_symbol." ".$due?></td>
                            </tr>
                        </table>
                    <?php } else { ?>
                    <table class="table">
                        <tr>
                            <th class="col-sm-8 col-xs-8"><?=$this->lang->line('invoice_due')." (".$siteinfos->currency_code.")";?></th>
                            <?php $due = $invoice->amount-$invoice->paidamount; ?>
                            <td class="col-sm-4 col-xs-4"><?=$siteinfos->currency_symbol." ".$due?></td>
                        </tr>
                    </table>
                    <?php } } ?>

		        </div>
		    </div><!-- /.col -->
		</div><!-- /.row -->

		<!-- this row will not appear when printing -->
	</section><!-- /.content -->
</div>
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
                        <textarea class="form-control" id="message" name="message" style="resize: vertical;" value="<?=set_value('message')?>" ></textarea>
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
        var id = "<?=$invoice->invoiceID;?>";
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
                url: "<?=base_url('invoice/send_mail')?>",
                data: 'to='+ to + '&subject=' + subject + "&id=" + id+ "&message=" + message,
                dataType: "html",
                success: function(data) {
                    location.reload();
                }
            });
        }
    });
    
</script>
<?php }} ?>
