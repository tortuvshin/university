        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?php echo base_url('dashboard/index'); ?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <?php if(count($siteinfos)) { echo $siteinfos->sname; } ?>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <?php
                                    $alCounter = 0; 
                                    if(count($alert) > 0) {
                                        $alCounter += count($alert);
                                        echo "<span class='label label-danger'>";
                                            echo "<lable class='alert-image'>".count($alert)."</lable>";
                                        echo "</span>";
                                    } 
                                ?>
                            </a>
                            <?php
                                if(count($alert) > 0) {
                                    $pdate = date("Y-m-d H:i:s");
                                    $title = '';
                                    $discription = '';
                                    $i = 1;
                                    echo "<ul class='dropdown-menu'>";
                                        echo "<li class='header'>";
                                            echo $this->lang->line("la_fs")." ".$alCounter ." ".$this->lang->line("la_ls");
                                        echo '</li>';
                                        echo '<li>';
                                            echo "<ul class='menu'>";
                                                foreach ($alert as $alt) {
                                                    if(strlen($alt->title) > 16) {
                                                       $title = substr($alt->title, 0,16). ".."; 
                                                    } else {
                                                        $title = $alt->title;
                                                    }
                                                    if(strlen($alt->notice) > 30) {
                                                       $discription = substr($alt->notice, 0,30). ".."; 
                                                    } else {
                                                        $discription = $alt->notice;
                                                    }
                                                    echo '<li>';
	                                                    echo "<a href=".base_url("notice/view")."/".$alt->noticeID.">";
	                                                        echo "<div class='pull-left'>" ;
	                                                            echo "<img class='img-circle' src='".base_url('uploads/images/'.$siteinfos->photo)."'>";
	                                                        echo '</div>';
	                                                        echo '<h4>';
	                                                            echo strip_tags($title) ;
	                                                                echo "<small><i class='fa fa-clock-o'></i> ";
	                                                                    $dafstdate = $alt->create_date;
	                                                                    $first_date = new DateTime($alt->create_date);
	                                                                    $second_date = new DateTime($pdate);
	                                                                    $difference = $first_date->diff($second_date);
	                                                                    if($difference->y >= 1) {
	                                                                        $format = 'Y-m-d H:i:s';
	                                                                        $date = DateTime::createFromFormat($format, $dafstdate);
	                                                                        echo $date->format('M d Y');
	                                                                    } elseif($difference->m ==1 && $difference->m !=0) {
	                                                                        echo $difference->m . " month";
	                                                                    } elseif($difference->m <=12 && $difference->m !=0) {
	                                                                        echo $difference->m . " months";
	                                                                    } elseif($difference->d == 1 && $difference->d != 0) {
	                                                                        echo "Yesterday";
	                                                                    } elseif($difference->d <= 31 && $difference->d != 0) {
	                                                                        echo $difference->d . " days";
	                                                                    } else if($difference->h ==1 && $difference->h !=0) {
	                                                                        echo $difference->h . " hr";
	                                                                    } else if($difference->h <=24 && $difference->h !=0) {
	                                                                        echo $difference->h . " hrs";
	                                                                    } elseif($difference->i <= 60 && $difference->i !=0) {
	                                                                      echo $difference->i . " mins";
	                                                                    } elseif($difference->s <= 10) {
	                                                                      echo "Just Now";
	                                                                    } elseif($difference->s <= 60 && $difference->s !=0) {
	                                                                      echo $difference->s . " sec";
	                                                                    }
	                                                                echo '</small>';
	                                                        echo '</h4>';
	                                                        echo '<p>'. strip_tags($discription).'</p>';
	                                                    echo '</a>';
                                                    echo '</li>';
                                                } 
                                            echo '</ul>';
                                        echo '</li>';
                                        echo "<li class='footer'>";
                                            echo "<a href=".base_url("notice/index").">";
                                                echo $this->lang->line("view_more");
                                            echo '</a>';
                                        echo '</li>';
                                    echo '</ul>';
                                }
                            ?>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img class="language-img" src="<?php 
                                $image = $this->session->userdata('lang'); 
                                echo base_url('uploads/language_image/'.$image.'.png'); ?>" 
                                /> 
                                <span class="label label-warning">14</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header"> <?=$this->lang->line("language")?></li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li class="language" id="arabic">
                                            <a href="<?php echo base_url('language/index/arabic')?>">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url('uploads/language_image/arabic.png'); ?>"/>
                                                </div>
                                                <h4>
                                                    Arabic
                                                    <?php if($image == 'arabic') echo " <i class='glyphicon glyphicon-ok'></i>";  ?>
                                                </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="bengali">
                                            <a href="<?php echo base_url('language/index/bengali')?>">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url('uploads/language_image/bengali.png'); ?>"/>
                                                </div>
                                                <h4>
                                                    Bengali
                                                    <?php if($image == 'bengali') echo " <i class='glyphicon glyphicon-ok'></i>";  ?>
                                                </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="chinese">
                                            <a href="<?php echo base_url('language/index/chinese')?>">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url('uploads/language_image/chinese.png'); ?>"/>
                                                </div>
                                                <h4>
                                                    Chinese
                                                    <?php if($image == 'chinese') echo " <i class='glyphicon glyphicon-ok'></i>";  ?>
                                                </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="english">
                                            <a href="<?php echo base_url('language/index/english')?>">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url('uploads/language_image/english.png'); ?>"/>
                                                </div>
                                                <h4>
                                                    English
                                                    <?php if($image == 'english') echo " <i class='glyphicon glyphicon-ok'></i>";  ?>
                                                </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="french">
                                            <a href="<?php echo base_url('language/index/french')?>">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url('uploads/language_image/french.png'); ?>"/>
                                                </div>
                                                <h4>
                                                    French
                                                    <?php if($image == 'french') echo " <i class='glyphicon glyphicon-ok'></i>";  ?>
                                                </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="german">
                                            <a href="<?php echo base_url('language/index/german')?>">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url('uploads/language_image/german.png'); ?>"/>
                                                </div>
                                                <h4>
                                                    German
                                                    <?php if($image == 'german') echo " <i class='glyphicon glyphicon-ok'></i>";  ?>
                                                </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="hindi">
                                            <a href="<?php echo base_url('language/index/hindi')?>">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url('uploads/language_image/hindi.png'); ?>"/>
                                                </div>
                                                <h4>
                                                    Hindi
                                                    <?php if($image == 'hindi') echo " <i class='glyphicon glyphicon-ok'></i>";  ?>
                                                </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="indonesian">
                                            <a href="<?php echo base_url('language/index/indonesian')?>">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url('uploads/language_image/indonesian.png'); ?>"/>
                                                </div>
                                                <h4>
                                                    Indonesian
                                                    <?php if($image == 'indonesian') echo " <i class='glyphicon glyphicon-ok'></i>";  ?>
                                                </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="italian">
                                            <a href="<?php echo base_url('language/index/italian')?>">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url('uploads/language_image/italian.png'); ?>"/>
                                                </div>
                                                <h4>
                                                    Italian
                                                    <?php if($image == 'italian') echo " <i class='glyphicon glyphicon-ok'></i>";  ?>
                                                </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="romanian">
                                            <a href="<?php echo base_url('language/index/romanian')?>">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url('uploads/language_image/romanian.png'); ?>"/>
                                                </div>
                                                <h4>
                                                    Romanian
                                                    <?php if($image == 'romanian') echo " <i class='glyphicon glyphicon-ok'></i>";  ?>
                                                </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="russian">
                                            <a href="<?php echo base_url('language/index/russian')?>">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url('uploads/language_image/russian.png'); ?>"/>
                                                </div>
                                                <h4>
                                                    Russian
                                                    <?php if($image == 'russian') echo " <i class='glyphicon glyphicon-ok'></i>";  ?>
                                                </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="spanish">
                                            <a href="<?php echo base_url('language/index/spanish')?>">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url('uploads/language_image/spanish.png'); ?>"/>
                                                </div>
                                                <h4>
                                                    Spanish
                                                    <?php if($image == 'spanish') echo " <i class='glyphicon glyphicon-ok'></i>";  ?>
                                                </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="thai">
                                            <a href="<?php echo base_url('language/index/thai')?>">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url('uploads/language_image/thai.png'); ?>"/>
                                                </div>
                                                <h4>
                                                    Thai
                                                    <?php if($image == 'thai') echo " <i class='glyphicon glyphicon-ok'></i>";  ?>
                                                </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="turkish">
                                            <a href="<?php echo base_url('language/index/turkish')?>">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url('uploads/language_image/turkish.png'); ?>"/>
                                                </div>
                                                <h4>
                                                    Turkish
                                                    <?php if($image == 'turkish') echo " <i class='glyphicon glyphicon-ok'></i>";  ?>
                                                </h4>
                                            </a>
                                        </li>
             
                                    </ul>
                                </li>
                                <li class="footer"></li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?=base_url("uploads/images/".$this->session->userdata('photo')); 
                                ?>" class="user-logo" alt="" />
                                
                                <span>
                                    <?php
                                        $name = $this->session->userdata('name');
                                        if(strlen($name) > 11) {
                                           echo substr($name, 0,11). ".."; 
                                        } else {
                                            echo $name;
                                        }
                                    ?>
                                    <i class="caret"></i>
                                </span>   
                            </a>

                            <ul class="dropdown-menu">

                                <!-- Menu Body -->

                                <li class="user-body">
                                    <div class="col-xs-6 text-center">
                                        <a href="<?=base_url("profile/index")?>">
                                            <div><i class="fa fa-briefcase"></i></div>
                                            <?=$this->lang->line("profile")?> 
                                        </a>

                                    </div>
                                    <div class="col-xs-6 text-center">
                                        <a href="<?=base_url("signin/cpassword")?>">
                                            <div><i class="fa fa-lock"></i></div>
                                            <?=$this->lang->line("change_password")?> 
                                        </a>
                                    </div>
                                </li>

                                <!-- Menu Footer-->
                                <li class="user-footer">

                                    <div class="text-center">
                                        <a href="<?=base_url("signin/signout")?>">
                                            <div><i class="fa fa-power-off"></i></div>
                                            <?=$this->lang->line("logout")?> 
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>