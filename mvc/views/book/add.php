
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-lbooks"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("book/index")?>"><?=$this->lang->line('menu_books')?></a></li>
            <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('menu_books')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">
                 <form class="form-horizontal" role="form" method="post">
                   <?php 
                        if(form_error('book')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="book" class="col-sm-2 control-label">
                            <?=$this->lang->line("book_name")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="book" name="book" value="<?=set_value('book')?>" >
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
                            <?=$this->lang->line("book_author")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="author" name="author" value="<?=set_value('author')?>" >
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
                            <?=$this->lang->line("book_subject_code")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="subject_code" name="subject_code" value="<?=set_value('subject_code')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('subject_code'); ?>
                        </span>
                    </div>

                   

                    <?php 
                        if(form_error('price')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="price" class="col-sm-2 control-label">
                            <?=$this->lang->line("book_price")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="price" name="price" value="<?=set_value('price')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('price'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('quantity')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="quantity" class="col-sm-2 control-label">
                            <?=$this->lang->line("book_quantity")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="quantity" name="quantity" value="<?=set_value('quantity')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('quantity'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('rack')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="rack" class="col-sm-2 control-label">
                            <?=$this->lang->line("book_rack_no")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="rack" name="rack" value="<?=set_value('rack')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('rack'); ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("add_book")?>" >
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
