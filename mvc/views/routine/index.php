
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-routine"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_routine')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <?php 
                    $usertype = $this->session->userdata("usertype");
                    if($usertype == "Teacher") {
                ?>

                    <div class="col-sm-6 col-sm-offset-3 list-group">
                        <div class="list-group-item list-group-item-warning">
                            <form style="" class="form-horizontal" role="form" method="post">  
                                <div class="form-group">              
                                    <label for="classesID" class="col-sm-2 col-sm-offset-2 control-label">
                                        <?=$this->lang->line("routine_classes")?>
                                    </label>
                                    <div class="col-sm-6">
                                        <?php
                                            $array = array("0" => $this->lang->line("routine_select_classes"));
                                            foreach ($classes as $classa) {
                                                $array[$classa->classesID] = $classa->classes;
                                            }
                                            echo form_dropdown("classesID", $array, set_value("classesID", $set), "id='classesID' class='form-control'");
                                        ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php } ?>

                <?php 
                    $usertype = $this->session->userdata("usertype");
                    if($usertype == "Admin") {
                ?>

                    <h5 class="page-header">
                        <a href="<?php echo base_url('routine/add') ?>">
                            <i class="fa fa-plus"></i> 
                            <?=$this->lang->line('add_title')?>
                        </a>
                    </h5>

                    <div class="col-sm-6 col-sm-offset-3 list-group">
                        <div class="list-group-item list-group-item-warning">
                            <form style="" class="form-horizontal" role="form" method="post">  
                                <div class="form-group">              
                                    <label for="classesID" class="col-sm-2 col-sm-offset-2 control-label">
                                        <?=$this->lang->line("routine_classes")?>
                                    </label>
                                    <div class="col-sm-6">
                                        <?php
                                            $array = array("0" => $this->lang->line("routine_select_classes"));
                                            foreach ($classes as $classa) {
                                                $array[$classa->classesID] = $classa->classes;
                                            }
                                            echo form_dropdown("classesID", $array, set_value("classesID", $set), "id='classesID' class='form-control'");
                                        ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <?php if(count($routines) > 0 ) { ?>

                        <div class="col-sm-12">

                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true"><?=$this->lang->line("routine_all_routine")?></a></li>
                                    <?php foreach ($sections as $key => $section) {
                                        echo '<li class=""><a data-toggle="tab" href="#'. $section->sectionID .'" aria-expanded="false">'. $this->lang->line("student_section")." ".$section->section. " ( ". $section->category." )".'</a></li>';
                                    } ?>
                                </ul>


                                <div class="tab-content">
                                    <div id="all" class="tab-pane active">
                                        <div id="hide-table-2">
                                            <table id="table" class="table table-striped ">
                                                <tbody>
                                                    <?php
                                                        $us_days = array('MONDAY' => $this->lang->line('monday'), 'TUESDAY' => $this->lang->line('tuesday'), 'WEDNESDAY' => $this->lang->line('wednesday'), 'THURSDAY' => $this->lang->line('thursday'), 'FRIDAY' => $this->lang->line('friday'), 'SATURDAY' => $this->lang->line('saturday'), 'SUNDAY' => $this->lang->line('sunday'));
                                                        $flag = 0;
                                                        $map = function($r) {return $r->day;};
                                                        $count = array_count_values(array_map($map, $routines));
                                                        $max = max($count);
                                                        foreach ($us_days as $key => $us_day) {
                                                            $row_count = 0;
                                                            foreach ($routines as $routine) {
                                                                if($routine->day == $key) {
                                                                    if($flag == 0) {
                                                                        echo '<tr>';
                                                                        echo '<td>'.$us_day.'</td>';
                                                                        $flag = 1;
                                                                    } 
                                                                    echo '<td>';
                                                                    echo '<div class="btn-group">';
                                                                    echo "<span type=\"button\" class=\"btn btn-success\">"; 
                                                                        echo $routine->start_time.'-'.$routine->end_time.'<br/>';
                                                                        echo $routine->section.'<br/>';
                                                                        echo $routine->subject.'<br/>';
                                                                        echo $routine->room.'<br/>';
                                                                        echo btn_edit('routine/edit/'.$routine->routineID.'/'.$set, $this->lang->line('edit'));
                                                                        echo btn_delete('routine/delete/'.$routine->routineID.'/'.$set, $this->lang->line('delete'));
                                                                    echo '</span>';
                                                                    echo '</div>';
                                                                    echo '</td>'; 
                                                                    $row_count++;
                                                                } 
                                                            }

                                                            
                                                            if($flag == 1) {
                                                                while($row_count<$max) {
                                                                    echo "<td></td>";
                                                                    $row_count++;
                                                                }
                                                                echo '</tr>';
                                                                $flag = 0;
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <?php foreach ($sections as $key => $section) { ?>
                                        <div id="<?=$section->sectionID?>" class="tab-pane">
                                            <div id="hide-table-2">
                                                <table id="table" class="table table-striped ">
                                                    <tbody>
                                                        <?php
                                                            if(count($allsection[$section->section])) {

                                                                $us_days = array('MONDAY' => $this->lang->line('monday'), 'TUESDAY' => $this->lang->line('tuesday'), 'WEDNESDAY' => $this->lang->line('wednesday'), 'THURSDAY' => $this->lang->line('thursday'), 'FRIDAY' => $this->lang->line('friday'), 'SATURDAY' => $this->lang->line('saturday'), 'SUNDAY' => $this->lang->line('sunday'));
                                                                $flag = 0;
                                                                $map = function($r) {return $r->day;};
                                                                $count = array_count_values(array_map($map, $routines));
                                                                $max = max($count);
                                                                foreach ($us_days as $key => $us_day) {
                                                                    $row_count = 0;
                                                                    foreach($allsection[$section->section] as $routine) {
                                                                        if($routine->day == $key) {
                                                                            if($flag == 0) {
                                                                                echo '<tr>';
                                                                                echo '<td>'.$us_day.'</td>';
                                                                                $flag = 1;
                                                                            } 
                                                                            echo '<td>';
                                                                            echo '<div class="btn-group">';
                                                                            echo "<span type=\"button\" class=\"btn btn-success\">"; 
                                                                                echo $routine->start_time.'-'.$routine->end_time.'<br/>';
                                                                                echo $routine->subject.'<br/>';
                                                                                echo $routine->room.'<br/>';
                                                                                echo btn_edit('routine/edit/'.$routine->routineID.'/'.$set, $this->lang->line('edit'));
                                                                                echo btn_delete('routine/delete/'.$routine->routineID.'/'.$set, $this->lang->line('delete'));
                                                                            echo '</span>';
                                                                            echo '</div>';
                                                                            echo '</td>'; 
                                                                            $row_count++;
                                                                        } 
                                                                    }
                                                         
                                                                    if($flag == 1) {
                                                                        while($row_count<$max) {
                                                                            echo "<td></td>";
                                                                            $row_count++;
                                                                        }
                                                                        echo '</tr>';
                                                                        $flag = 0;
                                                                    }
                                                                }
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    <?php } ?>

                                </div>

                            </div>
                        </div>

                    <?php } else { ?>

                        <div class="col-sm-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true"><?=$this->lang->line("routine_all_routine")?></a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="all" class="tab-pane active">
                                        <div id="hide-table-2">
                                            <table id="table" class="table table-striped ">
                                                <tbody>
                                                    <?php
                                                        $us_days = array('MONDAY' => $this->lang->line('monday'), 'TUESDAY' => $this->lang->line('tuesday'), 'WEDNESDAY' => $this->lang->line('wednesday'), 'THURSDAY' => $this->lang->line('thursday'), 'FRIDAY' => $this->lang->line('friday'), 'SATURDAY' => $this->lang->line('saturday'), 'SUNDAY' => $this->lang->line('sunday'));
                                                        $flag = 0;
                                                        foreach ($us_days as $key => $us_day) {
                                                            echo '<tr>';
                                                            echo '<td>'.$us_day.'</td>';
                                                            echo '</tr>';
                                                        }  
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                <?php } elseif($usertype == "Teacher") { ?>
                <div class="col-sm-12">


                    <?php if(count($routines) > 0 ) { ?>

                        <div class="col-sm-12">

                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true"><?=$this->lang->line("routine_all_routine")?></a></li>
                                    <?php foreach ($sections as $key => $section) {
                                        echo '<li class=""><a data-toggle="tab" href="#'. $section->sectionID .'" aria-expanded="false">'. $this->lang->line("student_section")." ".$section->section. " ( ". $section->category." )".'</a></li>';
                                    } ?>
                                </ul>


                                <div class="tab-content">
                                    <div id="all" class="tab-pane active">
                                        <div id="hide-table-2">
                                            <table id="table" class="table table-striped ">
                                                <tbody>
                                                    <?php
                                                        $us_days = array('MONDAY' => $this->lang->line('monday'), 'TUESDAY' => $this->lang->line('tuesday'), 'WEDNESDAY' => $this->lang->line('wednesday'), 'THURSDAY' => $this->lang->line('thursday'), 'FRIDAY' => $this->lang->line('friday'), 'SATURDAY' => $this->lang->line('saturday'), 'SUNDAY' => $this->lang->line('sunday'));
                                                        $flag = 0;
                                                        $map = function($r) {return $r->day;};
                                                        $count = array_count_values(array_map($map, $routines));
                                                        $max = max($count);
                                                        foreach ($us_days as $key => $us_day) {
                                                            $row_count = 0;
                                                            foreach ($routines as $routine) {
                                                                if($routine->day == $key) {
                                                                    if($flag == 0) {
                                                                        echo '<tr>';
                                                                        echo '<td>'.$us_day.'</td>';
                                                                        $flag = 1;
                                                                    } 
                                                                    echo '<td>';
                                                                    echo '<div class="btn-group">';
                                                                    echo "<span type=\"button\" class=\"btn btn-success\">"; 
                                                                        echo $routine->start_time.'-'.$routine->end_time.'<br/>';
                                                                        echo $routine->section.'<br/>';
                                                                        echo $routine->subject.'<br/>';
                                                                        echo $routine->room;
                                                                    echo '</span>';
                                                                    echo '</div>';
                                                                    echo '</td>'; 
                                                                    $row_count++;
                                                                } 
                                                            }

                                                            
                                                            if($flag == 1) {
                                                                while($row_count<$max) {
                                                                    echo "<td></td>";
                                                                    $row_count++;
                                                                }
                                                                echo '</tr>';
                                                                $flag = 0;
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <?php foreach ($sections as $key => $section) { ?>
                                        <div id="<?=$section->sectionID?>" class="tab-pane">
                                            <div id="hide-table-2">
                                                <table id="table" class="table table-striped ">
                                                    <tbody>
                                                        <?php
                                                            if(count($allsection[$section->section])) {

                                                                $us_days = array('MONDAY' => $this->lang->line('monday'), 'TUESDAY' => $this->lang->line('tuesday'), 'WEDNESDAY' => $this->lang->line('wednesday'), 'THURSDAY' => $this->lang->line('thursday'), 'FRIDAY' => $this->lang->line('friday'), 'SATURDAY' => $this->lang->line('saturday'), 'SUNDAY' => $this->lang->line('sunday'));
                                                                $flag = 0;
                                                                $map = function($r) {return $r->day;};
                                                                $count = array_count_values(array_map($map, $routines));
                                                                $max = max($count);
                                                                foreach ($us_days as $key => $us_day) {
                                                                    $row_count = 0;
                                                                    foreach($allsection[$section->section] as $routine) {
                                                                        if($routine->day == $key) {
                                                                            if($flag == 0) {
                                                                                echo '<tr>';
                                                                                echo '<td>'.$us_day.'</td>';
                                                                                $flag = 1;
                                                                            } 
                                                                            echo '<td>';
                                                                            echo '<div class="btn-group">';
                                                                            echo "<span type=\"button\" class=\"btn btn-success\">"; 
                                                                                echo $routine->start_time.'-'.$routine->end_time.'<br/>';
                                                                                echo $routine->subject.'<br/>';
                                                                                echo $routine->room;
                                                                            echo '</span>';
                                                                            echo '</div>';
                                                                            echo '</td>'; 
                                                                            $row_count++;
                                                                        } 
                                                                    }
                                                         
                                                                    if($flag == 1) {
                                                                        while($row_count<$max) {
                                                                            echo "<td></td>";
                                                                            $row_count++;
                                                                        }
                                                                        echo '</tr>';
                                                                        $flag = 0;
                                                                    }
                                                                }
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    <?php } ?>

                                </div>

                            </div>
                        </div>

                    <?php } else { ?>

                        <div class="col-sm-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true"><?=$this->lang->line("routine_all_routine")?></a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="all" class="tab-pane active">
                                        <div id="hide-table-2">
                                            <table id="table" class="table table-striped ">
                                                <tbody>
                                                    <?php
                                                        $us_days = array('MONDAY' => $this->lang->line('monday'), 'TUESDAY' => $this->lang->line('tuesday'), 'WEDNESDAY' => $this->lang->line('wednesday'), 'THURSDAY' => $this->lang->line('thursday'), 'FRIDAY' => $this->lang->line('friday'), 'SATURDAY' => $this->lang->line('saturday'), 'SUNDAY' => $this->lang->line('sunday'));
                                                        $flag = 0;
                                                        foreach ($us_days as $key => $us_day) {
                                                            echo '<tr>';
                                                            echo '<td>'.$us_day.'</td>';
                                                            echo '</tr>';
                                                        }  
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                </div>
                <?php } elseif($usertype == "Student") { ?> 
                    <?php if(count($routines) > 0 ) { ?>
                        <div id="hide-table-2">
                            <table id="table" class="table table-striped ">
                                <tbody>
                                    <?php
                                        $us_days = array('MONDAY' => $this->lang->line('monday'), 'TUESDAY' => $this->lang->line('tuesday'), 'WEDNESDAY' => $this->lang->line('wednesday'), 'THURSDAY' => $this->lang->line('thursday'), 'FRIDAY' => $this->lang->line('friday'), 'SATURDAY' => $this->lang->line('saturday'), 'SUNDAY' => $this->lang->line('sunday'));
                                        $flag = 0;
                                        $map = function($r) {return $r->day;};
                                        $count = array_count_values(array_map($map, $routines));
                                        $max = max($count);
                                        foreach ($us_days as $key => $us_day) {
                                            $row_count = 0;
                                            foreach ($routines as $routine) {
                                                if($routine->day == $key) {
                                                    if($flag == 0) {
                                                        echo '<tr>';
                                                        echo '<td>'.$us_day.'</td>';
                                                        $flag = 1;
                                                    } 
                                                    echo '<td>';
                                                    echo '<div class="btn-group">';
                                                    echo "<span type=\"button\" class=\"btn btn-success\">"; 
                                                        echo $routine->start_time.'-'.$routine->end_time.'<br/>';
                                                        echo $routine->subject.'<br/>';
                                                        echo $routine->room;
                                                    echo '</span>';
                                                    echo '</div>';
                                                    echo '</td>'; 
                                                    $row_count++;
                                                } 
                                            }

                                            if($flag == 1) {
                                                while($row_count<$max) {
                                                  echo "<td></td>";
                                                  $row_count++;
                                                }
                                                echo '</tr>';
                                                $flag = 0;
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <div id="hide-table-2">
                            <table id="table" class="table table-striped ">
                                <tbody>

          
                                    <?php
                                        $us_days = array('MONDAY' => $this->lang->line('monday'), 'TUESDAY' => $this->lang->line('tuesday'), 'WEDNESDAY' => $this->lang->line('wednesday'), 'THURSDAY' => $this->lang->line('thursday'), 'FRIDAY' => $this->lang->line('friday'), 'SATURDAY' => $this->lang->line('saturday'), 'SUNDAY' => $this->lang->line('sunday'));
                                        $flag = 0;
                                        foreach ($us_days as $key => $us_day) {
                                            echo '<tr>';
                                            echo '<td>'.$us_day.'</td>';
                                            echo '</tr>';
                                        }  
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#classesID').change(function() {
        var classesID = $(this).val();
        if(classesID == 0) {
            $('#table').hide();
            $('.nav-tabs-custom').hide();
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('routine/routine_list')?>",
                data: "id=" + classesID,
                dataType: "html",
                success: function(data) {
                    window.location.href = data;
                }
            });
        }
    });
</script>
