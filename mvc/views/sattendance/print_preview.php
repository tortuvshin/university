<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $panel_title; ?></title>

<style type="text/css">
    #page-wrap {
        width: 1000px;
        margin: 0 auto;
    }
    .center-justified {
        text-align: justify;
        margin: 0 auto;
        width: 30em;
    }
    /*ini starts here*/
    .list-group {
      padding-left: 0;
      margin-bottom: 15px;
      width: auto;
    }
    .list-group-item {
      position: relative;
      display: block;
      padding: 7.5px 10px;
      margin-bottom: -1px;
      background-color: #fff;
      border: 1px solid #ddd;
      /*margin: 2px;*/
    }
    table {
      border-spacing: 0;
      border-collapse: collapse;
      font-size: 12px;
    }
    td,
    th {
      padding: 0;
    }
    @media print {
      * {
        color: #000 !important;
        text-shadow: none !important;
        background: transparent !important;
        box-shadow: none !important;
      }
      a,
      a:visited {
        text-decoration: underline;
      }
      a[href]:after {
        content: " (" attr(href) ")";
      }
      abbr[title]:after {
        content: " (" attr(title) ")";
      }
      a[href^="javascript:"]:after,
      a[href^="#"]:after {
        content: "";
      }
      pre,
      blockquote {
        border: 1px solid #999;

        page-break-inside: avoid;
      }
      thead {
        display: table-header-group;
      }
      tr,
      img {
        page-break-inside: avoid;
      }
      img {
        max-width: 100% !important;
      }
      p,
      h2,
      h3 {
        orphans: 3;
        widows: 3;
      }
      h2,
      h3 {
        page-break-after: avoid;
      }
      select {
        background: #fff !important;
      }
      .navbar {
        display: none;
      }
      .table td,
      .table th {
        background-color: #fff !important;
      }
      .btn > .caret,
      .dropup > .btn > .caret {
        border-top-color: #000 !important;
      }
      .label {
        border: 1px solid #000;
      }
      .table {
        border-collapse: collapse !important;
      }
      .table-bordered th,
      .table-bordered td {
        border: 1px solid #ddd !important;


      }
    }
    table {
      max-width: 100%;
      background-color: transparent;
      font-size: 12px;
    }
    th {
      text-align: left;
    }
    /*td {
      text-align: center;
      background-color: red;
    }*/
    .table {
      width: 100%;
      margin-bottom: 20px;
    }
    .table h4 {
      font-size: 15px;
      padding: 0px;
      margin: 0px;
    }
    .head {
       border-top: 0px solid #e2e7eb;
       border-bottom: 0px solid #e2e7eb;  
    }
    .table > thead > tr > th,
    .table > tbody > tr > th,
    .table > tfoot > tr > th,
    .table > thead > tr > td,
    .table > tbody > tr > td,
    .table > tfoot > tr > td {
      padding: 8px;
      line-height: 1.428571429;
      vertical-align: top;
      text-align: left;
      /*border-top: 1px solid #e2e7eb; */
    }
    /*ini edit default value : border top 1px to 0 px*/
    .table > thead > tr > th {
      font-size: 15px;
      font-weight: 500;
      vertical-align: bottom;
      /*border-bottom: 2px solid #e2e7eb;*/
      color: #242a30;
     
      
    }
    
    .table > caption + thead > tr:first-child > th,
    .table > colgroup + thead > tr:first-child > th,
    .table > thead:first-child > tr:first-child > th,
    .table > caption + thead > tr:first-child > td,
    .table > colgroup + thead > tr:first-child > td,
    .table > thead:first-child > tr:first-child > td {
      border-top: 0;
    }
    .table > tbody + tbody {
      border-top: 2px solid #e2e7eb;
    }
    .table .table {
      background-color: #fff;
    }
    .table-condensed > thead > tr > th,
    .table-condensed > tbody > tr > th,
    .table-condensed > tfoot > tr > th,
    .table-condensed > thead > tr > td,
    .table-condensed > tbody > tr > td,
    .table-condensed > tfoot > tr > td {
      padding: 5px;
    }
    .table-bordered {
      border: 1px solid #e2e7eb;
      text-align: center;
    }
    .table-bordered > thead > tr > th,
    .table-bordered > tbody > tr > th,
    .table-bordered > tfoot > tr > th,
    .table-bordered > thead > tr > td,
    .table-bordered > tbody > tr > td,
    .table-bordered > tfoot > tr > td {
      border: 1px solid #e2e7eb;
    }
    .table-bordered > thead > tr > th,
    .table-bordered > thead > tr > td {
      border-bottom-width: 2px;
    }
    .table-striped > tbody > tr:nth-child(odd) > td,
    .table-striped > tbody > tr:nth-child(odd) > th {
      background-color: #f0f3f5;
    }
    .panel-title {
      margin-top: 0;
      margin-bottom: 0;
      font-size: 20px;
      color: #fff;
      padding: 0;
    }
    .panel-title > a {
      color: #707478;
      text-decoration: none;
    }
    a {
      background: transparent;
      color: #707478;
      text-decoration: none;
    }
    strong {
        color: #707478;
    }
