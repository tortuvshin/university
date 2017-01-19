<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-flask"></i> <?=$this->lang->line('panel_title')?></h3>
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_mark')?></li>
        </ol>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12"></div>
        </div>
    </div>
</div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-flask"></i> <?=$this->lang->line('panel_title')?></h3>
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_mark')?></li>
        </ol>
    </div>

    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <canvas id="myChartLine"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-flask"></i> <?=$this->lang->line('panel_title')?></h3>
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_mark')?></li>
        </ol>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>

</div>


<script type="text/javascript" src="<?php echo base_url('assets/chartjs/chart.js'); ?>"></script>
<script type="text/javascript">
    var ctx = document.getElementById("myChart");
    var ctxline = document.getElementById("myChartLine");

    var myLineChart = new Chart(ctxline, {
        type: 'line',
        data: {
            labels: ["2013-2014 оны 1-р улирал",
                     "2013-2014 оны 2-р улирал", 
                     "2014-2015 оны 1-р улирал", 
                     "2014-2015 оны 2-р улирал", 
                     "2015-2016 оны 1-р улирал", 
                     "2015-2016 оны 2-р улирал", 
                     "2016-2017 оны 1-р улирал"],
            datasets: [
                {
                    label: "Голч дүн",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(75,192,192,0.4)",
                    borderColor: "rgba(75,192,192,1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(75,192,192,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(75,192,192,1)",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: [2.1, 2.5, 2.4, 3.2, 2.0, 2.8, 1.6],
                    spanGaps: false,
                }
            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            hover: {
                mode: 'label'
            },
            scales: {
                xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Хичээлийн жил'
                        }
                    }],
                yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            steps: 10,
                            stepValue: 5,
                            max: 4.0
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Үнэлгээний голч дүн'
                        }
                    }]
            },
            title: {
                display: true,
                text: 'Оюутны дүнгийн үзүүлэлт'
            }
        }
    });
    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: ["Хөтөлбөрийн хэмжээнд", "Сургуулийн хэмжээнд", "Citi-ийн хэмжээнд"],
            datasets: [{
                label: 'Дүнгийн үзүүлэлт индексээр',
                data: [12, 119, 343],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
    $('#classesID').change(function() {
        var classesID = $(this).val();
        if(classesID == 0) {
            $('#hide-table').hide();
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('mark/mark_list')?>",
                data: "id=" + classesID,
                dataType: "html",
                success: function(data) {
                    window.location.href = data;
                }
            });
        }
    });
</script>