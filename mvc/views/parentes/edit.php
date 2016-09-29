
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-user"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("parentes/index")?>"><?=$this->lang->line('menu_parent')?></a></li>
            <li class="active"><?=$this->lang->line('menu_edit')?> <?=$this->lang->line('menu_parent')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">

                <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">

                    <?php 
                        if(form_error('name')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="name_id" class="col-sm-2 control-label">
                            <?=$this->lang->line("parentes_guargian_name")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="name_id" name="name" value="<?=set_value('name', $parentes->name)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('name'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('father_name')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="father_name" class="col-sm-2 control-label">
                            <?=$this->lang->line("parentes_father_name")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="father_name" name="father_name" value="<?=set_value('father_name', $parentes->father_name)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('father_name'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('mother_name')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="mother_name" class="col-sm-2 control-label">
                            <?=$this->lang->line("parentes_mother_name")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="mother_name" name="mother_name" value="<?=set_value('mother_name', $parentes->mother_name)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('mother_name'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('father_profession')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="father_profession" class="col-sm-2 control-label">
                            <?=$this->lang->line("parentes_father_profession")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="father_profession" name="father_profession" value="<?=set_value('father_profession', $parentes->father_profession)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('father_profession'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('mother_profession')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="mother_profession" class="col-sm-2 control-label">
                            <?=$this->lang->line("parentes_mother_profession")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="mother_profession" name="mother_profession" value="<?=set_value('mother_profession', $parentes->mother_profession)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('mother_profession'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('email')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="email" class="col-sm-2 control-label">
                            <?=$this->lang->line("parentes_email")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="email" name="email" value="<?=set_value('email', $parentes->email)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('email'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('phone')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="phone" class="col-sm-2 control-label">
                            <?=$this->lang->line("parentes_phone")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="phone" name="phone" value="<?=set_value('phone', $parentes->phone)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('phone'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('address')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="address" class="col-sm-2 control-label">
                            <?=$this->lang->line("parentes_address")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="address" name="address" value="<?=set_value('address', $parentes->address)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('address'); ?>
                        </span>
                    </div>

                    <?php 
                        if(isset($image)) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="photo" class="col-sm-2 control-label col-xs-8 col-md-2">
                            <?=$this->lang->line("parentes_photo")?>
                        </label>
                        <div class="col-sm-4 col-xs-6 col-md-4">
                            <input class="form-control"  id="uploadFile" placeholder="Choose File" disabled />  
                        </div>

                        <div class="col-sm-2 col-xs-6 col-md-2">
                            <div class="fileUpload btn btn-success form-control">
                                <span class="fa fa-repeat"></span>
                                <span><?=$this->lang->line("upload")?></span>
                                <input id="uploadBtn" type="file" class="upload" name="image" />
                            </div>
                        </div>
                         <span class="col-sm-4 control-label col-xs-6 col-md-4">
                           
                            <?php if(isset($image)) echo $image; ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("update_parentes")?>" >
                        </div>
                    </div>

                </form>
            </div> <!-- col-sm-8 -->
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->
<script type="text/javascript">
document.getElementById("uploadBtn").onchange = function() {
    document.getElementById("uploadFile").value = this.value;
};
</script>
