
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-promotion"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_promotion')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">


                <div class="col-sm-6 col-sm-offset-3 list-group">
                    <div class="list-group-item list-group-item-warning">
                        <form style="" class="form-horizontal" role="form" method="post">  
                            <div class="form-group">              
                                <label for="classesID" class="col-sm-2 col-sm-offset-2 control-label">
                                    <?=$this->lang->line("promotion_classes")?>
                                </label>
                                <div class="col-sm-6">
                                    <?php
                                        $array = array("0" => $this->lang->line("promotion_select_class"));
                                        foreach ($classes as $classa) {
                                            $array[$classa->classesID] = $classa->classes;
                                        }
                                        echo form_dropdown("classesID", $array, set_value("classesID", $set), "id='classesID' class='form-control'");
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-sm-6 col-sm-offset-3 list-group">
                    <div class="list-group-item list-group-item-warning">
                        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                            <?php 
                                $mark=array();
                                $promotionsID = array(); 
                                foreach ($promotionsubjects as $key => $promotionsubject) {
                                    $mark[$promotionsubject->subjectID] = $promotionsubject->subjectMark;
                                    $promotionsID[$promotionsubject->subjectID] = $promotionsubject->promotionSubjectID;

                                }
                                
                                if(count($promotionsID)) {
                                    foreach ($subjects as $key => $subject) {    
                            ?>
                                <div class="form-group">
                                    <label for="<?php if(isset($promotionsID[$subject->subjectID])) echo $promotionsID[$subject->subjectID]; else echo "0";?>" class="col-sm-2 col-sm-offset-2 control-label">
                                        <?=$subject->subject?>
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="<?php if(isset($promotionsID[$subject->subjectID])) echo $promotionsID[$subject->subjectID]; else echo "0";?>" name="<?php if(isset($promotionsID[$subject->subjectID])) echo $promotionsID[$subject->subjectID]; else echo "0";?>" value="<?php if(isset($promotionsID[$subject->subjectID])) echo set_value($subject->subjectID, $mark[$subject->subjectID])?>" >
                                    </div>
                                    <span class="col-sm-4 col-sm-offset-4 control-label">
                                        <?php if(isset($promotionsID[$subject->subjectID])) echo form_error($promotionsID[$subject->subjectID]); ?>
                                    </span>

                                </div>
                            <?php } } ?>

                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-4">
                                    <input type="submit" class="btn btn-success" value="<?=$this->lang->line("add_mark_setting")?>" >
                                </div>
                            </div>

                        </form>
                    <div>
                </div>

            </div> <!-- col-sm-12 -->
            
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->

<script type="text/javascript">
    $('#classesID').change(function() {
        var classesID = $(this).val();
        if(classesID == 0) {
            $('#hide-table').hide();
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('promotion/promotion_list')?>",
                data: "id=" + classesID,
                dataType: "html",
                success: function(data) {
                    window.location.href = data;
                }
            });
        }
    });
</script>