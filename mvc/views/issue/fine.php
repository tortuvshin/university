
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-fine"></i> <?=$this->lang->line('menu_fine')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("issue/fine")?>"><?=$this->lang->line('menu_fine')?></a></li>
            <li class="active"><?=$this->lang->line('menu_view')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <div class="col-sm-6 col-sm-offset-3 list-group">
                    <div class="list-group-item list-group-item-warning">
                        <form class="form-horizontal" role="form" method="post">

                            <div class="form-group">
                                <label for="lid" class="col-sm-2 col-sm-offset-2 control-label">
                                    <?=$this->lang->line('issue_day')?>
                                </label>
                                <div class="col-sm-6">
                                    <select name="day" class="form-control" id="day">
                                        <option value="0"><?=$this->lang->line('issue_select_day')?></option>
                                        <?php

                                            for ($i=1; $i <=31 ; $i++) { 
                                                if($i == $day) {
                                                    echo "<option value='$i' selected='selected'>". $i ."</option>";
                                                } else {
                                                    echo "<option value='$i'>". $i ."</option>";
                                                }
                                                
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="month" class="col-sm-2 col-sm-offset-2 control-label">
                                    <?=$this->lang->line('issue_month')?>
                                </label>
                                <div class="col-sm-6">
                                    <select name="month" class="form-control" id="month">
                                        <option value="0"><?=$this->lang->line('issue_select_month')?></option>
                                        <?php
                                            $array = array($this->lang->line('slno'), "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
                                            for ($i=1; $i <=12 ; $i++) { 
                                                if($i == $month) {
                                                    echo "<option value='$i' selected='selected'>". $array[$i] ."</option>";
                                                } else {
                                                    echo "<option value='$i'>". $array[$i] ."</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="year" class="col-sm-2 col-sm-offset-2 control-label">
                                    <?=$this->lang->line('issue_year')?>
                                </label>
                                <div class="col-sm-6">
                                    <select name="year" class="form-control" id="year">
                                        <option value="0"><?=$this->lang->line('issue_select_year')?></option>
                                        <?php
                                            $pyear = date("Y");
                                            for ($i=$pyear; $i >=1990 ; $i--) { 
                                                if($i == $year) {
                                                    echo "<option value='$i' selected='selected'>". $i ."</option>";
                                                } else {
                                                    echo "<option value='$i'>". $i ."</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <input type="submit" class="btn btn-success" value="<?=$this->lang->line('add_fine')?>" >
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

                <?php if(count($fines)) { ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="well">
                            <div class="row">
                                <div class="col-sm-6">
                                    <button class="btn-cs btn-sm-cs" onclick="javascript:printDiv('printablediv')"><span class="fa fa-print"></span> <?=$this->lang->line('issue_print')?> </button>
                                    <?php
                                        echo btn_add_pdf("issue/print_preview/$url", $this->lang->line('issue_printpreview'));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="printablediv">
                    <div id="hide-table">
                        <table class="table table-striped table-bordered dataTable no-footer">
                            <thead>
                                <tr>
                                    <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                    <th class="col-sm-2"><?=$this->lang->line('issue_lid')?></th>
                                    <th class="col-sm-2"><?=$this->lang->line('issue_book')?></th>
                                    <th class="col-sm-2"><?=$this->lang->line('issue_due_date')?></th>
                                    <th class="col-sm-2"><?=$this->lang->line('issue_return_date')?></th>
                                    <th class="col-sm-2"><?=$this->lang->line('issue_fine')?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $total_fine = 0;
                                    if(count($fines)) {$i = 1; foreach($fines as $fine) {
                                        if(strtotime($fine->return_date) > strtotime($fine->due_date)) {
                                            $total_fine += $fine->fine;
                                ?>
                                    <tr>
                                        <td data-title="<?=$this->lang->line('slno')?>">
                                            <?php echo $i; ?>
                                        </td>
                                        <td data-title="<?=$this->lang->line('issue_lid')?>">
                                            <?php echo $fine->lID; ?>
                                        </td>
                                        <td data-title="<?=$this->lang->line('issue_book')?>">
                                            <?php echo $fine->book; ?>
                                        </td>
                                        <td data-title="<?=$this->lang->line('issue_due_date')?>">
                                            <?php echo date("d M Y", strtotime($fine->due_date)); ?>
                                        </td>
                                        <td data-title="<?=$this->lang->line('issue_return_date')?>">
                                            <?php echo date("d M Y", strtotime($fine->return_date)); ?>
                                        </td>
                                        <td data-title="<?=$this->lang->line('issue_fine')?>">
                                            <?php echo $fine->fine; ?>
                                        </td>
                                    </tr>
                                <?php $i++; }}} ?>

                            </tbody>
                        </table>
                    </div>

        
                    <div class="col-sm-4 col-sm-offset-8 total-marg">
                        <div class="well well-sm">
                            <table style="width:100%; margin:0px;">
                                <tr>
                                    <td width="50%">
                                        <?php
                                            echo $this->lang->line('issue_total');
                                        ?>
                                    </td>
                                    <td style="width:50%;padding-left:10px">
                                        <?php
                                            echo $total_fine. " TK"; 
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>

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
</script>









