
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-issue"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("issue/index/$set")?>"><?=$this->lang->line('menu_issue')?></a></li>
            <li class="active"><?=$this->lang->line('menu_edit')?> <?=$this->lang->line('menu_issue')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">
                <form class="form-horizontal" role="form" method="post">

                    <?php 
                        if(form_error('lid')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="lid" class="col-sm-2 control-label">
                            <?=$this->lang->line("issue_lid")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="lid" name="lid" value="<?=set_value('lid', $issue->lID)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('lid'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('book')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="book" class="col-sm-2 control-label">
                            <?=$this->lang->line("issue_book")?>
                        </label>
                        <div class="col-sm-6">

                            <input type="text" class="form-control" id="book" name="book" readonly value="<?=set_value('book', $issue->book)?>" >
                            <div class="book"><ul  class=" result"></ul></div>
                            
                        </div>


                        <span class="col-sm-4 control-label">
                            <?php echo form_error('book'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('author')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="author" class="col-sm-2 control-label">
                            <?=$this->lang->line("issue_author")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" readonly class="form-control" id="author" name="author" value="<?=set_value('author', $issue->author)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('author'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('subject_code')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="subject_code" class="col-sm-2 control-label">
                            <?=$this->lang->line("issue_subject_code")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" readonly class="form-control" id="subject_code" name="subject_code" value="<?=set_value('subject_code', $bookinfo->subject_code)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('subject_code'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('serial_no')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="serial_no" class="col-sm-2 control-label">
                            <?=$this->lang->line("issue_serial_no")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="serial_no" name="serial_no" value="<?=set_value('serial_no', $issue->serial_no)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('serial_no'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('due_date')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="due_date" class="col-sm-2 control-label">
                            <?=$this->lang->line("issue_due_date")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="due_date" name="due_date" value="<?=set_value('due_date', date("d-m-Y", strtotime($issue->due_date)))?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('due_date'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('fine')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="fine" class="col-sm-2 control-label">
                            <?=$this->lang->line("issue_fine")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="fine" name="fine" value="<?=set_value('15', $issue->fine)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('fine'); ?>
                        </span>
                    </div>
                    

                    <?php 
                        if(form_error('note')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="note" class="col-sm-2 control-label">
                            <?=$this->lang->line("issue_note")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="note" name="note" value="<?=set_value('note', $issue->note)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('note'); ?>
                        </span>
                    </div>
                    <input style="display:none;" type="text" name="bookID" id="bookID" value="<?=set_value('bookID', $issue->bookID)?>">

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("update_issue")?>" >
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$('#due_date').datepicker();
</script>
