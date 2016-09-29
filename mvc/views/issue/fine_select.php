
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-fine"></i> <?=$this->lang->line('menu_fine')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_fine')?></li>
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
                                <label for="day" class="col-sm-2 col-sm-offset-2 control-label">
                                    <?=$this->lang->line('issue_day')?>
                                </label>
                                <div class="col-sm-6">
                                    <select name="day" class="form-control" id="day">
                                        <option value="0"><?=$this->lang->line('issue_select_day')?></option>
                                        <?php
                                            for ($i=1; $i <=31 ; $i++) { 
                                                echo "<option value='$i'>". $i ."</option>";
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
                                                echo "<option value='$i'>". $array[$i] ."</option>";
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
                                                echo "<option value='$i'>". $i ."</option>";
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

            </div>
        </div>
    </div>
</div>


