

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

                <div class="col-sm-6 col-sm-offset-3 list-group">
                    <div class="list-group-item list-group-item-warning">
                        <form style="" class="form-horizontal" role="form" method="post">  
                            <div class="form-group">              
                                <label for="studentID" class="col-sm-2 col-sm-offset-2 control-label">
                                    <?=$this->lang->line("routine_student")?>
                                </label>
                                <div class="col-sm-6">
                                    <?php
                                        $array = array("0" => $this->lang->line("routine_select_student"));
                                        if($students) {
                                            foreach ($students as $student) {
                                                $array[$student->studentID] = $student->name;
                                            }
                                        }
                                        echo form_dropdown("studentID", $array, set_value("studentID", $set), "id='studentID' class='form-control'");
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-sm-12">
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
                                                        echo $routine->room.'<br/>';
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
                </div>
            </div> <!-- col-sm-12 -->
            
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->
<script type="text/javascript">
    $('#studentID').change(function() {
        var studentID = $(this).val();
        if(studentID == 0) {
            $('#hide-table').hide();
            $('.nav-tabs-custom').hide();
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('routine/student_list')?>",
                data: "id=" + studentID,
                dataType: "html",
                success: function(data) {
                    window.location.href = data;
                }
            });
        }
    });
</script>