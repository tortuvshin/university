
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
                <input class="form-control" placeholder="Username" name="username" type="text" autofocus value="<?=set_value('username')?>">
            </div>
            <div class="form-group">
                <input class="form-control" placeholder="Password" name="password" type="password">
            </div>


            <div class="checkbox">
                <label>
                    <input type="checkbox" value="Remember Me" name="remember">
                    <span> &nbsp; Remember Me</span>
                </label>
                <span class="pull-right">
                    <label>
                        <a href="<?=base_url('reset/index')?>"> Forgot Password?</a>
                    </label>
                </span>
            </div>
            <input type="submit" class="btn btn-lg btn-success btn-block" value="SIGN IN" />
        </div>
    </form>
</div>
