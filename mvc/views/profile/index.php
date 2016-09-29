
<?php
    $usertype = $this->session->userdata('usertype');
    if($usertype == "Admin") {
?>
    <section class="panel">
        <div class="profile-view-head">
            <a href="#">
                <?=img(base_url('uploads/images/'.$admin->photo))?>
            </a>
            <h1><?=$admin->name?></h1>
            <p><?=$this->lang->line($this->lang->line($admin->usertype))?></p>
        </div>
        <div class="panel-body profile-view-dis">
            <h1><?=$this->lang->line("personal_information")?></h1>
            <div class="row">
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_email")?> </span>: <?=$siteinfos->email?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_phone")?> </span>: <?=$siteinfos->phone?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_address")?> </span>: <?=$siteinfos->address?></p>
                </div>
            </div>

        </div>
    </section>
<?php } elseif($usertype == "Librarian" || $usertype == "Accountant") { ?>
    <section class="panel">
        <div class="profile-view-head">
            <a href="#">
                <?=img(base_url('uploads/images/'.$user->photo))?>
            </a>

            <h1><?=$user->name?></h1>
            <p><?=$this->lang->line($user->usertype)?></p>
        </div>

        <div class="panel-body profile-view-dis">
            <h1><?=$this->lang->line("personal_information")?></h1>
            <div class="row">
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_dob")?> </span>: <?=date("d M Y", strtotime($user->dob));?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_jod")?> </span>: <?=date("d M Y", strtotime($user->jod))?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_sex")?> </span>: <?=$user->sex?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_religion")?> </span>: <?=$user->religion?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_email")?> </span>: <?=$user->email?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_phone")?> </span>: <?=$user->phone?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_address")?> </span>: <?=$user->address?></p>
                </div>
            </div>
        </div>
    </section>
<?php } elseif($usertype == "Teacher") { ?>
    <section class="panel">
        <div class="profile-view-head">
            <a href="#">
                <?=img(base_url('uploads/images/'.$teacher->photo))?>
            </a>

            <h1><?=$teacher->name?></h1>
            <p><?=$teacher->designation?></p>
        </div>
        <div class="panel-body profile-view-dis">
            <h1><?=$this->lang->line("personal_information")?></h1>
            <div class="row">
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_dob")?> </span>: <?=date("d M Y", strtotime($teacher->dob))?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_jod")?> </span>: <?=date("d M Y", strtotime($teacher->jod))?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_sex")?> </span>: <?=$teacher->sex?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_religion")?> </span>: <?=$teacher->religion?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_email")?> </span>: <?=$teacher->email?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_phone")?> </span>: <?=$teacher->phone?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_address")?> </span>: <?=$teacher->address?></p>
                </div>
            </div>
        </div>
    </section>
<?php } elseif($usertype == "Student") { ?>
    <section class="panel">

        <div class="profile-view-head">
            <a href="#">
                <?=img(base_url('uploads/images/'.$student->photo))?>
            </a>

            <h1><?=$student->name?></h1>
            <p><?=$this->lang->line("profile_classes")." ".$class->classes?></p>

        </div>
        <div class="panel-body profile-view-dis">
            <h1><?=$this->lang->line("personal_information")?></h1>
            <div class="row">
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_roll")?> </span>: <?=$student->roll?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_dob")?> </span>: <?=date("d M Y", strtotime($student->dob))?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_sex")?> </span>: <?=$student->sex?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_religion")?> </span>: <?=$student->religion?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_email")?> </span>: <?=$student->email?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_phone")?> </span>: <?=$student->phone?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_address")?> </span>: <?=$student->address?></p>
                </div>
                <?php if($usertype == "Admin") { ?>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_username")?> </span>: <?=$student->username?></p>
                </div>
                <?php } ?>
            </div>

            <h1><?=$this->lang->line("parents_information")?></h1>
            <?php   if(count($parent)) { ?>

            <div class="row">
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_guargian_name")?> </span>: <?=$parent->name?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_father_name")?> </span>: <?=$parent->father_name?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_mother_name")?> </span>: <?=$parent->mother_name?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_father_profession")?> </span>: <?=$parent->father_profession?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_mother_profession")?> </span>: <?=$parent->mother_profession?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_email")?> </span>: <?=$parent->email?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_phone")?> </span>: <?=$parent->phone?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_address")?> </span>: <?=$parent->address?></p>
                </div>
            </div>
            <?php
                } else {
                    echo "<div class='col-sm-12'><div class='col-sm-12 alert alert-warning'><span class='fa fa-exclamation-triangle'></span> " .$this->lang->line("parent_error"). "</div></div>";
                }
            ?>

        </div>
    </section>
<?php } elseif($usertype == "Parent") { ?>
    <section class="panel">
        <div class="profile-view-head">
            <a href="#">
                <?=img(base_url('uploads/images/'.$parentes->photo))?>
            </a>

            <h1><?=$parentes->name?></h1>
            <p><?=$parentes->email?></p>
        </div>
        <div class="panel-body profile-view-dis">
            <h1><?=$this->lang->line("personal_information")?></h1>
            <div class="row">
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_father_name")?> </span>: <?=$parentes->father_name?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_father_profession")?> </span>: <?=$parentes->father_profession?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_mother_name")?> </span>: <?=$parentes->mother_name?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_mother_profession")?> </span>: <?=$parentes->mother_profession?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_phone")?> </span>: <?=$parentes->phone?></p>
                </div>
                <div class="profile-view-tab">
                    <p><span><?=$this->lang->line("profile_address")?> </span>: <?=$parentes->address?></p>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
