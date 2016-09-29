<?php
    $usertype = $this->session->userdata("usertype");
    if($usertype == "Admin") {
?>
    <div class="well">
        <div class="row">
            <div class="col-sm-6">
                <button class="btn-cs btn-sm-cs" onclick="javascript:printDiv('printablediv')"><span class="fa fa-print"></span> <?=$this->lang->line('print')?> </button>
                <?php
                //  echo btn_add_pdf('holiday/print_preview/'.$holiday->holidayID."/", $this->lang->line('pdf_preview'))
                ?>
                <?php echo btn_sm_edit('holiday/edit/'.$holiday->holidayID."/", $this->lang->line('edit'))
                ?>
                <!-- <button class="btn-cs btn-sm-cs" data-toggle="modal" data-target="#mail"><span class="fa fa-envelope-o"></span> <?=$this->lang->line('mail')?></button> -->
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
                    <li><a href="<?=base_url("holiday/index/")?>"><?=$this->lang->line('menu_holiday')?></a></li>
                    <li class="active"><?=$this->lang->line('view')?></li>
                </ol>
            </div>
        </div>

    </div>

<?php } ?>


    <div id="printablediv" <?php if($usertype=="Admin") echo "class='admin'";?>>
        <section class="panel">

            <div class="profile-view-head-cover" style="background-image: url(<?=base_url('uploads/images/'.$holiday->photo)?>);">
              <h1 class="img-thumbnail picture-left"><?=date("d M", strtotime($holiday->fdate))?></h1>
              <?php if($holiday->fdate!=$holiday->tdate) { ?>
              <h1 class="img-thumbnail picture-right"><?=date("d M", strtotime($holiday->tdate))?></h1>
              <?php } ?>
            </div>

            <br/>
            <br/>
            <div class="panel-body profile-view-dis">
              <div class="text-center">
                <h1><?=$holiday->title?></h1>
                <h4><?=date("d M Y", strtotime($holiday->fdate))?> <?php if($holiday->fdate!=$holiday->tdate) {  echo " <b>to</b> ".date("d M Y", strtotime($holiday->tdate)); } ?></h4>
              </div>
              <br/>
              <div class="row">
                <div class="col-md-6 col-md-offset-3">
                  <?=$holiday->details?>
                </div>
              </div>

            </div>
        </section>
    </div>