</style>
</head>
<?php 
  $usertype = $this->session->userdata("usertype");
  if($usertype){
?>
  <body>
    <div id="page-wrap">
      <table width="100%">
        <tr>
          <td>
            <h2 style="text-align:center">
              <?php
                if($siteinfos->photo) {
                    $array = array(
                        "src" => base_url('uploads/images/'.$siteinfos->photo),
                        'width' => '50px',
                        'height' => '50px',
                        "style" => "margin-right:0px;"
                    );
                    echo img($array)."<br>";
                } 
                echo $siteinfos->sname;
                ?>
            </h2>
          </td>
        </tr>
      </table>
      <table width="100%">
        <tbody>
          <tr>
            <td width="8%">
              <?php
                if(count($student)) {
                    $array = array(
                        "src" => base_url('uploads/images/'.$student->photo),
                        'width' => '80px',
                        'height' => '80px',
                        "style" => "margin-bottom:5px; border: 2px solid #707478;"
                    );
                    echo img($array);
                }  
              ?>
            </td>
            <td width="80%">
              <table>
                <tr>
                  <td>
                      <h3 style="margin:0px;"> <strong><?php  echo $student->name; ?></strong></h3>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h5 style="margin:0px;"> <strong><?php  echo $this->lang->line("attendance_classes")." ".$class->classes; ?> </strong>
                    </h5>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h5 style="margin:0px;"> <strong><?php  echo $this->lang->line("attendance_roll")." ".$student->roll; ?></strong>
                    </h5> 
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
              <td colspan="2">&nbsp;</td>
          </tr>
        </tbody>
      </table>

      <table class="table table-bordered">
        <tbody>
          <tr>
            <th colspan="2"><h4><?=$this->lang->line("personal_information")?></h4></th>
          </tr>

          <tr>
              <th width="40%"><?=$this->lang->line("menu_section")?></th>
              <td width="60%"><?php if(count($section)) { echo $section->section;} else { echo $student->section;} ?></td>
          </tr>
                
          <tr>
              <th width="40%"><?=$this->lang->line("attendance_dob")?></th>
              <td width="60%"><?php  echo $student->dob; ?></td>
          </tr>

          <tr>
              <th width="40%"><?=$this->lang->line("attendance_sex")?></th>
              <td width="60%"><?php  echo $student->sex; ?></td>
          </tr>
          <tr>
              <th width="40%"><?=$this->lang->line("attendance_religion")?></th>
              <td width="60%"><?php  echo $student->religion; ?></td>
          </tr>
          <tr>
              <th width="40%"><?=$this->lang->line("attendance_email")?></th>
              <td width="60%"><?php  echo $student->email; ?></td>
          </tr>
          <tr>
              <th width="40%"><?=$this->lang->line("attendance_phone")?></th>
              <td width="60%"><?php  echo $student->phone; ?></td>
          </tr>
          <tr>
              <th width="40%"><?=$this->lang->line("attendance_address")?></th>
              <td width="60%"><?php  echo $student->address; ?></td>
          </tr>
        </tbody> 
      </table>  

      <table class="table table-striped table-bordered">
        <thead>
            <tr>
              <td colspan="32"><h4><?=$this->lang->line("attendance_information")?></h4></td>
            </tr>
            <tr>
                <th>#</th> 
                <th><?=$this->lang->line('attendance_1')?></th>
                <th><?=$this->lang->line('attendance_2')?></th>
                <th><?=$this->lang->line('attendance_3')?></th>
                <th><?=$this->lang->line('attendance_4')?></th>
                <th><?=$this->lang->line('attendance_5')?></th>
                <th><?=$this->lang->line('attendance_6')?></th>
                <th><?=$this->lang->line('attendance_7')?></th>
                <th><?=$this->lang->line('attendance_8')?></th>
                <th><?=$this->lang->line('attendance_9')?></th>
                <th><?=$this->lang->line('attendance_10')?></th>
                <th><?=$this->lang->line('attendance_11')?></th>
                <th><?=$this->lang->line('attendance_12')?></th>
                <th><?=$this->lang->line('attendance_13')?></th>
                <th><?=$this->lang->line('attendance_14')?></th>
                <th><?=$this->lang->line('attendance_15')?></th>
                <th><?=$this->lang->line('attendance_16')?></th>
                <th><?=$this->lang->line('attendance_17')?></th>
                <th><?=$this->lang->line('attendance_18')?></th>
                <th><?=$this->lang->line('attendance_19')?></th>
                <th><?=$this->lang->line('attendance_20')?></th>
                <th><?=$this->lang->line('attendance_21')?></th>
                <th><?=$this->lang->line('attendance_22')?></th>
                <th><?=$this->lang->line('attendance_23')?></th>
                <th><?=$this->lang->line('attendance_24')?></th>
                <th><?=$this->lang->line('attendance_25')?></th>
                <th><?=$this->lang->line('attendance_26')?></th>
                <th><?=$this->lang->line('attendance_27')?></th>
                <th><?=$this->lang->line('attendance_28')?></th>
                <th><?=$this->lang->line('attendance_29')?></th>
                <th><?=$this->lang->line('attendance_30')?></th>
                <th><?=$this->lang->line('attendance_31')?></th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $year = date("Y");
            if($attendances) { 

                foreach ($attendances as $key => $attendance) {
                    $monthyear_ex = explode('-', $attendance->monthyear);

                    if($monthyear_ex[0] === '01' && $monthyear_ex[1] == $year ){
                    
        ?>
        <tr>
            <th><?=$this->lang->line('attendance_jan')?></th>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
            <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
        </tr>
        <?php break; } elseif($monthyear_ex[0] === '02' && $monthyear_ex[1] == $year) { ?>
            <tr>
                <th><?=$this->lang->line('attendance_feb')?></th>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
            </tr>
        <?php break; } elseif($monthyear_ex[0] === '03' && $monthyear_ex[1] == $year) { ?>
            <tr>
                <th><?=$this->lang->line('attendance_mar')?></th>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
            </tr>
        <?php break; } elseif($monthyear_ex[0] === '04' && $monthyear_ex[1] == $year) { ?>
            <tr>
                <th><?=$this->lang->line('attendance_apr')?></th>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
            </tr>
        <?php break; } elseif($monthyear_ex[0] === '05' && $monthyear_ex[1] == $year) { ?>
            <tr>
                <th><?=$this->lang->line('attendance_may')?></th>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
            </tr>
        <?php break; } elseif($monthyear_ex[0] === '06' && $monthyear_ex[1] == $year) { ?>
            <tr>
                <th><?=$this->lang->line('attendance_june')?></th>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
            </tr>
        <?php break; } elseif($monthyear_ex[0] === '07' && $monthyear_ex[1] == $year) { ?>
            <tr>
                <th><?=$this->lang->line('attendance_jul')?></th>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
            </tr>
        <?php break; } elseif($monthyear_ex[0] === '08' && $monthyear_ex[1] == $year) { ?>
            <tr>
                <th><?=$this->lang->line('attendance_aug')?></th>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
            </tr>
        <?php break; } elseif($monthyear_ex[0] === '09' && $monthyear_ex[1] == $year) { ?>
            <tr>
                <th><?=$this->lang->line('attendance_sep')?></th>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
            </tr>
        <?php break; } elseif($monthyear_ex[0] === '10' && $monthyear_ex[1] == $year) { ?>
            <tr>
                <th><?=$this->lang->line('attendance_oct')?></th>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
            </tr>
        <?php break; } elseif($monthyear_ex[0] === '11' && $monthyear_ex[1] == $year) { ?>
            <tr>
                <th><?=$this->lang->line('attendance_nov')?></th>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
            </tr>
        <?php break; } elseif($monthyear_ex[0] === '12' && $monthyear_ex[1] == $year) { ?>
            <tr>
                <th><?=$this->lang->line('attendance_dec')?></th>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_1')?>' ><?=$attendance->a1?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_2')?>' ><?=$attendance->a2?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_3')?>' ><?=$attendance->a3?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_4')?>' ><?=$attendance->a4?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_5')?>' ><?=$attendance->a5?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_6')?>' ><?=$attendance->a6?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_7')?>' ><?=$attendance->a7?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_8')?>' ><?=$attendance->a8?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_9')?>' ><?=$attendance->a9?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_10')?>' ><?=$attendance->a10?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_11')?>' ><?=$attendance->a11?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_12')?>' ><?=$attendance->a12?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_13')?>' ><?=$attendance->a13?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_14')?>' ><?=$attendance->a14?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_15')?>' ><?=$attendance->a15?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_16')?>' ><?=$attendance->a16?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_17')?>' ><?=$attendance->a17?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_18')?>' ><?=$attendance->a18?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_19')?>' ><?=$attendance->a19?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_20')?>' ><?=$attendance->a20?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_21')?>' ><?=$attendance->a21?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_22')?>' ><?=$attendance->a22?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_23')?>' ><?=$attendance->a23?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_24')?>' ><?=$attendance->a24?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_25')?>' ><?=$attendance->a25?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_26')?>' ><?=$attendance->a26?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_27')?>' ><?=$attendance->a27?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_28')?>' ><?=$attendance->a28?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_29')?>' ><?=$attendance->a29?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_30')?>' ><?=$attendance->a30?></td>
                <td class="att-bg-color" data-title='<?=$this->lang->line('attendance_31')?>' ><?=$attendance->a31?></td>
            </tr>
        <?php
              break; }
                }
            }
        ?>
        </tbody>
    </table>
      


    </div>
  </body>
<?php } ?>
</html>