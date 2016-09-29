

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-issue"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("issue/index")?>"><?=$this->lang->line('menu_issue')?></a></li>
            <li class="active"><?=$this->lang->line('menu_view')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">

                <?php if($book) { ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td colspan="2"><h4><?=$this->lang->line("issue_book_information")?></h4></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="col-sm-5"><?=$this->lang->line("issue_book")?></th>
                                <td class="col-sm-7"><?php  echo $book->book; ?></td>
                            </tr>
                            <tr>
                                <th class="col-sm-5"><?=$this->lang->line("issue_author")?></th>
                                <td class="col-sm-7"><?php  echo $book->author; ?></td>
                            </tr>
                            <tr>
                                <th class="col-sm-5"><?=$this->lang->line("issue_serial_no")?></th>
                                <td class="col-sm-7"><?php  echo $book->serial_no; ?></td>
                            </tr>
                            <tr>
                                <th class="col-sm-5"><?=$this->lang->line("issue_issue_date")?></th>
                                <td class="col-sm-7"><?php echo date("d M Y", strtotime($book->issue_date)); ?></td>
                            </tr>
                            <tr>
                                <th class="col-sm-5"><?=$this->lang->line("issue_due_date")?></th>
                                <td class="col-sm-7"><?php echo date("d M Y", strtotime($book->due_date)); ?></td>
                            </tr>
                            <tr>
                                <th class="col-sm-5"><?=$this->lang->line("issue_return_date")?></th>
                                <td class="col-sm-7">
                                    <?php
                                        if(!$book->return_date == "" && !empty($book->return_date)) {
                                           echo date("d M Y", strtotime($book->return_date));
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="col-sm-5"><?=$this->lang->line('issue_fine')?></th>
                                <td class="col-sm-7">
                                    <?php
                                        $date = date("Y-m-d");
                                        if($book->return_date == "" || empty($book->return_date)) {
                                            if(strtotime($date) > strtotime($book->due_date)) {
                                                echo $book->fine;
                                            } 
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="col-sm-5"><?=$this->lang->line("issue_note")?></th>
                                <td class="col-sm-7"><?php  echo $book->note; ?></td>
                            </tr>
                        </tbody>    
                    </table>

                <?php } ?>

            </div>
        </div>
    </div>
</div>
