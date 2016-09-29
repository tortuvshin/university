        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?=base_url("uploads/images/".$this->session->userdata('photo')); 
                                ?>" class="img-circle" alt="User Image" />
                        </div>

                        <div class="pull-left info">
                            <?php
                                $name = $this->session->userdata("name");
                                if(strlen($name) > 11) {
                                   $name = substr($name, 0,11). ".."; 
                                }
                                echo "<p>".$name."</p>";
                            ?>
                            <a href="<?=base_url("profile/index")?>">
                                <i class="fa fa-hand-o-right color-green"></i>
                                <?=$this->lang->line($this->session->userdata("usertype"))?>
                            </a>
                        </div>
                    </div>

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <?php $usertype = $this->session->userdata("usertype"); ?>
                    <ul class="sidebar-menu">
                        <li>
                            <?php
                                echo anchor('dashboard/index', '<i class="fa fa-laptop"></i><span>'.$this->lang->line('menu_dashboard').'</span>'); 
                            ?>
                        </li>

                        <?php 
                            if($usertype == "Admin" || $usertype == "Teacher") {
                                echo '<li>';
                                    echo anchor('student/index', '<i class="fa icon-student"></i><span>'.$this->lang->line('menu_student').'</span>');
                                echo '</li>';
                            } 
                        ?>

                        <?php 
                            if($usertype == "Admin") {
                                echo '<li>';
                                    echo anchor('parentes/index', '<i class="fa fa-user"></i><span>'.$this->lang->line('menu_parent').'</span>');
                                echo '</li>';
                            }
                        ?>

                        <?php
                            if($usertype) {
                                echo '<li>';
                                    echo anchor('teacher/index', '<i class="fa icon-teacher"></i><span>'.$this->lang->line('menu_teacher').'</span>');
                                echo '</li>';
                            }
                        ?>

                        <?php 
                            if($usertype == "Admin") {
                                echo '<li>';
                                    echo anchor('user/index', '<i class="fa fa-users"></i><span>'.$this->lang->line('menu_user').'</span>');
                                echo '</li>';
                            }
                        ?>
                        
                        <?php 
                            if($usertype == "Admin") {
                                echo '<li>';
                                    echo anchor('classes/index', '<i class="fa fa-sitemap"></i><span>'.$this->lang->line('menu_classes').'</span>');
                                echo '</li>';
                            }
                        ?>

                        <?php 
                            if($usertype == "Admin") {
                                echo '<li>';
                                    echo anchor('section/index', '<i class="fa fa-star"></i><span>'.$this->lang->line('menu_section').'</span>');
                                echo '</li>';
                            }
                        ?>

                        <?php 
                            if($usertype == "Admin" || $usertype == "Student" || $usertype == "Parent" || $usertype == "Librarian" || $usertype == "Teacher") {
                                echo '<li>';
                                echo anchor('subject/index', '<i class="fa icon-subject"></i><span>'.$this->lang->line('menu_subject').'</span>');
                                echo '</li>';
                            }
                        ?>

                        <?php 
                            if($usertype == "Admin") {
                                echo '<li>';
                                echo anchor('grade/index', '<i class="fa fa-signal"></i><span>'.$this->lang->line('menu_grade').'</span>');
                                echo '</li>';
                            } 
                        ?>

                       
                        <?php if($usertype == "Admin") { ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa icon-exam"></i> 
                                    <span><?=$this->lang->line('menu_exam');?></span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <?php echo anchor('exam/index', '<i class="fa fa-pencil"></i><span>'.$this->lang->line('menu_exam').'</span>'); ?>
                                    </li>
                                    <li>
                                        <?php echo anchor('examschedule/index', '<i class="fa fa-puzzle-piece"></i><span>'.$this->lang->line('menu_examschedule').'</span>'); ?>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php 
                            if($usertype == "Student" || $usertype == "Parent" || $usertype == "Teacher") { 
                                echo '<li>';
                                echo anchor('examschedule/index', '<i class="fa fa-puzzle-piece"></i><span>'.$this->lang->line('menu_examschedule').'</span>');
                                echo '</li>';
                            }
                        ?> 

                        <?php
                            if($usertype == "Admin" || $usertype == "Teacher") { 
                                echo '<li>';
                                    echo anchor('mark/index', '<i class="fa fa-flask"></i><span>'.$this->lang->line('menu_mark').'</span>');
                                echo '</li>';
                            }   
                        ?>
                           
                        <?php
                            if($usertype == "Student") { 
                                echo '<li>';
                                    echo anchor('mark/view', '<i class="fa fa-flask"></i><span>'.$this->lang->line('menu_mark').'</span>');
                                echo '</li>';
                            }
                        ?>

                        <?php
                            if($usertype == "Parent") { 
                                echo '<li>';
                                    echo anchor('mark/index', '<i class="fa fa-flask"></i><span>'.$this->lang->line('menu_mark').'</span>');
                                echo '</li>';
                            }
                        ?> 

                        <?php
                            if($usertype == "Admin" || $usertype == "Student" || $usertype == "Parent" || $usertype == "Teacher") { 
                                echo '<li>';
                                    echo anchor('routine/index', '<i class="fa icon-routine"></i><span>'.$this->lang->line('menu_routine').'</span>');
                                echo '</li>';
                            }
                        ?>

                        <?php if($usertype == "Admin" || $usertype == "Teacher") { ?>
                            <li class="treeview" id="tattendance">
                                <a href="#">
                                    <i class="fa icon-attendance"></i> 
                                    <span><?=$this->lang->line('menu_attendance');?> </span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu" >
                                    <li>
                                        <?php echo anchor('sattendance/index', '<i class="fa icon-sattendance"></i><span>'.$this->lang->line('menu_sattendance').'</span>'); ?>
                                    </li>
                                    <?php if($usertype == "Teacher") { ?>
                                    <li>
                                        <?php echo anchor('tattendance/view', '<i class="fa icon-tattendance"></i><span>'.$this->lang->line('menu_tattendance').'</span>'); ?>
                                    </li>
                                    <?php } else { ?>
                                    <li>
                                        <?php echo anchor('tattendance/index', '<i class="fa icon-tattendance"></i><span>'.$this->lang->line('menu_tattendance').'</span>'); ?>
                                    </li>
                                    <?php } ?>
                                     <li>
                                        <?php echo anchor('eattendance/index', '<i class="fa icon-eattendance"></i><span>'.$this->lang->line('menu_eattendance').'</span>'); ?>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php
                            if($usertype == "Student" || $usertype == "Parent") { 
                                echo '<li id="sattendance">';
                                    echo anchor('sattendance/view', '<i class="fa icon-sattendance"></i><span>'.$this->lang->line('menu_attendance').'</span>');
                                echo '</li>';
                            }
                        ?>

                        <?php if($usertype == "Admin") { ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa icon-library"></i> 
                                    <span><?=$this->lang->line('menu_library');?></span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <?php echo anchor('lmember/index', '<i class="fa icon-member"></i><span>'.$this->lang->line('menu_member').'</span>'); ?>
                                    </li>
                                    <li>
                                        <?php echo anchor('book/index', '<i class="fa icon-lbooks"></i><span>'.$this->lang->line('menu_books').'</span>'); ?>
                                    </li>
                                    <li>
                                        <?php echo anchor('issue/index', '<i class="fa icon-issue"></i><span>'.$this->lang->line('menu_issue').'</span>'); ?>
                                    </li>
                                    <li>
                                        <?php echo anchor('issue/fine', '<i class="fa icon-fine"></i><span>'.$this->lang->line('menu_fine').'</span>'); ?>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php 
                            if($usertype == "Librarian") {
                                echo '<li>';
                                    echo anchor('lmember/index', '<i class="fa icon-member"></i><span>'.$this->lang->line('menu_member').'</span>');
                                echo '</li>';
                            } 
                        ?>
                           
                        <?php 
                            if($usertype == "Librarian" || $usertype == "Parent" || $usertype == "Teacher") {
                                echo '<li>';
                                    echo anchor('book/index', '<i class="fa icon-lbooks"></i><span>'.$this->lang->line('menu_books').'</span>');
                                echo '</li>';
                            } 
                        ?>
                           
                        <?php 
                            if($usertype == "Librarian" || $usertype == "Parent") {
                                echo '<li>';
                                    echo anchor('issue/index', '<i class="fa icon-issue"></i><span>'.$this->lang->line('menu_issue').'</span>');
                                echo '</li>';
                            } 
                        ?>

                        <?php 
                            if($usertype == "Librarian") {
                                echo '<li>';
                                    echo anchor('issue/fine', '<i class="fa icon-fine"></i><span>'.$this->lang->line('menu_fine').'</span>');
                                echo '</li>';
                            } 
                        ?>

                        <?php if($usertype == "Student") { ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa icon-exam"></i> 
                                    <span><?=$this->lang->line('menu_library');?></span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    
                                    <li>
                                        <?php echo anchor('book/index', '<i class="fa icon-lbooks"></i><span>'.$this->lang->line('menu_books').'</span>'); ?>
                                    </li>
                                    <li>
                                        <?php echo anchor('issue/index', '<i class="fa icon-issue"></i><span>'.$this->lang->line('menu_issue').'</span>'); ?>
                                    </li>
                                   
                                    <li>
                                        <?php echo anchor('lmember/view', '<i class="fa fa-briefcase"></i><span>'.$this->lang->line('menu_profile').'</span>'); ?>
                                    </li>

                                </ul>
                            </li>
                        <?php } ?>

                        <?php if($usertype == "Admin" || $usertype == "Accountant") { ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa icon-bus"></i> 
                                    <span><?=$this->lang->line('menu_transport');?></span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <?php echo anchor('transport/index', '<i class="fa icon-sbus"></i><span>'.$this->lang->line('menu_transport').'</span>'); ?>
                                    </li>
                                    <li>
                                        <?php echo anchor('tmember/index', '<i class="fa icon-member"></i><span>'.$this->lang->line('menu_member').'</span>'); ?>
                                    </li>

                                </ul>
                            </li>
                        <?php } ?>

                        <?php if($usertype == "Student") { ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa icon-bus"></i> 
                                    <span><?=$this->lang->line('menu_transport');?></span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <?php echo anchor('transport/index', '<i class="fa icon-sbus"></i><span>'.$this->lang->line('menu_transport').'</span>'); ?>
                                    </li>
                                    <li>
                                        <?php echo anchor('tmember/view', '<i class="fa fa-briefcase"></i><span>'.$this->lang->line('menu_profile').'</span>'); ?>
                                    </li>

                                </ul>
                            </li>
                        <?php } ?>

                        <?php 
                            if($usertype == "Parent" || $usertype == "Teacher" || $usertype == "Librarian") { 
                                echo '<li>';
                                echo anchor('transport/index', '<i class="fa icon-sbus"></i><span>'.$this->lang->line('menu_transport').'</span>');
                                echo '</li>';
                            }
                        ?>

                        <?php if($usertype) { ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa icon-hhostel"></i> 
                                    <span><?=$this->lang->line('menu_hostel');?></span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <?php echo anchor('hostel/index', '<i class="fa icon-hostel"></i><span>'.$this->lang->line('menu_hostel').'</span>'); ?>
                                    </li>
                                    <li>
                                        <?php echo anchor('category/index', '<i class="fa fa-leaf"></i><span>'.$this->lang->line('menu_category').'</span>'); ?>
                                    </li>
                                    <li>
                                        <?php if($usertype == "Admin" || $usertype == "Accountant") { echo anchor('hmember/index', '<i class="fa icon-member"></i><span>'.$this->lang->line('menu_member').'</span>'); } ?>
                                    </li>
                                    <li>
                                        <?php if($usertype == "Student") { echo anchor('hmember/view', '<i class="fa fa-briefcase"></i><span>'.$this->lang->line('menu_profile').'</span>'); } ?>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if($usertype == "Admin") { ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa icon-account"></i> 
                                    <span><?=$this->lang->line('menu_account');?></span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <?php echo anchor('feetype/index', '<i class="fa icon-feetype"></i><span>'.$this->lang->line('menu_feetype').'</span>'); ?>
                                    </li>
                                    <li>
                                        <?php echo anchor('invoice/index', '<i class="fa icon-invoice"></i><span>'.$this->lang->line('menu_invoice').'</span>'); ?>
                                    </li>
                                    <li>
                                        <?php echo anchor('balance/index', '<i class="fa icon-payment"></i><span>'.$this->lang->line('menu_balance').'</span>'); ?>
                                    </li>
                                    <li>
                                        <?php echo anchor('expense/index', '<i class="fa icon-expense"></i><span>'.$this->lang->line('menu_expense').'</span>'); ?>
                                    </li>
                                    <li>
                                        <?php echo anchor('payment_settings/index', '<i class="fa icon-paymentsettings"></i><span>'.$this->lang->line('menu_paymentsettings').'</span>'); ?>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if($usertype == "Accountant") { ?>
                            <li>
                                <?php echo anchor('feetype/index', '<i class="fa icon-feetype"></i><span>'.$this->lang->line('menu_feetype').'</span>'); ?>
                            </li>
                            <li>
                                <?php echo anchor('invoice/index', '<i class="fa icon-invoice"></i><span>'.$this->lang->line('menu_invoice').'</span>'); ?>
                            </li>
                            <li>
                                <?php echo anchor('balance/index', '<i class="fa icon-payment"></i><span>'.$this->lang->line('menu_balance').'</span>'); ?>
                            </li>
                            <li>
                                <?php echo anchor('expense/index', '<i class="fa icon-expense"></i><span>'.$this->lang->line('menu_expense').'</span>'); ?>
                            </li>
                        <?php } ?>

                        <?php if($usertype == "Student" || $usertype == "Parent") { ?>
                            <li>
                                <?php echo anchor('invoice/index', '<i class="fa icon-invoice"></i><span>'.$this->lang->line('menu_invoice').'</span>'); ?>
                            </li>
                        <?php } ?>

                        <?php
                            if($usertype == "Admin" || $usertype == "Teacher") { 
                                echo '<li>';
                                    echo anchor('promotion/index', '<i class="fa icon-promotion"></i><span>'.$this->lang->line('menu_promotion').'</span>');
                                echo '</li>';
                            }
                        ?>

                        <?php
                            if($usertype) { 
                                echo '<li>';
                                    echo anchor('media/index', '<i class="fa fa-film"></i><span>'.$this->lang->line('menu_media').'</span>');
                                echo '</li>';
                            }
                        ?>

                        <?php if($usertype == "Admin") { ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa icon-mailandsmstop"></i> 
                                    <span><?=$this->lang->line('menu_mailandsms');?></span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <?php echo anchor('mailandsmstemplate/index', '<i class="fa icon-template"></i><span>'.$this->lang->line('menu_mailandsmstemplate').'</span>'); ?>
                                    </li>
                                    <li>
                                        <?php echo anchor('mailandsms/index', '<i class="fa icon-mailandsms"></i><span>'.$this->lang->line('menu_mailandsms').'</span>'); ?>
                                    </li>
                                    <li>
                                        <?php echo anchor('smssettings/index', '<i class="fa fa-wrench"></i><span>'.$this->lang->line('menu_smssettings').'</span>'); ?>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php
                            if($usertype) { 
                                echo '<li>';
                                    echo anchor('message/index', '<i class="fa fa-envelope"></i><span>'.$this->lang->line('menu_message').'</span>');
                                echo '</li>';
                            }
                        ?>
                        

                        <?php
                            if($usertype) { 
                                echo '<li>';
                                    echo anchor('notice/index', '<i class="fa fa-calendar"></i><span>'.$this->lang->line('menu_notice').'</span>');
                                echo '</li>';
                            }
                        ?>

                        <?php 
                            if($this->session->userdata("usertype") == "Admin") {
                                echo '<li>';
                                    echo anchor('report/index', '<i class="fa fa-clipboard"></i><span>'.$this->lang->line('menu_report').'</span>');
                                echo '</li>';
                            }
                        ?>

                        <?php
                            if($this->session->userdata("usertype") == "Admin") { 
                                echo '<li>';
                                    echo anchor('setting/index', '<i class="fa fa-gears"></i><span>'.$this->lang->line('menu_setting').'</span>');
                                echo '</li>';
                            } 
                        ?>

                        <?php
                            if($this->session->userdata("usertype") == "Admin") { 
                                echo '<li>';
                                    echo anchor('update/index', '<i class="fa fa-refresh"></i><span>'.$this->lang->line('menu_update').'</span>');
                                echo '</li>';
                            } 
                        ?>
  
                    </ul>
                    
                </section>
                <!-- /.sidebar -->
            </aside>