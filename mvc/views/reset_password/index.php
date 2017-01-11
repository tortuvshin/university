
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-reset_password"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_reset_password')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">
                <form class="form-horizontal" role="form" method="post">

                    <?php 
                        if(form_error('users')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="classesID" class="col-sm-2 control-label">
                            <?=$this->lang->line("reset_password_users")?>
                        </label>
                        <div class="col-sm-6">
                           <?php
                                $tables = array('student' => 'student', 'parent' => 'parent', 'teacher' => 'teacher', 'user' => 'user', 'systemadmin' => 'systemadmin');
                                $array = array(
                                    0 => $this->lang->line("reset_password_select_users"),
                                    'Admin' => $this->lang->line("Admin"),
                                    'Accountant' =>  $this->lang->line("Accountant"),
                                    'Librarian' => $this->lang->line("Librarian"),
                                    'Parent' => $this->lang->line("Parent"),
                                    'Student' => $this->lang->line("Student"),
                                    'Teacher' => $this->lang->line("Teacher")
                                );
                                echo form_dropdown("users", $array, set_value("users"), "id='users' class='form-control'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('users'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('username')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="guargianID" class="col-sm-2 control-label">
                            <?=$this->lang->line("reset_password_username")?>
                        </label>
                        <div class="col-sm-6">
                            <div class="select2-wrapper">

                                <?php
                                    $array = array();
                                    $array[0] = $this->lang->line("reset_password_select_username");
               
                                    if($usernames != "empty") {
                                        foreach ($usernames as $usernamea) {
                                            if($usernamea->usertype == "Admin") {
                                                $array[$usernamea->systemadminID] = $usernamea->username;
                                            } elseif($usernamea->usertype == "Teacher") {
                                                $array[$usernamea->teacherID] = $usernamea->username;
                                            } elseif($usernamea->usertype == "Student") {
                                                $array[$usernamea->studentID] = $usernamea->username;
                                            } elseif($users == "Accountant") {
                                                $array[$usernamea->userID] = $usernamea->username;
                                            } elseif($users == "Librarian") {
                                                $array[$usernamea->userID] = $usernamea->username;
                                            } elseif($users == 'Parents') { 
                                                $array[$usernamea->parentID] = $usernamea->username;
                                            }
                                        }
                                    }

                                    $usrID = 0;
                                    if($username == 0) {
                                        $usrID = 0;
                                    } else {
                                        $usrID = $username;
                                    }

                                    echo form_dropdown("username", $array, set_value("username", $usrID), "id='username' class='form-control guargianID select2-offscreen'");
                                ?>

                            </div>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('username'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('new_password')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="password" class="col-sm-2 control-label">
                            <?=$this->lang->line("reset_password_new_password")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="new_password" name="new_password" value="<?=set_value('new_password')?>" >
                        </div>
                         <span class="col-sm-4 control-label">
                            <?php echo form_error('new_password'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('re_password')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="password" class="col-sm-2 control-label">
                            <?=$this->lang->line("reset_password_re_password")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="re_password" name="re_password" value="<?=set_value('re_password')?>" >
                        </div>
                         <span class="col-sm-4 control-label">
                            <?php echo form_error('re_password'); ?>
                        </span>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("reset_password")?>" >
                        </div>
                    </div>

                </form>


            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

$('#users').click(function(event) {
    var users = $(this).val();
    if(users === '0') {
        $('#users').val(0);
    } else {
        $.ajax({
            type: 'POST',
            url: "<?=base_url('reset_password/userscall')?>",
            data: "users=" + users,
            dataType: "html",
            success: function(data) {
               $('#username').html(data);
            }
        });
    }
});

</script>

