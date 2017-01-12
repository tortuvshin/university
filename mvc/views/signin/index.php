
<div class="form-box" id="login-box">
    <div class="header"><?=$this->lang->line('signin')?></div>
    <form method="post">

        <!-- style="margin-top:40px;" -->

        <div class="body white-bg">
        <?php
            if($form_validation == "No"){
            } else {
                if(count($form_validation)) {
                    echo "<div class=\"alert alert-danger alert-dismissable\">
                        <i class=\"fa fa-ban\"></i>
                        <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
                        $form_validation
                    </div>";
                }
            }
            if($this->session->flashdata('reset_success')) {
                $message = $this->session->flashdata('reset_success');
                echo "<div class=\"alert alert-success alert-dismissable\">
                    <i class=\"fa fa-ban\"></i>
                    <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
                    $message
                </div>";
            }
        ?>
            <div class="form-group">
                 <input class="form-control" placeholder="<?=$this->lang->line('signin_username')?>" name="username" type="text" autofocus value="<?=set_value('username')?>">
            </div>
            <div class="form-group">
                 <input class="form-control" placeholder="<?=$this->lang->line('signin_password')?>" name="password" type="password">
            </div>


            <div class="checkbox">
                <label>
                    <input type="checkbox" value="Remember Me" name="remember">
                     <span> &nbsp; <?=$this->lang->line('signin_remember_me')?></span>
                </label>
                <span class="pull-right">
                    <label>
                       <a href="<?=base_url('reset/index')?>"> <?=$this->lang->line('signin_forgot')?>?</a>
                    </label>
                </span>
            </div>
            <input type="submit" class="btn btn-lg btn-success btn-block" value="<?=$this->lang->line('signin_value')?>" />
        </div>
    </form>
</div>
