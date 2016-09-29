

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-lbooks"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_books')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <?php
                    $usertype = $this->session->userdata("usertype");
                    if($usertype == "Admin" || $usertype == "Librarian") {
                ?>
                    <h5 class="page-header">
                        <a href="<?php echo base_url('book/add') ?>">
                            <i class="fa fa-plus"></i> 
                            <?=$this->lang->line('add_title')?>
                        </a>
                    </h5>
                <?php } ?>


                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th class="col-sm-1"><?=$this->lang->line('slno')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('book_name')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('book_author')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('book_subject_code')?></th>
                                <?php if($usertype == "Admin" || $usertype == "Librarian") { ?>
                                <th class="col-sm-1"><?=$this->lang->line('book_price')?></th>
                                <?php } ?>
                                <?php if($usertype == "Admin" || $usertype == "Librarian") { ?>
                                <th class="col-sm-1"><?=$this->lang->line('book_quantity')?></th>
                                <?php } ?>
                                <th class="col-sm-1"><?=$this->lang->line('book_rack_no')?></th>
                                <th class="col-sm-1"><?=$this->lang->line('book_status')?></th>
                                <?php if($usertype == "Admin") { ?>
                                <th class="col-sm-1"><?=$this->lang->line('action')?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($books)) {$i = 1; foreach($books as $book) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>

                                    <td data-title="<?=$this->lang->line('book_name')?>">
                                        <?php echo $book->book; ?>
                                    </td>

                                    <td data-title="<?=$this->lang->line('book_author')?>">
                                        <?php echo $book->author; ?>
                                    </td>

                                    <td data-title="<?=$this->lang->line('book_subject_code')?>">
                                        <?php echo $book->subject_code; ?>
                                    </td>
                                    
                                    <?php if($usertype == "Admin" || $usertype == "Librarian") { ?>
                                    <td data-title="<?=$this->lang->line('book_price')?>">
                                        <?php echo $book->price; ?>
                                    </td>
                                    <?php } ?>

                                    <?php if($usertype == "Admin" || $usertype == "Librarian") { ?>
                                    <td data-title="<?=$this->lang->line('book_quantity')?>">
                                        <?php echo $book->quantity; ?>
                                    </td>
                                    <?php } ?>


                                    <td data-title="<?=$this->lang->line('book_rack_no')?>">
                                        <?php echo $book->rack; ?>
                                    </td>

                                    <td data-title="<?=$this->lang->line('book_status')?>">
                                        <?php 
                                            if($book->quantity == $book->due_quantity) {
                                                echo "<button class='btn btn-danger btn-xs'>" . $this->lang->line('book_unavailable') . "</button>";
                                            } else {
                                                echo "<button class='btn btn-success btn-xs'>" . $this->lang->line('book_available') . "</button>";
                                            }
                                        ?>
                                    </td>

                                    <?php if($usertype == "Admin") { ?>
                                    <td data-title="<?=$this->lang->line('action')?>">
                                        <?php echo btn_edit('book/edit/'.$book->bookID, $this->lang->line('edit')) ?>
                                        <?php echo btn_delete('book/delete/'.$book->bookID, $this->lang->line('delete')) ?>
                                    </td>
                                    <?php } ?>
                                </tr>
                            <?php $i++; }} ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
