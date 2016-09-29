
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-gears"></i> <?=$this->lang->line('panel_title')?></h3>


        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_setting')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">
                <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                    <?php
                        if(form_error('sname'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="sname" class="col-sm-2 control-label">
                            <?=$this->lang->line("setting_school_name")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="sname" name="sname" value="<?=set_value('sname', $setting->sname)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('sname'); ?>
                        </span>
                    </div>

                    <?php
                        if(form_error('phone'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="phone" class="col-sm-2 control-label">
                            <?=$this->lang->line("setting_school_phone")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="phone" name="phone" value="<?=set_value('phone', $setting->phone)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('phone'); ?>
                        </span>
                    </div>

                    <?php
                        if(form_error('email'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="email" class="col-sm-2 control-label">
                            <?=$this->lang->line("setting_school_email")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="email" name="email" value="<?=set_value('email', $setting->email)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('email'); ?>
                        </span>
                    </div>

                    <?php
                        if(form_error('automation'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="automation" class="col-sm-2 control-label">
                            <?=$this->lang->line("setting_school_automation")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="automation" name="automation" value="<?=set_value('automation', $setting->automation)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('automation'); ?>
                        </span>
                    </div>

                    <?php
                        if(form_error('currency_code'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="currency_code" class="col-sm-2 control-label">
                            <?=$this->lang->line("setting_school_currency_code")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="currency_code" name="currency_code" value="<?=set_value('currency_code', $setting->currency_code)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('currency_code'); ?>
                        </span>
                    </div>

                    <?php
                        if(form_error('currency_symbol'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="currency_symbol" class="col-sm-2 control-label">
                            <?=$this->lang->line("setting_school_currency_symbol")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="currency_symbol" name="currency_symbol" value="<?=set_value('currency_symbol', $setting->currency_symbol)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('currency_symbol'); ?>
                        </span>
                    </div>

                    <?php
                        if(form_error('footer'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="footer" class="col-sm-2 control-label">
                            <?=$this->lang->line("setting_school_footer")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="footer" name="footer" value="<?=set_value('footer', $setting->footer)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('footer'); ?>
                        </span>
                    </div>

                    <?php
                        if(form_error('address'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="address" class="col-sm-2 control-label">
                            <?=$this->lang->line("setting_school_address")?>
                        </label>
                        <div class="col-sm-6">
                            <textarea class="form-control" style="resize:none;" id="address" name="address"><?=set_value('address', $setting->address)?></textarea>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('address'); ?>
                        </span>
                    </div>

                    <?php
                        if(form_error('lang'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="lang" class="col-sm-2 control-label">
                            <?=$this->lang->line("setting_school_lang")?>
                        </label>
                        <div class="col-sm-6">
                            <?php
                                echo form_dropdown("language", array("english" => $this->lang->line("setting_english"),
                                "bengali" => $this->lang->line("setting_bengali"),
                                "arabic" => $this->lang->line("setting_arabic"),
                                "chinese" => $this->lang->line("setting_chinese"),
                                "french" => $this->lang->line("setting_french"),
                                "german" => $this->lang->line("setting_german"),
                                "hindi" => $this->lang->line("setting_hindi"),
                                "indonesian" => $this->lang->line("setting_indonesian"),
                                "italian" => $this->lang->line("setting_italian"),
                                "romanian" => $this->lang->line("setting_romanian"),
                                "russian" => $this->lang->line("setting_russian"),
                                "spanish" => $this->lang->line("setting_spanish"),
                                "thai" => $this->lang->line("setting_thai"),
                                "turkish" => $this->lang->line("setting_turkish"),
                                ),
                                set_value("lang", $setting->language), "id='lang' class='form-control'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('lang'); ?>
                        </span>
                    </div>

                    <?php

                        if(form_error('attendance'))

                            echo "<div class='form-group has-error' >";

                        else

                            echo "<div class='form-group' >";

                    ?>

                        <label for="address" class="col-sm-2 control-label">

                            <?=$this->lang->line("setting_school_attendance")?>

                        </label>

                        <div class="col-sm-6">

                            <?php

                                $array = array("0" => $this->lang->line("setting_school_select_attendance"),

                                          "day" => $this->lang->line("setting_school_select_day_attendance"),

                                          "subject" => $this->lang->line("setting_school_select_subject_attendance")

                                );

                                echo form_dropdown("attendance", $array, set_value("attendance",$setting->attendance), "id='attendance' class='form-control'");

                            ?>

                        </div>

                        <span class="col-sm-4 control-label">

                            <?php echo form_error('attendance'); ?>

                        </span>

                    </div>

                    <?php
                        if(isset($image))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="photo" class="col-sm-2 control-label">
                            <?=$this->lang->line("setting_school_photo")?>
                        </label>
                        <div class="col-sm-4">
                            <input class="form-control"  id="uploadFile" placeholder="Choose File" disabled />
                        </div>

                        <div class="col-sm-2">
                            <div class="fileUpload btn btn-success form-control">
                                <span class="fa fa-repeat"></span>
                                <span><?=$this->lang->line("upload_setting")?></span>
                                <input id="uploadBtn" type="file" class="upload" name="image" />
                            </div>
                        </div>
                         <span class="col-sm-4 control-label">
                            <?php if(isset($image)) echo $image; ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("update_setting")?>" >
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
document.getElementById("uploadBtn").onchange = function() {
    document.getElementById("uploadFile").value = this.value;
};
</script>
