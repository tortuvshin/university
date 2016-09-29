
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5 class="panel-title"> <?=$this->lang->line('panel_title')?> </h5>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-8">
                    <form class="form-horizontal" role="form" method="post">
                        <?php 
                            if(form_error('classesID')) 
                                echo "<div class='form-group has-error' >";
                            else     
                                echo "<div class='form-group' >";
                        ?>
                            <label for="classesID" class="col-sm-2 control-label">
                                <?=$this->lang->line("class_name")?>
                            </label>
                            <div class="col-sm-6">
                                
                                <?php
                                    $array = array();
                                    foreach ($classes as $classa) {
                                        $array[$classa->classesID] = $classa->classes;
                                    }
                                    echo form_dropdown("classesID", $array, set_value("classesID", $subject->classesID), "id='classesID' class='form-control'");
                                ?>
                            </div>
                            <span class="col-sm-4 control-label">
                                <?php echo form_error('classesID'); ?>
                            </span>
                        </div>

                        <?php 
                            if(form_error('subject')) 
                                echo "<div class='form-group has-error' >";
                            else     
                                echo "<div class='form-group' >";
                        ?>
                            <label for="subject" class="col-sm-2 control-label">
                                <?=$this->lang->line("subject_name")?>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="subject" name="subject" value="<?=set_value('subject', $subject->subject)?>" >
                            </div>
                            <span class="col-sm-4 control-label">
                                <?php echo form_error('subject'); ?>
                            </span>
                        </div>

                        <?php 
                            if(form_error('subject_code')) 
                                echo "<div class='form-group has-error' >";
                            else     
                                echo "<div class='form-group' >";
                        ?>
                            <label for="subject_code" class="col-sm-2 control-label">
                                <?=$this->lang->line("subject_code")?>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="subject_code" name="subject_code" value="<?=set_value('subject_code', $subject->subject_code)?>" >
                            </div>
                            <span class="col-sm-4 control-label">
                                <?php echo form_error('subject_code'); ?>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="note" class="col-sm-2 control-label">
                                <?=$this->lang->line("subject_note")?>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="note" name="note" value="<?=set_value('note', $subject->note)?>" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
                                <input type="submit" class="btn btn-success" value="<?=$this->lang->line("update_subject")?>" >
                            </div>
                        </div>

                    </form>
                </div>    
            </div>
        </div>
    </div>
</div>
