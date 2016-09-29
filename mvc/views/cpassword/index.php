
<div class="panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title"> <?=$this->lang->line('panel_title')?> </h5>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">

            	<h5 class="page-header"><a href="<?php echo base_url('subject/add') ?>"><i class="fa fa-plus"></i> 
                    <?=$this->lang->line('add_title')?></a>
                </h5>

                

                <section id="hide-table">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><?=$this->lang->line('slno')?></th>
                                <th><?=$this->lang->line('class_name')?></th>
                                <th><?=$this->lang->line('subject_name')?></th>
                                <th><?=$this->lang->line('subject_code')?></th>
                                <th><?=$this->lang->line('subject_note')?></th>
                                <th><?=$this->lang->line('action')?></th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php if(count($subjects)) {$i = 1; foreach($subjects as $subject) { ?>
	                            <tr>
	                                <td class="col-lg-1" data-title="<?=$this->lang->line('slno')?>">
	                                	<?php echo $i; ?>
	                                </td>
	                                <td class="col-lg-2" data-title="<?=$this->lang->line('class_name')?>">
	                                	<?php echo $subject->classes; ?>
	                                </td>
	                                <td class="col-lg-2" data-title="<?=$this->lang->line('subject_name')?>">
	                                	<?php echo $subject->subject; ?>
	                                </td>
                                    <td class="col-lg-2" data-title="<?=$this->lang->line('subject_code')?>">
                                        <?php echo $subject->subject_code; ?>
                                    </td>
                                    <td class="col-lg-3" data-title="<?=$this->lang->line('subject_note')?>">
                                        <?php echo $subject->note; ?>
                                    </td>
	                                <td class="col-lg-2 action" data-title='Action'>
	                                	<?php echo btn_edit('subject/edit/'.$subject->subjectID, $this->lang->line('edit')) ?>
	                                	<?php echo btn_delete('subject/delete/'.$subject->subjectID, $this->lang->line('delete')) ?>
	                                </td>
	                            </tr>
                        	<?php $i++; }} ?>
                        </tbody>
                    </table>
                </section>

                
               
            </div>
        </div>
    </div>
</div>
